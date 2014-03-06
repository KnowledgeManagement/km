<?php

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$newNomSousCat = $_POST['nomSousCat'];
$oldNomSousCat = $_POST['oldSousCat'];
$idSousCat = $_POST['idSousCat'];
$nomCat = $_POST['nomCat'];

if($newNomSousCat != ""){
	UpdateSousCategorie($newNomSousCat, $idSousCat);
	$update_folder = rename('..\..\dlExemples\\'. utf8_decode($nomCat).'\\'.utf8_decode($oldNomSousCat).'\\', '..\..\dlExemples\\'. utf8_decode($nomCat).'\\'.utf8_decode($newNomSousCat).'\\');
}

?>