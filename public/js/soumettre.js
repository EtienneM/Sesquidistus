$(window).load(function() {
    new qq.FileUploader({
        element: document.getElementById('dropbox'),
        action: $('input#urlUpload').val(),
        allowedExtensions: ['jpg', 'jpeg'],
        sizeLimit: 5242880, // max size = 5Mo
        minSizeLimit: 0, // min size
        showMessage: function(message){ 
            alert(message);
        },


        debug: true
    });           
});
