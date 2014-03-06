var firstClick = 1;
function goToMailBoxRightContent(type){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/messRightContent.php',
		type :'POST', 
		data : {etat : type},
		dataType : 'text',
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Tous les messages");	
		}
	});
}

function goToMailBoxLeftContent(){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/messLeftContent.php',
		type :'POST', 
		success:function(data) 
		{
			$('#LeftContent').html(data);
			$('#titleLeftContent').html("Messagerie");
			$.ajax({
				url : 'Defauts/Contenu/WhoIsIt.php',
				type :'POST', 
				success:function(data) 
				{
					$('#header').html(data);
				}
			});
		}
	});
	
}

function openMessage(idMessage, objet){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/viewMessage.php',
		data : {type : 'mess',id : idMessage},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Objet : "+objet);
			goToMailBoxLeftContent();
			$.ajax({
				url : 'Defauts/Contenu/WhoIsIt.php',
				type :'POST', 
				success:function(data) 
				{
					$('#UserMenu').html(data);
				}
			});
		}
	});
}

function RedirectMessageModifie(idMessage, objet){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/viewMessage.php',
		data : {type : 'mess',id : idMessage},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Objet : "+objet);
			goToMailBoxLeftContent();
			$.ajax({
				url : 'Defauts/Contenu/WhoIsIt.php',
				type :'POST', 
				success:function(data) 
				{
					$('#UserMenu').html(data);
				}
			});
		}
	});
}

function openMessageContact(idMessage, objet){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/viewMessage.php',
		data : {type : 'cont', id : idMessage},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Objet : "+objet);
			goToMailBoxLeftContent();
			$.ajax({
				url : 'Defauts/Contenu/WhoIsIt.php',
				type :'POST', 
				success:function(data) 
				{
					$('#UserMenu').html(data);
				}
			});
		}
	});
}

function validMessage(idMessage){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/acceptMessage.php',
		data : {id : idMessage, comm : document.getElementById('commentaire').value},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			goToMailBoxRightContent('allMessages');
			goToMailBoxLeftContent();
		}
	});
}

function refuseMessage(idMessage){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/refuseMessage.php',
		data : {id : idMessage, comm : document.getElementById('commentaire').value},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			goToMailBoxRightContent('allMessages');
			goToMailBoxLeftContent();
		}
	});
}

function deleteMessages(){
	var i;
	var nb = 0;
	var list = new Array();
	var objs = document.getElementsByName('boxMess[]');
	var nbElements = objs.length;
	for (i = 0; i< nbElements ; i++){
		if (objs[i].checked){
			nb++;
			list.push(document.getElementsByName('boxMess[]')[i].value);
		}
	}
	if(nb == 0){
		alert("Veuillez sélectionner au moins un message !");
	}else{
		if(confirm("Êtes-vous sûrs de vouloir supprimer ces messages ?")){
			$.ajax({
				url : 'Defauts/Contenu/mailBox/deleteMessages.php',
				data : {lesMessages : list},
				dataType : 'text',
				type :'POST',
				success:function(data) 
				{
					goToMailBoxLeftContent();
					goToMailBoxRightContent('allMessages');
					$.ajax({
						url : 'Defauts/Contenu/WhoIsIt.php',
						type :'POST', 
						success:function(data) 
						{
							$('#UserMenu').html(data);
						}
					});
				}
			});
		}
	}
}

function openMessageContributeur(idMessage, objet){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/viewMessage.php',
		data : {type : 'mess',id : idMessage},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Objet : "+objet);
		}
	});
}

function openMessageContactContributeur(idMessage, objet){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/viewMessage.php',
		data : {type : 'cont', id : idMessage},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Objet : "+objet);
		}
	});
}

function modifMessage(idMessage, objet){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/modifyMessage.php',
		data : {id : idMessage},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Objet : "+objet);
		}
	});
}

function showSousCategorie(idMessage, idCategorie){
	$.ajax({
		url : 'Defauts/Contenu/mailBox/modifyMessage.php',
		data : {id : idMessage, idCategorie : idCategorie},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
		}
	});
}

function clickOnExemple(idMessage, action){
	if(firstClick == 1){
		var data = $('#myGreatExemple').html();
		$.ajax({
			url : 'Defauts/Contenu/functions/changeExemple.php',
			data : {idMessage : idMessage, action : "modify"},
			dataType : 'text',
			type :'POST', 
			success:function(data) 
			{
				$('#myGreatExemple').html(data);
				firstClick = 0;
			}
		});
	}/*else{
		$.ajax({
			url : 'Defauts/Contenu/functions/changeExemple.php',
			data : {idMessage : idMessage, action : "write"},
			dataType : 'text',
			type :'POST', 
			success:function(data) 
			{
				$('#myGreatExemple').html(data);
				firstClick = 1;
			}
		});
	}*/
}

function modifExemple(idMessage){
	if(firstClick == 0){
		$.ajax({
			url : 'Defauts/Contenu/functions/changeExemple.php',
			data : {idMessage : idMessage, action : "write"},
			dataType : 'text',
			type :'POST', 
			success:function(data) 
			{
				$('#myGreatExemple').html(data);
				firstClick = 1;
			}
		});
	}
}

function saveExemple(){
	var contenu = document.getElementById('textExemple').value;
	str = contenu.replace(/\n/g, "\n"+"/g");
	$.ajax({
		url : 'Defauts/Contenu/functions/changeExemple.php',
		data : {action : "save", contenu : document.getElementById('textExemple').value},
		dataType : 'text',
		type :'POST'
	});
}