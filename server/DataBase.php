<?php

/**
 * This PHP class is used to connect to a MySQL database and perform various operations on it.
 */ 
class DataBase
{
    public $db;

    /**
     * This is a PHP constructor function that creates a PDO object for connecting to a MySQL database with
     * error handling.
     * 
     * @param $host The host name or IP address of the MySQL server where the database is located.
     * @param $db_name The name of the database that the PDO object will connect to.
     * @param $user The username used to connect to the MySQL database.
     * @param $pass The password used to connect to the MySQL database.
     */
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

    /**
     * This PHP function checks if a given email exists in the "client" table of a database.
     * 
     * @param $email The email address of the client being checked.
     * 
     * @return boolean value. It returns true if a client with the given email exists in the database
     * table "client", and false otherwise.
     */
    public function getIsClient($email) {
        try {
            $q = $this->db->prepare("SELECT * FROM `client` WHERE `Email` = :email");
            $q->execute([
                'email' => $email
            ]);
            $result = $q->fetch();
            if ($result == true) return true;
            else return false;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * This PHP function adds a new friend relationship between two clients in a database.
     * 
     * @param $idClient1 The ID of the first client in the friend relationship.
     * @param $idClient2 The ID of the second client to be added as a friend in the database.
     * 
     * @return boolean value. It returns true if the insertion of a new friend relationship between
     * two clients (specified by their IDs) was successful, and false if there was an error (caught by
     * a PDOException) during the insertion process.
     */
    public function addNewFriend($idClient1, $idClient2)
    {
        try {
            $q = $this->db->prepare("INSERT INTO `friend`(`ID_client1`, `ID_client2`) VALUES (:idClient1, :idClient2)");
            $q->execute([
                'idClient1' => $idClient1,
                'idClient2' => $idClient2
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * This function adds a new client to a database with their first name, last name, email, and
     * password.
     * 
     * @param $firstname The first name of the new client being added to the database.
     * @param $lastname The last name of the new client being added to the database.
     * @param $password The password of the new client being added to the database.
     * @param $email The email address of the new client being added to the database.
     * 
     * @return boolean value. It returns true if the insertion of a new client into the database is
     * successful, and false if it fails.
     */
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

    /**
     * This function checks if a given email and password match a client's credentials in a database
     * and returns their information if they do.
     * 
     * @param $email string representing the email address of the client trying to log in.
     * @param $password string representing the password of the client trying to log in.
     * 
     * @return array|false value. It returns an array containing the client's ID, first name, last
     */
    public function isClient(String $email, String $password) : array|false
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

    /**
     * This PHP function adds a new message to a database table.
     * 
     * @param $idTo The ID of the recipient of the message.
     * @param $idFrom The ID of the user who is sending the message.
     * @param $msg The message that needs to be added to the database.
     * 
     * @return boolean value. It returns true if the message was successfully added to the database,
     * and false if there was an error (caught by the catch block).
     */
    public function addNewMessage($idTo, $idFrom, $msg) : bool
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

    /**
     * This PHP function retrieves a list of friends for a given client ID from a database table called
     * "friend".
     * 
     * @param $id The parameter "id" is an integer representing the ID of a client. This function
     * retrieves all the rows from the "friend" table where the ID of the client matches either the
     * "ID_client1" or "ID_client2" column.
     * 
     * @return \PDOStatement|false the result of the executed SQL query that selects all rows from the "friend" table where
     * the "ID_client1" or "ID_client2" column matches the provided "id" parameter. If the query
     * execution fails, the function returns false.
     */
    public function getFriend($id): \PDOStatement|false
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

    /**
     * This function retrieves messages between two users from a database.
     * 
     * @param $id The ID of the user who is requesting the messages.
     * @param $idFriend The ID of the friend with whom the user wants to retrieve messages.
     * 
     * @return \PDOStatement|false the result of the executed query, which is a PDOStatement object containing the selected
     * messages between two users sorted by message ID in descending order. If there is an error, the
     * function returns false.
     */
    public function getMessage($id, $idFriend) : \PDOStatement|false
    {
        try {
            $q = $this->db->prepare("SELECT * FROM `message` WHERE (`ID_from` = :id AND `ID_to` = :idFriend) OR (`ID_from` = :idFriend AND `ID_to` = :id) ORDER BY `ID_message` DESC");
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

    /**
     * This PHP function retrieves information about a client from a database based on their ID.
     * 
     * @param $idClient The parameter idClient is the unique identifier of a client in the database. The
     * function retrieves all the information related to the client with the specified idClient.
     * 
     * @return \PDOStatement|false object that contains the result set of the executed SQL query.
     */
    public function getInfoClient($idClient) : \PDOStatement|false
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

    /**
     * This PHP function retrieves client information from a database based on their email address.
     * 
     * @param $email The email address of the client whose information is being retrieved from the
     * database.
     * 
     * @return mixed the result of a SELECT query that retrieves all columns from the "client" table where
     * the "Email" column matches the provided email parameter. The function returns a single row of
     * data as an associative array or false if there was an error executing the query.
     */
    public function getInfoClientByEmail($email) : mixed
    {
        try {
            $q = $this->db->prepare("SELECT * FROM `client` WHERE `Email` = :email");
            $q->execute([
                'email' => $email
            ]);
            return $q->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }
}
