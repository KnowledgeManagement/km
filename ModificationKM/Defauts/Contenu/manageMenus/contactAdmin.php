<?php
	session_start();
?>
<div class="form-inline">
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<td>Objet :</td>
				<td><input type="text" id="objet" class="form-control"/></td>
			</tr>
			<tr>
				<td>Description :</td>
				<td><textarea class="form-control" id="textarea" cols="75" rows="6" ></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="button" class="btn btn-sm btn-success" value="Envoyer" onclick="javascript:sendContact()"/></td>
			</tr>
		</table>
	</div>
</div>