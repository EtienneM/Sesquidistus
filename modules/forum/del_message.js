/* Fichier js pour la suppression
 * de message pendant le parcours d'un sujet.
 * (Utilisé dans le forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Redéfinission de l'action click sur la croix */
$("a.del_message").click(
	function(event){
		if(!confirm("Etes-vous sur de vouloir supprimer ce message?")){event.preventDefault();}
	}
);
