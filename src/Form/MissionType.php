<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Mission;
use App\Entity\Customer;
use App\Entity\StackTechLanguage;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MissionType extends AbstractType
{

    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150',
                ],
                'label' => 'Poste',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('date_start', DateType::class, [
                'label' => 'Début mission',
                'widget' => 'single_text',
            ])
            ->add('date_end', DateType::class, [
                'label' => 'Fin mission',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('mission_type', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150',
                ],
                'label' => 'Type de mission',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('reason_contract_end', TextareaType::class, [
                'attr' => [
                    'spellcheck' => 'false',
                    'rows' => '5',
                    'placeholder' => 'Raison de fin de mission',
                    'class' => 'form-control'
                ],
                'label' => 'Raison de fin de mission',
                'required' => false,
            ])
            ->add('techPrincipal', EntityType::class, [
                'class' => StackTechLanguage::class,
                'label' => 'Stack technique',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'name_language',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                "placeholder" => "Choisissez...",
                'choices' => [
                    'ENCOURS' => 'ENCOURS',
                    'EN ATTENTE' => 'EN ATTENTE',
                    'TERMINE' => 'TERMINE',
                ],

            ])
            ->add('employee', EntityType::class, [
                "label" => $this->translator->trans('Employee'),
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => User::class,
                'query_builder' => function (UserRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->andWhere('u.job <> :value')
                        ->setParameter('value', 'UM')
                        ->andWhere('u.job <> :value')
                        ->setParameter('value', 'BM')
                        ->orderBy('u.firstname', 'ASC');
                },
                "choice_label" => function (User $user) {
                    return $user->getFullName();
                },
                "placeholder" => "Choisissez..."
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
            'data_class' => Mission::class,
        ]);
    }
}
