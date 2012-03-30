/* Fichier js pour l'édition de catégorie
 * (Utilisé dans l'administration du forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Fonction pour le traitement d'édition des catégories.*/
function edit_cat(sData)
{
	var cat = sData.getElementsByTagName("item");
	var selec = document.getElementById("rang");
	var rg = document.getElementById("rg");
	var option = selec.getElementsByTagName("option");
	var rang = cat[0].getAttribute("rang");

	rg.value = cat[0].getAttribute("rang");
	document.getElementById("nom").value = cat[0].getAttribute("nom");

	for(var i=0, cmp = 1; i<option.length; i++)
	{
		option[i].removeAttribute("selected");		
		if(rang == option[i].getAttribute("value")){
 		  option[i].setAttribute("selected", "selected");	
		}
	}
}

/*Fonction qui exécute le traitement ajax.*/
function ajax()
{
	request(edit_cat, "edit_cat", 
				document.getElementById("categorie").options[document.getElementById("categorie").selectedIndex].value);				
};

/*Appel de la fonction au chargement de la page.*/
ajax();

/*Définition de l'évènement onchange.*/
document.getElementById("categorie").onchange = ajax;
