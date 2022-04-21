<?php

namespace App\Controller;

use App\Entity\UserEntity;
use App\Repository\UserEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(UserEntityRepository $userEntityRepository, PaginatorInterface $paginator, Request $request ): Response
    {
        $user = $this->getUser();
        $a = $user->getEmail();
        $users = $paginator->paginate(
        $userEntityRepository->findAllUser($a), /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        5 /*limit per page*/
    );

        return $this->render('user/index.html.twig', [
            'users' => $users, 
        ]);
    }

   #[Route('/new_user', name: 'new_user', methods: 'POST')]
   public function addNewUser (Request $request, UserPasswordHasherInterface $passwordHash, EntityManagerInterface  $manager ) : JsonResponse 
   {
    
    
        try {
            $username = $request->request->get('val-name');
            $lastname = $request->request->get('val-username');
            $adresse = $request->request->get('val-suggestions');
            $email = $request->request->get('val-email');
            $password = $request->request->get('val-password');

            $user = new UserEntity;
            $user ->setName($username)
                  ->setfirstName($lastname)
                  ->setEmail($email)
                  ->setAddress($adresse)
                  ->setIsActive(true)
                  ->setPassword($passwordHash->hashPassword($user, $password));  
            if (!empty($username && $lastname  && $adresse  && $email && $password)) {
                $manager->persist($user);
                $manager->flush();

                $result['status'] = true;
                $result['message'] = 'Insertion effectuée avec succès';
                $result['data'] = $user;
            } else {
                $result['message'] = 'Veuillez completé les champs';
            }     

        } catch (\Exception $e) {

            $result['status'] = false;
            $result['message'] = 'Erreur lors de l\'insertion de site : ' . $e->getMessage();
        }
        return new JsonResponse($result);

   }

   #[Route('/form', name: 'user_add_form')]
   public function addForm () : JsonResponse
   {
        try {
            $data['status'] = true;
            $data['html'] = $this->renderView(
                'user/_form.html.twig',
            );
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['message'] = 'Erreur s\'est produite:' . $e->getMessage();
        }

        return new JsonResponse($data);
   }

    #[Route('/table', name: 'table_user')]
    public function table(UserEntityRepository $userEntityRepository, PaginatorInterface $paginator, Request $request): JsonResponse
    {
        $user = $this->getUser();
        $a = $user->getEmail();
        $users = $paginator->paginate(
        $userEntityRepository->findAllUser($a), /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        5 /*limit per page*/
        );
        try {
            $data['status'] = true;
            $data['html'] = $this->renderView('user/_table.html.twig', [
                'users' => $users 
            ]);
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['message'] = 'Erreur s\'est produite:' . $e->getMessage();
        }
        return new JsonResponse($data);
    }

    #[Route('/delete', name: 'delete_user', methods: 'DELETE')]
    public function delete( Request $request,  UserEntityRepository $userEntityRepository, EntityManagerInterface $manager ) : JsonResponse
    {
        try {
            $id = $request->query->get('id');
            $data = $userEntityRepository->find($id);
            $manager->remove($data);
            $manager->flush();
            $result['status'] = true;
            $result['message'] = 'Supprimer avec succes ';
        } catch (\Exception $e) {
            $result['status'] = false;
            $result['message'] =  'Erreur lors de la suppression : ' . $e->getMessage();
        }

        return new JsonResponse($result);
    }

  #[Route('/edit_form', name: 'edit_form', methods: ['GET', 'POST'])]
   public function editForm (Request $request,  UserEntityRepository $userEntityRepository, EntityManagerInterface $manager) : JsonResponse
   {
        
        try {
            $id = $request->query->get('id');
             $user = $userEntityRepository->find($id);

            $data['status'] = true;
            $data['html'] = $this->renderView('user/_edit_form.html.twig', [
                    'user' => $user,
                
            ]);

            
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['message'] = 'Erreur s\'est produite:' . $e->getMessage();
        }

        return new JsonResponse($data);
   }


   #[Route('/edit_user', name: 'edit_user', methods:['GET', 'POST'] ) ]
   public function editUser (Request $request, UserPasswordHasherInterface $passwordHash, EntityManagerInterface  $manager, UserEntityRepository $userEntityRepository ) : JsonResponse 
   {
        $id = $request->query->get('id');
        $user =  $userEntityRepository->find($id);

        try {
            $username = $request->request->get('_username');
            $lastname = $request->request->get('_lastname');
            $adresse = $request->request->get('_adresse');
            $email = $request->request->get('_email');
            $password = $request->request->get('_password');

            $user ->setName($username)
                  ->setfirstName($lastname)
                  ->setEmail($email)
                  ->setAddress($adresse)
                  ->setIsActive(true)
                  ->setPassword($passwordHash->hashPassword($user, $password));  
            if (!empty($username && $lastname  && $adresse  && $email && $password)) {
                $manager->persist($user);
                $manager->flush();

                $result['status'] = true;
                $result['message'] = 'Modification effectuée avec succès';
                $result['data'] = $user;
            } else {
                $result['message'] = 'Veuillez completé les champs';
            }     

        } catch (\Exception $e) {

            $result['status'] = false;
            $result['message'] = 'Erreur lors de l\'insertion de site : ' . $e->getMessage();
        }
        return new JsonResponse($result);

   }

}
