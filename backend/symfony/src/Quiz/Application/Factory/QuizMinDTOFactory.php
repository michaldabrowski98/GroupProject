<?php

namespace App\Quiz\Application\Factory;

use App\Quiz\Application\DTO\QuizMinDTO;
use App\Quiz\Domain\Quiz;

class QuizMinDTOFactory
{
    public function create(Quiz $quiz): QuizMinDTO
    {
        $quizMinDTO = new QuizMinDTO();
        $quizMinDTO->setId($quiz->getId());
        $quizMinDTO->setName($quiz->getName());
        $quizMinDTO->setQuestionsNumber(iterator_count($quiz->getQuestions()));

        return $quizMinDTO;
    }
}
