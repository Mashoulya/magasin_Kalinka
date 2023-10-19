<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    #[Route('/error403', name: 'error_403')]
    public function error403(): Response
    {
        return $this->render('/bundles/TwigBundle/Exception/error403.html.twig');
    }
}