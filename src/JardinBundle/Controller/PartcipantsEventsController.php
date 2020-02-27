<?php


namespace JardinBundle\Controller;


use JardinBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartcipantsEventsController extends Controller
{
    public function participerEvenementAction(){
        $list=$this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render('JardinBundle:Parent/evenement:particper.html.twig',array('events'=>$list));
    }

}