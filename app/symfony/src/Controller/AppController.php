<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function json_encode;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="application")
     */
    public function index(): Response
    {
        // @var User|null $user
        $user = $this->getUser();
        $data = null;
        if (! empty($user)) {
            $userClone = clone $user;
            $userClone->setPassword('');
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            $serializer = new Serializer($normalizers, $encoders);
            $data = $serializer->serialize($userClone, JsonEncoder::FORMAT);
        }

        return $this->render('/app.html.twig', [
            'isAuthenticated' => json_encode(! empty($user)),
            'user' => $data ?? json_encode($data),
        ]);
    }
}
