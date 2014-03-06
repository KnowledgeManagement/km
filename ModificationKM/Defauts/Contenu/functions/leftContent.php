<?php
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	
	$sousCa = $_POST['sousCate'];
	$fct = $_POST['fct'];
	echo '<div class="list-group">';
	$functions = getFunctionNameBySousCategorie($sousCa);
	for($i = 0; $i < sizeof($functions); $i++){
		if($functions[$i]['idReference'] == $fct){
			echo "<a class='list-group-item list-group-item-info' list-group-item-info' onclick='javascript:seeFunction(\"".$functions[$i]['intituleDoc']."\", ".$sousCa.", \"".$functions[$i]['idReference']."\")'><b>".$functions[$i]['intituleDoc'].'</b></a>';
		}else{
			echo "<a class='list-group-item' style='cursor:pointer;' onclick='javascript:seeFunction(\"".$functions[$i]['intituleDoc']."\", ".$sousCa.", \"".$functions[$i]['idReference']."\")'>".$functions[$i]['intituleDoc'].'</a>';
		}
	}
	echo "</div>";
	
?>