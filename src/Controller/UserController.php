<?php

namespace App\Controller;

use Carbon\Carbon;
use App\Entity\User;
use App\Form\UserType;
use App\Service\Conversion;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use App\Repository\UserRepository;
use App\Repository\MissionRepository;
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
	/**
	 * Constructor
	 *
	 * @param Conversion $conversion
	 */

	private $convert;
	private $statusClassColor;

	public function __construct()
	{
	}

	/**
	 * Index page
	 *
	 * @param UserRepository $userRepository
	 * @param Request $request
	 * @param DataTableFactory $dataTableFactory
	 * @return Response array list
	 */


	#[Route('/list', name: 'app_user_list', methods: ['POST', 'GET'])]
	public function index(UserRepository $userRepository, Request $request, DataTableFactory $dataTableFactory, Conversion $conversion): Response
	{

		// $conversion = $this->container->get('oscc.conversion');
		$this->convert = $conversion;
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
			->add('email', TextColumn::class, [
				'label' => 'Email'
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
							CONCAT(u.lastname, ' ', UPPER(u.firstname)) AS fullName,
							u.birth_date,
							u.gender,
							u.date_entry,
							u.email,
							u.matrimonial_status,
							CONCAT(u.matrimonial_status, ', ', u.childNumber) AS family,
							TIMESTAMPDIFF(MONTH, u.date_entry, CURRENT_TIMESTAMP()) AS monthsCount,
							u.location,
							u.district,
							u.original_company,
							u.contacts,
							u.contract_type")
						->from(User::class, 'u')
						->orderBy('u.firstname,u.lastname,u.id', 'ASC')
						->addOrderBy('u.job', 'ASC');
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

	/**
	 * add new
	 *
	 * @param Request $request
	 * @param UserRepository $userRepository
	 * @return Response
	 */
	#[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
	public function new(Request $request, UserRepository $userRepository): Response
	{
		$user = new User();
		$form = $this->createForm(UserType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$userRepository->add($user, true);

			return  $this->redirectToRoute('app_user_list', [], Response::HTTP_SEE_OTHER);
		}

		return $this->renderForm('user/new.html.twig', [
			'user' => $user,
			'form' => $form,
			'missions' => []
		]);
	}

	/**
	 * 
	 */
	#[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
	public function show(User $user): Response
	{
		return $this->render('user/show.html.twig', [
			'user' => $user,
		]);
	}

	/**
	 * edit user
	 * @param Request $request
	 * @param UserRepository $userRepository
	 * @return Response
	 */
	#[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, User $user, UserRepository $userRepository, MissionRepository $missionRepository): Response
	{

		$listMissions = $missionRepository->findMissionUserSelected(intval($request->get('id')));
		// Carbon::setFallBackLocale('fr');
		for ($i = 0; $i < count($listMissions); $i++) {
			$listMissions[$i]['status'] = 'TERMINE';
			$date = new Carbon($listMissions[$i]['date_start']);
			$now = Carbon::now();
			$diffDate = $date->locale('fr')->diffForHumans($now);
			$listMissions[$i]['duration'] = $diffDate;
			if (empty($listMissions[$i]['date_end']) || $listMissions[$i]['date_end'] == null) {
				$listMissions[$i]['status'] = 'EN COURS';
			}
		}
		$form = $this->createForm(UserType::class, $user);
		$form->remove('password');
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$userRepository->add($user, true);

			return $this->redirectToRoute('app_user_list', [], Response::HTTP_SEE_OTHER);
		}

		return $this->renderForm('user/edit.html.twig', [
			'user' => $user,
			'form' => $form,
			'missions' => $listMissions
		]);
	}

	/**
	 * 
	 */
	#[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
	public function delete(Request $request, User $user, UserRepository $userRepository): Response
	{
		if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
			$userRepository->remove($user, true);
		}

		return $this->redirectToRoute('app_user_list', [], Response::HTTP_SEE_OTHER);
	}
}
