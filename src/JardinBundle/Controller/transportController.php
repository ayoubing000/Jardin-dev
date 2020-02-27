<?php

namespace JardinBundle\Controller;

use JardinBundle\Entity\transport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Transport controller.
 *
 */
class transportController extends Controller
{
    /**
     * Lists all transport entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
       // $user = $this->container->get('security.token_storage')->getToken()->getUser()->getid();
        $transports = $em->getRepository('JardinBundle:transport')->findAll();//By(array('employee' => $user ));

        return $this->render('transport/index.html.twig', array(
            'transports' => $transports,
        ));
    }

    /**
     * Creates a new transport entity.
     *
     */
    public function newAction(Request $request)
    {
        $transport = new Transport();
        $form = $this->createForm('JardinBundle\Form\transportType', $transport);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transport);
            $em->flush();

            return $this->redirectToRoute('transport_show', array('id' => $transport->getId()));
        }

        return $this->render('transport/new.html.twig', array(
            'transport' => $transport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a transport entity.
     *
     */
    public function showAction(transport $transport)
    {
        $deleteForm = $this->createDeleteForm($transport);

        return $this->render('transport/show.html.twig', array(
            'transport' => $transport,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing transport entity.
     *
     */
    public function editAction(Request $request, transport $transport)
    {
        $deleteForm = $this->createDeleteForm($transport);
        $editForm = $this->createForm('JardinBundle\Form\transportType', $transport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transport_edit', array('id' => $transport->getId()));
        }

        return $this->render('transport/edit.html.twig', array(
            'transport' => $transport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a transport entity.
     *
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $transport=$em->getRepository(transport::class)->find($id);
        $em->remove($transport);
        $em->flush();

        return $this->redirectToRoute('transport_index');
    }

    /**
     * Creates a form to delete a transport entity.
     *
     * @param transport $transport The transport entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(transport $transport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transport_delete', array('id' => $transport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
