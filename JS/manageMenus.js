function goToManageMenusRightContent(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/manageMenuRightContent.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Gérer les menus");	
		}
	});
}

function goToManageMenusLeftContent(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/manageMenuLeftContent.php',
		type :'POST', 
		success:function(data) 
		{
			$('#LeftContent').html(data);
			$('#titleLeftContent').html("Menus");
		}
	});
}

function goToEditMenu(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenusEditMenu.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Modifier un menu");
		}
	});
}

function goToEditSousMenu(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/EditSousMenu.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Modifier un sous-menu");
		}
	});
}function goToCreateMenu(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/CreateMenu.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Créer un menu");
		}
	});
}

function goToAddSousMenu(idCat, nomCat){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/AddSousMenu.php',
		type :'POST', 
		data : {idCat : idCat, nomCat : nomCat},
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Ajouter un sous-menu");
		}
	});
}

function goToEditMenu(idCat, nomCat){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/EditMenu.php',
		type :'POST', 
		data : {idCat : idCat, nomCat : nomCat},
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Modifier un menu");
		}
	});
}

function goToEditSousMenu(idSousCat, nomSousCat, idCat, nomCat){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/EditSousMenu.php',
		type :'POST', 
		data : {idSousCat : idSousCat, nomSousCat : nomSousCat, idCat : idCat, nomCat : nomCat},
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html("Modifier un sous-menu");
		}
	});
}

function contactAdmin(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/contactAdmin.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#LeftContent').html("");
			$('#titleLeftContent').html("Navigation");
			$('#titleRightContent').html("Formulaire de contact");
		}
	});
}

function sendContact(){
	if(document.getElementById('objet').value == "" || document.getElementById('textArea').value == ""){
		alert("Merci de remplir tous les champs.");
	}else{
		$.ajax({
			url : 'Defauts/Contenu/manageMenus/sendContact.php',
			data : {objet : document.getElementById('objet').value, description : document.getElementById('textArea').value},
			dataType : 'TEXT',
			type :'POST', 
			success:function(data) 
			{
				$('#RightContent').html("Votre formulaire a bien été envoyé.");
				$('#LeftContent').html("");
				$('#titleLeftContent').html("Navigation");
				$('#titleRightContent').html("Formulaire de contact");
			}
		});
	}
}

function seeMyAsking(){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/seeMyAsking.php',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#LeftContent').html("");
			$('#titleLeftContent').html("Navigation");
			$('#titleRightContent').html("Mes demandes");
		}
	});
}

function deleteSousCat(idSousCat, nomSousCat, nomCat){
	if(confirm("Êtes-vous sûr de vouloir supprimer cette sous-catégorie de la base ?")){
		$.ajax({
			url : 'Defauts/Contenu/manageMenus/DeleteSousMenu.php',
			type :'POST', 
			data : {idSousCat : idSousCat, nomSousCat : nomSousCat, nomCat : nomCat},
			dataType : 'text',
			success:function(data) 
			{
				goToManageMenusLeftContent();
				goToManageMenusRightContent();
			}
		});
	}
}

function deleteCat(idCat, nomCat){
	if(confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ?")){
		$.ajax({
			url : 'Defauts/Contenu/manageMenus/DeleteMenu.php',
			type :'POST', 
			data : {idCat : idCat, nomCat : nomCat},
			dataType : 'text',
			success:function(data) 
			{
				goToManageMenusLeftContent();
				goToManageMenusRightContent();
			}
		});
	}
}

function AddSousCat(nomSousCat, idCat, nomCat){
		$.ajax({
			url : 'Defauts/Contenu/manageMenus/AddSousMenuExecute.php',
			type :'POST', 
			data : {nomSousCat : nomSousCat, idCat : idCat, nomCat : nomCat},
			dataType : 'text',
			success:function(data) 
			{
				goToManageMenusLeftContent();
				goToManageMenusRightContent();
			}
		});
}

function CreateMenu(nomCat){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/CreateMenuExecute.php',
		type :'POST', 
		data : {nomCat : nomCat},
		dataType : 'text',
		success:function(data) 
		{
			goToManageMenusLeftContent();
			goToManageMenusRightContent();
		}
	});
}

function EditCat(nomCat, idCat, oldCat){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/EditMenuExecute.php',
		type :'POST', 
		data : {nomCat : nomCat, idCat : idCat, oldCat : oldCat},
		dataType : 'text',
		success:function(data) 
		{
			goToManageMenusLeftContent();
			goToManageMenusRightContent();
		}
	});
}

function EditSousCat(nomSousCat, idSousCat, nomCat, oldSousCat){
	$.ajax({
		url : 'Defauts/Contenu/manageMenus/EditSousMenuExecute.php',
		type :'POST', 
		data : {nomSousCat : nomSousCat, idSousCat : idSousCat, nomCat : nomCat, oldSousCat : oldSousCat},
		dataType : 'text',
		success:function(data) 
		{
			goToManageMenusLeftContent();
			goToManageMenusRightContent();
		}
	});
}