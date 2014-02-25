<?php
	session_start();
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	include_once "../../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../../SQL/Fonctions_SQL/user.php";
	
	$idCategorie = $_POST['idCategorie'];
	if(isset($_POST['idSousCategorie'])){
		$idSousCategorie = $_POST['idSousCategorie'];
	}
?>
<div class="list-group">
	<div class="list-group-item">
		<form method="POST" id="formulaire" enctype="multipart/form-data" action="Defauts\Contenu\mailBox\sendMail.php"> 
			<table id="tablefunction" class="table">
				<tr>
					<td class="tdModifFunction">Catégorie : </td>
					<td>
						<select name="categorie" class="form-control" id="categorie" onChange="javascript:showSousCategorieAddFunction(this.options[this.selectedIndex].value)">
							<?php
								$cate = getAllCategorie();
								for($i = 0; $i < sizeof($cate); $i++)
								{
									if($idCategorie == $cate[$i]['idCat']){
										echo "<option class='option' selected='selected' value='".$cate[$i]['idCat']."'>".$cate[$i]['nomCat']."</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="tdModifFunction">Sous Catégorie : </td>
					<td>
						<select name="sousCategorie" class="form-control" id="sousCategorie">
							<?php
								$sousCate = getSousCategorieByCategorie($idCategorie);
								for($i = 0; $i < sizeof($sousCate); $i++)
								{
									if(isset($_POST['idSousCategorie']) && $idSousCategorie == $sousCate[$i]['idSousCat']){
										echo "<option class='option' selected='selected' value='".$sousCate[$i]['idSousCat']."'>".$sousCate[$i]['nomSousCat']."</option>";
									}else if(!isset($_POST['idSousCategorie'])){
										echo "<option class='option' value='".$sousCate[$i]['idSousCat']."'>".$sousCate[$i]['nomSousCat']."</option>";
									}			
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="tdModifFunction">Intitulé :</td>
					<td><input class="form-control" id="intitule" name="intitule" required ></input></td>
				</tr>
				<tr>
					<td class="tdModifFunction">Description :</td>
					<td><textarea class="form-control" onkeydown="insertTab(this, event);" class="textarea" id="description" name="description" required ></textarea></td>
				</tr>
				<tr>
					<td class="tdModifFunction">Explication :</td>
					<td><textarea class="form-control" onkeydown="insertTab(this, event);" class="textarea" id="explication0" name="explication0" required ></textarea></td>
				</tr>
				<tr>
					<td class="tdModifFunction">Exemple : </td>
					<td><textarea class="form-control" onkeydown="insertTab(this, event);" class="textarea" id="exemple0" name="exemple0" ></textarea></td>
				</tr>
				
			</table>

			<p>Pièce jointe : </p>
			<p><input type="file" name="pj" id="piecejointe" value="Insérer" /></p>
			<br/>

			<a href="#" class="btn btn-sm btn-warning" title="Ajouter un exemple" id="boutonAjout" onclick="javascript:addexemple()"><i class="glyphicon glyphicon-plus-sign"></i></a>
			<a href="#" title="Enlever un exemple" id="boutonAjout" onclick="javascript:removeexemple()"><i class="glyphicon glyphicon-moins-sign"></i></a>

			<input type="hidden" id="nombre" name="nombre" value=0 />

			<input type="submit" class="btn btn-success btn-sm" value="Envoyer" onclick="javascript:fieldVerification()" />
		</form>
	</div>
</div>
<script>

/* Add CKEditor */
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'explication0' );

function insertTab(o, e)
{
	var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;
	if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey)
	{
		var oS = o.scrollTop;
		if (o.setSelectionRange)
		{
			var sS = o.selectionStart;
			var sE = o.selectionEnd;
			o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
			o.setSelectionRange(sS + 1, sS + 1);
			o.focus();
		}
		else if (o.createTextRange)
		{
			document.selection.createRange().text = "\t";
			e.returnValue = false;
		}
		o.scrollTop = oS;
		if (e.preventDefault)
		{
			e.preventDefault();
		}
		return false;
	}
	return true;
}
</script>