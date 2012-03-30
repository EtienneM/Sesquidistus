
$(function() {
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
				var lien = $( "#form" ).attr('action');
				document.location.replace(lien);
			}
		}
	});

	$( "#confirmationMove" ).dialog({
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
				var lien = $( "#form" ).attr('action');
				document.location.replace(lien);
			}
		}
	});
                
	$( "#Valider" ).click(function() {
		if ( $('input[type=radio][name=action]:checked').attr('value') == "delete" ) {
			$( "#confirmationDelete" ).dialog( "open" );
		}
		else if ( $('input[type=radio][name=action]:checked').attr('value') == "move" ) {
			$( "#confirmationMove" ).dialog( "open" );
		}
		return false;
	});
});