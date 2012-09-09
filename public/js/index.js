/* 
 * Page d'accueil
 */

$(document).ready(function() {
    $('a.video').click(function() {
        $(this).children('div.videoEmbeddedCode').clone().dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: false,
            buttons: {
                'Fermer': function() { 
                    $(this).dialog('destroy');
                }																
            }
        });
        return false;
    });
});
