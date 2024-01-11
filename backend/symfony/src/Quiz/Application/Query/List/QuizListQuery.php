<?php

namespace App\Quiz\Application\Query\List;

use App\Shared\Domain\Bus\Query\Query;
use App\User\Domain\User;

class QuizListQuery implements Query
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
