<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatterController extends AbstractController
{
    #[Route('/matter', name: 'matter')]
    public function index(): Response
    {
        return $this->render('matter/index.html.twig', [
            'controller_name' => 'MatterController',
        ]);
    }
}
