<?php


namespace JardinBundle\Controller;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use JardinBundle\Entity\Commentaire;
use JardinBundle\Entity\Evenement;
use JardinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class CommentaireController extends Controller
{
    public function addCommentAction(Request $request, $id)
    {

        $username = (string)$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $currentUser = $em->getRepository(User::class)->findOneBy(array('username' => $username));

        $text = $request->get('text');

        $comment = new Commentaire();
        $comment->setContenu($text);
        $comment->setDate(new \DateTime());

        $event = $em->getRepository(Evenement::class)->find($id);

        $comment->setEvenement($event);
        $comment->setUser($currentUser);

        $em->persist($comment);
        $em->flush();

        $rolesNames = $currentUser->getRoles();
        if (in_array('ROLE_ADMIN', $rolesNames, true) ||
            in_array('ROLE_SUPER_ADMIN', $rolesNames,true)  ){
            return $this->redirectToRoute('details_evenement', array('id' => $id));
        }else{
            return $this->redirectToRoute('details_evenement_parent', array('id' => $id));
        }


    }

    public function deleteCommentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository(Commentaire::class)->find($id);
        $idEvenement = $commentaire->getEvenement()->getId();
        $em->remove($commentaire);
        $em->flush();

        $username = (string)$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $currentUser = $em->getRepository(User::class)->findOneBy(array('username' => $username));
        $rolesNames = $currentUser->getRoles();
        if (in_array('ROLE_ADMIN', $rolesNames, true) ||
            in_array('ROLE_SUPER_ADMIN', $rolesNames,true)  ){
            return $this->redirectToRoute('details_evenement', array('id' => $idEvenement));
        }else{
            return $this->redirectToRoute('details_evenement_parent', array('id' => $idEvenement));
        }

    }

    public function updateCommentAction(Request $request)
    {
        $id = $request->get('id');
        $content = $request->get('contenu');

        $em = $this->getDoctrine()->getManager();

        $com = $em->getRepository(Commentaire::class)->find($id);
        $com->setContenu($request->get('contenu'));
        $date = new \DateTime($request->get('date'));

        $em->persist($com);
        $em->flush();

        $response = new Response();
        $response->setContent(json_encode([
                'contenu' => $content,
                'date' => $date
            ])
        );
        return $response;
    }

}

