<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, array("attr"=>["class"=>"form-control m-2", "placeholder"=>"First Name"]))
            ->add('last_name', TextType::class, array("attr"=>["class"=>"form-control m-2", "placeholder"=>"Last Name"]))
            ->add('email', EmailType::class, array("attr"=>["class"=>"form-control m-2", "placeholder"=>"Email"]))
            ->add('date_of_birth', DateType::class, [
                'years' => range(date('Y')-100, date('Y')),
                'attr' => ['class' => 'form-control m-2'],
                ])
            // ->add('date_of_birth', BirthdayType::class)
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
                'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('phone_number', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('city', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('street', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('str_number_ap_number', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('post_code', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => ['class' => 'form-control m-2'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
