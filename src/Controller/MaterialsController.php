<?php

namespace App\Controller;

use App\Form\MaterialFormType;
use App\Repository\MaterialRepository;
use App\Entity\Material;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MaterialsController extends AbstractController
{
    #[Route('/materials', name: 'materials_index')]
    public function index(MaterialRepository $materialRepository): Response
    {
        return $this->render('materials/index.html.twig' , [
            'materials' =>$materialRepository->findAll()
        ]);
    }

    #[Route('/materials/detail', name: 'materials_detail')]
    public function details(MaterialRepository $materialRepository) : Response 
    {
        return $this->render('materials/detail.html.twig' , [
            'materials' =>$materialRepository->findAll()
        ]);
    }
    #[Route('/materials/create', name: 'materials_create')]
    public function create(Request $request, EntityManagerInterface $entityManager) : Response 
    {
       
        $material = new Material();

        $form = $this->createForm(MaterialFormType::class, $material);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($material);
            $entityManager->flush();
           return $this->redirectToRoute('materials_index');
        }
        return $this->render('materials/create.html.twig',[
            'material_form' => $form
        ]);
    }
    #[Route('/materials/{id}', name: 'materials_edit')]
    public function edit(Material $material,Request $request, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(MaterialFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $material = $form->getData();
            $entityManager->persist($material);
            $entityManager->flush();

            return new Response('Création du nouveau matériel avec succes');

        }
        dd($form);
        return $this->render('materials/edit.html.twig',[
            'material_form' => $form
        ]);
    }
}
