<?php
if($_SESSION['lvl']==1){
	 
	 echo ' <span id="consultButton" class="bouton1 boutonPageCourante">Visualiser les inscriptions aux tournois</span>';
				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($db);
				mysql_query("SET NAMES 'utf8'"); 	
									
				$req = "SELECT * FROM reponse_inscription_tournoi ORDER BY date DESC LIMIT 5";
				$res = mysql_query($req)  or die('Erreur SQL !<br />'.$req.'<br />'.mysql_error());
				$hasFiche = false;
				
					while($data = mysql_fetch_array($res)){
					$alire = false;
					$info="";
					$color = "#e2e2e2";
					
					if(!$hasFiche){
						$hasFiche = true;
						echo '<div id="accordionInscription" style="margin-bottom:40px;"> ';
					}
					
					if($data['lu']==0){
						$alire=true;
						$info =" (à lire)";
						$color = "white";
					}
					
					$id_form = $data['id_formulaire'];
					$id_reponse = $data['id_reponse'];
					$tabQuestion = array();
					$tabReponse = array();
					
					$reqQ = "SELECT id_event FROM inscription_tournoi WHERE id_formulaire = $id_form";
					$resQ = mysql_query($reqQ)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$row = mysql_fetch_row($resQ);
					$id_event = $row[0];
					
					$tabQuestion = explode("~",$data['questions']);
					$tabReponse = explode("~",$data['reponses']);
					
					$reqT = "SELECT titre FROM evenement WHERE id=$id_event";
					$resT = mysql_query($reqT)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$rowT = mysql_fetch_row($resT);
					
					
				?>
				
				<h4 style="color:<?php echo $color;?>" id="<?php echo $id_reponse; ?>" class="header titreSaison">
						<span>Fiche d'inscription pour :<?php echo $rowT[0].$info; ?></span>
				</h4>
					<div class="box2">
						<div class="question" style="text-align:left">	
							<?php for($i=0; $i<count($tabQuestion); $i++){
							echo '<div class="totalBox" style="margin-top:15px"> 
								<div class="box">
									<div class="titreNews">
										
										<span id="q'.$i.'">'.$tabQuestion[$i].'</span>
									</div>
									<div style="margin:1px 3px; padding:10px; border-style:solid; border-color:#DDD; border-width:1px">
									<div class="reponseValue">'.$tabReponse[$i].'</div>
								  </div>
								</div>
							</div>';
							
								}
							?>
						</div>
						<?php if ($alire){ ?>
							 <form style="display:inline; position:absolute; right:4px; top:-3px" id="formLu<?php echo $id_reponse; ?>" method="post" action="./modules/inscription_tournoi/lu.php">
								<input type="hidden" name="id_reponse" value="<?php echo $id_reponse; ?>" />
								<input  class="bouton3" type="submit" value="J'ai lu" />
							 </form>
						<?php } ?>
					</div>	
			<?php }
				
				mysql_close();
				
				if(!$hasFiche){
					echo '<div class="totalBox" style="margin-top:20px">
						 <div class="box">
						 <div class="titreNews">Aucun élément:</div>
							<span>Il n\'y a pour le moment aucune fiche d\'inscription remplie par une autre équipe</span>
						</div>
					</div>';
				}
			?>		
							
	</div>

	<script type="text/javascript">
		$("#accordionInscription").accordion({ autoHeight: false, collapsible: true, active:false});
	</script>
<?php 
}
else{
?>
	<div class="totalBox" style="margin-top:20px">
		 <div class="box">
		 <div class="titreNews">Erreur :</div>
			<span>Cette page est uniquement accessible aux administateurs du site...</span>
		</div>
	</div>
<?php
}
?>
