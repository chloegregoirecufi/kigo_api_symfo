<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competence::class;
    }

   public function configureCrud(Crud $crud): Crud
   {
    //permet de renommer les différentes page
    return $crud
        ->setPageTitle(Crud::PAGE_INDEX, 'Compétences')
        ->setPageTitle(Crud::PAGE_EDIT, 'Modifier les compétences')
        ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une nouvelle compétence');
   }

   public function configureFields(string $pageName): iterable
   {
        //permet de reféfinir le formulaire 
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
        ];
   }

   public function configureActions(Actions $actions): Actions
   {
    //permet de configurer les différentes actions
    return $actions
        //permet de customiser les champs de la page index
        ->update(Crud::PAGE_INDEX, Action::NEW,
            fn(Action $action) => $action->setIcon('fa fa-add')->setLabel('Ajouter')->setCssClass('btn btn-success'))
        ->update(Crud::PAGE_INDEX, Action::EDIT,
            fn(Action $action) => $action->setIcon('fa fa-pen')->setLabel('Modifier'))
        ->update(Crud::PAGE_INDEX, Action::DELETE,
            fn(Action $action) => $action->setIcon('fa fa-trash')->setLabel('Supprimer'))
        
        //page edition
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN,
            fn(Action $action) => $action->setLabel('Enregistrer et quitter'))
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE,
            fn(Action $action) => $action->setLabel('Enregistrer et continer'))
        
        //page création 
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN,
            fn(Action $action) => $action->setLabel('Enregistrer'))
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER,
            fn(Action $action) => $action->setLabel('Enregistrer et ajouter un nouveau'));
   }
}
