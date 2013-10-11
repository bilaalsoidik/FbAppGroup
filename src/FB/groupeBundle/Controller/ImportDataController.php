<?php

namespace FB\groupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Response;
use FB\groupeBundle\Entity\Utilisateur;
use FB\groupeBundle\Entity\Groupe;
class ImportDataController extends Controller
{
    
    /**
     * 
     * @Route("/Init_Groupes/importMembres/{id_groupe}&{nbrmembre}&{pas}", name="importMb")
     */
    public function importMembresAction($id_groupe,$nbrmembre, $pas){
         
        $em=$this->getDoctrine()->getManager(); 
        $groupe= ($em->find("FBgroupeBundle:Groupe", $id_groupe));
        
        if (!$groupe) {
        throw $this->createNotFoundException(
            'Le groupe n\'existe pas id veuiller l\'enregistrer '.$id_groupe
        );}
        
        
        $facebook = $this->get('fos_facebook.api');
        $CreateurGb=$facebook->api('/'.$id_groupe.'?fields=owner');
        $id_createur_gp = $CreateurGb["owner"]["id"];
        
        if(isset($id_createur_gp)){
            
     $usr = $facebook->api(
     '/'.$id_createur_gp.'?fields=id,name,first_name,last_name,username,gender,email');
        
        $utilisateur=new Utilisateur();
        $utilisateur->setId($id_createur_gp)
                       ->setNomEntier($usr['name'])
                       ->setNom(isset($usr['last_name']) ? $usr['last_name'] : "")
                       ->setPrenom(isset($usr['first_name']) ? $usr['first_name'] : "")
                       ->setUsername(isset($usr['username']) ? $usr['username']: "")
                       ->setSexe(($usr['gender']=='male') ? "M" : "F")
                       ->setEmail(isset($usr['email']) ? $usr['first_name'] : "");
        $em->persist($utilisateur);
        $groupe->setCreateur($utilisateur);
        
        try{
        $em->flush();
        }  catch (DBALException $e){
            $this->get('session')->getFlashBag()->add(
            'note',
            "Il y a des erreurs : $e" 
        );
            return $this->redirect($this->generateUrl("_security_check"),301);
        }
        
        //Enregistrement du nombre déja ajouté pour le suivi.
        $this->get('session')->set('nbrMbr', 1);
        $this->get('session')->set('nbAdmin', 1);
        }
        else{
            if(isset($CreateurGb[id]))
                return new Response("Le createur du groupe ne fait plus parti des memebres");
            else
            return new Response("Pas de recupération d'information de profile depuis facebook");
        }
        
     $encore=true; $nombreImpoté=0; $nbrSurPas=0;
    while($encore && ($nbrmembre<=$nombreImpoté)){
      
        
      }
    }
}
