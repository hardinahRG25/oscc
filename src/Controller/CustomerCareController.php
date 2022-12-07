<?php

namespace App\Controller;

use App\Entity\CustomerCare;
use App\Form\CustomerCareType;
use App\Repository\CustomerCareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client/care')]
class CustomerCareController extends AbstractController
{
	#[Route('/', name: 'app_client_care_index', methods: ['GET'])]
	public function index(CustomerCareRepository $customerCareRepository): Response
	{
		return $this->render('client_care/index.html.twig', [
			'customer_cares' => $customerCareRepository->findAll(),
		]);
	}

	#[Route('/new', name: 'app_client_care_new', methods: ['GET', 'POST'])]
	public function new(Request $request, CustomerCareRepository $customerCareRepository): Response
	{
		$customerCare = new CustomerCare();
		$form = $this->createForm(CustomerCareType::class, $customerCare);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$customerCareRepository->add($customerCare, true);

			return $this->redirectToRoute('app_client_care_index', [], Response::HTTP_SEE_OTHER);
		}

		return $this->renderForm('client_care/new.html.twig', [
			'customer_care' => $customerCare,
			'form' => $form,
		]);
	}

	#[Route('/{id}', name: 'app_client_care_show', methods: ['GET'])]
	public function show(CustomerCare $customerCare): Response
	{
		return $this->render('client_care/show.html.twig', [
			'customer_care' => $customerCare,
		]);
	}

	#[Route('/{id}/edit', name: 'app_client_care_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, CustomerCare $customerCare, CustomerCareRepository $customerCareRepository): Response
	{
		$form = $this->createForm(CustomerCareType::class, $customerCare);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$customerCareRepository->add($customerCare, true);

			return $this->redirectToRoute('app_client_care_index', [], Response::HTTP_SEE_OTHER);
		}

		return $this->renderForm('client_care/edit.html.twig', [
			'customer_care' => $customerCare,
			'form' => $form,
		]);
	}

	#[Route('/{id}', name: 'app_client_care_delete', methods: ['POST'])]
	public function delete(Request $request, CustomerCare $customerCare, CustomerCareRepository $customerCareRepository): Response
	{
		if ($this->isCsrfTokenValid('delete' . $customerCare->getId(), $request->request->get('_token'))) {
			$customerCareRepository->remove($customerCare, true);
		}

		return $this->redirectToRoute('app_client_care_index', [], Response::HTTP_SEE_OTHER);
	}
}
