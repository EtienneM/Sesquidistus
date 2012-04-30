$(document).ready(function() {
    /*
     * Ne pas pouvoir supprimer un certain nombre de types d'évènement
     */
    $('select#listeEvent').bind('change click keypress', function(){
        // If the selection has changed
        if( $(this).data('selection') != $('option:selected', this).val() ) {
            if ($.inArray($('option:selected', this).val(), ['1', '4', '5']) != -1) {
                $('#supprType').css('display', 'none');
            } else {
                $('#supprType').css('display', 'inline');
            }
        }
    }).click();// Trigger the click event to initialize corectly 
    
    /*
     * Active le choix du lieu dans liste déroulante ou champs de texte
     */
    $('select#id_lieuEvent').bind('change click keypress', function(){
        // If the selection has changed
        if( $(this).data('selection') != $('option:selected', this).val() ) {
            if ($('option:selected', this).val() == 0) {
                $('input#text_lieuEvent').removeAttr('disabled');
            } else {
                $('input#text_lieuEvent').attr('disabled', 'disabled');
            }
        }
    }).click();
    
    /*
     * (Dés)active la sélection des horaires
     */
	$('input[type="checkbox"]#checkHoraire').change(function() {
		if($(this).is(':checked')){
			$('select.horaire').attr("disabled", "disabled");
			$(this).attr("title", "Définir des horaires");
		} else {
			$('select.horaire').removeAttr("disabled");
			$(this).attr("title", "Ne pas définir d'horaire");
		}
	}).attr('checked', true).change();
});

