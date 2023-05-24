<?php session_start();

require 'DataBase.php';

define('HOST', 'localhost');
define('BD_NAME', 'connectchat');
define('USER', 'root');
define('PASS', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        header('Location: /#empty');
        exit;
    }
    extract($_POST);

    $db = new DataBase(HOST, BD_NAME, USER, PASS);    

    $result = $db->isClient($email, $password);

    if ($result != true) {
        header('Location: /#noClient');
        exit;
    } else {
        $_SESSION['id'] = $result['ID_client'];
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['email'] = $result['email'];
        header('Location: /message');
        exit;
    }
} else {
    header('Location: /#noPost');
    exit;
}
