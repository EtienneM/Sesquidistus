/* Fichier js pour l'édition de sous-catégorie
 * (Utilisé dans l'administration du forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Fonction pour le traitement d'édition des catégories.*/
function edit_scat(sData)
{
	var scat = sData.getElementsByTagName("item");
	document.getElementById("nom").value = scat[0].getAttribute("nom");
	document.getElementById("desc").value = scat[0].getAttribute("desc");
	document.getElementById("rg").value = scat[0].getAttribute("rang");
	document.getElementById("max").value = scat[0].getAttribute("max");
	document.getElementById("id_cat").value = scat[0].getAttribute("id_cat");
	var sel_rang = document.getElementById("rang");
	var rang = scat[0].getAttribute("rang");
	var nb = scat[0].getAttribute("max");


	//On vire tout
	sel_rang.innerHTML="";

	for(var i=1; i<=nb; i++){
	  var option =document.createElement("option");
	  option.setAttribute("value", i);
	  option.innerHTML = i;	
	  if(rang == nb){option.setAttribute("selected", "selected");}
	  sel_rang.appendChild(option);
	}
}

/*Fonction qui exécute le traitement ajax.*/
function ajax()
{
	request(edit_scat, "edit_scat", 
				document.getElementById("scat").options[document.getElementById("scat").selectedIndex].value);				
};

/*Appel de la fonction au chargement de la page.*/
ajax();

/*Définition de l'évènement onchange.*/
document.getElementById("scat").onchange = ajax;
