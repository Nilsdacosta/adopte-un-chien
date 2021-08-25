<?php

namespace App\Controller\Admin;

use App\Admin\Field\AddressField;
use App\Entity\Announcer;
use App\Form\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnnouncerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Announcer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            EmailField::new('email'),
            TextField::new('plainPassword')->hideOnIndex(),
            AssociationField::new('category'),
            TextareaField::new('description'),
            FormField::addPanel('Adresse'),
            AddressField::new('address')
        ];
    }
}
