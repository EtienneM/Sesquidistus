/*
 * Ce fichier la dialog de confirmation du changement 
 * du mot de passe.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
$(document).ready(function() {
    $('form#editProfil').validate();
    $('form#editPwd').validate({
        rules: {
            confirm_pwd: {
                equalTo: '#new_pwd'
            }
        }
    });
});

