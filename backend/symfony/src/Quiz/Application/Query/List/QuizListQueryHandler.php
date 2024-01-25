<?php

namespace App\Quiz\Application\Query\List;

use App\Quiz\Application\Factory\QuizMinDTOFactory;
use App\Quiz\Domain\QuizRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

class QuizListQueryHandler implements QueryHandler
{
    private QuizRepository $quizRepository;

    private QuizMinDTOFactory $quizMinDTOFactory;

    public function __construct(QuizRepository $quizRepository, QuizMinDTOFactory $quizMinDTOFactory)
    {
        $this->quizRepository = $quizRepository;
        $this->quizMinDTOFactory = $quizMinDTOFactory;
    }

    public function __invoke(QuizListQuery $command): array
    {
        $user = $command->getUser();
        $quizes = $this->quizRepository->getQuizByUser($user);
        return $this->getQuizesDTOs($quizes);
    }

    public function getQuizesDTOs(array $quizes): array
    {
        $quizesDTOs = [];
        foreach ($quizes as $quize) {
            $quizesDTOs[] = $this->quizMinDTOFactory->create($quize);
        }
        return $quizesDTOs;
    }
}

