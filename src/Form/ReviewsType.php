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
            ]])
            ->add('title', TextType::class)
            ->add('type', ChoiceType::class, ['choices' => [
                'review' => 'review',
                'question' => 'question'
            ]])
            ->add('review', TextType::class)
            ->add('fkAuthor', EntityType::class, [
               'class' => User::class,
               'choice_label' => 'email',
            ]) 
            ->add('fkProduct', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
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
