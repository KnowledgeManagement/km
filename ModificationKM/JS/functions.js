function goToFunction(sousCategorie){
	getLink(sousCategorie);
	goToFunctionLeftContent(sousCategorie, 'aucun');
	goToFunctionRightContent(sousCategorie);
}

function getLink(sousCategorie){
	$.ajax({
		url : 'Defauts/Contenu/functions/getLink.php',
		type :'POST', 
		data : {sousCate : sousCategorie},
		dataType : 'text',
		success:function(data) 
		{
			var doc = eval('(' + data + ')');
			$('#titleRightContent').html(doc['nomCat']+" <i class='glyphicon glyphicon-minus'></i> "+doc['nomSousCat']);
			$('#titleLeftContent').html(doc['nomSousCatGauche']);
		}
	});
}

function goToFunctionRightContent(sousCategorie){
	$.ajax({
		url : 'Defauts/Contenu/functions/rightContent.php',
		type :'POST', 
		data : {sousCate : sousCategorie},
		dataType : 'text',
		success:function(data) 
		{
			$('#RightContent').html(data);
		}
	});
}

function goToFunctionLeftContent(sousCategorie, fct){
	$.ajax({
		url : 'Defauts/Contenu/functions/leftContent.php',
		type :'POST', 
		data : {sousCate : sousCategorie, fct : fct},
		dataType : 'text',
		success:function(data) 
		{
			$('#LeftContent').html(data);
		}
	});
}

function seeFunction(intitule, sousCategorie, idReference){
	$.ajax({
		url : 'Defauts/Contenu/functions/seeFunction.php',
		type :'POST', 
		data : {idReference : idReference, sousCategorie : sousCategorie},
		dataType : 'text',
		success:function(data) 
		{
			$.ajax({
				url : 'Defauts/Contenu/functions/getLink.php',
				type :'POST', 
				data : {sousCate : sousCategorie},
				dataType : 'text',
				success:function(data) 
				{
					var doc = eval('(' + data + ')');
					$('#titleRightContent').html(doc['nomCat']+" <i class='glyphicon glyphicon-minus'></i> "+doc['nomSousCat']+" <i class='glyphicon glyphicon-minus'></i> "+intitule);
				}
			});
			goToFunctionLeftContent(sousCategorie, idReference);
			$('#RightContent').html(data);
		}
	});
}

function deleteFunction(idReference, sousCategorie){
	if(confirm("Êtes-vous sûr de vouloir supprimer cette fonction de la base ?")){
		$.ajax({
			url : 'Defauts/Contenu/functions/deleteFunction.php',
			type :'POST', 
			data : {idReference : idReference},
			dataType : 'text',
			success:function(data) 
			{
				goToFunction(sousCategorie);
			}
		});
	}
}

function downloadFunction(lien){
	window.open("ftp://www.knowledgemanagement.fr/Defauts/dlExemples/"+escape(lien));
}

function addFunctionContributeur(sousCategorie, categorie){
	$.ajax({
		url : 'Defauts/Contenu/functions/addFunction.php',
		type :'POST',
		data : {idCategorie : categorie, idSousCategorie : sousCategorie},
		dataType : 'text',
		success:function(data) 
		{
			$('#RightContent').html(data);
		}
	});
}

function showSousCategorieAddFunction(idCategorie){
	$.ajax({
		url : 'Defauts/Contenu/functions/addFunction.php',
		type :'POST',
		data : {idCategorie : idCategorie},
		dataType : 'text',
		success:function(data) 
		{
			$('#RightContent').html(data);
		}
	});
}

/*function fieldVerification(){
	if (document.getElementById('description').value == "")
	{
		alert('Vérifier le champ description');
	}
	else if (document.getElementById('exemple').value == "")
	{
		alert('Vérifier le champ exemple');
	}
	else if (document.getElementById('piecejointe').value == "")
	{
		alert('Vérifier qu\'il y a une piéce jointe');
	}
}*/
function addexemple(){
	var id = document.getElementById('nombre').value;
	id++;
	var explication=new Array;
	var exemple = new Array;
	for(var i=0;i<id;i++)
	{
		explication[i] = document.getElementById('explication'+i).value;
		exemple[i] = document.getElementById('exemple'+i).value;
	}
	var table=document.getElementById('tablefunction');
	var description = document.getElementById('description').value;
	var intitule = document.getElementById('intitule').value;
	
	document.getElementById('nombre').value=id;
	
$.ajax({
		url : 'Defauts/Contenu/functions/addTextarea.php',
		type :'POST', 
		data:{
				id:id
		},
		dataType : 'text',
		success:function(data) 
		{
			table.innerHTML += data;
			document.getElementById('intitule').value=intitule;
			document.getElementById('description').value=description;
			for(var j=0;j<id;j++)
			{
				document.getElementById('explication'+j).value=explication[j];
				document.getElementById('exemple'+j).value=exemple[j];
			}
		}
	});
}

function modifyFunction(idReference, objet){
	$.ajax({
		url : 'Defauts/Contenu/functions/modifyFunction.php',
		data : {idReference : idReference},
		dataType : 'text',
		type :'POST', 
		success:function(data) 
		{
			$('#RightContent').html(data);
			$('#titleRightContent').html(objet);
		}
	});
}