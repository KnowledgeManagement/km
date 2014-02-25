<?php
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	session_start();
	$idMessage = $_POST['id'];
	if($_POST['type'] == 'mess'){
		$message = getMessageById($idMessage);
		if($message[0]['etatTmp'] == 'Non Lu'){
			setMessageRead($idMessage);
		}
	}else{
		$message = getMessageByIdContact($idMessage);
		if($message[0]['lu'] == '0'){
			setMessageReadContact($idMessage);
		}
	}
	$findLink = findLink($idMessage);
?>
<div class="form-inline">
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-condensed">
				<tr>
					<td class="col-md-6">
						<p class="text-right"><b>Expéditeur</b></p>
					</td>
					<td class="col-md-6">
						<?php echo $message[0]['nom'].' '.$message[0]['prenom']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p class="text-right"><b>Date</b></p>
					</td>
					<td>
						<?php 
							if($_POST['type'] == 'mess'){
								echo $message[0]['dateTmp']->format('d/m/Y');
							}else{
								echo $message[0]['date']->format('d/m/Y H:i:s');
							}
						?>
					</td>
				</tr>
				<?php
					if($_POST['type'] == 'mess'){
				?>
					<tr>
						<td>
							<p class="text-right"><b>Catégorie</b></p>
						</td>
						<td>
							<?php echo $message[0]['nomCat']; ?>
						</td>
					</tr>
					<tr>
						<td>
							<p class="text-right"><b>Sous-catégorie</b></p>
						</td>
						<td>
							<?php echo $message[0]['nomSousCat']; ?>
						</td>
					</tr>
				<?php
					}
				?>
			</table>
<?php
	echo "<br />";
	if($_POST['type'] == 'mess')
	{
		echo '<b>Description : </b><br/><br/>'.html_entity_decode($message[0]['descriptionTmp']).'<br/></br><hr></br>';
		echo html_entity_decode($message[0]['exempleTmp']);
		
		if(($message[0]['etatTmp'] == 'Non Lu' || $message[0]['etatTmp'] == 'Lu') && $_SESSION['fonction']=="Administrateur")
		{
			?>
			<div style="margin-top : 50px;">
				<b>Commentaire :</b> <input type="text" class="form-control" style="width : 350px;" id="commentaire" placeholder="Le commentaire sera vu par le contributeur..."/>
				<a href="#" class="btn btn-success" onclick="javascript:validMessage('<?php echo $idMessage; ?>')"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;Accepter</a>
				<a href="#" class="btn btn-primary" onclick="javascript:modifMessage('<?php echo $idMessage; ?>', '<?php echo $message[0]['intituleTmp']; ?>')"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;&nbsp;Modifier</a>
				<a href="#" class="btn btn-danger" onclick="javascript:refuseMessage('<?php echo $idMessage; ?>')"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;&nbsp;Refuser</a>
			</div>
			<?php
		}
	}else
	{
		echo $message[0]['contenu'];
	}
?>
		</div>
	</div>
</div>
<script type="text/javascript">
 $( document ).ready(function() {
  Prism.highlightAll();
 });
</script>