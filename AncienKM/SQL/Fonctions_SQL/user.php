<?php
include_once("connexion.php");

/* Selectionne l'identifiant et le mot de passe de l'utilisateur avec en paramètre l'identifiant et 
* le mot de passe saisit sur le formulaire de connexion
* Si les deux champs saisis sont dans la base de données et correspondent à un même utilisateur, alors l'utilisateur existe 
* et la fonction renvoie vrai, sinon faux.
*/
function verifLogin($login,$pass){
	$sql = run("SELECT m5f_user.login, m5f_user.mdp 
				FROM m5f_user 
				WHERE login = '".$login."' 
				AND mdp = '".md5($pass)."';");
	if($sql) {
		return true;
	}
	else{
		return false;
	}
}

/* Selectionne les informations d'un utilisateur avec en paramètre son identifiant et son mot de passe */
function getUser($login,$pass){
	$sql = run("SELECT * 
				FROM m5f_user 
				WHERE login = '".$login."' 
				AND mdp = '".md5($pass)."';");
	return $sql;
}

/* Selectionne les informations de tous les utilisateurs */
function getAllUser(){
	$sql = run("SELECT * 
				FROM m5f_user;");
	return $sql;
}

/* Selectionne les informations d'un utilisateur précis avec en paramètre son identifiant */
function getUserById($id){
	$sql = run("SELECT * 
				FROM m5f_user 
				WHERE idUser = '".$id."'");
	return $sql;
}

function getUserByAlpha($alpha){
	$sql = run("SELECT *
				FROM m5f_user
				WHERE nom LIKE '".$alpha."%'");
	return $sql;
}

function modifyPassword($idUser, $mdp){
	$sql = run("UPDATE m5f_user set mdp = '".md5($mdp)."' where idUser = ".$idUser);
}

function updateFromAD(){
	$sql = run("INSERT INTO m5f_user (login,mdp,nom,prenom,mail,fonction)
				SELECT  givenName,dbo.MD5(givenName),sn,givenName,mail,title
				FROM OPENQUERY (ADSI, 'SELECT givenName,initials,telephoneNumber,sn,mail,title
				FROM ''LDAP://M5F.ProjetKM.lan''
				WHERE objectCategory = ''Person'' AND objectClass = ''user''
				')
				WHERE givenName IS NOT NULL 
				AND sn IS NOT NULL
				AND title IS NOT NULL
				AND givenName NOT IN (SELECT login from m5f_user);
			");
}

function sendContact($objet, $description){
	$sql = run("INSERT INTO m5f_contact(objet, contenu, lu, date, idUser) values('".$objet."', '".$description."', 0, GetDate(), ".$_SESSION['id'].")");
}

?>