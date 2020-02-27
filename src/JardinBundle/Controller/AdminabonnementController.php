<?php
/**
 * Created by PhpStorm.
 * User: ayoub
 * Date: 2/23/2020
 * Time: 10:17 PM
 */

namespace JardinBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use JardinBundle\Entity\Abonnmentad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminabonnementController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abonnements = $em->getRepository('JardinBundle:Abonnmentad')->findAll();
        return $this->render('@Jardin/dashboard/abonnement/affiche_abn.html.twig', array(
            'abonnements' => $abonnements,
        ));
    }

    public function newAction(Request $request)
    {
        $abonnement = new Abonnmentad();
        $form = $this->createForm('JardinBundle\Form\AbonnmentadType', $abonnement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($abonnement);
            $em->flush();
            return $this->redirectToRoute('abonnement_show', array('id' => $abonnement->getId()));
        }
        return $this->render('@Jardin/dashboard/abonnement/ajouter_abn.html.twig', array(
            'abonnement' => $abonnement,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $abn=$em->getRepository(Abonnmentad::class)->find($id);
        $em->remove($abn);
        $em->flush();
        return $this->redirectToRoute('abonnement_show');

    }


    public function editAction(Request $request, Abonnmentad $abonnement)
    {
        $editForm = $this->createForm('JardinBundle\Form\AbonnmentadType', $abonnement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('abonnement_edit', array('id' => $abonnement->getId()));
        }

        return $this->render('@Jardin/dashboard/abonnement/edit_abonnment.html.twig', array(
            'abonnement' => $abonnement,
            'edit_form' => $editForm->createView(),
        ));
    }


}