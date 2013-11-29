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
 define('DIR_ENTIES',RACINE_PROJET."/src/FB/groupeBundle/Entity");
 define('COMMUNIC_INTER_SERV',100);
 
 require_once  RACINE_PROJET."/vendor/autoload.php";
 
 use Ratchet\MessageComponentInterface;
 use Ratchet\ConnectionInterface;
 use Doctrine\ORM\Tools\Setup;
 use Doctrine\ORM\EntityManager;
/**
 * Cette class permet de definir l'ensemble des méthodes necessaires pour
 * assurer la communication avec les websockets
 * 
 * @author Bilal Soidik <bilalsoidik@gmail.com>
 * @copyright (c) 2013, Bilal Soidik
 * 
 */
class WsImportProgress implements MessageComponentInterface {
    
  protected $clients;
  private $paths = array(DIR_ENTIES);
  private $isDevMode = false;
  private $entityManager;
          
  const PROGRESS_MEMBRES=10;
  const PROGRESS_POSTS=20;
  
  
  private $dbConn;
  private $nbrC;
    public function __construct() {
        
           $this->clients = new \SplObjectStorage;
           
           $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'dbfacebook',
                );

    $config = Setup::createAnnotationMetadataConfiguration($this->paths, $this->isDevMode);
    $this->entityManager = EntityManager::create($dbParams, $config);

        $this->dbConn = mysql_connect('localhost', 'root');
        // Check connection
       if (mysqli_connect_errno($this->dbConn))
        {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
        mysql_select_db('dbfacebook',$this->dbConn);
        $this->connAccepted=array();
        $this->nbrC=0;
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
      echo "Rcepetion de la part de $from->resourceId \n";

      $objMsg=  json_decode($msg);
      
     if (isset($objMsg)) {

         if($objMsg->code!=COMMUNIC_INTER_SERV){
     

        if((!isset($this->connAccepted[$from->resourceId]))||!$this->clients->contains($from)){
        
                $this->initialisation($from,$msg);
            
        }
     
    
            switch ($objMsg->code) {

                case self::PROGRESS_MEMBRES : $this->progressMembres($objMsg->donnee->id_groupe, $from);
                    break;
                case self::PROGRESS_POSTS : $this->progressPostes($objMsg->donnee->id_groupe, $from);
            }
     }
     else { //Traitement des requêtes internes sur le serveur
       /*  $msg="{
        *         "code":CONST_CODE,
        *         "donnee":{ "hashClient":""
        *                    "data"      : "formatjsont"}
        *          }"
        */
         if(isset($objMsg->donnee->hashClient)){
         
        $clientCible=null;
        $this->clients->rewind();
        
        while($this->clients->valid()){
           
         if($this->clients->getHash($this->clients->current())){
             $clientCible=$this->clients->current();
         }
         $this->clients->next();
         }
         
         if ($clientCible != null) {
                        $clientCible->send($objMsg->donnee->data);
                    }
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
            
   
 private $connAccepted;
 public function initialisation(&$from,$msg){      
      $donTemp = explode("\n",$msg); 
      $entetes=array();
      $entetes[0]=$donTemp[0];
      
      for($i=1;$i<count($donTemp);$i++){
          
         $tab=explode(":",$donTemp[$i]);
         if (count($tab) <= 1) {break;}
            $entetes[$tab[0]]=  trim($tab[1]);
      }
      $subProtocol = (isset($entetes['Sec-WebSocket-Protocol'])) ? $this->checkWebsocProtocol($entetes['Sec-WebSocket-Protocol']) : "";
      $extensions = (isset($entetes['Sec-WebSocket-Extensions'])) ?$this->checkWebsocExtensions($entetes['Sec-WebSocket-Extensions']) : "";
      $CleAccept=$this->creationCleAccept($entetes["Sec-WebSocket-Key"]) ;
      $reponse ="HTTP/1.1 101 Switching Protocols\r\nUpgrade: websocket\r\n".
                "Connection: Upgrade\r\nSec-WebSocket-Accept: $CleAccept\r\n$subProtocol$extensions\r\n";
                
      echo "Voici la reponse \n$reponse \r\n\r\n";
      $this->connAccepted[$from->resourceId]=true;
      $hashClient=$this->clients->getHash($from);
      
      $from->send($reponse."#$hashClient#\r\n");
      
      echo "Etablissement de la connextion avec $from->resourceId \n";
      
    
    }
    
     public function __destruct() {
         mysql_close();
    }
    
    function creationCleAccept($cleClient){
     
        $magicGUID = "258EAFA5-E914-47DA-95CA-C5AB0DC85B11";
        $webSocketKeyHash = sha1($cleClient.$magicGUID);
		$rawToken = "";
		for ($i = 0; $i < 20; $i++) {
			$rawToken .= chr(hexdec(substr($webSocketKeyHash,$i*2, 2)));
		}
        $handshakeToken = base64_encode($rawToken) . "\r\n";
        return $handshakeToken;
    }
       protected function checkWebsocProtocol($protocol) {
		return true; // Override and return false if a protocol is not found that you would expect.
	}

	protected function checkWebsocExtensions($extensions) {
		return true; // Override and return false if an extension is not found that you would expect.
	}
        
        /*

         * 
         * 
         * $webSocketKeyHash = sha1($headers['sec-websocket-key'] . $magicGUID);

		$rawToken = "";
		for ($i = 0; $i < 20; $i++) {
			$rawToken .= chr(hexdec(substr($webSocketKeyHash,$i*2, 2)));
		}
		$handshakeToken = base64_encode($rawToken) . "\r\n";
         *          */
    /*
  
 */
    
}
