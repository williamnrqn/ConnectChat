<?php session_start();
    if (!empty($_SESSION['email']) && !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])) {
        header('Location: /message');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="dark light">
    <meta name="robots" content="noarchive">
    <meta name="description" content="ConnectChat est un site de messagerie instantanée qui vous permet de discuter avec vos amis et votre famille.">
    <link rel="shortcut icon" href="img/DALL_E_2023-05-11_11.42.29_-_je_veux_que_tu_remplace_le_text_par__ConnectChat_-removebg-preview.png">
    <title>Connection | ConnectChat</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section id="connection" class="test transition-appear">
            <div id="T1" class="title" style="display: flex;">
                <p id="title-p">Connection</p>
                <div></div>
            </div>
            <div id="T2" class="title" style="display: none;">
                <p id="title-p">Inscription</p>
                <div></div>
            </div>
            <div class id="form" style="display: block;">
                <form action="server/login.php" method="post">
                    <div>
                        <label for="email">E-Mail</label>
                        <input type="email" name="email" class="input" id="email" required>
                    </div>
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="input" id="password" required>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Se connecter" id="send">
                    </div>
                </form>
            </div>
            <div id="form2" style="display: none;">
                <form action="server/logup.php" method="post">
                    <div id="form">
                        <div>
                            <div>
                                <label for="firstName">Nom</label>
                                <input type="text" name="lastname" class="input" id="lastname" required>
                            </div>
                            <div>
                                <label for="firstName">Prénom</label>
                                <input type="text" name="firstname" class="input" id="firstname" required>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="firstName">E-Mail</label>
                                <input type="email" name="email" class="input" id="email" required>
                            </div>
                            <div>
                                <label for="firstName">Mot de passe</label>
                                <input type="password" name="password" class="input" id="password" required>
                            </div>
                        </div>
                    </div>
                    <div id="button">
                        <input type="submit" name="submit" value="S'inscrire" id="send"   >
                    </div>
                </form>
            </div>
            <div id="lien-ex1" style="display: flex;">
                <div></div>
                <p>Créer un compte</p>
            </div>
            <div id="lien-ex2" style="display: none;">
                <div></div>
                <p>Déjâ un compte ?</p>
            </div>
    </section>
</body>
<script src="js/front/login.js">
</script>
</html>