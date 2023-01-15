<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\LeaveCompany;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LeaveCompanyType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_resignation', DateType::class, [
                'label' => $this->translator->trans('Date output'),
                'widget' => 'single_text',
            ])
            ->add('reason_resignation', TextareaType::class, [
                'attr' => [
                    'minlength' => '2',
                    'rows' => '3',
                    'placeholder' => $this->translator->trans('Reason resignation'),
                ],
                'label' => $this->translator->trans('Reason resignation'),
                'required' => false
            ])
            ->add('employee_out', EntityType::class, [
                "label" => $this->translator->trans('Employee'),
                "attr" => [
                    "class" => "form-control mb-2 select2"
                ],
                "class" => User::class,
                'query_builder' => function (UserRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->orderBy('u.firstname', 'ASC');
                },
                "choice_label" => function (User $user) {
                    return $user->getFullName();
                },
                "placeholder" => $this->translator->trans('Choose...')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LeaveCompany::class,
        ]);
    }
}
