<?php

namespace App\Quiz\Domain;

use App\User\Domain\User;

class QuizSolve
{
    private int $id;

    private Quiz $quiz;

    private User $user;

    private string $token;

    private \DateTime $startDate;

    private \DateTime $endDate;

    private iterable $quizSolveAnswers;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getQuiz(): Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getQuizSolveAnswers(): iterable
    {
        return $this->quizSolveAnswers;
    }

    public function setQuizSolveAnswers(iterable $quizSolveAnswers): void
    {
        $this->quizSolveAnswers = $quizSolveAnswers;
    }
}
