$(document).ready(function() {
    /*
     * Suppression d'un article
     */
    $('a.supprimer').click( function() {
        var link = $(this);
        $('div#dialog').html('<p>Souhaitez-vous vraiment supprimer l\'article intitulé "'+$.trim($(this).parent('h2.titreNews').text())+'"</p>').dialog({
            width: 400,
            title: "Supprimer l'article",
            modal: true,
            draggable: false,
            closeText: 'X',
            buttons:{
                'Confirmer': function() { 
                    window.location.href = $(link).attr('href');
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
});