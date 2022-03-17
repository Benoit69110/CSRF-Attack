<?php 

session_start();
$username = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="style.css" /> -->
    </head>
    <body>
        <h1> INDEX</h1>
        <?php if(!empty($username)){ ?>
        <h2>Bienvenue à toi, <?php echo $username; ?>, tu peux à présent accéder à du contenu exclusif !</h2>
        <?php } ?>
        <ol>
            <?php if(!empty($username)){ ?>
                <li>
                    <a href='logout'>Déconnexion</a>
                </li>
                <li>
                    <a href='change/password/level1'>Modifier son mot de passe (niveau de sécurité 1)</a>
                </li>
                <li>
                    <a href='change/password/level2'>Modifier son mot de passe (niveau de sécurité 2)</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href='login'>Se connecter</a>
                </li>
                <li>
                    <a href='register'>S'inscrire</a>
                </li>
            <?php } ?>
        </ol>
    </body>
</html>
