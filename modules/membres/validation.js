/*
 * Ce fichier regroupe les différentes actions 
 * possibles pour la fonction de validation des inscriptions
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/* Déclaration des variables. */
var call = document.getElementById("tous");
var check = document.getElementsByTagName("input");
var resultat = document.getElementById("res");

function change_check()
{
 var ch = false;
 if(this.checked || document.getElementById("tous").checked)
 {
   ch= true;
 }
 for(var i=0; i<check.length; i++)
 {
   if(check[i].getAttribute("type") == "checkbox")
   {
     check[i].checked = ch;
   }
 }
}

call.onclick = change_check;

document.getElementById("form_membre").onsubmit = function()
{
  for(var i=0; i<check.length; i++)
  {
    if(check[i].getAttribute("type") == "checkbox" && check[i].checked)
    {
      resultat.value = resultat.value + check[i].value + ";";
    }
  }
  this.submit();
};

$("#confirmation").dialog({
 autoOpen: false,
 width: 400,
 closeText: 'X',
 draggable: false,
 resizable: false,
 modal: true,
 buttons: {
  "Oui": function()
	 {
		 	$("#mode").attr("value", "confirm_suppression");
           $("#form_membre").submit();
           $(this).dialog("close");
         },
  "Non": function()
         {
	   $(this).dialog("close");                        
         }
  }
});
$("#supprimer").click(
  function()
  {
    $("#confirmation").dialog("open");
    return false;
  }
);
