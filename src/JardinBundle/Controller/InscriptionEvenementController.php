<?php


namespace JardinBundle\Controller;
use JardinBundle\Entity\Evenement;
use JardinBundle\Entity\InscriptionEvenement;
use JardinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InscriptionEvenementController extends Controller
{
    public function inscrireEvenementAction($idEvenement,Request $request){
        $username =(string) $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $currentUser = $em->getRepository(User::class)->findOneBy(array('username'=>$username));
        $event = $em->getRepository(Evenement::class)->find($idEvenement);

        $inscription =new InscriptionEvenement();

        $inscription->setUser($currentUser);
        $inscription->setEvenement($event);
        $inscription->setDateCreation(new \DateTime());

        $em->persist($inscription);
        $em->flush();

        foreach (  $currentUser->getEnfants() as $enfant) {
            if($request->get($enfant->getPrenom())) {
                $enfant->getInscriptionEvenements()[] = $inscription;
                $em->persist($enfant);
                $em->flush();
            }
        }

       return $this->redirectToRoute('parent_evenements');

    }
    public function annulerInscriptionAction($idEvenement){
        $username =(string) $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $currentUser = $em->getRepository(User::class)->findOneBy(array('username'=>$username));
        $event = $em->getRepository(Evenement::class)->find($idEvenement);

       $inscriptions=$em->getRepository(InscriptionEvenement::class)->findBy(array('user'=>$currentUser,'evenement'=>$event));

     foreach ($inscriptions as $inscri){
         $em->remove($inscri);
         $em->flush();
     }

        return $this->redirectToRoute('parent_evenements');
    }

}