<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaterialsController extends AbstractController
{
    #[Route('/materials', name: 'materials_index')]
    public function index(MaterialRepository $materialRepository): Response
    {
        return $this->render('materials/index.html.twig', [
            'materials' => $materialRepository->findAll()
        ]);
    }

    #[Route('/materials/detail', name: 'materials_detail')]
    public function details(MaterialRepository $materialRepository): Response
    {
        return $this->render('materials/detail.html.twig', [
            'materials' => $materialRepository->findAll()
        ]);
    }

    #[Route('/materials/search', name: 'materials_search')]
    public function search(Request $request, MaterialRepository $materialRepository): JsonResponse
    {
        $searchTerm = $request->query->get('searchTerm');

        $materials = $materialRepository->findBySearchTerm($searchTerm);

        $data = [];
        foreach ($materials as $material) {
            $borrowAt = $material->getRelatedTo()->isEmpty() ? null : $material->getRelatedTo()->first()->getBorrowAt()->format('d-m-Y');
            $actualReturnDate = $material->getRelatedTo()->isEmpty() ? null : $material->getRelatedTo()->first()->getActualReturnDate()->format('d-m-Y');
            $firstname = $material->getRelatedTo()->isEmpty() ? null : $material->getRelatedTo()->first()->getStudent()->getFirstname();

            $availability = $material->getRelatedTo()->isEmpty() ? 'Pas Disponible' : 'Disponible'; 

            $data[] = [
                'id' => $material->getId(),
                'name' => $material->getName(), 
                'tagNumber' => $material->getTagNumber(),
                'borrowAt' => $borrowAt,
                'actualReturnDate' => $actualReturnDate,
                'firstname' => $firstname,
                'comment' => $material->getComment(),
                'serialNumber' => $material->getSerialNumber(),
                'availability' => $availability, 
            ];
        }

        return new JsonResponse($data);
    }

}
