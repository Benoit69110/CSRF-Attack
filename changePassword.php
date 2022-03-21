<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="style.css" /> -->
        <style type="text/css">
		<?php include 'css/custom.css'; ?>
        </style>
    </head>
    <body>
        <?php
            // Connexion to the database
            require_once('manager.php');
            // Generate the csrf token if we get the page
            if($_SERVER["REQUEST_METHOD"]== 'GET'){
                $_SESSION['token'] = bin2hex(random_bytes(35));
            }
            
            // Get all attributes useful
            $username = $_SESSION['username'];
            $getPassword=$_GET['pwd'];
            $level=$_POST['level'];

            // Check if a user is connected
            if(!empty($username)){
                // If this page is called with a get parameter
                if(isset($getPassword)){
                    $getPassword = stripslashes($getPassword);
                    $getPassword = strip_tags($getPassword);
                    if($getPassword!=''){
                        // Change the password of the user with the username stored in the session cookie
                        $req = $bdd->prepare('UPDATE users SET password = :pwd WHERE username = :user');
                        try{
                            $req->execute(array('user' => $username,'pwd'=>hash('sha256',$getPassword)));
                            $message = "Votre mot de passe à bien été modifié.";
                            header("Location: ../../");
                        }catch(Exception $e){
                            $message="Une erreur est survenue. Veuillez réesayer plus tard.";
                            header("Location: ../../logout");
                        }
                    }                    
                // If this page is called with a post parameter
                }else if(isset($_POST['password'])){
                    // Check the level and eventually the csrf-token
                    if($level==1 ||
                        ($level==2 && isset($_POST['csrf-token']) && $_POST['csrf-token']==$_SESSION['token'])){

                        $password = stripslashes($_POST['password']);
                        $password = strip_tags($_POST['password']);
                        if($password==''){
                            $message="Veuillez saisir un mot de passe.";
                        }else{
                            // Change the password of the user with the username stored in the session cookie
                            $req = $bdd->prepare('UPDATE users SET password = :pwd WHERE username = :user');
                            try{
                                $req->execute(array('user' => $username,'pwd'=>hash('sha256',$password)));
                                $message = "Votre mot de passe à bien été modifié.";
                                header("Location: ../../");
                            }catch(Exception $e){
                                $message="Une erreur est survenue. Veuillez réeesayer plus tard.";
                                header("Location: ../../logout");
                            }
                        }
                        
                    }else{
                        echo $_POST['csrf-token'];
                        $message="Une erreur est survenue. Veuillez réeesayer plus tard.";
                    }
                }
            }else{
                header("Location: ../../");
            }

        ?>

        <form action="" method="post" name="register">
        <svg viewBox="0 0 500 200">
            <text id="willie" x="50%" y="50%" text-anchor="middle" fill="none">Modification MDP (Sécurité <?php echo $level ?>)</text>
            <use xlink:href="#willie" class="will will1"></use>
            <use xlink:href="#willie" class="will will2"></use>
            <use xlink:href="#willie" class="will will3"></use>
            <use xlink:href="#willie" class="will will4"></use>
            <use xlink:href="#willie" class="will will5"></use>
        </svg>
        
            <input type="password" name="password" placeholder="Nouveau mot de passe" required>
            <?php if($level==2){ ?>
                <input type="hidden" name="csrf-token" value="<?php echo $_SESSION['token'] ?>"/>
            <?php } ?>
            <input type="submit" value="Modifier" name="submit">
            <?php if (! empty($message)) { ?>
                <p class="message"><?php echo $message; ?></p>
            <?php } ?>
        </form>
        <a href="../../">Retour à la page d'accueil</a>
    </body>
</html>
