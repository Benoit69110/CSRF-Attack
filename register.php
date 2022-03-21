<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
		<?php include 'css/custom.css'; ?>
        </style>
        <!-- <link rel="stylesheet" href="style.css" /> -->
    </head>
    <body>
        <?php
            // Connexion to the database
            require_once('manager.php');

            if(isset($_POST['username']) && isset($_POST['password'])){
                $username = stripslashes($_POST['username']);
                $username = strip_tags($_POST['username']);

                $password = stripslashes($_POST['password']);
                $password = strip_tags($_POST['password']);
                if($password == '' || $username == ''){
                    $message="Veillez à remplir tous les champs.";
                }else{
                    // Insert the new user in the table users if the username is not already used
                    $req = $bdd->prepare('INSERT INTO users VALUE (:user, :pwd)');
                    try{
                        $req->execute(array('user' => $username,'pwd'=>hash('sha256',$password)));
                        $message = "Vous avez bien été enregistré ! Vous pouvez désormais vous connecter.";
                    }catch(Exception $e){
                        $message="Veuillez choisir un autre nom d'utilisateur.";
                    }
                }
                
            }
        ?>

        <form action="" method="post" name="register">
        <svg viewBox="0 0 1400 200">
            <text id="willie" x="50%" y="50%" text-anchor="middle" fill="none">Inscription</text>
            <use xlink:href="#willie" class="will will1"></use>
            <use xlink:href="#willie" class="will will2"></use>
            <use xlink:href="#willie" class="will will3"></use>
            <use xlink:href="#willie" class="will will4"></use>
            <use xlink:href="#willie" class="will will5"></use>
        </svg>
    
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" class="myBtn" value=" Inscription " name="submit">
            <?php if (! empty($message)) { ?>
                <p class="message"><?php echo $message; ?></p>
            <?php } ?>
        </form>
        <p>Vous êtes déjà inscrit ? </br> <a class="myBtn" href="login">Se connecter</a></p>
    </body>
</html>
