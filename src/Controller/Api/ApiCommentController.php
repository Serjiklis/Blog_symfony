<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCommentController extends AbstractController
{
    #[Route('/api/comment', name: 'app_api_comment')]
    public function index(): Response
    {
        return $this->render('api_comment/index.html.twig', [
            'controller_name' => 'ApiCommentController',
        ]);
    }
}
