<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=golfwithswag;charset=utf8;', 'root', '');
if(isset($_POST['connexion'])){
	if(!empty($_POST['email']) AND !empty($_POST['password'])){
		$email = htmlspecialchars($_POST['email']);
		$password = $_POST['password'];
		$recupUser = $bdd->prepare('SELECT * FROM membre WHERE email = ? AND password = ?');
		$recupUser->execute(Array($email, $password));

		if($recupUser->rowCount() > 0){
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			$_SESSION['id'] = $recupUser->fetch()['id'];
			header('Location: welcome.php');
		}else{
			echo("Votre mot de passe ou identifiant est incorrect!");
		}
	}
	else{
		echo("Veuillez completer tous les champs!");
	}
}
