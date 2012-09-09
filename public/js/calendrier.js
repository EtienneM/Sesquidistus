$(document).ready(function() {
    /* $('#printCalendar').click(function() {
var divPrint = $('#accordionCal').clone();
$(divPrint).find('.printInfo').removeClass('printInfo').addClass('printInfo2');
$(divPrint2).find('div').css("display","block");
$(document).ready(function() {
printPartOfPage(divPrint);
});
});*/
    // Créé l'accordéon du récapitulatif
    $("#accordionCal").accordion({
        autoHeight: false, 
        collapsible: true, 
        active:false
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
