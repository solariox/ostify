<?php

namespace App\Controller\Admin;

use App\Entity\Streak;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StreakCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Streak::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('score'),
            AssociationField::new('streaker'),
        ];
    }
}
