/* Ce fichier sert lors de l'ajout d'un nouveau sujet,
 * il vérifie qu'il y a bien quelque chose dans les différents
 * champs a remplir. Il affiche le cas échéant une dialog
 * jQuery pour informer l'utilisateur. Et change la couleur des 
 * champs non remplis.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

$("#remp_attr").dialog({	 autoOpen: false,
									 width: 400,
									 closeText: 'X',
									 draggable: false,
									 resizable: false,
									 modal: true,
									 buttons: {"Ok": function(){$(this).dialog("close");}}	
});

$("#poster").click(
	function(){
		if($("#titre").attr("value") == "" || $("#elm1").attr("value") == "")
		{
			$("#remp_attr").dialog("open");
			if($("#titre").attr("value") == "") $("#titre").attr("style", "background-color:#FF7373;");
			return false;
		}
		else $("#ajout_topic").submit();
	}
);				   