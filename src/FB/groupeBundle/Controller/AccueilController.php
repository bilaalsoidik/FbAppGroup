<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FB\groupeBundle\Form\GroupeType;

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
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', 
                                  array('utilisateur'=>$utilisateur, 
                                          'afficheMessg'=>0));
       }
  
   public function ajouterGroupAction(){
       $facebook = $this->get('fos_facebook.api');
       //On a besoin toujours pour afficher les info de l'utilsateur courant
       $utilisateur=$facebook->api('/me');
       
       $formulaire=$this->createForm(new GroupeType());
       $em=$this->getDoctrine()->getManager();  
       $request=$this->getRequest();
       if($request->isMethod('POST')){
        $formulaire->bind($request);
        $un_groupe=$formulaire->getData();
        $em->persist($un_groupe);
        $em->flush();
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig',
                        array('utilisateur'=>$utilisateur,
                               'afficheMessg'=>1,
                               'message'=>' Le groupe a été enregistré en base de données avec scccès'));
       }
       return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig',
                        array('utilisateur'=>$utilisateur,
                               'afficheMessg'=>1,
                               'message'=>'Il y a des erreurs'));
   }
   //recuperation du formulaire d'ajout de groupe
   public function getFormGroupAction(){
        $formulaire=$this->createForm(new GroupeType());
        return $this->render('FBgroupeBundle:FbGroupeViews:formGroup.html.twig',
                                array('formulaire'=>$formulaire->createView()));
   }
    public function  deconnecteAction(){
        
   }
}
