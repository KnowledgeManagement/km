<?php

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$nomSousCat = $_POST['nomSousCat'];
$idCat = $_POST['idCat'];
$nomCat = $_POST['nomCat'];

if($nomSousCat != ""){
	addSousCategorie($nomSousCat, $idCat);

	$dir = '..\..\dlExemples\\'. utf8_decode($nomCat).'\\'.utf8_decode($nomSousCat).'\\';
	$create_folders = mkdir($dir, 0777, true);
}
?>