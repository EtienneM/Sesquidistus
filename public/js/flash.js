/**
 * Affiche un flash message.
 * Comme je ne suis pas certain de la librairie que je vais utiliser pour les
 * messages flashs, j'ai créé cette fonction et je ne modifierai qu'ici la 
 * librairie utilisée.
 */
function displayFlash(message) {
    $.jGrowl(message);
}

