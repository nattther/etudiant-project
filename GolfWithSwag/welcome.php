<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
	header('Location: index.php');
	exit;
}

$email = $_SESSION['email'];
$password = $_SESSION['password'];


$bdd = new PDO('mysql:host=localhost;dbname=golfwithswag;charset=utf8;', 'root', '');
$req = $bdd->prepare('SELECT * FROM membre WHERE email = ? AND password = ?');
$req->execute(array($email, $password));
$user = $req->fetch();
$niveau = $user['niveau'];
$req = $bdd->prepare('SELECT * FROM niveau WHERE id = ?');
$req->execute(array($niveau));
$niveau_info = $req->fetch();
$partieinfo = $user['id'];
$req = $bdd->prepare('SELECT * FROM partie WHERE membre = ?');
$req->execute(array($partieinfo));
$parties = $req->fetchAll();
$compteur = 0
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="static/css/style.css" />

<head>
	<meta charset="utf-8">
	<title>Golf With Swag - Accueil</title>
</head>

<body id="home">
	<header>
	</header>
	<section id="contentGame">
		<h1 align="center">Dernières parties</h1>
		<table>
			<tr>
				<th>Date</th>
				<th>Ville</th>
				<th>Départ</th>
				<th>Score</th>
				<th> PAR</th>
			</tr>

			<?php foreach ($parties as $partie): ?>
				<?php
				$compteur = $compteur+1;
				$clubinfo = $partie['club'];
				$req = $bdd->prepare('SELECT * FROM club WHERE id = ?');
				$req->execute(array($clubinfo));
				$club = $req->fetch();
				$pardif = $partie['score'] - $club['par'];
				if ($pardif > 0) {
					$pardif = '+' . $pardif;
				}
				$departinfo = $partie['depart'];
				$req = $bdd->prepare('SELECT * FROM depart WHERE id = ?');
				$req->execute(array($departinfo));
				$depart = $req->fetch();
				?>

				<tr>
					<td><?php echo $partie['date']; ?></td>
					<td><?php echo $club['ville']; ?></td>
					<td><?php echo $depart['libelle']; ?></td>
					<td><?php echo $partie['score']; ?></td>
					<td><?php echo $pardif; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<a href="game.php">
			<button id="addGame" type="button">Ajouter une partie</button>
		</a>
	</section>
	<section id="contentLicense">
		<h2>Nom complet : <?php echo $user['nom'] . ' ' . $user['prenom']; ?></h2>
		<h2>Nombre de parties jouées en 2023 : <?php echo $compteur; ?></h2>
		<h2>Index actuel : <?php echo $niveau_info['libelle']; ?></h2>

	</section>
</body>

</html>