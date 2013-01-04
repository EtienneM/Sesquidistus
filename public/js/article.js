$(document).ready(function() {
    $('textarea#contenu').tinymce({
        script_url: '/js/tinymce/tiny_mce.js',
        theme : 'advanced',
        skin : 'o2k7',
        skin_variant : 'silver',
        width : '560',
        height : '475',
        language : 'fr',
        content_css : '/css/article.css,/css/style.css',
            
        plugins : 'table,fullscreen,preview,inlinepopups,media',
        theme_advanced_toolbar_location : 'top',
        theme_advanced_toolbar_align : 'left',
        theme_advanced_statusbar_location : 'bottom',
        theme_advanced_resizing : true,
        theme_advanced_path : false,
        theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect',
        theme_advanced_buttons2 : 'cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,media,|,forecolor,backcolor',
        theme_advanced_buttons3 : 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen,|preview',
        theme_advanced_buttons4 : ''
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