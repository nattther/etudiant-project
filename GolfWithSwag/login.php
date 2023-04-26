<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="static/css/style.css"/>
	<head>
		<meta charset="utf-8">
		<title>
			Golf with Swag - Connexion
		</title>
	</head>
	<body id="loginPage">
		<header>
		</header>
		<section id="content">
			<h1 align="center">Connexion</h1>
			<form action="log.php" method="POST">
				<p>
					<label for="email">Adresse e-mail : </label>
					<input name="email" id="email" size="30" type="email"/>
				</p>
				<p>
					<label for="password">Mot de passe : </label>
					<input name="password" id="password" size="30" type="password"/>
				</p>
				<p>
					<input type="submit" value="Se connecter" name="connexion"/>
					<a href="create.php">Créer un compte </a>
				</p>
			</form>
		</section>
	</body>
</html>