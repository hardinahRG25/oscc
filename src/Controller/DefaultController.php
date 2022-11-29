<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
	#[Route('/', name: 'app_default')]
	public function indexAction(): Response
	{
		$user = $this->getUser();

		if (is_null($user)) {
			return $this->redirectToRoute("app_login");
		} else {
			return $this->redirectToRoute("app_dashboard");
		}
	}
}
