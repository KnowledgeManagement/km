<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
?>
<h3>Ajout/Modification de fonctions</h3>
<table class='messArray'>
	<tr>
		<th>Objet</th>
		<th>Etat</th>
		<th>Date</th>
	</tr>
	<?php
		$messages = getAllMessByUser($_SESSION['id']);
		for($i = 0; $i < sizeof($messages); $i++){
			echo '<tr>';
		?>
			<td id='messTitle'>
				<a href='#' onclick="javacript:openMessageContributeur('<?php echo $messages[$i]['idReferenceTmp'] ?>', '<?php echo $messages[$i]['intituleTmp']; ?>')">
					<?php echo $messages[$i]['intituleTmp']; ?>
				</a>
			</td>
			<td class='messTime'>
				<?php
					if($messages[$i]['etatTmp'] == "Refusé"){
						echo "<span title='".addslashes($messages[$i]['commentaireTmp'])."'>".urldecode($messages[$i]['etatTmp'])."</span>";
					}else{
						echo urldecode($messages[$i]['etatTmp']);
					}
				?>
			</td>
			<td class='messTime'>
				<?php echo $messages[$i]['dateTmp']->format('d/m/Y'); ?>
			</td>
		<?php
			echo '</tr>';
		}
	?>
</table>

<h3>Autres messages</h3>
<table class='messArray'>
	<tr>
		<th>Objet</th>
		<th>Etat</th>
		<th>Date</th>
	</tr>
	<?php
		$messages = getContactByIdUser($_SESSION['id']);
		for($i = 0; $i < sizeof($messages); $i++){
			echo '<tr>';
		?>
			<td id='messTitle'>
				<a href='#' onclick="javacript:openMessageContactContributeur(<?php echo $messages[$i]['idFormContact'] ?>, '<?php echo $messages[$i]['objet']; ?>')">
					<?php echo $messages[$i]['objet']; ?>
				</a>
			</td>
			<td class='messTime'>
				<?php
					if($messages[$i]['lu'] == 0){
						echo "Non Lu";
					}else{
						echo "Lu";
					}
				?>
			</td>
			<td class='messTime'>
				<?php echo $messages[$i]['date']->format('d/m/Y H:i:s'); ?>
			</td>
		<?php
			echo '</tr>';
		}
	?>
</table>