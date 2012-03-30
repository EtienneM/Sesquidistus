
$(function() {
	$( "#ajoutAlbumDialog" ).dialog({
		autoOpen: false,
		closeText: 'x',
		draggable: false,
		resizable: false,
		modal: true
	});

	$( "#ajoutAlbum" ).click(function() {
		$( "#ajoutAlbumDialog" ).dialog( "open" );
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
				document.location.replace("?categorie=admin_galerie");
			}
		}
	});

	$( "#btn_confirm_del" ).click(function() {
		$( "#confirmationDelete" ).dialog( "open" );
		return false;
	});
});