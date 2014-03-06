<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	//intituleDoc, idReference, date, description, exemple, lienTelechargement
	$idReference = $_POST['idReference'];
	$infos = getFunctionBySousCategorie($idReference);
	$findLink = findLink($idReference);
?><br/>
<link rel="stylesheet" href="CSS/prism.css"/>
<script type="text/javascript" src="JS/prism.js"></script>
<div class="list-group">
	<div class="list-group-item">
		<b>Dernière modification : </b><?php echo $infos[0]['date']->format('d/m/Y'); ?><br/><br/>
		<b>Description : </b><br/><br/>
		<?php echo $infos[0]['description']; ?><br/><br/>
		<b>Exemple : </b><br/>
		<p id="exemple"><?php echo $infos[0]['exemple']; ?></p><br/>

		<div class="btn btn-group btn-group-sm">

<?php
				if($findLink == true)
				{
					?>
					<a href="#" class="btn btn-info" onclick="javascript:downloadFunction('<?php echo findLink($idReference); ?>')"><i class="glyphicon glyphicon-cloud-download"></i>&nbsp;&nbsp;Télécharger</a>
					<?php
				}

				if($_SESSION['fonction'] != "Accesseur")
				{
					if(ifExistsInTmp($idReference))
					{
						?>
						<a href="#" class="btn btn-primary" onclick="javascript:modifyFunction('<?php echo $idReference; ?>', '<?php echo addslashes($infos[0]['intituleDoc']) ?>')"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Modifier</a>
						<?php
					}
					else
					{
						?>
						<input type="button" class="btn btn-primary" value="Modifier" onclick="alert('Une modification est déjà en cours.');"/>
						<?php
					}
				}
				if($_SESSION['fonction'] == "Administrateur")
				{
					?>
					<a href="#" class="btn btn-danger" onclick="javascript:deleteFunction('<?php echo $idReference; ?>', <?php echo $_POST['sousCategorie']; ?>)"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;&nbsp;Supprimer</a>
					<?php
				}
			?>

		</div>
	</div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		Prism.highlightAll();
	});
</script>