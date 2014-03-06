<?php
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	
	$idSousCat = $_POST['idSousCat'];
	$nomSousCat = $_POST['nomSousCat'];
	$nomCat = $_POST['nomCat'];
	
	deleteSousCategorie($idSousCat);
	
	
	$dir = '..\..\dlExemples\\'. utf8_decode($nomCat).'\\'.utf8_decode($nomSousCat).'\\';
	
	if($dh = opendir($dir)){
		while(($file = readdir($dh))!== false){
			if(file_exists($dir.$file)) {
				unlink($dir.$file);
			}
		}
		closedir($dh);
	}
	
	$delete_folders = rmdir($dir);
?>