<?php
	session_start();
	include_once "../../SQL/Fonctions_SQL/messagerie.php";
?>
<ul class="nav navbar-nav">
	<li class="dropdown">
		<a href="#" class="titre_menu dropdown-toggle" data-toggle="dropdown">
			<?php
				if($_SESSION['fonction'] == "Administrateur"){
					$notRead = countMessNotRead();
					echo "<span title='Messages non lus' class='badge'>".$notRead."</span>&nbsp;";
				}
				echo $_SESSION['nom'];
			?>
		</a>
		<ul class="dropdown-menu">
			<?php
				if($_SESSION['fonction'] == "Administrateur"){
			?>
				<li>
					<a href="#" style="margin-top : 2px;" onclick="javascript:goToMailBoxRightContent('allMessages');goToMailBoxLeftContent()">
						 <i class="glyphicon glyphicon-envelope"></i> Ma Messagerie
					</a>
				</li>
				<li>
					<a href="#" onclick="javascript:goToPage();goToPageLeft()">
						<i class="glyphicon glyphicon-wrench"></i> Gérer les mots de passe
					</a>
				</li>
			<?php
				}else if($_SESSION['fonction'] == "Contributeur"){
			?>
				<li>
					<a href="#" onclick="javascript:seeMyAsking()">
						<i class="glyphicon glyphicon-wrench"></i> Gérer mes demandes
					</a>
				</li>
			<?php
				}
			?>
			<li><a href="Defauts/Contenu/deconnexion.php"><i class="glyphicon glyphicon-off"></i> Déconnexion</a></li>
		</ul>
	</li>
</ul>