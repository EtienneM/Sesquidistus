$(document).ready(function() {
    $('textarea#contenu').tinymce({
        script_url: '/js/tinymce/tinymce.min.js',
        theme : 'modern',
        width : '560',
        height : '475',
        language : 'fr_FR',
        content_css : '/css/article.css,/css/style.css',
        plugins : 'table,fullscreen,image,link,media,textcolor,hr,charmap',
        resize: false,
        statusbar: false,
        toolbar1: 'formatselect fontselect fontsizeselect',
        toolbar2: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | cut copy paste | bullist numlist | outdent indent',
        toolbar3: 'link unlink image media | forecolor backcolor | undo redo | hr removeformat | subscript superscript | charmap | fullscreen ',
    }); 
    
    $('form#frmEcrire').validate();
    
    $('select#sltEvents').bind('change click keypress', function() {
        // Si "Autre" est sélectionné
        if($(this).val() == -1) {
            $('div#dialog').dialog({
                height: 'auto',
                width: 'auto',
                position: 'center',
                modal: true,
                title: "Sélection d'un évènement",
                draggable: false,
                closeText: 'X',
                buttons: {
                    'OK': function() { 
                        $('div#dialog').dialog('close');
                    }
                },
                close: function(event, ui) {
                    if ($('input#txtEvent').val() == '') {
                        $('select#sltEvents option[value="null"]').attr('selected', true);
                    }
                }
            });
            $('input#txtEvent').focus();
        }
    });
    
    $('input#txtEvent').autocomplete({
        source: $('input#urlList').val(),
        minLength: 2,
        select: function( event, ui ) {
            $('select#sltEvents').append($("<option></option>")
                .attr("value", ui.item.id)
                .attr('selected', true)
                .text(ui.item.value));
        }
    });
});