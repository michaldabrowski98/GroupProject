<?php

namespace App\Tests\User\Application\Factory;

use App\User\Application\Factory\UserFactory;
use App\User\Domain\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactoryTest extends TestCase
{
    public function testCreateUser(): void
    {
        $email = 'test@example.com';
        $password = 'test_password';

        $passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
        $passwordHash = 'hashed_password';
        $passwordHasher->expects($this->once())
            ->method('hashPassword')
            ->willReturn($passwordHash);

        $userFactory = new UserFactory($passwordHasher);

        $user = $userFactory->create($email, $password);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($email, $user->getUsername());
        $this->assertSame($passwordHash, $user->getPassword());
    }
}
