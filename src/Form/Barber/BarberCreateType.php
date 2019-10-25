<?php

namespace App\Form\Barber;

use App\Entity\Barber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\User\UserCreateType;

class BarberCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', UserCreateType::class)
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
