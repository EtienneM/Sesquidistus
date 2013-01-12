$(document).ready(function() {
    $('a#lnkAjouter').click(function() {
        $('form#frmAjouter').attr('action', $(this).attr('href')).dialog({
            width: 380,
            modal: true,
            title: $(this).text(),
            buttons: {
                'Ajouter': function() {
                    $('form#frmAjouter').submit();
                },
                'Annuler': function() { 
                    $(this).dialog('close'); 
                }
            }
        });
        $('input#nom').focus();
        return false;
    });
    $('a#lnkSupprimer').click(function() {
        var lnk = $(this);
        $('div#dialog').html('<p>Etes vous sur de vouloir supprimer cet(ces) album(s) ainsi que ses(leurs) photos(s) ?</p>')
        .dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: false,
            buttons: {
                'Supprimer': function() {
                    $('form#frmModifier').attr('action', $(lnk).attr('href')).submit();
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
    
    var clickable = 'td.video';
    if ($('.chkAdminAlbum').size() !== 0) {
        clickable = 'div.albumImg';
    }
    $(clickable).click(function() {
        var jClickable = $(this);
        if ($('.chkAdminAlbum').size() !== 0) {
            jClickable = $(this).parents('td.video');
        }
        $(jClickable).children('div.videoEmbeddedCode').clone().dialog({
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
    });

    /*
     * Suppression de photos et vidéos 
     */
    $('a#lnkDeleteElements').click(function() {
        var lnk = $(this);
        $('div#dialog').html('<p>Etes vous sûr de vouloir supprimer ces photos/vidéos&nbsp;?</p>')
        .dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: false,
            buttons: {
                'Supprimer': function() {
                    $('form#frmModifier').attr('action', $(lnk).attr('href')).submit();
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });

    /*
     * Déplacement de photos/vidéos
     */
    $('a#lnkMove').click(function() {
        $('div#actions').show(200);
        return false;
    });
    
    $('a#lnkValidMove').click(function() {
        $('#albumDestination').val($('#sltAlbumDestination').val());
        $('form#frmModifier').attr('action', $(this).attr('href')).submit();
        return false;
    });
});