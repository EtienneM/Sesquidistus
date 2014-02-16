/**
 * Equivalent to the php addslashes function 
 * (http://fr2.php.net/manual/en/function.addslashes.php)
 */
function addslashes(str) {
    // From: http://phpjs.org/functions
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +   improved by: marrtins
    // +   improved by: Nate
    // +   improved by: Onno Marsman
    // +   input by: Denny Wardhana
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Oskar Larsson Högfeldt (http://oskar-lh.name/)
    // *     example 1: addslashes("kevin's birthday");
    // *     returns 1: 'kevin\'s birthday'
    return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

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
    $('div#bandeauDefilant').css('backgroundImage', 'url('+addslashes(tabImgGalerie[indexSlideshow])+')');
    indexSlideshow++;
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

