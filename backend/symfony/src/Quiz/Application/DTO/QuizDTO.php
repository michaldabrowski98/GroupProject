<?php

namespace App\Quiz\Application\DTO;

class QuizDTO implements \JsonSerializable
{
    private string $name;

    private ?string $description = null;

    /**
     * @var array | QuestionDTO[]
     */
    private array $questions = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): void
    {
        $this->questions = $questions;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'questions' => $this->getQuestions()
        ];
    }
}