<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable 
    {
        return [
            IdField::new('id'),
            TextField::new('first_name'),
            TextField::new('last_name'),
            TelephoneField::new('tel'),
            EmailField::new('email'),
            Field::new('password')
                ->setFormType(PasswordType::class)
                ->setLabel('Password'),
            // ChoiceField::new('roles') modifier(?)
        ];
    }
}
