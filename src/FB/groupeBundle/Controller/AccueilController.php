<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AccueilController extends Controller
{
    
    public function indexAction()
    {
        
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
    }
    public function login_reussiAction(){
      
       
       
         $facebook = $this->get('fos_facebook.api');
         
        $facebook->setExtendedAccessToken();
        $utilisateur=$facebook->api('/me');
         return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', array('utilisateur'=>$utilisateur));  
       }

    public function  deconnecteAction(){
        
   }
}
