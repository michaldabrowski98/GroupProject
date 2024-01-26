<?php

namespace App\Quiz\Application\Query\Quiz;

use App\Quiz\Domain\Quiz;
use App\Quiz\Domain\QuizRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

class QuizQueryHandler implements QueryHandler
{
    private QuizRepository $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function __invoke(QuizQuery $query): ?Quiz
    {
        return $this->quizRepository->getQuizById($query->getId());
    }
}
