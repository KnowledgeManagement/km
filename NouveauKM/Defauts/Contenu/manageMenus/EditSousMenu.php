<?php
session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$idSousCat = $_POST['idSousCat'];
$nomSousCat = $_POST['nomSousCat'];
$idCat = $_POST['idCat'];
$nomCat = $_POST['nomCat'];

?>
<div class="form-inline">
	<div class="panel panel-default">
		<div class="panel-body">
			<p><i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;Vous allez modifier <?php echo $nomSousCat; ?> rattaché à <?php echo $nomCat; ?>.</p>
				Nom :
				<input type="text" value="<?php echo $nomSousCat; ?>" id="text_edit_sous_menu" name="text_edit_sous_menu" class="form-control"/>
				<input type="button" value="Modifier" name="button_add_sous_menu" class="btn btn-primary" onclick="javascript:EditSousCat(document.getElementById('text_edit_sous_menu').value, '<?php echo $idSousCat ?>', '<?php echo $nomCat ?>', '<?php echo $nomSousCat ?>');" />
				<input type="button" value="Retour" name="button_back" class="btn btn-default" onclick="javascript:goToManageMenusRightContent();">
		</div>
	</div>
</div>