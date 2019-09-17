<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact", name="contact")
     */
    public function newContact(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $message = (new \Swift_Message('You Got Mail!'))
                    ->setFrom($contact->getEmail())
                    ->setTo('etienne.ziegelmeyer@lapiscine.pro')
                    ->setBody(
                        $this->renderView(
                            'contact/_mail.html.twig', [
                                'firstname' => $contact->getFirstname(),
                                'lastname' => $contact->getLastname(),
                                'message' => $contact->getMessage(),
                                'email' => $contact->getEmail(),
                                'phone' => $contact->getPhone()
                            ]
                        ),
                        'text/html'
                    );
                $mailer->send($message);
                $this->addFlash('success', 'Votre message a bien été envoyé.');

                return $this->redirectToRoute('games');
            }else{
                $this->addFlash('fail', 'Votre message n\'a pas pu être envoyé.');

                return $this->render('contact/contact.html.twig', [
                    'contactForm' => $form->createView()
                ]);
            }
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $form->createView()
        ]);
    }
}
