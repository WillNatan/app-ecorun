<?php

namespace App\Form;

use App\Entity\Attributes;
use App\Entity\Devis;
use App\Entity\Frais;
use App\Entity\ProductForm;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class,  ['label'=>'Nom du produit','attr'=>['class'=>'form-control'],'required'=>false,'placeholder' => 'Ajouter un produit',
                // looks for choices from this entity
                'class' => Products::class,
                'group_by'=> function(Products $products){
                    return $products->getCategory()->getName();
                },
                // uses the User.username property as the visible option string
                'choice_label' => 'name'])
            ->add('height', NumberType::class, ['label'=>'Hauteur','attr'=>['class'=>'form-control']])
            ->add('width', NumberType::class, ['label'=>'Largeur','attr'=>['class'=>'form-control']])
            ->add('qte', IntegerType::class, ['label'=>'Quantité','attr'=>['class'=>'form-control']])
            ->add('attributes', EntityType::class,  ['label'=>'Attributs','attr'=>['class'=>'form-control'],'required'=>false,'placeholder' => 'Ajouter un attribut',
                // looks for choices from this entity
                'class' => Attributes::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'multiple'=>true])
            ->add('heureFraisPose', IntegerType::class, ['label'=>'Heures de frais de pose','attr'=>['class'=>'form-control']])
            ->add('heureFraisMaquette', IntegerType::class, ['label'=>'Heures de frais de maquette','attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductForm::class,
        ]);
    }
}
