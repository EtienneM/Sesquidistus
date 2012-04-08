<div style="margin-bottom:25px">
		<span id="organiserButton" class="bouton1" onclick="javascript:document.location='./?categorie=event&amp;page=organiser'">Evènements organisés par le club</span>
		<span id="participerButton" class="bouton1" onclick="javascript:document.location='./?categorie=event&amp;page=participer'">Evènements auxquels le club participe</span>
</div>

<?php

/* 
  * Module Event
  * G�n�re les tableaux des �v�nements des tournois du club avec un affichage en accord�on.
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */


$getPage = false;
$tabSousCatName = array("organiser","participer");
$admin=false;

if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
	$admin=true;
}

	//Si la variable GET page est vide on charge la page de organiser.
	if(!isset($_GET['page'])){
		$_GET['page']= $tabSousCatName[0];
	}
	
		//Verification que la variable GET page est dans le tableau $tabSousCatName.
		for($i=0; $i<count($tabSousCatName) && !$getPage; $i++){
		  if($tabSousCatName[$i] == $_GET['page']){
			$getPage = true;
		  }
		 }
		 
		 //Si la variable GET page n'est pas dans le tableau $tabSousCatName, on charge la page de consultation.
		 if(!$getPage){$_GET['page']=$tabSousCatName[0];}
		 
		 $pageSousCat = $_GET['page'];
		
		 if($pageSousCat == $tabSousCatName[0]){
			$type=5;
		}
		 else if($pageSousCat == $tabSousCatName[1]){
			$type=4;
		}
		
		$currentButton = "'" . "#" . $pageSousCat. "Button" . "'";
	?>

	<div id="accordionEvent" style="margin-bottom:40px"> 
							
				<?php 
				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($db); 
				mysql_query("SET NAMES 'utf8'");	
									
				$reqSaison = "SELECT DISTINCT MONTH(date) as month, YEAR(date) AS dateSaison1, YEAR(ADDDATE(date, INTERVAL 1 YEAR)) AS dateSaison2  FROM evenement WHERE type = $type ORDER BY date DESC";
				$resSaison = mysql_query($reqSaison)  or die('Erreur SQL !<br />'.$reqSaison.'<br />'.mysql_error());
				
		


				
									$nbArticle = 0; //compte le nb d'article
									$nbEvent = 0; //compte le nb d'evenement
									$tmpN = 0;
									$oldY1;
									$oldY2;
									
					while($dataSaison = mysql_fetch_array($resSaison)){
						
						 
					
						if((int)$dataSaison['month']>=9){
								$anSaison1 =$dataSaison['dateSaison1'];
								$anSaison2 =$dataSaison['dateSaison2'];
								$saison1=$dataSaison['dateSaison1'] . '-09-01';
								$saison2=$dataSaison['dateSaison2'] . '-08-31';
								$hasTitre = false;
						}
						else{
								$anSaison1 =((int)$dataSaison['dateSaison1']-1);
								$anSaison2 =$dataSaison['dateSaison1'];
							    $saison1=((int)$dataSaison['dateSaison1']-1) . '-09-01';
								$saison2=$dataSaison['dateSaison1'] . '-08-31';
								$hasTitre = false;
						}
					
					if($anSaison1==$oldY1 && $anSaison2==$oldY2)
					{
						//on ne fait rien
					}
					else{	
						$titreSaison = "&Eacute;v&egrave;nements de la saison " . $anSaison1 . "-" .$anSaison2;
						
									$req = "SELECT id, titre, lieu, id_lieu, contenu_video, contenu_photo, 
									DATE_FORMAT(date, '%d/%m/%Y') AS dateEvent FROM evenement 
									WHERE date BETWEEN '$saison1' AND '$saison2' AND type = $type
									ORDER BY date DESC";
									$res = mysql_query($req)  or die('Erreur SQL !<br />'.$req.'<br />'.mysql_error());
									
					
									while($data = mysql_fetch_array($res)){
										if(!$hasTitre){ ?>
										<h4 class="header titreSaison"><?php echo $titreSaison; ?></h4>
										<div class="box2">
											<table class="table">
												<tr class="header">
													<th>Titre</th>
													<th>Lieu</th>
													<th>Date</th>
													<th>Contenu</th>
												</tr>	
									<?php 
										$hasTitre = true;
										}
										$nbArticle = 0;
										$hasQuestion = false;
										$tabIdArticle = array();
										$tabTitreArticle = array();
										$idEvent = $data['id'];
										$reqArt = "SELECT titre, id, contenu from article
										WHERE id_event = $idEvent";
										$resArt = mysql_query($reqArt)  or die('Erreur SQL !<br />'.$reqArt.'<br />'.mysql_error());
								
										$reqQ = "SELECT questions FROM inscription_tournoi WHERE id_event = $idEvent LIMIT 1";
										$resQ = mysql_query($reqQ)  or die('Erreur SQL !<br />'.$reqQ.'<br />'.mysql_error());
									while($dataQ = mysql_fetch_array($resQ)){
										$hasQuestion = true;
									}
									
									$num_lieu = $data["id_lieu"];
									if($num_lieu != 0){
										$reqlieu = "SELECT nom FROM lieu_ultimate WHERE numero = $num_lieu";
										$reslieu = mysql_query($reqlieu) or die (mysql_error());
										$datalieu=mysql_fetch_row($reslieu);
										$nom_lieu = $datalieu[0];
									}
									else{
										$nom_lieu = $data["lieu"];
									}
									echo '<tr class="mouseover">';
										echo '<td>' . $data['titre'] . '</td>';
										echo '<td>' . $nom_lieu . '</td>';
										echo '<td>' . $data['dateEvent'] . '</td>';
										echo '<td>';
										
										echo '<form id="creer' . $data['id'] . '"  style="display:inline" method="POST" action="./?categorie=article">
													<input type="hidden" name="id_event" value="' . $data['id'] . '" />
													<input type="hidden" name="mode" value="creer" />
											  </form>';
											  
											while($dataArt = mysql_fetch_array($resArt)){
												if($dataArt['contenu']!=""){
													array_push($tabIdArticle, $dataArt['id']);
													array_push($tabTitreArticle, $dataArt['titre']);
													$nbArticle++;
												}
											}
											if($nbArticle>0){
													echo '<span style="margin-right:5px;"><img style="cursor:pointer" id="ico'.$data['id'].'" src="./images/page.png" alt="Articles" title="Accéder aux articles liés à cet évènement" /></span>';
												
												
												echo '<select style="display:none" id="select'.$data['id'].'">';
												for($i=0; $i<count($tabIdArticle); $i++){
													echo '<option value="'.$tabIdArticle[$i].'">'.$tabTitreArticle[$i].'</option>';
												}
												echo '</select>';
														?>
														<script type="text/javascript">
															$('#ico'+<?php echo $data['id'];?>).click( function(){	
													  <?php if($nbArticle>1 || $admin){ ?>
																		var textIdForm = "creer<?php echo $data['id']; ?>"
																		var idForm = document.getElementById(textIdForm);
																		var divChoixPage = document.createElement("div");
																		var selectListe = document.getElementById("select<?php echo $data['id']; ?>");
																		var valeurId = selectListe.options[0].value;
																		
																		selectListe.onchange = function(){
																			valeurId = this.options[this.selectedIndex].value;
																			//alert(valeurId);
																		};
																			
																		
																		$(divChoixPage).html('<p style="font-style:italic">Veuillez sélectionnez un article: </p>');
																		$(divChoixPage).append($("#select<?php echo $data['id']; ?>").css("display","block"));
																		$(divChoixPage).dialog({
																			width: 400,
																			title: "S�lection de l'article",
																			modal: true,
																			draggable: false,
																			closeText: 'x'
																		});
														<?php if($admin){ ?>
																				$(divChoixPage).dialog( "option", "buttons", { 
																					
																								"Consulter l'article": function() { 
																									window.location.href='./?categorie=article&page=lecture&id='+valeurId;
																									$(this).dialog("close");
																								},
																								"Cr�er un nouvel article": function() { 
																									idForm.submit();
																									$(this).dialog("close");
																								}	 
																				});
															<?php 
															} 
															else if($nbArticle>1){ ?>
																$(divChoixPage).dialog( "option", "buttons", { 
																					
																								"Consulter l'article": function() { 
																									window.location.href='./?categorie=article&page=lecture&id='+valeurId;
																									$(this).dialog("close");
																								}
																							 
																});
														<?php }
															}
															else if(!$admin){ 
															?>
																window.location.href='./?categorie=article&page=lecture&id=<?php echo $tabIdArticle[0]; ?>';
															
													  <?php }	
															?>
															});		
														</script>
											<?php
												
											
											}
											if($nbArticle==0 && $admin){
												echo '<span style="margin-right:5px;">
															
															<img style="cursor:pointer" id="icoCreer'.$data['id'].'" src="./images/page2.png" alt="Article" title="Creer un article pour cet évènement" />
															
														</span>';
												?>
														<script type="text/javascript">
														$('#icoCreer'+<?php echo $data['id'];?>).click( function(){
															var textIdForm = "creer<?php echo $data['id']; ?>"
															var idForm = document.getElementById(textIdForm);
															idForm.submit();
														});
														</script>
												<?php		
											}
											
											echo '<form id="formPhoto' . $data['id'] . '"  style="display:none" method="POST" action="./modules/event/action_media.php">
													<input type="hidden" name="id" value="' . $data['id'] . '" />
													<input size=40 type="text" name="lien_photo" value="'.$data['contenu_photo'].'" />
													<input type="hidden" name="mode" value="doc_image" />
												</form>';
												
											if($data['contenu_photo']!="" || $admin){
												echo '<span style="margin-right:5px;">
														<img style="cursor:pointer" id="icoPhoto'.$data['id'].'" src="./images/image.png" alt="Images" title="Images de l\'évènement" />
													  </span>';
												?>
														<script type="text/javascript">
															$('#icoPhoto'+<?php echo $data['id'];?>).click( function(){	
																<?php if ($admin){ ?>
																		
																		var divDocImage = document.createElement("div");
																		
																		$(divDocImage).html('<p style="font-style:italic">Veuillez entrer le lien du dossier image: </p>');
																		$(divDocImage).append($("#formPhoto<?php echo $data['id']; ?>").css("display","block"));
																		
																		$(divDocImage).dialog({
																			width: 400,
																			title: 'Gestion des photos',
																			modal: true,
																			draggable: false,
																			closeText: 'x'
																		});
																		
																		<?php if($data['contenu_photo']!=""){ ?>
																					$(divDocImage).dialog( "option", "buttons", { 
																							"Accéder au dossier": function() { 
																								window.location.href='<?php echo $data['contenu_photo']; ?>';
																								$(this).dialog("close");
																							},
																							"Valider": function() { 
																								$("#formPhoto<?php echo $data['id']; ?>").submit();
																								$(this).dialog("close");
																							}	 
																					});
																		<?php }
																			else{ ?>
																				$(divDocImage).dialog( "option", "buttons", { 
																					
																							"Valider": function() { 
																								$("#formPhoto<?php echo $data['id']; ?>").submit();
																								$(this).dialog("close");
																							}	 
																				});
																		<?php } ?>	
															<?php } 
															else { ?>	
																	window.location.href='<?php echo $data['contenu_photo']; ?>'; 
															<?php } ?>				
															
															});		
														</script>
													<?php
											}
											
											
											echo '<form id="formVideo' . $data['id'] . '"  style="display:none" method="POST" action="./modules/event/action_media.php">
													<input type="hidden" name="id" value="' . $data['id'] . '" />
													<input size=40 type="text" name="lien_video" value="'.$data['contenu_video'].'" />
													<input type="hidden" name="mode" value="doc_video" />
												</form>';
												
											if($data['contenu_video']!="" || $admin){
												echo '<span style="margin-right:5px;">
															<img style="cursor:pointer" id="icoVideo'.$data['id'].'" src="./images/film.png" alt="Video" title="Vidéos de l\'évènement" />
													  </span>';
											?>
														<script type="text/javascript">
															$('#icoVideo'+<?php echo $data['id'];?>).click( function(){	
															<?php if ($admin){ ?>
																		var divDocVideo = document.createElement("div");
																		
																		$(divDocVideo).html('<p style="font-style:italic">Veuillez entrer le lien du dossier vidéo: </p>');
																		$(divDocVideo).append($("#formVideo<?php echo $data['id']; ?>").css("display","block"));
																		
																		$(divDocVideo).dialog({
																			width: 400,
																			title: 'Gestion des vidéos',
																			modal: true,
																			draggable: false,
																			closeText: 'x'
																		});
																		
																		<?php if($data['contenu_video']!=""){ ?>
																					$(divDocVideo).dialog( "option", "buttons", { 
																							"Accéder au dossier": function() { 
																								window.location.href='<?php echo $data['contenu_video']; ?>';
																								$(this).dialog("close");
																							},
																							"Valider": function() { 
																								$("#formVideo<?php echo $data['id']; ?>").submit();
																								$(this).dialog("close");
																							}	 
																					});
																		<?php }
																			else{ ?>
																				$(divDocVideo).dialog( "option", "buttons", { 
																					
																							"Valider": function() { 
																								$("#formVideo<?php echo $data['id']; ?>").submit();
																								$(this).dialog("close");
																							}	 
																				});
																		<?php } ?>
															<?php } 
															else { ?>
																window.location.href='<?php echo $data['contenu_video']; ?>'; 
														<?php } ?>				
															});		
														</script>
													<?php
													}
												
												
												$reqImage = "SELECT questions FROM inscription_tournoi WHERE id_event = $idEvent LIMIT 1";
												$resImage = mysql_query($reqImage)  or die('Erreur SQL !<br />'.$reqImage.'<br />'.mysql_error());


												$imageInter = "./images/inscription2.png";
												$titleInter = "Créer un formulaire d'inscription";
												while($dataImage = mysql_fetch_array($resImage)){
													$imageInter = "./images/inscription.png";
													$titleInter = "Modifier le formulaire d'inscription";
												}
												
												if ($admin && $type==5){	
												echo '<span style="margin-right:5px;">
															<img style="cursor:pointer" id="icoInscription_Tournoi'.$data['id'].'" src="'.$imageInter.'" alt="Tournoi" title="'.$titleInter.'" />
													  </span>';
												echo '<form id="ajout_Inscription'.$data['id'].'" method="post" action="./?categorie=ajout_form_inscription">
														<input type="hidden" name="id_event" value="'.$data['id'].'" />
													  </form>';	
												?>	  
													  <script type="text/javascript">
														$('#icoInscription_Tournoi'+<?php echo $data['id'];?>).click( function(){
															$('#ajout_Inscription'+<?php echo $data['id'];?>).submit();
														});
													  </script>
												<?php
												}
												else if($hasQuestion && $type==5){
												echo '<span style="margin-right:5px;">
															<a href="./?categorie=inscription_tournoi&id_event='.$data['id'].'">
																<img style="cursor:pointer" src="./images/inscription.png" alt="Tournoi" title="Remplir un formulaire d\'inscription" />
															</a>
													  </span>';
												
													
												}
											
										
										 echo '</td>';
									echo '</tr>';
									$nbEvent++;
									}
									
						if($hasTitre){
							echo '</table></div>';
						}
					}
					$oldY1 = $anSaison1; 
					$oldY2 = $anSaison2;
				}
				mysql_close();
			?>		
							
	</div>

	<script type="text/javascript">
		$("#accordionEvent").accordion({ autoHeight: false});
		$(<?php echo $currentButton; ?>).addClass("boutonPageCourante").attr("onclick",""); 
	</script>
