<?php

namespace mySocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Exception;

class WebSocketClass implements MessageComponentInterface
{
    protected $clients;
    private \DataBase $db;
    public function __construct(\DataBase $db) {
        $this->clients = array();
        $this->db = $db;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $session = new Session();
        $conn->Session = $session;
        $conn->Session->start();
        $conn->Session->set("id", "");
        $conn->Session->set("email", "");
        $conn->Session->set("lastname", "");
        $conn->Session->set("firstname", "");
        echo "new client\n";
    }

    public function onClose(ConnectionInterface $conn) {
        $sessionId = $conn->Session->getId();
        unset($this->clients[$sessionId]);
        echo "client disconnect\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo "un nouveau message\n";
            echo $msg . "\n";
            $this->checkTypeInput($from, $data);
        } else {
            echo "Erreur JSON : " . json_last_error_msg();
        }
    }

    public function onError(ConnectionInterface $conn, Exception $e) {}

    private function checkTypeInput(ConnectionInterface $from, $data) {
        if (isset($data["infoUser"])) $this->setInfoUser($from, $data["infoUser"]);
        else if (isset($data["message"])) $this->sendMessage($from, $data["message"]);
        else if (isset($data["get"])) $this->get($from, $data);
        else if (isset($data["search"])) $this->search($from, $data);
        else echo "no function fond\n";
    }

    private function sendMessage(ConnectionInterface $from, $data) {
        echo "sendMessage\n";
        if (isset($data['from']) && isset($data['to']) && isset($data['msg'])) {
            $message = $data['msg'];
            $toId = $data['to'];
            $fromId = $data['from'];

            // Capturer la session du client émetteur
            echo json_encode($this->clients);
            echo "message from id = {$fromId} to {$toId}\n";

            // Récupère le client destinataire en utilisant l'ID de session comme clé
            $recipientClient = $this->clients[$toId] ?? null;

            if ($this->db->addNewMessage($toId, $fromId, $message)) {
                if ($recipientClient)
                    $recipientClient->send(json_encode(["message" => ["msg" => $message, "from" => $fromId]]));
            }
        }
    }

    private function setInfoUser(ConnectionInterface $from, $data) {
        echo "setInfoUser\n";
        if (isset($data['id'])) {
            try {
                $from->Session->set("id", $data['id']);
                $from->Session->start();
                $this->clients[$data['id']] = $from;
            } catch(Exception $e) {
                echo "error to save id\n";
            }
            $from->send(json_encode(['connection' => ['etat' => 'ok']]));
            echo "client enregistre\n";
        }
    }

    private function search(ConnectionInterface $from, $data)
    {
        if ($data['search'] == 'newfriend' && isset($data['content'])) {
            $content = $data['content'];
            $result = $this->db->getIsClient($content['search']);
            if ($result == true) {
                $result = $this->db->getInfoClientByEmail($content['search']);
                $this->db->addNewFriend($content['id'], $result['ID_client']);
                $result = "OK";
            } else {
                $result = "KO";
            }
            $this->clients[$content['id']]->send(json_encode(['search' => ['friend' => $result]]));
        }
    }

    private function get(ConnectionInterface $from, $data) {
        if (isset($data["get"])) {
            $get = $data["get"];
            switch ($get) {
                case 'friend':
                    $this->getFriend($from, $data);
                    break;
                case 'message':
                    $this->getMessage($from, $data);
                    break;
                default:
                    echo "no function fond\n";
                    break;
            }
        }
    }

    private function getFriend(ConnectionInterface $from, $data) {
        echo "getFriend\n";
        if (isset($data['id'])) {
            $id = $data['id'];
            $friend = $this->db->getFriend($id);
            $result = [];
            while ($value = $friend->fetch()) {
                if ($value == true) {
                    echo "fetch good";
                } else echo "fetch not good";
                echo $value;
            }
                // if ($value['ID_client1'] == $id) {
                //         echo $this->db->getInfoClient($value['ID_client2']);
                //         $result[] = $this->db->getInfoClient($value['ID_client2']);
                // } else {
                //     echo $this->db->getInfoClient($value['ID_client1']);
                //     $result[] = $this->db->getInfoClient($value['ID_client1']);
                // }

            echo json_encode(['friend' => $result]);
            $from->send(json_encode(['friend' => $result]));
        }
    }

    private function getMessage(ConnectionInterface $from, $data) {
        echo "getMessage\n";
        if (isset($data['id']) && isset($data['idfrom'])) {
            $id = $data['id'];
            $idFriend = $data['idfrom'];
            $message = $this->db->getMessage($id, $idFriend);
            if ($message == true) {
                $result = [];
                while ($value = $message->fetch()) {
                    $result[] = ['msg' => $value['message'], 'from' => $value['ID_from'], 'to' => $value['ID_to']];
                }

                echo json_encode(['conversation' => $result, 'ID_from' => $idFriend]);
                $from->send(json_encode(['conversation' => $result, 'ID_from' => $idFriend]));
            } else {
                echo "no message\n";
            }
        }
    }
}
