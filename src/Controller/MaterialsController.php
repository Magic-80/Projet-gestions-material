<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
