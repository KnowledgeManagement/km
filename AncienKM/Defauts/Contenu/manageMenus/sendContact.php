<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/user.php";
	
	$objet = $_POST['objet'];
	$description = $_POST['description'];
	
	sendContact($objet, $description);
?>