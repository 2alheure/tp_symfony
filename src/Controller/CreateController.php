<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Entity\Eleve;
use App\Entity\Classe;
use App\Entity\Matiere;
use App\Form\ProfType;
use App\Form\EleveType;
use App\Form\ClasseType;
use App\Form\MatiereType;
use App\Repository\ProfRepository;
use App\Repository\EleveRepository;
use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateController extends AbstractController {
    #[Route('/profs/create', name: 'profs_create')]
    public function profs(Request $request, ProfRepository $pr): Response {

        $prof = new Prof;
        $formulaire = $this->createForm(ProfType::class, $prof);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $pr->add($prof);
            return $this->redirectToRoute('profs_all');
        }

        return $this->render('generic/form.html.twig', [
            'titre' => 'Nouveau professeur',
            'form' => $formulaire->createView()
        ]);
    }
    
    #[Route('/classes/create', name: 'classes_create')]
    public function classes(Request $request, ClasseRepository $cr): Response {

        $classe = new Classe;
        $formulaire = $this->createForm(ClasseType::class, $classe);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $cr->add($classe);
            return $this->redirectToRoute('classes_all');
        }

        return $this->render('generic/form.html.twig', [
            'titre' => 'Nouvelle classe',
            'form' => $formulaire->createView()
        ]);
    }

    #[Route('/matieres/create', name: 'matieres_create')]
    public function matieres(Request $request, MatiereRepository $mr): Response {

        $matiere = new Matiere;
        $formulaire = $this->createForm(MatiereType::class, $matiere);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $mr->add($matiere);
            return $this->redirectToRoute('matieres_all');
        }

        return $this->render('generic/form.html.twig', [
            'titre' => 'Nouvelle matière',
            'form' => $formulaire->createView()
        ]);
    }

    #[Route('/eleves/create', name: 'eleves_create')]
    public function eleves(Request $request, EleveRepository $er): Response {

        $eleve = new Eleve;
        $formulaire = $this->createForm(EleveType::class, $eleve);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $er->add($eleve);
            return $this->redirectToRoute('eleves_all');
        }

        return $this->render('generic/form.html.twig', [
            'titre' => 'Nouvel élève',
            'form' => $formulaire->createView()
        ]);
    }
}
