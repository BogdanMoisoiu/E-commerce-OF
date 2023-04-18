<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('type')
            ->add('prod_dimensions')
            ->add('short_description')
            ->add('description')
            ->add('color')
            ->add('power_max')
            ->add('power_source')
            ->add('availability')
            ->add('quantity_left')
            ->add('material')
            ->add('special_features')
            ->add('style')
            ->add('sale')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
