<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Announcer;
use App\Entity\Breed;
use App\Entity\Faq;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Adopte Un Chien');
    }

    public function configureMenuItems(): iterable
    {
        return[

            yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            yield MenuItem::linkToCrud('Administrateur', 'fas fa-tags', Admin::class),
            yield MenuItem::linkToCrud('Annonceur', 'fas fa-tags', Announcer::class),
            yield MenuItem::linkToCrud('Race', 'fas fa-tags', Breed::class),
            yield MenuItem::linkToCrud('Faq', 'fas fa-tags', Faq::class),
        ];
    }
}
