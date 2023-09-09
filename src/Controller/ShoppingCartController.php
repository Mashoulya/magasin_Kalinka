<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    #[Route('/shop', name: 'app_shopping_cart')]
    public function index(): Response
    {
        return $this->render('shop/shopping_cart.html.twig', [
            'controller_name' => 'ShoppingCartController',
        ]);
    }
}
