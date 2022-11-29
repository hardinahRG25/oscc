<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Mission;
use App\Entity\Customer;
use App\Entity\CustomerCare;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class CustomerCareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateShare', null, [
                'label' => 'Date d\'évaluation',
                'widget' => 'single_text',
            ])
            ->add('noteCollaboration', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '5',
                    'placeholder' => 'Notes',
                    'class' => 'form-control'
                ],
                'label' => 'Notes collaboration',
                'required' => false,
            ])
            ->add('cust_relationship_info', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '4',
                    'class' => 'form-control'
                ],
                'label' => 'Relation client',
                'required' => false,
            ])
            ->add('cust_relationship_note', NumberType::class, [
                'attr' => [],
                'required' => false,
            ])
            ->add('business_info', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '4',
                    'class' => 'form-control'
                ],
                'label' => 'Business / Projets',
                'required' => false,
            ])
            ->add('business_note')
            ->add('cust_back_info', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '4',
                    'class' => 'form-control'
                ],
                'label' => 'Retours client',
                'required' => false,
            ])
            ->add('cust_back_note')
            ->add('employee_back_info', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '4',
                    'class' => 'form-control'
                ],
                'label' => 'Retours collaborateurs',
                'required' => false,
            ])
            ->add('employee_back_note')
            ->add('average_note', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '4',
                    'class' => 'form-control'
                ],
                'label' => 'Note',
                'required' => false,
            ])
            ->add('customer', EntityType::class, [
                "label" => "Client",
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => Customer::class,
                "choice_label" => 'name_company',
                "placeholder" => "Choisissez..."
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerCare::class,
        ]);
    }
}
