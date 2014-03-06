<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/user.php";
	$idMessage = $_POST['id'];
	$myMessage = getMessageById($idMessage);
?>
<form method="POST" id="formulaire" name="formulaire" enctype="multipart/form-data" action="Defauts\Contenu\mailBox\modifyMail.php">
	<table style="width : 100%;">
		<tr>
			<td>
				<input type="hidden" name="id" value='<?php echo $idMessage; ?>'/>
			</td>
		</tr>
		<tr>
			<td class="tdModifFunction" style="width: 130px;" >Catégorie : </td>
			<td>
				<select name="categorie" class="option" id="categorie" onChange="javascript:showSousCategorie('<?php echo $idMessage ?>', this.options[this.selectedIndex].value)">
					<?php
						$cate = getAllCategorie();
						for($i = 0; $i < sizeof($cate); $i++){
							if(isset($_POST['idCategorie'])){
								if($_POST['idCategorie'] == $cate[$i]['idCat']){
									echo "<option class='option' selected='selected' value='".$cate[$i]['idCat']."'>".$cate[$i]['nomCat']."</option>";
								}else{
									echo "<option class='option' value='".$cate[$i]['idCat']."'>".$cate[$i]['nomCat']."</option>";
								}
							}else if($myMessage[0]['nomCat'] == $cate[$i]['nomCat']){
								echo "<option class='option' selected='selected' value='".$cate[$i]['idCat']."'>".$cate[$i]['nomCat']."</option>";
							}else{
								echo "<option class='option' value='".$cate[$i]['idCat']."'>".$cate[$i]['nomCat']."</option>";
							}				
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="tdModifFunction" style="width: 130px;" >Sous Catégorie : </td>
			<td>
				<?php
					if(isset($_POST['idCategorie'])){
						$idCat = $_POST['idCategorie'];
					}else{
						$idCat = $myMessage[0]['idCat'];
					}
				?>
				<select class="option" name="sousCategorie" id="sousCategorie">
					<?php
						$sousCate = getSousCategorieByCategorie($idCat);
						for($i = 0; $i < sizeof($sousCate); $i++){
							if($myMessage[0]['nomSousCat'] == $sousCate[$i]['nomSousCat']){
								echo "<option class='option' selected='selected' value='".$sousCate[$i]['idSousCat']."'>".$sousCate[$i]['nomSousCat']."</option>";
							}else{
								echo "<option class='option' value='".$sousCate[$i]['idSousCat']."'>".$sousCate[$i]['nomSousCat']."</option>";
							}				
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="tdModifFunction" style="width: 130px;" >Description :</td>
			<td><textarea name="description" class="textarea"><?php echo $myMessage[0]['descriptionTmp']; ?></textarea></td>
		</tr>
		<tr>
			<td colspan='2'>
				<br/>
				<hr>
				<br/>
				<br/>
				<?php
					$exemple = $myMessage[0]['exempleTmp']; 
					$explodeSection = explode('<section', $exemple);
					$exp = 0;
					$ex = 0;
					$explodeExpli = explode('cadreMessage">', $explodeSection[0]);
					$explodeFinalExpli = explode('</div>', $explodeExpli[1]);
					echo '<textarea id="explication'.$exp.'" class="textarea" name="explication'.$exp.'" required>'.$explodeFinalExpli[0].'</textarea>';
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
						echo '<tr><td colspan="2"><span style="color:red">Attention : champ exclusivement réservé au code.</span></br><textarea id="exemple'.$ex.'" class="textarea" name="exemple'.$ex.'" required>'.$codeFinal[0].'</textarea></td></tr>';
						$ex++;
						if(isset($explodeDiv[1])){
							if($i != sizeof($explodeSection)-1){
								$explodeExpli = explode('cadreMessage">', $explodeDiv[1]);
								$explodeFinalExpli = explode('</div>', $explodeExpli[1]);
								echo '<tr><td colspan="2"><textarea id="explication'.$exp.'" class="textarea" name="explication'.$exp.'" required>'.$explodeFinalExpli[0].'</textarea></td></tr>';
								$exp++;
							}
						}
					}
				}
			?>
		<tr>
		<?php
			$link = $myMessage[0]["lienTelechargementTmp"];
			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'\Defauts\dlExemples\\'.$link;
		?>
			<td class="tdModifFunction" style="width: 130px;" >Pièce jointe : </td>
				<label><td><input style="width: 140px;" type="file" name="pj" id="piecejointe" value="<?php echo $uploaddir; ?>"/></label><label> <?php echo $link; ?> </label></td>
		</tr>
		<tr>
			<td><input type="hidden" name="link" value="<?php echo $link; ?>"/></td>
			<td style="text-align : right;"><input type='submit' style="width : 200px;" class='bouton' value='Valider la modification'/></td>
		</tr>
		<tr>
			<td><input type="hidden" name="intituleTmp" value="<?php echo $myMessage[0]['intituleTmp']; ?>"/></td>
			<td><input type="hidden" name="nombre" value="<?php echo $exp-1; ?>"/></td>
		</tr>
	</table>
</form>
<script type="text/javascript">

/* Add CKEditor */
for(var i=0; i<<?php echo $exp; ?>; i++)
{
	CKEDITOR.replace( 'explication'+i );
}
CKEDITOR.replace( 'description');


 $( document ).ready(function() {
	Prism.highlightAll();
 });
</script>