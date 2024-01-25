<?php

namespace App\Controller\Quiz;

use App\Quiz\Application\Command\Create\QuizCreateCommand;
use App\Quiz\Application\Command\CreateSolve\QuizSolveCreateCommand;
use App\Quiz\Application\Query\List\QuizListQuery;
use App\Quiz\Application\Query\Quiz\QuizQuery;
use App\Quiz\Domain\Quiz;
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

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
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
}
