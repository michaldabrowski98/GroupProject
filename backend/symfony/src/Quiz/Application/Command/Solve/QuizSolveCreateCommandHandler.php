<?php

namespace App\Quiz\Application\Command\Solve;

use App\Shared\Domain\Bus\Command\CommandHandler;

class QuizSolveCreateCommandHandler implements CommandHandler
{
    public function __invoke(QuizSolveCreateCommand $command): void
    {
    }
}
