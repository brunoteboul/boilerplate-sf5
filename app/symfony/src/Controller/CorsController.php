<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CorsController extends AbstractController
{
    /**
     * @Route("/cors/", name="cors_check")
     */
    public function index(): Response
    {
        return $this->render('/util/cors.html.twig');
    }

    /**
     * @Route("/cors/request/", name="cors_request")
     */
    public function bench(): JsonResponse
    {
        return $this->json([
            ['id' => 1, 'username' => 'Sofiane'],
            ['id' => 2, 'username' => 'Patrice'],
            ['id' => 3, 'username' => 'Jerome'],
            ['id' => 3, 'username' => 'Eric'],
        ]);
    }
}
