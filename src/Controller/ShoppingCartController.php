<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShoppingCartController extends AbstractController
{
    #[Route('/shop', name: 'shopping_cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
       
        //on initialise des ariables
        $data = [];
        $total = 0;
        
        foreach($cart as $id => $quantity){
            $product = $productRepository->find($id);

            $data[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
            $total += $product->getPrice() * $quantity;
        }
       return $this->render('shop/shopping_cart.html.twig', compact('data', 'total'));
    }

    #[Route('/add/{id}', name: 'cart_add')]
    public function add(Product $product, SessionInterface $session)
    {

        //on récupère id du produit
        $id = $product->getId();

        //on récupère le panier existant
        $cart = $session->get('cart', []);


        //on ajoute le produit dan sle panier s'il n'y est pas encore
        //sinon on incrémente sa qte
        if(empty($cart[$id])){
            $cart[$id] = 1;
        }else{
            $cart[$id]++;
        }


        $cart[4] = 1;

        $session->set('cart', $cart);

        //on redirige vers la page panier
        return $this->redirectToRoute('shopping_cart');
        
    }

}

