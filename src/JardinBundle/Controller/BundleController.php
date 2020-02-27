<?php
/**
 * Created by PhpStorm.
 * User: ayoub
 * Date: 2/19/2020
 * Time: 1:09 AM
 */

namespace JardinBundle\Controller;


use JardinBundle\Entity\abonnement;
use JardinBundle\Entity\message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BundleController extends Controller
{
    public function sendMailAction (Request $request)
    {
        $mail = new message();
        $form =$this->createForm('JardinBundle\Form\messageType',$mail);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $subject= $mail->getSubject();
                $mail = $mail->getMail();
                $object = $form['object']->getData();
                $men = "ayoub.bousselmi@esprit.tn";
                $message= \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom($men)
                    ->setTo($mail)
                    ->setBody($object);
                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->add('success','Message envoyer avec success');

        }
        return $this->render('@Jardin/Parent/contact.html.twig',array('f'=>$form->createView()));
    }

    public function PdfgenerateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $x = $em->getRepository('JardinBundle:abonnement')->find($id);
        $today = new \DateTime('today');
        $next = new \DateTime('today');
        $next = $next->modify("+1 months");
        $x->setDataDebut($today);
        $x->setDateFin($next->modify("+1 months"));
        $x->setStatu("valide");
        $x->setStatuPaiment("payed");
        $em->flush();
       /* $check = $em->getRepository('JardinBundle:abonnement')->check($id);
        if ($check)
        {    $abnenfan = $em->getRepository('JardinBundle:abonnement')->facturenf($id);
            $html = $this->renderView('JardinBundle:PDF:index.html.twig',array(
                '$abnenfan'=>$abnenfan
            ));*/
        $html = $this->renderView('JardinBundle:PDF:index.html.twig',array(
            'abnenfan'=>$x
        ));
            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="file.pdf"'
                )
            );

        /*}else{
            $em->getRepository('JardinBundle:abonnement')->updateabn($id);
            $abnenfan = $em->getRepository('JardinBundle:abonnement')->facturenf($id);
            $html = $this->renderView('JardinBundle:PDF:index.html.twig',array(
                '$abnenfan'=>$abnenfan
            ));
            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="file.pdf"'
                )
            );
        }*/
    }
    public function phoneAction()
    {
        /*$sms = new Sms("+21627232362", "test");
        $provider = $providerManager->getProvider('message_bird_provider_doc')  ;
        $provider->send($sms);*/
        /* $messagebird = $this->get('airoude.messagebird.client');

         $message             = new \MessageBird\Objects\Message();
         $message->originator = 'MessageBird';
         $message->recipients = array(+21655359343);
         $message->body       = '';

         $result = $messagebird->messages->create($message);*/
        $twilio = $this->get('twilio.api');
        $message = $twilio->account->messages->sendMessage(
            '+16788057888', // From a Twilio number in your account
            '+21627232362', // Text any number
            "votre abonnement pas encore payer"
        );
        //get an instance of \Service_Twilio
        return new Response($message->sid);

    }

}