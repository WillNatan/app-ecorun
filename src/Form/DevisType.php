<?php

namespace App\Form;

use App\Entity\Customers;
use App\Entity\Devis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modeReglement', TextType::class, ['label'=>'Mode de règlement','attr'=>['class'=>'form-control']])
            ->add('numDevis', TextType::class, ['label'=>'Numéro de devis','disabled'=>true, 'attr'=>['class'=>'form-control']])
            ->add('productForms',CollectionType::class, ['label'=>'Produits','attr'=>['class'=>'form-control'],
        'entry_type' => ProductFormType::class,

        'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
