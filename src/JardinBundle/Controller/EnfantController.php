<?php
/**
 * Created by PhpStorm.
 * User: ayoub
 * Date: 2/27/2020
 * Time: 12:51 AM
 */

namespace JardinBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EnfantController extends  Controller
{
public function listeAction()
{
    $user = $this->container->get('security.token_storage')->getToken()->getUser()->getid();
    $em = $this->getDoctrine()->getManager();
    $enf = $em->getRepository('JardinBundle:enfant')->findBy(array('parents'=>$user));
    return $this->render('@Jardin/Parent/Enfant/lister_enf.html.twig', array(
        'enfs' => $enf,
    ));
}
}