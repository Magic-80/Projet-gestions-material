<?php

namespace App\Controller;

use App\Entity\Borrowing;
use App\Entity\Employee;
use App\Entity\Material;
use App\Form\BorrowingFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BorrowingReturnController extends AbstractController
{
    #[Route('/borrowing', name: 'borrowing_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $borrowing = new Borrowing();

        $borrowing->setBorrowAt(new \DateTime());

        $form = $this->createForm(BorrowingFormType::class, $borrowing);
        $form2 = $this->createForm(BorrowingFormType::class , $borrowing);

        $form->handleRequest($request);
        $form2->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() || $form2->isSubmitted() && $form2->isValid()) {
            // Si l'objet existe et est disponible, continuez avec le traitement du formulaire
            $entityManager->persist($borrowing);
            $entityManager->flush();
            return $this->redirectToRoute('borrowing_index');
        }

        return $this->render('borrowing/index.html.twig', [
            'borrowing_form' => $form->createView(),
            'returning_form' => $form2->createView()
        ]);
    }

}
