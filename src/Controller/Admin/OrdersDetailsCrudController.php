<?php

namespace App\Controller\Admin;

use App\Entity\OrdersDetails;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrdersDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrdersDetails::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('orders'),
            TextField::new('product.name', 'Product Name'), // Affiche le nom du produit
            ImageField::new('product.image', 'Product Image') // Affiche la photo du produit
                ->setBasePath('/upload/images/products') // Spécifiez le chemin de base vers les images
                ->setUploadDir('/public/upload/images/products') // Spécifiez le répertoire de téléchargement pour les images
                ->setUploadedFileNamePattern('[randomhash].[extension]'), // Modifiez ce modèle en fonction de vos besoins
            IntegerField::new('quantity'),
            NumberField::new('price'),
        ];
    }
    
}
