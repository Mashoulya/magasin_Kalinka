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
       
        //on initialise des variables
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

    #[Route('/add/{id}', name: 'add')]
    public function add(Product $product, SessionInterface $session)
    {
        $id = $product->getId();
        $stock = $product->getStock();

        // on récupère le panier existant
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            // si le stock est suffisant
            if ($cart[$id] < $stock) {
           
            $cart[$id]++;
            $session->set('cart', $cart);
            } else {
                // Stock insuffisant, on fait rien
            }
        } elseif ($stock > 0) {
            // Ajouter le produit au panier avec une qté de 1 si le stock est supérieur à zéro
            $cart[$id] = 1;
            $session->set('cart', $cart);
        }

        // Rediriger vers la page panier
        return $this->redirectToRoute('shopping_cart');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Product $product, SessionInterface $session)
    {
        $id = $product->getId();

        $cart = $session->get('cart', []);

        if(!empty($cart[$id])){
            if($cart[$id] > 1)
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }

        $session->set('cart', $cart);

        //on redirige vers la page panier
        return $this->redirectToRoute('shopping_cart');    
    }

    
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Product $product, SessionInterface $session)
    {
        //on récupère id du produit
        $id = $product->getId();

        //on récupère le panier existant
        $cart = $session->get('cart', []);

        if(!empty($cart[$id])){
           unset($cart[$id]);
        }
 
        $session->set('cart', $cart);

        //on redirige vers la page panier
        return $this->redirectToRoute('shopping_cart');        
    }

}

