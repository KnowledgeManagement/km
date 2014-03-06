<form method="POST" id="formulaire" name="formulaire"  action="../../../accueil.php">
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
	<input type="hidden" name="intitule" value="<?php echo $_GET['intitule']; ?>"/>
</form>
<script>
	document.formulaire.submit();
</script>