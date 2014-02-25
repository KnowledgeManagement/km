<?php
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	
	$sousCa = $_POST['sousCate'];
	$fct = $_POST['fct'];
	
	$functions = getFunctionNameBySousCategorie($sousCa);
	for($i = 0; $i < sizeof($functions); $i++){
		if($functions[$i]['idReference'] == $fct){
			echo "<span style='float:left' onclick='javascript:seeFunction(\"".$functions[$i]['intituleDoc']."\", ".$sousCa.", \"".$functions[$i]['idReference']."\")'><b>".$functions[$i]['intituleDoc'].'</b></span><br/>';
		}else{
			echo "<span style='cursor:pointer;float:left' onclick='javascript:seeFunction(\"".$functions[$i]['intituleDoc']."\", ".$sousCa.", \"".$functions[$i]['idReference']."\")'>".$functions[$i]['intituleDoc'].'</span><br/>';
		}
	}
?>