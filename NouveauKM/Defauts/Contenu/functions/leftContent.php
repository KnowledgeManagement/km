<?php
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	
	$sousCa = $_POST['sousCate'];
	$fct = $_POST['fct'];
	
	echo '<div class="list-group">';
	$functions = getFunctionNameBySousCategorie($sousCa);
	for($i = 0; $i < sizeof($functions); $i++){
		if($functions[$i]['idReference'] == $fct){
			?>
			<a class='list-group-item' style='cursor:pointer;' onclick="javascript:seeFunction('<?php echo addslashes($functions[$i]['intituleDoc']);?>','<?php echo addslashes($sousCa); ?>','<?php echo $functions[$i]['idReference']; ?>')"><?php echo $functions[$i]['intituleDoc']; ?></a>
			<?php
		}else{
			?>
			<a class='list-group-item' style='cursor:pointer;' onclick="javascript:seeFunction('<?php echo addslashes($functions[$i]['intituleDoc']);?>','<?php echo addslashes($sousCa); ?>','<?php echo $functions[$i]['idReference']; ?>')"><?php echo $functions[$i]['intituleDoc'];?> </a>
		<?php
		}
	}
?>