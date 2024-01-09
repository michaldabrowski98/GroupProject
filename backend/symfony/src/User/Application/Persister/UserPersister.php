<?php

namespace App\User\Application\Persister;

use App\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

class UserPersister
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function persist(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}

