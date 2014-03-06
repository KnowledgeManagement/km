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
			Nom :
			<input type="text" value="<?php echo $nomCat; ?>" id="text_edit_menu" name="text_edit_menu" class="form-control" />
			<input type="submit" value="Modifier" name="button_edit_menu" class="btn btn-primary" onclick="javascript:EditCat(document.getElementById('text_edit_menu').value, '<?php echo $idCat ?>', '<?php echo $nomCat ?>');"/>
			<input type="button" value="Retour" name="button_back" class="btn btn-default" onclick="javascript:goToManageMenusRightContent();">
		</div>
	</div>
</div>