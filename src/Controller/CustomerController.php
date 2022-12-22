<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Customer;
use App\Form\CustomerType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use App\Repository\UserRepository;
use App\Repository\MissionRepository;
use App\Repository\CustomerRepository;
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

#[Route('/client')]
class CustomerController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @param CustomerRepository $customerRepository
     * @param Request $request
     * @param DataTableFactory $dataTableFactory
     * @return Response
     */
    #[Route('/', name: 'app_customer_index', methods: ['POST', 'GET'])]
    public function index(CustomerRepository $customerRepository, Request $request, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
            ->add('id', NumberColumn::class, ['visible' => false])
            ->add('name_company', TextColumn::class, [
                'label' => 'Client',
            ])
            ->add('location', TextColumn::class, [
                'label' => 'Localisation'
            ])
            ->add('size_company', TextColumn::class, [
                'label' => 'Effectif'
            ])
            ->add('work_time', TextColumn::class, [
                'label' => 'Horaire'
            ])
            ->add('dateCollaboration', DateTimeColumn::class, [
                'label' => 'Contrat',
                'format' => 'd-m-Y',
                'searchable' => false,
            ])
            ->add('activity_name', TextColumn::class, [
                'label' => 'Type activité',
                'propertyPath' => '[activity_name]'
            ])
            ->add('sector_name', TextColumn::class, [
                'label' => 'Secteur activité',
                'propertyPath' => '[sector_name]'
            ])
            ->add('unit_manager', TextColumn::class, [
                'label' => 'Unit manager',
                'propertyPath' => '[unit_manager]',
                'searchable' => false,
                'orderable' => false,
                'globalSearchable' => false
            ])
            ->add('business_manager', TextColumn::class, [
                'label' => 'Business manager',
                'propertyPath' => '[business_manager]',
                'searchable' => false,
                'orderable' => false,
                'globalSearchable' => false
            ])
            ->add('buttons', TwigColumn::class, [
                'label' => 'Actions',
                'template' => 'customer/datatable/buttonbar.html.twig'
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Customer::class,
                'hydrate' => AbstractQuery::HYDRATE_ARRAY,
                'query' => function (QueryBuilder $builder) {
                    $builder
                        ->select("
                        c.id,
                        c.name_company,
                        c.location,
                        c.size_company,
                        c.work_time,
                        c.cra,
                        c.dateCollaboration,
                        activity.nameActivity AS activity_name,
                        sector.nameSector AS sector_name,
                        CONCAT(um.firstname, ' ', um.lastname) AS unit_manager,
                        CONCAT(bm.firstname, ' ', bm.lastname) AS business_manager
                        ")
                        ->from(Customer::class, 'c')
                        ->leftjoin('c.unitManager', 'um')
                        ->leftjoin('c.businessManager', 'bm')
                        ->leftjoin('c.typeActivity', 'activity')
                        ->leftjoin('c.businessSector', 'sector');
                }
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render(
            'customer/index.html.twig',
            ['datatable' => $table]
        );
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param CustomerRepository $customerRepository
     * @return Response
     */
    #[Route('/nouveau', name: 'app_customer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CustomerRepository $customerRepository): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * 
     */
    #[Route('/{id}', name: 'app_customer_show', methods: ['GET'])]
    public function show(Customer $customer): Response
    {
        return $this->render('customer/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    /**
     * 
     */
    #[Route('/{id}/edit', name: 'app_customer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_customer_delete', methods: ['POST'])]
    public function delete(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $customer->getId(), $request->request->get('_token'))) {
            $customerRepository->remove($customer, true);
        }

        return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
    }
}
