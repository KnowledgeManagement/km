<?php
	include("../../SQL/Fonctions_SQL/user.php");
	if(verifLogin($_POST['identifiant'],$_POST['password'])){
		session_start();
		$array=getUser($_POST['identifiant'],$_POST['password']);
		if($array[0]['login'] == $_POST['password']){
			$_SESSION['sameLogs'] = 1;
		}
		$_SESSION['id'] = $array[0]['idUser'];
		$_SESSION['login'] = $array[0]['login'];
		$_SESSION['nom'] = $array[0]['nom'];
		$_SESSION['fonction'] = $array[0]['fonction'];
		$_SESSION['prenom'] = $array[0]['prenom'];
		$_SESSION['mail'] = $array[0]['mail'];
		header('Location:../../accueil.php');
	}else{
		header('Location:../../index.php?error');
	}
?>