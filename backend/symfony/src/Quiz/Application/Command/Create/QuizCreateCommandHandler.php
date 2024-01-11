<?php

namespace App\Quiz\Application\Command\Create;

use App\Quiz\Domain\Answer;
use App\Quiz\Domain\Question;
use App\Quiz\Domain\Quiz;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Doctrine\ORM\EntityManagerInterface;

class QuizCreateCommandHandler implements CommandHandler
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(QuizCreateCommand $command): void
    {
        $quizData = $command->getQuiz();
        $quiz = new Quiz();
        $quiz->setAuthor($command->getUser());
        $quiz->setName($quizData['title']);
        $quiz->setDescription($quizData['description']);
        $quizQuestions  = $quizData['questions'];
        $questions = [];
        foreach($quizQuestions as $quizQuestion) {
            $question = new Question();
            $question->setImage($quizQuestion['image']);
            $question->setContent($quizQuestion['content']);

            $questionAnswers = $quizQuestion['answers'];
            $answers = [];
            foreach ($questionAnswers as $questionAnswer) {
                $answer = new Answer();
                $answer->setQuestion($question);
                $answer->setContent($questionAnswer['content']);
                $answer->setIsCorrect($questionAnswer['is_correct']);
                $answers[] = $answer;
            }
            $question->setAnswers($answers);
            $question->setQuiz($quiz);
            $questions[] = $question;
        }
        $quiz->setQuestions($questions);

        $this->entityManager->persist($quiz);
        $this->entityManager->flush();
    }
}
