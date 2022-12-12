<?php

namespace App\Form;

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

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('imageFile', VichImageType::class, [
				'label' => 'Photo de profil',
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
				'label' => 'Nom'
			])
			->add('lastname', TextType::class, [
				'attr' => [
					'minlength' => '2',
					'maxlength' => '150',
				],
				'label' => 'Prénom'
			])
			->add('email', EmailType::class)
			->add('password', RepeatedType::class, [
				'type' => PasswordType::class,
				'first_options' => [
					'attr' => [
						'class' => 'form-control'
					],
					'label' => 'Mot de passe'
				],
				'second_options' => [
					'attr' => [
						'class' => 'form-control'
					],
					'label' => 'Confirmation du mot de passe'
				],
				'invalid_message' => 'Les mots de passe ne correspondent pas.'
			])
			->add('date_entry', DateType::class, [
				'label' => 'Date d\'entrée',
				'widget' => 'single_text',
			])
			->add('country', TextType::class, [
				'label' => 'Pays'
			])
			->add('city', TextType::class, [
				'label' => 'Ville',
				'required' => false
			])
			->add('district', TextType::class, [
				'label' => 'Quartier',
				'required' => false
			])
			->add('qualification')
			->add('contract_type', ChoiceType::class, [
				'label' => 'Type de contrat',
				"placeholder" => "Choisissez...",
				'choices' => [
					'Salarié' => 'SALARIE',
					'Indépendant' => 'INDEPENDANT'
				],
			])
			->add('manager', EntityType::class, [
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
			->add('birth_date', DateType::class, [
				'label' => 'Date de naissance',
				'widget' => 'single_text',
			])
			->add('matrimonial_status', ChoiceType::class, [
				'label' => 'Situation matrimoniale',
				"placeholder" => "Choisissez...",
				'choices' => [
					'Célibataire' => 'CELIBATAIRE',
					'Marié(e)' => 'MARIE(E)'
				],
			])
			->add('gender', ChoiceType::class, [
				'label' => 'Genre',
				"placeholder" => "Choisissez...",
				'choices' => [
					'Masculin' => 'm',
					'Féminin' => 'f'
				],
			])
			->add('childNumber', IntegerType::class, [
				'attr' => [
					'min' => 0,
					'max' => 10
				],
				'required' => false,
				'label' => 'Nombre d\'enfant',
				'constraints' => [
					new Assert\LessThan(10)
				]
			])
			->add('location', ChoiceType::class, [
				'label' => 'Pays de localisation',
				"placeholder" => "Choisissez...",
				'choices' => [
					'MADAGASCAR' => 'MADAGASCAR',
					'MAURICE' => 'MAURICE'
				],
			])
			->add('address', TextType::class, [
				'label' => 'Adresse'
			])
			->add('contacts', TextType::class, [
				'label' => 'Télephone principale'
			])
			->add('contactSecondary', TextType::class, [
				'label' => 'Télephone secondaire',
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
				"placeholder" => "Choisissez...",
				'choices' => [
					'DEBUTANT' => 'DEBUTANT',
					'MOYEN' => 'MOYEN',
					'AVANCE' => 'AVANCE',
					'EXCELLENT' => 'EXCELLENT',
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
