<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('shop/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}