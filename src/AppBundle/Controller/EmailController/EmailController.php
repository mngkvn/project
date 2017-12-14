<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 12/14/2017
 * Time: 8:29 AM
 */

namespace AppBundle\Controller\EmailController;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EmailController extends Controller
{
    /**
     * @Route("/emailTest",name="email-test")
     * @param string $address
     * @param \Swift_Mailer $mailer
     */
    public function sendEmail($address="bvmngkvn@mailinator.com"){
        $message = new \Swift_Message();
        $message->setSubject("Test Email");
        $message->setFrom("bv@example.com");
        $message->setTo($address);
        $message->setBody($this->renderView('EmailView/EmailTemplate.html.twig'),'text/html');

        $this->get('mailer')->send($message);

        return $this->render('EmailView/EmailView.html.twig');
    }
}