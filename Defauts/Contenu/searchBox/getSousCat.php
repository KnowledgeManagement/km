<?php	
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	$idCat = $_POST['idCat'];
	
	$myArray = array();
	$sousC = getSousCategorieByCategorie($idCat);
	foreach($sousC as $uneSous){
		$myArray[] = $uneSous['idSousCat'];
	}
	
	print json_encode($myArray);
?>