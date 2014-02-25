<?php
	session_start();
	if(isset($_SESSION['id'])){
		header("location:accueil.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Titre de l'onglet des pages web -->
		<title>PROJET KM // Base de Connaissances de Marianne et les 5 fantastiques</title>
		<meta charset="utf-8"/>
		<!-- Insertion du CSS et du Favicon -->
		<link rel="stylesheet" href="css/bouton.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/accueil.css"/>
		<link rel="stylesheet" href="css/authentification.css"/>
		<link rel="icon" type="image/png" href="Images/favicon.png" />
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<!----------- HEADER DEBUT ----------->
		<header>
				<!--- LOGO --->
				<img id="logo" src="Images/logo.png" />
		</header>	
		<!----------- HEADER FIN ----------->
		<!----------- CORPS DEBUT ----------->
		<section>
			<div id="middle">
				<div id="authentification">
					<!--- FORMULAIRE DE CONNEXION --->
					<form action="Defauts/Contenu/authentification.php" method="post">
						<table class="tabAuthen">	
							<tr class="trTabAuth">
								<td colspan="2">
									<h3>Authentification</h3>
									<hr>
									<?php
									/* Si le mot de passe ou l'identifiant est faux, affichage d'un message d'erreur */
									if(isset($_GET['error'])){
										echo"Login ou password incorrect!";
									}
									?>
								</td>
							</tr>
							
							<!--- IDENTIFIANT --->
							<tr>
								<td class="stuckRightNav">
									<label>Identifiant : </label>
								</td>
								<td>
									<input name="identifiant" type="text" class="label" />
								</td>
							</tr>
							<!--- MOT DE PASSE --->
							<tr>
								<td class="stuckRightNav">
									<label>Mot de passe : </label>
								</td>
								<td>
									<input name="password" type="password"  class="label"/><br/>
								</td>
							</tr>
						</table>
						<table class="tabAuthen" >
							<!--- BOUTON REINITIALISER ET CONNEXION --->
							<tr>
								<td class="stuckRightNav">
									<input type="reset" class="bouton" name="reinitialiser" value="Reinitialiser"/>
								</td>
								<td class="butAuthForm">
									<input type="submit" class="bouton" name="connexion" value="Connexion"/>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</section>
		<!----------- CORPS FIN ----------->
		<!----------- FOOTER DEBUT ----------->
		<footer>
			COPYRIGHT © - Toute la documentation disponible sur cette application est confidentielle - Marianne et les 5 fantastiques - 2013 
		</footer>
		<!----------- FOOTER FIN ----------->
	</body>
</html>