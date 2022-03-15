<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="style.css" /> -->
    </head>
    <body>
        <?php
            require_once('manager.php');

            if(isset($_POST['username']) && isset($_POST['password'])){
                $username = stripslashes($_POST['username']);
                $username = strip_tags($_POST['username']);

                $password = stripslashes($_POST['password']);
                $password = strip_tags($_POST['password']);

                //  Récupération de l'utilisateur et de son pass hashé
                $req = $bdd->prepare('INSERT INTO users VALUE (:user, :pwd)');
                try{
                    $req->execute(array('user' => $username,'pwd'=>hash('sha256',$password)));
                    $message = "Vous avez bien été enregistré ! Vous pouvez désormais vous connecter.";
                }catch(Exception $e){
                    $message="Veuillez choisir un autre nom d'utilisateur.";
                }
            }
        ?>

        <form action="" method="post" name="register">
            <h1>Inscription</h1>
            <input type="text" name="username" placeholder="Nom d'utilisateur">
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="submit" value="Inscription " name="submit">
            <p class="box-register">Vous êtes déjà inscrit ? <a href="login">Se connecter</a></p>
            <?php if (! empty($message)) { ?>
                <p class="message"><?php echo $message; ?></p>
            <?php } ?>
        </form>
    </body>
</html>
