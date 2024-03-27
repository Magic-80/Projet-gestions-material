<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\UserType;
use App\Repository\BorrowingRepository;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/users', name: 'user_list')]
    public function list(EmployeeRepository $userRepository): Response
    {
        return $this->render('user/detail.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }


    #[Route('/create', name: 'user_register')]
    public function create(Request $request): Response
    {
        $user = new Employee();
        $form = $this->createForm(UserType::class, $user ,[
            'roles' => ['Admin' => 'Admin', 'Prof' => 'Prof', 'Student' => 'Student'],
        ]);

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

        // $user->setRoles(implode(',', $user->getRoles()));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si le champ password est vide
            if ($user->getPassword() !== 'none') {
                // Encoder le mot de passe avant de l'enregistrer en base de données
                $encodedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword($encodedPassword);
            }

            $this->entityManager->flush();

            // Redirection vers la liste des utilisateurs après la modification
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profile/{id}', name: 'profile')]
    public function showProfile(Employee $user, BorrowingRepository $borrowingRepository): Response
    {
        // Récupérer les emprunts gérés par l'utilisateur
        $managedBorrowings = $borrowingRepository->findBy(['manage' => $user]);

        // Récupérer les emprunts où l'utilisateur est l'emprunteur
        $borrowedBorrowings = $borrowingRepository->findBy(['borrow' => $user]);

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'managedBorrowings' => $managedBorrowings,
            'borrowedBorrowings' => $borrowedBorrowings,
        ]);
    }
    #[Route('/register', name: 'register')]
    public function register(Request $request): Response
    {
        $employee = new Employee();
        $form = $this->createForm(UserType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encodedPassword = password_hash($employee->getPassword(), PASSWORD_DEFAULT);
            $employee->setPassword($encodedPassword);

            $this->entityManager->persist($employee);
            $this->entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérer l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        $isLoggedIn = $this->getUser() !== null;

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(LogoutUrlGenerator $logoutUrlGenerator)
    {
        // Cette méthode ne sera jamais exécutée, car la déconnexion est gérée par Symfony
        throw new \Exception('This should never be reached!');
    }
}