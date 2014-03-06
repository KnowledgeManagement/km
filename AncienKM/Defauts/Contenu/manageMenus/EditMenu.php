<?php
session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$idCat = $_POST['idCat'];
$nomCat = $_POST['nomCat'];

?>

<label>Nom :</label>
<input type="text" value="<?php echo $nomCat; ?>" id="text_edit_menu" name="text_edit_menu" class="input_text"  />
<input type="submit" value="Modifier" name="button_edit_menu" class="bouton" onclick="javascript:EditCat(document.getElementById('text_edit_menu').value, '<?php echo $idCat ?>', '<?php echo $nomCat ?>');"/>
<input type="button" value="Retour" name="button_back" class="bouton" onclick="javascript:goToManageMenusRightContent();">