<?php
namespace FB\groupeBundle\Controller;

/**
 * @author Bilal Soidik <bilalsoidik@gmail.com>
 * @copyright (c) 2013, Bilal Soidik
 * 
 */


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\DBAL\DBALException;
use FB\groupeBundle\Entity\Utilisateur;
use FB\groupeBundle\Entity\MembreGroupe;
use FB\groupeBundle\Entity\Post;
use FB\groupeBundle\Entity\Commentaire;
use FB\groupeBundle\Entity\Historique;
use FB\groupeBundle\Entity\PersistProgressionMb;
use FB\groupeBundle\Entity\PersistProgressPst;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class ImportDataController extends Controller {
    /**
     * Mode d'importation des posts
     */
  
    const IMPORT_TOUT = 1;
    const IMPORT_DEPUIS = 2; //date de mise à jour
    const IMPORT_JUSQUA = 3; //date de mise à jour
    const IMPORT_DEP_JUSQ = 4;
    const IMPORT_DEP_JUSQ_DATE_CREAT = 5;
    const IMPORT_DEP_DATE_CREAT = 6;
    const IMPORT_JUSQ_DATE_CREAT = 7;
    
    private $facebook;
    
    /**
     * @var AbstractManagerRegistry c'est l'objet entityManager mais on utilise 
     *                               le manager car l'entity manager est deprecié 
     *                               dans les recentess version  
     */
    private $manager;
    /**
     * @var Groupe c'est l'objet groupe courant dont on fait l'importation 
     *  
     */
    private $groupe;
    
    /**
     * @var Utilisateur c'est l'utilisateur nouveau qui change à chaque 
     *                  importation d'un membre qui a posé, aimé ou commenté
     *                  chaque itération sur le boucle d'importation
     */
    
    private $new_usr;
    
    /**
     * @var Post c'est le post courant,cahangé à 
     *           chaque itération sur le boucle d'importation
     */
    private $new_post; 
    
    /**
     *@var integer Nombre designant la progression en cours une fois l'importation est fini
     */
    private $progression;
    /**
     *@var integer Nombre de poste importé une fois l'importation est fini
     */
    private $nPostImporté;
    
    /**
     *@var integer  la date depuis laquelle on va importer les post 
     *              il est exprimé en tempstime qui est le temps unix a compté 
     *              depuis le 1e Janvier 1970 à minuit.
     *              L'importation se fait depuis cette date jusqu'a une date plus proche            
     */
    private $tempstime_depuis;
    
    /**
     *@var integer  la date juqu'a laquelle on va importer les posts 
     *              il est exprimé en tempstime qui est le temps unix a compté 
     *              depuis le 1e Janvier 1970 à minuit.
     *              L'importation se fait depuis la limite ou la date depuis
     *              jusqu'a cette date.            
     */
    private $tempstime_jusqua;
    
    /**
     *@var PersistProgressionMb   l'objet qui permet le suivi en temps réel de
     *                            la progression  de l'importation des membres  
     *                            la session est vérouillé par le thread en cours      
     */
    private $progressMbPersistance;
    
    /**
     *@var PersistProgressPst  l'objet qui permet le suivi en temps réel de
     *                      la progression  de l'importation des membres
     *                      la session est vérouillé par le thread en cours        
     */
    private $progressPstPersistance;
    /**
     * Importation des membre du groupe
     * 
     * @Route("/importmembres/{id_groupe}&{nbrmembre}&{limit}", defaults={"_format": "json"} , name="import_membres")
     */
    public function importMembresAction($id_groupe, $nbrmembre, $limit=40) {

        $this->facebook = $this->get('fos_facebook.api');
        
        $this->manager = $this->getDoctrine()->getManager();

        $this->groupe = $this->manager->find("FBgroupeBundle:Groupe", $id_groupe);

        $this->progressMbPersistance=$this->manager->find("FBgroupeBundle:PersistProgressionMb", $id_groupe);
       
        //CODE POUR LE SUIVI DE LA PROGRESSION
        if(!$this->progressMbPersistance){
        $this->progressMbPersistance=new PersistProgressionMb();
        $this->progressMbPersistance->setIdGroupe($id_groupe);
        $this->manager->persist($this->progressMbPersistance);
        $this->manager->flush();
        }
        
        if (!$this->groupe) {
            $this->get('session')->getFlashBag()->add(
                    'note', "Il y a des erreurs le groupe avec id: $id_groupe  n'existe pas"
            );
            return $this->redirect($this->generateUrl("_security_check"), 301);
        }
        
        $requete = "/$id_groupe?fields=owner";
        $CreateurGb = $this->facebook->api($requete);
        $id_createur_gp = $CreateurGb["owner"]["id"];

        if (isset($id_createur_gp)) {

            $requete = "/$id_createur_gp?fields=id,name,first_name,last_name,username,gender,email,updated_time";

            $usr = $this->facebook->api($requete);

            $this->new_usr = (new Utilisateur($usr['id']))
                                    ->setNomEntier($usr['name'])
                                    ->setNom(isset($usr['last_name']) ? $usr['last_name'] : "")
                                    ->setPrenom(isset($usr['first_name']) ? $usr['first_name'] : "")
                                    ->setUsername(isset($usr['username']) ? $usr['username'] : "")
                                    ->setSexe(isset($usr['gender']) ? (($usr['gender'] == 'male') ? "M" : "F") : "")
                                    ->setEmail(isset($usr['email']) ? $usr['email'] : "");
            
            try {

                $this->manager->persist($this->new_usr);
                $this->manager->flush();
                
            } catch (DBALException $e) {
                //Si le  Manager est férmé
                
                    $this->container->get('doctrine')->resetManager();
                    $this->manager = $this->getDoctrine()->getManager();
                    $this->groupe  = $this->manager->merge($this->groupe);
                    $this->new_usr = $this->manager->merge($this->new_usr);
                    $this->progressMbPersistance=$this->manager->merge($this->progressMbPersistance);
            }

            if (!$this->groupe->getCreateur()) {
                $this->groupe->setCreateur($this->new_usr);
                $this->manager->flush();
            }
        } else {
            if (isset($CreateurGb[id]))
                return new Response("Le createur du groupe ne fait plus parti des memebres, possible qu'il a quitté le groupe");
            else
                return new Response("Pas de recupération d'information de profile depuis facebook");
        }

        $nbrImporte = 0;
        $offset = 0;
        $id_dernier_importé = "";
        $this->progression=0;
        $nbrAdmin=0;
        
    while (($offset <= $nbrmembre) ) {

        $requete = "/$id_groupe?fields=members.offset($offset).limit($limit).fields" .
                "(id,name,first_name,last_name,username,gender,email,administrator)";

        $Resultat = $this->facebook->api($requete);
        if(empty($Resultat['members']['data'])||!isset($Resultat['members']['data']))break;

        foreach ($Resultat['members']['data'] as &$membre) {

            if (isset($membre['id'])) {

            $this->new_usr = (new Utilisateur($membre['id']))
                                    ->setNomEntier($membre['name'])
                                    ->setNom(isset($membre['last_name']) ? $membre['last_name'] : "")
                                    ->setPrenom(isset($membre['first_name']) ? $membre['first_name'] : "")
                                    ->setUsername(isset($membre['username']) ? $membre['username'] : "")
                                    ->setSexe(isset($membre['gender']) ? (($membre['gender'] == 'male') ? "M" : "F") : "")
                                    ->setEmail(isset($membre['email']) ? $membre['email'] : "");

            
                    try {
                        $this->manager->persist($this->new_usr);
                        $this->manager->flush();
                    } catch (DBALException $e) {

                            $this->container->get('doctrine')->resetManager();
                            $this->manager = $this->getDoctrine()->getManager();
                            $this->groupe = $this->manager->merge($this->groupe);
                            $this->new_usr = $this->manager->merge($this->new_usr);
                            $this->progressMbPersistance=$this->manager->merge($this->progressMbPersistance);
                    }

                    $membre_gpoupe = (new MembreGroupe($this->groupe, $this->new_usr))->setEstAdmin($membre['administrator']);
               
                    try {
                        
                        $this->manager->persist($membre_gpoupe);
                        $this->manager->flush();
                        //CODE POUR LE SUIVI DE LA PROGRESSION
                        $nbrImporte++;
                        if ($membre['administrator']) $nbrAdmin++;
                        $id_dernier_importé = $this->new_usr->getId();
                        
                    } catch (DBALException $e) {

                            $this->container->get('doctrine')->resetManager();
                            $this->manager = $this->getDoctrine()->getManager();
                            $this->groupe = $this->manager->merge($this->groupe);
                            
                            //CODE POUR LE SUIVI DE LA PROGRESSION
                            $this->progressMbPersistance=$this->manager->merge($this->progressMbPersistance);                      
                            
                    }
                } 
                
                //CODE POUR LE SUIVI DE LA PROGRESSION
                $this->progression++;
                $this->progressMbPersistance->setNbrProgress($this->progression);
                $this->progressMbPersistance->setNbrMembre($nbrImporte);
                $this->progressMbPersistance->setNbrAdmin($nbrAdmin);
                $this->manager->flush();
            }//END foreach


            $offset+=$limit;
            
        }//END while
        
        if($nbrImporte!=0){
        $thisuser = $this->get('session')->get('utilisateur');

        $HistoUser = $this->manager->find("FBgroupeBundle:Historique", 
           array('idUtilisateur' => $thisuser['id'],
            'idGroupe' => $id_groupe));
        
        if (isset($HistoUser)) {
            
             $HistoUser->setDernierMembreImport($id_dernier_importé);
             $this->manager->flush();
        } else {
            
            $HistoUser = new Historique($thisuser['id'], $id_groupe);
            $HistoUser->setDernierMembreImport($id_dernier_importé);
            $this->manager->persist($HistoUser);
            $this->manager->flush();
        }
        }

        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $objetJSON=$serializer->serialize($this->progressMbPersistance, 'json');
            
        $response = new Response($objetJSON);
          
          
        //LIBRATION DES DONNEES DE SUIVIS POUR LES PROCHAINES REQUETES
        $this->progressMbPersistance->setNbrProgress(0)
                                            ->setNbrMembre(0)
                                            ->setNbrAdmin(0);
              
                $this->manager->flush();
                $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /** 
     * @Route("/importposts/{id_groupe}&{MODE_IMPORT}&{date_depuis}&{date_jusqua}&{limit}", defaults={"_format": "json"}, name="importPost")
     * @Route("/importposts/{id_groupe}&{MODE_IMPORT}&{limit}", defaults={"MODE_IMPORT" = 1,"_format": "json"},name="importTout")
     * 
     * Le mode d'importation nous permettra de connaitre la requete à executer et si la valeur est null pas de probleme
     */
    public function importPostsAction($id_groupe, $MODE_IMPORT, $date_depuis = null, $date_jusqua = null,$limit = 25) {

        $this->manager = $this->getDoctrine()->getManager();

        $this->groupe = ($this->manager->find("FBgroupeBundle:Groupe", $id_groupe));

        $this->facebook = $this->get('fos_facebook.api');
        
        $this->progressPstPersistance=$this->manager->find("FBgroupeBundle:PersistProgressPst", $id_groupe);
         
        if(!$this->progressPstPersistance){
        $this->progressPstPersistance=new PersistProgressPst();
        $this->progressPstPersistance->setIdGroupe($id_groupe);
        $this->manager->persist($this->progressPstPersistance);
        $this->manager->flush();
        }
        $this->nPostImporté = 0;
        $this->progression=0;
        
        if($MODE_IMPORT==self::IMPORT_TOUT)
            {
            /**
            *Pour le mode d'importation Import tout on va fixer la date au temps actuel 
            * pour boucler jusqu'au dernier post 
            */
            
            $this->tempstime_jusqua=  strtotime(date("c"));
            $this->tempstime_depuis=  strtotime(date("c"))-30; //On recule de 30 secondes juste pour créer la difference
     
       while($this->tempstime_jusqua!=$this->tempstime_depuis){
           
           $this->tempstime_jusqua--;
           $requete = "/$id_groupe?fields=feed.until($this->tempstime_jusqua).limit($limit)" .
                        ".fields(id,type,message,link,full_picture,source," .
                        "name,description,created_time,updated_time,from)";    
            
            $Resultat = $this->facebook->api($requete);
                    
            if(!isset($Resultat['feed']['data']))break;
            
            foreach($Resultat['feed']['data'] as $post){
                
                $this->importPost($post);
                
            }
            
            $url_precedant=$Resultat['feed']['paging']['previous'];
            $url_suivant=$Resultat['feed']['paging']['next'];
            
            $this->tempstime_depuis=  intval(Outils::paramDansURL('since', $url_precedant));
            $this->tempstime_jusqua=  intval(Outils::paramDansURL('until',$url_suivant));
            
        };//FIN WHILE
            
        }
        
        else  //IMPORTATION SELON LA DATE DE MISE A JOUR  
               if(in_array($MODE_IMPORT, array(2,3,4))) {
      
       if(isset($date_depuis)&&$date_depuis!='null') $this->tempstime_depuis = strtotime($date_depuis);
       if(isset($date_jusqua)&&$date_jusqua!='null') $this->tempstime_jusqua = strtotime($date_jusqua);
        
        switch ($MODE_IMPORT) {
         
            //Cette requette va boucler en fonction du pas
            case self::IMPORT_JUSQUA : $requete = "/$id_groupe?fields=feed.until($this->tempstime_jusqua).limit" .
                                            "($limit).fields(id,type,message,link,full_picture,source," .
                                            "name,description,created_time,updated_time,from)";
                                             break;

            case self::IMPORT_DEPUIS : $requete = "/$id_groupe?fields=feed.since($this->tempstime_depuis).limit" .
                                            "($limit).fields(id,type,message,link,full_picture,source," .
                                            "name,description,created_time,updated_time,from)";
                                             break;

            case self::IMPORT_DEP_JUSQ : $requete = "/$id_groupe?fields=feed.since($this->tempstime_depuis)" .
                                                ".until($this->tempstime_jusqua).limit(5000).fields" .
                                                "(id,type,message,link,full_picture,source," .
                                                "name,created_time,updated_time,from)";
                                              break;
        }       
           $Resultat = $this->facebook->api($requete);
            
           $nbrTotPost=count($Resultat['feed']['data']);
           $this->progressPstPersistance->setNbrTotPost($nbrTotPost)->setNbrPostImport(0);
           $this->manager->flush();
           
            foreach($Resultat['feed']['data'] as $post){
                
                $this->importPost($post);
                
            }
        } 
        
        
        else    //IMPORTATION SELON LA DATE DE CREATION
         /*==================!!!!!!ATTENTION!!!!=========================/**
        * L'importation selon la date de creation reconnait un bug sur   * 
        * facebook quand vous fournissez une date de creation de post que*
        * vous voulez selectioner les postes dont leurs date de creation *
        * sont inférieus ou supérieus alors si la date de mise à jour de *
        * ne l'est pas ne sera pas sélectioné.                           *
        *================================================================*/       
            if(in_array($MODE_IMPORT, array(5,6,7))){

        $this->tempstime_depuis = strtotime($date_depuis);
        $this->tempstime_jusqua = strtotime($date_jusqua);
        
        switch ($MODE_IMPORT) {
            //On selectione les id des posts et on boucle dessus.
            case self::IMPORT_DEP_JUSQ_DATE_CREAT : 
                        $requetFQL = "SELECT post_id FROM  stream  WHERE source_id=$id_groupe" .
                        " AND created_time<=$this->tempstime_jusqua ".
                        " AND created_time>=$this->tempstime_depuis LIMIT 5000";
                        break;

            case self::IMPORT_DEP_DATE_CREAT : 
                         $requetFQL = "SELECT post_id FROM  stream  WHERE source_id=$id_groupe" .
                        " AND created_time>=$this->tempstime_depuis LIMIT $limit";
                        break;

            case self::IMPORT_JUSQ_DATE_CREAT : 
                        $requetFQL = "SELECT post_id FROM  stream  WHERE source_id=$id_groupe" .
                        " AND created_time<=$this->tempstime_jusqua LIMIT $limit";
                        break;
        }

        $lesIdPosts = $this->facebook->api(array(
            'method' => 'fql.query',
            'query' => $requetFQL
        ));
        
        $nbrTotPosts = count($lesIdPosts);
        $this->progressPstPersistance->setNbrTotPost($nbrTotPosts)->setNbrPostImport(0);
        $this->manager->flush();


        foreach ($lesIdPosts as &$objet_post_id) {
            
              $id_post=$objet_post_id['post_id'];
              $requete = "/$id_post?fields=type,message,link,full_picture,".
                         "source,name,created_time,updated_time,from";
              
              $post= $this->facebook->api($requete);
              
              $this->importPost($post);            
        }//fin foreach sur les id des postes     
        }
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $objetJSON=$serializer->serialize($this->progressPstPersistance, 'json');
        
        //LIBERATION DES DONNEES DE SUIVI
        $this->progressPstPersistance->setNbrComImport(0)
                                            ->setNbrTotPost(0)
                                            ->setNbrProgress(0)
                                            ->setIdPost("")
                                            ->setNbrPostImport(0)
                                            ->setNbrTotComment(0)
                                            ->setNbrToJaime(0)
                                            ->setNbrJaimeImport(0);
        $this->manager->flush();
        
        return new Response($objetJSON);
    }
    /**
     * 
     * @param id_utilisateur
     * 
     */
    private function findOuCreatMembre($id_utilisateur) {
        
        $this->new_usr = $this->manager->find("FBgroupeBundle:Utilisateur", $id_utilisateur);
      
        if ($this->new_usr) {
            $membre_groupe = $this->manager->find("FBgroupeBundle:MembreGroupe", array('utilisateur' => $this->new_usr->getId(), 'groupe' => $this->groupe->getId()));
            if (!$membre_groupe) {
                
                $Resultat = $this->facebook->api(array(
                    'method' => 'fql.query',
                    'query' => "select administrator FROM group_member WHERE gid=".$this->groupe->getId()." AND uid=$id_utilisateur"
                ));
                $membre_gpoupe = (new MembreGroupe($this->groupe, $this->new_usr))->setEstAdmin($Resultat[0]['administrator']);
                $this->manager->persist($membre_gpoupe);
                $this->manager->flush();
            }
            
                
        }else {

            $requete = "/$id_utilisateur?fields=id,name,first_name,last_name,username,gender,email,updated_time";

            $usr = $this->facebook->api($requete);
            $this->new_usr = (new Utilisateur($id_utilisateur))
                                ->setNomEntier($usr['name'])
                                ->setNom(isset($usr['last_name']) ? $usr['last_name'] : "")
                                ->setPrenom(isset($usr['first_name']) ? $usr['first_name'] : "")
                                ->setUsername(isset($usr['username']) ? $usr['username'] : "")
                                ->setSexe(($usr['gender'] == 'male') ? "M" : "F")
                                ->setEmail(isset($usr['email']) ? $usr['email'] : "");
            
            $Resultat = $this->facebook->api(array(
                'method' => 'fql.query',
                'query' => "select administrator FROM group_member WHERE gid=".$this->groupe->getId()." AND uid=$id_utilisateur"
            ));

            $membre_gpoupe = (new MembreGroupe($this->groupe, $this->new_usr))->setEstAdmin($Resultat[0]['administrator']);

            $this->manager->persist($this->new_usr);
            $this->manager->persist($membre_gpoupe);
            $this->manager->flush();
   }
    }
    
    /**
     * 
     * @param array $post une ligne d'enregistrement d'un postrecuperé depuis facebook
     * 
     */
    private function importPost($post){
        
              $this->new_post = new Post($post['id']);
              $this->new_post->setType($post['type'])//Obligatoire et existe toujour si le new_post exist
                                ->setMessage(isset($post['message']) ? $post['message'] : "")
                                ->setLien(isset($post['link']) ? $post['link'] : "")
                                ->setSource(isset($post['source']) ? $post['source'] : "")
                                ->setNom(isset($post['name']) ? $post['name'] : "")
                                ->setDescription(isset($post['description']) ? $post['description'] : "")
                                ->setDateHeurCreation(new \DateTime($post['created_time']))//Obligatoire et existe toujour si le new_post exist
                                ->setDateHeurUpdate(new \DateTime($post['updated_time']));
            //Pour les photos on va remplacer just celles de type XXXXXXX_s.jpg par XXXXXXX_n.jpg pour une meilleur qualité
            if(isset($post['full_picture'])){ 
                
                $picture=$post['full_picture'];
                $photo = (substr_count($picture, "s.jpg") ? str_replace("s.jpg", "n.jpg", $picture) : $picture);
                $this->new_post->setPhoto($photo);
                
            }
            
            $this->new_post->setGroupe($this->groupe);
            
            $id_publicateur = $post['from']['id'];
            $this->findOuCreatMembre($id_publicateur);
            $this->new_post->setPublicateur($this->new_usr);
            
            $this->progressPstPersistance->setIdPost($this->new_post->getId());

            
           //On persiste le post avant ses commentaires car il faut que le post existe en BD
           try{ 
   
            $this->manager->persist($this->new_post);
            
            $this->progression++;
            $this->nPostImporté++;
            $this->progressPstPersistance->setIdPost($this->new_post->getId())
                                                ->setNbrProgress($this->progression)
                                                ->setNbrPostImport($this->nPostImporté);
            $this->manager->flush();
            
            //RECUPERATION DES JAIMES
            $this->importJaimes();
            $this->manager->flush();
            
            } catch (DBALException $e) {
                //Si l'entity Manager est férmé
                if (!$this->getDoctrine()->getEntityManager()->isOpen()) {

                    $this->container->get('doctrine')->resetManager();
                    $this->manager = $this->getDoctrine()->getManager();
                    $this->groupe = $this->manager->merge($this->groupe); 
                    $this->new_post = $this->manager->merge($this->new_post); 
                    $this->progressPstPersistance=$this->manager->merge($this->progressPstPersistance);
                    $this->nPostImporté--;
                    $this->progressPstPersistance->setNbrPostImport($this->nPostImporté);
                    $this->manager->flush();
                    }
            } 
       //RECUPERATION DES COMMENTAIRES DU POST
       $this->importCommentaires();
    }

    //A Appeler àprès l'intialisation d'un post
    //il accède au valiable du controlleur
    private function importJaimes(){
        
            $requete = "/". $this->new_post->getId()."?fields=likes.limit(5000).fields(id)";
            $ResultJaimes = $this->facebook->api($requete);

            //Si il y a des personnes qui aiment la publication
            if(isset($ResultJaimes['likes'])){
                
            $nbrTotJaime = count($ResultJaimes['likes']['data']);
            
            $this->progressPstPersistance->setNbrJaimeImport($nbrTotJaime);
             //On boucle sur les jaimes
            foreach ($ResultJaimes['likes']['data'] as &$usr_passioné) {

                $this->findOuCreatMembre($usr_passioné['id']);
                $this->new_post->addJaime($this->new_usr);
            }
            }     $this->progressPstPersistance->setNbrJaimeImport(0);  
    }
    
    //A Appeler àprès l'intialisation d'un post et importation des commentaires
    //il accède au valiable du controlleur
    private function importCommentaires(){
        
            $requete = "/".$this->new_post->getId()."?fields=comments.limit(5000).fields(id,message,like_count,created_time,from)";
            $ResultComments = $this->facebook->api($requete);
            
            if(isset($ResultComments['comments'])){
            $nbrComment = count($ResultComments['comments']['data']);
            $this->progressPstPersistance->setNbrTotComment($nbrComment);

            $nbrCommentImport = 0;
            //On boucle sur les jaimes
            foreach ($ResultComments['comments']['data'] as &$comment) {

                $commentaire=new Commentaire($comment['id']);
                $commentaire->setMessage($comment['message'])
                               ->setDateCreation(new \DateTime($comment['created_time']))
                               ->setNbrJaime($comment['like_count']);
                
                $id_commentateur=$comment['from']['id'];
                
                $this->findOuCreatMembre($id_commentateur);
                               
                $commentaire->setCommentateur($this->new_usr);          
                
                $commentaire->setPost($this->new_post);
                
            try{ 
   
            $this->manager->persist($commentaire);
            $nbrCommentImport++;
            $this->progressPstPersistance->setNbrJaimeImport($nbrCommentImport);
            $this->manager->flush();
            
            } catch (DBALException $e) {
                //Si l'entity Manager est férmé
                if (!$this->getDoctrine()->getEntityManager()->isOpen()) {

                    $this->container->get('doctrine')->resetManager();
                    $this->manager = $this->getDoctrine()->getManager();
                    $this->groupe = $this->manager->merge($this->groupe); 
                    $this->new_post = $this->manager->merge($this->new_post); 
                    $this->progressPstPersistance=$this->manager->merge($this->progressPstPersistance);
                    $nbrCommentImport--;
                }
            }              }
            }$this->progressPstPersistance->setNbrTotComment(0);
    }
    /**
     * 
     * @Route("/importposts/progress/{id_gp}" , defaults={"_format": "json"}, name="postsProgress")
     * 
     */
    
    public function progressPostsAction($id_gp){
        $em=$this->getDoctrine()->getManager();
        $this->progressPstPersistance=$em->find("FBgroupeBundle:PersistProgressPst", $id_gp);
          
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $objetJSON=$serializer->serialize($this->progressPstPersistance, 'json');
        return new Response($objetJSON);
    }
    /**
     * 
     * @Route("/importmembres/progress/{id_gp}" , defaults={"_format": "json"}, name="membresProgress")
     * 
     */
    
    public function progressMembresAction($id_gp){       
        $em=$this->getDoctrine()->getManager();
        $this->progressMbPersistance=$em->find("FBgroupeBundle:PersistProgressionMb", $id_gp);
        
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $objetJSON=$serializer->serialize($this->progressMbPersistance, 'json');
        return new Response($objetJSON);
    }
    
    
    /**
     * @Route("/importposts/vues", name="vues_importpost")
     */
    public function sendVuesImportPostAction() {
    
        return $this->render('FBgroupeBundle:FbGroupeViews:VuesImportPost.html.twig');
    }

    /** @Route("/testdate2/{time}")
     */
    public function test2DateAction($time) {


        return new Response(" date " . date("c",$time));
    }

    
    
}

//SELECT created_time,updated_time,post_id from stream WHERE source_id=568126449865957 AND created_time >=1380921300 ORDER BY created_time DESC