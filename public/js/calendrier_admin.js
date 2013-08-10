$(document).ready(function() {
    // Créé l'accordéon du récapitulatif
    $("#accordionCal").accordion({
    	heightStyle: 'content',
        collapsible: true, 
        active: false,
    });
    // Définit l'évènement lors du click sur un évènement
    $('td.outSelected').click(function() {
        var id = $(this).attr('id');
        // Récupère le div qui contient le récapitulatif
        $('#recap'+id).clone().dialog({
            width: 380,
            modal: true,
            title: "",
            draggable: false,
            closeText: 'X',
            buttons:{
                'Ok': function() { 
                    $(this).dialog("close"); 
                },
                'Modifier': function() {
                    window.location.href = $('a#modif'+id).attr('href');
                },
                'Supprimer': function() {
                    $('div#dialog').html('<p>Souhaitez-vous vraiment supprimer l\'événement&nbsp;? Cette action entraînera la suppression de tous les articles associés.</p>')
                    .dialog({
                        width: 400,
                        title: "Supprimer un événement",
                        modal: true,
                        draggable: false,
                        closeText: 'X',
                        buttons: {
                            'Confirmer': function() { 
                                window.location.href = $('a#suppr'+id).attr('href');
                            },
                            'Annuler': function() { 
                                $('div#dialog').dialog('close');
                            }																
                        }
                    });
                }
            }
        });
    });
});
