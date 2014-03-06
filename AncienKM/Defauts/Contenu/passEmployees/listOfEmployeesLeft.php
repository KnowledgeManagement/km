<?php 
	
include_once "../../../SQL/Fonctions_SQL/user.php";

?>

<a href="#" class="alpha" onclick="javascript:seeListOfEmployees('')">[All]</a>

<?php 

for ($i=65; $i<=90; $i++) {
	$lettre = chr($i);
?>
	<a href="#" class="alpha" onclick="javascript:seeListOfEmployees('<?php echo $lettre; ?>')">[<?php echo $lettre ?>]</a>
<?php 
}
?>
