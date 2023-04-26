<?php 
	$bdd = new PDO('mysql:host=localhost;dbname=golfwithswag;charset=utf8;', 'root', ''); 
	if(isset($_POST['ok'])){
		if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) 
		&& !empty($_POST['password']) && !empty($_POST['club']) && !empty($_POST['level'])){
			$nom = htmlspecialchars($_POST['nom']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$email = htmlspecialchars($_POST['email']);
			$password = htmlspecialchars($_POST['password']);
			$club = htmlspecialchars($_POST['club']);
			$level = htmlspecialchars($_POST['level']);
			$recupUser = $bdd->prepare('SELECT * FROM membre WHERE email = ?');
			$recupUser->execute(Array($email));

			if($recupUser->rowCount() > 0){
				echo("Cet utilisateur existe déja!");
			}else{
				$insertUser = $bdd->prepare('INSERT INTO membre(nom,prenom,email,password,club,niveau) 
				VALUES(?,?,?,?,?,?)');
				$insertUser->execute(Array($nom,$prenom,$email,$password,$club,$level));
				header('Location: login.php');
			}
		}else{
			echo "Veuillez remplir tous les champs!";
			}
		}	
?>			
<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="static/css/style.css"/>
	<head>
		<meta charset="utf-8">
		<title>
			Golf With Swag - Création de compte
		</title>
	</head>
	<body id="userCreatePage">
		<header>
		</header>
		<section id="content">
			<h1 align="center">Création d'un compte</h1>
			<form action="create.php" method="POST">
				<p>
					<label for="nom">Nom : </label>
					<input name="nom" id="nom" size="30" type="text"/>
				</p>
				<p>
					<label for="prenom">Prenom : </label>
					<input name="prenom" id="prenom" size="30" type="text"/>
				</p>
				<p>
					<label for="email">Adresse e-mail : </label>
					<input name="email" id="email" size="30" type="email"/>
				</p>
				<p>
					<label for="password">Mot de passe : </label>
					<input name="password" id="password" size="30" type="password"/>
				</p>
				<p>
					<label for="club">Club : </label>
					<select name="club" id="club">
						<option value="">--Choisir un club--</option>
						<option value="1">Arras</option>
						<option value="2">Bethune</option>
						<option value="3">Parc d'Olhain</option>
						<option value="4">Amiens</option>
						<option value="5">Bondues</option>
						<option value="6">Mérignies</option>
					</select>
				</p>
				<p>
					<label for="level">Niveau : </label>
					<select name="level" id="level">
						<option value="">--Définissez votre niveau--</option>
						<option value="1">Débutant</option>
						<option value="2">Novice (Index entre 36 et 54)</option>
						<option value="3">Moyen (Index entre 18 et 36)</option>
						<option value="4">Bon (Index entre 10 et 18)</option>
						<option value="5">Très bon (Index entre 5 et 10)</option>
						<option value="6">Excellent (Index en dessous de 5)</option>
					</select>
				</p>
				<p>
					<input type="submit" name="ok" value="Créer un compte"/>
				</p>			
			</form>
		</section>
	</body>
</html>