<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
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
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(PostCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back - End Store');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Products');
        yield MenuItem::linkToCrud('Posts', 'fa fa-file', Post::class);
        yield MenuItem::linkToCrud('Category', 'fa fa-tags', Category::class);

        yield MenuItem::section('Settings');
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        /*
        we don't need if statment anymore go to 
        UserConTroller methode : configureCrud() 
        to see permissions changes
    
        if ($this->isGranted('ROLE_ADMIN') && '...') {    
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        } else {
            yield MenuItem::section('User', 'fa fa-user');
        }
        */
    }
}
