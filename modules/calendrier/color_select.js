 /* 
  * Module Calendrier
  * Gestion des évènements pour le choix d'une couleur.
  * Génération tableau des couleurs fréquentes et suite à un clic utilisateur, 
  * renvoi le code de la couleur sélectionnée.
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */


	document.getElementById("Button_type_color").onclick = function(){ //Evenement lors du clic sur le bouton "choix"
		var divSelectColor = document.createElement("div");
		$(divSelectColor).addClass("colorSelecter");
		var tabMiniColor = new Array( //Tableau qui stocke les couleurs sélectionnables
		"000000","993300","333300","003300","003366","000099","5500BB","333333",
		"400000","BB6600","555500","116000","115080","0000AA","660099","444444",
		"800000","DD7700","88CC00","339900","3384A3","1133DD","701188","666666",
		"BB0022","EEBB00","BBCC00","55CC33","55AABB","3377FF","802277","888888",
		"FF0055","FFEE00","DDCC44","99FF99","88CCDD","7755FF","993366","AAAAAA"
		);
		
		var textDivSelectColor = '<table><tr>';
		for(z=0; z<tabMiniColor.length; z++){
			if(z!=0 && z%8==0){
				textDivSelectColor += '</tr><tr>';
			}
			textDivSelectColor += '<td class="colorChoice" id="'+tabMiniColor[z]+'" style="background-color:#'+tabMiniColor[z]+'"></td>';
		}
		
		textDivSelectColor += '</tr></table>';
	
		$(divSelectColor).html(textDivSelectColor);
		$(divSelectColor).find('.colorChoice').click(function(){
		    $("#type_color").css("backgroundColor","");
			$('#type_color').val("#"+$(this).attr("id"));
			$(divSelectColor).dialog("close")
		});
		$(divSelectColor).dialog({draggable: false, closeText: 'x', title:'SÃ©lectionnez une couleur'});
	}