
$(function() {
	$( "#ajoutDossierDialog" ).dialog({
		autoOpen: false,
		closeText: 'x',
		draggable: false,
		resizable: false,
		modal: true
	});

	$( "#ajoutDossier" ).click(function() {
		$( "#ajoutDossierDialog" ).dialog( "open" );
		return false;
	});

	$( "#confirmationDelete" ).dialog({
		autoOpen: false,
		width: 500,
		closeText: 'x',
		draggable: false,
		resizable: false,
		modal: true,
		buttons: {
			"Oui": function() {
				$( "#form" ).submit();
				$( this ).dialog( "close" );
			},
			"Non": function() {
				$( this ).dialog( "close" );
				document.location.replace("?categorie=admin_galerie_video");
			}
		}
	});

	$( "#btn_confirm_del" ).click(function() {
	  $( "#confirmationDelete" ).dialog( "open" );
		return false;
	});
});