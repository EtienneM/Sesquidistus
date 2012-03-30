/* 
 * Fading jQuery + redirection vers la page d'accueil après une tempo de 2sec
 */
$(document).ready(
  function()
  {
    $("div > p").hide().fadeIn(1500);
  }
);
	
function reload()
{
  window.location.href="./?categorie=accueil";
}
window.setTimeout("reload()", 2000);
