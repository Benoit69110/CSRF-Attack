<?php 

session_start();
$username = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="style.css" /> -->
        <!-- Custom CSS -->
        <style type="text/css">
            <?php include 'css/custom.css'; ?>
        </style>

    </head>
    <body>
        
        <svg viewBox="0 0 1400 400">
            <text id="willie" x="50%" y="50%" text-anchor="middle" fill="none">Bienvenue</text>
            <use xlink:href="#willie" class="will will1"></use>
            <use xlink:href="#willie" class="will will2"></use>
            <use xlink:href="#willie" class="will will3"></use>
            <use xlink:href="#willie" class="will will4"></use>
            <use xlink:href="#willie" class="will will5"></use>
        </svg>
    
    


        <?php if(!empty($username)){ ?>
        <h2>Bienvenue à toi, <?php echo $username; ?>, tu peux à présent accéder à du contenu exclusif !</h2>
        <?php } ?>
        <ol>
            <?php if(!empty($username)){ ?>
                <button href='logout' class="btn">Déconnexion</button>
                <button href='change/password/level1' class="btn">Modifier son mot de passe (niveau de sécurité 1)</button>
                <button href='change/password/level2' class="btn">Modifier son mot de passe (niveau de sécurité 2)</button>
            <?php } else { ?>
                
                <button href='login' class="btn">Se connecter</button>
                <button href='register' class="btn">s'inscrire</button>

            <?php } ?>
        </ol>
    </body>
</html>
