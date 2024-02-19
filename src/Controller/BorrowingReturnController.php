<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BorrowingReturnController extends AbstractController
{
    #[Route('/borrowing', name: 'borrowing_index')]
    public function index(): Response
    {
        return $this->render('borrowing_return/index.html.twig');
    }
}
