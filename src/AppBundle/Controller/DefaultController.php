<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Form\ContactForm;

class DefaultController extends FOSRestController
{
    private $email = 'tasktest88@gmail.com';
    
    /**
     * @Rest\Post("/send")
     */
    public function sendAction(Request $request, \Swift_Mailer $mailer) {
        
        $form = $this->createForm(ContactForm::class, null, [
            'csrf_protection' => false,        
        ]);
        
        $form->submit($request->request->all());
        
        if(!$form->isValid()) {
            return $form;
        }
        
        $data = $request->request->all();
        
        if($this->sendMail($data, $mailer)) {
            return new View("Email has sent", Response::HTTP_OK);
        }
    }
    
    private function sendMail(array $data, $mailer) {
        
        $from = $data['email'];
        $content = $data['content'];
        $sender = $data['sender'];
        $title = $data['title'];

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
