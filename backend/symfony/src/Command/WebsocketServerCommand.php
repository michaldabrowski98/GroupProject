<?php

namespace App\Command;

use App\Quiz\Domain\QuizSolveAnswerRepository;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\WebSocket\MessageHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WebsocketServerCommand extends Command
{
    protected static $defaultName = "run:websocket-server";

    private QueryBus $queryBus;

    private QuizSolveAnswerRepository $answerRepository;

    public function __construct(
        QueryBus $queryBus,
        QuizSolveAnswerRepository $answerRepository
    ) {
        parent::__construct('run:websocket-server');
        $this->queryBus = $queryBus;
        $this->answerRepository = $answerRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $port = 3001;
        $output->writeln("Starting server on port " . $port);
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new MessageHandler($this->queryBus, $this->answerRepository)
                )
            ),
            $port
        );
        $server->run();

        return 0;
    }
}