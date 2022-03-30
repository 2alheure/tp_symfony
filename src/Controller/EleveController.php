<?php

namespace App\Controller;

use App\Entity\Eleve;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController {
    #[Route('/eleves/{eleve}', name: 'eleves_details')]
    public function index(Eleve $eleve): Response {
        return $this->render('eleves/details.html.twig', [
            'eleve' => $eleve,
        ]);
    }
}
