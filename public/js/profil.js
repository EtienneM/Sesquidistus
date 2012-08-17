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
                    $('div#dialog').dialog('close');
                }																
            }
        });
    });
});

