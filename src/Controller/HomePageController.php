<?php

namespace App\Controller;

use App\Entity\UserEntity;
use App\Repository\UserEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index( UserEntityRepository $userEntityRepository ): Response
    {

    /*     $user = $this->getUser();
       $a['email'] = $user;
       $a['id'] = $user;
        dd($a); */
       
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
           
        ]);
    }
}
