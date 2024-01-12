<?php

namespace App\User\Application\Factory;

use App\User\Domain\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function create(string $email, string $password): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setUsername($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        return $user;
    }
}
