function goToPage(){
	$.ajax({
		url : 'Defauts/Contenu/passEmployees/listOfEmployees.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Liste des personnes inscrites <span style='float:right;margin-top:-15px;'><input type='button' class='bouton' style='width:140px' onclick='javascript:synchroAD()' value='Synchroniser AD'/></span>");
		}
	});
}

function goToPageLeft(){
	$.ajax({
		url : 'Defauts/Contenu/passEmployees/listOfEmployeesLeft.php',
		type :'POST', 
		success:function(data) 
		{
			$('#LeftContent').html(data);
			$('#titleLeftContent').html("Utilisateurs");
		}
	});
}

function reinitPass(idUser){
	if(confirm("Êtes-vous sûr de vouloir réinitialiser le mot de passe de cet utilisateur ?")){
		$.ajax({
			url : 'Defauts/Contenu/passEmployees/listOfEmployees.php',
			data:{idUser:idUser},
			dataType:'TEXT',
			type :'POST', 
			success:function(data) 
			{
				$('#RightContent').html(data);
				$('#titleRightContent').html("Liste des personnes inscrites");
				$('#LeftContent').html("");
			}
		});
	}	
}

function synchroAD(){
	
}

function seeListOfEmployees(lettre){
	$.ajax({
		url : 'Defauts/Contenu/passEmployees/seeListOfEmployees.php',
		type :'POST', 
		data : {lettre : lettre},
		dataType : 'text',
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Liste des personnes inscrites <span style='float:right;margin-top:-15px;'><input type='button' class='bouton' style='width:140px' onclick='javascript:synchroAD()' value='Synchroniser AD'/></span>");
		}
	});
}