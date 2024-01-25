<?php

namespace App\Quiz\Domain;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuizSolveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizSolve::class);
    }

    public function getQuizSolveByToken(string $token): ?QuizSolve
    {
        $query = $this->createQueryBuilder('qs')
            ->andWhere('qs.token = :token')
            ->setParameter('token', $token);

        return $query->getQuery()->getSingleResult() ?? null;
    }
}
