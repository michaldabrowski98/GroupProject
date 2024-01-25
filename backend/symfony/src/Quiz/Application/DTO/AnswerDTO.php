<?php

namespace App\Quiz\Application\DTO;

class AnswerDTO implements \JsonSerializable
{
    private int $id;
    private string $content;

    private bool $isCorrect;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'content' => $this->getContent(),
            'is_correct' => $this->isCorrect()
        ];
    }
}
