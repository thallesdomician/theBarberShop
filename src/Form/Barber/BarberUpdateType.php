<?php

namespace App\Form\Barber;

use App\Entity\Barber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\User\UserUpdateType;

class BarberUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayName', TextType::class)
            ->add('user', UserUpdateType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Barber::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'barber';
    }
}
