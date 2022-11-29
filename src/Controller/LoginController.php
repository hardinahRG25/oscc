<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
	#[Route('/login', name: 'app_login')]
	public function index(AuthenticationUtils $authenticationUtils): Response
	{
		$user = $this->getUser();

		if (is_null($user)) {
			// get the login error if there is one
			$error = $authenticationUtils->getLastAuthenticationError();

			// last username entered by the user
			$lastUsername = $authenticationUtils->getLastUsername();

			return $this->render('login/index.html.twig', [
				'last_username' => $lastUsername,
				'error'         => $error,
			]);
		} else {
			return $this->redirectToRoute("app_dashboard");
		}
	}

	#[Route('/logout', name: 'app_logout')]
	public function logout(Request $request, TokenStorageInterface $tokenStorage): void
	{
		$request->getSession()->invalidate();
		$this->$tokenStorage->setToken(null);
	}
}
