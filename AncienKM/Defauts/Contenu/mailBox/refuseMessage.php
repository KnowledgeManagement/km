<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	$idMessage = $_POST['id'];
	$commentaires = $_POST['comm'];
	
	deleteFiles($idMessage);
	setMessageRefused($idMessage, $commentaires);
?>