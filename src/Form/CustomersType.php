<?php

namespace App\Form;

use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom de la société','attr'=>['class'=>'form-control']])
            ->add('address', TextareaType::class, ['label'=>'Adresse','attr'=>['class'=>'form-control']])
            ->add('tel', TextType::class, ['label'=>'Numéro de téléphone','attr'=>['class'=>'form-control']])
            ->add('email', EmailType::class, ['label'=>'Adresse Email','attr'=>['class'=>'form-control']])
            ->add('postalcode', TextType::class, ['label'=>'Code postal','attr'=>['class'=>'form-control']])
            ->add('city', TextType::class, ['label'=>'Ville','attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customers::class,
        ]);
    }
}
