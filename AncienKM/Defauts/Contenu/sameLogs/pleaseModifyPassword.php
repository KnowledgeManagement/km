<div id="shadowing" style="display: none;"></div>
<div id="box" style="">
	<span id="boxtitle"></span>
	<form method="post" id="formSameLogs" name="formSameLogs" action="Defauts/Contenu/sameLogs/modificationOfPassword.php">
		<p style="color : #1d3d5f">
			Attention !</br>
			Votre mot de passe et votre login sont identiques.<br/>
			Nous vous invitons à le modifier :
			<br /><br />
			Nouveau mot de passe : <input type="password" class="label" id="password" name="password"/>
		</p>
		<p style="margin-left : 130px;"> 
			<input type="button" class="bouton" onclick="javascript:validModif()" name="submit" value="Modifier"/>
			<input type="button" style="margin-left : 50px;" class="bouton" name="cancel" value="Plus tard" onclick="closebox('box', 'shadowing')"/>
		</p>
	</form>
</div>