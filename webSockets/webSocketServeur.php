<?php
use Ratchet\Server\IoServer;
use webSockets\FBgroupe\WsImportProgress;

    require __DIR__. '/FBgroupe/WsImportProgress.php';

    $server = IoServer::factory(
        new WsImportProgress(),
        8080
    );
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

