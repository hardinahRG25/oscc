<?php

namespace App\Controller;

use App\Entity\MoodEmployee;
use App\Form\MoodEmployeeType;
use App\Repository\MoodEmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mood/employee')]
class MoodEmployeeController extends AbstractController
{
    #[Route('/', name: 'app_mood_employee_index', methods: ['GET'])]
    public function index(MoodEmployeeRepository $moodEmployeeRepository): Response
    {
        return $this->render('mood_employee/index.html.twig', [
            'mood_employees' => $moodEmployeeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mood_employee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MoodEmployeeRepository $moodEmployeeRepository): Response
    {
        $moodEmployee = new MoodEmployee();
        $form = $this->createForm(MoodEmployeeType::class, $moodEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moodEmployeeRepository->add($moodEmployee, true);

            return $this->redirectToRoute('app_mood_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mood_employee/new.html.twig', [
            'mood_employee' => $moodEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mood_employee_show', methods: ['GET'])]
    public function show(MoodEmployee $moodEmployee): Response
    {
        return $this->render('mood_employee/show.html.twig', [
            'mood_employee' => $moodEmployee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mood_employee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MoodEmployee $moodEmployee, MoodEmployeeRepository $moodEmployeeRepository): Response
    {
        $form = $this->createForm(MoodEmployeeType::class, $moodEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moodEmployeeRepository->add($moodEmployee, true);

            return $this->redirectToRoute('app_mood_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mood_employee/edit.html.twig', [
            'mood_employee' => $moodEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mood_employee_delete', methods: ['POST'])]
    public function delete(Request $request, MoodEmployee $moodEmployee, MoodEmployeeRepository $moodEmployeeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $moodEmployee->getId(), $request->request->get('_token'))) {
            $moodEmployeeRepository->remove($moodEmployee, true);
        }

        return $this->redirectToRoute('app_mood_employee_index', [], Response::HTTP_SEE_OTHER);
    }
}
