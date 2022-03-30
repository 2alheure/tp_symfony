<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Repository\ProfRepository;
use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController {
    #[Route('/profs/{id}/delete', name: 'profs_delete')]
    public function profs($id, ProfRepository $pr): Response {
        $prof = $pr->find($id);

        if ($prof->getClassesPrincipales()->isEmpty()) {
            $pr->remove($prof);
            $this->addFlash('success', $prof->getNomEtPrenom() . ' a été correctement supprimé.');
        } else $this->addFlash('errors', 'On ne peut pas supprimer un professeur qui est professeur principal d\'une classe.');

        return $this->redirectToRoute('profs_all');
    }

    #[Route('/eleves/{eleve}/delete', name: 'eleves_delete')]
    public function eleves(Eleve $eleve, EleveRepository $er): Response {
        $er->remove($eleve);
        $this->addFlash('success', $eleve->getNomEtPrenom() . ' a été correctement supprimé.');

        return $this->redirectToRoute('eleves_all');
    }
}
