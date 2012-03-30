<?php

 /* 
  * Module Sondage
  * G�n�re le formlulaire et l'interface d'ajout de sondage (pour ADMIN).
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */

if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
?>
	<span id="consultButton" class="bouton1" onclick="javascript:document.location='./?categorie=sondage'">Visualiser les sondages</span>
	<span id="ajoutButton" class="bouton1 boutonPageCourante">Ajouter un sondage</span>
	
	<div class="totalBox" style=" margin-top:20px;">
		 <div class="box">
		 <div class="titreNews">Ajout d'un sondage:</div>
			<form id="formSondage" method="post" action="./modules/sondage/action_ajout.php">
				<div class="bouton2 dataForm">
					Question: <input id="nomQuestion" class="inputStyle" type="text" name="nomQuestion" />
				</div>
				<input id="reponseFinale" type="hidden" name="reponseFinale" />
				<div class="bouton2 dataForm">Nombre de réponses possibles:
								  <select style="font-size:12px" id="nbReponse" name="nbReponse">
								  <?php 
									for($i=2; $i<=6; $i++){ 
									?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							  <?php }
								  ?>
								  </select>
				</div>
				<div style="width:400px" id="reponses" class="bouton2 dataForm">
		
				</div>
				
				<div style="text-align:right">
					<input id="reset" type="reset" id="resetSondage" class="bouton1" value="Remise à zéro" />
					<span id="validerSondage" class="bouton1">Valider ce sondage</span>
				</div>
			</form>
		</div>
	</div>
	
	 <script type="text/javascript">
		creerRep();
		var selectRep = document.getElementById("nbReponse");
		selectRep.onchange = function(){creerRep();};
		document.getElementById("reset").onclick = function(){creerRep(2);};
		
		function creerRep(nbRep){
			if(!nbRep){
				var selectRep = document.getElementById("nbReponse");
				var nbRep = selectRep.options[selectRep.selectedIndex].value;
				//alert(nbRep);
			}
			var textRep ="";
				for(i=1; i<=nbRep; i++){
					textRep += '<span>Réponse '+ i + ': </span><input id="rep'+ i +'" style="margin-right:10px" class="inputStyle2" type="text" />';
					if(i%2==0){
						textRep +="<br />";
					}
				}
			$("#reponses").html(textRep);
		}
		
		document.getElementById("validerSondage").onclick = valider;
		
		function valider(){
			var selectRep = document.getElementById("nbReponse");
			var nbRep = selectRep.options[selectRep.selectedIndex].value;
			
			var repVide = false;
			for(i=1; i<=nbRep && !repVide; i++){
					if($("#rep"+i).val()==""){
						repVide = true;
					}
			}
			var divVal = document.createElement("div");
			
			if($("#nomQuestion").val()==""){
				$(divVal).html("Le champs \"Question\" n'a pas été rempli.");
				$(divVal).dialog({
					width: 350,
					title: "Erreur:",
					modal: true,
					draggable: false,
					closeText: 'x',
					buttons: {
						"ok": function() { 
							$(this).dialog("close");
						}
					}
				});
			}
			else if(repVide){
				$(divVal).html("Tous les champs de réponse ne sont pas remplis.");
				$(divVal).dialog({
					width: 350,
					title: "Erreur:",
					modal: true,
					draggable: false,
					closeText: 'x',
					buttons: {
						"ok": function() { 
							$(this).dialog("close");
						}
					}
				});
			}
			else{
				$(divVal).html("Confirmer ce sondage?");
				$(divVal).dialog({
						width: 350,
						modal: true,
						title: "Confirmation du sondage:",
						draggable: false,
						closeText: 'x',
						buttons: {
							"Annuler": function() { 
								$(this).dialog("close");
							} ,
							"Confirmer": function() {
								var selectRep = document.getElementById("nbReponse");
								var nbRep = selectRep.options[selectRep.selectedIndex].value;
								var resultat ="";
								for(i=1; i<=nbRep; i++){
									resultat += $("#rep"+i).val();
									if(i<nbRep){resultat += "~";}
								}
								$("#reponseFinale").val(resultat);
																	
								$("#formSondage").submit();														
							}
														
						}
				});
			}
	
		}
	 </script>

<?php 
}
else{
?>
	<div class="totalBox">
		 <div class="box">
		 <div class="titreNews">Erreur :</div>
			<span>Cette page est uniquement accessible aux membres du site...</span>
		</div>
	</div>
<?php
}
?>