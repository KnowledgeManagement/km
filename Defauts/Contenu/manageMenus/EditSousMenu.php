<?php
session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$idSousCat = $_POST['idSousCat'];
$nomSousCat = $_POST['nomSousCat'];
$idCat = $_POST['idCat'];
$nomCat = $_POST['nomCat'];

?>

<label style="font-weight:italic;font-size:11px">Vous allez modifier <?php echo $nomSousCat; ?> rattaché à <?php echo $nomCat; ?>.</label><br/>
<label>Nom :</label>
<input type="text" value="<?php echo $nomSousCat; ?>" id="text_edit_sous_menu" name="text_edit_sous_menu" class="input_text"/>
<input type="button" value="Modifier" name="button_add_sous_menu" class="bouton" onclick="javascript:EditSousCat(document.getElementById('text_edit_sous_menu').value, '<?php echo $idSousCat ?>', '<?php echo $nomCat ?>', '<?php echo $nomSousCat ?>');" />
<input type="button" value="Retour" name="button_back" class="bouton" onclick="javascript:goToManageMenusRightContent();">
