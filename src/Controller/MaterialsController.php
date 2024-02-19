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
}
