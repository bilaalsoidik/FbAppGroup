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
use Doctrine\DBAL\DBALException;

class AccueilController extends Controller
{   
    
    /**
     * L'action index d'acceul si vous êtes connecté il va vous renvoyer à page
     * d'accueil qui vous donne accès à tous les services, sinon il vous renvoie 
     * à la page d'acceul principale.
     */
    public function indexAction()
    {
        
         
            $facebook = $this->get('fos_facebook.api'); 
            $user=$this->get('session')->get('utilisateur');
    if($facebook->getUser()==0||!isset($user)) 
        return $this->render('FBgroupeBundle:Accueil:index.html.twig');
     else
          return $this->render('FBgroupeBundle:Accueil:indexLoged.html.twig');
        
    }
    
    
    public function login_reussiAction(){
        $facebook = $this->get('fos_facebook.api');
    
       if($facebook->getUser()==0) 
           return $this->forward ("FBgroupeBundle:Accueil:index");
  
        $facebook->setExtendedAccessToken();
          
        $access_token=$facebook->getAccessToken();
       
        $temp=56*24*3600;
        setcookie('accessToken', $access_token,time()+$temp);
        
   try {
        
            $utilisateur=$facebook->api('/me?fields=id,name,link');
        
        } catch (\FacebookApiException $e){     
            
             return $this->redirect($facebook->getLoginUrl());
        }
        $this->get('session')->set('utilisateur',$utilisateur);
        $em=$this->getDoctrine()->getManager(); 
        $groups=$em->getRepository("FBgroupeBundle:Groupe")->findAll();
        return $this->render('FBgroupeBundle:FbGroupeViews:InitGroup.html.twig', 
                                  array('groupes'=>$groups));
       }
  
   /**
     * L'action qui s’exécute pour ajouter un groupe, il necessite une session en cours
     * sinon il vous redirigera à la page d'accueil, il reçoit les données d'un formulaire
     * et ajoute le groupe à la base de donnée. 
     * 
     */
   public function ajouterGroupAction(){
       $facebook = $this->get('fos_facebook.api');
       if($facebook->getUser()==0) 
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
/**
 * recuperation du formulaire d'ajout de groupe
 * on le fait avec ajax
 * 
 */
 public function getFormGroupAction(){
        $formulaire=$this->createForm(new GroupeType());
        return $this->render('FBgroupeBundle:FbGroupeViews:formGroup.html.twig',
                          array('formulaire'=>$formulaire->createView()));
   }
  /**
     * L'action qui s’exécute pour supprimer un groupe, il nécessité une session en cours
     * sinon il vous redirigera à la page d'accueil,
     * 
     */
public function supprimerGroupAction($idgp){
    $facebook = $this->get('fos_facebook.api');
       if($facebook->getUser()==0) 
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
    /**
     * L'action qui s’exécute au moment de la déconnection de facebook à partir de notre application
     * il va détruire touts les attributs de session et les cookies crée par cet application
     * et détruire la FacebookSessionPersistence 
     * 
     */   
public function deconnecteAction(){
  
   $facebook = $this->get('fos_facebook.api');
   $facebook->destroySession();
   $this->get('security.context')->setToken(null);
   $this->get('session')->invalidate();
      return $this->redirect($this->generateUrl("f_bgroupe_accueil"));

}
      
   
}
