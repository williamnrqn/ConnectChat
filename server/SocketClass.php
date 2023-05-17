<?php
namespace mySocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketClass implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        // Logique lorsqu'une connexion est établie
        printf("connection du socket\n");
        $message = array(
            "message" => "test"
        );
        if (json_encode($message) != false);
        $conn->send(json_encode($message));
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Logique lorsqu'une connexion est fermée
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Logique lorsqu'un message est reçu
        $data = json_decode($msg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo $data["message"];
        } else {
            echo "Erreur JSON : " . json_last_error_msg();
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Logique en cas d'erreur
    }
}