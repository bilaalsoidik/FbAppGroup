<?php
namespace webSockets;

use Ratchet\Server\IoServer;
use webSockets\FBgroupe\FbImportProgress;

/** 
 * @author Bilal Soidik <bilalsoidik@gmail.com>
 * @copyright (c) 2013, Bilal Soidik
 * 
 */

require dirname(__DIR__) . '/vendor/autoload.php';
require '/FBgroupe/FbImportProgress.php';

//Nous créons notre serveur websocket
$server = IoServer::factory(
        new FbImportProgress(),
        8181
    );

$server->run();

