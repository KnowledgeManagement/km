<?php

session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$idCat = $_POST['idCat'];
$nomCat = $_POST['nomCat'];

?>

<div class="form-inline">
	<div class="panel panel-default">
		<div class="panel-body">
			<p><i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;Vous allez ajouter un sous-menu rattaché à <?php echo $nomCat; ?>.</p>
			Nom :
			<input type="text"  id="text_add_menu" name="text_add_menu" class="form-control"/>
			<input type="submit" value="Ajouter" name="button_add_sous_menu" class="btn btn-warning" onclick="javascript:AddSousCat(document.getElementById('text_add_menu').value, '<?php echo $idCat ?>', '<?php echo $nomCat ?>');"/>
			<input type="button" value="Retour" name="button_back" class="btn btn-default" onclick="javascript:goToManageMenusRightContent();">
		</div>
	</div>
</div>