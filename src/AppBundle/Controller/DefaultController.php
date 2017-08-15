<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\ContactForm;

class DefaultController extends Controller
{
    private $email = 'tasktest88@gmail.com';
    
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        
        $form = $this->createForm(ContactForm::class);
        
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            
            if($form->isValid() && $form->isSubmitted()){
                $data = $request->request->all();
                
                $session = $this->get('session')->getFlashBag();
                if($this->sendMail($data, $mailer)) {
                    $session->add('success', 'Wiadomość została wysłana');
                    return $this->redirectToRoute('homepage');
                } else {
                    $session->add('danger', 'Błąd podczas wysyłania wiadomości');
                }                  
            }            
        }
        
        return $this->render('AppBundle:Default:show.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    private function sendMail(array $data, \Swift_Mailer $mailer) {
                $from = $data['contact_form']['email'];
                $content = $data['contact_form']['content'];
                $sender = $data['contact_form']['sender'];
                $title = $data['contact_form']['title'];
                
                $message = (new \Swift_Message())
                        ->setSubject($title)
                        ->setFrom(['botblackd988@gmail.com' => 'Arek Dobosz'])
                        ->setReplyTo($from)
                        ->setTo($this->email)
                        ->setBody(
                            $this->renderView(
                                'AppBundle:Emails:send_email.html.twig',
                                array(
                                    'content' => $content,
                                    'sender' => $sender
                                )
                            ),
                            'text/html'
                        );
            
        return $mailer->send($message);
    }
}
