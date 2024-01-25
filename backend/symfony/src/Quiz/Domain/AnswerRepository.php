<?php

namespace App\Quiz\Domain;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    public function getAnswersByQuestionId(int $questionId): array
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.question = :questionId')
            ->setParameter('questionId', $questionId);

        return $query->getQuery()->execute() ?? [];
    }
}
