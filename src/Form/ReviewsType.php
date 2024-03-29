<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Reviews;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', ChoiceType::class, ['choices'=>[
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5'
            ], 
            'attr' => ['class' => 'form-control m-2'],
            'required' => false,])
            ->add('title', TextType::class, ['required' => false,
            'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('type', ChoiceType::class, ['choices' => [
                'review' => 'review',
                'question' => 'question',
                'answer' => 'answer',
            ],
            'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('review', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('fkAuthor', EntityType::class, [
               'class' => User::class,
               'choice_label' => 'email',
               'attr' => ['class' => 'form-control m-2'],
            ]) 
            ->add('fkProduct', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control m-2'],
            ] ) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
