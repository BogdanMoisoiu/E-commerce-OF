<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['attr' => ['class' => 'form-control m-2']])

            ->add('roles', CollectionType::class, ['entry_type'  => ChoiceType::class, 
            'entry_options' => [
                'choices'  => [
                    "Admin" => 'ROLE_ADMIN',
                    "User" => 'ROLE_USER',
                ],  
            ], 
            'attr' => ['class' => 'form-control m-2'],
            ])


            ->add('plainPassword', PasswordType::class, [ 'label' => 'Password',
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
            ->add('first_name', TextType::class, ['label' => 'First Name',
            'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('last_name', TextType::class, ['label' => 'Last Name',
            'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('date_of_birth', DateType::class, ['label' => 'Date of Birth', 
                'years' => range(date('Y')-100, date('Y')),
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
                    "attr"=>["value"=> null, 'class' => 'form-control m-2'],
                ])
            ->add('phone_number', TextType::class, ['label' => 'Phone Number', 
            'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('city', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('street', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('str_number_ap_number', TextType::class, ['label' => 'House Number/Appartment Number', 
            'attr' => ['class' => 'form-control m-2'],
            ])
            ->add('post_code', TextType::class, [ 'attr' => ['class' => 'form-control m-2']])
            ->add('banned', ChoiceType::class, [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
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
