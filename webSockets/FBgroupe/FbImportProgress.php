<?php
namespace webSockets\FBgroupe;

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
class FbImportProgress implements MessageComponentInterface {
   public function onOpen(ConnectionInterface $conn) {
    }

    public function onMessage(ConnectionInterface $from, $msg) {
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}
