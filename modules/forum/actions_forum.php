<?php
/*
 * Ce fichier regroupe les différentes actions 
 * possibles dans le forum, il peut être considéré
 * comme le controleur du forum dans un modèle 
 * de type MVC.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

//-On include les paramètres de la bdd---
include("./config/mysql.php");
//---

//-On include les fonctions utiles---
include("./modules/forum/fonctions.php");
//---

if($_POST['mode'] == "add_cat"){//Actions réalisées lors d'un ajout d'une catégorie
	if(!empty($_POST['nom']))
	{
		extract($_POST);
		if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
		{
			$continuer = true;
			if($rang < $max)
			{
				$query="UPDATE forum_cat SET RANG=RANG+1 WHERE RANG>=".mysql_real_escape_string($rang);
				$query_cat = mysql_query($query);
				if(!$query_cat){$continuer=false;}
    		}
			if($continuer)
			{ 
				$query="INSERT INTO forum_cat (`LIBELLE`, `RANG`) VALUES ".
							"('".mysql_real_escape_string(utf8_decode($nom))."', '".mysql_real_escape_string($rang)."')";
				$query_cat = mysql_query($query);
				if($query_cat)
				{	
					//Si pas de problème.
	 				info("Ajout réalisé avec succès!", 1);
				}
			}
			else{info("Un problème de traitement est survenu!", 0);}
     		mysql_close();
		}
		else{info("Un problème de connexion est survenu!", 0);}	
	}
	else{info("Veuillez remplir le champ correctement!", 0);}
}
else if($_POST['mode'] == "del_cat"){//Actions réalisées lors d'une suppression d'une catégorie
	extract($_POST);
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$continuer = true;
		$tmp = explode("-", $cat);
		$query="DELETE FROM forum_cat WHERE ID=".mysql_real_escape_string($tmp[1]);
		$query_cat = mysql_query($query);
		
		if(!$query_cat)
		{
			$continuer=false;
			info("Un problème de traitement est survenu!", 0);
		}
		if($tmp[0] < $max && $continuer)
		{
			$query="UPDATE forum_cat SET RANG=RANG-1 WHERE RANG > ".mysql_real_escape_string($tmp[0]);
			$query_cat = mysql_query($query);
			
			if($query_cat)
			{
				//Si pas de problème.
				info("Suppression réalisée avec succès!", 1);
			}
			else{info("Un problème de traitement est survenu!", 0);}
     	}
		else if($continuer){info("Suppression réalisée avec succès!", 1);}
		mysql_close();
    }
    else{info("Un problème de connexion est survenu!", 0);}	
}
else if($_POST['mode'] == "edit_cat"){//Actions réalisées lors d'une édition d'une catégorie
	extract($_POST);
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$continuer = true;
		$query="UPDATE forum_cat SET LIBELLE='".mysql_real_escape_string(utf8_decode($nom)).
					"' WHERE ID=".mysql_real_escape_string($categorie);
		$query_cat = mysql_query($query);
		
		if(!$query_cat)
		{
			$continuer=false;
			info("Un problème de traitement est survenu!", 0);
		}
		if(($rang <= $max) && $continuer){//On décale tout d'un rang pour mettre la catégorie la bonne place.
			if($rg > $rang)
			{
				$query="UPDATE forum_cat SET RANG=RANG+1 WHERE RANG >= ".mysql_real_escape_string($rang);
			}
			else if($rg < $rang)
			{
				$query="UPDATE forum_cat SET RANG=RANG-1 WHERE RANG >= ".mysql_real_escape_string($rang);
			}
        	$query_cat = mysql_query($query);
      		if($query_cat)
      		{
      			//Si pas de problème.
				$query="UPDATE forum_cat SET RANG=".mysql_real_escape_string($rang).
							" WHERE ID=".mysql_real_escape_string($categorie);
        		$query_cat = mysql_query($query);
        		if($query_cat)
        		{
        			//Si pas de problème.       
					info("Edition réalisée avec succès!", 1);
				}
				else{info("Un problème de traitement est survenu!", 0);}
      		}
      		else{info("Un problème de traitement est survenu!", 0);}
     	}
     	else if($continuer){info("Edition réalisée avec succès!", 1);}
     	mysql_close();
    }
    else{info("Un problème de connexion est survenu!", 0);}	
}
else if($_POST['mode'] == "add_scat"){//Actions réalisées lors d'un ajout d'une sous-catégorie
	if(!empty($_POST['nom']) && !empty($_POST['desc']))
	{
		extract($_POST);
		if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
		{
			$continuer = true;
			if($rang < $max)
			{
				$query = "UPDATE forum_scat SET RANG=RANG+1 WHERE RANG>=".mysql_real_escape_string($rang);
				$query_cat = mysql_query($query);
				if(!$query_cat){$continuer=false;}
			}
			if($continuer)
			{ 
				$query = "INSERT INTO forum_scat (`LIBELLE`, `RANG`, `ID_CAT`, `DESC`)". 
			 				 "VALUES ('".mysql_real_escape_string(utf8_decode($nom)).
							 "', '".mysql_real_escape_string($rang).
							 "', '".mysql_real_escape_string($cat).
							 "', '".mysql_real_escape_string(utf8_decode($desc))."')";
			 
				$query_cat = mysql_query($query);
				if($query_cat)
				{
					//Si pas de problème.
					info("Ajout réalisé avec succès!", 1);
      			}
    		}
    		else{info("Un problème de traitement est survenu!", 0);}
     		mysql_close();
    	}
    	else{info("Un problème de connexion est survenu!", 0);}	
  	}
  	else{info("Veuillez remplir les champs correctement!", 0);}
}
else if($_POST['mode'] == "del_scat"){//Actions réalisées lors d'une suppression d'une sous-catégorie
	extract($_POST);
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$continuer = true;
		$tmp = explode("-", $scat);
		$max = $tmp[3];
		$query="DELETE FROM forum_scat WHERE ID=".mysql_real_escape_string($tmp[1]);
		$query_cat = mysql_query($query);
		
		if(!$query_cat)
		{
			$continuer=false;
			info("Un problème de traitement est survenu!", 0);
     	}
		if($tmp[2] < $max && $continuer)
		{
			$query="UPDATE forum_scat".
						" SET RANG=RANG-1 ".
			 			"WHERE RANG >= ".mysql_real_escape_string($tmp[2]).
						" AND ID_CAT=".mysql_real_escape_string($tmp[0]);
			$query_cat = mysql_query($query);
			if($query_cat)
			{
				//Si pas de problème.
				info("Suppression réalisée avec succès!", 1);
			}
      		else{info("Un problème de traitement est survenu!", 0);}
     	}
		else if($continuer){info("Suppression réalisée avec succès!", 1);}
		mysql_close();
	}
	else{info("Un problème de connexion est survenu!", 0);}	
}
elseif($_POST['mode'] == "reponse"){//Réponse à un topic
	extract($_POST);
	if(!empty($content))
	{
		 if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
		 {
			$query = "INSERT INTO forum_msg (`CONTENU`, `DATE_PUB`, `ID_TOPIC`, `ID_MEMBRE`)".
						  "VALUES ('".mysql_real_escape_string($content)."', '".time()."', '".mysql_real_escape_string($t_id)."', '".$_SESSION['id']."')";
			$query_cat = mysql_query($query);
			if($query_cat)
			{
				//Si pas de problème.
				info_forum("Message ajouté avec succès!", 1, $t_id);
			}
			else{	info_forum("Un problème de traitement est survenu!", 0, $t_id);	}
			mysql_close();
			}
			else{info_forum("Un problème de connexion est survenu!", 0, $t_id);}
	}
	else{info_forum("Votre message est vide!", 0, $t_id);}	 
}//Fin ajout_message
elseif($_POST['mode'] == "edit"){//Edition d'un message.
	extract($_POST);
	if(!empty($content))
	{
		 if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
		 {
			$query = "UPDATE forum_msg SET `CONTENU`='".mysql_real_escape_string($content)."' WHERE ID=".mysql_real_escape_string($msg_id);
			$query_cat = mysql_query($query);
			if($query_cat)
			{
				if($edit_titre)
				{
					//-On édite le tittre du topic---
					if(!empty($titre))
					{					
						$query = "UPDATE forum_topic SET `LIBELLE`='".mysql_real_escape_string(utf8_decode($titre))."' WHERE ID=".mysql_real_escape_string($t_id);
						$query_cat = mysql_query($query);
						if($query_cat)
						{
							//Si pas de problème.
							info_forum("Message édité avec succès!", 1, $t_id);
						}
						else
						{ 
							//Si le titre à échoué l'édition a partiellement réussie
							info_forum("Message partiellement édité !", 0, $t_id);	
						}
					}
					else
					{
						info_forum("Veuillez écrire un titre pour le sujet!", 0, $t_id);	
					}
					//---
				}
				else
				{			
					//Si pas de problème.
					info_forum("Message édité avec succès!", 1, $t_id);
				}
			}
			else{	info_forum("Un problème de traitement est survenu!", 0, $t_id);	}
			mysql_close();
			}
			else{info_forum("Un problème de connexion est survenu!", 0, $t_id);}
	}
	else{info_forum("Votre message est vide!", 0, $t_id);}	 
}
elseif($_POST['mode'] == "ajout_sujet"){//Ajout d'un sujet.
	extract($_POST);
	if(!empty($content) && !empty($titre))
	{
		if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
		{
			$query = "INSERT INTO forum_topic (LIBELLE, ID_SCAT) VALUES ('".mysql_real_escape_string(utf8_decode($titre))."', '".mysql_real_escape_string($s_id)."')";
			$query_cat = mysql_query($query);
			
			if($query_cat)
			{
				//-Si pas de problème---
				$query = "SELECT ID FROM forum_topic WHERE LIBELLE='".mysql_real_escape_string(utf8_decode($titre))."'";
				$query_cat = mysql_query($query);
				if($query_cat)
				{
					$r = mysql_fetch_object($query_cat);
					if(!empty($r))
					{
						$t_id = $r->ID;
						$query = "INSERT INTO forum_msg (`CONTENU`, `DATE_PUB`, `ID_TOPIC`, `ID_MEMBRE`)".
							  		  "VALUES ('".mysql_real_escape_string($content)."', '".time()."', '".mysql_real_escape_string($t_id)."', '".$_SESSION['id']."')";					
						$query_cat = mysql_query($query);
						if($query_cat)
						{
							//-Si pas de problème---
							info_forum("Sujet posté avec succès!", 1, $t_id);
						}
						else{	//-S'il y a eu une erreur de traitement on le redirige vcers l'index du forum---
								echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';		
								//---	
						}
					}
					else{	//-S'il y a eu une erreur de traitement on le redirige vcers l'index du forum---
							echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';		
							//---	
					}
				}
				else{	//-S'il y a eu une erreur de traitement on le redirige vcers l'index du forum---
						echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';		
						//---	
				}
			}
			else{	//-S'il y a eu une erreur de traitement on le redirige vcers l'index du forum---
					echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';		
					//---
			}
			mysql_close();
		}
		else{	//-S'il y a eu une erreur de traitement on le redirige vcers l'index du forum---
				echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';		
				//---	
		}
	}
	else{	//-Si l'utilisateur n'a pas rempli tous les champs on le redirige---
			echo '<script type="text/javascript">window.location.href="./?categorie=topic_ajout&s_id='.$_id.'";</script>';		
			//---
	}
}//Fin suppr_message
elseif($_GET['action'] == "suppr_sujet" || $_POST['action'] == "suppr_sujet" ){//Suppression d'un sujet.
	if($_SESSION['lvl'] > 0)
	{
		if(isset($_GET['action']) && !empty($_GET['action']))
		{
			extract($_GET);
		}
		else extract($_POST);
		if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
		{
			$query = "SELECT ID, count(ID) AS NB FROM forum_topic where ID=".mysql_real_escape_string($id);
			$query_cat = mysql_query($query);
			if($query_cat)
			{//Si pas de problème.
				$r = mysql_fetch_object($query_cat);
				if($r->NB == 1)
				{
					$query = "DELETE FROM forum_topic WHERE ID=".$r->ID;
					$query_cat = mysql_query($query);
					if($query_cat)
					{//Si pas de problème.
						info("Sujet supprimé avec succès!", 1);
					}
					else info("Un problème de traitement est survenu!", 0);
				}
				else info("Impossible de supprimer ce sujet !", 0);
			}
			else info("Un problème de traitement est survenu!", 0);
			mysql_close();
		}
		else info("Un problème de connexion est survenu!", 0);
	}
	else info("Vous ne pouvez pas supprimer ce message!", 0);
 }
else if($_POST['mode'] == "edit_scat"){//Actions réalisées lors d'une édition d'une catégorie
	extract($_POST);
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$continuer = true;
		$query="UPDATE forum_scat SET `LIBELLE`='".mysql_real_escape_string(utf8_decode($nom))."', `DESC`='".mysql_real_escape_string(utf8_decode($desc))."' WHERE ID=".mysql_real_escape_string($scat);
		$query_cat = mysql_query($query);
		
		if(!$query_cat)
		{
			$continuer=false;
			info("Un problème de traitement est survenu!", 0);
		}
		if(($rang <= $max) && $continuer){//On décale tout d'un rang pour mettre la catégorie la bonne place.
			if($rg > $rang)
			{
				$query="UPDATE forum_scat SET RANG=RANG+1 WHERE RANG >= ".mysql_real_escape_string($rang)." AND ID_CAT=".mysql_real_escape_string($id_cat);
			}
			else if($rg < $rang)
			{
				$query="UPDATE forum_scat SET RANG=RANG-1 WHERE RANG >= ".mysql_real_escape_string($rang)." AND ID_CAT=".mysql_real_escape_string($id_cat);
			}
        	$query_cat = mysql_query($query);
      		if($query_cat)
      		{
      			//Si pas de problème.
				$query="UPDATE forum_scat SET RANG=".mysql_real_escape_string($rang).
							" WHERE ID=".mysql_real_escape_string($scat);
        		$query_cat = mysql_query($query);
        		if($query_cat)
        		{
        			//Si pas de problème.       
					info("Edition réalisée avec succès!", 1);
				}
				else{info("Un problème de traitement est survenu!", 0);}
      		}
      		else{info("Un problème de traitement est survenu!", 0);}
     	}
     	else if($continuer){info("Edition réalisée avec succès!", 1);}
     	mysql_close();
    }
    else{info("Un problème de connexion est survenu!", 0);}	
}
	
?>