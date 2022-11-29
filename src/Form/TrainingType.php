<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objective', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150',
                ],
                'label' => 'Objectif',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('training', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150',
                ],
                'label' => 'Formation',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '5',
                    'placeholder' => 'Description',
                    'class' => 'form-control'
                ],
                'label' => 'Raison de fin de mission',
                'required' => true,
            ])
            ->add('source', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150',
                ],
                'label' => 'Source',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('progress', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150',
                ],
                'label' => 'Progression',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('note', TextareaType::class, [
                'attr' => [
                    'rows' => '5',
                    'class' => 'form-control',
                ],
                'label' => 'Remarque(s)',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
