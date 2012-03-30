/* 
 * Fonction qui retour l'objet xhr
 * pour les requêtes en ajax.
 */
function getXMLHttpRequest() {
  var xhr = null;
  if(window.XMLHttpRequest || window.ActiveXObject){
    if(window.ActiveXObject){
	  try{ xhr = new ActiveXObject("Msxml2.XMLHTTP");}
	  catch(e){xhr = new ActiveXObject("Microsoft.XMLHTTP");}
	} 
	else{xhr = new XMLHttpRequest();}
  }else{
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
  }	
  return xhr;
}

/*
 * Fonction qui réalise les demandes au serveur.
 */
function request(callback, mode, valeur) {
  var xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
       callback(xhr.responseXML);
       document.getElementById("wait").style.display ="none";	
	}
	else if(xhr.readyState < 4) {
		document.getElementById("wait").style.display ="inline";	
	}
};
    /* Envoie en POST */
	xhr.open("POST", "./modules/forum/traitements_ajax.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("mode=" + encodeURIComponent(mode) + "&valeur=" + encodeURIComponent(valeur));
}

/*
 * Fonction qui réalise le fadein en jQuery
 * et qui redirige après un traitement.
 */
function info(){
 $(document).ready(function() {$("div.box > p").hide().fadeIn(1500);});
 function redir(){window.location.href="./?categorie=admin_forum";}
 setTimeout(redir, 2500);
}
