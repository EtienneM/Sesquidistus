<?php

/* 
  * Module Sondage
  * GÈnËre l'interface, visible par tous les membres, de rÈponse ‡ un sondage.
  * GÈnËre Ègalement les statistiques par rapport ‡ chaque sondage.
  * Auteur : BenoÓt SOUFFLET <benoit.soufflet@gmail.com>
  */


if(isset($_SESSION['id'])){
	$id_current_member = $_SESSION['id'];
	
	if($_SESSION['lvl']==1){
	?>
		  <span id="consultButton" class="bouton1 boutonPageCourante">Visualiser les sondages</span>
		  <span id="ajoutButton" class="bouton1" onclick="javascript:document.location='./?categorie=ajout_sondage'">Ajouter un sondage</span>
	<?php
	}
	
?>
							
				<?php 
				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($bdd);
				mysql_query("SET NAMES 'utf8'"); 	
				
				$hasSondage = false;
				$req = "SELECT * FROM sondage ORDER BY date DESC LIMIT 5";
				$res = mysql_query($req)  or die('Erreur SQL !<br />'.$req.'<br />'.mysql_error());
							
					while($data = mysql_fetch_array($res)){
					
					if(!$hasSondage){
						$hasSondage = true;
						echo '<div id="accordionEvent" style="margin-bottom:40px;"> ';
					}
					
					$id_sondage = $data['id_formulaire'];
					$modeSondage = "ajouter";
					$totPourcent = 0;
					
						$req2 = "SELECT id_membre FROM reponse_sondage WHERE id_sondage = $id_sondage";
						$res2 = mysql_query($req2)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
							while($data2 = mysql_fetch_array($res2)){
									
										if($data2['id_membre'] == $id_current_member){
											$modeSondage = "modifier";
											break;
										}
									
							}
							$doit_rep = "";
							$color = "#e2e2e2";
							if(isset($_SESSION['sondage'])){
								$tmp = $_SESSION['sondage'];
								for($i=0; $i<count($tmp); $i++){
									if($id_sondage == substr($tmp[$i],1)){
										$doit_rep = "(Veuillez r√©pondre √† cette question)";
										$color = "white";
									}
								}
							}
				?>
				<h4 style="color:<?php echo $color;?>" id="<?php echo $id_sondage; ?>" class="header titreSaison">
						<span>Sondage n¬∞<?php echo $id_sondage." ".$doit_rep; ?></span>
				</h4>
					<div class="box2">
						<?php if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
						echo '<form style="display:inline; position:absolute; right:4px; top:-3px" id="formSuppr'.$id_sondage.'" method="post" action="./modules/sondage/action.php">
								<input type="hidden" name="mode" value="supprimer" />
								<input type="hidden" name="id_sondage" value="'.$id_sondage.'" />
								<input  onclick="confirmerSuppr('.$id_sondage.')" type="button" class="bouton3" value="x" title="Supprimer ce sondage" />
							 </form>';
							}
						?>
						<div class="question">	
							<h3><?php echo $data['question']; ?></h3>
							<div style="margin-bottom:30px">
								<?php
									$tabRep = explode("~",$data['reponse_possible']);		
								?>
								
								<form id="form<?php echo $id_sondage;?>" method="post" action="./modules/sondage/action.php">
									<input type="hidden" name="id_membre" value="<?php echo $id_current_member; ?>" /> 
									<input type="hidden" name="id_sondage" value="<?php echo $id_sondage;?>" /> 
									<input type="hidden" name="mode" value="<?php echo $modeSondage; ?>" /> 
								  <?php for($i=0; $i<count($tabRep); $i++){?>
											<input onclick="$('#val<?php echo $id_sondage;?>').removeAttr('disabled')" style="margin-left:20px" type="radio" name="reponse" value="<?php echo $i;?>" />
											<?php echo $tabRep[$i]; ?>
								<?php	}
									?>
									<div style="margin-top:15px">
										<input disabled="disabled" id="val<?php echo $id_sondage;?>" type="submit" class="bouton1" value="valider ma r√©ponse" />
									</div>
								</form>
							</div>
						</div>
					<?php 
						$reqnb = "SELECT count(*) FROM reponse_sondage WHERE id_sondage=$id_sondage";
						$resnb = mysql_query($reqnb) or die (mysql_error());
						$datanb=mysql_fetch_row($resnb);
						$nbRes = $datanb[0];
						
						if($nbRes>0){
									echo '<div id="reponse_membre" style="text-align:left">'.
											'<span style="text-decoration:underline">R√©ponses des membres ayant d√©j√† particip√©s au sondage:</span>'.
						'<div style="overflow:auto; margin-top:10px; max-height:300px">'.
							'<table style="position:relative; z-index:10;" class="table">'.
											'<tr class="header">'.
												'<th>Membre</th>'.
												'<th>R√©ponse</th>'.
												'<th>Date</th>'.
											'</tr>';
											
									$tabPourcent = array();
									$nbrep = 0;
									
									//initialisation du tableau statistique
									for($i=0; $i<count($tabRep); $i++){
										$tabPourcent[$i]=0;
									}
									
										
									$reqRep = "SELECT rs.reponse, rs.date, m.login, m.id
									FROM reponse_sondage rs, membre m WHERE id_sondage=$id_sondage AND rs.id_membre = m.id
									ORDER BY date";
									$resRep = mysql_query($reqRep)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
												while($dataRep = mysql_fetch_array($resRep)){
													echo '<tr class="mouseover">' .
															'<td>' .$dataRep['login']. '</td>' .
															'<td>' .$tabRep[$dataRep['reponse']]. '</td>' .
															'<td>' .$dataRep['date']. '</td>' .
														  '</tr>';
													$tabPourcent[$dataRep['reponse']]++;
													$nbrep++;
												}
							?>
							</table>
						</div>
						<?php 
							if($nbRes>1){
						?>

						<div style="position:relative; z-index:0; text-align:center; margin-top:10px">
							<span class="stat" onclick="afficherStat(<?php echo $id_sondage; ?>);">[statistiques] (<?php echo $nbrep;?> votes)</span>
						</div>
						<?php
						  echo '<div class="statistique" id="statistique'.$id_sondage.'" style="display:none; width:115px; margin:10px auto 0px auto;">';
							for($i=0; $i<count($tabRep); $i++){
							$pourcent=0;
								if($tabPourcent[$i]!=0){
									$pourcent = round(($tabPourcent[$i]/$nbrep)* 100);
								}
								
							$totPourcent += $pourcent;
							
							if($i==(count($tabRep)-1)){
								$pourcent = $pourcent + (100-$totPourcent);
							}
								
								echo '
								<div style="margin:6px 0px;">
									<span style="font-size:10px">' .$tabRep[$i]. '</span>
									<div class="barreCont">
										<div class="barrePourcent" style="width:'.$pourcent.'px;"></div>
										<div style="margin-top:-10px; margin-left:102px; color:#777; font-size:9px">'.$pourcent.'%</div>
									</div>
								</div>';
							}
							echo '</div>';
							}

							echo '</div>';
						}
						
						?>	
						
					</div>
			<?php }
				
				mysql_close();
				
				if(!$hasSondage){
					echo '<div class="totalBox">
						 <div class="box">
						 <div class="titreNews">Aucun √©l√©ment:</div>
							<span>Il n\'y a pour le moment aucun sondage dans la base de donn√©es</span>
						</div>
					</div>';
				}
			?>		
							
	</div>

	<script type="text/javascript">
		var anchor = window.location.hash; 
		var selectedElement;
		if(anchor.length != 0){
			anchor = anchor.substring(1,anchor.length);
			selectedElement = $("#"+anchor);
		}
		else{
			selectedElement = 0;
		}
		$("#accordionEvent").accordion({ autoHeight: false, active:selectedElement});
		
		function afficherStat(id){
			if($("#statistique"+id).css("display")=="none"){
				$("#statistique"+id).css("display","block");
			}
			else{
				$("#statistique"+id).css("display","none");
			}
		}
		
		function confirmerSuppr(id){
			var divVal = document.createElement("div");
			
				$(divVal).html("Voulez-vous vraiment supprimer le sondage n¬∞"+id +" ?");
				$(divVal).dialog({
					width: 350,
					title: "Confirmer la suppression du sondage:",
					modal: true,
					draggable: false,
					buttons: {
						"Annuler": function() { 
							$(this).dialog("close");
						},
						"Confirmer": function() { 
							$("#formSuppr"+id).submit();
						}
					}
				});
			
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