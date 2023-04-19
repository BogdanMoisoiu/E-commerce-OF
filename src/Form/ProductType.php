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
            ->add('picture', FileType::class, [
                'label' => 'Upload Picture',
 //unmapped means that is not associated to any entity property
                'mapped' => false,
 //not mandatory to have a file
                'required' => false,
 
 //in the associated entity, so you can use the PHP constraint classes as validators
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
