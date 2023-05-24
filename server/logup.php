<?php session_start();

require 'DataBase.php';

define('HOST', 'localhost');
define('BD_NAME', 'connectchat');
define('USER', 'root');
define('PASS', '');

if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])) {
        $db = new DataBase(HOST, BD_NAME, USER, PASS);
        $password = $_POST['password'];
        
        $hpassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        $result;
        if ($db->addNewClient($_POST['firstname'], $_POST['lastname'], $hpassword, $_POST['email']))
            $result = $db->isClient($_POST['email'], $password);
        if ($result) {
            $_SESSION['id'] = $result['ID_client'];
            $_SESSION['firstname'] = $_POST['firstname'];
            $_SESSION['lastname'] = $_POST['lastname'];
            $_SESSION['email'] = $_POST['email'];
            header('Location: /message');
            exit;
        } else {
            echo "ERROR";
        }
    } else {
        header('Location: /#coucou');
        exit;     
    }
} else {
    header('Location: /#hey');
    exit;
}