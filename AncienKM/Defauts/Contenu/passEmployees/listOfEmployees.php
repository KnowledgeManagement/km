<?php
	include_once "../../../SQL/Fonctions_SQL/user.php";
	if(isset($_POST['idUser'])){//Réinitialise le mot de passe d'un utilisateur
		$findLogin = getUserById($_POST['idUser']);
		$login = $findLogin[0]['login'];
		modifyPassword($_POST['idUser'], $login);
		echo '<span class="alert">Le mot de passe a bien été réinitialisé.</span>';
	}
?>
