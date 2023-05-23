<?php

require 'vendor/autoload.php';
require 'SocketClass.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use mySocket\WebSocketClass;

define('HOST', 'http://dbvz3741.odns.fr:3306');
define('BD_NAME', 'dbvz3741_ConnectChat');
define('USER', 'dbvz3741_admin');
define('PASS', 'K~llKJ20&MRa');

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . BD_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
    exit (84);
}

$server = IoServer::factory(new HttpServer(new WsServer(new WebSocketClass($db))), 8080);

$server->run();
