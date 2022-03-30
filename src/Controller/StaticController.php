<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController {
    #[Route('/', name: 'accueil')]
    public function home(): Response {
        return $this->render('static/home.html.twig');
    }

    #[Route('/reglement', name: 'reglement')]
    public function reglement(): Response {
        return $this->render('static/reglement.html.twig');
    }
}
