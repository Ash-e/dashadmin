<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        if($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $imageFile = TextField::new('thumbnailFile')-> setFormType(VichImageType::class);
            $image = ImageField::new('thumbnail')->setBasePath('/images/thumbnails');
            $users = AssociationField::new('user')->hideOnForm(); 
            //echo  $this->getUser();
         
            //if($users == 'user1@user1.com'){
            //   echo "hello";
            //}
            if ($this->isGranted('ROLE_ADMIN') && '...') {    
               
            }
                $fields = [
                    TextField::new('title'),
                    BooleanField::new('enabled'),
                    DateField::new('createdat'),
                    TextField::new('codebar'),
                    NumberField::new('price'),
                    TextField::new('quantity'),
                    // result will filtred
                    //AssociationField::new('user')->hideOnForm(),
                    AssociationField::new('category')->autocomplete(),
                    TextEditorField::new('content'),    
                ];
       
            if ($this->isGranted('ROLE_ADMIN') && '...') {   
               
                $fields[] = $users;
                //var_dump($users);/
               
            }
    
            //echo json_encode($fields);
            //print_r($users);
            //var_dump($fields);
            if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
                $fields[] = $image;
            } else {               
                $fields[] = $imageFile;
            }

            return $fields;
        }

    }

}

/*

[
            TextField::new('title'),
            BooleanField::new('enabled'),
            DateField::new('createdat'),
            TextField::new('codebar'),
            NumberField::new('price'),
            TextField::new('quantity'),
            AssociationField::new('user')->hideOnForm(),
            AssociationField::new('category')->autocomplete(),
            TextEditorField::new('content'),
            TextField::new('thumbnailFile')-> setFormType(VichImageType::class),
            ImageField::new('thumbnail')->setBasePath('/images/thumbnails'),
        
        ]

*/