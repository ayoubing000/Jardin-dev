<?php


namespace JardinBundle\Controller;


use JardinBundle\Entity\Evenement;
use JardinBundle\Entity\User;
use JardinBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    public function listEvenementAction()
    {
        $username = (string)$this->getUser();
        $list = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render('JardinBundle:dashboard/evenement:list.html.twig', array('events' => $list, 'username' => $username));
    }

    public function addEvenementAction(Request $request)
    {
        $event = new Evenement();
        $form = $this->createForm(EvenementType::class, $event);
        $form = $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('list_evenement');
        }
        return $this->render('JardinBundle:dashboard/evenement:add.html.twig', array('form' => $form->createView()));
    }

    public function deleteEvenementAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Evenement::class)->find($id);

        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('list_evenement');
    }


    public function updateEvenementAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Evenement::class)->find($id);

        if ($request->isMethod('POST')) {
            $event->setTitre($request->get('titre'));
            $dateDebut = new \DateTime($request->get('dateDebut'));
            $dateFin = new \DateTime($request->get('dateFin'));
            $event->setDateDebut($dateDebut);
            $event->setDateFin($dateFin);
            $event->setType($request->get('type'));
            $event->setDescription($request->get('description'));
            //$event->setActive($request->get('active'));

            $em->flush();

            return $this->redirectToRoute('list_evenement');

        }

        return $this->render('JardinBundle:dashboard/evenement:update.html.twig', array('event' => $event));
    }

    public function detailsEvenementAction($id)
    {
        $username = (string)$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Evenement::class)->find($id);
        return $this->render('JardinBundle:dashboard/evenement:detailsEvenement.html.twig', array('event' => $event,'username' => $username));
    }

    public function detailsEvenementParentAction($id)
    {
        $username = (string)$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Evenement::class)->find($id);
        return $this->render('JardinBundle:Parent/Evenement:details_evenement.html.twig', array('event' => $event,'username' => $username));
    }


    public function listEvenementParentAction()
    {
        $events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        $username = (string)$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $currentUser = $em->getRepository(User::class)->findOneBy(array('username' => $username));
        return $this->render("JardinBundle:Parent/Evenement:list_evenement.html.twig", array("events" => $events, "user" => $currentUser));
    }


}