<?php

namespace App\Quiz\Application\DTO;

class QuestionDTO implements \JsonSerializable
{
    private string $image;

    private string $content;

    /**
     * @var array | AnswerDTO[]
     */
    private array $answers;

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

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }

    public function jsonSerialize(): array
    {
        return [
            'image' => $this->getImage(),
            'content' => $this->getContent(),
            'answers' => $this->getAnswers()
        ];
    }
}