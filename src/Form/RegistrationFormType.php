<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                    'onblur' => 'validateFirstName(this.value)',
                    'required' => 'required'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/',
                        'message' => 'Le prénom ne peut contenir que des lettres et un trait d\'union.'
                    ]),
                ],
            ])
            ->add('lastName', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrez votre nom',
                    'onblur' => 'validateLastName(this.value)',
                    'required' => 'required'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/',
                        'message' => 'Le nom ne peut contenir que des lettres et un trait d\'union.'
                    ]),
                ],
            ])
            ->add('tel', TelType::class,[
                'attr' => [
                    'placeholder' => 'Entrez votre numéro de téléphone',
                    'onblur' => 'validatePhoneNumber(this.value)',
                    'required' => 'required'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^0[0-9]{9}$/',
                        'message' => 'Le numéro de téléphone doit commencer par 0 et contenir 10 chiffres.'
                    ]),
                ],
            ])
            ->add('email', EmailType::class,[
                'attr' => [
                    'id' => 'email',
                    'placeholder' => 'Entrez votre adresse e-mail',
                    'onblur' => 'validateEmail(this.value)',
                    'required' => 'required'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Email(),
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Entrez votre mot de passe',
                        'onblur' => 'validatePassword(this.value)',
                        'required' => 'required'
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Confirmez votre mot de passe',
                        'onblur' => 'validatePasswordConfirmation(this.value)',
                        'required' => 'required'
                    ],
                ],
                'mapped' => false,
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe doit contenir au moins 8 caractères, dont au moins une majuscule et un symbole',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
