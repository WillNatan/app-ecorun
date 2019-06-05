<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Products;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom du produit','attr'=>['class'=>'form-control']])
            ->add('price', NumberType::class, ['label'=>'Prix (cm²)','attr'=>['class'=>'form-control']])
            ->add('category', EntityType::class,  ['label'=>'Catégorie','attr'=>['class'=>'form-control'],'placeholder' => 'Catégorie',
                // looks for choices from this entity
                'class' => Categories::class,
                'query_builder' => function (CategoriesRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.parent = :parent')
                    ->setParameter('parent', !null);
                },
                // uses the User.username property as the visible option string
                'choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
