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
		$req = $bdd->prepare('SELECT * FROM users WHERE username = :user AND password = :pwd');
		$req->execute(array('user' => $username,'pwd'=>hash('sha256',$password)));
		$resultat = $req->fetch();
		if(!$resultat){
			$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
		}else{
			$_SESSION['username'] = $username;
	    	header("Location: ./");
		}

	}
?>

<form action="" method="post" name="login">
<h1>Connexion</h1>
<input type="text" name="username" placeholder="Nom d'utilisateur">
<input type="password" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit">
<?php if (! empty($message)) { ?>
    <p class="message"><?php echo $message; ?></p>
<?php }  ?>
</form>
<p class="box-register">Vous êtes nouveau ici? <a href="register">S'inscrire</a></p>

</body>
</html>