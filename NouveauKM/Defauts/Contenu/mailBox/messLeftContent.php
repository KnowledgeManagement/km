<?php
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
									
	$allRead = countMessAllRead();
	$notRead = countMessNotRead();
	$read = countMessRead();
?>
<div class="list-group">
	<a class="list-group-item pointer" onclick='javascript:goToMailBoxRightContent("allMessages")'><b  class="badge"><?php echo $allRead; ?></b><i class="glyphicon glyphicon-envelope"></i> Tous les messages<br/></a>
	<a class="list-group-item pointer" onclick='javascript:goToMailBoxRightContent("read")'><b  class="badge"><?php echo $read; ?></b><i class="glyphicon glyphicon-check"></i> Message(s) lu(s)<br/></a>
	<a class="list-group-item pointer" onclick='javascript:goToMailBoxRightContent("notRead")'><b  class="badge"><?php echo $notRead; ?></b><i class="glyphicon glyphicon-unchecked"></i> Message(s) non lu(s)</a>
</div>