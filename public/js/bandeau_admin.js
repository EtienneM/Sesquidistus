function updateCoords(c) {
    $('#x1').val(c.x);
    $('#y1').val(c.y);
    $('#x2').val(c.x2);
    $('#y2').val(c.y2);
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