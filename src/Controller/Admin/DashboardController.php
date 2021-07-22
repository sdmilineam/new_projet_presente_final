<?php

namespace App\Controller\Admin;

use App\Entity\Profil;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// ...

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
        // you can also redirect to different pages depending on the current user
        if ('ROLE_ADMIN' === $this->getUser()->getUsername()) {
            return $this->redirect('app_home');
        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard(' Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Profil', 'fas fa-user-circle', Profil::class);
    }
}
