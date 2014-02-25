<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/user.php";
	$idMessage = $_POST['idMessage'];
	
	$myMessage = getMessageById($idMessage);
	if($_POST['action'] == "modify"){
		echo "<textarea class='textarea' id='textExemple' onkeypress='saveExemple()' style='width : 700px; height : 300px;'>".$_SESSION['exemple']."</textarea>";
		echo "<input type='button' class='bouton' value='Modifier' onclick='javascript:modifExemple(\"".$idMessage."\")'/>";
	}else if($_POST['action'] == "write"){
		echo $_SESSION['exemple'];	
	}else if($_POST['action'] == "save"){
		$_SESSION['exemple'] = $_POST['contenu'];
	}
?>

<script type="text/javascript">
	$( document ).ready(function() {
		Prism.highlightAll();
	});
</script>