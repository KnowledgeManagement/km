<?php
	session_start();
	include("../../../SQL/Fonctions_SQL/user.php");
	$pass = $_POST['password'];
	modifyPassword($_SESSION['id'], $pass);
	unset($_SESSION['sameLogs']);
	header("location:../../../accueil.php");

?>