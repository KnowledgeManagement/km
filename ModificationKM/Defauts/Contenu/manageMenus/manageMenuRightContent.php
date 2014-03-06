<?php
	
session_start();
include_once "../../../SQL/Fonctions_SQL/categorie.php";
include_once "../../../SQL/Fonctions_SQL/souscategorie.php";
	
$lesCate = getAllCategorie();
	
echo '<a href="#" id="menuButtonNew" class="btn btn-warning" onclick="javascript:goToCreateMenu();"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;Nouveau</a>';
for($i = 0; $i < sizeof($lesCate); $i++){
?>
<ul class="manageMenu list-group">
	<li class="Menu list-group-item">
		<a href="#" style="padding-left:20px;text-decoration:none"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $lesCate[$i]['nomCat']; ?></a>
			<ul class="sousMenu">
				<div class="btn-group btn-group-sm" style="float:right;margin-bottom:10px;">
					<a href="#" class="btn btn-warning" onclick="javascript:goToAddSousMenu('<?php echo $lesCate[$i]['idCat']; ?>','<?php echo $lesCate[$i]['nomCat']; ?>');"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;Ajouter</a>
			 		<a href="#" class="btn btn-primary" onclick="javascript:goToEditMenu('<?php echo $lesCate[$i]['idCat']; ?>','<?php echo $lesCate[$i]['nomCat']; ?>');"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Modifier</a> 
					<?php $lesSousCat = getSousCategorieDinstinctCategorie(); if(isset($lesSousCat[$i]['idCat']) != $lesCate[$i]['idCat']) { ?>
					<a href="#" class="btn btn-danger" onclick="javascript:deleteCat('<?php echo $lesCate[$i]['idCat']; ?>','<?php echo $lesCate[$i]['nomCat']; ?>')"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;&nbsp;Supprimer</a>
					<?php } ?>
				</div>
				<table class="table">
					<?php $SousMenu = getSousCategorieByCategorie($lesCate[$i]['idCat']);
						if(isset($SousMenu)){
							for($j = 0; $j < sizeof($SousMenu); $j++){
					?>
					<li>
						<tr>
							<td>
								<?php echo $SousMenu[$j]['nomSousCat']; ?>
							</td>
							<td>
								<div class="btn-group btn-group-sm" style="float:right;">
									<a href="#" class="btn btn-primary" onclick="javascript:goToEditSousMenu('<?php echo $SousMenu[$j]['idSousCat']; ?>','<?php echo $SousMenu[$j]['nomSousCat']; ?>','<?php echo $SousMenu[$j]['idCat']; ?>','<?php echo $lesCate[$i]['nomCat']; ?>');"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Modifier</a>
									<a href="#" class="btn btn-danger" onclick="javascript:deleteSousCat('<?php echo $SousMenu[$j]['idSousCat']; ?>','<?php echo $SousMenu[$j]['nomSousCat']; ?>','<?php echo $lesCate[$i]['nomCat']; ?>')"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;&nbsp;Supprimer</a>
								</div>
							</td>
						</tr>
					</li>
						<?php
							}
						} ?>
				</table>
			</ul>
	</li>
</ul>
<?php
}
?>
<script type="text/javascript">

$(document).ready( function () {
    // On cache les sous-menus
    // sauf celui qui porte la classe "open_at_load" :
    $(".manageMenu ul.sousMenu:not('.open_at_load')").hide();
    // On sélectionne tous les items de liste portant la classe "Menu"

    // et on remplace l'élément span qu'ils contiennent par un lien :
    $(".manageMenu li.Menu span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = $(this).text();
        $(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a>') ;
    } ) ;

    // On modifie l'évènement "click" sur les liens dans les items de liste
    // qui portent la classe "Menu" :
    $(".manageMenu li.Menu > a").click( function () {
        // Si le sous-menu était déjà ouvert, on le referme :
        if ($(this).next("ul.sousMenu:visible").length != 0) {
            $(this).next("ul.sousMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } );
        }
        // Si le sous-menu est caché, on ferme les autres et on l'affiche :
        else {
            $(".manageMenu ul.sousMenu").slideUp("normal", function () { $(this).parent().removeClass("open") });
            $(this).next("ul.sousMenu").slideDown("normal", function () { $(this).parent().addClass("open") } );
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });

} ) ;

</script>