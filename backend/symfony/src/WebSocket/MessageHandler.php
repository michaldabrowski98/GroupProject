<?php

namespace App\WebSocket;

use App\Quiz\Application\DTO\QuizDTO;
use App\Quiz\Application\Query\QuizSolve\QuizSolveQuery;
use App\Quiz\Domain\QuizSolveAnswerRepository;
use App\Shared\Domain\Bus\Query\QueryBus;
use Doctrine\DBAL\Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use SplObjectStorage;

class MessageHandler implements MessageComponentInterface
{
    protected SplObjectStorage $connections;

    private QueryBus $queryBus;

    private QuizSolveAnswerRepository $answerRepository;

    private array $questions = [];

    private int $questionsIterator = 0;

    private array $users = [];

    public function __construct(
        QueryBus $queryBus,
        QuizSolveAnswerRepository $answerRepository
    ) {
        $this->queryBus = $queryBus;
        $this->answerRepository = $answerRepository;
        $this->connections = new SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->connections->attach($conn);
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $this->connections->detach($conn);
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, MessageInterface $msg): void
    {
        $message = json_decode($msg, true);

        if ('start' === $message['action']) {
            /** @var QuizDTO $quiz */
            $quiz = $this->queryBus->handle(new QuizSolveQuery($message['token']));
            $questions = $quiz->getQuestions();
            $this->questions = $questions;
            $this->questionsIterator = 0;
        } else if ('next' === $message['action']) {
            $this->questionsIterator++;
        }

        foreach($this->connections as $connection) {
            if ($message['type'] === 'control') {
                $connection->send(json_encode($this->questions[$this->questionsIterator] ?? []));
            } else if ($message['type'] === 'user_connect') {
                $this->users[$message['username']] = $message['username'];
                $connection->send(json_encode(["type" => "alert", "users" => array_values($this->users)]));
            } else if($message['type'] === 'answer') {
                try {
                    $this->answerRepository->addNewQuizSolveAnswer((int) $message['answer_id'], $message['username'], $message['token']);
                } catch (Exception $e) {
                    // do nothing
                }
            }
        }
    }
}
