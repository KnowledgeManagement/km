<?php
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	$idMessage = $_POST['id'];
	setMessageAccepted($idMessage);
?>