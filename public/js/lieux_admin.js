$(document).ready(function() {
    $('#accordionLieu').accordion({ 
        autoHeight: false, 
        collapsible: true, 
        active:false
    });
    
    $('div#dialog').html('<img src="/images/ajax-loader.gif" alt="Loading..." />');
    $('.modifier').click(function() {
        var data = {};
        if ($(this).attr('id') == 'boutonModif') {
            data = {idLieu: $('select#listeLieu').val()}
        }
        $('div#dialog').html('<img src="/images/ajax-loader.gif" alt="Loading..." />')
        .load($(this).attr('href'), data, function() {
            $("#formModifLieu").validate();
        }).dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: false,
            buttons:{
                'Confirmer': function() { 
                    $("#formModifLieu").submit();
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
    $('#boutonSuppr').click(function() {
        $('div#dialog').html('<p>Souhaitez-vous réellement supprimer ce lieu : '+$('select#listeLieu option').filter(":selected").text()+'</p>')
        .dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: false,
            buttons: {
                'Confirmer': function() { 
                    window.location.href = $('a#boutonSuppr').attr('href')+'/idLieu/'+$('select#listeLieu').val();
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
});