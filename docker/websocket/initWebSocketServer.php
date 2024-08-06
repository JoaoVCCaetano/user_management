<?php

require_once 'vendor/autoload.php';
require_once 'WebSocketServer.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocketServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocketServer()
        )
    ),
    9090 // Porta para o WebSocket
);

$server->run();
