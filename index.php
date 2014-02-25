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
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-responsive.css"/>
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
		<link rel="icon" type="image/png" href="Images/favicon.png" />
		<script type="text/javascript" src="JS/bootstrap.js"></script>
		<script type="text/javascript" src="JS/bootstrap.min.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<!----------- HEADER DEBUT ----------->
		<header>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid" style="padding-left:40px">
					<div class="navbar-header">
						<a class="navbar-brand" href="accueil.php"><b>M5F</b></a>
					</div>
				</div>
			</nav>
		</header>	
		<!----------- HEADER FIN ----------->
		<!----------- CORPS DEBUT ----------->
		<section>
			<div id="middle">
				<div id="authentification">
					<!--- FORMULAIRE DE CONNEXION --->
					<form action="Defauts/Contenu/authentification.php" method="post">
						<div class="form-inline panel panel-default">
							<div class="panel-body">
								<input type="text" name="identifiant" class="form-control" autofocus required placeholder="Identifiant" style="width:50%">
							
									
									<?php
										/* Si le mot de passe ou l'identifiant est faux, affichage d'un message d'erreur */
										if(isset($_GET['error'])){
											echo '<div class="alert alert-danger pull-right" style="width : 40%">';
											echo '<i class="glyphicon glyphicon-exclamation-sign"></i>';
											echo ' Identifiant ou mot de passe incorrect !';
											echo '</div>';
										}
									?>
								<br/><br/>
	    						<input type="password" name="password" class="form-control" required placeholder="Mot de passe" style="width:50%"><br/><br/>
	      						<button type="submit" class="btn btn-primary btn-small" name="connexion"> <i class="glyphicon glyphicon-user"></i> Connexion</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		<!----------- CORPS FIN ----------->
		<!----------- FOOTER DEBUT ----------->
		<footer>
			<div class="form-inline panel panel-default">
				<div class="panel-body">
					COPYRIGHT © - Toute la documentation disponible sur cette application est confidentielle - Marianne et les 5 fantastiques - 2013/2014
				</div>
			</div>
		</footer>
		<!----------- FOOTER FIN ----------->
	</body>
</html>