<?php

namespace App\Tests\Unit\Application\Factory;

use App\User\Application\Factory\UserFactory;
use App\User\Domain\User;
use PHPUnit\Framework\TestCase;
final class UserFactoryTest extends TestCase
{
    public function testCreateUser()
    {
        $userFactory = new UserFactory();

        $email = 'test@example.com';
        $password = 'password123';

        $user = $userFactory->create($email, $password);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($email, $user->getUsername());
        $this->assertEquals($password, $user->getPassword());
    }
}
