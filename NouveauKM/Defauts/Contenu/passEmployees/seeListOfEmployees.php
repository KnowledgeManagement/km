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

echo '<div class="list-group">';
echo '<div class="list-group-item">';

if($listOfUsers != ""){
	echo '<table id="tabListUsers" class="table table-condensed" style="text-align:center;">';
	echo '<tr class="info">';
	echo '<td><b>Nom</b></td>';
	echo '<td><b>Prénom</b></td>';
	echo '<td><b>Fonction</b></td>';
	echo '<td><b>Mot de passe</b></td>';
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
				<center>
					<input type="button" class="btn btn-info btn-sm" onclick="javascript:reinitPass(<?php echo $listOfUsers[$j]['idUser']; ?>)" value="Réinitialiser"/>
				</center>
			<?php 
			echo '</td>';
			echo '</tr>';
		}
	echo "</table>";
} else {
	echo "Aucun résultat trouvé !";
}
	echo "</div>";
	echo "</div>";
?>