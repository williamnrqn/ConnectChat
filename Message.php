<?php session_start();
if (empty($_SESSION['id']) || empty($_SESSION['email']) || empty($_SESSION['firstname']) || empty($_SESSION['lastname'])) {
    session_destroy();
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/DALL_E_2023-05-11_11.42.29_-_je_veux_que_tu_remplace_le_text_par__ConnectChat_-removebg-preview.png">
    <link rel="stylesheet" href="css/Message.css">
    <script src="js/back/Socket.js"></script>
    <script src="js/front/Message.js"></script>
    <title>Message | ConnectChat</title>
</head>
<body>
    <div id=id style="display:none"><?= $_SESSION['id']?></div>
    <section id="main">
        <div id="nav">
            <div id="logo">
                <img src="img/DALL_E_2023-05-11_11.42.29_-_je_veux_que_tu_remplace_le_text_par__ConnectChat_-removebg-preview.png" alt="logo ConnectChat">
            </div>
            <div id="lien">
                <div id="message" class="nav-button" style="margin-top: 0;">
                    <button id="to-message" class="select"><img src="" alt=""></button>
                </div>
                <div id="friend" class="nav-button">
                    <button id="to-friend"class="no-select"><img src="" alt=""></button>
                </div>
                <div id="group" class="nav-button">
                    <button id="to-group" class="no-select"><img src="" alt=""></button>
                </div>
                <div id="setting" class="nav-button">
                    <button id="to-setting" class="no-select"><img src="" alt=""></button>
                </div>
                <div id="button-change-theme" class="nav-button" style="margin-bottom: 0;">
                    <button id="theme-toggle"><img src="" alt=""></button>
                </div>
            </div>
            <div id="img-profil-client">
                <div id="photo"></div>
            </div>
        </div>
        <div id="core">
            <div id="left">
                <div id="cherche"></div>
                <div id="clients">
                    <ul id="client-list">
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                        <li id="client" class="n"></li>
                    </ul>
                </div>
            </div>
            <div id="right">
                <div id="message">
                    <div id="degrad"></div>
                    <div id="conversation">
                        <ul id="message-list"></ul>
                    </div>
                </div>
                <div id="input">
                    <div id="input-message">
                        <input type="text" id="input-text-message">
                    </div>
                    <div id="button-send">
                    </div>
                </div>
            </div>
        </div>
        <div id="info"></div>
    </section>
    <script src="js/back/Message.js"></script>
</body>
</html>