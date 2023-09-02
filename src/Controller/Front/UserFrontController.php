<?php

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

Class UserFrontController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
public function login(AuthenticationUtils $authenticationUtils): Response
{
    $error = $authenticationUtils->getLastAuthenticationError();

    // Utilisez getLastUsername() pour récupérer le nom d'utilisateur (ou l'e-mail)
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('user/login.html.twig', [
        'email' => $lastUsername, // Vous pouvez le passer à votre modèle de vue
        'error' => $error,
    ]);
}

    #[Route('/register', name: 'app_register')]
    public function register()
    {
        return $this->render('user/register.html.twig');
    }
}