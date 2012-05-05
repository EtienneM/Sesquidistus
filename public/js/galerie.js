$(document).ready(function() {
    $('a#lnkAjouter').click(function() {
        $('form#frmAjouter').attr('action', $(this).attr('href')).dialog({
            width: 380,
            modal: true,
            title: $(this).text(),
            buttons: {
                'Ajouter': function() {
                    $('form#frmAjouter').submit();
                },
                'Annuler': function() { 
                    $(this).dialog('close'); 
                }
            }
        });
        $('input#nom').focus();
        return false;
    });
    $('a#lnkSupprimer').click(function() {
        var lnk = $(this);
        $('div#dialog').html('<p>Etes vous sur de vouloir supprimer cet(ces) album(s) ainsi que ses(leurs) photos(s) ?</p>')
        .dialog({
            height: 'auto',
            width: 'auto',
            position: 'center',
            modal: true,
            title: $(this).attr('title'),
            draggable: false,
            buttons: {
                'Supprimer': function() {
                    $('form#frmSupprimer').attr('action', $(lnk).attr('href')).submit();
                },
                'Annuler': function() { 
                    $('div#dialog').dialog('close');
                }																
            }
        });
        return false;
    });
});

/*var val = 0;
var divImage;
var tableauImg = new Array();

//Fonction slideShow pour l'element div Source
function gallery(divSource, tabImages, type){

divImage = divSource;
tableauImg	= tabImages;

	//Initialisation du premier couple (Image + info) du slideShow
	if(type==0){
		$(divImage).empty();
		$(divImage).css("backgroundImage","url("+tabImages[val]+")");
		setInterval("changerImage()", 4000);
	}
	else{
		val = Math.ceil(Math.random()  * tabImages.length) -1 ;
		$(divImage).empty();
		$(divImage).css("backgroundImage","url("+tabImages[val]+")");
		$(divImage).css("width","650px");
		$(divImage).css("height","130px");
	}
}

//changement de l'image du slideShow
function changerImage(){
	$(divImage).empty();
	$(divImage).css("backgroundImage","url("+tableauImg[val]+")");
	if(val<tableauImg.length-1){val++;}
	else{val=0;}
}*/

