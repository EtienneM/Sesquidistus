<?php
 /* Fichier d'index des sujet d'une sous-catégorie.
  * il représente la liste des sujet d'une sous-catégorie.
  *
  * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
  */
 if(!isset($_SESSION['login']) && empty($_SESSION['login']))
 {
 	//-S'il le memebre n'est pas admin on le redirige sur l'index---
	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
   //---
 }  
 else if(isset($_GET['scat']) && is_numeric($_GET['scat']) && $_GET['scat'] >= 0)
 {    
	//-Include concernant le SGBD---
	include("./config/mysql.php");
	//-Include du fichier de fonctions---
	include("./modules/forum/fonctions.php");
   
	//-Arbosescence---
	$arbo = get_cat_info($_GET['scat']);  
	//-S'il s'agit d'une mauvaise sous-catégorie on redirige sur la page d'index du forum---
	if(empty($arbo)){echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
  
	echo '<div class="arbo">'.
				'<a href="?categorie=forum"><span class="bouton1">Index Forum</span></a>&nbsp;&nbsp;> '.
				'<a href="?categorie=topics&scat='.$arbo['ID'].'"><span class="bouton1">'.utf8_encode($arbo['LIBELLE']).'</span></a>'.
			'</div>';
			
	//-Si la connexion réussie---
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$req = "SELECT count(ID) AS NB FROM forum_topic WHERE ID_SCAT=".$arbo['ID'];
		$query = mysql_query($req);
		if($query)
		{
			$r = mysql_fetch_object($query);	
			$p_id = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
			
			//-On compte 10 sujets par page---
			$limite_par_page = 10;
			$limite_pages = 4;
			$nb_pages = $r->NB / $limite_par_page; 
			if($r->NB % $limite_par_page != 0) $nb_pages= intval(++$nb_pages);
			//-Si mauvais pid alors on redirige---
			//if($p_id > $nb_pages || $p_id < 0) echo '<script type="text/javascript">window.location.href="./?categorie=topics&scat='.$arbo['ID'].'";</script>';
			//---
			//---
			
			//-Bouton nouveau topic & pages---
			echo '<div class="arbo">'.
						'<a href="?categorie=topic_ajout&s_id='.$_GET['scat'].'"><span class="bouton1">Nouveau sujet</span></a>';
			echo		'<span style="margin-left:530px;" class="bouton2">Pages : ';
			
			//-Dans tous les cas on affiche la page n°1 et la dernière ---
			$selec = $p_id  == 1? 'style="color:red;"' : '';
			echo '<a '.$selec.' href="./?categorie=topics&scat='.$arbo['ID'].'&p=1">1</a> ';	
			//---

			for($j=0, $i = $p_id > 1 ? $p_id : $p_id+1; $i<$nb_pages && $j<3 ; $i++, $j++)
			{
				$selec = $i == $p_id ? 'style="color:red;"' : '';
				echo '<a '.$selec.' href="./?categorie=topics&scat='.$arbo['ID'].'&p='.$i.'">'.$i.'</a> ';	
			}
			if($nb_pages >1){ 
			  $selec = $i == $p_id ? 'style="color:red;"' : '';
			  echo ' ... <a '.$selec.' href="./?categorie=topics&scat='.$arbo['ID'].'&p='.$nb_pages.'">'.$nb_pages.'</a> ';	
			}
			echo	'</div>';			
		    //---
		    
			//-Header de la sous-catégorie
			echo '<div class="box"><div class="titreNews"><span class="h_titre">Sujet</span><span class="h_stat">Stats</span><span class="h_lstmsg">Dernier message</span></div>';
			//---
	
	
			$scat = mysql_real_escape_string($_GET['scat']);
			//-Requête num 1 on récupère le libellé et le nombre de message par sujet---
			$inf_query = "SELECT t.ID, t.LIBELLE, count(m.ID) AS NB_MSG FROM forum_topic t, forum_msg m ".
								"WHERE t.ID_SCAT=".$scat." AND t.ID = m.ID_TOPIC GROUP BY t.ID LIMIT ".($p_id-1)*$limite_par_page.",".$limite_par_page;
	       
			$r_topic = mysql_query($inf_query);
	
			//-Si la requête a marché---
			if($r_topic)
			{ 
				//-On procède sujet par sujet---
				while($rtopic = mysql_fetch_object($r_topic))
				{  
					//-Requête num 2 on récupère les infos sur le dernier post du sujet---
					$lastmsg_query = "SELECT DATE_PUB, LOGIN FROM forum_msg m, membre mem ".
											  "WHERE m.ID_MEMBRE=mem.ID AND m.ID_TOPIC=".$rtopic->ID." ORDER BY DATE_PUB DESC LIMIT 1";
					$last_msg = mysql_query($lastmsg_query);
	
					//-Si la requête a marché---
					if($last_msg)
	       			{
						$l_msg = mysql_fetch_object($last_msg);  
	           
						//-Accords lexicaux---
				       $nb_msg = $rtopic->NB_MSG > 1 ? $rtopic->NB_MSG." Messages" : $rtopic->NB_MSG." Message";              
				       $date = isset($l_msg->DATE_PUB) ? "le ".date("j/m/y \à H:i:s",$l_msg->DATE_PUB) : "-";
				       $auteur = isset($l_msg->LOGIN) ? "Par ".$l_msg->LOGIN : "-";
				       //---
				       
					    //-Affichage du sujet---
						$del_ok = '<span class="del">'.
											'<a href="./?categorie=actions_forum&action=suppr_sujet&id='.$rtopic->ID.'"/><img src="images/forum/del.png" width="32" height="32"/></a>'.
	                   					'</span>';
						$del_admin = $_SESSION['lvl'] == 1 ? $del_ok: "";
						echo '<div class="cat">'.
									'<div class="souscat">'.
										'<span class="titretopic">'.
												'<a href="?categorie=topic&id='.$rtopic->ID.'">'.utf8_encode(stripslashes($rtopic->LIBELLE)).'</a>'.
										'</span>'.
										$del_admin.
										'<span class="stattopic">'.$nb_msg.'</span>'.
										'<span class="lstmsg">'.$auteur.'<br/>'.$date.'</span>'.
									'</div>'.
								'</div>';
						//-On libère le curseur de la requête 2---
						mysql_free_result($last_msg);
						//---
					}
					//-Si une des requetes a échouée on redirige---
					else echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
					//---
				}
				echo "</div>";
				echo '<script type="text/javascript" src="./modules/forum/del_sujet.js"></script>';
				//-On libère le curseur de la requête 1---
				mysql_free_result($r_topic); 
				//---
			}
			else echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
		}
		else echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
		//-On ferme la connexion---
		mysql_close();
		//---
	}
	else echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
}
else
{
	//-S'il s'agit d'un mauvais topic on redigire vers la page d'inex du forum---
	echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
   //---
}
?>
