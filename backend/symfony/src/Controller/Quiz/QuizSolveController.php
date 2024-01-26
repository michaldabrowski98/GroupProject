<?php

namespace App\Controller\Quiz;

use App\Quiz\Application\Command\CreateSolve\QuizSolveCreateCommand;
use App\Quiz\Application\Query\Quiz\QuizQuery;
use App\Quiz\Application\Query\QuizSolve\QuizSolveQuery;
use App\Quiz\Domain\Quiz;
use App\Quiz\Domain\QuizSolveAnswerRepository;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class QuizSolveController extends AbstractController
{
    private CommandBus $commandBus;

    private QueryBus $queryBus;

    private QuizSolveAnswerRepository $answerRepository;

    public function __construct(
        CommandBus $commandBus,
        QueryBus $queryBus,
        QuizSolveAnswerRepository $answerRepository
    ) {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->answerRepository = $answerRepository;
    }

    #[Route('/quiz/solve/start', name: 'quiz_solve_start', methods: 'post')]
    public function addQuizAction(Request $request): JsonResponse
    {
        try {
            $token = $this->container->get('security.token_storage')->getToken();
            $user = $token->getUser();
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return new JsonResponse(['message' => 'Unauthorized user']);
        }

        $requestContent = json_decode($request->getContent(), true);
        $quizId = (int) $requestContent['quiz_id'];
        $quizToken = $requestContent['token'];

        $quiz = $this->queryBus->handle(new QuizQuery($quizId));

        if (!$quiz instanceof Quiz) {
            return new JsonResponse(['message' => 'Unrecognized quiz ID']);
        }

        $this->commandBus->dispatch(
            new QuizSolveCreateCommand($quiz, $user, $quizToken)
        );

        return new JsonResponse(['message' => 'Started Quiz Successfully']);
    }

    #[Route('/quiz/solve/{token}/data', name: 'quiz_solve_data', methods: 'get')]
    public function getQuizDataAction(string $token): JsonResponse
    {
        $quiz = $this->queryBus->handle(new QuizSolveQuery($token));
        $answers = $this->answerRepository->getQuizSolveAnswerData($token);

        $usersScore = [];
        foreach ($answers as $answer) {
            $usersScore[$answer['participant_name']] = 0;
        }

        foreach ($answers as $answer) {
            if ($answer['is_correct']) {
                $usersScore[$answer['participant_name']]++;
            }
        }


        return new JsonResponse(['quiz' => $quiz, 'user_score' => $usersScore]);
    }
}
