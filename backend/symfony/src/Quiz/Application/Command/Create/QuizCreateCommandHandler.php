<?php

namespace App\Quiz\Application\Command\Create;

use App\Quiz\Domain\Answer;
use App\Quiz\Domain\Question;
use App\Quiz\Domain\Quiz;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Doctrine\ORM\EntityManagerInterface;

class QuizCreateCommandHandler implements CommandHandler
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(QuizCreateCommand $command): void
    {
        $quizData = $command->getQuiz();
        $quiz = $this->getQuiz($command, $quizData);
        $this->entityManager->persist($quiz);
        $this->entityManager->flush();
    }

    public function getQuiz(QuizCreateCommand $command, array $quizData): Quiz
    {
        $quiz = new Quiz();
        $quiz->setAuthor($command->getUser());
        $quiz->setName($quizData['title']);
        $quiz->setDescription($quizData['description']);
        $quizQuestions = $quizData['questions'];
        $questions = $this->getQuestions($quizQuestions, $quiz);
        $quiz->setQuestions($questions);
        return $quiz;
    }

    public function getQuestions(array $quizQuestions, Quiz $quiz): array
    {
        $questions = [];
        foreach ($quizQuestions as $quizQuestion) {
            $question = $this->getQuestion($quizQuestion, $quiz);
            $questions[] = $question;
        }
        return $questions;
    }

    public function getQuestion(array $quizQuestion, Quiz $quiz): Question
    {
        $question = new Question();
        $question->setImage($quizQuestion['image']);
        $question->setContent($quizQuestion['content']);

        $questionAnswers = $quizQuestion['answers'];
        $answers = $this->getAnswers($questionAnswers, $question);
        $question->setAnswers($answers);
        $question->setQuiz($quiz);
        return $question;
    }

    public function getAnswers(array $questionAnswers, Question $question): array
    {
        $answers = [];
        foreach ($questionAnswers as $questionAnswer) {
            $answer = $this->getAnswer($question, $questionAnswer);
            $answers[] = $answer;
        }
        return $answers;
    }

    public function getAnswer(Question $question, array $questionAnswer): Answer
    {
        $answer = new Answer();
        $answer->setQuestion($question);
        $answer->setContent($questionAnswer['content']);
        $answer->setIsCorrect($questionAnswer['is_correct']);
        return $answer;
    }
}
