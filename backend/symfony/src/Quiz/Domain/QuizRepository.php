<?php

namespace App\Quiz\Domain;

use App\User\Domain\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function getQuizByUser(User $author): array
    {
        $query = $this->createQueryBuilder('q')
            ->andWhere('q.author = :author')
            ->setParameter('author', $author);

        return $query->getQuery()->execute() ?? [];
    }
    public function getQuizById(int $quizId): ?Quiz
    {
        $query = $this->createQueryBuilder('q')
            ->andWhere('q.id = :quizId')
            ->setParameter('quizId', $quizId);

        return $query->getQuery()->getSingleResult() ?? null;
    }
}
