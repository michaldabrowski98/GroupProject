<?php

namespace App\Quiz\Application\DTO;

class QuizMinDTO implements \JsonSerializable
{
    private int $id;

    private string $name;

    private int $questionsNumber = 0;

    private \DateTime $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuestionsNumber(): int
    {
        return $this->questionsNumber;
    }

    public function setQuestionsNumber(int $questionsNumber): void
    {
        $this->questionsNumber = $questionsNumber;
    }

    public function getCreatedAt(): \DateTime
    {
        return new \DateTime();
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getName(),
            'questions_number' => $this->getQuestionsNumber(),
            'created_at' => $this->getCreatedAt()
        ];
    }
}
