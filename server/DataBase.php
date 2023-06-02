<?php

class DataBase
{
    private $db;

    public function __construct($host, $db_name, $user, $pass)
    {
        try {
            $this->db = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e;
            exit;
        }
    }

    public function addNewClient($firstname, $lastname, $password, $email)
    {
        try {
            $q = $this->db->prepare("INSERT INTO `client`(`lastName`, `firstName`, `Email`, `Password`) VALUES (:lastname, :firstname, :email, :password)");
            $q->execute([
                'lastname'  => $lastname,
                'firstname' => $firstname,
                'email'     => $email,
                'password'  => $password
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function isClient(String $email, String $password)
    {
        if (empty($password)) return false;
        if (empty($email)) return false;
        $q = $this->db->prepare("SELECT * FROM `client` WHERE `Email` = :email");
        $q->execute([
            'email'     => $email
        ]);

        $result = $q->fetch();
        if ($result == true) {
            if (password_verify((String)$password, (String)$result['Password'])) {
                return [
                    'ID_client' => $result['ID_client'],
                    'firstname' => $result['firstName'],
                    'lastname' => $result['lastName'],
                    'email' => $result['Email']
                ];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function addNewMessage($idTo, $idFrom, $msg)
    {
        try {
            $q = $this->db->prepare("INSERT INTO `message`(`ID_from`, `ID_to`, `message`) VALUES (:ID_from, :ID_to, :msg)");
            $q->execute([
                'ID_from' => $idFrom,
                'ID_to' => $idTo,
                'msg' => $msg
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getFriend($id)
    {
        try {
            $q = $this->db->prepare("SELECT * FROM `friend` WHERE `ID_client1` = :id OR `ID_client2` = :id");
            $q->execute([
                'id' => $id
            ]);
            return $q;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getMessage($id, $idFriend)
    {
        try {
            $q = $this->db->prepare("SELECT * FROM `message` WHERE (`ID_from` = :id AND `ID_to` = :idFriend) OR (`ID_from` = :idFriend AND `ID_to` = :id)");
            $q->execute([
                'id' => $id,
                'idFriend' => $idFriend
            ]);
            $result = $q;
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getInfoClient($idClient)
    {
        try {
            $q = $this->db->prepare("SELECT * FROM `client` WHERE `ID_client` = :idClient");
            $q->execute([
                'idClient' => $idClient
            ]);
            return $q;
        } catch (PDOException $e) {
            return false;
        }
    }
}


