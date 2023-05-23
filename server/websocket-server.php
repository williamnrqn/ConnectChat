<?php

require 'vendor/autoload.php';
require 'SocketClass.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use mySocket\WebSocketClass;

$server = IoServer::factory(new HttpServer(new WsServer(new WebSocketClass())), 8080);

$server->run();
