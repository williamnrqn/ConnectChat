<?php session_start();
if (empty($_SESSION['id']) || empty($_SESSION['email']) || empty($_SESSION['firstname']) || empty($_SESSION['lastname'])) {
    session_destroy();
    header("Location: /");
    exit;
}

require 'server/DataBase.php';

define('HOST', 'localhost');
define('BD_NAME', 'connectchat');
define('USER', 'root');
define('PASS', '');

$db = new DataBase(HOST, BD_NAME, USER, PASS);

$db = $db->db;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta property="og:William Niarquin" content="ConnectChat">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <meta name="theme-color" content="dark light">
    <meta name="robots" content="noarchive">
    <meta name="description" content="ConnectChat est un site de messagerie instantanée qui vous permet de discuter avec vos amis et votre famille.">
    <link rel="shortcut icon" href="img/DALL_E_2023-05-11_11.42.29_-_je_veux_que_tu_remplace_le_text_par__ConnectChat_-removebg-preview.png">
    <link rel="stylesheet" href="css/Message.css">
    <script src="js/back/Socket.js"></script>
    <script src="js/front/Message.js"></script>
    <script src="js/front/friend.js"></script>
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
                    <button id="to-message" class="select-img"><img src="img/message.png" alt=""></button>
                </div>
                <div id="friend" class="nav-button">
                    <button id="to-friend"class="no-select-img"><img src="img/ajouter-un-utilisateur.png" alt=""></button>
                </div>
                <div id="group" class="nav-button">
                    <button id="to-group" class="no-select-img"><img src="img/groupe.png" alt=""></button>
                </div>
                <div id="setting" class="nav-button">
                    <button id="to-setting" class="no-select-img"><img src="img/parametres.png" alt=""></button>
                </div>
                <div id="button-change-theme" class="nav-button" style="margin-bottom: 0;">
                    <button id="theme-toggle" class="no-select-img"><img src="img/jour-et-nuit.png" alt=""></button>
                </div>
            </div>
            <div id="img-profil-client">
                <div id="photo"></div>
            </div>
        </div>
        <div id="core-message">
            <div id="left">
                <div id="cherche"></div>
                <div id="clients">
                    <ul id="client-list">
                        <?php
                        $q = $db->prepare("SELECT * FROM `friend` WHERE `ID_client1` = :id OR `ID_client2` = :id");
                        $q->execute(['id' => $_SESSION['id']]);

                        while ($result = $q->fetch()) {
                            if ($result['ID_client1'] == $_SESSION['id']) {
                                $q2 = $db->prepare("SELECT * FROM `client` WHERE `ID_client` = :id");
                                $q2->execute([
                                    'id' => $result['ID_client2']
                                ]);
                                $result2 = $q2->fetch();
                                ?>
                                <li id="<?= $result2['ID_client']?>" class="n" onclick="openMessage(<?= $result2['ID_client']?>)">
                                    <div id="photo"></div>
                                    <div id="name"><?= ucfirst($result2['firstName']) . " " . ucfirst($result2['lastName'])?></div>
                                </li>
                                <?php
                            } else {
                                $q2 = $db->prepare("SELECT * FROM `client` WHERE `ID_client` = :id");
                                $q2->execute([
                                    'id' => $result['ID_client1']
                                ]);
                                $result2 = $q2->fetch();
                                ?>
                                <li id="<?= $result2['ID_client']?>" class="n" onclick="openMessage(<?= $result2['ID_client']?>)">
                                    <div id="photo"></div>
                                    <div id="name"><?= ucfirst($result2['firstName']) . " " . ucfirst($result2['lastName'])?></div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="right">
                <div id="message">
                    <div id="degrad"></div>
                    <div id="conversation">
                        <div id="id_from" style="display: none"></div>
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
        <div id="core-friend" style="display :none;">
            <div id="up">
                <div id="friend">
                    <button id="list-friend" class="select">Amis</button>
                </div>
                <div id="online">
                    <button id="list-online" class="no-select">En ligne</button>
                </div>
                <div id="attent">
                    <button id="list-attent" class="no-select">En attente</button>
                </div>
                <div id="newFriend">
                    <button id="list-newFriend" class="no-select">Ajouter</button>
                </div>
            </div>
            <div id="down-friend">
                <div id="search">
                    <input type="text" id="search-friend" class="search" placeholder="Rechercher un ami">
                </div>
                <div id="client">
                    <ul id="client-list-friend">
                        <?php
                        $q = $db->prepare("SELECT * FROM `friend` WHERE `ID_client1` = :id OR `ID_client2` = :id");
                        $q->execute(['id' => $_SESSION['id']]);

                        while ($result = $q->fetch()) {
                            if ($result['ID_client1'] == $_SESSION['id']) {
                                $q2 = $db->prepare("SELECT * FROM `client` WHERE `ID_client` = :id");
                                $q2->execute([
                                    'id' => $result['ID_client2']
                                ]);
                                $result2 = $q2->fetch();
                                ?>
                                <li id="client" class="n" onclick="openMessage(<?= $result2['ID_client']?>)">
                                    <div id="photo"></div>
                                    <div id="name"><?= ucfirst($result2['firstName']) . " " . ucfirst($result2['lastName'])?></div>
                                </li>
                                <?php
                            } else {
                                $q2 = $db->prepare("SELECT * FROM `client` WHERE `ID_client` = :id");
                                $q2->execute([
                                    'id' => $result['ID_client1']
                                ]);
                                $result2 = $q2->fetch();
                                ?>
                                <li id="client" class="n" onclick="openMessage(<?= $result2['ID_client']?>)">
                                    <div id="photo"></div>
                                    <div id="name"><?= ucfirst($result2['firstName']) . " " . ucfirst($result2['lastName'])?></div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="down-attent" style="display: none"></div>
            <div id="down-newFriend" style="display: none">
                <div id="search">
                    <input type="email" id="search-newFriend" placeholder="Tu peux rechercher des amis grâce a leur E-mail">
                </div>
                <div id="search-status">
                    <div id="search-status-text" class></div>
                </div>
                <div id="client-want-to-add">
                    <ul id="client-want-to-add-list"></ul>
                </div>
            </div>
        </div>
        <div id="core-group" style="display: none;"></div>
        <div id="core-seting" style="display: none;">
            <div id="page">
                <div id=title>Paramètres Utilisateur</div>
                <div id="content">
                    <div id="profil">
                        <div id="title-1">Information</div>
                        <div id="info">
                            <div id="name">
                                <div id="name-text"><?= ucfirst($_SESSION['firstname']) . " " . ucfirst($_SESSION['lastname'])?></div>
                            </div>
                            <div id="email">
                                <div id="email-text"><?= $_SESSION['email']?></div>
                            </div>
                        </div>
                    </div>
                    <div id="change">
                        <div id="change-password">
                            <div id="title-1">Changer de mot de passe</div>
                            <div id="content">
                                <div id="old-password">
                                    <input type="password" class="password" id="old-password-input" placeholder="Ancien mot de passe">
                                </div>
                                <div id="new-password">
                                    <input type="password" class="password" id="new-password-input" placeholder="Nouveau mot de passe">
                                </div>
                                <div id="confirm-password">
                                    <input type="password" class="password" id="confirm-password-input" placeholder="Confirmer le nouveau mot de passe">
                                </div>
                                <div id="button">
                                    <button id="change-password-button">Changer</button>
                                </div>
                            </div>
                        </div>
                        <div id="change-photo">
                            <div id="title-1">Changer de photo de profil</div>
                            <div id="content">
                                <div id="photo">
                                    <div id="photo-profil"></div>
                                </div>
                                <div id="button">
                                    <button id="change-photo-button">Changer</button>
                                </div>
                            </div>
                        </div>
                        <div id="delete-account">
                            <div id="title-1">Supprimer le compte</div>
                            <div id="content">
                                <div id="button">
                                    <button id="delete-account-button">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="info"></div>
    </section>
    <script src="js/back/Message.js"></script>
    <script src="js/back/friend.js"></script>
</body>
</html>