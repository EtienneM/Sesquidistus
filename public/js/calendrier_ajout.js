$(document).ready(function() {
    /*
     * Ne pas pouvoir supprimer un certain nombre de types d'évènement
     */
    $('select#listeEvent').bind('change click keypress', function(){
        // If the selection has changed
        if( $(this).data('selection') !== $('option:selected', this).val() ) {
            if ($.inArray($('option:selected', this).val(), ['1', '4', '5', '11']) !== -1) {
                $('#supprType').css('display', 'none');
            } else {
                $('#supprType').css('display', 'inline');
            }
        }
    }).click();// Trigger the click event to initialize corectly 
    
    $('#supprType').click(function() {
        var link = $(this);
        $('div#dialog').html('<p>Souhaitez-vous vraiment supprimer le type d\'évènement "'+$('#listeEvent option:selected').text()+'"</p>').dialog({
            width: 400,
            title: "Supprimer un type d'évènement",
            modal: true,
            draggable: false,
            buttons:{
                'Confirmer': function() { 
                    window.location.href = $(link).attr('href')+'/id/'+$('#listeEvent option:selected').val();
                },
                'Annuler': function() {
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
    
    $('#addType').click(function() {
        //$('#idType_event').val($('#listeEvent option:selected').val());
        var div = $('#divFormActionType');
        div.css('display', 'block').detach();
        $('div#dialog').append(div).dialog({
            width: 400,
            title: "Ajouter un type d'évènement",
            modal: true,
            draggable: false,
            buttons: {
                'Confirmer': function() {
                    $('#formActionType').submit();
                },
                'Annuler': function() {
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
    
    /*
     * Active le choix du lieu dans liste déroulante ou champs de texte
     */
    $('select#id_lieuEvent').bind('change click keypress', function(){
        // If the selection has changed
        if( $(this).data('selection') !== $('option:selected', this).val() ) {
            if ($('option:selected', this).val() === 0) {
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
    }).change();
    
    /*
     * Sélection manuel ou via le calendrier de la date
     */
    $('input[name="rdDate[]"]:radio').change(function(){
        if ($('#rdCalendar').prop('checked')) {
            $('#calendarDatepicker').css('display', 'block');
            $('#inputDatepicker').css('display', 'none');
        } else {
            $('#calendarDatepicker').css('display', 'none');
            $('#inputDatepicker').css('display', 'block');
        }
    });
    $('#rdCalendar').change();
    
    /*
     * Clique sur une case du calendrier
     */
    $('td.calendar').each(function() {
        if ($(this).hasClass('selected')) {
            $(this).attr('class', 'calendar').addClass('eventSelected').addClass("selected");
            $('input#hdnDates').val($(this).attr('title')+','+$('input#hdnDates').val());
        }
    });
    $('td.calendar').click(function() {
        // Désélection
        if ($(this).hasClass('selected')) {
            $(this).attr('class', 'calendar').addClass('defaultCalendar');
            var dates = $('input#hdnDates').val().split(',');
            $('input#hdnDates').val('');
            for (var i = 0; i < dates.length; i++) {
                if (dates[i] !== '' && dates[i] !== $(this).attr('title')) {
                    $('input#hdnDates').val(dates[i]+','+$('input#hdnDates').val());
                }
            }
        } else { //Sélection d'une date
            $('span#errorDatepicker').css('display', 'none');
            $(this).attr("class","calendar").addClass("eventSelected").addClass("selected");
            $('input#hdnDates').val($(this).attr('title')+','+$('input#hdnDates').val());
        }
    });
    
    /*
     * Reset
     */
    $('input#resetDate').click(function() {
        $('td.selected').attr("class", "calendar").addClass("defaultCalendar");
        $('input#text_lieuEvent').removeAttr('disabled');
        $('select.horaire').attr("disabled", "disabled");
    });
    
    /*
     * Validation du formulaire
     */
    $('form#formAjout').validate();
    $('form#formAjout').submit(function() {
        if ($('#rdCalendar').prop('checked')) {
            $('input#txtDates').remove();
        } else {
            $('input#hdnDates').remove();
            $('input#txtDates').prop('value', $('input#txtDates').prop('value')+',');
        }
        if ( ($('input#hdnDates').val() === '') && ($('input#txtDates').val() === '')) {
            $('span#errorDatepicker').css('display', 'inline');
            return false;
        }
        return true;
    });
});

