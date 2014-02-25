<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/user.php";
	include_once "../../../SQL/Fonctions_SQL/search.php";
	$mot = $_POST['text'];

	$document = findTextByWord(str_replace("'", "''", utf8_decode($mot)));
	
	function mettreMotEnGras($mot, $phrase) {
		return ucfirst(str_replace($mot, "<strong>".$mot."</strong>", $phrase));
	}
	function mettreMotEnGrasDescription($mot, $phrase) {
		$position = strpos($phrase, $mot);
		if($position <= 50){
			return(str_replace($mot, "<strong>".$mot."</strong>",  substr($phrase, 0, 100))."...");
		}else if(($position+50) >= strlen($phrase)){
			return("...".str_replace($mot, "<strong>".$mot."</strong>", substr($phrase, strlen($phrase)-100)));
		}else{
			return("...".str_replace($mot, "<strong>".$mot."</strong>", substr($phrase, $position-50, 100))."...");
		}
	}
?>
<table style="width : 100%; border-collapse : collapse;">
	<?php
		for($i = 0; $i < sizeof($document); $i++){
			echo "<tr onclick='goToMyFunction(\"".$document[$i]['intituleDoc']."\", ".$document[$i]['idSousCat'].", \"".$document[$i]['idReference']."\")' style='width : 100%;' id='".$document[$i]['idReference']."' onmouseOver='javascript:hoverTr(\"".$document[$i]['idReference']."\")' onmouseout='javascript:hoverOffTr(\"".$document[$i]['idReference']."\")'>";
				if(strstr(strtolower($document[$i]['intituleDoc']), strtolower($mot))){
					echo "<td>".mettreMotEnGras($mot, $document[$i]['intituleDoc'])."</td>";
				}else if(strstr(strtolower($document[$i]['description']), strtolower($mot)) && strstr(strtolower($document[$i]['intituleDoc']), strtolower($mot))){
					echo "<td>".mettreMotEnGras($mot, $document[$i]['intituleDoc'])."</td>";
				}else{
					echo "<td>".mettreMotEnGrasDescription($mot, $document[$i]['description'])."</td>";
				}
				$infos = findInfosCat($document[$i]['idReference']);
				echo "<td style='text-align : right;'><span style='color : grey;'>".$infos[0]['nomCat'].' / '.$infos[0]['nomSousCat']."</span></td>";
			echo "</tr>";
		}
	?>
</table>

<script type="text/javascript">
function hoverTr(id){
	document.getElementById(id).style.backgroundColor = "#e7e7e9";
	document.getElementById(id).style.cursor = "pointer";
}

function hoverOffTr(id){
	document.getElementById(id).style.backgroundColor = "white";
	document.getElementById(id).style.cursor = "default";
}

function goToMyFunction(intitule, sousCat, reference){
	goToFunctionLeftContent(sousCat, reference);
	seeFunction(intitule, sousCat, reference);
	document.getElementById('search').value = "";
	document.getElementById('searchResult').style.display = "none";
	$.ajax({
		url : 'Defauts/Contenu/functions/getLink.php',
		type :'POST', 
		data : {sousCate : sousCat},
		dataType : 'text',
		success:function(data) 
		{
			var doc = eval('(' + data + ')');
			$('#titleLeftContent').html(doc['nomSousCatGauche']);
		}
	});
}

</script>