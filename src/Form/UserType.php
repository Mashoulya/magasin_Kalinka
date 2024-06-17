<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civility', TextType::class, [
            'label' => 'Civilité:',
            // 'choices' => [
            //     'M.' => 'Monsieur',
            //     'Mme' => 'Madame',
            //     'Mlle' => 'Mademoiselle',
            // ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom:',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom:',
            ])
            ->add('tel', TextType::class, [
                'label' => 'Tél:',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
