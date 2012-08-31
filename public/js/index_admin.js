$(document).ready(function() {
    /*
     * Suppression d'une catégorie
     */
    $('a.supprimer').click( function() {
        var link = $(this);
        $('div#dialog').html('<p>Souhaitez-vous vraiment supprimer l\'article intitulé "'+$.trim($(this).parent('div.titreNews').text())+'"</p>').dialog({
            width: 400,
            title: "Supprimer l'article",
            modal: true,
            draggable: false,
            buttons:{
                'Confirmer': function() { 
                    $.get($(link).attr('href'), function() {
                        location.reload(true);
                    });
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
});