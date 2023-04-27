<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('price', NumberType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Ceiling Fan' => 'Ceiling Fan',
                    'Floor Fan' => 'Floor Fan',
                    'Table Fan' => 'Table Fan',
                    'Folding Fan' => 'Folding Fan',
                    'Handheld Fan' => 'Handheld Fan',
                ],
                'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('fk_brand', EntityType::class, [
                // looks for choices from this entity
                'class' => Brand::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
                'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('prod_dimensions', ChoiceType::class, [
                'choices' => [
                    '30 cm' => '30 cm',
                    '42 cm' => '42 cm',
                    '50 cm' => '50 cm',
                    '72 cm' => '72 cm',
                    '120 cm' => '120 cm',
                    '125 cm' => '125 cm',
                ],
                'attr' => ['class' => 'form-control m-2'],
                ]
                )
            ->add('short_description', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('description', TextareaType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'Dark Bronze' => 'Dark Bronze',
                    'Brushed Nickel' => 'Brushed Nickel',
                    'Matte Black' => 'Matte Black',
                    'Gloss White' => 'Gloss White',
                ], 
                'attr' => ['class' => 'form-control m-2'],
                ])
            ->add('power_max', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('power_source', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('availability', ChoiceType::class,  [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
                'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('approved', ChoiceType::class,  [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
                'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('quantity_left', IntegerType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('material', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('special_features', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('style', TextType::class, ['attr' => ['class' => 'form-control m-2']])
            ->add('discount', ChoiceType::class,  [
                'choices'  => [
                    'No discount' => '0',
                    '5%' => '0.05',
                    '10%' => '0.10',
                    '15%' => '0.15',
                    '20%' => '0.20',
                    '25%' => '0.25',
                    '30%' => '0.30',
                    '35%' => '0.35',
                    '40%' => '0.40',
                    '45%' => '0.45',
                    '50%' => '0.50',
                ],
                'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('picture', FileType::class, [
                'label' => 'Upload Picture',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
                'attr' => ['class' => 'form-control m-2']
                
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
