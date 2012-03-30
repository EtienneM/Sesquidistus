/*
 * Ce fichier regroupe les différentes actions 
 * possibles pour les traitements d'un membre, 
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
/*
 * Fonction qui permet de récupéré l'objet XHR,
 * en fonction du navigateur utilisé.
 */
function getXMLHttpRequest()
{
  var xhr = null;
  if(window.XMLHttpRequest || window.ActiveXObject)
  {
    if(window.ActiveXObject)
    {
      try{
	   xhr = new ActiveXObject("Msxml2.XMLHTTP");
	 }
      catch(e){
	        xhr = new ActiveXObject("Microsoft.XMLHTTP");
	      }
     } 
     else
     {
       xhr = new XMLHttpRequest();
     }
  }
  else
  {
    alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
    return null;
  }	
  return xhr;
}


function request(callback, mode)
{
  var xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function(){
  if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
  {
    callback(xhr.responseXML);
    document.getElementById("wait").style.display ="none";	
  }
  else if(xhr.readyState < 4)
  {
    document.getElementById("wait").style.display ="inline";	
  }
};
  /* Envoie en POST */
  xhr.open("POST", "./modules/membres/traitements_ajax.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("mode=" + encodeURIComponent(mode));
}

/*
 * Fonction qui réalise le fadein en jQuery
 * et qui redirige après un traitement.
 */
function info()
{
 $(document).ready(function() {$("div.box > p").hide().fadeIn(1500);});
 function redir(){window.location.href="./?categorie=login";}
 setTimeout(redir, 2500);
}
