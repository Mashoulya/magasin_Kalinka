<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\OrdersDetails;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdersController extends AbstractController
{
    #[Route('/shop', name: 'app_orders')]
    public function listOrders(OrdersRepository $ordersRepository, EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les commandes depuis la base de données
        $newOrders = $ordersRepository->findNonPayedOrders();
        $payedOrders = $ordersRepository->findPayedOrders();

        $orders = $payedOrders;

        return $this->render('shop/orders.html.twig', [
            'orders' => $orders,
            'newOrders' => $newOrders,
            'payedOrders' => $payedOrders,
        ]);
    }
    
    #[Route('/add-order', name: 'app_add_order')]
    public function addOrder(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        //on récupère le panier de la session
        $cart = $session->get('cart', []);
        //le panier est vide
        if($cart === []){
           
            return $this->redirectToRoute('shopping_cart'); // soit app_index !!!
        }

        //le panier n'est pas vide
        $orders = new Orders();

        $orders->setUser($this->getUser());
        $orders->setReference(uniqid()); //       MODIFIER!!!


        //on parcourt le panier pour créer les détails de la commande
        foreach($cart as $item => $quantity){
            $orderDetails = new OrdersDetails();

            $product = $productRepository->find($item);

            $price = $product->getPrice();

            //on crée le détail de commande
            $orderDetails->setProduct($product);
            $orderDetails->setPrice($price);
            $orderDetails->setQuantity($quantity);

            $orders->addOrdersDetails($orderDetails);
        }

        $orders->setPayed(false);

        //on péersiste et on flush
        $em->persist($orders);
        $em->flush();

        $session->remove('cart');

        $this->addFlash('order-success', 'Votre commande a été validée avec succès. Vous pouvez consulter les détails de votre commande depuis votre page "Mes commandes".');

        return $this->redirectToRoute('shopping_cart');
    }
}
