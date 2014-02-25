<?php
	include_once "../../../SQL/Fonctions_SQL/messagerie.php";
									
	$allRead = countMessAllRead();
	$notRead = countMessNotRead();
	$read = countMessRead();
?>
<span class="pointer" onclick='javascript:goToMailBoxRightContent("allMessages")'><b>(<?php echo $allRead; ?>)</b> Tous les messages<br/></span>
<span class="pointer" onclick='javascript:goToMailBoxRightContent("read")'><b>(<?php echo $read; ?>)</b> Message(s) lu(s)<br/></span>
<span class="pointer" onclick='javascript:goToMailBoxRightContent("notRead")'><b>(<?php echo $notRead; ?>)</b> Message(s) non lu(s)</span>
																