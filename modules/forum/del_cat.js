/* Fichier js pour les traitements 
 * de suppression de catégorie.
 * (Utilisé dans l'administration du forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/*Paramètres de la dialog*/
$("#confirmation").dialog({ autoOpen: false,
										width: 400,
										closeText: 'X',
										draggable: false,
										resizable: false,
										modal: true,
										buttons: { "Oui": function() {
												        $("#action_form").submit();
												        $(this).dialog("close");
													 },
													   "Non": function(){
														$(this).dialog("close");                        
     												 }
  													}
});

/*Redéfinission de l'action click sur le bouton valider*/
$("#btn_valider").click(function(){$("#confirmation").dialog("open"); return false;});

