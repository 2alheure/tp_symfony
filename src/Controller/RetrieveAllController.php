<?php

namespace App\Controller;

use App\Repository\ProfRepository;
use App\Repository\EleveRepository;
use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RetrieveAllController extends AbstractController {
    #[Route('/profs', name: 'profs_all')]
    public function profs(ProfRepository $pr): Response {
        return $this->render('profs/index.html.twig', [
            'profs' => $pr->findAll(),
        ]);
    }

    #[Route('/classes', name: 'classes_all')]
    public function classes(ClasseRepository $cr): Response {
        return $this->render('classes/index.html.twig', [
            'classes' => $cr->findAll(),
        ]);
    }

    #[Route('/eleves', name: 'eleves_all')]
    public function eleves(EleveRepository $er): Response {
        return $this->render('eleves/index.html.twig', [
            'eleves' => $er->findAll(),
        ]);
    }

    #[Route('/matieres', name: 'matieres_all')]
    public function matieres(MatiereRepository $er): Response {
        return $this->render('matieres/index.html.twig', [
            'matieres' => $er->findAll(),
        ]);
    }
}
