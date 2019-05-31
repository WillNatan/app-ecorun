<?php

namespace App\Form;

use App\Entity\Attributes;
use App\Entity\Devis;
use App\Entity\ProductForm;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class,  ['required'=>false,'placeholder' => 'Ajouter un produit',
                // looks for choices from this entity
                'class' => Products::class,
                'group_by'=> function(Products $products){
                    return $products->getCategory()->getName();
                },
                // uses the User.username property as the visible option string
                'choice_label' => 'name'])
            ->add('height')
            ->add('width')
            ->add('attributes', EntityType::class,  ['required'=>false,'placeholder' => 'Ajouter un attribut',
                // looks for choices from this entity
                'class' => Attributes::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'multiple'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductForm::class,
        ]);
    }
}
