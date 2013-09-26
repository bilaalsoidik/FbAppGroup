<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
    }
    public function login_checkAction(){
        
    }
    public function  logutAction(){
        
    }
}
