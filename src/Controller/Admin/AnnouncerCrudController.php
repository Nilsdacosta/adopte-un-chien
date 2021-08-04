<?php

namespace App\Controller\Admin;

use App\Entity\Announcer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnnouncerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Announcer::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
