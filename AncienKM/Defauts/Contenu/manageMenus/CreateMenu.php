<?php
session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

?>


	<label>Nom :</label>
	<input type="text"  id="text_create_menu" name="text_create_menu" class="input_text"/>
	<input type="submit" value="Créer" name="button_create_menu" class="bouton" onclick="javascript:CreateMenu(document.getElementById('text_create_menu').value);"/>
	<input type="button" value="Retour" name="button_back" class="bouton" onclick="javascript:goToManageMenusRightContent();">
