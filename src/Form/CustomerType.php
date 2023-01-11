<?php

namespace App\Form;

use App\Entity\BusinessSector;
use App\Entity\User;
use App\Entity\Customer;
use App\Entity\StackTechLanguage;
use App\Entity\TypeActivity;
use App\Repository\StackTechLanguageRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_company', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '250',
                ],
                'label' => 'Nom du client',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('size_company', TextType::class, [
                'attr' => [
                    'minlength' => '1',
                    'maxlength' => '250'
                ],
                'label' => 'Taille',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('location', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '250'
                ],
                'label' => 'Localisation',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('team_structure', TextareaType::class, [
                'attr' => [
                    'minlength' => '2'
                ],
                'label' => 'Structure de l\'equipe',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 550]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('listStack', EntityType::class, [
                'class' => StackTechLanguage::class,
                'label' => 'Stack technique',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'name_language',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('day_off', TextType::class, [
                'label' => 'Jours fériés',
                'required' => false,
            ])
            ->add('cra', TextType::class, [
                'label' => 'CRA',
                'required' => false,
            ])
            ->add('work_time', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '250'
                ],
                'label' => 'Horaire',
                'required' => false,
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('annual_closure', TextType::class, [
                'label' => 'Fermeture annuelle',
                'required' => false,
            ])
            ->add('important_criteria', TextType::class, [
                'label' => 'Critères importants pour le client',
                'required' => false,
            ])
            ->add('notes', TextareaType::class, [
                'label' => 'Notes',
                'required' => false,
            ])
            ->add('pc_specification', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '250'
                ],
                'label' => 'Spécifications techniques PC',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('contacts', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '250'
                ],
                'label' => 'Contact(s)',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('typeActivity', EntityType::class, [
                "label" => "Type d'activité",
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => TypeActivity::class,
                "choice_label" => 'name_activity',
                "placeholder" => "Choisissez..."
            ])
            ->add('businessSector', EntityType::class, [
                "label" => "Secteur d'activité",
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => BusinessSector::class,
                "choice_label" => 'name_sector',
                "placeholder" => "Choisissez..."
            ])
            ->add('unitManager', EntityType::class, [
                "label" => "Unit Manager",
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => User::class,
                'query_builder' => function (UserRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->andWhere('u.job = :value')
                        ->setParameter('value', 'UM')
                        ->orderBy('u.firstname', 'ASC');
                },
                "choice_label" => function (User $user) {
                    return $user->getFullName();
                },
                "placeholder" => "Choisissez..."
            ])
            ->add('businessManager', EntityType::class, [
                "label" => "Business Manager",
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => User::class,
                'query_builder' => function (UserRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->andWhere('u.job = :value')
                        ->setParameter('value', 'BM')
                        ->orderBy('u.firstname', 'ASC');
                },
                "choice_label" => function (User $user) {
                    return $user->getFullName();
                },
                "placeholder" => "Choisissez..."
            ])
            ->add('dateCollaboration', DateType::class, [
                'label' => 'Début collaboration',
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
