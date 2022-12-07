<?php

namespace App\Controller;

use App\Entity\EmployeeMissionEvaluation;
use App\Form\EmployeeMissionEvaluationType;
use App\Repository\EmployeeMissionEvaluationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employee/mission/evaluation')]
class EmployeeMissionEvaluationController extends AbstractController
{
    #[Route('/', name: 'app_employee_mission_evaluation_index', methods: ['GET'])]
    public function index(EmployeeMissionEvaluationRepository $employeeMissionEvaluationRepository): Response
    {
        return $this->render('employee_mission_evaluation/index.html.twig', [
            'employee_mission_evaluations' => $employeeMissionEvaluationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_mission_evaluation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmployeeMissionEvaluationRepository $employeeMissionEvaluationRepository): Response
    {
        $employeeMissionEvaluation = new EmployeeMissionEvaluation();
        $form = $this->createForm(EmployeeMissionEvaluationType::class, $employeeMissionEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeeMissionEvaluationRepository->add($employeeMissionEvaluation, true);

            return $this->redirectToRoute('app_employee_mission_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee_mission_evaluation/new.html.twig', [
            'employee_mission_evaluation' => $employeeMissionEvaluation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_mission_evaluation_show', methods: ['GET'])]
    public function show(EmployeeMissionEvaluation $employeeMissionEvaluation): Response
    {
        return $this->render('employee_mission_evaluation/show.html.twig', [
            'employee_mission_evaluation' => $employeeMissionEvaluation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_mission_evaluation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EmployeeMissionEvaluation $employeeMissionEvaluation, EmployeeMissionEvaluationRepository $employeeMissionEvaluationRepository): Response
    {
        $form = $this->createForm(EmployeeMissionEvaluationType::class, $employeeMissionEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeeMissionEvaluationRepository->add($employeeMissionEvaluation, true);

            return $this->redirectToRoute('app_employee_mission_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee_mission_evaluation/edit.html.twig', [
            'employee_mission_evaluation' => $employeeMissionEvaluation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_mission_evaluation_delete', methods: ['POST'])]
    public function delete(Request $request, EmployeeMissionEvaluation $employeeMissionEvaluation, EmployeeMissionEvaluationRepository $employeeMissionEvaluationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employeeMissionEvaluation->getId(), $request->request->get('_token'))) {
            $employeeMissionEvaluationRepository->remove($employeeMissionEvaluation, true);
        }

        return $this->redirectToRoute('app_employee_mission_evaluation_index', [], Response::HTTP_SEE_OTHER);
    }
}
