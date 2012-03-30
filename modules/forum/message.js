/* Fichier js pour l'effet d'animation jQuery
 * qui réalise le fadein et qui redirige après un traitement.
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
/*
 * info
 *
 * @param : id du topic sur lequel on doit rediriger
 */ 
function info(t_id)
{
 $(document).ready(function() {
	$("div.box > p").hide().fadeIn(1500);
	}
 );
 function redir(){window.location.href="./?categorie=topic&id=" + t_id;}
 setTimeout(redir, 2500);
}