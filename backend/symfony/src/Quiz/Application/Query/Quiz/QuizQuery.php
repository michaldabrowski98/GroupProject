<?php

namespace App\Quiz\Application\Query\Quiz;

use App\Shared\Domain\Bus\Query\Query;

class QuizQuery implements Query
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
