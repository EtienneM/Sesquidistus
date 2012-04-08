<?php 
 /* 
  * Module Calendrier
  * Sert � g�n�rer le calendrier ainsi que sa l�gende.
  * G�re �galement les �v�nements (sens informatique) li�s  aux actions r�alis�es par les utilisateurs (click, onmouseover, �)
  *
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */


//D�claration des tableaux en JS pour sauvegarde des données et passage vers calendrier_consultation.js
echo '<script type="text/javascript">
			var tabId = new Array();
			var tabDate = new Array();
			var tabType = new Array();
			var tabNom = new Array();
			var tabDebut = new Array();
			var tabFin = new Array();
			var tabLieu = new Array();
			var tabComm = new Array();
			var tabType_numero = new Array();
			var tabType_nom = new Array();
			var tabType_color = new Array();
		</script>';
		
	if(!isset($_POST['inputMois']) || !isset($_POST['inputAnnee'])){
		$_POST['inputMois'] = $monthNow;
		$_POST['inputAnnee'] = $yearNow;
	}
	
	
	$mois = $_POST['inputMois'];
	$annee = $_POST['inputAnnee'];
	
	$mois1 = $mois;
	$annee1 = $annee;
	$annee2 = $annee;
	
	$mois2 = (int)$mois - 1;
	if($mois2==0){
		$mois2 = 12;
		$annee2--;
	}
	
	if($mois1 == 12){
		$mois1 = 0;
		$annee1++;
	}
	
	$date1 = $annee1.'-'.((int)$mois1+1).'-01';
	$date2 = $annee2.'-'.$mois2.'-01';
	
	
	mysql_connect($host, $user, $passwd); 
	mysql_select_db($db);
	mysql_query("SET NAMES 'utf8'");

	
		$req4 = "SELECT TC.numero, TC.nom, TC.color FROM type_event TC, evenement E WHERE TC.numero = E.type AND E.date BETWEEN '$date2' AND '$date1'";
		$res4 = mysql_query($req4)  or die('Erreur SQL !<br />'.$req4.'<br />'.mysql_error());
					
			$tabType_nomEvent = array();
			$tabType_numero = array();
			$tabType_color = array();
			$tabTypeUse = array();
			$i=0;
			while($data4 = mysql_fetch_array($res4))
			{
				$tabType_nomEvent[$i] = $data4["nom"];
				$tabType_numero[$i] = $data4["numero"];
				$tabType_color[$i] = $data4["color"];
				echo 	'<script type="text/javascript">
							tabType_numero.push("'.$data4["numero"].'");
							tabType_nom.push("'.$data4["nom"].'");
							tabType_color.push("'.$data4["color"].'");
						</script>';
				$i++;
			}
	
	$reqlieu = "SELECT lu.nom, lu.numero FROM lieu_ultimate lu, evenement E WHERE lu.numero = E.id_lieu AND E.date BETWEEN '$date2' AND '$date1' ORDER BY E.date";
	$reslieu = mysql_query($reqlieu)  or die('Erreur SQL !<br />'.$reqlieu.'<br />'.mysql_error());
					
			$tabLieu_nom = array();
			$tabLieu_numero = array();
			
			$i=0;
			while($datalieu = mysql_fetch_array($reslieu))
			{
				$tabLieu_nom[$i] = $datalieu["nom"];
				$tabLieu_numero[$i] = $datalieu["numero"];
				$i++;
			}
	
	//Requete de sélection des informations sur les évènements pour l'affichage de ceux-ci.
	$req = "SELECT id, titre, duree, lieu, id_lieu, type, DATE_FORMAT(date, '%d/%m/%Y') AS dateEvent, duree, horaire_debut, horaire_fin, description FROM evenement WHERE date BETWEEN '$date2' AND '$date1' ORDER BY date";
  	$res = mysql_query($req)  or die('Erreur SQL !<br />'.$req.'<br />'.mysql_error());
	
	while($data = mysql_fetch_array($res)){
	$data["description"] = str_replace("\r\n"," ",$data["description"]);
		echo '<script type="text/javascript">';
				
				for($i=0; $i<$data['duree']; $i++){ //Calcul de la durée d'un évènement
						
						$newDate = explode("/",$data['dateEvent']);
				echo 'var newDate = new Date('.$newDate[2].','.((int)($newDate[1])-1).', '.((int)($newDate[0])).');
						newDate.setDate(newDate.getDate()+'.$i.');
					  
					  var day =  newDate.getDate();
					  var month =  parseInt(newDate.getMonth()+1);
					  var year =  newDate.getFullYear();

					if(month == '.$mois.'){	
					  if(day<10){day = "0" + day;}
					  if(month<10){month = "0" + month;}
					  var formatDate = day + "/" + month + "/" + year;
						
						//alert(formatDate);
					
						tabDate.push(formatDate);
						
						tabId.push("'.$data["id"].'");
						tabType.push("'.$data["type"].'");
						tabNom.push("'.$data["titre"].'");
						tabDebut.push("'.$data["horaire_debut"].'");
						
						tabComm.push("'.$data["description"].'");
						tabFin.push("'.$data["horaire_fin"].'");';
						if($data["id_lieu"]==0){
						 echo 'tabLieu.push("'.$data["lieu"].'");';
						}
						else{
						 $lieuRes = "";
						 for($j=0;$j<count($tabLieu_numero); $j++){
							if($tabLieu_numero[$j]==$data["id_lieu"]){
								$lieuRes = $tabLieu_nom[$j];
								break;
							}
						 }
						 echo 'tabLieu.push("'.$lieuRes.'");';
						}
			  echo '}';
				}	
		echo '</script>';
			  
			  
			if($admin){ 
					//Récupération des informations sur les types d'évènement
					$req3 = "SELECT nom, numero FROM type_event ORDER BY numero";
					$res3 = mysql_query($req3)  or die('Erreur SQL !<br />'.$req3.'<br />'.mysql_error());
					$disctinctType_numero = array();
					$disctinctType_nom = array();
					$i=0;
					while($data3 = mysql_fetch_array($res3)){
						$disctinctType_numero[$i] = $data3["numero"];
						$disctinctType_nom[$i] = $data3["nom"];
						$i++;
					}
					
					//Récupération des lieux d'entrainement enregistrés dans la bdd
					$reqLieu = "SELECT nom, numero FROM lieu_ultimate";
					$resLieu = mysql_query($reqLieu)  or die('Erreur SQL !<br />'.$reqLieu.'<br />'.mysql_error());
					$disctinctLieu_numero = array();
					$disctinctLieu_nom = array();
					$i=0;
					while($dataLieu = mysql_fetch_array($resLieu)){
						$disctinctLieu_numero[$i] = $dataLieu["numero"];
						$disctinctLieu_nom[$i] = $dataLieu["nom"];
						$i++;
					}
			?>
	<!-- Génération du formulaire pour la modification des évènements (le faire en AJAX pour optimisation)-->		
				<div id="<?php echo $data["id"];?>" style="display:none; width:auto; font-size:12px">
					<form id="formModif<?php echo $data["id"];?>" method="post" action="./modules/calendrier/action.php">
						<input type="hidden" name="idEvent" value="<?php echo $data["id"];?>" />
						<input type="hidden" name="dateEvent" value="<?php echo $data["dateEvent"];?>" />
						<input type="hidden" name="mode" value="modification" />
							<img style="float:right" src="./images/silhouette2.gif" alt="" />
							
							<div class="bouton2 dataForm">
								<span style="font-size:12px; padding:0 8px 0 3px">Nom:</span>
								<input class="inputStyle" type="text" maxlength="35" id="nomEvenement<?php echo $data["id"];?>" name="nomEvent" value="<?php echo $data["titre"];?>" />
							</div>
						
						<div class="bouton2 dataForm">
							<span id="spanListeType<?php echo $data["id"];?>" style="font-size:12px; padding:0 7px 0 3px">Type:</span>
								<div id="divListeEvent<?php echo $data["id"];?>" style="display:inline">
									  <select class="admin" name="typeEvent">
									 <?php
											
										
											for($j=0; $j< count($disctinctType_numero); $j++)
											{ 
												if($disctinctType_numero[$j]==$data["type"]){
													$selected = 'selected = "selected"';
												}
												else{$selected="";}
												
												echo '<option value="'.$disctinctType_numero[$j].'" '.$selected.'>'.$disctinctType_nom[$j].'</option>';
									   
											}
									 ?>
									  </select>
								</div>
						</div> 
						
						<div class="bouton2 dataForm">
							<span id="spanListeLieu<?php echo $data["id"];?>" style="font-size:12px; padding:0 11px 0 3px">Lieu:</span>
								<div id="divListeLieu<?php echo $data["id"];?>" style="display:inline">
								  <select class="admin" id="id_lieuEvent<?php echo $data["id"];?>" name="id_lieuEvent">
									 <option selected="selected" value="init">--Liste des lieux--</b></option>
								 <?php
									
										for($j=0; $j< count($disctinctLieu_numero); $j++){
										
											if($disctinctLieu_numero[$j]==$data["id_lieu"]){
												$selected = 'selected = "selected"';
											}
											else{$selected="";}
										
											
											echo '<option value="'.$disctinctLieu_numero[$j].'" '.$selected.'>'.$disctinctLieu_nom[$j].'</option>';
								  
										}
								?>
								  </select>
								</div>
								<input class="inputStyle" style="margin-left:50px" value="<?php echo $data["lieu"]; ?>" type="text" maxlength="35" id="text_lieuEvent<?php echo $data["id"];?>" name="text_lieuEvent" />
						</div>
						
						<div class="bouton2 dataForm2">
								<span style="font-size:12px;  padding:0 0 0 3px">Durée (jour):</span>
								<div style="display:inline">
								  <select style="font-size:12px" id="duree_event" name="duree_event">
								  <?php 
									for($i=1; $i<=7; $i++){ 
										if($data['duree'] == $i){
											$selected = 'selected = "selected"';
										}
										else{
											$selected="";
										}
									echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
							  	}
								  ?>
								  </select>
								</div>
							</div>
							
						  <div class="bouton2 dataForm2">
							<span style="font-size:12px; padding:0 0 0 3px">Début:</span>
									<div style="display:inline">
									  <select class="admin" id="horaireDebutHeure<?php echo $data["id"];?>" name="debutEventHeure">
									  <?php 
										for($j=0; $j<24; $j++){ 
											$heure=$j;
											if($heure<10){$heure="0".$heure;}
											
												if($heure==substr($data["horaire_debut"],0,2)){
													$selected = 'selected = "selected"';
												}
												else{$selected="";}
											
											echo '<option value="'.$heure.'" '.$selected.'>'.$heure.'</option>';
										}
									  ?>
									  </select>
									  
									</div>
									<div style="display:inline">
									  <select class="admin" id="horaireDebutMinute<?php echo $data["id"];?>" name="debutEventMinute">
									  <?php 
										for($j=0; $j<60; $j=$j+5){ 
											$minute=$j;
											if($minute<10){$minute="0".$minute;}
										
												if($minute==substr($data["horaire_debut"],3)){
													$selected = 'selected = "selected"';
												}
												else{$selected="";}
												
											echo '<option value="'.$minute.'" '.$selected.' >'.$minute.'</option>';
										}
										
										if($data["horaire_debut"]==NULL){$checked = 'checked="checked"';}
									  ?>
									  </select>
									</div>
									<input type="checkbox" <?php echo $checked;?> id="checkHoraire<?php echo $data["id"];?>" name="boolHoraire" value="true" />

							</div>
						
							<div class="bouton2 dataForm2">
							<span style="font-size:12px; padding:0 19px 0 3px">Fin:</span>
									<div style="display:inline">
									  <select class="admin" id="horaireFinHeure<?php echo $data["id"];?>" name="finEventHeure">
									  <?php 
										for($j=0; $j<24; $j++){ 
											$heure=$j;
											if($heure<10){$heure="0".$heure;}
											
												if($heure==substr($data["horaire_fin"],0,2)){
													$selected = 'selected = "selected"';
												}
												else{$selected="";}
											
											echo '<option value="'.$heure.'" '.$selected.'>'.$heure.'</option>';
										}
									  ?>
									  </select>
									</div>
									<div style="display:inline">
									  <select class="admin" id="horaireFinMinute<?php echo $data["id"];?>" name="finEventMinute">
									  <?php 
										for($j=0; $j<60; $j=$j+5){ 
											$minute=$j;
											if($minute<10){$minute="0".$minute;}
										
												if($minute==substr($data["horaire_fin"],3)){
													$selected = 'selected = "selected"';
												}
												else{$selected="";}
												
											echo '<option value="'.$minute.'" '.$selected.'>'.$minute.'</option>';
										}
									  ?>
									  </select>
									</div>
									
							</div>
	
							<div style="width:300px">
								<div class="totalBox">
									<div class="box">
										<div class="titreNews">Commentaire (facultatif)</div>
											<textarea class="admin" name="commentaireEvent" tabindex="4" cols="35" rows="4"><?php echo $data["description"];?></textarea>
									</div>
								</div>
							</div>
						
					</form>
					</div>
					
					<form id="formSuppr" style="display:inline" method="post" action="./modules/calendrier/suppression.php">
						<input id="inputSuppr" type="hidden" name="supprEvent" value="" />
					</form>
			<?php		
			} else{
				?>
				
				<div id="<?php echo $data["id"];?>" style="display:none; width:auto; font-size:12px">
				<img style="float:right" src="./images/silhouette2.gif" alt="" />
				<table class="info">
					<tr>
						<td class="print">Nom:</td>
						<th><span id="nomEvenement"> <?php echo $data["titre"];?> </span></th>
					</tr>
				<?php for($j=0; $j<count($tabType_numero);$j++){
						if($data["type"]==$tabType_numero[$j]){
				 ?> <tr>
						<td class="print">Type:</td> 
						<th><?php echo $tabType_nomEvent[$j];?></th> 
					</tr>	
						<?php
							break;
						}
					}
				
				$finalLieu="";
				if($data["id_lieu"]!=0){
					for($j=0; $j<count($tabLieu_numero);$j++){
							if($data["id_lieu"]==$tabLieu_numero[$j]){
							$finalLieu = $tabLieu_nom[$j];
							break;
							}
					}
				}
				else{
					$finalLieu = $data["lieu"];
				}
				
				if($finalLieu != ""){
				 ?> <tr>
						<td class="print">Lieu:</td>
						<th><?php echo $finalLieu;?></th> 
					</tr>	
						
				<?php
				}
				
				if($data["horaire_debut"] !=NULL){ ?>
					<tr>
						<td class="print">Début:</td>
						<th><?php echo $data["horaire_debut"];?></th>
					</tr>
				<?php } if($data["horaire_fin"] !=NULL){ ?>
					<tr>
						<td class="print">Fin:</td>
						<th><?php echo $data["horaire_fin"];?></th>
					</tr>
				<?php } if($data["description"] !=""){ ?>
					<tr>
						<td class="print">Commentaire:</td>
						<th><?php echo $data["description"];?></th>
					</tr>
				<?php } ?>
				</table>
				</div>
				<?php
			}
	}

	mysql_close();
	?>
	<div style="text-align:center; margin-top:15px;">
		<form id="selection"  style="" method="post" action="./?categorie=calendrier&page=consultation#selection">
			<div class="bouton2" style="display:inline; position:relative; z-index:5; padding:5px">
				<select name="inputMois">
					<?php for($i=1; $i<13; $i++){ 
						if($i==(int)$mois){$isSelected = 'selected="selected"';} else{$isSelected='';}
						if($i<10){$i="0".$i;}
						echo '<option '.$isSelected.'>'.$i.'</option>';
					} ?>
				</select>
				<select name="inputAnnee">
					<?php for($i=2008; $i<date('Y')+2; $i++){ 
						if($i==$annee){$isSelected = 'selected="selected"';} else{$isSelected='';}
						  echo '<option '.$isSelected.'>'.$i.'</option>';
					} ?>
				</select>
			</div>
			
				<input style="padding:1px; margin-left:5px; font-size:10px" type="submit" value="Valider" />
			
		</form>
	</div>	
	<div id="globCalendar">
		<!--Boutons pour le changement de mois -->
		<form id="formMonth" style="display:inline" method="post" action="./?categorie=calendrier&page=consultation#selection">
			<span style="font-size:10px" id="prevDate" class="bouton1">&lt;&lt; Mois précédent</span>
			<input id="inputAnnee" type="hidden" name="inputAnnee" value="<?php echo $annee;?>" />
			<input id="inputMois" type="hidden" name="inputMois" value="<?php echo $mois;?>" />
			<span style="font-size:14px; font-weight:bold; margin:0px 130px" id="textMoisCourant"></span>
			<span style="font-size:10px" id="nextDate" class="bouton1">Mois suivant &gt;&gt;</span>
		</form>
		
		<!-- Zone dans lequel se trouve le calendrier -->
		<div id="datepicker"></div>
	</div>
	
	<?php
		if(count($tabType_numero)>0){ //génération de la légende avec les type d'évènements renvoyés par la requete.
		echo '<div class="totalBox" id="legende" style="height:70px">
			<div class="box" style="float:right;">
			<div class="titreNews">Légende :</div>';
				
				$tmp=0;
				$margin="0px";
					for($i=0; $i<count($tabType_numero); $i++){
						if($i==0 || $tabType_numero[$i] != $tmp){
						  echo  '<div id="lgd'.$tabType_numero[$i].'" style="display:inline; margin-left:'.$margin.';">
									<img src="./images/headerWTransparent.png" style="background-color:'.$tabType_color[$i].'; width:15px; height:12px" />
									<span style="font-size:10px">'.$tabType_nomEvent[$i].'</span>
								</div>';
						}
						$tmp =  $tabType_numero[$i];
						$margin="10px";
					}
				
			echo '</div> 
			</div>';
			?><script type="text/javascript">
					for(i=0; i<tabType_numero.length; i++){
						var isUsed = false;
						
						for(j=0; j<tabType.length; j++){
							if(tabType[j]==tabType_numero[i]){
								isUsed = true;
								break;
							}
						}
						if(!isUsed){
							$('#lgd'+tabType_numero[i]).detach();
						}
					}
				  </script>
			<?php
		}
		?>
	
	<!-- Appel des fichiers JS -->
	<script type="text/javascript" src="./modules/calendrier/calendrier_global.js"></script>
	<script type="text/javascript" src="./modules/calendrier/calendrier_consultation.js"></script>
	<script type="text/javascript">
		var tabEvent = new Array(tabDate, tabType, tabNom, tabId);
		var tabTypeEvent = new Array(tabType_numero, tabType_nom , tabType_color);
		
		var boolAdmin = false;
		
		<?php if(isset($_SESSION['id']) && $_SESSION['lvl']==1){ //Bool admin = true si connexion en mode administrateur
				echo 'boolAdmin = true;' ;
			  }
		?>
		  $("#consultButton").addClass("boutonPageCourante").attr("onclick",""); 
		  MonCalendar(document.getElementById("datepicker"), <?php echo $mois;?>, <?php echo $annee;?>, tabEvent, tabTypeEvent, boolAdmin);
	</script>
	<?php 
		if(count($tabType_numero)>0){ //Génération du récapitulatif
	?>
	
			<!-- Zone dans lequel se trouve le récapitulatif des évènements du mois sélectionné -->
			<div id="globalRecap" style="width:500px; margin:0 auto; margin-top:10px">
				<div id="accordionCal"></div>
				<span style="float:right">
					<span id="pdfCalendar" class="bouton1">Version pdf</span>
					<span id="printCalendar" class="bouton1">Version imprimable</span>
				</span>
				<form id="formPdfCalendar" method="post" action="./modules/calendrier/export_pdf.php">
					<input type="hidden" name="mois_pdf" value="<?php echo $mois;?>"/>
					<input type="hidden" name="annee_pdf" value="<?php echo $annee;?>" />
					<input type="hidden" name="date1" value="<?php echo $date1;?>" />
					<input type="hidden" name="date2" value="<?php echo $date2;?>" />
				</form>
			</div>
			
			<?php 
				include("./modules/calendrier/recapitulatif.php");
		
		} 
?>

<script type="text/javascript">
	if(tabId.length==0){ //S'il n'y a pas d'évènement dans le tableau, on détache la légende et le récapitulatif du DOM.
		$("#globalRecap").detach();
		$("#legende").detach();
	}
</script>

	

	
	
