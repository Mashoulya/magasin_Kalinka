<?php

namespace App\Controller\Front;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class UserFrontController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login()
    {
        return $this->render('user/login.html.twig');
    }

    #[Route('/register', name: 'app_register')]
    public function register()
    {
        return $this->render('user/register.html.twig');
    }
}