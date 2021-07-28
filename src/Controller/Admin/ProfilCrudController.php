<?php

namespace App\Controller\Admin;

use App\Entity\Profil;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profil::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Titre'),
            TextEditorField::new('description'),
            TextEditorField::new('NiveauEtude'),
            TextField::new('Link'),
            ImageField::new('image')->setBasePath('Uploads/image/')
                ->OnlyOnIndex(),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->setTranslationParameters(['form.label.delete' => 'Delete'])
                ->HideOnIndex(),
        ];
    }
}
