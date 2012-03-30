<?php
 //-Inclusion des paramètres de la BDD.---
 include("./config/mysql.php");

 if(!isset($_SESSION['login']) && empty($_SESSION['login'])){
 	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
 }
 else if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
 {
	$req = "SELECT scat.ID AS SCAT_ID, scat.LIBELLE AS SCAT_LIBELLE, t.LIBELLE AS T_LIBELLE, count(m.ID) AS NB ".
				"FROM forum_topic t, forum_scat scat, forum_msg m WHERE m.ID_TOPIC = t.ID AND t.ID_SCAT = scat.ID AND t.ID=".mysql_real_escape_string($_GET['id']);
   $query = mysql_query($req);
   if($query)
   {
		$r = mysql_fetch_object($query);
		$p_id = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
		
		//-S'il s'agit d'un mauvais topic on redirige sur la page d'index du forum---
		if(empty($r)){echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
		
		//-On compte 10 messages par topic---
		$limite_par_page = 10;
		$limite_pages = 4;
		$nb_pages = $r->NB / $limite_par_page; 
		if($r->NB % $limite_par_page != 0) $nb_pages= intval(++$nb_pages);
		//-Si mauvais pid alors on redirige---
		if($p_id > $nb_pages || $p_id < 0) echo '<script type="text/javascript">window.location.href="./?categorie=topic&id='.$_GET['id'].'";</script>';
		//---
		//---

		//-On génère l'arborescence du forum.---
		$t_id = $_GET['id'];
		echo '<div class="arbo">'.
					'<a href="./?categorie=forum"><span class="bouton1">Index Forum</span></a>'.
						'&nbsp;&nbsp;>'.
					'<a href="?categorie=topics&scat='.$r->SCAT_ID.'"><span class="bouton1">'.utf8_encode(stripslashes($r->SCAT_LIBELLE)).'</span></a>'.
						'&nbsp;&nbsp;>'.
					'<a href="?categorie=topic&id='.$_GET['id'].'"><span class="bouton1">'.utf8_encode(stripslashes($r->T_LIBELLE)).'</span></a>'.
				'</div>';
		//---
		
		//-Bouton répondre & pages---
     	echo '<div class="arbo">'.
     				'<a href="./?categorie=topic_update&action=repondre&t_id='.$t_id.'" name="debut">'.
     					'<span class="bouton1">Repondre</span>'.
     				'</a>';
     	echo		'<span style="margin-left:530px;" class="bouton2">Pages : ';
		
		//-Dans tous les cas on affiche la page n°1 et la dernière ---
		$selec = $p_id  == 1? 'style="color:red;"' : '';
		echo '<a '.$selec.' href="./?categorie=topic&id='.$t_id.'&p=1">1</a> ';	
		//---

		for($j=0, $i = $p_id > 1 ? $p_id : $p_id+1; $i<$nb_pages && $j<3 ; $i++, $j++)
		{
			$selec = $i == $p_id ? 'style="color:red;"' : '';
			echo '<a '.$selec.' href="./?categorie=topic&id='.$t_id.'&p='.$i.'">'.$i.'</a> ';	
		}
		if($nb_pages >1){ 
		  $selec = $i == $p_id ? 'style="color:red;"' : '';
		  echo ' ... <a '.$selec.' href="./?categorie=topic&id='.$t_id.'&p='.$nb_pages.'">'.$nb_pages.'</a> ';	
		}
     	echo	'</div>';
     	//---
     	
		echo	'<div class="totalBox">'.
					'<!-- Div du forum-->'.
						'<div class="box">'.
							'<div class="titreNews">'.utf8_encode(stripslashes($r->T_LIBELLE)).'</a></div>';
 		$req = "SELECT msg.ID, m.LOGIN, p.AVATAR, msg.ID_MEMBRE, msg.DATE_PUB, msg.CONTENU FROM forum_msg msg, forum_topic t, profil p, membre m ".
 					"WHERE t.ID = msg.ID_TOPIC AND m.ID = msg.ID_MEMBRE AND p.ID_MEMBRE = m.ID AND ID_TOPIC=".mysql_real_escape_string($_GET['id']).
 					" ORDER BY msg.DATE_PUB ASC LIMIT ".($p_id-1)*$limite_par_page.",".$limite_par_page;
		$query= mysql_query($req);
		   if($query)
		   {
				$compteur =  0;
				//-On récupère l'objet résultat.---
				while($r = mysql_fetch_object($query))
				{ 
					echo '<!-- Un message -->
							<div style="padding-bottom:0px; min-height:200px;">
								<!-- Infos sur le posteur -->
								<div style="text-align:center;margin-left:5px;">
								<!-- Div du pseudo -->
									<div class="bouton2" style ="text-align:center; position:absolute; width:130px;" >
										<a href="./?categorie=view_profil&u_id='.$r->ID_MEMBRE.'"><b>'.$r->LOGIN.'</b></a><br/>
										<a href="./?categorie=view_profil&u_id='.$r->ID_MEMBRE.'">
											<img style="margin-top:10px;" src="'.$r->AVATAR.'" width="110" height="140"/>
										</a>
									</div>
								</div>
								<!-- Date du poste -->
								<div style="float:right;width:200px;margin-right:20px;" class="bouton2"><b>Posté, le</b> '.date("d/m/Y  à  H:i", $r->DATE_PUB).'</div>
								<!-- Contenu du poste -->
								<div style="width:580px; padding-top:30px; margin-left:165px">
									<div style="width:580px; text-align:justify;">
										<hr>'.utf8_encode(stripslashes($r->CONTENU)).'<br/><hr>
									</div>
								</div>
							</div><hr/>';

					//-Actions possibles---
					if((isset($_SESSION['lvl']) && $_SESSION['lvl'] == 1) || (isset($_SESSION['id']) && $_SESSION['id'] == $r->ID_MEMBRE))
					{
						echo '<div class="actions_forum">'.
									'<a href="./?categorie=topic_update&action=edit&t_id='.$_GET['id'].'&msg_id='.$r->ID.'">'.
										'<img src="./images/forum/edit.png" alt="editer" class="bouton1" /></a>';
						if($compteur++ != 0)
								echo '<a href="./?categorie=actions_forum&action=suppr_message&t_id='.$_GET['id'].'&msg_id='.$r->ID.'" class="del_message">'.
											'<img src="./images/forum/del.png" alt="supprimer" class="bouton1"/></a>';
						echo '</div>';
		
					}
					//---
			}
			mysql_free_result($query);
   		}
   		//-Si requête échouée on redirige---
		else {echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
		//---
   		mysql_close();
  	}
  	 //-Si requête échouée on redirige---
	 else {echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
	 //---
	 //-Script pour la confirmation de suppression de message---
	 echo '<script type="text/javascript" src="./modules/forum/del_message.js"></script>';
	 echo '</div>'.
				'</div>'.
				'<div class="arbo"><a href="./?categorie=topic_update&action=repondre&t_id='.$t_id.'"><span class="bouton1">Repondre</span></a></div>'.
				'<div class="arbo"><a href="#debut"><span class="bouton1">Remonter tout en haut</span></a></div>'.
		   '</div>';
	 //----
	 
	 //-Réponse rapide---
	 echo '<script type="text/javascript" src="./tinymce/jquery.tinymce.js"></script>';
	 echo '<script type="text/javascript" src="./modules/forum/ajout_rapide.js"></script>';
	 echo '<div id="accordion" class="box_mce_topic">
				<h4 class="header titreSaison">Réponse rapide</h3>
				<div style="padding:0px;height:323px;">
					  <form method="POST" action="./?categorie=actions_forum">
						<div>
							<textarea id="elm1" name="content" rows="15" cols="40" class="tinymce"></textarea>
						</div>
						<div class="boutons_mce">
							<input type="hidden" value="reponse" name="mode" />
							<input type="hidden" value="'.$t_id.'" name="t_id" />
							<input type="submit" value="Poster" class="bouton1" />
							<input type="reset" value="Tout effacer" class="bouton1" id="reset" />
						</div>
					  </form>
				</div>
		   </div>';
	//---- 
 }
 //-Si probleme de connexion on redirige---
 else {echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
 //---
?>