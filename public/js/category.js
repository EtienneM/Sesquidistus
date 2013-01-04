$(document).ready(function() {
    /*
     * Modification de la catégorie courante
     */
    $('div#modifContent input').click(function() {
        $('textarea#content').tinymce({
            script_url: '/js/tinymce/tiny_mce.js',
            theme: 'advanced',
            skin: 'o2k7',
            skin_variant: 'silver',
            width: '560',
            height: '475',
            language: 'fr',
            content_css: '/css/club/club.css,/css/style.css',
            plugins: 'table,fullscreen,preview,inlinepopups,media',
            theme_advanced_toolbar_location: 'top',
            theme_advanced_toolbar_align: 'left',
            theme_advanced_resizing: false,
            theme_advanced_path: false,
            theme_advanced_buttons1: 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect',
            theme_advanced_buttons2: 'cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,media,|,forecolor,backcolor',
            theme_advanced_buttons3: 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen,|preview',
            theme_advanced_buttons4: ''
        });
        // Create an alternate "insert media" button
        /*$('textarea#content').tinymce().addButton('mce_media', {
            'title': 'Embed a video',
            'image': '{T_ICONS_PATH}mce_icons/video.gif',
            'onclick': function() {
                var text = prompt('Please enter the embed code for your video:', '');
                var pattern = new RegExp('embed', 'gi'); // very simple check for proper code
                if (text.match(pattern)) {
                    var width = parseInt(text.replace(/^(?:.*?)(?:width="(.*?)"){1}(?:.*?)$/gi, '$1'));
                    var height = parseInt(text.replace(/^(?:.*?)(?:height="(.*?)"){1}(?:.*?)$/gi, '$1'));
                    var aspect = width / height;
                    var w = 320; // basic resize-to
                    var h = Math.round(w / aspect);
                    var str = text
                            .replace(/&amp;/gi, '&')
                            .replace(/&quot;/gi, '"')
                            .replace(/&lt;/gi, '<')
                            .replace(/&gt;/gi, '>')
                            .replace(/width="(?:.*?)"/gi, 'width="' + w + '"')
                            .replace(/height="(?:.*?)"/gi, 'height="' + h + '"')
                    ed.execCommand('mceInsertContent', false, '<div>' + str + '</div>');
                    setTimeout(function() {
                        ed.hide()
                    }, 1);
                    setTimeout(function() {
                        ed.show()
                    }, 5);
                    setTimeout(function() {
                        ed.focus()
                    }, 10);
                } else {
                    alert('Incorrect or invalid embed code');
                }
            }
        });*/

        var titleVal = $('div#news div.titreNews span').detach().text();
        $('<input type="text" value="' + titleVal + '" id="titleVisible" name="titleVisible" size="50" maxlength="50" />')
                .appendTo('div#news div.titreNews')
                .keyup(function() {
            $('input#title').val($(this).val());
        });
        $('input#title').val(titleVal);

        $('div.contenuNews div').css('display', 'none');
        $('form#frmContent').css('display', 'block');
        $(this).css('display', 'none');
    });
    /*
     * Ajout d'un catégorie
     */
    $('#ajoutCat').click(function() {
        $('div#addCategory').dialog({
            width: 400,
            title: "Ajout d'une catégorie",
            modal: true,
            draggable: false,
            closeText: 'x',
            buttons: {
                "Valider": function() {
                    $('#formAjoutCat').submit();
                }
            }
        });
    });
    /*
     * Suppression d'une catégorie
     */
    $('#supprCat').click(function() {
        $('div#delCategory').dialog({
            width: 400,
            title: "Supprimer une catégorie",
            modal: true,
            draggable: false,
            closeText: 'x',
            buttons: {
                "Valider": function() {
                    $('#formSupprCat').submit();
                }
            }
        });
    });
});