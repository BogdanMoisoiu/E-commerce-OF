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

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('price')
            ->add('type', TextType::class)
            ->add('fk_brand', EntityType::class, [
                // looks for choices from this entity
                'class' => Brand::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('prod_dimensions', TextType::class, ["attr"=>["value"=> null]])
            ->add('short_description', TextType::class)
            ->add('description', TextType::class)
            ->add('color', TextType::class, ["attr"=>["value"=> null]])
            ->add('power_max', TextType::class, ["attr"=>["value"=> null]])
            ->add('power_source', TextType::class, ["attr"=>["value"=> null]])
            ->add('availability', ChoiceType::class,  [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('quantity_left', IntegerType::class)
            ->add('material', TextType::class)
            ->add('special_features', TextType::class, ["attr"=>["value"=> null]])
            ->add('style', TextType::class, ["attr"=>["value"=> null]])
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
                "attr"=>["value"=> null],
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
                "attr"=>["value"=> null],
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
