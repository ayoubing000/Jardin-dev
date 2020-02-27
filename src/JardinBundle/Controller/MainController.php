<?php


namespace JardinBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends  Controller
{
    public function parentHomeAction(){
        $username=(string) $this->getUser();
        return $this->render('JardinBundle:Parent:Profil.html.twig',array('username'=> $username));
    }

    public function enseignantHomeAction(){
        $username=(string) $this->getUser();
        return $this->render('JardinBundle:Enseignant:index.html.twig',array('username'=> $username));
    }

    public function dashboardHomeAction(){
        $username=(string) $this->getUser();
        return $this->render('JardinBundle:dashboard:index.html.twig',array('username'=> $username));
    }
}