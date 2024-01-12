<?php

namespace App\Controller\Quiz;

use App\Quiz\Application\Command\Create\QuizCreateCommand;
use App\Quiz\Application\Query\List\QuizListQuery;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class QuizController extends AbstractController
{
    private CommandBus $commandBus;

    private QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    #[Route('/quiz/add', name: 'quiz_add', methods: 'post')]
    public function addQuizAction(Request $request): JsonResponse
    {
        $newQuizData = json_decode($request->getContent(), true);

        try {
            $token = $this->container->get('security.token_storage')->getToken();
            $user = $token->getUser();
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return  new JsonResponse(['message' => 'Unauthorized user']);
        }

        $this->commandBus->dispatch(
            new QuizCreateCommand($user, $newQuizData)
        );
        return new JsonResponse(['message' => 'Added Quiz Successfully']);
    }

    #[Route('/quiz/list', name: 'quiz_list', methods: 'get')]
    public function listQuizAction(Request $request): JsonResponse
    {
        try {
            $token = $this->container->get('security.token_storage')->getToken();
            $user = $token->getUser();
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return  new JsonResponse(['message' => 'Unauthorized user']);
        }

        $quizes = $this->queryBus->handle(
            new QuizListQuery($user)
        );

        return new JsonResponse(['quizes' => $quizes]);
    }
}
