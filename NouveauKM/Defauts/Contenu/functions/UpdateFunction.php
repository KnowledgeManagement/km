<?php
	session_start();
	include_once("../../../SQL/Fonctions_SQL/souscategorie.php");
	include_once("../../../SQL/Fonctions_SQL/categorie.php");
	include_once("../../../SQL/Fonctions_SQL/messagerie.php");
	require_once('../pclzip.lib.php');

	//Récupération du bon lien 
	$categorie = getCategorieById($_POST['categorie']);
	$souscategorie = getsousCategorieById($_POST['souscategorie']);
	$uploaddir = $_SERVER['DOCUMENT_ROOT'].'\Defauts\dlExemples\\'. utf8_decode($categorie[0]['nomCat']).'\\'.utf8_decode($souscategorie[0]['nomSousCat']).'\\';
	
	$link = explode("/", $_POST['link']);
	$reference = explode(".", $link[2]);
	$uploadfile = $uploaddir.$reference[0];
	
	if(!empty($_FILES['pj']['name']))
	{
		$extension = explode('.',$_FILES['pj']['name']);
		// Upload le fichier sur le serveur
		$nameOrigin = $uploaddir.$_FILES['pj']['name'];
		move_uploaded_file($_FILES['pj']['tmp_name'], $nameOrigin);
		
		$filename = $uploadfile.'.'.$extension[1];
		$zip = new PclZip($uploadfile.'.zip');
		$zip->create($nameOrigin,PCLZIP_OPT_REMOVE_ALL_PATH);
		
		// Suppression fichier coté serveur
		unlink($nameOrigin);
	}
	
	//Mise en forme des éléments rentrés
	$exemple = "" ;
	$souscategorie[0]['nomSousCat'] = strtolower($souscategorie[0]['nomSousCat']);
	
	if ($souscategorie[0]['nomSousCat'] == "html")
	{
		$souscategorie[0]['nomSousCat'] = "markup";
	}
	else if ($souscategorie[0]['nomSousCat'] == "C#")
	{
		$souscategorie[0]['nomSousCat'] = "csharp";
	}
	
	for ($i=0 ; $i<$_POST['nombre']+1 ; $i++)
	{
		$exemple .='<div class="panel panel-info">'.str_replace("'","''",htmlspecialchars($_POST['explication'.$i])).'</div></br></br>'.
					'<section class="language-'.$souscategorie[0]['nomSousCat'].'"><pre class="line-numbers" style="solid cadetblue 4px;">
					<code>'.str_replace("'","''",htmlspecialchars($_POST['exemple'.$i])).'</code></pre></section>';
	}
	$description = str_replace("'","''",htmlspecialchars($_POST['description']));
	$intitule = str_replace("'", "''",$_POST['intitule'] );
	addFunctionBddTmp(utf8_decode($_POST['id']), utf8_decode($intitule),utf8_decode($description),$exemple,utf8_decode($categorie[0]['nomCat']).'/'.utf8_decode($souscategorie[0]['nomSousCat']).'/'.utf8_decode($reference[0]).'.zip',$_POST['souscategorie'],$_SESSION['id']);
	header('Location:../../../accueil.php');

?>