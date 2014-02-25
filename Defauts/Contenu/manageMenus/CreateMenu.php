<?php
session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

?>
<div class="form-inline">
	<div class="panel panel-default">
		<div class="panel-body">
			Nom :
			<input type="text" class="form-control" id="text_create_menu" name="text_create_menu" />
			<input type="submit" value="Créer" name="button_create_menu" class="btn btn-warning" onclick="javascript:CreateMenu(document.getElementById('text_create_menu').value);"/>
			<input type="button" value="Retour" name="button_back" class="btn btn-default" onclick="javascript:goToManageMenusRightContent();">
		</div>
	</div>
</div>