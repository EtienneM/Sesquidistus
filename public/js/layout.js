/**
 * Affiche un flash message.
 * Comme je ne suis pas certain de la librairie que je vais utiliser pour les
 * messages flashs, j'ai créé cette fonction et je ne modifierai qu'ici la 
 * librairie utilisée.
 */
function displayFlash(message) {
    $.jGrowl(message);
}

var indexSlideshow = 0;
function _slideshow(tabImgGalerie) {
    $('div#bandeauDefilant').css('backgroundImage', 'url('+tabImgGalerie[indexSlideshow++]+')');
    if (indexSlideshow >= tabImgGalerie.length) {
        indexSlideshow = 0;
    }
}


function slideshow(tabImgGalerie) {
    indexSlideshow = Math.floor(Math.random()*tabImgGalerie.length);
    _slideshow(tabImgGalerie);
    setInterval(function() {
        _slideshow(tabImgGalerie);
    }, 4000);
}

