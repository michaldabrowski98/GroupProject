<?php

namespace App\Quiz\Application\Command\Create;

use App\Shared\Domain\Bus\Command\Command;
use App\User\Domain\User;

class QuizCreateCommand implements Command
{
    private User $user;
    private array $quiz;

    public function __construct(
        User $user,
        array $quiz
    ) {
        $this->user = $user;
        $this->quiz = $quiz;
    }

    public function getQuiz(): array
    {
        return $this->quiz;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
