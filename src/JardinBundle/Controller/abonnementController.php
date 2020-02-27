<?php

namespace JardinBundle\Controller;

use JardinBundle\Entity\abonnement;
use JardinBundle\Entity\Abonnmentad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class abonnementController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $abonnements = $em->getRepository('JardinBundle:Abonnmentad')->findAll();
        return $this->render('JardinBundle:Parent/Abonnement:Abonnement.html.twig', array(
            'abonnements' => $abonnements,
        ));
    }
    /*Confirmation de achat */
    public function abnselectionerAction($id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.token_storage')->getToken()->getUser()->getid();
            $ko = $em->getRepository(Abonnmentad::class)->find($id);
            $enf = $em->getRepository('JardinBundle:enfant')->getenfantparent($user);
            return $this->render('JardinBundle:Parent/Abonnement:purchase.html.twig', array(
                'ko' => $ko,
                'enf' => $enf
            ));
        }
        else
            return $this->redirectToRoute('fos_user_security_login');

    }


//affecter un abonnement a un enfant avec test sur

    public function registerabnAction(Request $request)
    {
        $now = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('enfant');
        $cc = $em->getRepository('JardinBundle:abonnement')->getabnenf($id);
        if( $cc[0]->getStatu() == 'valide')
        {
            $em = $this->getDoctrine()->getManager();
            $abonnements = $em->getRepository('JardinBundle:Abonnmentad')->findAll();
            $this->get('session')->getFlashBag()->add('error','Vous avez déja un abonnment');
            return $this->render('JardinBundle:Parent/Abonnement:Abonnement.html.twig', array(
                'abonnements' => $abonnements,
            ));

        }elseif($cc[0]->getDateFin() < $now && $cc[0]->getStatu() == 'no valide')
        {
            if ($request->isMethod('POST')) {
                $id = $request->get('enfant');
                $enafant = $em->getRepository('JardinBundle:enfant')->find($id);
                $abn = $em->getRepository('JardinBundle:abonnement')->findBy(array("enfant"=>$id));
                $abn[0]->setType($request->get('type'));
                $abn[0]->setDescription($request->get('description'));
                $abn[0]->setDataDebut(null);
                $abn[0]->setDateFin(null);
                $abn[0]->setStatuPaiment("en attente");
                $abn[0]->setStatu("no valide");
                $em->persist($abn[0]);
                $em->flush();
                return $this->render('JardinBundle:Parent/Abonnement:Success.html.twig',
                    array('type'=> $request->get('type')
                    ,'enfant'=>$enafant)
                );
            }

        }elseif ($cc[0]->getStatu() == 'no valide')
        {
            $em = $this->getDoctrine()->getManager();
            $abonnements = $em->getRepository('JardinBundle:Abonnmentad')->findAll();
            $this->get('session')->getFlashBag()->add('warning','vous devez payer votre abonnement');
            return $this->render('JardinBundle:Parent/Abonnement:Abonnement.html.twig', array(
                'abonnements' => $abonnements,
            ));
        }elseif ($cc[0]->getDateFin() < $now)
        {
            $em = $this->getDoctrine()->getManager();
            $abonnements = $em->getRepository('JardinBundle:Abonnmentad')->findAll();
            $this->get('session')->getFlashBag()->add('other','Votre Abonnement est expiré');
            return $this->render('JardinBundle:Parent/Abonnement:Abonnement.html.twig', array(
                'abonnements' => $abonnements,
            ));
        }
        else {
            if ($request->isMethod('POST')) {
                $abonnement = new abonnement();
                $enafant = $em->getRepository('JardinBundle:enfant')->find($id);
                $abonnement->setType($request->get('type'));
                $abonnement->setDescription($request->get('description'));
                $abonnement->setEnfant($enafant);
                $em->persist($abonnement);
                $em->flush();
                return $this->render('JardinBundle:Parent/Abonnement:Success.html.twig',
                    array('type' => $request->get('type')
                    , 'enfant' => $enafant)
                );
            }
        }

    }
    public function affichenfantabnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser()->getid();
        $enafant = $em->getRepository('JardinBundle:User')->getEnfants($user);
        return $this->render("@Jardin/Parent/Abonnement/affiche_abn.html.twig",array('tab'=>$enafant));
    }
    public function affiche_parent_abnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser()->getid();

    }




    public function showadminabonnmentAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('JardinBundle:abonnement')->getdata();
        return $this->render('@Jardin/dashboard/abonnement/abonnement.html.twig',array(
            'data'=>$data
        ));
    }


}
