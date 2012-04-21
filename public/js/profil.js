/*
 * Ce fichier la dialog de confirmation du changement 
 * du mot de passe.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
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
           $("#pwd_form").submit();
           $(this).dialog("close");
         },
  "Non": function()
         {
	   $(this).dialog("close");                        
         }
  }
});
$("#btn_valider").click(
  function()
  {
    $("#confirmation").dialog("open");
    return false;
  }
);

