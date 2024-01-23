<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebsocketController extends AbstractController
{
    #[Route('/', name: 'websocket')]
    public function index(): Response
    {
        return $this->render('websocket/index.html.twig', [
        ]);
    }
}