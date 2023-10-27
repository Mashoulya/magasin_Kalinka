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
            TextField::new('product.name', 'Product Name'),
            ImageField::new('product.image', 'Product Image')
                ->setBasePath('/upload/images/products')
                ->setUploadDir('/public/upload/images/products')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            IntegerField::new('quantity'),
            NumberField::new('price'),
        ];
    }
    
}
