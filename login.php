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
		<?php
			// Connexion to the database
			require_once('manager.php');
			
			if(isset($_POST['username']) && isset($_POST['password'])){
				$username = stripslashes($_POST['username']);
				$username = strip_tags($_POST['username']);

				$password = stripslashes($_POST['password']);
				$password = strip_tags($_POST['password']);

				// Check if the username and the password correspond to a user in the database
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
		<svg viewBox="0 0 1600 200">
            <text id="willie" x="50%" y="50%" text-anchor="middle" fill="none">Connexion</text>
            <use xlink:href="#willie" class="will will1"></use>
            <use xlink:href="#willie" class="will will2"></use>
            <use xlink:href="#willie" class="will will3"></use>
            <use xlink:href="#willie" class="will will4"></use>
            <use xlink:href="#willie" class="will will5"></use>
        </svg>
		
			<input type="text" name="username" placeholder="Nom d'utilisateur" required>
			<input type="password" name="password" placeholder="Mot de passe" required>
			<input type="submit" class="myBtn" value=" Connexion " name="submit">
			<?php if (! empty($message)) { ?>
				<p class="message"><?php echo $message; ?></p>
			<?php }  ?>
		</form>
		<p>Vous êtes nouveau ici? <a class="myBtn" href="register">S'inscrire</a></p>

	</body>
</html>