<?php
/* 
 * Ce fichier regroupe les "vues" des  
 * pages qui réalisent des opérations de maj
 * ou d'insertion de message dans un sujet.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
 //-Inclusion des paramètres de la BDD.---
 include("./config/mysql.php");
 //---
 
 //-On include les fonctions utiles---
 include("./modules/forum/fonctions.php");
 //---
 
 if(($_GET['action'] == "edit" || $_GET['action'] == "repondre") && isset($_SESSION['login']))
 {
 	$action = $_GET['action'];
 	
	 if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	 {
		$req = "SELECT scat.ID AS SCAT_ID, scat.LIBELLE AS SCAT_LIBELLE, t.LIBELLE AS T_LIBELLE ".
				   "FROM forum_topic t, forum_scat scat WHERE t.ID_SCAT = scat.ID AND t.ID=".mysql_real_escape_string($_GET['t_id']);
	    $query = mysql_query($req);
	    if($query)
	    {
	   		//-On réquère l'objet résultat---
			$r = mysql_fetch_object($query);
			//---
			
			//-S'il s'agit d'un mauvais topic on redirige sur la page d'index du forum.---
			if(empty($r)){echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
			//---
			
			$t_id = $_GET['t_id'];
			
			//-On génère l'arborescence.---
			echo '<div class="arbo">'.
						'<a href="./?categorie=forum"><span class="bouton1">Index Forum</span></a>'.
							'&nbsp;&nbsp;>'.
						'<a href="?categorie=topics&scat='.$r->SCAT_ID.'"><span class="bouton1">'.utf8_encode(stripslashes($r->SCAT_LIBELLE)).'</span></a>'.
							'&nbsp;&nbsp;>'.
						'<a href="?categorie=topic&id='.$t_id.'"><span class="bouton1">'.utf8_encode(stripslashes($r->T_LIBELLE)).'</span></a>'.
					'</div><br/>';
			//---		
			if($action == "edit")
			{
				//-On regarde si le post a éditer est le premier du topic---
				$req = 'SELECT ID FROM forum_msg WHERE DATE_PUB IN (SELECT min(DATE_PUB) FROM forum_msg '.
							'WHERE ID_TOPIC='.mysql_real_escape_string($t_id).') AND ID_TOPIC='.mysql_real_escape_string($t_id);
				$query= mysql_query($req);
				if($query)
				{
					$r = mysql_fetch_object($query);
					$first_msg = $r->ID;
				}
				mysql_free_result($query);
				//---
				
				$req = "SELECT t.LIBELLE, msg.ID AS msg_ID, m.LOGIN, m.ID AS m_ID, msg.CONTENU FROM forum_msg msg, forum_topic t, membre m ".
							"WHERE t.ID = msg.ID_TOPIC AND m.ID = msg.ID_MEMBRE AND msg.ID=".mysql_real_escape_string($_GET['msg_id']);
				$query= mysql_query($req);
			}
			
			if($query)
			{
				if($action == "edit")
				{
					$r = mysql_fetch_object($query);
					//-S'il s'agit d'un mauvais topic on redirige sur la page du topic---
					if(empty($r)){info_forum("Un problème de connexion est survenu!", 0, $t_id);} 
					//---
					$ok = $r->m_ID == $_SESSION['id'] ? true : false;
					$msg_id = $r->msg_ID;
					$contenu = $r->CONTENU;
					$titre = $r->LIBELLE;
					
					//-On détermine si on peut éditer le titre (1er post)---
					$edit_titre = $first_msg == $msg_id ? "" : 'disabled=disabled"';
					//---
				}
				else if($action == "repondre")
				{
					$ok = isset($_SESSION['login']) ? true : false;
					$titre = $r->T_LIBELLE;	
					$contenu = "";
					//-On ne peux pas éditer le titre en mode réponse---
					$edit_titre = "disabled=\"disabled\"";
					//---
				}
				if($_SESSION['lvl'] == 1 || $ok)
				{
					//-Inclusion de TinyMCE.---
					echo '<script type="text/javascript" src="./tinymce/jquery.tinymce.js"></script>';					
					echo '<script type="text/javascript" src="./modules/forum/topic_tinymce.js"></script>';
					//---
					
					//-Box Rép & Edition---
					echo '<div class="box_mce">'.
							'<form method="POST" action="./?categorie=actions_forum">'.
								'<div class="bouton2 dataForm2">'.
									'Titre du topic: <input type="text" size="50" '.$edit_titre.' name="titre" value="'.utf8_encode(stripslashes($titre)).'"/>'.
							 '</div><br/>'.
							 '<div class="bouton2 dataForm2">'.
									'Contenu du message:'.
							 '</div><br/>'.
								'<div>'.
									'<textarea id="elm1" name="content" rows="15" cols="40" class="tinymce">'.utf8_encode(stripslashes($contenu)).'</textarea>'.
								'</div>'.
								'<div style="text-align:center;margin-top:10px;">';
					
					if($action == "repondre")
					{
						echo	'<input type="hidden" value="'.$t_id.'" name="t_id" />';
						$mode = "reponse";
					}
					else if($action == "edit")
					{
						echo '<input type="hidden" value="'.$t_id.'" name="t_id" />';
						echo '<input type="hidden" value="'.$msg_id.'" name="msg_id" />';
						if ($first_msg == $msg_id)
						{
							echo '<input type="hidden" value="true" name="edit_titre" />';
						}
						$mode = "edit";
					}
					  echo 		'<input type="hidden" value="'.$mode.'" name="mode" />'.
					  				'<input type="submit" value="Poster" class="bouton1" />'.
									'<input type="reset" value="Tout effacer" class="bouton1" id="reset" />'.
								'</div>'.
							  '</form>'.
							  '</div>';
					//---
				}
				else
				{
						//-Sinon le membre n'as rien à faire la on le redirige---
    					echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
    					//--- 	
				}	
				//-On libère l'objet resultat---
				mysql_free_result($query);
				//---
			}
			else{
				//-Si erreurde requête on redirige avec info_forum---
				 echo info_forum("Un problème de traitement est survenu!", 0, $t_id);
				//--
			}
		}
		else {
			//-Si erreur de requête on redirige avec info_forum---
			 echo info_forum("Un problème de traitement est survenu!", 0, $t_id);
			//---
		}	
		mysql_close();
	}
	else {
		//-Si probleme de connexion on redirige a	vec info_forum---
		echo info_forum("Un problème de connexion est survenu!", 0, $t_id);
		//---
	}
 }
 else
 {
    //-Sinon le membre n'as rien à faire la on le redirige---
    echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
    //--- 	
 }
  
 ?>