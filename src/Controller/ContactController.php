<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\Core\Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function newContact(Request $request,  \Swift_Mailer $mailer)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $contactFormData = $form->getData();

            $message = (new \Swift_Message('You Got Mail!'))
                ->setFrom($contact->getEmail())
                ->setTo('etienne.ziegelmeyer@lapiscine.pro')
                ->setBody($contactFormData['message'],
                'text/plain'
                           )
            ;
          $mailer->send($message);

          return $this->redirectToRoute('games');
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $form->createView()
        ]);
    }
}
