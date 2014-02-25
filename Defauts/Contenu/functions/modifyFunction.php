<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/user.php";
	$idDoc = $_POST['idReference'];
	$myFunction = getFunctionBySousCategorie($idDoc);
?>
<div class="list-group">
	<div class="list-group-item">
		<form method="POST" id="formulaire" name="formulaire" enctype="multipart/form-data" action="Defauts\Contenu\functions\UpdateFunction.php">
			<input type="hidden" name="id" value='<?php echo $idDoc; ?>'/>
			<table class="table" style="width : 100%;">
				<tr>
					<td class="tdModifFunction">Catégorie : </td>
					<td>
						<?php
							echo $myFunction[0]['nomCat'];
						?>
						<input type="hidden" name="categorie" value="<?php echo $myFunction[0]['idCat']; ?>"/>
					</td>
				</tr>
				<tr>
					<td class="tdModifFunction">Sous Catégorie : </td>
					<td>
						<?php
							echo $myFunction[0]['nomSousCat'];
						?>
						<input type="hidden" name="souscategorie" value="<?php echo $myFunction[0]['idSousCat']; ?>"/>
					</td>
				</tr>
				<tr>
					<td class="tdModifFunction">Description :</td>
					<td><textarea class="form-control" name="description"><?php echo $myFunction[0]['description']; ?></textarea></td>
				</tr>
				<tr>
					<td colspan='2'>
						<br/>
						<hr>
						<br/>
						<br/>
						<?php
							$exemple = $myFunction[0]['exemple']; 
							$explodeSection = explode('<section', $exemple);
							$exp = 0;
							$ex = 0;
							$explodeExpli = explode('cadreMessage">', $explodeSection[0]);
							$explodeFinalExpli = explode('</div>', $explodeExpli[1]);
							echo '<textarea id="explication'.$exp.'" class="form-control" name="explication'.$exp.'" required>'.$explodeFinalExpli[0].'</textarea>';
							$exp++;
						?>
					</td>
				</tr>
					<?php
						if(isset($explodeSection[1])){
							for($i = 1; $i < sizeof($explodeSection); $i++){
								$explodeDiv = explode('<div', $explodeSection[$i]);
								$explodeCode = explode('<code>', $explodeDiv[0]);
								$codeFinal = explode('</code>', $explodeCode[1]);
								echo '<tr><td colspan="2"><span class="alert alert-danger pull-left"><i class="glyphicon glyphicon-exclamation-sign"></i> Attention : champ exclusivement réservé au code.</span></br><textarea id="exemple'.$ex.'" class="form-control" name="exemple'.$ex.'" required>'.$codeFinal[0].'</textarea></td></tr>';
								$ex++;
								if(isset($explodeDiv[1])){
									if($i != sizeof($explodeSection)-1){
										$explodeExpli = explode('cadreMessage">', $explodeDiv[1]);
										$explodeFinalExpli = explode('</div>', $explodeExpli[1]);
										echo '<tr><td colspan="2"><textarea id="explication'.$exp.'" class="form-control" name="explication'.$exp.'" required>'.$explodeFinalExpli[0].'</textarea></td></tr>';
										$exp++;
									}
								}
							}
						}
					?>
				<tr>
				<?php
					$link = $myFunction[0]["lienTelechargement"];
					$uploaddir = $_SERVER['DOCUMENT_ROOT'].'\Defauts\dlExemples\\'.$link;
				?>
					<td class="tdModifFunction" style="width: 130px;" >Pièce jointe : </td>
					<label><td><input style="width: 140px;" type="file" name="pj" id="piecejointe" value="<?php echo $uploaddir; ?>"/></label><label> <?php echo $link; ?> </label></td>
				</tr>
				<tr>
					<td><input type="hidden" name="link" value="<?php echo $link; ?>"/></td>
					<td style="text-align : right;"><input type='submit' style="width : 200px;" class='btn btn-sm btn-success' value='Valider la modification'/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="hidden" name="intitule" value="<?php echo $myFunction[0]['intituleDoc']; ?>"/></td>
				</tr>
			</table>
			<input type="hidden" name="nombre" id="nombre" value="<?php echo ($exp-1); ?>"/>
		</form>
	</div>
</div>

<script type="text/javascript">
 $( document ).ready(function() {
  Prism.highlightAll();
 });
</script>