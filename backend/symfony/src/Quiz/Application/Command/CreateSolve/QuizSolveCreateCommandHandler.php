<?php

namespace App\Quiz\Application\Command\CreateSolve;

use App\Quiz\Domain\QuizSolve;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Doctrine\ORM\EntityManagerInterface;

class QuizSolveCreateCommandHandler implements CommandHandler
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(QuizSolveCreateCommand $command): void
    {
        $quizSolve = $this->getQuizSolve($command);//dd($quizSolve);
        $this->entityManager->persist($quizSolve);
        $this->entityManager->flush();
    }

    public function getQuizSolve(QuizSolveCreateCommand $command): QuizSolve
    {
        $quizSolve = new QuizSolve();
        $quizSolve->setQuiz($command->getQuiz());
        $quizSolve->setUser($command->getUser());
        $quizSolve->setToken($command->getToken());
        return $quizSolve;
    }
}
