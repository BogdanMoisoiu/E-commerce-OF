<?php

namespace App\Form;

use App\Entity\Product;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('price')
            ->add('type', TextType::class)
            ->add('prod_dimensions', TextType::class)
            ->add('short_description', TextType::class)
            ->add('description', TextType::class)
            ->add('color', TextType::class)
            ->add('power_max', TextType::class)
            ->add('power_source', TextType::class)
            ->add('availability', ChoiceType::class,  [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('quantity_left', IntegerType::class)
            ->add('material', TextType::class)
            ->add('special_features', TextType::class)
            ->add('style', TextType::class)
            ->add('sale', ChoiceType::class,  [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
