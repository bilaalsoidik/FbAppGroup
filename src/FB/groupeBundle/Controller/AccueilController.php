<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BaseFacebook;

class AccueilController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
    }
    public function login_reussiAction(){
        $facebook->setExtendedAccessToken();
        $facebook = $this->get('fos_facebook.api');
        $moi=$facebook->api('/me');

         return $this->render('FBgroupeBundle::affiche.html.twig', array('tableau'=>$moi));  
       }

    public function  deconnecteAction(){
        
   }
}
