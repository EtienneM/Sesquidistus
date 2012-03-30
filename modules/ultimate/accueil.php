<?php 		
 /* 
  * Module de prÈsentation de l'Ultimate Frisbee
  * 
  *
  * Auteur : BenoÓt SOUFFLET <benoit.soufflet@gmail.com>
  */	  
				$padMenu = 0;
				if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
					$admin=true;
					$padMenu = 32;
				}

				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($bdd);
				mysql_query("SET NAMES 'utf8'");
				
				$reqCat = "SELECT * FROM ultimate";
				$resCat = mysql_query($reqCat)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				
				$idCat = array();
				$titreCat = array();

				while($data = mysql_fetch_array($resCat)){
					array_push($idCat, $data['id']);
					array_push($titreCat, $data['titre']);
	 			} 
				
				$idOk = false; //boolean pour vÈrification de la sous-catÈgorie. 

				if(isset($_GET['id']) && is_numeric($_GET['id'])){
					for($i=0; $i<count($idCat); $i++){
						if($_GET['id']==$idCat[$i]){
							$idOk = true;
							break;
						}
					}
				}
				if(!$idOk){ //Si la sous-catÈgorie n'existe pas, on charge la premiËre sous-catÈgorie
					$_GET['id']=$idCat[0];
				}
				
				if(count($idCat)>0){
					$id = $_GET['id'];
					$req = "SELECT * FROM ultimate WHERE id=$id";
					$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$row = mysql_fetch_row($res);
				}
				

				
?>

<div style="margin-bottom:100px">
	<!-- div du menu -->
   <div id="Menu" class="box" style="background-color:#dfdfdf; padding-bottom:<?php echo $padMenu;?>px;">
     <div class="titreNews">Sections</div>
	 
	<?php for($i=0; $i<count($idCat); $i++){ //GÈnÈration du menu "Sections"
		if($idCat[$i]==$id){$isSelect='bouton6';}else{$isSelect='bouton2';}
			echo '<a href="./?categorie=ultimate&id='.$idCat[$i].'">
					<div class="'.$isSelect.'" style="margin:10px 0; padding:5px;">
					
						<span style="font-size:11px; font-weight:500;">'.$titreCat[$i].'</span>
					
		     	    </div>
				 </a>';
	 } 
	 
		  
		  echo '<select id="selectSuppr" style="display:none">';
	 for($i=0; $i<count($idCat);$i++){
		echo '<option value="'.$idCat[$i].'">'.$titreCat[$i].'</option>';
	 }
		  echo '</select>';
	 ?>
	  <?php if($admin){ ?>
				<span class="bouton1" style="position:absolute; left:5px; bottom:5px" id="ajoutCat" title="Ajouter une cat√©gorie">+</span>
				<span class="bouton1" style="position:absolute; left:35px; bottom:5px" id="supprCat" title="Supprimer une cat√©gorie">-</span>
				<span style="position:absolute; left:125px; bottom:1px"><a href="./doc/doc_club_ultimate/doc_admin_club_ultimate.html" target="_blank"><img src="./images/help.png" title="aide en ligne" alt="aide"/></a></span>
	  <?php } ?>
    </div>

 <!-- div du contenu de la page -->
  <div class="box" id="content">
   <div class="titreNews"><?php echo '<span>'.$row[1].'</span>'; ?></div> 
  	 <div style="margin-bottom:20px">
	 <?php 		//IntÈgration du contenu stockÈ dans la bdd par rapport la sous-catÈgorie courante
				echo '<div>'.$row[2].'</div>';
	 ?>
	 
	 </div>
	 
	
	 
   </div>
	 <?php if($admin){ //Bouton Ajout et suppression d'une sous-catÈgorie pour les ADMIN ?>
			 <div style="position:absolute; right:5px;">
				 <form style="display:inline" method="POST" action="./?categorie=admin_ultimate">
							<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
							<input class="bouton1" type="submit" value="modifier le contenu" />
				 </form>
			 </div>
	 <?php } ?>
</div>

<script type="text/javascript">

//Gestion des ÈvËnements "click" sur bouton (ADMIN uniquement)

	$('#ajoutCat').click( function(){
		var divForm = document.createElement('div');
		$(divForm).html('<p class="i">Veuillez entrer le nom de la nouvelle cat√©gorie:</p><form id="formAjoutCat" method="post" action="./modules/ultimate/action.php"><input type="text" size=30 name="titre" /><input type="hidden" name="mode" value="ajout" /></form>');
		$(divForm).dialog({
							width: 400,
							title: "Ajout d'une cat√©gorie",
							modal: true,
							draggable: false,
							closeText: 'x',
							buttons:{ "Valider": function() { 
											$('#formAjoutCat').submit();
											$(this).dialog("close");
										}
							}
		});
	});
	
	$('#supprCat').click( function(){
		var divForm = document.createElement('div');
		$(divForm).html('<p class="i">Veuillez selectionner la cat√©gorie √† supprimer:</p><form style="display:none" id="formSupprCat" method="post" action="./modules/ultimate/action.php"><input type="hidden" name="mode" value="suppr" /><input id="idCatSuppr" type="hidden" name="id" /></form>');
		$(divForm).append($('#selectSuppr').css("display","block"));
		$(divForm).dialog({
							width: 400,
							title: "Supprimer d'une cat√©gorie",
							modal: true,
							draggable: false,
							closeText: 'x',
							buttons:{ "Valider": function() { 
										var selectSuppr = document.getElementById('selectSuppr');
											$('#idCatSuppr').val(selectSuppr.options[selectSuppr.selectedIndex].value);
											$('#formSupprCat').submit();
											$(this).dialog("close");
										}
							}
		});
	});
</script>
