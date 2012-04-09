 /* 
  * Module Calendrier
  * Sert à générer le calendrier ainsi que sa légende.
  * Gère également les évènements (sens informatique) liés  aux actions réalisées par les utilisateurs (click, onmouseover, …)
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

function MonCalendar(divSource, mois, an, tabResultatConfirmation, tabTypeEvents, boolAdmin){
	
	$(divSource).empty(); //suppression des eventuels elements se trouvant dans la div Source
	
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
		
	if(tabTypeEvents){ //Chargement des informations relatives aux types d'évènement.
		tabType_numero = tabTypeEvents[0];
		tabType_nomEvent = tabTypeEvents[1];
		tabType_color = tabTypeEvents[2];
	}
	
	//MAJ des variables dans le cas ou les bons éléments sont présent en parametre de la fonction
	if(mois && an){
		numJour = 0;
		numeroMois = mois;
		numeroMoisDepart = numeroMois;
		anneeCal = an;
		anneeCalDepart = anneeCal;
		nbrJour = nombreDeJourParMois(an, mois);
	}
		
	if(tabResultatConfirmation){ //Tableau de sauvegarde lorsqu'on passe d'un mois à un autre.(sauvegarde des évènements sélectionnés)
		tabDatePicker = tabResultatConfirmation[0];
		tabTypeEventCourant = tabResultatConfirmation[1];
		tabNomEvent = tabResultatConfirmation[2];
		tabIdEvent = tabResultatConfirmation[3];	
	}
	else{
		tabDatePicker = new Array();
	}
		
	if(!boolAdmin){
		boolAdmin = false;
	}
	
	// - VARIABLES POUR LA MISE EN FORME DU CALENDRIER	
	//definition des valeurs par défault
	var nbrMoisCalendrier = 1;
		
	var divCal = divSource;
	var chaineCalendar = "";
	var decalageLeftCal= 0;
	var decalageTopCal= 15;
	var nbElement = nbrMoisCalendrier;  if(nbElement>3){nbElement = 3;}
	var boolTailleDiv = false;
	var widthDatePicker;
	var divMoisWidth=750;
	
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
			boolTailleDiv = true;
		}
			
		//positionnement des mini-calendar
		$(divCal).css("width",widthDatePicker +"px");
			
		if(z>0){decalageLeftCal += divMoisWidth + 50;}
		if(z!= 0 && z%3==0){decalageTopCal += 335; decalageLeftCal = 0;}
		$(divMois).css("left",decalageLeftCal + "px");
		$(divMois).css("top",decalageTopCal + "px");
		
		//Ajout de l'indication de jours de la semaine dans le mini-calendar
		tabMiniJour = tabJour;
			
		for(g=0; g<tabMiniJour.length; g++){
			var tdTableau = document.createElement("TD");
			$(tdTableau).attr("width","96");
			$(tdTableau).attr("height","50");
			$(tdTableau).attr("style","text-align:center; font-weight:bold;");
			tdTableau.appendChild(document.createTextNode(tabMiniJour[g]));
			trTableau.appendChild(tdTableau);
			
			if(g >= (tabMiniJour.length-2)){
				$(tdTableau).css("color","#d72c2c");
			}
		}
		
		tBody.appendChild(trTableau);
		if(z>0){numeroMois++}
		if(numeroMois==13){numeroMois=1; anneeCal ++;}
		if(numeroMois<10){numeroMois = "0" + numeroMois;}
		nbrJour = nombreDeJourParMois(anneeCal, numeroMois);
		var trTableauCal = document.createElement("TR");
		var caseCourante=0;
		var nbrLine =0;
		
		function caseVide(){
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
			//ajout de "0" en début de chaine si le jour courant < 10
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
			$(tdTableauCal).attr("width","96");
			$(tdTableauCal).attr("height","50");
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
					
					//Ecriture du nom de l'evenement pour la consultation
					$(tdTableauCal).addClass("defaultCalendar");
					$(tdTableauCal).addClass("selected");
					if(multi==0){ //S'il y a un seul évènement par case
						var tBodyTD = document.createElement("TBODY");
						var tableTD = document.createElement("table");
						tableTD.appendChild(tBodyTD);
						tdTableauCal.appendChild(tableTD);
					}
							
					var trTD = document.createElement("tr");
					tBodyTD.appendChild(trTD);
					multi++;
					var tdTD = document.createElement("td"); 
					$(tdTD).attr("title",numJourZero + "/"  +numeroMois+ "/" +anneeCal);
					trTD.appendChild(tdTD);
					if(ie6ouMoins){$(tdTD).css("backgroundImage","none");}
					$(tdTD).css("margin","0px");
					$(tdTD).attr("width","96");
					$(tdTD).addClass("outSelected");
					$(tdTD).addClass("calendar");
					$(tdTD).addClass("eventSelected");
					$(tdTD).addClass("selected");
					var typeEventCourant = tabTypeEventCourant[k];
					$(tdTD).attr("alt",tabIdEvent[k])
					$(tdTD).css("cursor","pointer");
					var divNomEvent = document.createElement("div");
					$(divNomEvent).attr("class","divNomEvent");
					var textNomEvent = document.createTextNode(tabNomEvent[k]);
					divNomEvent.appendChild(textNomEvent);
					tdTD.appendChild(divNomEvent);
				
					for(j=0; j<tabType_color.length; j++){
						if(typeEventCourant==tabType_numero[j]){
							$(tdTD).css("backgroundColor",tabType_color[j]);
							$(tdTD).css("borderColor",tabType_color[j]);
							break;
						}
					}
								
					tdTD.onclick = function(){
						var divEventClick = document.getElementById($(this).attr("alt"));
						tailleElement($(this).attr("alt"));
						var dateEvenement = $(this).attr("title");
						$(divEventClick).attr("title","Evènement du " + dateEvenement);
						
						if(boolAdmin){
							var idEvent = divEventClick.getAttribute("id");
							$(divEventClick).dialog({
								width: 450,
								modal: true,
								title: $(this).attr("title"),
								draggable: false,
								closeText: 'x',
								buttons: {
									"ok": function() { 
										$(this).dialog("close");
									} ,
									"Modifier l'évènement": function(){
										$(this).dialog("close");
										var divConfirmSuppr = document.createElement("div");
										divConfirmSuppr.setAttribute("title","Confirmer la modification");
										$(divConfirmSuppr).html("<p>Confirmer la modification de l'évènement:<br /> <b>\"" + $(divEventClick).find("#nomEvenement"+idEvent).val() + "\"</b>  du " + dateEvenement + " ? </p>");
										$(divConfirmSuppr).dialog({
											width: 330,
											modal: true,
											draggable: false,
											closeText: 'x',
											buttons: {
												"confirmer": function(){ 
												var textFormModif = "formModif"+idEvent;
												var formModif = document.getElementById(textFormModif);
												formModif.submit(); 
												},
												"annuler": function(){ 
													$(this).dialog("close");
												}																
																
											}
																 
										});															
									},
									"Supprimer l'évènement": function(){
										$(this).dialog("close");
										var divConfirmSuppr = document.createElement("div");
										divConfirmSuppr.setAttribute("title","Confirmer la suppression");
										$(divConfirmSuppr).html("<p>Confirmer la suppression de l'évènement:<br /> <b>\"" + $(divEventClick).find("#nomEvenement"+idEvent).val() + "\"</b>  du " + dateEvenement + " ? </p>");
										$(divConfirmSuppr).dialog({
											width: 330,
											modal: true,
											draggable: false,
											closeText: 'x',
											buttons: {
												"confirmer": function() { 
												var formSuppr = document.getElementById("formSuppr");
												document.getElementById("inputSuppr").value = idEvent;
												formSuppr.submit(); 
												},
												"annuler": function() { 
													$(this).dialog("close");
												}																					
											}
																 
										});															
									}
								}
							});
							
							//check textLieu > disabled liste id lieu
							var textTextLieu = "text_lieuEvent"+idEvent;
							var textLieu =  document.getElementById(textTextLieu);
							var textIdLieuList = "id_lieuEvent"+idEvent;
							var idLieuList = document.getElementById(textIdLieuList);
							checkTextLieu(textLieu, idLieuList);
							
							//checkbox horaire
							var checkHoraire = document.getElementById("checkHoraire"+idEvent);
							if(checkHoraire.checked){
								$(document.getElementById("horaireDebutHeure"+idEvent)).attr("disabled","disabled");
								$(document.getElementById("horaireDebutMinute"+idEvent)).attr("disabled","disabled");
								$(document.getElementById("horaireFinMinute"+idEvent)).attr("disabled","disabled");
								$(document.getElementById("horaireFinHeure"+idEvent)).attr("disabled","disabled");
								$(checkHoraire).attr("title","Définir des horaires");
							}
							checkHoraire.onchange = function(){
								if(this.checked){
									$(document.getElementById("horaireDebutHeure"+idEvent)).attr("disabled","disabled");
									$(document.getElementById("horaireDebutMinute"+idEvent)).attr("disabled","disabled");
									$(document.getElementById("horaireFinMinute"+idEvent)).attr("disabled","disabled");
									$(document.getElementById("horaireFinHeure"+idEvent)).attr("disabled","disabled");
									$(this).attr("title","Définir des horaires");
								}
								else{
									$(document.getElementById("horaireDebutHeure"+idEvent)).removeAttr("disabled");
									$(document.getElementById("horaireDebutMinute"+idEvent)).removeAttr("disabled");
									$(document.getElementById("horaireFinMinute"+idEvent)).removeAttr("disabled");
									$(document.getElementById("horaireFinHeure"+idEvent)).removeAttr("disabled");
									$(this).attr("title","Ne pas définir d'horaire");
								}
							}
						}
						else{
							$(divEventClick).dialog({
								width: 380,
								modal: true,
								title: $(this).attr("title"),
								draggable: false,
								closeText: 'x',
								buttons:{
									"ok": function() { 
										$(this).dialog("close"); 
									} 
								}
							});
						}
					};
							
					tdTD.onmouseover = function(){
						if(!$(this).hasClass("selected")){
							$(this).attr("class","calendar");
							$(this).addClass("calendarMouseOver");
						}
						else{
							$(this).removeClass("outSelected");
							$(this).addClass("overSelected");
						}
					};
			
					tdTD.onmouseout = function(){
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
			}
				
			if(multi==0){
				tdTableauCal.appendChild(textCalendar);
			}
			else{
				tdTD.appendChild(divJourMois);
				var heightdTD = 50/multi;
				$(tdTableauCal).find('td').attr("height",heightdTD);
			}
				
			if(multi==0){
				if(!ie6ouMoins){
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
			}		
		
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
	
	// if(tabType_numero.length > 0){
		// var legende = document.getElementById("legende");
		// $(legende).css("display","block");
		// divCal.appendChild(legende);
		// $(legende).css("top",$(divMois).height() + 50);
		// $(legende).css("display","block");
	// }
	//Bouton pr?cedent (mois pr?cedent)
	var prev = document.getElementById("prevDate");
	
	prev.onclick = function(){
		var inputMois = document.getElementById("inputMois");
		var inputAnnee = document.getElementById("inputAnnee");
		inputMois.value = parseInt(inputMois.value) - 1;
		if(inputMois.value<1){
			inputAnnee.value = parseInt(inputAnnee.value) - 1;
			inputMois.value = 12;
		}
		$("#formMonth").submit();
	};
			
			
	//Bouton suivant (mois suivant)
	var next = document.getElementById("nextDate");
	
	next.onclick = function(){
		var inputMois = document.getElementById("inputMois");
		var inputAnnee = document.getElementById("inputAnnee");
		inputMois.value = parseInt(inputMois.value) + 1;
		if(inputMois.value>12){
			inputAnnee.value = parseInt(inputAnnee.value) + 1;
			inputMois.value = 1;
		}
		$("#formMonth").submit();
	};
}

$(document).ready(function() {
    $("#accordionCal").accordion({ autoHeight: false, collapsible: true, active:false});
});

