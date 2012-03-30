<?php
 
//-Inclusion des paramètres de la BDD.---
include("./config/mysql.php");
//---
 
//-On include les fonctions utiles---
include("./modules/forum/fonctions.php");
//---

//-Div qui va nous servir en cas de défaut---
 echo '<div id="remp_attr" title="Attention" style="display: none;">'.
        	'<p>Veuillez remplir tous les champs svp!</p>'.
      	 '</div>';
//---

 if(!isset($_SESSION['login']) && empty($_SESSION['login'])){
 	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
 }
//-On test si la sous-caégorie existe bien---
else if(isset($_GET['s_id']) && is_numeric($_GET['s_id']) && $_GET['s_id'] >= 0)
{    
	$s_id = $_GET['s_id'];
	
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$req = "SELECT scat.ID AS SCAT_ID, scat.LIBELLE AS SCAT_LIBELLE ".
				   "FROM forum_scat scat WHERE ID=".mysql_real_escape_string($s_id);
	    $query = mysql_query($req);
	    if($query)
	    {
	   		//-On réquère l'objet résultat---
			$r = mysql_fetch_object($query);
			//---
				
			//-S'il s'agit d'un mauvais topic on redirige sur la page d'index du forum.---
			if(empty($r->SCAT_ID)){echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';}
			//---
	
			//-On génère l'arborescence---
			echo '<div class="arbo">'.
						'<a href="./?categorie=forum"><span class="bouton1">Index Forum</span></a>'.
							'&nbsp;&nbsp;>'.
						'<a href="?categorie=topics&scat='.$r->SCAT_ID.'"><span class="bouton1">'.utf8_encode(stripslashes($r->SCAT_LIBELLE)).'</span></a>'.
					'</div><br/>';
			//---
			mysql_free_result($query);
			
			//-Inclusion de TinyMCE.---
			echo '<script type="text/javascript" src="./tinymce/jquery.tinymce.js"></script>';					
			echo '<script type="text/javascript" src="./modules/forum/topic_tinymce.js"></script>';
			//---

						
			//-Box Rép & Edition---
			echo '<div class="box_mce">'.
						'<form id="ajout_topic" method="POST" action="./?categorie=actions_forum">'.
							'<div class="bouton2 dataForm2">'.
									'Titre du topic: <input type="text" size="50" name="titre" id="titre" />'.
							 '</div><br/>'.
							 '<div class="bouton2 dataForm2">'.
									'Contenu du message:'.
							 '</div><br/>'.
								'<div>'.
									'<textarea id="elm1" name="content" rows="20" cols="40" class="tinymce"></textarea>'.
								'</div>'.
								'<div class="boutons_mce">'.
					  				'<input type="hidden" value="'.$s_id.'" name="s_id" />'.
					  				'<input type="hidden" value="ajout_sujet" name="mode" />'.
					  				'<input type="submit" value="Poster" class="bouton1" id="poster"/>'.
									'<input type="reset" value="Tout effacer" class="bouton1" id="reset" />'.
								'</div>'.
							  '</form>'.
						   '</div>';	
			//---
			echo '<script type="text/javascript" src="./modules/forum/ajout_topic.js"></script>';
	    }
	    else
	    {
	    	//-Si erreur de traitement on redirige vers l'index du forum---
	    	echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
	    	//---
	    }
	    mysql_close();
	}
	else
	{
	   	//-Si erreur de connexion on redirige vers l'index du forum---
	   	echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
	   	//---
	}
}
else
{
	//-Si erreur de sous-catégorie on redirige vers l'index du forum---
	echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
	//---
}
?>