<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request): Response
    {
        $categories = $categoryRepository->findAll();

        $mostPopularProducts = $productRepository->findPopularProducts();

        return $this->render('shop/index.html.twig', [
            'categories' => $categories,
            'mostPopularProducts' => $mostPopularProducts,
        ]);
    }
}