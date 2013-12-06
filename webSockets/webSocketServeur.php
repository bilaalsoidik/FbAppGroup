<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use webSockets\FBgroupe\WsImportProgress;

    require_once __DIR__. '/FBgroupe/WsImportProgress.php';



    $server = IoServer::factory(
            new HttpServer(
            new WsServer(
                new WsImportProgress()
            )
        ),
        8080
    );
    echo "Demarage du serveur WebSocket\n";
    $server->run();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

