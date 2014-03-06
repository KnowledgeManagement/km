<?php

session_start();

include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";

$idCat = $_POST['idCat'];
$nomCat = $_POST['nomCat'];

?>

<label style="font-weight:italic;font-size:11px">Vous allez ajouter un sous-menu rattaché à <?php echo $nomCat; ?>.</label><br/>
<label>Nom :</label>
<input type="text"  id="text_add_menu" name="text_add_menu" class="input_text"/>
<input type="submit" value="Ajouter" name="button_add_sous_menu" class="bouton" onclick="javascript:AddSousCat(document.getElementById('text_add_menu').value, '<?php echo $idCat ?>', '<?php echo $nomCat ?>');"/>
<input type="button" value="Retour" name="button_back" class="bouton" onclick="javascript:goToManageMenusRightContent();">
