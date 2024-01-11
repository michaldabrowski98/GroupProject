<?php

namespace App\Controller\Quiz;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class QuizController extends AbstractController
{
    #[Route('/quiz/add', name: 'quiz_add', methods: 'post')]
    public function saveQuizAction(Request $request): JsonResponse
    {
        return new JsonResponse(['message' => 'Added Quize Successfully']);
    }
}
