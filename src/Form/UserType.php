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
            ->add('email', EmailType::class)

            ->add('roles', CollectionType::class, ['entry_type'  => ChoiceType::class, 
            'entry_options' => [
                'choices'  => [
                    "Admin" => 'ROLE_ADMIN',
                    "User" => 'ROLE_USER',
                ],  
            ], 
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
                        ])
            ->add('first_name', TextType::class, ['label' => 'First Name'])
            ->add('last_name', TextType::class, ['label' => 'Last Name'])
            ->add('date_of_birth', DateType::class, ['label' => 'Date of Birth', 
                'years' => range(date('Y')-100, date('Y'))
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
                ])
            ->add('phone_number', TextType::class, ['label' => 'Phone Number',])
            ->add('city', TextType::class)
            ->add('street', TextType::class)
            ->add('str_number_ap_number', TextType::class, ['label' => 'House Number/Appartment Number'])
            ->add('post_code', TextType::class)
            ->add('banned', ChoiceType::class, [
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
            'data_class' => User::class,
        ]);
    }
}
