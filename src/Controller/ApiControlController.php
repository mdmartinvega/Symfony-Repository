<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiControlController extends AbstractController
{
    /**
     * @Route("/api/control", name="api_control")
     */
    public function index(): Response
    {
        return $this->render('api_control/index.html.twig', [
            'controller_name' => 'ApiControlController',
        ]);
    }
}
