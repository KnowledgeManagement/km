<?php
	$i=$_POST['id'];
	echo'<tr>
		<td class="tdModifFunction">Explication n°'.$i.':</td>
		<td><textarea onkeydown="insertTab(this, event);" class="textarea" id="explication'.$i.'" name="explication'.$i.'" required ></textarea></td>
	</tr>
	<tr>
		<td class="tdModifFunction">Exemple n°'.$i.': </td>
		<td><textarea onkeydown="insertTab(this, event);" class="textarea" id="exemple'.$i.'" name="exemple'.$i.'" required></textarea></td>
	</tr>';
?>