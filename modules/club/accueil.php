<?php 	
 /* 
  * Module de présentation du Club
  * 
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */
  
		$padMenu = 0;
				if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
					$admin=true;
					$padMenu = 32;
				}

				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($db);
				mysql_query("SET NAMES 'utf8'");
				
				$reqCat = "SELECT * FROM club";
				$resCat = mysql_query($reqCat)  or die('Erreur SQL !<br />'.$reqCat.'<br />'.mysql_error());
				
				$idCat = array();
				$titreCat = array();

				while($data = mysql_fetch_array($resCat)){
					array_push($idCat, $data['id']);
					array_push($titreCat, $data['titre']);
	 			} 
				
				$idOk = false; //boolean pour vérification de la sous-catégorie. 

				if(isset($_GET['id']) && is_numeric($_GET['id'])){
					for($i=0; $i<count($idCat); $i++){
						if($_GET['id']==$idCat[$i]){
							$idOk = true;
							break;
						}
					}
				}
				if(!$idOk){ //Si la sous-catégorie n'existe pas, on charge la première sous-catégorie
					$_GET['id']=$idCat[0];
				}
				
				if(count($idCat)>0){
				 $id = $_GET['id'];
				 $req = "SELECT * FROM club WHERE id=$id";
				 $res = mysql_query($req)  or die('Erreur SQL !<br />'.$req.'<br />'.mysql_error());
				 $row = mysql_fetch_row($res);
				}
				

				
?>

<div style="margin-bottom:100px">
	<!-- div du menu -->
   <div id="Menu" class="box" style="background-color:#dfdfdf; padding-bottom:<?php echo $padMenu;?>px;">
     <div class="titreNews">Sections</div>
	 
	<?php for($i=0; $i<count($idCat); $i++){ //Génération du menu "Sections"
		if($idCat[$i]==$id){$isSelect='bouton6';}else{$isSelect='bouton2';}
			echo '<a href="./?categorie=club&id='.$idCat[$i].'">
					<div class="'.$isSelect.'" style="margin:10px 0; padding:5px;">
					
						<span style="font-size:11px; font-weight:500;">'.$titreCat[$i].'</span>
					
		     	    </div>
				 </a>';
	 } 
	 
		  
		  echo '<select id="selectSuppr" style="display:none">';
	 for($i=0; $i<count($idCat);$i++){
		if($titreCat[$i]!=3 && $idCat[$i]!=5){//Exeption pour les sous-cat?rie Equipe et Lieu d'entrainement
			echo '<option value="'.$idCat[$i].'">'.$titreCat[$i].'</option>';
		}
	 }
		  echo '</select>';
	 ?>
	  <?php if($admin){ ?>
				<span class="bouton1" style="position:absolute; left:5px; bottom:5px" id="ajoutCat" title="Ajouter une catégorie">+</span>
				<span class="bouton1" style="position:absolute; left:35px; bottom:5px" id="supprCat" title="Supprimer une catégorie">-</span>
				<span style="position:absolute; left:125px; bottom:1px"><a href="./doc/doc_club_ultimate/doc_admin_club_ultimate.html" target="_blank"><img src="./images/help.png" title="aide en ligne" alt="aide"/></a></span>
	  <?php } ?>
    </div>

 <!-- div du contenu de la page -->
  <div class="box" id="content">
   <div class="titreNews"><?php echo '<span>'.$row[1].'</span>'; ?></div> 
   
  	 <div style="margin:30px 10px">
	 <?php 		//Intégration du contenu stocké dans la bdd par rapport la sous-catégorie courante
				echo '<div>'.$row[2].'</div>';
	 ?>
	 
	 </div>

	 <?php
		if($row[0]==5){//Si sous-catégorie = Lieu d'entrainement, on charge la page correspondante
			include("./modules/club/lieux_entrainement.php");
		}
		else if($row[0]==3){//Si sous-catégorie = l'équipe, on charge la page correspondante
			include("./modules/membres/trombi.php");
		}
	 ?> 
	
	 
   </div>
	 <?php if($admin){ // Bouton Ajout et suppression et modification d'une sous-catégorie pour les ADMIN ?>
			 <div style="position:absolute; right:5px;">
				 <form style="display:inline" method="POST" action="./?categorie=admin_club">
							<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
							<input class="bouton1" type="submit" value="modifier le contenu" />
				 </form>
			 </div>
	 <?php } ?>
</div>

<?php if($admin){ ?>
<script type="text/javascript">
//Gestion des évènements "click" sur bouton (ADMIN uniquement)

	$('#ajoutCat').click( function(){
		var divForm = document.createElement('div');
		$(divForm).html('<p class="i">Veuillez entrer le nom de la nouvelle catégorie:</p><form id="formAjoutCat" method="post" action="./modules/club/action.php"><input type="text" size=30 name="titre" /><input type="hidden" name="mode" value="ajout" /></form>');
		$(divForm).dialog({
							width: 400,
							title: "Ajout d'une catégorie",
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
		$(divForm).html('<p class="i">Veuillez selectionner la catégorie à supprimer:</p><form style="display:none" id="formSupprCat" method="post" action="./modules/club/action.php"><input type="hidden" name="mode" value="suppr" /><input id="idCatSuppr" type="hidden" name="id" /></form>');
		$(divForm).append($('#selectSuppr').css("display","block"));
		$(divForm).dialog({
							width: 400,
							title: "Supprimer d'une catégorie",
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

<?php } ?>
