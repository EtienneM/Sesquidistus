$(document).ready(function() {
    // Créé l'accordéon du récapitulatif
    $("#accordionCal").accordion({
    	heightStyle: 'content',
        collapsible: true, 
        active: false,
    });
    // Définit l'évènement lors du click sur un évènement
    $('td.outSelected').click(function() {
        // Récupère le div qui contient le récapitulatif
        $('#recap'+$(this).attr('id')).clone().dialog({
            width: 380,
            modal: true,
            title: "",
            draggable: false,
            closeText: 'x',
            buttons:{
                'Ok': function() { 
                    $(this).dialog("close"); 
                }
            }
        });
    });
});
