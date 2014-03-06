<?php
include_once("connexion.php");

/* Fonction qui retourne l'identifiant et l'intitulé des catégories */
function getAllCategorie(){
	$sql = run("SELECT idCat, nomCat
				FROM m5f_categorie
				ORDER BY idCat");
	return $sql;
}

/* Fonction qui retourne l'identifiant et l'intitulé d'une catégorie dont on précise l'identifiant */
function getCategorieById($id){
	$sql = run("SELECT idCat, nomCat 
				FROM m5f_categorie 
				WHERE idCat = '".$id."';");
	return $sql;
}

/* Fonction qui ajoute une catégorie dont on saisira l'intitulé */
function addCategorie($intitule_cat){
	$sql = run("INSERT INTO m5f_categorie(nomCat) 
				VALUES('".$intitule_cat."')");
}

/* Fonction qui supprime une catégorie dont on précisera l'identifiant */
function deleteCategorie($id){
	$sql = run("DELETE FROM m5f_categorie 
				WHERE idCat = '".$id."';");
}

/* Fonction qui met à jour une catégorie dont on précisera l'identifiant et le nouvel intitulé */
function UpdateCategorie($intitule_cat, $id){
	$sql = run("UPDATE m5f_categorie
				SET nomCat = '".$intitule_cat."'
				WHERE idCat = '".$id."';");
	$sql1 = run("select idReference, lienTelechargement from m5f_document, m5f_sous_categorie where m5f_sous_categorie.idSousCat = m5f_document.idSousCat and m5f_sous_categorie.idCat = ".$id);
	foreach($sql1 as $uneRequete){
		$lienTel = explode("/", $uneRequete['lienTelechargement']);
		run("update m5f_document set lienTelechargement = '".$intitule_cat."/".$lienTel[1].'/'.$lienTel[2]."' where idReference = '".$uneRequete['idReference']."'");
	}
	
	$sql2 = run("select idReferenceTmp, lienTelechargementTmp from m5f_tmp, m5f_sous_categorie where m5f_sous_categorie.idSousCat = m5f_tmp.idSousCat and m5f_sous_categorie.idCat = ".$id);
	foreach($sql2 as $uneRequete){
		$lienTel = explode("/", $uneRequete['lienTelechargementTmp']);
		run("update m5f_tmp set lienTelechargementTmp = '".$intitule_cat."/".$lienTel[1].'/'.$lienTel[2]."' where idReferenceTmp = '".$uneRequete['idReferenceTmp']."'");
	}
}
?>