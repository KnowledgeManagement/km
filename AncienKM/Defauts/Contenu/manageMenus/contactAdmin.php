<?php
	session_start();
?>
<br/>
Objet : <input type="text" id="objet" class="label"/><br/><br/>
Description :<br/><br/>

<textarea class="textarea" id="textArea"></textarea><br/><br/>
<div style="width : 100%; text-align : right;">
	<input type="button" class="bouton" value="Envoyer" onclick="javascript:sendContact()"/>
</div>