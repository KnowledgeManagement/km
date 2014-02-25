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
<b>Dernière modification : </b><?php echo $infos[0]['date']->format('d/m/Y'); ?><br/><br/>
<b>Description : </b><br/><br/>
<?php echo $infos[0]['description']; ?><br/><br/>
<b>Exemple : </b><br/>
<p id="exemple"><?php echo $infos[0]['exemple']; ?></p><br/>

<div style="width : 100%; text-align : right;">
	<input type="button" class="bouton" value="Télécharger" onclick="javascript:downloadFunction('<?php echo $findLink;?>')"/>
	<?php
		if($_SESSION['fonction'] != "Accesseur"){
			if(ifExistsInTmp($idReference)){
				?>
					<input type="button" class="bouton" value="Modifier" onclick="javascript:modifyFunction('<?php echo $idReference; ?>', '<?php echo $infos[0]['intituleDoc'] ?>')"/>
				<?php
			}else{
				?>
					<input type="button" class="bouton" value="Modifier" onclick="alert('Une modification est déjà en cours.');"/>
				<?php
			}
		}
		if($_SESSION['fonction'] == "Administrateur"){
	?>
		<input type="button" class="bouton" value="Supprimer" onclick="javascript:deleteFunction('<?php echo $idReference; ?>', <?php echo $_POST['sousCategorie']; ?>)"/>
	<?php
		}
	?>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		Prism.highlightAll();
	});
</script>