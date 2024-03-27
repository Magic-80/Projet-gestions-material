<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\UserType;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/user', name: 'user_index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }
    #[Route('/users', name: 'user_list')]
    public function list(EmployeeRepository $userRepository): Response
    {
        return $this->render('user/detail.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }


    #[Route('/register', name: 'user_register')]
    public function create(Request $request): Response
    {
        $user = new Employee();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encodedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $user->setPassword($encodedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/user/{id}/edit', name: 'user_edit')]
    public function edit(Request $request, Employee $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe avant de l'enregistrer en base de données (si nécessaire)
            // $encodedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            // $user->setPassword($encodedPassword);

            $this->entityManager->flush();

            // Redirection vers la liste des utilisateurs après la modification
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}