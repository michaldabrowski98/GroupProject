<?php

namespace App\Quiz\Domain;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

class QuizSolveAnswerRepository extends ServiceEntityRepository
{
    private QuizSolveRepository $quizSolveRepository;
    public function __construct(
        ManagerRegistry $registry,
        QuizSolveRepository $quizSolveRepository
    ) {
        $this->quizSolveRepository = $quizSolveRepository;
        parent::__construct($registry, QuizSolveAnswer::class);
    }

    /**
     * @throws Exception
     */
    public function addNewQuizSolveAnswer(int $answerId, string $participantName, string $token): void
    {
        $conn = $this->_em->getConnection();
        $conn->insert(
            'quiz_solve_answer',
            [
                'quiz_solve_id' => $this->quizSolveRepository->getQuizSolveByToken($token)->getId(),
                'participant_name' => $participantName,
                'answer_id' => $answerId
            ]
        );
    }
}
