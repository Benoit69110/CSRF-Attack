<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="style.css" /> -->
    </head>
    <body>
        <?php
            require_once('manager.php');

            $username = $_SESSION['username'];
            $getPassword=$_GET['pwd'];
            
            if(!empty($username)){
                if(isset($getPassword)){
                    $password = stripslashes($_POST['password']);
                    $password = strip_tags($_POST['password']);

                    //  Récupération de l'utilisateur et de son pass hashé
                    $req = $bdd->prepare('UPDATE users SET password = :pwd WHERE username = :user');
                    try{
                        $req->execute(array('user' => $username,'pwd'=>hash('sha256',$getPassword)));
                        $message = "Votre mot de passe à bien été modifié.";
                        header("Location: ../");
                    }catch(Exception $e){
                        $message="Une erreur est survenue. Veuillez réeesayer plus tard.";
                        header("Location: ../logout");
                    }
                }else if(isset($_POST['password'])){
                    $password = stripslashes($_POST['password']);
                    $password = strip_tags($_POST['password']);

                    //  Récupération de l'utilisateur et de son pass hashé
                    $req = $bdd->prepare('UPDATE users SET password = :pwd WHERE username = :user');
                    try{
                        $req->execute(array('user' => $username,'pwd'=>hash('sha256',$password)));
                        $message = "Votre mot de passe à bien été modifié.";
                        header("Location: ../");
                    }catch(Exception $e){
                        $message="Une erreur est survenue. Veuillez réeesayer plus tard.";
                        header("Location: ../logout");
                    }
                }
            }else{
                header("Location: ../");
            }
        ?>

        <form action="" method="post" name="register">
            <h1>Modification de votre mot de passe</h1>
            <input type="password" name="password" placeholder="Nouveau mot de passe">
            <input type="submit" value="Modifier" name="submit">
            <?php if (! empty($message)) { ?>
                <p class="message"><?php echo $message; ?></p>
            <?php } ?>
        </form>
        <a href="../">Retour à la page d'accueil</a>
    </body>
</html>
