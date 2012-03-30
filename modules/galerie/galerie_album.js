
$(function() {
	$( "#dialogContainer" ).dialog({
		autoOpen: false,
		closeText: 'x',
		draggable: false,
		resizable: false,
		modal: true,
		open: function() { $("body").css("overflowX", "hidden"); },
		close: function() {
			$("#picture").attr("src","./modules/galerie/loading.gif");
			$("body").css("overflowX", "auto");
		}
	});
});
	
	
	
var hiddenImg = document.getElementById('allImg');
var Images = hiddenImg.getAttribute("value");
var tabImg = Images.split(';');
	
function array_search(what, where){
	var index_du_tableau=-1
	for(elt in where){
		index_du_tableau++;
		if (where[elt]==what){return index_du_tableau}
	}
	index_du_tableau=-1;
	return index_du_tableau
}

function imgSvt() {
	$("#picture").attr("src","./modules/galerie/loading.gif");
	$(document).ready(function(){
		var currentImg = $( "#picture" ).attr("alt");
		var IdImg = parseInt(array_search(currentImg, tabImg)) + 1;
		$( "#picture" ).attr( "src", imgInfos[tabImg[IdImg]][0].replace(/\'/g,"\\\'").replace(/\"/g,"\\\"") );
		$( "#picture" ).height(imgInfos[tabImg[IdImg]][1]);
		$( "#picture" ).width(imgInfos[tabImg[IdImg]][2]);
		$( "#picture" ).attr( "alt", tabImg[IdImg] );
		$( "#commentaire" ).html( imgInfos[tabImg[IdImg]][3] );
		if ($( "#commentaire" ).html() == "") {
			$( "#imageComment" ).css("display","none");
		}
		else {
			$( "#imageComment" ).css("display","block");
		}
		$( "#dialogContainer" ).dialog( "option", "width", ($( "#picture" ).attr("width") + 120));
		$( "#dialogContainer" ).dialog( "option", "position", 'center' );	
		$( "#dialogContainer" ).dialog( "option", "title", imgInfos[tabImg[IdImg]][4]);	
		updateMvtDialogButton(tabImg[IdImg]);
	});
}
var btn_next = document.getElementById('next');
btn_next.onclick = function(){imgSvt()};
	
function imgPrec() {
	$("#picture").attr("src","./modules/galerie/loading.gif");
	$(document).ready(function(){
	var currentImg = $( "#picture" ).attr("alt");
	var IdImg = parseInt(array_search(currentImg, tabImg)) - 1;
	$( "#picture" ).attr( "src", imgInfos[tabImg[IdImg]][0].replace(/\'/g,"\\\'").replace(/\"/g,"\\\"") );
	$( "#picture" ).height(imgInfos[tabImg[IdImg]][1]);
	$( "#picture" ).width(imgInfos[tabImg[IdImg]][2]);
	$( "#picture" ).attr( "alt", tabImg[IdImg] );
	$( "#commentaire" ).html( imgInfos[tabImg[IdImg]][3] );
	if ($( "#commentaire" ).html() == "") {
		$( "#imageComment" ).css("display","none");
	}
	else {
		$( "#imageComment" ).css("display","block");
	}
	$( "#dialogContainer" ).dialog( "option", "width", ($( "#picture" ).attr("width") + 120));
	$( "#dialogContainer" ).dialog( "option", "position", 'center' );
	$( "#dialogContainer" ).dialog( "option", "title", imgInfos[tabImg[IdImg]][4]);
		updateMvtDialogButton(tabImg[IdImg]);
	});
}
var btn_prec = document.getElementById('prev');
btn_prec.onclick = function(){imgPrec()};
	
function updateMvtDialogButton(nom_image) {
	if (parseInt(array_search(nom_image, tabImg)) == 0) {
		if (tabImg.length == 1) {
			$( "#prevLink" ).attr( "style", "visibility: hidden;" );
			$( "#nextLink" ).attr( "style", "visibility: hidden;" );
		}
		else {
			$( "#prevLink" ).attr( "style", "visibility: hidden;" );
			$( "#nextLink" ).attr( "style", "visibility: visible;" );
		}
	}
	else if (parseInt(array_search(nom_image, tabImg)) == (tabImg.length - 1)) {
		$( "#nextLink" ).attr( "style", "visibility: hidden;" );
		$( "#prevLink" ).attr( "style", "visibility: visible;" );
	}
	else {
		$( "#prevLink" ).attr( "style", "visibility: visible;" );
		$( "#nextLink" ).attr( "style", "visibility: visible;" );
	}
}
	
// Changement d'image avec les flêches du clavier
document.onkeydown = quelle_touche;

function quelle_touche(evenement) {
	var touche = (window.event) ? event.keyCode : evenement.keyCode;
	var lookupImg = $( "#picture" ).attr( "alt");
	var lookupIdImg = parseInt(array_search(lookupImg, tabImg));		
	if (touche == 39 && lookupIdImg != (tabImg.length - 1)) { //touche gauche
		imgSvt();
	}
	else if (touche == 37 && lookupIdImg != 0) { //touche droite
		imgPrec();
	}
}