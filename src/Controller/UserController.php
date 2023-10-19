<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user_info')]
    public function index(Security $security): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupérer les données personnelles de l'utilisateur depuis la base de données
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $tel = $user->getTel();

        // Afficher le formulaire avec les données personnelles dans les inputs
        return $this->render('user/personal_info.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'tel' => $tel,
        ]);
    }
}
    

