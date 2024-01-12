<?php

namespace App\Quiz\Domain;

use Doctrine\Common\Collections\Collection;

class Question
{
    private ?int $id = null;

    private string $image;

    private string $content;

    private iterable $answers;

    private Quiz $quiz;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAnswers(): iterable
    {
        return $this->answers;
    }

    public function setAnswers(iterable $answers): void
    {
        $this->answers = $answers;
    }

    public function getQuiz(): Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }
}
