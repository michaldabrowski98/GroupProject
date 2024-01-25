<?php

namespace App\Quiz\Application\Query\QuizSolve;

use App\Shared\Domain\Bus\Query\Query;

class QuizSolveQuery implements Query
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}