<?php

namespace App\Form;

use App\Entity\EmployeeMissionEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeMissionEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('technical_skills')
            ->add('productivity')
            ->add('rigour')
            ->add('autonomy')
            ->add('communication')
            ->add('reactivity')
            ->add('disponibility')
            ->add('involvement')
            ->add('proactive')
            ->add('initiative')
            ->add('teamwork')
            ->add('versality')
            ->add('notes')
            ->add('date_create_info')
            ->add('examiner')
            ->add('employee')
            ->add('customer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeMissionEvaluation::class,
        ]);
    }
}
