<?php

namespace App\Quiz\Domain;

use App\User\Domain\User;
use Doctrine\Common\Collections\Collection;

class Quiz
{
    private ?int $id = null;

    private string $name;

    private ?string $description;

    private User $author;

    private iterable $questions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getQuestions(): iterable
    {
        return $this->questions;
    }

    public function setQuestions(iterable $questions): void
    {
        $this->questions = $questions;
    }
}
