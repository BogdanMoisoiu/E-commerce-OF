<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\OrderItem;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_time_stamp', DateTime::class)
            // ->add('status')
            ->add('Fk_order_item')
            // ->add('Fk_order_item', EntityType::class [
            //     'class' => OrderItem::class,
            //     'choice_label' => '',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
