<?php
/**
 * Created by PhpStorm.
 * User: ayoub
 * Date: 2/22/2020
 * Time: 10:26 PM
 */

namespace JardinBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParentController extends Controller
{
    Public function profilAction()
    {
        return $this->render("@Jardin/Parent/Profil.html.twig");
    }
    Public function enfantAction()
    {
        return $this->render("@Jardin/Parent/enfant.html.twig");
    }
}