<?php
include_once("connexion.php");

/* Selectionne les données des sous-catégories */
function getAllSousCategorie(){
	$sql = run("SELECT idSousCat, nomSousCat, idCat
				FROM m5f_sous_categorie;");
	return $sql;
}

/* Selectionne les données d'une sous-catégorie pour une catégorie précise dont on précisera l'identifiant en paramètre */
function getSousCategorieByCategorie($id){
	$sql = run("SELECT idSousCat, nomSousCat, idCat 
				FROM m5f_sous_categorie 
				WHERE idCat = '".$id."'
				ORDER BY nomSousCat");
	return $sql;
}

/* Selectionne les données d'une sous-catégorie dont on précisera son identifiant en paramètre */
function getSousCategorieById($id){
	$sql = run("SELECT idSousCat, nomSousCat, nomCat, m5f_categorie.idCat
				FROM m5f_sous_categorie, m5f_categorie
				where m5f_categorie.idCat = m5f_sous_categorie.idCat
				and idSousCat = ".$id);
	return $sql;
}

/* Ajoute une sous-catégorie. On précisera les valeurs "intitulé" et l'"identifiant" de la catégorie pour laquelle la sous-catégorie est rattachée */
function addSousCategorie($intitule_sous_cat,$id_cat){
	$sql = run("INSERT INTO m5f_sous_categorie(nomSousCat, idCat) 
				VALUES('".$intitule_sous_cat."','".$id_cat."')");
}

function UpdateSousCategorie($intitule_sous_cat, $id){
	$sql = run("UPDATE m5f_sous_categorie
				SET nomSousCat = '".$intitule_sous_cat."'
				WHERE idSousCat = '".$id."';");
	$sql1 = run("select idReference, lienTelechargement from m5f_document where idSousCat = ".$id);
	foreach($sql1 as $uneRequete){
		$lienTel = explode("/", $uneRequete['lienTelechargement']);
		run("update m5f_document set lienTelechargement = '".$lienTel[0]."/".$intitule_sous_cat.'/'.$lienTel[2]."' where idReference = '".$uneRequete['idReference']."'");
	}
	$sql2 = run("select idReferenceTmp, lienTelechargementTmp from m5f_tmp where idSousCat = ".$id);
	foreach($sql2 as $uneRequete){
		$lienTel = explode("/", $uneRequete['lienTelechargementTmp']);
		run("update m5f_tmp set lienTelechargementTmp = '".$lienTel[0]."/".$intitule_sous_cat.'/'.$lienTel[2]."' where idReferenceTmp = '".$uneRequete['idReferenceTmp']."'");
	}
}

function getSousCategorieDinstinctCategorie(){
	$sql = run("SELECT DISTINCT(idCat)
				FROM m5f_sous_categorie");
	return $sql;
}

function getFunctionNameBySousCategorie($id){
	$sql = run("SELECT intituleDoc, idReference 
				FROM m5f_document
				WHERE idSousCat = ".$id."
				ORDER by intituleDoc");
	return $sql;
}

function getFunctionBySousCategorie($id){
	$sql = run("SELECT intituleDoc, idReference, date, description, exemple, lienTelechargement, nomSousCat, nomCat ,m5f_sous_categorie.idSousCat, m5f_categorie.idCat
				FROM m5f_document, m5f_sous_categorie, m5f_categorie
				WHERE idReference = '".$id."'
				and m5f_document.idSousCat = m5f_sous_categorie.idSousCat
				and m5f_sous_categorie.idCat = m5f_categorie.idCat");
	return $sql;
}

function getFunctionBySousCategorieTmp($id){
	$sql = run("SELECT idReferenceTmp, intituleTmp, descriptionTmp, dateTmp, etatTmp, exempleTmp, commentaireTmp, lienTelechargementTmp
				FROM m5f_tmp
				WHERE idReferenceTmp = '".$id."'");
	
	return $sql;

	}

function getCategorieByReference($reference){
	$sql = run("select nomSousCat, nomCat from m5f_sous_categorie, m5f_categorie, m5f_document where m5f_categorie.idCat = m5f_sous_categorie.idCat and m5f_sous_categorie.idSousCat = m5f_document.idSousCat and m5f_document.idReference='".$reference."'");
	return $sql;
}

function deleteFiles($reference)
{
	$info = getFunctionBySousCategorie($reference);
	$directory = $_SERVER['DOCUMENT_ROOT'].'\Defauts\dlExemples\\'.utf8_decode($info[0]['lienTelechargement']);
	unlink($directory);
}

function findLink($reference){
	$info = getFunctionBySousCategorie($reference);
	$directory = $info[0]['lienTelechargement'];
	return $directory;
}

function deleteFunction($reference){
	deleteFiles($reference);
	$sql = run("DELETE from m5f_document WHERE idReference = '".$reference."'");
}

function deleteFunctionBySousCategorie($idSousCat){
	deleteFiles($idSousCat);
	$sql = run("DELETE from m5f_document WHERE idSousCat = '".$idSousCat."'");
}

/* Supprime une sous-catégorie avec en paramètre son identifiant */
function deleteSousCategorie($id){
	deleteFiles($id);
	$sql = run("DELETE FROM m5f_document WHERE idSousCat = '".$id."'");
	$sql = run("DELETE FROM m5f_tmp WHERE idSousCat = '".$id."'");
	$sql = run("DELETE FROM m5f_sous_categorie WHERE idSousCat = '".$id."';");
}
?>