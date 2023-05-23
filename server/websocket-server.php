<?php

require 'vendor/autoload.php';
require 'SocketClass.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use mySocket\WebSocketClass;

define('HOST', 'localhost');
define('BD_NAME', 'connectchat');
define('USER', 'root');
define('PASS', '');

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . BD_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
    exit (84);
}

$server = IoServer::factory(new HttpServer(new WsServer(new WebSocketClass($db))), 8080);

$server->run();
