/*
 * Fonction qui réalise le fadein en jQuery
 * et qui redirige après un traitement.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
function info()
{
 $(document).ready(function() {$("div.box > p").hide().fadeIn(1500);});
 function redir(){window.location.href="./?categorie=accueil";}
 setTimeout(redir, 5000);
}
