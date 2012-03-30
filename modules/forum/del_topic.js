/* Fichier js pour la suppression de sujet
 * (Utilisé dans l'administration du forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Fonction pour le traitement d'édition des catégories.*/
function del_topic(sData) 
{
	var cat = sData.getElementsByTagName("topics");
	var selec = document.getElementById("topics");
	var option = cat[0].getElementsByTagName("item");
	selec.innerHTML = "";

	if(option.length == 0){	
		document.getElementById("sujets").style.display="none";
		$("#no_topic").dialog({	 autoOpen: false,
											 width: 400,
											 closeText: 'X',
											 draggable: false,
											 resizable: false,
											 modal: true,
											 buttons: {"Ok": function(){$(this).dialog("close");}}	});
		$("#no_topic").dialog("open");
	}
	else{
		document.getElementById("sujets").style.display="block";
	

	for(var i=option.length-1; i>=0; i--)
	{
		var elem = document.createElement("option");
		var id = option[i].getAttribute("id");
		var libelle = option[i].getAttribute("nom");
		elem.setAttribute("value", id);
		elem.innerHTML = libelle;
		selec.appendChild(elem);	
	}
	document.getElementById("id").value = document.getElementById("topics").options[document.getElementById("topics").selectedIndex].value;
	}
}

/*Fonction qui exécute le traitement ajax.*/
function ajax()
{
	request(del_topic, "del_topic", 
				document.getElementById("scat").options[document.getElementById("scat").selectedIndex].value);				
};

/*Appel de la fonction au chargement de la page.*/
ajax();

/*Redéfinition des évènements onchange.*/
document.getElementById("scat").onchange = ajax;

document.getElementById("topics").onchange = function(){
	document.getElementById("id").value = document.getElementById("topics").options[document.getElementById("topics").selectedIndex].value;	
}
