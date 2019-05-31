<?php

namespace App\Form;

use App\Entity\Bla;
use App\Entity\Blo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('blas', EntityType::class,  ['required'=>false,'placeholder' => 'Ajouter un attribut',
                // looks for choices from this entity
                'class' => Bla::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'multiple'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blo::class,
        ]);
    }
}
