 /* 
  * Module Calendrier
  * Sert à créer les 3 mini-calendriers se trouvant sur la page d’ajout d’évènement.
  * Gère tous les évènements relatant à l’ajout d’un évènement (ouverture de dialog-box, soumission de formulaire, …)
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */
  
function MonCalendar(divSource, mois, an, tabResultatConfirmation, tabTypeEvents){
	
	$(divSource).empty(); //suppression des eventuels elements se trouvant dans la div Source
	initAjax(); //initialisation du protocol ajax pour la récupération des données sans rechargement de la page
	

	//Déclaration des variables globales
	var nbrJour;
	var numeroJour;
	var numeroMois;
	var numeroMoisDepart;
	var anneeCalDepart;
	var anneeCal;
	var tabDatePicker; 
	var tabNomEvent;
	var tabIdEvent; 
	var tabType_nomEvent;
	var tabType_numero;
	var tabType_color;
	var anneeNow;
	var moisNow;
	var iniDateNow = true;
		
	if(tabTypeEvents){ //Chargement des informations relatives aux types d'évènement.
		tabType_numero = tabTypeEvents[0];
		tabType_nomEvent = tabTypeEvents[1];
		tabType_color = tabTypeEvents[2];
	}
	
	//MAJ des variables dans le cas ou les bons éléments sont présents en parametre de la fonction
	if(mois && an){
		numJour = 0;
		numeroMois = mois;
		numeroMoisDepart = numeroMois;
		anneeCal = an;
		anneeCalDepart = anneeCal;
		nbrJour = nombreDeJourParMois(an, mois);
	}

	if(iniDateNow){
		moisNow = mois;
		anneeNow = an;
		iniDateNow = false;
	}
	
	if(tabResultatConfirmation){ //Tableau de sauvegarde lorsqu'on passe d'un mois à un autre.(sauvegarde des évènements sélectionnés)
		tabDatePicker = tabResultatConfirmation;
	}
	else{
		tabDatePicker = new Array();
	}

	// - VARIABLES POUR LA MISE EN FORME DU CALENDRIER

	//definition des valeurs par défault ==> 3 mini-calendar
	var nbrMoisCalendrier = 3; 
	var nbTaille=0;
	if(nbrMoisCalendrier <= 3){
		nbTaille = 910;
	}
	$(divSource.parentNode).css("height", nbTaille +"px");
	var divCal = divSource;
	var chaineCalendar = "";
	var decalageLeftCal= 0;
	var decalageTopCal= 15;
	var nbElement = nbrMoisCalendrier;
	if(nbElement>3){nbElement = 3;}
	var boolTailleDiv = false;
	var widthDatePicker;
	var divMoisWidth=180;

	//Boucle de créaction des mini-calendar (au nombre de "nbrMoisCalendrier")
	for(z=0; z<nbrMoisCalendrier; z++){
		//creation du mini-calendar numero z
		var divMois = document.createElement("div");
		$(divMois).attr("class","calendar");
		var tableau = document.createElement("TABLE");
		$(tableau).attr("cellpadding","2");
		var tBody = document.createElement("TBODY");
		var trTableau = document.createElement("TR");
		$(trTableau).attr("class","calendar");
		
		if(!boolTailleDiv){
			widthDatePicker = divMoisWidth + 15 + (nbElement-1)*220;
			$("#DivValiderCal").css("width",widthDatePicker);
			boolTailleDiv = true;
		}
			
		//positionnement des mini-calendar
		$(divCal).css("width",widthDatePicker +"px");
		if(z>0){decalageLeftCal += divMoisWidth + 50;}
		if(z!= 0 && z%3==0){decalageTopCal += 335; decalageLeftCal = 0;}
		$(divMois).css("left",decalageLeftCal + "px");
		$(divMois).css("top",decalageTopCal + "px");
		
		//Ajout de l'indication de jours de la semaine dans le mini-calendar
		tabMiniJour = new Array("Lu","Ma","Me","Je","Ve","Sa","Di");
	
		for(g=0; g<tabMiniJour.length; g++){
			var tdTableau = document.createElement("TD");
			$(tdTableau).attr("style","text-align:center; font-weight:bold;");
			if(g >= (tabMiniJour.length-2)){
				$(tdTableau).css("color","#d72c2c");
			}
			tdTableau.appendChild(document.createTextNode(tabMiniJour[g]));
			trTableau.appendChild(tdTableau);
		}
		
		tBody.appendChild(trTableau);
		if(z>0){numeroMois++}
		if(numeroMois==13){numeroMois=1; anneeCal ++;}
		if(numeroMois<10){numeroMois = "0" + numeroMois;}
		nbrJour = nombreDeJourParMois(anneeCal, numeroMois);
		var trTableauCal = document.createElement("TR");
		var caseCourante=0;
		var nbrLine =0;
		
		function caseVide(){ //création de cases grises, non cliquables
			var tdTableauCal = document.createElement("TD");
			tdTableauCal.appendChild(document.createTextNode("xx"));
			$(tdTableauCal).attr("class","calendarVide");
			trTableauCal.appendChild(tdTableauCal);
			caseCourante++;
		}
		
		//Boucle de création des numeros des jours du mois courant (01, 02, 03 ... 29, 30, 31)
		for(i=0; i< nbrJour; i++){
			if(caseCourante%7==0){
				tBody.appendChild(trTableauCal);
				trTableauCal = document.createElement("TR");
				nbrLine++;
			}
			//ajout de "0" en d?but de chaine si le jour courant < 10
			if(i<9){chaineCalendar = "0" + parseInt(i+1);}
			else{chaineCalendar = i+1;}
			
			if(i==0){
				var tempDate = new Date(anneeCal, numeroMois-1, i);
				firstDay = tempDate.getDay();
				for(h=0; h<firstDay; h++){
					caseVide();
				}
			}
				
			var numJourZero = parseInt(i+1);
			if(numJourZero<10){numJourZero = "0" + numJourZero;}
			var tdTableauCal = document.createElement("TD");
			$(tdTableauCal).attr("title",numJourZero +"/"+numeroMois+"/"+anneeCal);
			$(tdTableauCal).attr("class","calendar");
			$(tdTableauCal).addClass("defaultCalendar");
			var textCalendar = document.createTextNode(chaineCalendar);
			var divJourMois = document.createElement("div");
			$(divJourMois).css("marginTop","2px");
			$(divJourMois).css("textAlign","center");
			$(divJourMois).css("fontSize","10px");
			divJourMois.appendChild(textCalendar);
			var multi = 0;
			
			for(k=0; k<tabDatePicker.length; k++){	
				if($(tdTableauCal).attr("title")==tabDatePicker[k]){
					if(ie6ouMoins){$(tdTableauCal).css("backgroundImage","none");}
					$(tdTableauCal).attr("class","calendar");
					$(tdTableauCal).addClass("eventSelected");
					$(tdTableauCal).addClass("selected");
				}
			}
				
			if(multi==0){ //S'il y a un seul évènement par case
				tdTableauCal.appendChild(textCalendar);
			}
			else{
				tdTD.appendChild(divJourMois);
				var heightdTD = 50/multi;
				$(tdTableauCal).find('td').attr("height",heightdTD);
			}
				
			if(multi==0){ //S'il y a un seul évènement par case
				tdTableauCal.onmouseover = function(){
					if(!$(this).hasClass("selected")){
						$(this).attr("class","calendar");
						$(this).addClass("calendarMouseOver");
					}
					else{
						$(this).removeClass("outSelected");
						$(this).addClass("overSelected");
					}
				};
			
				tdTableauCal.onmouseout = function(){
					if(!$(this).hasClass("selected")){
						$(this).attr("class","calendar");
						$(this).addClass("defaultCalendar");
					}
					else{
						$(this).removeClass("overSelected");
						$(this).addClass("outSelected");
					}
				};
			}		
					
			//évènement onclick pour chaque numero de jour du mini-calendar courant
			var hiddenDateValue = document.getElementById("dateEventValue");
			hiddenDateValue.value ="";
			tdTableauCal.onclick = function(){
				if($(this).hasClass("selected")){
					$(this).attr("class","calendar");
					$(this).addClass("defaultCalendar");
				}
				else{
					$(this).attr("class","calendar");
					$(this).addClass("eventSelected");
					$(this).addClass("selected");
					if(ie6ouMoins){$(this).css("backgroundImage","none");}
				}
				tabDatePicker = resultatDatePicker(divCal, tabDatePicker, this);
			};
			
			trTableauCal.appendChild(tdTableauCal);
			tBody.appendChild(trTableauCal);
			caseCourante++;
		}
		
		if(nbrLine!=7){
		//boucle de creation des jours de chaque
			for(i=nbrLine; i<7; i++){
				while(true){
					if(caseCourante%7==0){
						tBody.appendChild(trTableauCal);
						trTableauCal = document.createElement("TR");
						nbrLine++;
						caseVide();
						break;
					}
					else{caseVide();}
				}
			}
		}	
		
		tableau.appendChild(tBody);
		divMois.appendChild(tableau);
			
		//Ecrire le mois du mini-calendrier courant
		var spanEcrireDate = document.createElement("span");
		$(spanEcrireDate).attr("id","spanEcrireDate");
		var textDateCourante = document.createTextNode(tabMois[numeroMois-1]+ " " + anneeCal);
		spanEcrireDate.appendChild(textDateCourante);
		divMois.appendChild(spanEcrireDate);
		$("#textMoisCourant").empty();
		$("#textMoisCourant").append(tabMois[numeroMois-1]+ " " + anneeCal);
		//ajout du mini-calendrier ? la div Source
		divCal.appendChild(divMois);
	}	
	
	$(divCal).after($("#commentaireEvenement").css("margin-top",$(divMois).height() + 50));
	
	//Les Boutons de navigation dans le DatePicker 
	//check textLieu > disabled liste id lieu
	var textLieu =  document.getElementById("text_lieuEvent");
	var idLieuList = document.getElementById("id_lieuEvent");
	checkTextLieu(textLieu, idLieuList);
	
	//checkbox horaire
	var checkHoraire = document.getElementById("checkHoraire");
	checkHoraire.onchange = function(){
		if(this.checked){
			$(document.getElementById("horaireDebutHeure")).attr("disabled","disabled");
			$(document.getElementById("horaireDebutMinute")).attr("disabled","disabled");
			$(document.getElementById("horaireFinMinute")).attr("disabled","disabled");
			$(document.getElementById("horaireFinHeure")).attr("disabled","disabled");
			$(this).attr("title","Définir des horaires");
		}
		else{
			$(document.getElementById("horaireDebutHeure")).removeAttr("disabled");
			$(document.getElementById("horaireDebutMinute")).removeAttr("disabled");
			$(document.getElementById("horaireFinMinute")).removeAttr("disabled");
			$(document.getElementById("horaireFinHeure")).removeAttr("disabled");
			$(this).attr("title","Ne pas définir d'horaire");
		}
	}
		
	//Bouton reset (efface les dates pr?cedemment s?lectionn?es)
	var reset = document.getElementById("resetDate");
	reset.onclick = function(){
		MonCalendar(divCal, moisNow, anneeNow, new Array(), tabTypeEvents);
	};
		

	//Bouton confirmer (confirmation des dates sélectionnées)
	
	var valid = document.getElementById("validerDate");

	valid.onclick = function(){ 
		var textEvent = document.getElementById("textevenement");
		var textEventValue = textEvent.value;
		var alertDiv = document.createElement("div");
		$(alertDiv).attr("title","Confirmation de la sélection");
		var valeurMessage = false;
		if(tabDatePicker.length == 0){
			alertText = "Veuillez sélectionner une/des date(s)";
		}
		else if(textEventValue.length == 0){
			alertText = "Veuillez saisir un nom pour l'évènement";
			$(textEvent).css("backgroundColor","#f4abab");
			textEvent.onkeypress = function(){$(this).css("backgroundColor","");};
		}
		else{
			alertText = "Evènement: <b>\"" + textEventValue + "\"</b> \n Date(s):" + tabDatePicker.join();
			valeurMessage = true;
		}
		$(alertDiv).html("<p>" + alertText + "</p>");
		
		if(valeurMessage){
			$(alertDiv).dialog({
				width: 300,
				modal: true,
				draggable: false,
				closeText: 'x',
				buttons:{
					"Confirmer": function(){ 
						var hiddenDateValue = document.getElementById("dateEventValue");
						for(i=0;i<tabDatePicker.length;i++){
							if(i<tabDatePicker.length -1){
								hiddenDateValue.value += tabDatePicker[i] + ",";
							}
							else{
								hiddenDateValue.value += tabDatePicker[i];
							}
						}
						$("#formAjout").submit();
						hiddenDateValue.value="";
						$(this).dialog("close"); 
					}, 
					"Annuler": function(){ 
						$(this).dialog("close"); 
					}
				}
			});
		}
		else{
			$(alertDiv).dialog({
				width: 300,
				modal: true,
				draggable: false,
				closeText: 'x',
				buttons:{
					"ok": function(){ 
						$(this).dialog("close"); 
					}
				}
			});
		}
	};

	//Bouton précédent (mois précédent)
	var prev = document.getElementById("prevDate");
	prev.onclick = function(){
	if(numeroMoisDepart - nbrMoisCalendrier < 1){anneeCalDepart --; numeroMoisDepart=12 +numeroMoisDepart;}
		MonCalendar(divCal, numeroMoisDepart - nbrMoisCalendrier, anneeCalDepart,tabDatePicker, tabTypeEvents);
	};
			
	//Bouton suivant (mois suivant)
	var next = document.getElementById("nextDate");
	next.onclick = function(){
		if(numeroMoisDepart + nbrMoisCalendrier > 12){anneeCalDepart ++; numeroMoisDepart = numeroMoisDepart -12;}
		MonCalendar(divCal, numeroMoisDepart + nbrMoisCalendrier, anneeCalDepart, tabDatePicker, tabTypeEvents);
	};
		
	//bouton supprimer un type d'évènement
	var buttonSupprType = document.getElementById("supprType");
	
	buttonSupprType.onclick = function(){
		var selectListe = document.getElementById("listeEvent");
		var valeurId = selectListe.options[selectListe.selectedIndex].value;
		var indexType;

		for(k=0; k<tabType_numero.length; k++){
			if(tabType_numero[k] == valeurId){
				indexType = k;
			}
		}

		var divConfirmSupprType = document.createElement("div");
		
		//[AJAX] récupération info avant suppression
		//.........................................................
			xhr.onreadystatechange = function(){
			//alert(xhr.status+" and "+xhr.readyState);
			if(xhr.readyState == 4 && xhr.status == 200){
				var chaineRes = parseInt(xhr.responseText);
				
				if(chaineRes > 0){
					if(chaineRes == 1){
						$(".infoNbSuppr").html('<b>'+chaineRes+'</b> évènement appartenant à ce type sera supprimé de la base de données.');
					}
					else{
						$(".infoNbSuppr").html('Les <b>'+chaineRes+'</b> évènements appartenant à ce type seront supprimés de la base de données.');
					}
				}
				else{
					$(".infoNbSuppr").html('Il n\'y a aucun évènement de ce type dans la base de données. <br/><i>(aucun évènement ne sera supprimé)</i>');
				}
			}
		};

		xhr.open("POST",'./modules/calendrier/info_type_event.php', true);
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xhr.send("type="+tabType_numero[indexType]);
		
		//............................................................
		
		
		$(divConfirmSupprType).html('<p>Souhaitez-vous vraiment supprimer ce type d\'évènement ?'+
		'<br/><br/><span class="infoNbSuppr"></span></p>');
		$(divConfirmSupprType).dialog({
			width: 500,
			modal: true,
			title: "Suppression du type d'évènement: " + tabType_nomEvent[indexType],
			draggable: false,
			closeText: 'x',
			buttons:{
				"confirmer": function() { 
					$("#idType_eventSuppr").val(valeurId);
					$("#formSupprType").submit();
				},
				"annuler": function() { 
					$(this).dialog("close");
				}																
																			
			}
		});
	};
		
	//bouton d'ajout d'un type d'évènement
	var buttonAddType = document.getElementById("addType");
	//$("#supprType").before($("#listeType").clone());
	$("#type_color").bind('change keypress keyup',(function(){
		if($(this).val().length>0){
			$(this).css("backgroundColor","");
		}
		else{
			$(this).css("backgroundColor","red");
		}
	}));
	
	$("#type_nom").bind('change keypress keyup',(function(){
		if($(this).val().length>0){
			$(this).css("backgroundColor","");
		}
		else{
			$(this).css("backgroundColor","red");
		}
	}));
	
	buttonAddType.onclick = function(){
		$("#type_nom").css("backgroundColor","");
		$("#type_color").css("backgroundColor","");
		$("#type_nom").removeAttr("value");
		$("#type_color").removeAttr("value");
		$("#idType_event").removeAttr("value");
		$("#divFormActionType").dialog({
			width: 400,
			modal: true,
			draggable: false,
			title: "Ajouter un type d'évènement",
			closeText: 'x',
			buttons:{
				"valider": function(){ 
					if($("#type_nom").val().length>0 && $("#type_color").val().length>=3){
						$("#modeType").val("ajouter");
						$("#formActionType").submit();
					}
					else{
						if($("#type_nom").val().length==0){
							$("#type_nom").css("backgroundColor","red");
						}
						else{
							$("#type_nom").css("backgroundColor","");
						}
						
						if($("#type_color").val().length<3){
							$("#type_color").css("backgroundColor","red");
						}
						else{
							$("#type_color").css("backgroundColor","");
						}
					}
				},
				"annuler": function(){ 
					$(this).dialog("close");
				}																
			}
		});	
	};
		
	//bouton modification d'un type d'évènement
	var buttonModifType = document.getElementById("modifType");
	buttonModifType.onclick = function(){
		var selectListe = document.getElementById("listeEvent");
		var valeurId = selectListe.options[selectListe.selectedIndex].value;
		var indexType;

		for(k=0; k<tabType_numero.length; k++){
			if(tabType_numero[k] == valeurId){
				indexType = k;
			}
		}
		$("#type_nom").css("backgroundColor","");
		$("#type_color").css("backgroundColor","");
		$("#type_nom").val(tabType_nomEvent[indexType]);
		$("#type_color").val(tabType_color[indexType]);
		$("#idType_event").val(valeurId);
		$("#divFormActionType").dialog({
			width: 500,
			modal: true,
			draggable: false,
			title :"Modification du type d'évènement: "+ tabType_nomEvent[indexType],
			closeText: 'x',
			buttons:{
				"valider": function(){
						if($("#type_nom").val().length>0 && $("#type_color").val().length>=3){
							$("#modeType").val("ajouter");
							$("#formActionType").submit();
						}
						else{
							if($("#type_nom").val().length==0){
								$("#type_nom").css("backgroundColor","red");
							}
							else{
								$("#type_nom").css("backgroundColor","");
							}
							
							if($("#type_color").val().length<3){
								$("#type_color").css("backgroundColor","red");
							}
							else{
								$("#type_color").css("backgroundColor","");
							}
						}
				},
				"annuler": function(){ 
					$(this).dialog("close");
				}																
																		
			}
		});	
	};
}