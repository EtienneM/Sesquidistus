<?php

 /* 
  * Page d'accueil du site
  * Gestion des prochains entrainements et tournois ainsi qu'affichage des derniers articles.
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */
  

	include("./config/mysql.php");
	mysql_connect($host, $user, $passwd); 
	mysql_select_db($bdd);
	mysql_query("SET NAMES 'utf8'");	

	$hasEntrainement = false;
	$hasTournoi = false;
	$hasOwnTournoi = false;
	$hasVideo = false;
	$idOwnTournoi = -1;
			
			$reqVideo = "SELECT id, titre, image, code FROM videos ORDER BY id_video DESC LIMIT 1";
  			$resVideo = mysql_query($reqVideo) or die (mysql_error());
			
			$reqTournoi = "SELECT DATE_FORMAT(e.date, '%d/%m/%Y') AS dateEvent, e.duree, e.lieu, e.id_lieu, e.id, e.titre FROM evenement e, inscription_tournoi t WHERE e.type=5 AND e.id = t.id_event AND e.date >= SUBDATE(CURDATE(),5) ORDER BY e.date LIMIT 1";
  			$resTournoi = mysql_query($reqTournoi) or die (mysql_error());
			
			$reqNewsEvent = "SELECT id, titre, lieu, id_lieu, DATE_FORMAT(date, '%d/%m/%Y') AS dateEvent, horaire_debut, horaire_fin, description FROM evenement WHERE type = (1) AND date >= CURDATE() ORDER BY date LIMIT 1";
  			$resNewsEvent = mysql_query($reqNewsEvent) or die (mysql_error());
			
			$reqNewsEvent2 = "SELECT id, duree, titre, lieu, id_lieu, DATE_FORMAT(date, '%d/%m/%Y') AS dateEvent, horaire_debut, horaire_fin, description FROM evenement WHERE type in (4,5) AND date >= CURDATE() ORDER BY date LIMIT 1";
  			$resNewsEvent2 = mysql_query($reqNewsEvent2) or die (mysql_error());
			
			$req = "SELECT a.contenu, a.id, a.titre, a.id_member, DATE_FORMAT(a.date_article, '%d/%m/%Y') AS dateEvent FROM evenement e, article a WHERE e.id = a.id_event ORDER BY date_article DESC LIMIT 5";
  			$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		
	
?>
<div id="globalMini">
		<div id="inscription" class="totalBox">
		<div class="box">
			<div class="titreNews">Inscription tournoi</div>
				<p style="text-align:left;"> 
			  <?php while($dataTournoi = mysql_fetch_array($resTournoi)){
						if(!$hasOwnTournoi){$hasOwnTournoi=true;}
						
						$idOwnTournoi = $dataTournoi['id'];
						$num_lieu = $dataTournoi["id_lieu"];
							if($num_lieu != 0){
								$reqlieu = "SELECT nom, numero FROM lieu_ultimate WHERE numero = $num_lieu";
								$reslieu = mysql_query($reqlieu) or die (mysql_error());
								$datalieu=mysql_fetch_row($reslieu);
								$nom_lieu = $datalieu[0]."<a title='Google maps' href='./?categorie=club&id=6#map".$datalieu[1]."'><img style='margin-left:3px' src='./images/loupe.png' /></a>";
							}
							else{
								$nom_lieu = $dataTournoi["lieu"];
							}
						
						echo '<div style="color:#bc0101; margin-bottom:10px; font-size:11px">'.$dataTournoi['titre'] . '</div>
						<table style="font-size:11px; margin-bottom:30px">
						<tr>
							<td style="color:#555">Date:</td> <td><span id="dateOwnTournoi">' . $dataTournoi['dateEvent'] . '</span></td> 
						</tr>
						<tr>
							<td style="color:#555">Lieu: </td> <td>' . $nom_lieu . '</td>'; 
			
						echo '</table></p>';
					
					echo '<div style="text-align:center">
							<a href="./?categorie=inscription_tournoi&id_event='.$dataTournoi['id'].'">
								<span class="bouton1 boutonPageCourante" style="cursor:pointer; font-size:10px; margin-left:0px">Inscrivez votre équipe !</span>
							</a>
						 </div>';
					if($dataTournoi['duree']>1){
						echo '<script type="text/javascript">';	
								$newDate = explode("/",$dataTournoi['dateEvent']);
							  
							  echo 'var newDate = new Date('.$newDate[2].','.((int)($newDate[1])-1).', '.((int)($newDate[0])).');
								newDate.setDate(newDate.getDate()+'.((int)$dataTournoi['duree']-1).');
							  
							  var day =  newDate.getDate();
							  var month =  parseInt(newDate.getMonth()+1);
							  var year =  newDate.getFullYear();

							  if(day<10){day = "0" + day;}
							  if(month<10){month = "0" + month;}
							  var formatDate = day + "/" + month + "/" + year;
							  $(\'#dateOwnTournoi\').html("Du " + $(\'#dateOwnTournoi\').html()+" au <br/>"+formatDate);
							  ';
						echo '</script>';
					}
				}
				if(!$hasOwnTournoi){
						echo 'Aucun formulaire d\'inscription';
						echo '<script type="text/javascript">
									$("#inscription").css("display","none");
							  </script>';
				}
				?> 
				
		</div>
	</div>
	<div id="nextTraining" class="totalBox">
		<div class="box" style="min-height:150px;">
		<img style="position:absolute; right:2px; bottom:1px" src="./images/silhouette3_mini.gif" />
			<div class="titreNews">Prochain entraînement</div>
				<p style="text-align:left;"> 
			  <?php while($dataNewsEvent = mysql_fetch_array($resNewsEvent)){
						if(!$hasEntrainement){$hasEntrainement=true;}
						
						$num_lieu = $dataNewsEvent["id_lieu"];
							if($num_lieu != 0){
								$reqlieu = "SELECT nom, numero FROM lieu_ultimate WHERE numero = $num_lieu";
								$reslieu = mysql_query($reqlieu) or die (mysql_error());
								$datalieu=mysql_fetch_row($reslieu);
								$nom_lieu = $datalieu[0]."<a title='Google maps' href='./?categorie=club&id=5#map".$datalieu[1]."'><img style='margin-left:3px' src='./images/loupe.png' /></a>";
							}
							else{
								$nom_lieu = $dataNewsEvent["lieu"];
							}
						
						echo '<div style="color:#bc0101; margin-bottom:10px; font-size:11px">'.$dataNewsEvent['titre'] . '</div>
						<table style="font-size:11px">
						<tr>
							<td style="color:#555">Date:</td> <td>' . $dataNewsEvent['dateEvent'] . '</td> 
						</tr>
						<tr>
							<td style="color:#555">Lieu: </td> <td>' . $nom_lieu . '</td>'; 
						if($dataNewsEvent['horaire_debut']){ 
						echo '<tr>
								<td style="color:#555">Debut: </td><td>' . $dataNewsEvent['horaire_debut'] . '</td>
							  </tr>';
						}
						if($dataNewsEvent['horaire_fin']){ 
							echo '<tr>
									<td style="color:#555">Fin: </td><td>' . $dataNewsEvent['horaire_fin'] . '</td>
								  </tr>';
						}
						echo "</table>";
					
				}
				if(!$hasEntrainement){
						echo "Aucun entrainement à venir";
						echo '<script type="text/javascript">
									$("#nextTraining").css("display","none");
							  </script>';
				}
				?> 
				</p>
		</div>
	</div>
	<div id="nextTournoi" class="totalBox">	
		<div class="box" style="min-height:150px;">
		<img style="position:absolute; right:2px; bottom:1px" src="./images/silhouette4.gif" />
			<div class="titreNews">Prochain tournoi</div>
				<p style="text-align:left;"> 
			  <?php while($dataNewsEvent2 = mysql_fetch_array($resNewsEvent2)){
						if(!$hasTournoi){$hasTournoi=true;}
						$num_lieu2 = $dataNewsEvent2["id_lieu"];
						$id_tournoi = $dataNewsEvent2['id'];
						if($num_lieu2 != 0){
						$reqlieu2 = "SELECT nom, numero FROM lieu_ultimate WHERE numero = $num_lieu2";
						$reslieu2 = mysql_query($reqlieu2) or die (mysql_error());
						$datalieu2=mysql_fetch_row($reslieu2);
						$nom_lieu2 = $datalieu2[0]."<a title='Google maps' href='./?categorie=club&id=5#map".$datalieu2[1]."'><img style='margin-left:3px' src='./images/loupe.png' /></a>";
						}
						else{
								$nom_lieu2 = $dataNewsEvent2["lieu"];
						}
						echo '<div style="color:#bc0101; margin-bottom:10px; font-size:11px;">'.$dataNewsEvent2['titre'] . '</div>
						<table style="font-size:11px">
						<tr>
							<td style="color:#555">Date:</td> <td><span id="dateNextTournoi">' . $dataNewsEvent2['dateEvent'] . '</span></td> 
						</tr>
						<tr>
							<td style="color:#555">Lieu: </td> <td>' . $nom_lieu2 . '</td>'; 
						/*if($dataNewsEvent2['horaire_debut']){ 
						echo '<tr>
								<td style="color:#555">Debut: </td><td>' . $dataNewsEvent2['horaire_debut'] . '</td>
							  </tr>';
						}
						if($dataNewsEvent2['horaire_fin']){ 
							echo '<tr>
									<td style="color:#555">Fin: </td><td>' . $dataNewsEvent2['horaire_fin'] . '</td>
								  </tr>';
						}*/
						echo "</table>";
						
						if($dataNewsEvent2['duree']>1){
							echo '<script type="text/javascript">';	
									$newDate = explode("/",$dataNewsEvent2['dateEvent']);
								  
								  echo 'var newDate = new Date('.$newDate[2].','.((int)($newDate[1])-1).', '.((int)($newDate[0])).');
									newDate.setDate(newDate.getDate()+'.((int)$dataNewsEvent2['duree']-1).');
								  
								  var day =  newDate.getDate();
								  var month =  parseInt(newDate.getMonth()+1);
								  var year =  newDate.getFullYear();

								  if(day<10){day = "0" + day;}
								  if(month<10){month = "0" + month;}
								  var formatDate = day + "/" + month + "/" + year;
								  $(\'#dateNextTournoi\').html("Du " + $(\'#dateNextTournoi\').html()+" au <br/>"+formatDate);
								  ';
							echo '</script>';
						}
					}
					if(!$hasTournoi || $idOwnTournoi==$id_tournoi ){
						echo "Aucun tournoi à venir";
						echo '<script type="text/javascript">
									$("#nextTournoi").css("display","none");
							  </script>';
					}
				?> 
				</p>
		</div>
	</div>
	<div id="newVideo" class="totalBox">
		<div class="box">
				<div class="titreNews">Vidéo du moment</div>
				<?php while($dataVideo = mysql_fetch_array($resVideo)){
					if(!$hasVideo){$hasVideo=true;}
					echo '<a href="./?categorie=video&video='.$dataVideo['id'].'">
						    <div style="position:relative;" >
							<img style="width:170px;" src="'.$dataVideo['image'].'" alt="'.$dataVideo['titre'].'" title="'.$dataVideo['titre'].'" />
						    </div>
						    <div style="position:absolute; margin-top:-92px; margin-left:60px">	
							<img style="width:50px;" src="./images/play.png" alt="'.$dataVideo['titre'].'" title="'.$dataVideo['titre'].'" />
						    </div>
						</a>';
				}
				if(!$hasVideo){
						echo "Aucune vidéo";
						echo '<script type="text/javascript">
									$("#newVideo").css("display","none");
							  </script>';
				}
				?>
		</div>
	</div>
</div>




<div id="globalNews">

<?php

			while($data = mysql_fetch_array($res))
  			{
						$reqMembre = "SELECT login FROM membre WHERE id = ".$data['id_member'];
						$resMembre = mysql_query($reqMembre)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$row = mysql_fetch_row($resMembre);
						$membre = $row[0];
						
					echo  '<div class="totalBox">'.
						'<div class="box">'.
							'<div class="titreNews">'.$data['titre'].'</div>' .
							
							'<div>';
							if($data['contenu']!=""){
								echo $data['contenu'];
							}

					if(!empty($membre)){
						 $creePar = ' par '.$membre; 
					}
					else{
						$creePar='';
					}
					
					echo	'</div>' .

								'<div style="margin-top:30px">' .
									'<span class="note">Article créé' .$creePar.' le ' .$data['dateEvent']. '</span>'.
									// '<span class="social">'.
										// '<script src="http://connect.facebook.net/fr_FR/all.js#xfbml=1"></script>'.
										// '<fb:like href="http://www.frisbee-strasbourg.net/?categorie=article&page=lecture&id='.$data['id'].'" layout="button_count" show_faces="false" font=""></fb:like>'.
									// '</span>'.
									
								'</div>' .
						'</div>
				 </div>';
					
					
				
			}
			
		mysql_close();
		
?>
</div>	

<script type="text/javascript">
	var sizeMini = $("#globalMini").height();
	var sizeNews = $("#globalNews").height();
	var diffSize = sizeMini - sizeNews;
	
	if(diffSize > 0){
		$("#globalNews").css("marginBottom",diffSize +"px");
	}
</script>