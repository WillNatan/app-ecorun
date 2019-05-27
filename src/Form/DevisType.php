<?php

namespace App\Form;

use App\Entity\Customers;
use App\Entity\Devis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modeReglement')
            ->add('numDevis')
            ->add('dateCrea')
            ->add('dateValid')
            ->add('customer', EntityType::class, [
                // looks for choices from this entity
                'class' => Customers::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
