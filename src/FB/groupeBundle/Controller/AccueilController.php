<?php

namespace FB\groupeBundle\Controller;


/**
 * @author Bilal Soidik <bilalsoidik@gmail.com>
 * @copyright (c) 2013, Bilal Soidik
 * 
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FB\groupeBundle\Form\GroupeType;
use Symfony\Component\HttpFoundation\Response;
use FOS\FacebookBundle\Facebook\FacebookSessionPersistence;
use Doctrine\DBAL\DBALException;

class AccueilController extends Controller
{   
    /**
     * @var FacebookSessionPersistence C'est l'instance qui permet d'intéragir avec le serveur facebook,
     * on le déclare privé que si on l'initialise au moins une fois 
     * on va pouvoir l'utliser sur les méthodes privé
     */
    private $facebook;
    
    /**
     * L'action index d'acceul si vous êtes connecté il va vous renvoyer à page
     * d'accueil qui vous donne accès à tous les services, sinon il vous renvoie 
     * à la page d'acceul principale.
     */
    public function indexAction()
    {
        
         
          $this->facebook = $this->get('fos_facebook.api'); 

    if($this->facebook->getUser()==0) 
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
     else
          return $this->render('FBgroupeBundle:Accueil:indexLoged.html.twig');
        
    }
    
    
    public function login_reussiAction(){
        $this->facebook = $this->get('fos_facebook.api');
    
       if($this->facebook->getUser()==0) 
           return $this->forward ("FBgroupeBundle:Accueil:index");
       
        $this->facebook->setExtendedAccessToken();
        $access_token=$this->facebook->getAccessToken();
        $temp=56*24*3600;
        setcookie('accessToken', $access_token,time()+$temp);
        
   try {
        
            $utilisateur=$this->facebook->api('/me?fields=id,name,link');
        
        } catch (\FacebookApiException $e){     
            
             return $this->redirect($this->facebook->getLoginUrl());
        }
        $this->get('session')->set('utilisateur',$utilisateur);
        $em=$this->getDoctrine()->getManager(); 
        $groups=$em->getRepository("FBgroupeBundle:Groupe")->findAll();
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', 
                                  array('groupes'=>$groups));
       }
  
   public function ajouterGroupAction(){
       $this->facebook = $this->get('fos_facebook.api');
       if($this->facebook->getUser()==0) 
           return $this->forward ("FBgroupeBundle:Accueil:index");
       
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
       $this->facebook = $this->get('fos_facebook.api');
       if($this->facebook->getUser()==0) 
           return $this->forward ("FBgroupeBundle:Accueil:index");
       $em=$this->getDoctrine()->getManager();
       $dept=$em->getRepository("FBgroupeBundle:"+$entite);
       $objet=$dept->find($id);
       $serializer=$this->container->get('serializer');
       $jsonObjet = $serializer->serialize($objet, 'json');
       
       return new Response($jsonObjet);
   }
    
public function supprimerGroupAction($idgp){
    $this->facebook = $this->get('fos_facebook.api');
       if($this->facebook->getUser()==0) 
           return $this->forward ("FBgroupeBundle:Accueil:index");
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
      
public function deconnecteAction(){
  
   
   if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
   
}
$this->facebook = $this->get('fos_facebook.api');
   $this->facebook->destroySession();
   $this->get('session')->invalidate();
      return $this->redirect($this->generateUrl("f_bgroupe_accueil"));

}
      
   
}
