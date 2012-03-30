<?php
 /* 
  * Génération de cartes Google Maps par rapport aux adresses des lieux d'entrainement stockés dans la bdd
  * (Module Club)
  * (API Google Maps, Geolocalisation)
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */
  

	include("./config/mysql.php");
	mysql_connect($host, $user, $passwd); 
	mysql_select_db($bdd);
	mysql_query("SET NAMES 'utf8'");
	
	$tabMap_num = array();
	$tabMap_nom = array();
	
	echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
	?>
	
	<script type="text/javascript">
	var tabMap_adresse = new Array();
	var tabMap_id = new Array();
	
		  function codeAddress(map,address, geocoder) {
			geocoder.geocode( { 'address': address}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map, 
					position: results[0].geometry.location
				});
			  } 
			  else{
				alert("Geocode was not successful for the following reason: " + status);
			  }
			});
		 }
	</script>
	<?php
	
	$req = "SELECT numero, nom, adresse FROM lieu_ultimate WHERE adresse != '' ORDER BY numero";
  	$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	while($data = mysql_fetch_array($res)){
		array_push($tabMap_num, $data['numero']);
		array_push($tabMap_nom, $data['nom']);
	?>
		<script type="text/javascript">
		  var map<?php echo $data['numero'];?>;
		  var address<?php echo $data['numero'];?> = "<?php echo $data['adresse'];?>";
		  var geocoder<?php echo $data['numero'];?>;
		  
			function initialize(){
				geocoder<?php echo $data['numero'];?> = new google.maps.Geocoder();
				var latlng<?php echo $data['numero'];?> = new google.maps.LatLng(-34.397, 150.644);
				var myOptions = {
					zoom: 12,
					center: latlng<?php echo $data['numero'];?>,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map<?php echo $data['numero'];?> = new google.maps.Map(document.getElementById("map_canvas<?php echo $data['numero'];?>"), myOptions);
			}
		</script>
			
			
		 <div class="box" id="map<?php echo $data['numero'];?>" style="width:510px; margin:22px auto;">
			<div class="titreNews"><?php echo $data['nom'];?></div>
			<div id="map_canvas<?php echo $data['numero'];?>" style="width: 500px; height: 300px; margin:0 auto;"></div>
			<p style="text-align:center; background-color:#222; color:white; margin:0 5px 5px 5px; padding:8px;">
				<?php echo $data['adresse'];?>
			</p>
		 </div>
		 <script type="text/javascript">
			initialize(); 
			codeAddress(map<?php echo $data['numero'];?>, address<?php echo $data['numero'];?>, geocoder<?php echo $data['numero'];?>);
			tabMap_adresse.push("<?php echo $data['adresse'];?>");
			tabMap_id.push("<?php echo $data['numero'];?>");
		 </script>
	<?php
	}
?>
	<?php
	if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
		if(count($tabMap_num)>0){ ?>
				<div id="accordionLieu">
			
					<h4 class="header titreSaison">Gestion des lieux d'entrainement</h4>
					<div class="box2">
						<div style="float:right">
								<a href="./doc/doc_lieu_entrainement/doc_admin_lieu.html">
									<img src="./images/help.png" alt="help" title="aide en ligne" />
								</a>
						</div>
						<form id="formLieu" method="post" action="./modules/club/action_lieu.php">
							<select id="listeLieu" name="id_lieu">
								<?php
								for($i=0; $i<count($tabMap_num);$i++){
										echo'<option value="'.$tabMap_num[$i].'">'.$tabMap_nom[$i].'</option>';
								} ?>
							</select>
							<input id="action_mode" type="hidden" name="mode"/>
							<span class="bouton1" id="boutonModif" title="Modifier">#</span>
							<span class="bouton1" id="boutonSuppr" title="Supprimer">X</span>
							<span class="bouton1" id="boutonAdd" title="Ajouter">+</span>
						</form>
					</div>
				</div>
  <?php }
	?>
		
	<script type="text/javascript">
		$(document).ready(function(){
			$("#accordionLieu").accordion({ autoHeight: false, collapsible: true, active:false});
		});
		
		$("#boutonSuppr").click(function(){
			var selectListe = document.getElementById("listeLieu");
			var valeurNum = selectListe.options[selectListe.selectedIndex].value;
			var divConfirmSuppr = document.createElement("div");
			$(divConfirmSuppr).html('<p>Souhaitez-vous vraiment supprimer ce lieu d\'entrainement ?</p>');
			$(divConfirmSuppr).dialog({
				width: 500,
				modal: true,
				title: $("#listeLieu").find('option').filter(function() {
								return $(this).val() == valeurNum;
						}).html(),
				draggable: false,
				closeText: 'x',
				buttons:{
					"confirmer": function() { 
						$("#action_mode").val('suppr');
						$("#formLieu").submit();
					},
					"annuler": function() { 
						$(this).dialog("close");
					}																
				}
			});
		});
		
		$("#boutonAdd").click(function(){
			
			var divConfirmSuppr = document.createElement("div");
			$(divConfirmSuppr).html('<form id="formAddLieu" method="post" action="./modules/club/action_lieu.php">'+
										'<div class="bouton2 dataForm" style="margin:10px; width:90%">'+
											'<span style="font-size:12px;  padding:0 10px 0 3px">Nom:</span>'+
											'<br/><br/><input type="text" style="width:90%" name="nom" />'+
										'</div>'+
										'<div class="bouton2 dataForm" style="margin:10px; width:90%">'+
											'<span style="font-size:12px;  padding:0 10px 0 3px">Adresse:</span>'+
											'<br/><br/><input type="text" style="width:90%" name="adresse" />'+
										'</div>'+
										'<input type="hidden" name="mode" value="add"/>'+
									'</form>'
								);
			$(divConfirmSuppr).dialog({
				width: 500,
				modal: true,
				title: "Ajout d'un lieu d'entrainement",
				draggable: false,
				closeText: 'x',
				buttons:{
					"confirmer": function() { 
						$("#formAddLieu").submit();
					},
					"annuler": function() { 
						$(this).dialog("close");
					}																
				}
			});
		});
		
		$("#boutonModif").click(function(){
			
			var selectListe = document.getElementById("listeLieu");
			var valeurNum = selectListe.options[selectListe.selectedIndex].value;
			
			var nom = $("#listeLieu").find('option').filter(function() {
								return $(this).val() == valeurNum;
						}).html();
						
			var adresse;
			
			for(i=0;i<tabMap_id.length; i++){
				if(tabMap_id[i]==valeurNum){
					adresse = tabMap_adresse[i];
					break;
				}
			}
			
			var divConfirmSuppr = document.createElement("div");
			$(divConfirmSuppr).html('<form id="formModifLieu" method="post" action="./modules/club/action_lieu.php">'+
										'<div class="bouton2 dataForm" style="margin:10px; width:90%">'+
											'<span style="font-size:12px;  padding:0 10px 0 3px">Nom:</span>'+
											'<br/><br/><input type="text" style="width:90%" name="nom" value="'+nom+'" />'+
										'</div>'+
										'<div class="bouton2 dataForm" style="margin:10px; width:90%">'+
											'<span style="font-size:12px;  padding:0 10px 0 3px">Adresse:</span>'+
											'<br/><br/><input type="text" style="width:90%" name="adresse" value="'+adresse+'" />'+
										'</div>'+
										'<input type="hidden" name="id_lieu" value="'+valeurNum+'"/>'+
										'<input type="hidden" name="mode" value="modif"/>'+
									'</form>'
								);
			$(divConfirmSuppr).dialog({
				width: 500,
				modal: true,
				title: "Modification du lieu d'entrainement:",
				draggable: false,
				closeText: 'x',
				buttons:{
					"confirmer": function() { 
						$("#formModifLieu").submit();
					},
					"annuler": function() { 
						$(this).dialog("close");
					}																
				}
			});
		});
	</script>
<?php 
	}
?>