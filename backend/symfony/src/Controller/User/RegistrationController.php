<?php

namespace App\Controller\User;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\User\Application\Command\Create\UserCreateCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class RegistrationController extends AbstractController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    #[Route('/register', name: 'register', methods: 'post')]
    public function index(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $plaintextPassword = $decoded->password;

        $this->commandBus->dispatch(
            new UserCreateCommand($email, $plaintextPassword)
        );

        return $this->json(['message' => 'Registered Successfully']);
    }
}
