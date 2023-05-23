<?php

namespace mySocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class WebSocketClass implements MessageComponentInterface
{
    protected $clients;
    private $db;
    public function __construct($db) {
        $this->clients = new \SplObjectStorage();
        $this->db = $db;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $session = new Session();
        $conn->Session = $session;
        $this->clients->attach($conn);
    }

    public function onClose(ConnectionInterface $conn) {}

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $this->checkTypeInput($from, $data);
        } else {
            echo "Erreur JSON : " . json_last_error_msg();
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {}

    private function checkTypeInput(ConnectionInterface $from, $data) {
        if (isset($data["infoUser"])) $this->setInfoUser($from, $data["infoUser"]);
        if (isset($data["message"])) $this->sendMessage($from, $data["message"]);
    }

    private function sendMessage(ConnectionInterface $from, $data) {
        if (isset($data['to']) && isset($data['msg'])) {
            $message = $data['msg'];
            $recipientId = $data['to'];
    
            foreach ($this->clients as $client) {
                if ($client->Session->get("id") == $recipientId) {
                    $client->send(json_encode(["message" => ["msg" => $message]]));
                    break;
                }
            }
        }
    }

    private function setInfoUser(ConnectionInterface $from, $data) {
        if (isset($data['id'])) {
            $from->Session->set("id", $data["id"]);
            $from->send(json_encode(['connection' => ['etat' => 'ok']]));
        }
    }
}
