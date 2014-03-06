<?php
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	
	$idCat = $_POST['idCat'];
	$nomCat = $_POST['nomCat'];
	deleteCategorie($idCat);
	
	deleteSousCategorie($idSousCat);
	deleteFunctionBySousCategorie($idSousCat);
	
	$dir = '..\..\dlExemples\\'. utf8_decode($nomCat).'\\';
		
	$delete_folders = rmdir($dir);
?>