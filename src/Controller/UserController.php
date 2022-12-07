<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\Conversion;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use App\Repository\UserRepository;
use Omines\DataTablesBundle\DataTableState;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Column\TwigColumn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Column\NumberColumn;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;

#[Route('/collaborateur')]
class UserController extends AbstractController
{
	public function __construct(Conversion $conversion)
	{
		$this->convert = $conversion;
	}
	#[Route('/', name: 'app_user_index', methods: ['POST', 'GET'])]
	public function index(UserRepository $userRepository, Request $request, DataTableFactory $dataTableFactory): Response
	{
		$table = $dataTableFactory->create()
			->add('id', NumberColumn::class, ['visible' => false])
			->add('fullName', TextColumn::class, [
				'label' => 'Nom et Prénom(s)',
				'propertyPath' => '[fullName]',
				'searchable' => false,
				'orderable' => true,
				'globalSearchable' => false
			])
			->add('birth_date', DateTimeColumn::class, [
				'label' => 'Date de naissance',
				'format' => 'd-m-Y',
				'searchable' => false,
			])
			->add('gender', TextColumn::class, [
				'label' => 'Genre',
				'render' => function ($value, $context) {
					return $this->convert->genderString($value);
				}
			])
			->add('date_entry', DateTimeColumn::class, [
				'label' => 'Date d\'intégration',
				'format' => 'd-m-Y',
				'searchable' => false,
			])
			->add('monthsCount', TextColumn::class, [
				'label' => 'Ancienneté',
				'propertyPath' => '[monthsCount]',
				'render' => function ($value, $context) {
					return $this->convert->conversionMonthYear($value);
				}
			])
			->add('matrimonial_status', TextColumn::class, [
				'label' => 'Situation familiale',
				'visible' => false
			])
			->add('family', TextColumn::class, [
				'label' => 'Situation familiale',
				'propertyPath' => '[family]',
				'searchable' => false,
				'orderable' => false,
				'globalSearchable' => false
			])
			->add('district', TextColumn::class, [
				'label' => 'Adresse'
			])
			->add('contacts', TextColumn::class, [
				'label' => 'Télephone'
			])
			->add('location', TextColumn::class, [
				'label' => 'Pays de localisation'
			])
			->add('original_company', TextColumn::class, [
				'label' => 'Société d\'origine'
			])
			->add('contract_type', TextColumn::class, [
				'label' => 'Type de contrat'
			])
			->add('buttons', TwigColumn::class, [
				'label' => 'Actions',
				'template' => 'user/datatable/buttonbar.html.twig'
			])
			->createAdapter(ORMAdapter::class, [
				'entity' => User::class,
				'hydrate' => AbstractQuery::HYDRATE_ARRAY,
				'query' => function (QueryBuilder $builder) {
					$builder
						->select("
							u.id,
							CONCAT(u.lastname, ' ', u.firstname) AS fullName,
							u.birth_date,
							u.gender,
							u.date_entry,
							u.matrimonial_status,
							CONCAT(u.matrimonial_status, ', ', u.childNumber) AS family,
							TIMESTAMPDIFF(MONTH, u.date_entry, CURRENT_TIMESTAMP()) AS monthsCount,
							u.location,
							u.district,
							u.original_company,
							u.contacts,
							u.contract_type")
						->from(User::class, 'u');
				}
			])
			->handleRequest($request);

		if ($table->isCallback()) {
			return $table->getResponse();
		}

		return $this->render(
			'user/index.html.twig',
			['datatable' => $table]
		);
	}

	#[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
	public function new(Request $request, UserRepository $userRepository): Response
	{
		$user = new User();
		$form = $this->createForm(UserType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$userRepository->add($user, true);

			return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
		}

		return $this->renderForm('user/new.html.twig', [
			'user' => $user,
			'form' => $form,
		]);
	}

	#[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
	public function show(User $user): Response
	{
		return $this->render('user/show.html.twig', [
			'user' => $user,
		]);
	}

	#[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, User $user, UserRepository $userRepository): Response
	{
		$form = $this->createForm(UserType::class, $user);
		$form->remove('password');
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$userRepository->add($user, true);

			return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
		}

		return $this->renderForm('user/edit.html.twig', [
			'user' => $user,
			'form' => $form,
		]);
	}

	#[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
	public function delete(Request $request, User $user, UserRepository $userRepository): Response
	{
		if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
			$userRepository->remove($user, true);
		}

		return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
	}
}
