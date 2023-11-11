<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Controller\ProductController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function product(EntityManagerInterface $entityManager, Request $request): Response
    {
        //récuperer tout de la bdd
        $productRepository = $entityManager->getRepository(Product::class); // Repository pour les produits
     
        $products = $productRepository->findAll();

        $image = [];
        foreach ($products as $product) {
      
        $image[] = $product->getImage();
    }
   
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'image' => $image,
        ]);
    }
}
