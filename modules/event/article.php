<?php

/* 
  * Module Event
  * Mise en page et affichage de l'article par rapport � l'id-event.
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */


$tabSousCatName = array("lecture","modifier","creer");
$estCat = false;
for($i=0; $i<count($tabSousCatName) && !$estCat; $i++){
	if($_GET['page']==$tabSousCatName[$i] || $_POST['mode']==$tabSousCatName[$i]){
		$estCat = true;
		$mode = $tabSousCatName[$i];
	}
}

if(!$estCat){ //Si la cat�gorie existe
	echo '<script type="text/javascript">document.location.href="./";</script>';
}

if($mode == $tabSousCatName[0]){
$id = $_GET['id'];
	if(!isset($id) || !is_numeric($id) || $id<0){
	 echo    '<div class="totalBox">'.
							'<div class="box">'.
								'<div class="titreNews">Article non trouvé</div>'.
								'<p>Cette article n\'existe pas/plus dans notre base de donnée</p>'.
									
							'</div>'.
						
			 '</div>';
	}
	else{
			include("./config/mysql.php");
			mysql_connect($host, $user, $passwd); 
			mysql_select_db($db);
			mysql_query("SET NAMES 'utf8'");
		
				$req = "SELECT titre, contenu, DATE_FORMAT(date_article, '%d/%m/%Y') AS dateArticle, id_member FROM article WHERE id=$id";
				$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$row = mysql_fetch_row($res);
				mysql_close();
				
				if($row[1]==""){
				 echo    '<div class="totalBox">'.
							'<div class="box">'.
								'<div class="titreNews">Article non trouvé</div>'.
								'<p>Cette article n\'existe pas/plus dans notre base de données</p>'.
									
							'</div>'.
					
						'</div>';
				}
				else{
					mysql_connect($host, $user, $passwd); 
					mysql_select_db($db);

						$reqMembre = "SELECT login FROM membre WHERE id = ".$row[3];
						$resMembre = mysql_query($reqMembre)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$rowMembre = mysql_fetch_row($resMembre);
						$membre = $rowMembre[0];
					mysql_close();
					
					if(!empty($membre)){
						 $creePar = ' par '.$membre; 
					}
						
					echo  '<div class="totalBox">'.
								'<div class="box">'.
									'<div class="titreNews">'.$row[0].'</div>';
									
									
										echo '<div>'.$row[1].'</div>' .
									
									'<div style="margin-top:30px">' .
										'<span class="note">Article créé' .$creePar.' le ' .$row[2].'</span>'.
										'<span class="social">'.
											//'<a href="#"><img class="socialIcon" src="./images/social/facebook.png" alt="Facebook" /></a>'.
											//'<a href="#"><img class="socialIcon" src="./images/social/twitter.png" alt="Twitter" /></a>'.
										'</span>'.
									'</div>' .	
										
								'</div>'.
							
							'</div>';
						
					if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
						echo '<div style="float:right">';
						echo '<form id="form" style="display:inline" method="post" action="./modules/event/action.php">'; 
							echo	'<input type="hidden" name="id" value="' .$id . '"/>';
							echo	'<input id="modeHidden" type="hidden" name="mode" value="supprimer" />';
							echo '<input type="submit" class="bouton1" value="Supprimer l\'article" />';
						echo '</form>';
						echo '<form id="form2" style="display:inline" method="post" action="./?categorie=article">'; 
							echo	'<input type="hidden" name="id_article" value="' .$id . '"/>';
							echo	'<input id="modeHidden" type="hidden" name="mode" value="modifier" />';
								echo '<input type="submit" class="bouton1" value="Modifier l\'article" />';
						echo '</form>';
						echo '</div>';
					}
	
				}
		}

}
else{
		include("./modules/event/creer_article.php");
	}
?>

