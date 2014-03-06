<?php

include_once "../../../SQL/Fonctions_SQL/user.php";

if(isset($_POST['idUser'])){//Réinitialise le mot de passe d'un utilisateur
	$findLogin = getUserById($_POST['idUser']);
	$login = $findLogin[0]['login'];
	modifyPassword($_POST['idUser'], $login);
	echo '<span class="alert">Le mot de passe a bien été réinitialisé.</span>';
}

$lettre = $_POST['lettre'];

$listOfUsers = getUserByAlpha($lettre);

if($listOfUsers != ""){
	echo '<table id="tabListUsers" cellpadding="0" cellspacing="0">';
	echo '<tr class="titre">';
	echo '<td>Nom</td>';
	echo '<td>Prénom</td>';
	echo '<td>Fonction</td>';
	echo '<td>Mot de passe</td>';
	echo '</tr>';
		for($j = 0; $j < sizeof($listOfUsers); $j++){
			echo '<tr>';
			echo '<td>';
			echo $listOfUsers[$j]['nom'];
			echo '</td>';
			echo '<td>';
			echo $listOfUsers[$j]['prenom'];
			echo '</td>';
			echo '<td>';
			echo $listOfUsers[$j]['fonction'];
			echo '</td>';
			echo '<td>';
			?>
				<input type="button" class="bouton" style="width:120px;margin:2px 0px 2px 0px;" onclick="javascript:reinitPass(<?php echo $listOfUsers[$j]['idUser']; ?>)" value="Réinitialiser"/>
			<?php 
			echo '</td>';
			echo '</tr>';
		}
	echo "</table>";
} else {
	echo "Aucun résultat trouvé !";
}

?>