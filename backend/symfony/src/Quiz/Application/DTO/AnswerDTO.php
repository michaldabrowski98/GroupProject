<?php

namespace App\Quiz\Application\DTO;

class AnswerDTO implements \JsonSerializable
{
    private string $content;

    private bool $isCorrect;

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
            'content' => $this->getContent(),
            'is_correct' => $this->isCorrect()
        ];
    }
}
