<?php
 /* 
  * Module Calendrier
  * GÈnËre des tableaux rÈcapitulatifs de tous les ÈvËnements du mois sÈlectionnÈ.
  *
  * Auteur : BenoÓt SOUFFLET <benoit.soufflet@gmail.com>
  */
?>


<script type="text/javascript">
			var divPrint = document.getElementById("accordionCal");
			var textDivPrint = '<h4 class="header titreSaison">R√©capitulatif des √©v√®nements du mois de '+tabMois[<?php echo $mois-1;?>] + ' ' + <?php echo $annee;?> +'</h4>'
			+ '<div id="boiteRecap" class="box2">';
			for(i=0;i<tabId.length;i++){
				var typeEvent = "";
				var typeColor = "";
				for(j=0;j<tabType_numero.length;j++){
					if(tabType[i]==tabType_numero[j]){
						typeEvent = tabType_nom[j];
						typeColor = tabType_color[j];
					}
				}
				
				var indexJour;
				if(tabDate[i][0]==0){
					indexJour = (parseInt(tabDate[i].substr(1,2))+firstDay-1)%7;
				}
				else{
					indexJour = (parseInt(tabDate[i].substr(0,2))+firstDay-1)%7;
				}
				
				var jour = tabJour[indexJour];
				
				var tabInfoTitre = new Array("Nom","Type","Lieu","D√©but","Fin","Commentaire");
				var tabInfo = new Array(tabNom[i],typeEvent,tabLieu[i],tabDebut[i],tabFin[i],tabComm[i]);
				textDivPrint += '<div class="printInfo"><span class="dateMiniTab">'+jour +' ' + tabDate[i] + ':</span>'
								+ '<table style="border-style:solid; border-width:2px; border-color:'+typeColor+'">';
				
				for(k=0;k<tabInfoTitre.length;k++){
					if(tabInfo[k]!=""){
						textDivPrint +=	'<tr>' +
											'<td class="print">'+ tabInfoTitre[k]+'</td>'+
											'<td>' + tabInfo[k] + '</td>' +
										'</tr>';
					}
				}
									
				textDivPrint +=	'</table></div>';
			}
			
			textDivPrint +=	'</div>';
			
			$(divPrint).html(textDivPrint);
			if($("#boiteRecap").height() < 250){
				$("#boiteRecap").css("height","auto");
			}
			else{
				$("#boiteRecap").css("height","250px");
			}
			//$(divPrint).dialog();
			$(document).ready(function(){
				$("#accordionCal").accordion({ autoHeight: false, collapsible: true, active:false});
			});

		document.getElementById("printCalendar").onclick = function(){
			var divPrint2 = $(divPrint).clone();
			$(divPrint2).find('.printInfo').removeClass('printInfo').addClass('printInfo2');
			$(divPrint2).find('div').css("display","block");
			
			$(document).ready(function(){
				printPartOfPage(divPrint2);
			});
		}
		
		
		function printPartOfPage(elementId){
		 var printContent = $(elementId);
		 var windowUrl = './';
		 var printWindow = window.open(windowUrl);

		 printWindow.document.write('<html><head><title>Ev√®nements  '+tabMois[<?php echo $mois-1;?>] + ' ' + <?php echo $annee;?>+'</title>'
		 +'<link href="./modules/calendrier/calendrier_consultation.css" rel="stylesheet" type="text/css" /></head><body>' 
		 +'<h3>SESQUIDISTUS</h3>'+ $(printContent).html()  +'</body></html>' );
		 printWindow.document.close();
		 printWindow.focus();
		 printWindow.print();
		// printWindow.close();
		}
		
		$("#pdfCalendar").click( function(){
			$("#formPdfCalendar").submit();
		});
</script>