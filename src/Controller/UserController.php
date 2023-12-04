<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user_info')]
    public function index(Request $request, Security $security): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Créer le formulaire
        $form = $this->createForm(UserType::class, $user);

        // Traiter le formulaire soumis
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer les modifications dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // Rediriger vers la page d'informations de l'utilisateur
            return $this->redirectToRoute('app_user_info');
        }

        // Afficher le formulaire dans le template
        return $this->render('user/personal_info.html.twig', [
            'controller_name' => 'UserController',
            'userForm' => $form->createView(),
        ]);
    }
}
    

