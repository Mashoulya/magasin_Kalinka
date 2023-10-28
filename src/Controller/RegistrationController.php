<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\JWTService;
use App\Security\EmailVerifier;
use App\Service\SendMailService;
use App\Form\RegistrationFormType;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SendMailService $mail, JWTService $jwt): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // on génère le JWT de l'utilisateur
            // on crée le header
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            // on crée le payload
            $payload = [
                'user_id' => $user->getId()
            ];

            //on génère le token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));
            
            // on envoie un mail
            $mail->send(
                'no-reply@monsite.net',
                $user->getEmail(),
                'Actiivation de votre compte sur le site e-commerce',
                'register',
                compact('user', 'token')
            );

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verif/{token}', name: 'verify_email_user')]
    public function verifyEmailUser($token, JWTService $jwt): Response
    {
        dd($jwt->tokenIsExpired($token));
    }
}
