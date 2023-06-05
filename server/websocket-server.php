<?php

require 'vendor/autoload.php';
require 'SocketClass.php';
require 'DataBase.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use mySocket\WebSocketClass;
use Ratchet\App;

define('HOST', 'localhost');
define('BD_NAME', 'connectchat');
define('USER', 'root');
define('PASS', '');

$db = new DataBase(HOST, BD_NAME, USER, PASS);

$server = IoServer::factory(new HttpServer(new WsServer(new WebSocketClass($db))), 8080);

// $server->app = new App('connectchat.william-niarquin.me', 8080, '127.0.0.1', null);
$server->run();
