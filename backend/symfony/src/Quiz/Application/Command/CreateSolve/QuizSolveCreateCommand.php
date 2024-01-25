<?php

namespace App\Quiz\Application\Command\CreateSolve;

use App\Quiz\Domain\Quiz;
use App\Shared\Domain\Bus\Command\Command;
use App\User\Domain\User;

class QuizSolveCreateCommand implements Command
{
    private Quiz $quiz;

    private User $user;

    private string $token;

    public function __construct(
        Quiz $quiz,
        User $user,
        string $token
    ) {
        $this->quiz = $quiz;
        $this->user = $user;
        $this->token = $token;
    }

    public function getQuiz(): Quiz
    {
        return $this->quiz;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
