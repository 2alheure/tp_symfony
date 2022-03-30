<?php

namespace App\Controller;

use App\Repository\ProfRepository;
use App\Repository\EleveRepository;
use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
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
    public function eleves(EleveRepository $er, Request $request): Response {

        if ($request->query->has('search')) { // "Si j'ai un $_GET['search']"
            $eleves = $er->findBySearch($request->query->get('search')); // $_GET['search']
        } else $eleves = $er->findAll();


        return $this->render('eleves/index.html.twig', [
            'eleves' => $eleves,
        ]);
    }

    #[Route('/matieres', name: 'matieres_all')]
    public function matieres(MatiereRepository $er): Response {
        return $this->render('matieres/index.html.twig', [
            'matieres' => $er->findAll(),
        ]);
    }
}
