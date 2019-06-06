<?php

namespace App\Form;

use App\Entity\Societe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo', FileType::class, ['data_class'=>null,  'required'=>false,'label' => 'Logo de la société', 'attr'=>['class'=>'form-control']])
            ->add('nom', TextType::class, ['label'=>'Nom de la société', 'attr'=>['class'=>'form-control']])
            ->add('adresse', TextareaType::class, ['label'=>'Adresse', 'attr'=>['class'=>'form-control']])
            ->add('tel', TextType::class, ['label'=>'Numéro de téléphone', 'attr'=>['class'=>'form-control']])
            ->add('fax', TextType::class, ['label'=>'FAX', 'attr'=>['class'=>'form-control']])
            ->add('siteWeb',TextType::class, ['label'=>'Lien du site web', 'attr'=>['class'=>'form-control']])
            ->add('email',EmailType::class, ['label'=>'Adresse Email', 'attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
