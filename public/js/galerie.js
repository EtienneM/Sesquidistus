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
                    $('form#frmSupprimer').attr('action', $(lnk).attr('href')).submit();
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
});

$(window).load(function() {
    new qq.FileUploader({
        element: document.getElementById('dropbox'),
        action: $('input#urlUpload').val(),
        allowedExtensions: ['jpg', 'jpeg'],
        sizeLimit: 5242880, // max size = 5Mo
        minSizeLimit: 1242880, // min size
        showMessage: function(message){ 
            alert(message);
        },


        debug: true
    });           
});
