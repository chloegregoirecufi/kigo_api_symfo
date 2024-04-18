<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use App\Entity\Contact;
use App\Entity\Filiere;
use App\Entity\Media;
use App\Entity\Message;
use App\Entity\Post;
use App\Entity\Projet;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(CompetenceCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/images/logo.png" style="width:100px; height:80px">')
            ->setFaviconPath('/images/logo.png');
    }

    public function configureMenuItems(): iterable
    {
        //Section principale
        yield MenuItem::section("Gestion de l'application");

        //Liste des sous-menu
        yield MenuItem::subMenu('Gestion compétences', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter une compétence', 'fa fa-plus', Competence::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les compétences', 'fa fa-eye', Competence::class)
        ]);
        yield MenuItem::subMenu('Gestion des contacts', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un contact', 'fa fa-plus', Contact::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les contacts', 'fa fa-eye', Contact::class)
        ]);
        yield MenuItem::subMenu('Gestion des médias', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un média', 'fa fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les médias', 'fa fa-eye', Media::class)
        ]);
        yield MenuItem::subMenu('Gestion des messages', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un message', 'fa fa-plus', Message::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les messages', 'fa fa-eye', Message::class)
        ]);
        yield MenuItem::subMenu('Gestion des posts', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un post', 'fa fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les posts', 'fa fa-eye', Post::class)
        ]);
        yield MenuItem::subMenu('Gestion des projets', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un projets', 'fa fa-plus', Projet::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les projets', 'fa fa-eye', Projet::class)
        ]);
        yield MenuItem::subMenu('Gestion des types', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un type', 'fa fa-plus', Type::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les types', 'fa fa-eye', Type::class)
        ]);
        yield MenuItem::subMenu('Gestion des users', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter un user', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les user', 'fa fa-eye', User::class)
        ]);
        yield MenuItem::subMenu('Gestion des filieres', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter une filiere', 'fa fa-plus', Filiere::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les filieres', 'fa fa-eye', Filiere::class)
        ]);
    }

}

