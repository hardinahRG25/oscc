<?php

namespace App\Controller;

use App\Entity\LeaveCompany;
use App\Form\LeaveCompanyType;
use App\Repository\LeaveCompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/leave/company')]
class LeaveCompanyController extends AbstractController
{
    #[Route('/', name: 'app_leave_company_index', methods: ['GET'])]
    public function index(LeaveCompanyRepository $leaveCompanyRepository): Response
    {
        return $this->render('leave_company/index.html.twig', [
            'leave_companies' => $leaveCompanyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_leave_company_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LeaveCompanyRepository $leaveCompanyRepository): Response
    {
        $leaveCompany = new LeaveCompany();
        $form = $this->createForm(LeaveCompanyType::class, $leaveCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $leaveCompanyRepository->add($leaveCompany, true);

            return $this->redirectToRoute('app_leave_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('leave_company/new.html.twig', [
            'leave_company' => $leaveCompany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_leave_company_show', methods: ['GET'])]
    public function show(LeaveCompany $leaveCompany): Response
    {
        return $this->render('leave_company/show.html.twig', [
            'leave_company' => $leaveCompany,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_leave_company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LeaveCompany $leaveCompany, LeaveCompanyRepository $leaveCompanyRepository): Response
    {
        $form = $this->createForm(LeaveCompanyType::class, $leaveCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $leaveCompanyRepository->add($leaveCompany, true);

            return $this->redirectToRoute('app_leave_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('leave_company/edit.html.twig', [
            'leave_company' => $leaveCompany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_leave_company_delete', methods: ['POST'])]
    public function delete(Request $request, LeaveCompany $leaveCompany, LeaveCompanyRepository $leaveCompanyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $leaveCompany->getId(), $request->request->get('_token'))) {
            $leaveCompanyRepository->remove($leaveCompany, true);
        }

        return $this->redirectToRoute('app_leave_company_index', [], Response::HTTP_SEE_OTHER);
    }
}
