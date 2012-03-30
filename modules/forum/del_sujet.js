/* Fichier js pour la suppression
 * de sujet pendant le parcours du forum.
 * (Utilisé dans le forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Redéfinission de l'action click sur la croix */
$("span.del > a").click(
	function(event) {
		if(!confirm("Etes-vous sur de vouloir supprimer ce sujet?")){event.preventDefault();	}
	}
);
