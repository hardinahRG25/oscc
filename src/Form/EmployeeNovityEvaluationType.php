<?php

namespace App\Form;

use App\Entity\EmployeeNovityEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeNovityEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('integration')
            ->add('model')
            ->add('communication')
            ->add('professionnal')
            ->add('excellence')
            ->add('audacity')
            ->add('humanity')
            ->add('examiner')
            ->add('notes')
            ->add('date_creation_info')
            ->add('employee')
            ->add('customer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeNovityEvaluation::class,
        ]);
    }
}
