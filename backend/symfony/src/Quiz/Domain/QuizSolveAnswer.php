<?php

namespace App\Quiz\Domain;

class QuizSolveAnswer
{
    private int $id;

    private QuizSolve $quizSolve;

    private string $participantName;

    private Answer $answer;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getQuizSolve(): QuizSolve
    {
        return $this->quizSolve;
    }

    public function setQuizSolve(QuizSolve $quizSolve): void
    {
        $this->quizSolve = $quizSolve;
    }

    public function getParticipantName(): string
    {
        return $this->participantName;
    }

    public function setParticipantName(string $participantName): void
    {
        $this->participantName = $participantName;
    }

    public function getAnswer(): Answer
    {
        return $this->answer;
    }

    public function setAnswer(Answer $answer): void
    {
        $this->answer = $answer;
    }
}
