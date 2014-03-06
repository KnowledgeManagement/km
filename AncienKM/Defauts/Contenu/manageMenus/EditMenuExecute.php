<?php

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$nomCat = $_POST['nomCat'];
$idCat = $_POST['idCat'];
$oldCat = $_POST['oldCat'];

if($nomCat != ""){
	UpdateCategorie($nomCat, $idCat);
	$update_folder = rename('..\..\dlExemples\\'.utf8_decode($oldCat).'\\' , '..\..\dlExemples\\'.utf8_decode($nomCat).'\\');
}

?>