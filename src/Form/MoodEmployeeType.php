<?php

namespace App\Form;

use App\Entity\MoodEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoodEmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateMood')
            ->add('customer_back')
            ->add('actions')
            ->add('note')
            ->add('remark')
            ->add('self_notation')
            ->add('self_remark')
            ->add('novity_note')
            ->add('novity_back')
            ->add('novity_remark')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('customer')
            ->add('employee')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MoodEmployee::class,
        ]);
    }
}
