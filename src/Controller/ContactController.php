<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController {
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response {

        $formulaire = $this->createForm(ContactType::class);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $data = $formulaire->getData();

            $email = new TemplatedEmail;
            $email
                ->from('Contact Pronote <' . $data['email'] . '>')
                ->to('2alheure@yopmail.fr')
                ->replyTo($data['email'])
                ->subject('Vous avez une demande de contact.')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'fromEmail' => $data['email'],
                    'message' => nl2br($data['message']),
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé.');
        }

        return $this->render('generic/form.html.twig', [
            'titre' => 'Contact',
            'form' => $formulaire->createView()
        ]);
    }
}
