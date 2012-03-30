var val = 0;
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
}

