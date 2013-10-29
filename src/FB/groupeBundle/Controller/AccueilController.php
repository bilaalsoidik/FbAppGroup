<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FB\groupeBundle\Form\GroupeType;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\DBAL\DBALException;

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
        
        $utilisateur=$facebook->api('/me?fields=id,name,link');
        $this->get('session')->set('utilisateur',$utilisateur);
        $em=$this->getDoctrine()->getManager(); 
        $groups=$em->getRepository("FBgroupeBundle:Groupe")->findAll();
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', 
                                  array('groupes'=>$groups));
       }
  
   public function ajouterGroupAction(){
      
       $formulaire=$this->createForm(new GroupeType());
       $em=$this->getDoctrine()->getManager();  
       $request=$this->getRequest();
       if($request->isMethod('POST')){
        $formulaire->bind($request);
        $un_groupe=$formulaire->getData();
        $em->persist($un_groupe);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'note',/*=>*/'Le groupe a été enregistré avec scccès'
            );
        
        return $this->redirect($this->generateUrl("_security_check"),301);
       } else{
           $this->get('session')->getFlashBag()->add(
            'note',
            'Il y a des erreur' 
        );
       }
       return $this->redirect($this->generateUrl("_security_check"),301);
   }
   //recuperation du formulaire d'ajout de groupe
   public function getFormGroupAction(){
        $formulaire=$this->createForm(new GroupeType());
        return $this->render('FBgroupeBundle:FbGroupeViews:formGroup.html.twig',
                          array('formulaire'=>$formulaire->createView()));
   }
   
   /**
    * 
    */
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
public function supprimerGroupAction($idgp){
     $em=$this->getDoctrine()->getManager();
     $gp=$em->find("FBgroupeBundle:Groupe",$idgp);
     try{
     $em->remove($gp);
     $em->flush();
     $succ_data = json_encode(array('statu' => 1 ), JSON_FORCE_OBJECT);
     }  catch (DBALException $e){
         
         $succ_data = json_encode(array('statu' => -20 ), JSON_FORCE_OBJECT);
     }
     return new Response($succ_data);
     
}
      

      
   
}
