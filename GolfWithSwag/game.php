<!DOCTYPE html>
<?php
session_start();

$bdd = mysqli_connect('localhost', 'root', '', 'golfwithswag');
if (isset($_POST['ajouter'])) { 
    $club = $_POST['club'];
    $depart = $_POST['start'];
	$id = $_SESSION['id'];
    $scores = array();
    for ($i = 1; $i <= 18; $i++) {
        $scores[$i] = $_POST['score'.$i];
    }

		if (empty($club) || empty($depart) || in_array('', $scores)) {
			echo "Veuillez remplir tous les champs obligatoires";
			return;
		}

    $total_score = array_sum($scores);

    $query = "INSERT INTO partie (club, score, membre, date, depart) 
              VALUES ('$club','$total_score','$id',NOW(),'$depart')";
    mysqli_query($bdd, $query);

    header('Location: welcome.php');
}
?>
<html>
<link rel="stylesheet" type="text/css" href="static/css/style.css" />

<head>
	<meta charset="utf-8">
	<title>
		Golf With Swag - Saisir une partie
	</title>
</head>

<body id="userGameEntry">
	<header>
	</header>
	<section id="content">
		<h1>Nouvelle partie</h1>
		<form method="POST">
			<p>
				<label for="club">Club : </label>
				<select name="club" id="club">
					<option value="">--Choisir un golf--</option>
					<option value="1">Arras</option>
					<option value="2">Bethune</option>
					<option value="3">Parc d'Olhain</option>
					<option value="4">Amiens</option>
					<option value="5">Bondues</option>
					<option value="6">Mérignies</option>
				</select>
			</p>
			<p>
				<label for="start">Départ : </label>
				<select name="start" id="start">
					<option value="">--Choisir un départ--</option>
					<option value="1">Rouges</option>
					<option value="2">Bleus</option>
					<option value="3">Jaunes</option>
					<option value="4">Blancs</option>
					<option value="5">Noirs</option>
				</select>
			</p>

		<h2>Carte des scores :</h2>
		<h3>Aller (Trou 1 à 9) : </h3>

		<table>
			<tr>
				<th scope="leftrow">Trou</th>
				<th scope="hole">1</th>
				<th scope="hole">2</th>
				<th scope="hole">3</th>
				<th scope="hole">4</th>
				<th scope="hole">5</th>
				<th scope="hole">6</th>
				<th scope="hole">7</th>
				<th scope="hole">8</th>
				<th scope="hole">9</th>
			</tr>
			<tr>
				<th scope="leftrow">Score</th>
				<td>
					<div class="header-label"></div><input type="text" name="score1">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score2">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score3">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score4">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score5">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score6">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score7">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score8">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score9">
				</td>

			</tr>
		</table>
		<h3>Retour (Trou 10 à 18) : </h3>
		<table>
			<tr>
				<th scope="leftrow">Trou</th>
				<th scope="hole">10</th>
				<th scope="hole">11</th>
				<th scope="hole">12</th>
				<th scope="hole">13</th>
				<th scope="hole">14</th>
				<th scope="hole">15</th>
				<th scope="hole">16</th>
				<th scope="hole">17</th>
				<th scope="hole">18</th>
			</tr>
			<tr>
				<th scope="leftrow">Score</th>
				<td>
					<div class="header-label"></div><input type="text" name="score10">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score11">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score12">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score13">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score14">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score15">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score16">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score17">
				</td>
				<td>
					<div class="header-label"></div><input type="text" name="score18">
				</td>

			</tr>
		</table>
		<p align="center">
			<input type="submit" value="Valider la carte" name="ajouter" />
		</p>
		</form>
	</section>

</body>

</html>