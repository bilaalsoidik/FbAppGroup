<?php
use Ratchet\Server\IoServer;
use webSockets\FBgroupe\FbImportProgress;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

/** 
 * @author Bilal Soidik <bilalsoidik@gmail.com>
 * @copyright (c) 2013, Bilal Soidik
 * 
 */

require dirname(__DIR__) . '/vendor/autoload.php';
require '/FBgroupe/WsImportProgress.php';

//Nous créons notre serveur websocket
echo "Demarage du serveur websocket .... \n";
$server = IoServer::factory(
//        new HttpServer(
//            new WsServer(
                new FbImportProgress()
//            )
//        )
        ,
        8080
    ); 

$server->run();

Demarage du serveur websocket .... 
Demarage du serveur reussi !!
