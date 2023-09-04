<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Controller\CategoryController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function category(EntityManagerInterface $entityManager): Response
    {
        $categoryRepository = $entityManager->getRepository(Category::class);
        $categories = $categoryRepository->findAll();
        
        $productRepository = $entityManager->getRepository(Product::class); // Repository pour les produits
        $products = $productRepository->findAll(); // Récupérer tous les produits
        
        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
