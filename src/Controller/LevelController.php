<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LevelController extends AbstractController
{
    #[Route('/level', name: 'level')]
    public function index(): Response
    {
        return $this->render('level/index.html.twig', [
            'controller_name' => 'LevelController',
        ]);
    }
}
