<?php

namespace App\User\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\User\Application\Factory\UserFactory;
use App\User\Application\Persister\UserPersister;

class UserCreateCommandHandler implements CommandHandler
{
    private UserFactory $userFactory;
    private UserPersister $userPersister;

    public function __construct(
        UserFactory $userFactory,
        UserPersister $userPersister
    ) {
        $this->userFactory = $userFactory;
        $this->userPersister = $userPersister;
    }

    public function __invoke(UserCreateCommand $command): void
    {
        $user = $this->userFactory->create(
            $command->getEmail(),
            $command->getPassword()
        );

        $this->userPersister->persist($user);
    }
}
