<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FB\groupeBundle\Form\GroupeType;
use \Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{   
    public function indexAction()
    {
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
    }
    public function login_reussiAction(){
        $facebook = $this->get('fos_facebook.api'); 
        $facebook->setExtendedAccessToken();
        $access_token=$facebook->getAccessToken();
        $temp=59*24*3600;
        setcookie('accessToken', $access_token,time()+$temp);
        $utilisateur=$facebook->api('/me');
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', 
                                  array('utilisateur'=>$utilisateur));
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
        $formulaire->remove($un_groupe);
        $this->get('session')->getFlashBag()->add(
            'note',
            'Le groupe a été enregistré avec scccès'
        );
        return $this->redirect('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig',
                             array('utilisateur'=>$utilisateur));
       }else{
           $this->get('session')->getFlashBag()->add(
            'note',
            'Il y a des erreur'
        );
       }
       return $this->redirect('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig',
                            array('utilisateur'=>$utilisateur));
   }
   //recuperation du formulaire d'ajout de groupe
   public function getFormGroupAction(){
        $formulaire=$this->createForm(new GroupeType());
        return $this->render('FBgroupeBundle:FbGroupeViews:formGroup.html.twig',
                          array('formulaire'=>$formulaire->createView()));
   }
   public function getObjetAction($id , $entite){
       $em=$this->getDoctrine()->getManager();
       $dept=$em->getRepository("FBgroupeBundle:"+$entite);
       $objet=$dept->find($id);
       $serializer=$this->container->get('serializer');
       $jsonObjet = $serializer->serialize($objet, 'json');
       
       return new Response($jsonObjet);
   }
    public function  deconnecteAction(){
        
   }
}
