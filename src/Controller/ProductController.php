<?php

namespace App\Controller;

use App\Entity\Product;
use App\Controller\ProductController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {

        //récuperer tout de la bdd
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
