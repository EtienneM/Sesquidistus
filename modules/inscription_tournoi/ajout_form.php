<?php
if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
if(!isset($_POST['id_event'])){
	?>
		<script type="text/javascript">window.location.href = "./?categorie=event"</script> 
	<?php
}
$id_event = $_POST['id_event'];

$tabQuestion = array("Nom de votre équipe :","Quand arrivez-vous ? (jour et heure approximative)","Combien de joueurs êtes-vous ?",
"Combien d'accompagnateurs ? Enfants, adultes ?","Nombre de végétariens ?","Quelle formule choisissez-vous ?",
"Le mail et le n° de tel de votre contact équipe :");

$mode = "ajout";

				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($db);
				mysql_query("SET NAMES 'utf8'"); 
				
				
$req = "SELECT titre FROM evenement WHERE id=$id_event";
$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$row = mysql_fetch_row($res);
				
$req = "SELECT questions FROM inscription_tournoi WHERE id_event = $id_event LIMIT 1";
$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());



while($data = mysql_fetch_array($res)){
	$tabQuestion = explode("~",$data['questions']);
	$mode = "update";
}

?>
	
	<span id="consultButton" class="bouton1 boutonPageCourante">Gestion du formulaire d'inscription: <?php echo $row[0]; ?></span>
		 <div style="margin-top:20px"> 
			<form id="formInscription" method="post" action="./modules/inscription_tournoi/action_ajout.php">
				<input id="questionFinale" type="hidden" name="questionFinale" />
				<input type="hidden" name="id_event" value="<?php echo $id_event; ?>" />
				<input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>" />
				
				<div id="questions" style="margin-bottom:20px">
					<?php for($i=0; $i<count($tabQuestion); $i++){
							echo '<div class="bouton2 question" style="margin-top:20px">
									<span style="margin-right:30px">Question n°'.($i+1).'</span>
									<input class="questionValue" type="text" size=80 id="q'.$i.'" value="'.$tabQuestion[$i].'" />
								  </div>';
						}
					?>
				</div>
				
				<div style="text-align:right">
				<?php if($mode=="update"){
						echo '<span id="supprForm" class="bouton1">Supprimer ce formulaire</span>';
					  }
				?>	
					<span id="addQuestion" class="bouton1" title="ajouter une question">+</span>
					<span id="supprQuestion" class="bouton1" title="supprimer la dernière question">-</span>
					<span id="validerForm" class="bouton1">Valider ce formulaire</span>
				</div>
			</form>
		</div>
	
	
	 <script type="text/javascript">
	 var nbQuestion = <?php echo count($tabQuestion) + 1 ; ?>; 
		$('#validerForm').click( function(){
			var finalQuestion ="";
			$('input.questionValue').each( function(){
				if($(this).val().length>0){
					finalQuestion += $(this).val() + "~";
				}
			});
		
			finalQuestion = finalQuestion.substring(0, finalQuestion.length-1);
			//alert(finalQuestion);
			$('#questionFinale').val(finalQuestion);
			$('#formInscription').submit();
			
		});
		
		$('#supprForm').click( function(){
			$('#questionFinale').val("");
			$('#mode').val("suppression");
			$('#formInscription').submit();
		});
		
		
		$('#addQuestion').click( function(){
			if(nbQuestion<=15){
				var divQuestion = document.createElement('div');
				$(divQuestion).html('<div class="bouton2 question" style="margin-top:20px"><span style="margin-right:30px">Question n°'+ nbQuestion + '</span><input class="questionValue" type="text" size=80 id="q'+ nbQuestion + '"  /></div>');
				$('#questions').append($(divQuestion));
				nbQuestion++;
			}
			
		});
		
		$('#supprQuestion').click( function(){
			if(nbQuestion>0){
				$('div.question:last').detach();
				nbQuestion--;
			}
		});
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
