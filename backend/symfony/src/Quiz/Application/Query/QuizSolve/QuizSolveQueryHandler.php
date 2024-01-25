<?php

namespace App\Quiz\Application\Query\QuizSolve;

use App\Quiz\Application\DTO\AnswerDTO;
use App\Quiz\Application\DTO\QuestionDTO;
use App\Quiz\Application\DTO\QuizDTO;
use App\Quiz\Domain\Answer;
use App\Quiz\Domain\AnswerRepository;
use App\Quiz\Domain\Question;
use App\Quiz\Domain\Quiz;
use App\Quiz\Domain\QuizSolveRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

class QuizSolveQueryHandler implements QueryHandler
{
    private QuizSolveRepository $quizSolveRepository;
    private AnswerRepository $answerRepository;

    public function __construct(
        QuizSolveRepository $quizSolveRepository,
        AnswerRepository $answerRepository
    ) {
        $this->quizSolveRepository = $quizSolveRepository;
        $this->answerRepository = $answerRepository;
    }

    public function __invoke(QuizSolveQuery $query): QuizDTO
    {
        $quizSolve = $this->quizSolveRepository->getQuizSolveByToken($query->getToken());
        $quiz = $quizSolve->getQuiz();

        return $this->getQuizDTO($quiz);
    }

    public function getQuestionDTOs(iterable $questions): array
    {
        $questionDTOs = [];
        /** @var Question $question */
        foreach ($questions as $question) {
            $questionDTO = new QuestionDTO();
            $questionDTO->setImage($question->getImage());
            $questionDTO->setContent($question->getContent());
            $answerDTOs = $this->getAnswerDTOs($question);
            $questionDTO->setAnswers($answerDTOs);
            $questionDTOs[] = $questionDTO;
        }
        return $questionDTOs;
    }

    public function getAnswerDTOs(Question $question): array
    {
        $answerDTOs = [];
        /** @var Answer $answer */
        foreach ($this->answerRepository->getAnswersByQuestionId($question->getId()) as $answer) {
            $answerDTO = new AnswerDTO();
            $answerDTO->setId($answer->getId());
            $answerDTO->setContent($answer->getContent());
            $answerDTO->setIsCorrect($answer->isCorrect());
            $answerDTOs[] = $answerDTO;
        }

        return $answerDTOs;
    }

    public function getQuizDTO(Quiz $quiz): QuizDTO
    {
        $quizDTO = new QuizDTO();
        $quizDTO->setName($quiz->getName());
        $quizDTO->setDescription($quiz->getDescription());
        $questions = $quiz->getQuestions();
        $questionDTOs = $this->getQuestionDTOs($questions);
        $quizDTO->setQuestions($questionDTOs);
        return $quizDTO;
    }
}