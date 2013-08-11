$(document).ready(function() {
    var listAlbum = $('#sltAlbum');
    var uploader = null;
    listAlbum.change(function() {
        // If selected element is an album
        if (listAlbum.val() !== '') {
            if (uploader === null) {
                uploader = new qq.FileUploader({
                    debug: true,
                    element: $('#dropbox')[0],
                    action: $('form#frmPhoto').attr('action'),
                    allowedExtensions: ['jpg', 'jpeg'],
                    sizeLimit: 5242880, // max size = 5Mo
                    minSizeLimit: 0, // min size
                    params: {
                        sltAlbum: $('#sltAlbum').val()
                    },
                    onProgress: function(id, fileName, loaded, total) {
                        var album = $('select#sltAlbum :selected').text();
                        var item = $($('ul.qq-upload-list li')[id]);
                        item.children('span.qq-upload-album').text('dans l\'album "'+album+'"');
                    },
                    fileTemplate: '<li>' +
                '<span class="qq-upload-file"></span>' +
                '<span class="qq-upload-album"></span>' +
                '<span class="qq-progress-bar"></span>' +
                '<span class="qq-upload-spinner"></span>' +
                '<span class="qq-upload-size"></span>' +
                '<a class="qq-upload-cancel" href="#">Annuler</a>' +
                '<span class="qq-upload-failed-text">&Eacute;chec</span>' +
                '</li>'
                });
            }
            $('#dropbox').show();
        } else {
            $('#dropbox').hide();
        }
    });
    
    var listAlbumVideo = $('#sltAlbumVideo');
    listAlbumVideo.change(function() {
        if (listAlbumVideo.val() !== '') {
            $('#urlVideo').show();
        } else {
            $('#urlVideo').hide();
        }
    });
});

