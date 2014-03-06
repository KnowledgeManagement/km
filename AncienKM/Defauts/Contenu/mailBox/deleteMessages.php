<?php
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
	$lesMessages = $_POST['lesMessages'];
	for($i = 0; $i < sizeof($lesMessages);$i++){
		if(is_numeric(substr($lesMessages[$i], 5))){
			deleteMessagesContact(substr($lesMessages[$i], 5));
		}else{
			deleteMessages(substr($lesMessages[$i], 5));
		}
	}
?>