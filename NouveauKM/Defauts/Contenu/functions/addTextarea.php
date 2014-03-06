<?php
	$i=$_POST['id'];
	echo'<tr>
		<td class="tdModifFunction">Explication n°'.$i.':</td>
		<td><textarea onkeydown="insertTab(this, event);" class="form-control" id="explication'.$i.'" name="explication'.$i.'"></textarea></td>
	</tr>
	<tr>
		<td class="tdModifFunction">Exemple n°'.$i.': </td>
		<td><textarea onkeydown="insertTab(this, event);" class="form-control" id="exemple'.$i.'" name="exemple'.$i.'"></textarea></td>
	</tr>';
?>