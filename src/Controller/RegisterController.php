<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


Class RegisterController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        // Vérifier si le formulaire est soumis
        if ($request->isMethod('POST')) {
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $tel = $request->request->get('phone');
            $email = $request->request->get('email');
            $plainPassword = $request->request->get('password');

        // Vérifier si le tél existe déjà dans la bdd
        $existingTel = $this->entityManager->getRepository(User::class)->findOneBy(['tel' => $tel]);
        if($existingTel){
            $this->addFlash('errorTel', 'Ce numéro de téléphone est déjà utilisé.');

            return $this->redirectToRoute('app_register');
        }

        // Vérifier si l'email existe déjà
        $existingEmail = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existingEmail) {
    
            $this->addFlash('errorMail', 'Cet email est déjà utilisé.');

            return $this->redirectToRoute('app_register');
        }

            // Créer un nouvel utilisateur
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setTel($tel);
            $user->setEmail($email);
          
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Enregistrer l'utilisateur en BDD
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        // Si le formulaire n'est pas soumis, affichez le formulaire
        return $this->render('user/register.html.twig');
    }

}