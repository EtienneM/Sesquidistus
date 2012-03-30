/* Fichier js pour les traitements 
 * d'ajout de sous-catégorie.
 * (Utilisé dans l'administration du forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Fonction pour le traitement d'ajout des sous-catégories.*/
function add_scat(sData) {
	var cat = sData.getElementsByTagName("rang");
	var selec = document.getElementById("rang");
	var option = sData.getElementsByTagName("option");
	selec.innerHTML = "";
	var elem = document.createElement("option");
	elem.setAttribute("value", option.length+1);
	elem.innerHTML = option.length+1;
	selec.appendChild(elem);
	for(var i=option.length-1; i>=0; i--)
	{
		var elem = document.createElement("option");
		var val = option[i].getAttribute("value");
		elem.setAttribute("value", val);
		elem.innerHTML = val;
		selec.appendChild(elem);
	}
	document.getElementById("max").value = option.length+1;
}

/*Fonction qui exécute le traitement ajax.*/
function ajax(){
	request(add_scat, "add_scat", 
			document.getElementById("categorie").options[document.getElementById("categorie").selectedIndex].value);				
};

/*Appel de la fonction au chargement de la page.*/
ajax();

/*Définition de l'évènement onchange.*/
document.getElementById("categorie").onchange = ajax;