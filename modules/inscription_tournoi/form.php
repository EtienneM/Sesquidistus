<?php
$id_event = $_GET['id_event'];


				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($db);
				mysql_query("SET NAMES 'utf8'"); 

$req2 = "SELECT e.id FROM evenement e, inscription_tournoi t WHERE e.type=5 AND e.id = t.id_event ";
$res2 = mysql_query($req2)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	

$id_ok = false;
$hasEvent = false;
	
while($data2 = mysql_fetch_array($res2)){
	if(!$hasEvent){$hasEvent = true;}
	if($data2['id']==$id_event){
		$id_ok = true;
		break;
	}
}		
	
	if(!$id_ok){
		echo '<script type="text/javascript">window.location.href = "./?categorie=event"</script>';
	}
if($hasEvent){

	$req = "SELECT titre FROM evenement WHERE id=$id_event";
	$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$row = mysql_fetch_row($res);
					
	$req = "SELECT id_formulaire, questions FROM inscription_tournoi WHERE id_event = $id_event LIMIT 1";
	$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());



	while($data = mysql_fetch_array($res)){
		$id_form = $data['id_formulaire'];
		$tabQuestion = explode("~",$data['questions']);
		$tabInitQuestion = $data['questions'];
	}

	?>
		<span id="consultButton" class="bouton1 boutonPageCourante">Formulaire d'inscription: <?php echo $row[0]; ?></span>
			<div style="margin-top:20px"> 
				<form id="formInscription" method="post" action="./modules/inscription_tournoi/action_validation.php">
					<input id="reponseFinale" type="hidden" name="reponseFinale" />
					<input id="questionFinale" type="hidden" name="questions"  value="<?php echo $tabInitQuestion; ?>" />
					<input type="hidden" name="id_form" value="<?php echo $id_form; ?>" />
					
					<div id="questions_rep" style="margin-bottom:20px">
						<?php for($i=0; $i<count($tabQuestion); $i++){
							echo ' <div class="totalBox">
								<div class="box">
									<div class="titreNews">
										
										<span id="q'.$i.'">'.$tabQuestion[$i].'</span>
									</div>
									<div style="text-align:center">
										<textarea class="reponseValue" style="width:600px; height:50px; margin:0 auto;" name="r'.$i.'"></textarea>
									  </div>
								</div>
							</div>';			  
							}
						?>
					</div>
					
					<div style="text-align:right">
						<span id="validerForm" class="bouton1">Valider ce formulaire</span>
					</div>
				</form>
			</div>
		
		 <script type="text/javascript">
		 var nbQuestion = <?php echo count($tabQuestion) + 1 ; ?>; 
			$('#validerForm').click( function(){
				var finalRep ="";
				$('textarea.reponseValue').each( function(){
					
						finalRep += $(this).val() + "~";
					
				});
			
				finalRep = finalRep.substring(0, finalRep.length-1);
				//alert(finalRep);
				$('#reponseFinale').val(finalRep);
				$('#formInscription').submit();
				
			});
			
		 </script>
<?php }
else{
?>
	<div class="totalBox">
		 <div class="box">
		 <div class="titreNews">Erreur :</div>
			<span>Il n'y a aucun évènement dans la base de données</span>
		</div>
	</div>
<?php
}
?>
