<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	
	$sousCa = $_POST['sousCate'];
	$cat = getSousCategorieById($sousCa);
	$array = array();
	if($_SESSION['fonction'] != "Accesseur"){
		$array['nomCat'] = $cat[0]['nomCat'];
		$array['nomSousCatGauche'] = $cat[0]['nomSousCat'].'<a href="#" style="margin-left : 50px; float:right" title="Ajouter une fonction" onclick="javascript:addFunctionContributeur('.$cat[0]['idSousCat'].', '.$cat[0]['idCat'].')"><i class="glyphicon glyphicon-plus-sign"></i></a>';
		$array['nomSousCat'] = $cat[0]['nomSousCat'];
	}else{
		$array['nomCat'] = $cat[0]['nomCat'];
		$array['nomSousCatGauche'] = $cat[0]['nomSousCat'];
		$array['nomSousCat'] = $cat[0]['nomSousCat'];
	}
	
	print json_encode($array);
?>