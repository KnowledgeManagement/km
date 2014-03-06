<?php
	session_start();
	include_once "../../SQL/Fonctions_SQL/messagerie.php";
	include_once "../../SQL/Fonctions_SQL/categorie.php";
	include_once "../../SQL/Fonctions_SQL/souscategorie.php";
?>
<!--- LOGO + BARRE DE RECHERCHE --->
<a href="accueil.php"><img id="logo" src="Images/logo.png" alt="Logo"/></a>
<input type="button" id="myButton" class="glyphicon glyphicon-th" style="width : 20px; position : relative; top : -6px;" onclick="getFiltre()" value="Filtre"/>
<input id="search" type="text" placeholder="Rechercher..." onkeyup="onSearch()" name="rechercher" />
<?php
	/* Selectionne les catégories par ordre d'identifiant */
	$lesCate = getAllCategorie();
	for($i = 0; $i < sizeof($lesCate); $i++){
?>
	<!--- MENU/SOUS-MENU DEBUT --->
	<div class="menu">
		<ul>
			<li><a href="#" class="titre_menu"><?php echo $lesCate[$i]['nomCat']; ?></a>
				<ul>
					<?php
						$SousMenu = getSousCategorieByCategorie($lesCate[$i]['idCat']);
						if(isset($SousMenu)){
							for($j = 0; $j < sizeof($SousMenu); $j++){
						?>
							<li><a href="#" onclick="javascript:goToFunction(<?php echo $SousMenu[$j]['idSousCat']; ?>)"><?php echo $SousMenu[$j]['nomSousCat']; ?></a></li>
						<?php
							}
						}
					?>
				</ul>
			</li>
		</ul>
	</div>
	<!--- MENU/SOUS-MENU FIN --->
<!--- Si administrateur > Ajout d'un bouton de gestion des menus
	  Si différent d'administrateur > Ajout d'un onglet pour contacter l'administrateur --->
<?php
	}
	if($_SESSION['fonction'] == "Administrateur"){
?>
	<div id="add">
		<a href="#" id="boutonAjout" onclick="javascript:goToManageMenusRightContent();goToManageMenusLeftContent();">+</a>
	</div>
<?php
	}
	if($_SESSION['fonction'] != "Administrateur"){
?>			
	<div id="help">
		<a href="#" onclick="javascript:contactAdmin()">?</a>
	</div>
<?php
	}
?>
<!--- MENU UTILISATEUR DEBUT --->
<div id="UserMenu">
	<ul>
		<li>
			<a href="#" >
				<?php
					if($_SESSION['fonction'] == "Administrateur"){
						$notRead = countMessNotRead();
						echo "<span title='Messages non lus'>(".$notRead.") </span>";
					}
					echo $_SESSION['nom'];
				?>
			</a>
			<ul>
				<?php
					if($_SESSION['fonction'] == "Administrateur"){
				?>
					<li>
						<a href="#" style="margin-top : 2px;" onclick="javascript:goToMailBoxRightContent('allMessages');goToMailBoxLeftContent()">
							Ma Messagerie
						</a>
					</li>
					<li>
						<a href="#" onclick="javascript:goToPage();goToPageLeft()">
							Gérer les mots de passe
						</a>
					</li>
				<?php
					}else if($_SESSION['fonction'] == "Contributeur"){
				?>
					<li>
						<a href="#" onclick="javascript:seeMyAsking()">
							Gérer mes demandes
						</a>
					</li>
				<?php
					}
				?>
				<li><a href="Defauts/Contenu/deconnexion.php">Déconnexion</a></li>
			</ul>
		</li>
	</ul>
</div>
<div id="searchResult" style="display : none; border : solid black 1px; width : 1000px; position : absolute; z-index : 50; background-color : white; color : black;">

</div>
<div id="filter" style="display : none; border : solid black 1px; width : 200px; position : absolute; z-index : 50; background-color : white; color : black;">
	<input type="button" value="Supprimer tous les filtres" onclick="deleteFilter()"/></br>
	<?php
	for($i = 0; $i < sizeof($lesCate); $i++){
	?>
		<!--- MENU/SOUS-MENU DEBUT --->
		<div>
			<label><input type="checkbox" onclick="javascript:allCheck(<?php echo $lesCate[$i]['idCat']; ?>)" name="cate" value="<?php echo $lesCate[$i]['idCat']; ?>"/><?php echo $lesCate[$i]['nomCat']."<br/>"; ?></label>
					
			<?php
				$SousMenu = getSousCategorieByCategorie($lesCate[$i]['idCat']);
				if(isset($SousMenu)){
					for($j = 0; $j < sizeof($SousMenu); $j++){
				?>
					<label><span style='margin-left : 50px;'><input onclick="javascript:checkSousCat(<?php echo $SousMenu[$j]['idSousCat']; ?>)" type="checkbox" name="sousCat" value="<?php echo $SousMenu[$j]['idSousCat']; ?>"/><?php echo $SousMenu[$j]['nomSousCat']."</span><br/>"; ?></label>
				<?php
					}
				}
			?>
		</div>
	<?php
	}
	?>
</div>
<!--- MENU UTILISATEUR FIN --->
<script type="text/javascript">
function onSearch(){
	if(document.getElementById('search').value == ""){
		document.getElementById('searchResult').style.display = "none";
	}else{
		var myArray = new Array();
		var indice = 0;
		for(var j = 0; j < document.getElementsByName("sousCat").length; j++){
			if(document.getElementsByName("sousCat")[j].checked == true){
				myArray.push(document.getElementsByName("sousCat")[j].value);
				indice++;
			}
		}
		if(indice == 0){
			myArray.push(0);
		}
		$.ajax({
			url : 'Defauts/Contenu/searchBox/findWord.php',
			data : {text : document.getElementById('search').value, maListe : myArray},
			dataType : "TEXT",
			type :'POST', 
			success:function(data) 
			{
				document.getElementById('searchResult').style.display = "block";
				document.getElementById('searchResult').style.top = "30px";
				document.getElementById('searchResult').style.left = document.getElementById('search').offsetLeft+"px";
				$("#searchResult").html(data);
			}
		});
		document.getElementById("search").focus();
	}
}

function getFiltre(){
	if(document.getElementById("filter").style.display == "none"){
		document.getElementById('filter').style.display = "block";
		document.getElementById('filter').style.top = "30px";
		document.getElementById('filter').style.left = document.getElementById('myButton').offsetLeft-160+"px";
	}else{
		document.getElementById('filter').style.display = "none";
	}
}

function deleteFilter(){
	for(var i = 0; i < document.getElementsByName("cate").length; i++){
		document.getElementsByName("cate")[i].checked = false;
	}
	for(var i = 0; i < document.getElementsByName("sousCat").length; i++){
		document.getElementsByName("sousCat")[i].checked = false;
	}
	onSearch();
}

function allCheck(idCat){
	$.ajax({
		url : 'Defauts/Contenu/searchBox/getSousCat.php',
		data : {idCat : idCat},
		dataType : "TEXT",
		type :'POST', 
		success:function(data) 
		{
			var sousCat = eval("("+data+")");
			
			for(var i = 0; i < document.getElementsByName("cate").length; i++){
				if(document.getElementsByName("cate")[i].value == idCat){
					if(document.getElementsByName("cate")[i].checked == false){
						for(var i = 0; i < sousCat.length; i++){
							for(var j = 0; j < document.getElementsByName("sousCat").length; j++){
								if(sousCat[i] == document.getElementsByName("sousCat")[j].value){
									document.getElementsByName("sousCat")[j].checked = false;
								}
							}
						}
					}else{
						for(var i = 0; i < sousCat.length; i++){
							for(var j = 0; j < document.getElementsByName("sousCat").length; j++){
								if(sousCat[i] == document.getElementsByName("sousCat")[j].value){
									document.getElementsByName("sousCat")[j].checked = true;
								}
							}
						}
					}
				}
			}
			onSearch();
		}
	});
}

function checkSousCat(){
	onSearch();
}
</script>