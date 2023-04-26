<?php

namespace App\Form;

use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('country', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('email', EmailType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('address', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
