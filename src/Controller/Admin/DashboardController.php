<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Announcer;
use App\Entity\Breed;
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
    
            // MenuItem::section('Blog'),
            yield MenuItem::linkToCrud('Admin', 'fas fa-tags', Admin::class),
            yield MenuItem::linkToCrud('Announcer', 'fas fa-tags', Announcer::class),
            yield MenuItem::linkToCrud('Race', 'fas fa-tags', Breed::class),
        ];
    }
}
