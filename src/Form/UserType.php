<?php

namespace App\Form;

use App\Entity\University;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserType extends AbstractType
{

	private $translator;

	public function __construct(TranslatorInterface $translator)
	{
		$this->translator = $translator;
	}
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('imageFile', VichImageType::class, [
				'label' => $this->translator->trans('Profil picture'),
				'label_attr' => [
					'class' => 'form-label mt-4'
				],
				'required' => false
			])
			->add('firstname', TextType::class, [
				'attr' => [
					'minlength' => '2',
					'maxlength' => '150',
				],
				'label' => $this->translator->trans('Firstname')
			])
			->add('lastname', TextType::class, [
				'attr' => [
					'minlength' => '2',
					'maxlength' => '150',
				],
				'label' => $this->translator->trans('Lastname')
			])
			->add('email', EmailType::class)
			->add('password', RepeatedType::class, [
				'type' => PasswordType::class,
				'first_options' => [
					'attr' => [
						'class' => 'form-control'
					],
					'label' => $this->translator->trans('Password'),
					'error_bubbling' => true
				],
				'second_options' => [
					'attr' => [
						'class' => 'form-control'
					],
					'label' => $this->translator->trans('Password confirm')
				],
				'invalid_message' => $this->translator->trans('The passwords do not match.') //'Les mots de passe ne correspondent pas.'
			])
			->add('date_entry', DateType::class, [
				'label' => 'Date d\'entrée',
				'widget' => 'single_text',
			])
			->add('country', TextType::class, [
				'label' => $this->translator->trans('Country')
			])
			->add('city', TextType::class, [
				'label' => $this->translator->trans('City'),
				'required' => false
			])
			->add('district', TextType::class, [
				'label' => $this->translator->trans('District'),
				'required' => false
			])
			->add('qualification')
			->add('contract_type', ChoiceType::class, [
				'label' => $this->translator->trans('Contract type'),
				"placeholder" => $this->translator->trans('Choose...'),
				'choices' => [
					$this->translator->trans('Worker') => 'SALARIE',
					$this->translator->trans('Independant') => 'INDEPENDANT'
				],
			])
			->add('manager', EntityType::class, [
				"label" => $this->translator->trans('Unit manager'),
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
				"placeholder" => $this->translator->trans('Choose...')
			])
			->add('birth_date', DateType::class, [
				'label' => $this->translator->trans('Birthday'),
				'widget' => 'single_text',
			])
			->add('matrimonial_status', ChoiceType::class, [
				'label' => $this->translator->trans('Marital status'),
				"placeholder" => $this->translator->trans('Choose...'),
				'choices' => [
					$this->translator->trans('Celibataire') => 'CELIBATAIRE',
					$this->translator->trans('Married') => 'MARIE(E)'
				],
			])
			->add('gender', ChoiceType::class, [
				'label' => $this->translator->trans('Gender'),
				"placeholder" => $this->translator->trans('Choose...'),
				'choices' => [
					$this->translator->trans('Male') => 'm',
					$this->translator->trans('Female') => 'f'
				],
			])
			->add('universityHome', EntityType::class, [
				'class' => University::class,
				'label' => $this->translator->trans('home university'),
				'label_attr' => [
					'class' => 'form-label mt-4'
				],
				'choice_label' => 'nameUniversity',
				'multiple' => true,
				'expanded' => true,
			])
			->add('childNumber', IntegerType::class, [
				'attr' => [
					'min' => 0,
					'max' => 10
				],
				'required' => false,
				'label' => $this->translator->trans('Child number'),
				'constraints' => [
					new Assert\LessThan(10)
				]
			])
			->add('location', ChoiceType::class, [
				'label' => $this->translator->trans('Country location'),
				"placeholder" => $this->translator->trans('Choose...'),
				'choices' => [
					'MADAGASCAR' => 'MADAGASCAR',
					'MAURICE' => 'MAURICE'
				],
			])
			->add('address', TextType::class, [
				'label' => $this->translator->trans('Adress')
			])
			->add('contacts', TextType::class, [
				'label' => $this->translator->trans('Phone principal')
			])
			->add('contactSecondary', TextType::class, [
				'label' => $this->translator->trans('Phone secondary'),
				'required' => false
			])
			->add('tech_dominant_cv', TextType::class, [
				'label' => 'Techno dominant (selon le CV)'
			])
			->add('tech_master', TextType::class, [
				'label' => 'Techno(s) maîtrisée(s)'
			])
			->add('tech_active', TextType::class, [
				'label' => 'Techno(s) active(s)'
			])
			->add('tech_others', TextType::class, [
				'label' => 'Autres technos',
				'required' => false,
			])
			->add('other_skills', TextType::class, [
				'label' => 'Autres qualifications',
				'required' => false,
			])
			->add('skills_evolution', TextType::class, [
				'label' => 'Evolution des compétences',
				'required' => false,
			])
			->add('english_level', ChoiceType::class, [
				'label' => 'Niveau Anglais',
				"placeholder" => $this->translator->trans('Choose...'),
				'choices' => [
					'DEBUTANT' => 'DEBUTANT',
					'MOYEN' => 'MOYEN',
					'AVANCE' => 'AVANCE',
				],
			])
			->add('cv_observations', TextareaType::class, [
				'attr' => [
					'spellcheck' => 'false',
					'rows' => '5',
					'placeholder' => 'Remarque suivant CV',
					'class' => 'form-control',
					'maxlength' => 250
				],
				'label' => 'Remarque suivant CV',
				'required' => false,
			])
			->add('risk_anticipation', TextareaType::class, [
				'attr' => [
					'spellcheck' => 'false',
					'rows' => '5',
					'placeholder' => 'Risque/Anticipation',
					'class' => 'form-control',
					'maxlength' => 250
				],
				'label' => 'Risque/Anticipation',
				'required' => false,
			])
			->add('notes', TextareaType::class, [
				'attr' => [
					'spellcheck' => 'false',
					'rows' => '5',
					'placeholder' => 'Notes',
					'class' => 'form-control',
					'maxlength' => 250
				],
				'label' => 'Notes',
				'required' => false,
			])
			->add('perspective', TextareaType::class, [
				'attr' => [
					'spellcheck' => 'false',
					'rows' => '5',
					'placeholder' => 'Perspectives',
					'class' => 'form-control',
					'maxlength' => 250
				],
				'label' => 'Perspectives',
				'required' => false,
			])
			->add('original_company', TextType::class, [
				'label' => 'Société d\'origine'
			]);
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'data_class' => User::class,
		]);
	}
}
