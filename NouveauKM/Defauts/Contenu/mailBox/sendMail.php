<?php
	session_start();
	include_once("../../../SQL/Fonctions_SQL/souscategorie.php");
	include_once("../../../SQL/Fonctions_SQL/categorie.php");
	include_once("../../../SQL/Fonctions_SQL/messagerie.php");
	require_once('../pclzip.lib.php');
	
	//-----------------------------------------------
	// FONCTION NOMBRE ALEATOIRE
	//-----------------------------------------------	
	
	function generateRandomString($length = 5)
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	//Récupération du bon lien 
	$categorie = getCategorieById($_POST['categorie']);
	$souscategorie = getsousCategorieById($_POST['sousCategorie']);
	$link = "";
	$reference = generateRandomString();
	
	if(!empty($_FILES['pj']['name'])){
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'\Defauts\dlExemples\\'. utf8_decode($categorie[0]['nomCat']).'\\'.utf8_decode($souscategorie[0]['nomSousCat']).'\\';
	 
		// Création de la référence aléatoire
		$extension = explode('.',$_FILES['pj']['name']);
		
		
		// Vérifie que la référence n'existe pas	
		$sql = run("SELECT idReferenceTmp FROM m5f_tmp WHERE idReferenceTmp = '".$reference."'");
		$sql2 = run("SELECT idReference FROM m5f_document WHERE idReference = '".$reference."'");
		$ok = 1;
		while ($ok == 1)
		{
			if ($reference == $sql[0]['idReferenceTmp'] || $reference == $sql2[0]['idReference']  )
			{
				$ok = 1;
				$reference = generateRandomString();
			}else{ $ok = 0; }
		}
		$uploadfile = $uploaddir.$reference;
		$nameOrigin = $uploaddir.$_FILES['pj']['name'];
		
		// Upload le fichier sur le serveur
		move_uploaded_file($_FILES['pj']['tmp_name'], $nameOrigin);
		
		$filename = $uploadfile.'.'.$extension[1];
		$zip = new PclZip($uploadfile.'.zip');
		$zip->create($nameOrigin,PCLZIP_OPT_REMOVE_ALL_PATH);
		
		// Suppression fichier coté serveur
		unlink($nameOrigin);
		$link = utf8_decode($categorie[0]['nomCat']).'/'.utf8_decode($souscategorie[0]['nomSousCat']).'/'.utf8_decode($reference).'.zip';
	}
		
	//Mise en forme des éléments rentrés
	$exemple = "" ;
	$souscategorie[0]['nomSousCat'] = strtolower($souscategorie[0]['nomSousCat']);
	if ($souscategorie[0]['nomSousCat'] == "html")
	{
		$souscategorie[0]['nomSousCat'] = "markup";
	}
	else if ($souscategorie[0]['nomSousCat'] == "c#")
	{
		$souscategorie[0]['nomSousCat'] = "csharp";
	}
	
	for ($i=0 ; $i<$_POST['nombre']+1 ; $i++)
	{
		$exemple .='<div class="cadreMessage">'.str_replace("'","''",htmlspecialchars($_POST['explication'.$i])).'</div></br></br>'.
					'<section class="language-'.$souscategorie[0]['nomSousCat'].'"><pre class="line-numbers" style="solid cadetblue 4px;">
					<code>'.str_replace("'","''",htmlspecialchars($_POST['exemple'.$i])).'</code></pre></section>';
	}
	$description = str_replace("'","''",htmlspecialchars($_POST['description']));
	$intitule = str_replace("'", "''",$_POST['intitule'] );
	addFunctionBddTmp(utf8_decode($reference),utf8_decode($intitule),utf8_decode($description),$exemple,$link,$_POST['sousCategorie'],$_SESSION['id']);

	// ENVOI DE MAIL
	
	// To
		$to = 'debas.thomas@gmail.com';
	 
	// Subject
		$subject = 'Nouvelle fonction ajoutée';
	 
	// clé aléatoire de limite
		$boundary = md5(uniqid(microtime(), TRUE));
	 
	// Headers
		$headers = 'From:'.$_SESSION['prenom'].' '.$_SESSION['nom'].'<'.$_SESSION['mail'].'>'."\r\n";
		//$headers = 'From: Matthieu J <thomasdebas@m5f.fr>'."\r\n";
		$headers .= 'Mime-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: multipart/mixed;boundary='.$boundary."\r\n";
		$headers .= "\r\n";
	 
	// Message
		$msg = 'This is a multipart/mixed message.'."\r\n\r\n";
	 
	// Texte
		$msg .= '--'.$boundary."\r\n";
		$msg .= 'Content-type:text/plain;charset=utf-8'."\r\n";
		$msg .= 'Content-transfer-encoding:8bit'."\r\n";
		$msg .= $description."\r\n";
	 
	// Pièce jointe

		$file_name = $uploaddir.$reference.'.zip';
		
		if (file_exists($file_name))
		{
			$file_type = filetype($file_name);
			$file_size = filesize($file_name);
		 
			$handle = fopen($file_name, 'r') or die('File '.$file_name.'can t be open');
			$content = fread($handle, $file_size);

			$content = chunk_split(base64_encode($content)); //chunk_split(base64_encode(file_get_contents($content)))."\n";			
			
			$f = fclose($handle);
		 
			$ext = $reference.".zip";
			$msg .= '--'.$boundary."\r\n";
			$msg .= 'Content-type:'.$file_type.';name='.$ext."\r\n";
			$msg .= 'Content-transfer-encoding:base64'."\r\n";
			$msg .= $content."\r\n";
		}
	 
	// Fin
		$msg .= '--'.$boundary."\r\n";
	 
	// Function mail()
		mail($to, $subject, $msg, $headers); 
	
	
	header('Location:../../../accueil.php');
?>