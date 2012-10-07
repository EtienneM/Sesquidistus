function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('img#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        $('#preview').show()
    }
}


$(document).ready(function() {
    $('form#editProfil').validate();
    $('form#editPwd').validate({
        rules: {
            confirm_pwd: {
                equalTo: '#new_pwd'
            }
        }
    });
    
    $('#uploadAvatar').click(function() {
        $('div#dialogUploadAvatar').dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: true,
            buttons: {
                'Ok': function() {
                    $('form#frmUploadAvatar').submit();
                },
                'Annuler': function() { 
                    $('div#dialogUploadAvatar').dialog('close');
                }																
            }
        });
    });
    
    /*
     * Suppression d'un membre
     */
    $('a.supprimer').click( function() {
        var link = $(this);
        $('div#dialog').html('<p>Souhaitez-vous vraiment supprimer le membre "'+$.trim($('td#login').text())+'"&nbsp;?</p>').dialog({
            width: 400,
            title: "Supprimer un membre",
            modal: true,
            draggable: false,
            buttons:{
                'Confirmer': function() { 
                    $.get($(link).attr('href'), function() {
                        //location.reload(true);
                        history.back();
                    });
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
});

