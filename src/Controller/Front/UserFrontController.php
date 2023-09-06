<?php

namespace App\Controller\Front;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


Class UserFrontController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        // Vérifiez si le formulaire est soumis
        if ($request->isMethod('POST')) {
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $tel = $request->request->get('phone');
            $email = $request->request->get('email');
            $plainPassword = $request->request->get('password');

            // Créez un nouvel utilisateur
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setTel($tel);
            $user->setEmail($email);
          
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Enregistrez l'utilisateur en BDD
            $entityManager->persist($user);
            $entityManager->flush();

            // Affichez un message de confirmation
            $this->addFlash('success', 'Le compte a été créé.');

            // Redirigez l'utilisateur vers la page d'accueil ou toute autre page souhaitée
            return $this->redirectToRoute('app_index');
        }

        // Si le formulaire n'est pas soumis, affichez le formulaire
        return $this->render('user/register.html.twig');
    }

    
    #[Route('/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Récupérez les données du formulaire
        $email = $request->request->get('email'); // Utilisez le nom du champ dans votre formulaire
        $password = $request->request->get('password');

        // Recherchez l'utilisateur dans la base de données par email
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $email]);

        if ($user) {
            // Vérifiez le mot de passe en utilisant le service de hachage de mot de passe
            if ($passwordHasher->isPasswordValid($user, $password)) {
                // Mot de passe valide, connectez l'utilisateur
                $this->addFlash('success', 'Vous êtes connecté avec succès.');

                return $this->redirectToRoute('app_index'); // Redirigez l'utilisateur vers la page d'accueil
            }
        }

        // En cas d'erreur d'authentification, affichez un message d'erreur
        $this->addFlash('error', 'Adresse e-mail ou mot de passe incorrect.');

        return $this->render('user/login.html.twig');
    }

}