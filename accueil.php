<?php
	//Démarre une session
	session_start();
	include_once "SQL/Fonctions_SQL/categorie.php";
	include_once "SQL/Fonctions_SQL/souscategorie.php";
	include_once "SQL/Fonctions_SQL/messagerie.php";
	// Si aucune session n'est en cours, l'utilisateur est redirigé vers la page d'authentification
	if(!isset($_SESSION['id'])){
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
		<!-- Titre de l'onglet des pages web -->
        <title>PROJET KM // Base de Connaissances de Marianne et les 5 fantastiques</title>
		<meta charset="utf-8"/>
		<!-- Insertion du CSS et du Favicon -->
		<link rel="stylesheet" href="css/accueil.css"/>
		<link rel="stylesheet" href="css/bouton.css"/>
		<link rel="stylesheet" href="css/sameLogs.css"/>
		<link rel="stylesheet" href="css/prism.css"/>
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
		<link rel="icon" type="image/png" href="Images/favicon.png" />
		<script type="text/javascript" src="JS/Jquery/jquery.js"></script>
        <script type="text/javascript" src="JS/Jquery/jquery.ui.js"></script>
		<script type="text/javascript" src="JS/sameLogs.js"></script>
		<script type="text/javascript" src="JS/passEmployees.js"></script>
		<script type="text/javascript" src="JS/mailBox.js"></script>
		<script type="text/javascript" src="JS/functions.js"></script>
		<script type="text/javascript" src="JS/manageMenus.js"></script>
		<script type="text/javascript" src="JS/prism.js"></script>
		<script type="text/javascript" src="JS/bootstrap.js"></script>
		<script type="text/javascript" src="JS/bootstrap.min.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
    </head>
    <body>
	<?php
		if(isset($_SESSION['sameLogs'])){
			echo '<input type="hidden" id="sameLogs" value="1"/>';
		}
		if(isset($_POST['id']) && isset($_POST['intitule'])){
		?>
			<script type="text/javascript">
				window.onload=openMessage("<?php echo $_POST['id']; ?>", "<?php echo $_POST['intitule']; ?>");
			</script>
		<?php
	}
	?>
	<!----------- HEADER DEBUT ----------->
		<header>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid" style="padding-left:40px">
    				<div class="navbar-header">
    					<a class="navbar-brand" href="accueil.php"><i class="glyphicon glyphicon-home"></i> <b>M5F</b></a>
    				</div>
    				<form class="navbar-form navbar-left" role="search">
						 <div class="form-group">
				          <input type="text" class="form-control" placeholder="Rechercher..." name="rechercher">
				        </div>
			        </form>
			<?php
				/* Selectionne les catégories par ordre d'identifiant */
				$lesCate = getAllCategorie();
				for($i = 0; $i < sizeof($lesCate); $i++){
			?>
				<!--- MENU/SOUS-MENU DEBUT --->
				<div class="menu">
					<ul class="nav navbar-nav">
						<li class="dropdown"><a href="#" class="titre_menu dropdown-toggle" data-toggle="dropdown"><?php echo $lesCate[$i]['nomCat']; ?></a>
							<ul class="dropdown-menu">
								<?php
									$SousMenu = getSousCategorieByCategorie($lesCate[$i]['idCat']);
									if(isset($SousMenu)){
										for($j = 0; $j < sizeof($SousMenu); $j++){
									?>
										<li><a href="#" onclick="javascript:goToFunction(<?php echo $SousMenu[$j]['idSousCat']; ?>)"><i class="glyphicon glyphicon-hand-right"></i>&nbsp;&nbsp;<?php echo $SousMenu[$j]['nomSousCat']; ?></a></li>
									<?php
										}
									}
								?>
							</ul>
						</li>
					</ul>
				</div>
				<!--- MENU/SOUS-MENU FIN --->
			<!--- Si administrateur > Ajout d'un bouton de gestion des menus
				  Si différent d'administrateur > Ajout d'un onglet pour contacter l'administrateur --->
			<?php
				}
				if($_SESSION['fonction'] == "Administrateur"){
			?>
				<div id="add">
					<a href="#" class="glyphicon glyphicon-plus-sign" onclick="javascript:goToManageMenusRightContent();goToManageMenusLeftContent();"></a>
				</div>
			<?php } ?>
				<div class="class="nav navbar-nav navbar-right">
					<div id="UserMenu" class="navbar-right">
				</div>
				
				<?php 
				if($_SESSION['fonction'] != "Administrateur"){
			?>			
				<div id="help">
					<a href="#" class="glyphicon glyphicon-question-sign" onclick="javascript:contactAdmin()"></a>
				</div>
			
			<?php }	?>
					</div>
				</div>
			</nav> 
		</header>
		<!----------- HEADER FIN ----------->
		<!----------- CORPS DEBUT ----------->
		<section>
			<div id="middle">
				<div class="container-fluid">
				    <div class="row-fluid" id="row">
				     		<!--- PARTIE GAUCHE DEBUT --->
					      
					       	<div class="col-md-4">
					       		<span id="titleLeftContent" class="label label-default"></span>
									<div id="LeftContent">
										<!--<h3 id="titleLeftContent">Navigation</h3>-->
									</div>
					       	</div>
					       	<!--- PARTIE GAUCHE FIN --->
							
					       	<!--- PARTIE DROITE DEBUT --->
					       	<div class="col-md-8">
					       		<span id="titleRightContent" class="label label-default"></span>
									<div id="RightContent">
										<!--<h3 id="titleRightContent">Bienvenue</h3>-->
									</div>
					      	</div>

					       
					       <!--- PARTIE DROITE FIN --->
				    </div>
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

<script type="text/javascript">
 $(document).ready(function() {
	if(document.getElementById("sameLogs")){
		$.ajax({
			url : 'Defauts/Contenu/sameLogs/pleaseModifyPassword.php',
			type :'POST', 
			success:function(data) 
			{
				$('#LeftContent').html("");
				$('#RightContent').html(data);
				openbox("Attention : veuillez modifier votre mot de passe !", 1);
			}
		});
	}
	$.ajax({
		url : 'Defauts/Contenu/WhoIsIt.php',
		type :'POST', 
		success:function(data) 
		{
			$('#UserMenu').html(data);
		}
	});
	
});
</script>