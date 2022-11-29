<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Entity\Customer;
use App\Form\MissionType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use App\Repository\MissionRepository;
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

#[Route('/mission')]
class MissionController extends AbstractController
{

    #[Route('/', name: 'app_mission_index', methods: ['POST', 'GET'])]
    public function index(MissionRepository $missionRepository, Request $request, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
            ->add('id', NumberColumn::class, ['visible' => false])
            ->add('name_employee', TextColumn::class, [
                'label' => 'Collaborateur',
                'propertyPath' => '[name_employee]',
                'searchable' => false,
                'orderable' => false,
                'globalSearchable' => false
            ])
            ->add('name_customer', TextColumn::class, [
                'label' => 'Client',
                'propertyPath' => '[name_customer]'
            ])
            ->add('job', TextColumn::class, [
                'label' => 'Poste',
            ])
            ->add('mission_type', TextColumn::class, [
                'label' => 'Type de mission'
            ])
            ->add('status_job,', TextColumn::class, [
                'label' => 'Statut',
                'propertyPath' => '[status_job]'
            ])
            ->add('date_start', DateTimeColumn::class, [
                'label' => 'Contrat',
                'format' => 'd-m-Y',
                'searchable' => false,
            ])
            ->add('buttons', TwigColumn::class, [
                'label' => 'Actions',
                'template' => 'mission/datatable/buttonbar.html.twig'
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Mission::class,
                'hydrate' => AbstractQuery::HYDRATE_ARRAY,
                'query' => function (QueryBuilder $builder) {
                    $select = "
                    m.id,
                    m.job,
                    m.mission_type,
                    m.date_start,
                    m.status AS status_job,
                    CONCAT(user.firstname, ' ', user.lastname) AS name_employee,
                    customer.name_company AS name_customer
                    ";
                    $builder
                        ->select($select)
                        ->from(Mission::class, 'm')
                        ->leftjoin('m.employee', 'user')
                        ->leftJoin('m.customer', 'customer');
                    if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
                        $builder
                            ->where('m.employee = :user')
                            ->setParameter('user', $this->getUser());
                    }
                }
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render(
            'mission/index.html.twig',
            [
                'datatable' => $table
            ]
        );
    }

    #[Route('/nouvelle', name: 'app_mission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->add($mission, true);

            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    #[Route('/{id}/modification', name: 'app_mission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mission $mission, MissionRepository $missionRepository): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->add($mission, true);

            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mission_delete', methods: ['POST'])]
    public function delete(Request $request, Mission $mission, MissionRepository $missionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mission->getId(), $request->request->get('_token'))) {
            $missionRepository->remove($mission, true);
        }

        return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
    }
}
