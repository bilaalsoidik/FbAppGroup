<?php
namespace webSockets\FBgroupe;
/**
 * L'arborecente est de cette manière
 * /
 * |-----app/
 * |-----src/
 * |-----vendor/
 * |............
 * |-----webSocket/
 * |-----|--------|FBgroupe/
 * |-----|--------|--------|webSocketSrv.php    : Le fichier en cours
 * 
 * Alors pour trouver le repertoire racine on fait comme ceci
 */
 define('RACINE_PROJET', dirname(dirname(__DIR__)));
 
 require_once  RACINE_PROJET."/vendor/autoload.php";
 
 use Ratchet\MessageComponentInterface;
 use Ratchet\ConnectionInterface;

/**
 * Cette class permet de definir l'ensemble des méthodes necessaires pour
 * assurer la communication avec les websockets
 * 
 * @author Bilal Soidik <bilalsoidik@gmail.com>
 * @copyright (c) 2013, Bilal Soidik
 * 
 */
class WsImportProgress implements MessageComponentInterface {
    
  
          
  const PROGRESS_MEMBRES=10;
  const PROGRESS_POSTS=20;

  
  private $dbConn;
 
    public function __construct() {
        
        $this->clients = new \SplObjectStorage;

        $this->dbConn = mysql_connect('localhost', 'root');
        // Check connection
       if (mysqli_connect_errno($this->dbConn))
        {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
        mysql_select_db('dbfacebook',$this->dbConn);
       
    }
 
    
    
    public function onOpen(ConnectionInterface $conn) {
        // Garder le message pour envoyer les message apr_s
        $this->clients->attach($conn,$this->clients->getHash($conn));

        echo "Nouvelle connexion ! ($conn->resourceId)\n";      
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        
    /**   Je normalise mes messages comme ceci pour que je les traite
        *  $msg="{
        *         "code":CONST_CODE,
        *         "donnee":{ }
        *          }"
        */
     $enpolling=true;
     if(!$enpolling){
          echo "Rcepetion de la part de $from->resourceId \n et traitement du message\n $msg \n";
     }

        $objMsg=  json_decode($msg);
     
     if (isset($objMsg)) {
         if(isset($objMsg->code)){
         
            switch ($objMsg->code) {

                case self::PROGRESS_MEMBRES : $this->progressMembres($objMsg->donnee->id_groupe, $from);
                    break;
                case self::PROGRESS_POSTS : $this->progressPostes($objMsg->donnee->id_groupe, $from);
                
            }
     
     }
     
            }
    } 

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
     
        echo "Connection {$conn->resourceId} has disconnected\n";
        
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
    
    private function progressMembres($id_groupe,ConnectionInterface &$conn){
        
        $id_groupe=sprintf ( "%.0f", $id_groupe);   
        
        $sql="SELECT * FROM persistprogressionmb WHERE id_groupe=$id_groupe";  
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
        $data = mysql_fetch_assoc($req);
       
        //On encode l'objet en json
        $jsonObject=json_encode($data);
              
      
        $conn->send($jsonObject);
        
        
            }
            
private function progressPostes($id_groupe,ConnectionInterface &$conn){
        
        $id_groupe=sprintf ( "%.0f", $id_groupe); 

        $sql="SELECT * FROM persistprogresspst WHERE id_groupe=$id_groupe";

        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
        $data = mysql_fetch_assoc($req);
        
        //On encode l'objet en json
        $jsonObject=json_encode($data);
      
        $conn->send($jsonObject);

            }
            
   
 
    
     public function __destruct() {
         mysql_close();
    }
    
    
        
    
}
