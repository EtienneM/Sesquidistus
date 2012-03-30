<?php
/* 
  * Module Calendrier
  * Gestion et mise en page des formulaires pour l'ajout d'�v�nements dans le calendrier.
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */

		if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
		
?>


<!-- Commencement de la div Globale où le calendrier prendra place -->

	<div class="totalBox">
		<div  class="box" style="background-color:#EEE">
			<div class="titreNews">Ajout d'un évènement:</div>
				<form id="formAjout" style="display:inline" method="post" action="./modules/calendrier/action.php">
					<div id="globCalendar">
						<div style="text-align:left">
							<div style="float:right">
								<a href="./doc/doc_event/doc_admin_event.html#ajouter_evenement">
									<img src="./images/help.png" alt="help" title="aide en ligne" />
								</a>
							</div>
								<div id="listeType" class="bouton2 dataForm">
									<span id="spanListeType" style="font-size:12px; padding:0 8px 0 3px">Type:</span>
									<div id="divListeEvent" style="display:inline">
									  <select id="listeEvent" style="font-size:12px" name="typeEvent">
									 <?php
											mysql_connect($host, $user, $passwd); 
											mysql_select_db($bdd);
											mysql_query("SET NAMES 'utf8'");
											
											$req3 = "SELECT nom, numero, color FROM type_event ORDER BY numero";
											$res3 = mysql_query($req3)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
										
											while($data3 = mysql_fetch_array($res3))
											{ ?>
												<option value="<?php echo $data3["numero"]; ?>"><?php echo $data3["nom"]; ?></option>
									   <?php  
																echo 	'<script type="text/javascript">
																			tabType_numero.push("'.$data3["numero"].'");
																			tabType_nom.push("'.$data3["nom"].'");
																			tabType_color.push("'.$data3["color"].'");
																		</script>';

											}
											mysql_close(); ?>
									  </select>
									</div>
									
								</div>
								<div id="divButtonType" style="position:absolute; margin-top:-30px; margin-left:265px">
									<span id="modifType" title="Modifier ce type d'évènement" class="bouton1">#</span>
									<span id="supprType" title="Supprimer ce type d'évènement" class="bouton1">X</span>
									<span id="addType" title="Ajouter un type d'évènement à la base de données" class="bouton1">+</span>
								</div>
							
							<div class="bouton2 dataForm">
								<span style="font-size:12px;  padding:0 10px 0 3px">Nom:</span>
								<input class="inputStyle" id="textevenement" name="nomEvent" maxlength="35" type="text"/>
							</div>
							
							<div id="listeLieu" class="bouton2 dataForm">
								<span id="spanListeLieu"" style="font-size:12px; padding:0 11px 0 3px">Lieu:</span>
								<div id="divListeLieu" style="display:inline">
								  <select id="id_lieuEvent" style="font-size:12px" name="id_lieuEvent">
										   <option selected="selected" value="init">--Liste des lieux--</b></option>
								 
								 <?php //Récupération de la liste des lieux d'entrainement enregistrés dans la bdd.
										mysql_connect($host, $user, $passwd); 
										mysql_select_db($bdd);
										
										$reqLieu = "SELECT nom, numero FROM lieu_ultimate ORDER BY numero";
										$resLieu = mysql_query($reqLieu)  or die('Erreur SQL !<br />'.$reqLieu.'<br />'.mysql_error());
									
										while($dataLieu = mysql_fetch_array($resLieu))
										{ //Gérération de la liste déroulante de la liste des lieux 
										?>
											<option value="<?php echo $dataLieu["numero"]; ?>"><?php echo $dataLieu["nom"]; ?></option>
								   <?php 
										}
										mysql_close(); ?>
								  </select>
								</div>
								<input id="text_lieuEvent" class="inputStyle" style="margin-left:50px" type="text" maxlength="35" name="text_lieuEvent" />
								
							</div>
							
							<div class="bouton2 dataForm2">
								<span style="font-size:12px;  padding:0 0 0 3px">Durée (jour):</span>
								<div style="display:inline">
								  <select style="font-size:12px" id="duree_event" name="duree_event">
								  <?php 
									for($i=1; $i<=7; $i++){ 
										
									echo '<option value="'.$i.'">'.$i.'</option>';
							  	}
								  ?>
								  </select>
								</div>
							</div>
							
							<div class="bouton2 dataForm2">
								<span style="font-size:12px;  padding:0 0 0 3px">Début:</span>
								<div style="display:inline">
								  <select style="font-size:12px" id="horaireDebutHeure" name="debutEventHeure">
								  <?php 
									for($i=0; $i<24; $i++){ 
										$heure=$i;
										if($heure<10){$heure="0".$heure;}
									?>
										<option value="<?php echo $heure; ?>"><?php echo $heure; ?></option>
							  <?php }
								  ?>
								  </select>
								</div>
								<div style="display:inline">
								  <select style="font-size:12px" id="horaireDebutMinute" name="debutEventMinute">
								  <?php 
									for($i=0; $i<60; $i=$i+5){ 
										$minute=$i;
										if($minute<10){$minute="0".$minute;}
									?>
										<option value="<?php echo $minute; ?>"><?php echo $minute; ?></option>
							  <?php }
								  ?>
								  </select>
								</div>
								<input type="checkbox" id="checkHoraire" name="boolHoraire" value="true" title="Ne pas définir d'horaire" />
							</div>
							<div class="bouton2 dataForm2">
								<span style="font-size:12px; padding:0 19px 0 3px">Fin:</span>
								<div style="display:inline">
								  <select style="font-size:12px" id="horaireFinHeure" name="finEventHeure">
								  <?php 
									for($i=0; $i<24; $i++){ 
										$heure=$i;
										if($heure<10){$heure="0".$heure;}
									?>
										<option value="<?php echo $heure; ?>"><?php echo $heure; ?></option>
							  <?php }
								  ?>
								  </select>
								</div>
								<div style="display:inline">
								  <select style="font-size:12px" id="horaireFinMinute" name="finEventMinute">
								  <?php 
									for($i=0; $i<60; $i=$i+5){ 
										$minute=$i;
										if($minute<10){$minute="0".$minute;}
									?>
										<option value="<?php echo $minute; ?>"><?php echo $minute; ?></option>
							  <?php }
								  ?>
								  </select>
								</div>
							</div>
						</div>
					
						<div style="text-align:left; margin:20px 0px 30px 0px">
							<div style="font-size:12px; font-weight:bold; margin-left:4px">
								Sélectionnez la date de début de l'évènement à ajouter: <br />
								<span style="font-style:italic; font-size:11px; font-weight:normal">
									(Vous pouvez séléctionner plusieurs dates afin d'enregister plusieurs fois le même évènement à des dates différentes)
								</span>
							</div>
						</div>	
						<div style="text-align:center">
								<span style="font-size:10px" id="prevDate" class="bouton1">&lt;&lt; Mois précédents</span>
								<span style="margin-left:70px; font-size:10px" id="nextDate" class="bouton1">Mois suivants &gt;&gt;</span>
							</div>
						<div id="datepicker"></div>
							
					 </div>
					 
					<div style="position:absolute; margin-bottom:0px; left:0px" id="commentaireEvenement">
						<div style="margin-left:0px; width:300px">
							<div class="totalBox">
								<div class="box">
									<div class="titreNews">Commentaire (facultatif)</div>
										<textarea style="font-size:12px;" id="CommentaireEvent" name="commentaireEvent" tabindex="4" cols="35" rows="8"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div style="text-align:right">
							<input type="reset" id="resetDate" class="bouton1" value="Remise à zéro" />
							<span id="validerDate" class="bouton1" style="padding:8px 5px; font-size:14px">Valider l'évènement</span>
					</div>
					<input type="hidden" id="dateEventValue" name="dateEvent" value="" />
				</form>
			</div>
		</div>

<!-- Formulaire action Type -->
								<div id="divFormActionType" style="display:none">
									<div style="float:right">
										<a href="./doc/doc_event/doc_admin_type_event.html">
											<img src="./images/help.png" alt="help" title="aide en ligne" />
										</a>
									</div>
									<form id="formActionType" method="post" action="./modules/calendrier/action_type.php">
										<div id="titreNewType" class="bouton2 dataForm">
											<span style="font-size:12px;  padding:0 10px 0 3px">Titre:</span>
											<input id="type_nom" class="inputStyle" type="text" name="nomType" />
										</div>
										<div class="bouton2 dataForm">
											<span style="font-size:12px;  padding:0 10px 0 3px">Couleur:</span>
											<input id="type_color" style="width:100px; font-size:12px" type="text" name="color" />
											<span id="Button_type_color" class="bouton1">Choix</span>
										</div>
										<input id="idType_event" type="hidden" name="idType_event" />
										<input id="modeType" type="hidden" name="modeType" />
									</form>
								</div>		
<!-- Fin formulaire ajout Type -->	

<!-- Formulaire ajout Type -->
<form style="display:none" id="formSupprType" method="post" action="./modules/calendrier/suppr_type.php">
	<input id="idType_eventSuppr" type="hidden" name="idType_eventSuppr" />
</form>
<!-- fin Formulaire ajout Type -->
	
<script type="text/javascript" src="./modules/calendrier/calendrier_global.js"></script>
<script type="text/javascript" src="./modules/calendrier/calendrier_ajout.js"></script>
<script type="text/javascript">
	var tabTypeEvent = new Array(tabType_numero, tabType_nom , tabType_color);
    $("#ajoutButton").addClass("boutonPageCourante").attr("onclick","");
    MonCalendar(document.getElementById("datepicker"), <?php echo $monthNow;?>, <?php echo $yearNow;?>, null, tabTypeEvent);
</script>
 
 <script type="text/javascript" src="./modules/calendrier/color_select.js"></script>
<?php }
	  else{ //Si pas admin, message d'erreur.
		echo '<div class="totalBox">
			<div class="box">
			<div class="titreNews">Erreur :</div>
				<span>Cette page est uniquement accessible aux administrateurs du site...</span>
			</div>
		</div>';
	  }	  