function updateCoords(c) {
    $('#x1').val(c.x);
    $('#y1').val(c.y);
    $('#width').val(c.w);
    $('#height').val(c.h);
}

$(window).load(function() {
    $('img#crop').Jcrop({
        aspectRatio: 900/200,
        boxWidth: 900,
        minSize: [900, 0],
        setSelect: [0, 0, 900, 200],
        addClass : 'jcrop-dark',
        onChange: updateCoords,
        onSelect: updateCoords
    });
});

$(document).ready(function() {
    $('form#frmAdd').validate({
        rules: {
            imgSrc: {
                accept: 'jpg'
            }
        
        }
    });
});
