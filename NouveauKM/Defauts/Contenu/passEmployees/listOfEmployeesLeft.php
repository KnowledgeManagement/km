<?php 
	
include_once "../../../SQL/Fonctions_SQL/user.php";

?>
<div class="list-group">
	<div class="list-group-item list-group-item-info">
		<i class="glyphicon glyphicon-list"></i> Affichage
	</div>
	<div class="list-group-item">
		<a href="#" style="text-decoration:none;" onclick="javascript:seeListOfEmployees('')">[All]</a>

		<?php 

		for ($i=65; $i<=90; $i++) {
			$lettre = chr($i);
		?>
			<a href="#" style="text-decoration:none;" onclick="javascript:seeListOfEmployees('<?php echo $lettre; ?>')">&nbsp;<?php echo $lettre ?>&nbsp;</a>
		<?php 
		}
		?>
	</div>
</div>