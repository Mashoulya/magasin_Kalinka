<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function category(Request $request, EntityManagerInterface $entityManager, #[MapQueryParameter] string $id): Response
    {
        $categoryRepository = $entityManager->getRepository(Category::class);
        $categories = $categoryRepository->findAll();
        
        $category = $categoryRepository->find($id);
        
        $productRepository = $entityManager->getRepository(Product::class); // Repository pour les produits
     
        $products = $productRepository->findByCategoryId($id);

        
        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
        ]);
    }
}
