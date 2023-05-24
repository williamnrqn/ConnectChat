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
        $conn->Session->set("id", "");
        $this->clients->attach($conn);
        echo "new client\n";
    }

    public function onClose(ConnectionInterface $conn) {
        echo "client disconnect\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo "un nouveau message\n";
            $this->checkTypeInput($from, $data);
        } else {
            echo "Erreur JSON : " . json_last_error_msg();
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {}

    private function checkTypeInput(ConnectionInterface $from, $data) {
        if (isset($data["infoUser"])) $this->setInfoUser($from, $data["infoUser"]);
        else if (isset($data["message"])) $this->sendMessage($from, $data["message"]);
        else echo "no function fond\n";
    }

    private function sendMessage(ConnectionInterface $from, $data) {
        echo "sendMessage\n";
        if (isset($data['to']) && isset($data['msg'])) {
            $message = $data['msg'];
            $recipientId = $data['to'];
            
            echo "whitch client to send message\n";
            foreach ($this->clients as $client) {
                if ($client->Session->get("id") == $recipientId) {
                    $client->send(json_encode(["message" => ["msg" => $message]]));
                    break;
                }
            }
        }
    }

    private function setInfoUser(ConnectionInterface $from, $data) {
        echo "setInfoUser\n";
        if (isset($data['id'])) {
            try {
                $from->Session->set("id", $data['id']);
            } catch(\Exception $e) {
                echo "error to save id\n";
            }
                $from->send(json_encode(['connection' => ['etat' => 'ok']]));
            echo "client enregistre\n";
        }
    }
}
