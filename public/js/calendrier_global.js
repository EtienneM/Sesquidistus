 /* 
  * Module Calendrier
  * 
  * Toutes les fonctions qui sont communes aux fichiers calendrier_consultation.js et calendrier_ajout.js se trouvent dans ce fichier.
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

//Les éléments pour la date
var tabJour = new Array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
var tabMois = new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

//Les variables globales
var moisNow;
var anneeNew;
var tabMiniJour;
var date;
var numJour;
var numMois;
var annee;
var nbrJourParMois;
var chaineCalendar;
var jourSemaineLettre;
var heure;
var minute;
var seconde;
var barreDeg;
var divTitre;
var firstDay;
var xhr;

//test sur l'utilisateur a IE6 ou mois
var ie6ouMoins = false;
testBrowserIE();
tailleElement();

function initAjax(){
		if(window.XMLHttpRequest){
			xhr = new XMLHttpRequest();
		}
		else if(window.ActiveXObject){
			try{
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e){
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		else{
			alert("Votre navigateur n'est pas compatible avec AJAX");
		}
}

//vÃ©rification du lieu saisie
function checkTextLieu(textLieu, idLieuList){

		if(textLieu.value != ""){
			$(idLieuList).attr("disabled","disabled");
		}
																
		textLieu.onkeyup = function(){
				if(textLieu.value != ""){
					$(idLieuList).attr("disabled","disabled");
				}
				else{
					$(idLieuList).removeAttr("disabled");
				}
				
		}
		
		if(idLieuList.value != "init"){
				$(textLieu).attr("disabled","disabled");
				$(textLieu).css("backgroundColor","#f4f3f3");
		}
		idLieuList.onchange = function(){
				if(this.value != "init"){
					$(textLieu).attr("disabled","disabled");
					$(textLieu).css("backgroundColor","#f4f3f3");
				}
				else{
					$(textLieu).removeAttr("disabled");
					$(textLieu).css("backgroundColor","");
				}
		}
}


//fonction mettant ï¿½ jour le tableau de saisie des dates de l'Ã©vÃ¨nement
//Si l'element est dï¿½selectionnï¿½, on le supprime du tableau,
//sinon si l'element est selectionnï¿½, on l'insere dans le tableau.
function resultatDatePicker(divSource, tabResultat, element){
	var tabRes = tabResultat;
	
	if(!$(element).hasClass("selected"))
	{
		var nobreak = true; 
		
		for(k=0; k<tabRes.length && nobreak; k++)
		{
			
				if(tabRes[k]==$(element).attr("title"))
				{
					var tempTab = tabRes;
					tabRes = tabRes.slice(0,k).concat(tempTab.slice(k+1,tempTab.length));					
					nobreak = false;
				}
			
		}
	}
	else if ($(element).hasClass("selected"))
	{
		tabRes.push($(element).attr("title"));
	}
	
	
	return tabRes;
	
}


//Fonction renvoyant le nombre de jour pour un couple (mois,annï¿½e) donnï¿½ en parametre.
function nombreDeJourParMois(annee, mois){
var res = 31;

		if(mois == 2)
		{
			if((annee%4 == 0 && annee%100 != 0) || (annee%400 == 0))
			{
				res = 29;
			}
			else
			{
				res = 28;
			}
		}

		if(mois == 4 || mois == 6 || mois == 9 || mois == 11)
		{
			res = 30;
		}
		
		return res;
}

function testBrowserIE(){
var version = jQuery.browser.version;

	if($.browser.msie && version.substring(0,1) < 7)
	{
		ie6ouMoins = true;
	}
}

function tailleElement(id){
	if(!id){var id="";}else{$("#"+id).css("display","block");}
	var divListeEvent = "#divListeEvent"+id;
	var spanListeType = "#spanListeType"+id;
	var divListeLieu = "#divListeLieu"+id;
	var spanListeLieu = "#spanListeLieu"+id;
	var liste1taille = $(divListeEvent).width() + $(spanListeType).width() + 30;
	var liste2taille = $(divListeLieu).width() + $(spanListeLieu).width() + 30;
	var maxTaille = liste1taille;
	if(maxTaille>30){
		if(liste2taille>maxTaille){
			maxTaille = liste2taille;
			$('.inputStyle').width($(divListeLieu).width());
		}
		else{
			$('.inputStyle').width($(divListeEvent).width());
		}
		//alert(maxTaille);
		$('.dataForm').width(maxTaille);
		$("#divButtonType").css("marginLeft",maxTaille+15);
	}
}
