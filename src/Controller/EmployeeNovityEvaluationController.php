<?php

namespace App\Controller;

use App\Entity\EmployeeNovityEvaluation;
use App\Form\EmployeeNovityEvaluationType;
use App\Repository\EmployeeNovityEvaluationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employee/novity/evaluation')]
class EmployeeNovityEvaluationController extends AbstractController
{
    #[Route('/', name: 'app_employee_novity_evaluation_index', methods: ['GET'])]
    public function index(EmployeeNovityEvaluationRepository $employeeNovityEvaluationRepository): Response
    {
        return $this->render('employee_novity_evaluation/index.html.twig', [
            'employee_novity_evaluations' => $employeeNovityEvaluationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_novity_evaluation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmployeeNovityEvaluationRepository $employeeNovityEvaluationRepository): Response
    {
        $employeeNovityEvaluation = new EmployeeNovityEvaluation();
        $form = $this->createForm(EmployeeNovityEvaluationType::class, $employeeNovityEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeeNovityEvaluationRepository->add($employeeNovityEvaluation, true);

            return $this->redirectToRoute('app_employee_novity_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee_novity_evaluation/new.html.twig', [
            'employee_novity_evaluation' => $employeeNovityEvaluation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_novity_evaluation_show', methods: ['GET'])]
    public function show(EmployeeNovityEvaluation $employeeNovityEvaluation): Response
    {
        return $this->render('employee_novity_evaluation/show.html.twig', [
            'employee_novity_evaluation' => $employeeNovityEvaluation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_novity_evaluation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EmployeeNovityEvaluation $employeeNovityEvaluation, EmployeeNovityEvaluationRepository $employeeNovityEvaluationRepository): Response
    {
        $form = $this->createForm(EmployeeNovityEvaluationType::class, $employeeNovityEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeeNovityEvaluationRepository->add($employeeNovityEvaluation, true);

            return $this->redirectToRoute('app_employee_novity_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee_novity_evaluation/edit.html.twig', [
            'employee_novity_evaluation' => $employeeNovityEvaluation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_novity_evaluation_delete', methods: ['POST'])]
    public function delete(Request $request, EmployeeNovityEvaluation $employeeNovityEvaluation, EmployeeNovityEvaluationRepository $employeeNovityEvaluationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employeeNovityEvaluation->getId(), $request->request->get('_token'))) {
            $employeeNovityEvaluationRepository->remove($employeeNovityEvaluation, true);
        }

        return $this->redirectToRoute('app_employee_novity_evaluation_index', [], Response::HTTP_SEE_OTHER);
    }
}
