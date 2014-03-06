<?php

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$nomCat = $_POST['nomCat'];

if($nomCat != ""){
	addCategorie($nomCat);
	
	$dir = '..\..\dlExemples\\'. utf8_decode($nomCat).'\\';
	$create_folders = mkdir($dir, 0777, true);
}

?>