<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{   
    public function indexAction()
    {
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
    }
    public function login_reussiAction(){
        $facebook = $this->get('fos_facebook.api'); 
        $ancien_AK=$facebook->getAccessToken();
        $facebook->setExtendedAccessToken();
        $access_token=$facebook->getAccessToken();
        $temp=59*24*3600;
        setcookie('accessToken', $access_token,time()+$temp);
        $utilisateur=$facebook->api('/me');
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', array('utilisateur'=>$utilisateur, 'ancien_AK'=>$ancien_AK));
       }

    public function  deconnecteAction(){
        
   }
}
