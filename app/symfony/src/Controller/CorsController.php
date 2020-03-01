<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CorsController extends AbstractController
{
    /**
     * @Route("/cors/", name="check_cors")
     */
    public function index(): ?Response
    {
        return $this->render('/util/cors.html.twig');
    }
}
