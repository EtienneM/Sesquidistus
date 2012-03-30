<?php
/*
 * Fonctions utiles à la galerie vidéo
*/

// Suppression d'un vidéo dans la DB
function delVideo($id_db_video_a_del, $sql) {
	$query = "DELETE FROM videos WHERE id_video=\"" . $id_db_video_a_del . "\"";

	if($sql->connection()) {
		//echo "Connexion réussie !";
		if($sql->execute($query)){
			//echo "<br>Requete bien executée!";
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }

		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }
    
	return $erreur;
}

// ajout d'un dossier vidéo dans la DB
function ajouterDossier($nom_dossier, $sql) {
	$query = "INSERT INTO dossiers_video(nom_dossier) VALUES (\"" . addslashes($nom_dossier) . "\")";
    
	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br>Requete bien executée!";
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
      
		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }
	
	return $erreurs;
}

// Suppression d'un dossier vidéo dans la DB
function delDossier($id_dossier, $sql, $sql2) {
	// Suppression des vidéos du dossier
	$query = "SELECT * FROM videos WHERE id_dossier = " . $id_dossier;
   
	if ($sql->connection()) {
		if ($sql->execute($query)) {
			while ($s = $sql->getObjectResult()) {
				delVideo($s->id_video, $sql2);
			}
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }

	// Suppression du dossier
	$query = "DELETE FROM dossiers_video WHERE id_dossier=\"" . $id_dossier . "\"";

	if($sql->connection()) {
		//echo "Connexion réussie !";
		if($sql->execute($query)){
			//echo "<br>Requete bien executée!";
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }

		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }

	return $erreur;
}

// Affiche une liste déroulante de choix des dossiers vidéos existants dans la DB
function listeDossier($sql) {
	$query = "SELECT * FROM dossiers_video WHERE id_dossier != 1 AND id_dossier != 0";
	
	if ($sql->connection()) {
		if ($sql->execute($query)) {
			echo "<select id=\"listeDossier\" name=\"listeDossier\">\n";
			while ($s = $sql->getObjectResult()) {
				echo "<option value=\"" . $s->id_dossier . "\">" . stripslashes($s->nom_dossier) . "</option>";
			}
			echo "</select>";
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }

		/*if ($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}*/
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }
	
	return $erreur;
}

// Déplacement d'une vidéo vers un dossier vidéo
function moveToDossier($id_video, $id_dossier, $sql) {
	$query = "UPDATE videos SET id_dossier = " . $id_dossier . " WHERE id_video = " . $id_video;

	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br>Requete bien executée!";
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }

		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }

	return $erreur;
}

// Retourne l'ID d'un dossier dans la DB
function getIdDossier($nom_dossier, $sql) {
	$query = 'SELECT id_dossier FROM dossiers_video WHERE nom_dossier="' . $nom_dossier . '"';
	
	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br>Requete bien executée!";
			while ($s = $sql->getObjectResult()) {
				$res = $s->id_dossier;
			}
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
		
		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }
	
	return $res;
}

// Retourne l'image de a première vidéo dans le dossier
function selectFirstVideoDossier($id_dossier, $sql) {
	$query = "SELECT * FROM videos WHERE id_dossier = " . $id_dossier . " LIMIT 1";

	if ($sql->connection()) {
		if ($sql->execute($query)) {
			while ($s = $sql->getObjectResult()) {
				$res = $s->image;
			}
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
        
		/*if($sql->close()) {
            //echo "<br>Déconnexion réussie!";
		}*/
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }
    
	return $res;
}

// Vérifie si le dossier existe dans la DB
function verif_if_dossier_exist($sql, $nom_dossier) {
	$query = 'SELECT id_dossier FROM dossiers_video WHERE nom_dossier = "' . $nom_dossier . '"';
	$res = TRUE;
	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br>Requete bien executée!";
			$s = $sql->getObjectResult();
			if ($s == NULL) {
				$res = FALSE;
			}
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
		
		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :" . $sql->getError(); }
	
	return $res;
}

// Vérifie si la vidéo existe dans la DB
function verif_if_video_exist($sql, $id) {
	$query = 'SELECT id_video FROM videos WHERE id = "' . $id . '"';
	$res = TRUE;
	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br>Requete bien executée!";
			$s = $sql->getObjectResult();
			if ($s == NULL) {
				$res = FALSE;
			}
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
		
		if($sql->close()) {
			//echo "<br>Déconnexion réussie!";
		}
	}
	else { $erreur = "Connexion échouée :" . $sql->getError(); }
	
	return $res;
}

// Fonction utilisé lors de la soumission d'un vidéo
// Récupère les informations sur la vidéo chez l'hébergeur
function getVideoInfo($url){
	$type = "";
	$id = -1;
	$titre = "no title";
	$description = "no description";
	$code = "no code";
	$img = "no image";
	
	if (preg_match("/\byoutube\b/i", $url)) $type="youtube";
	else if (preg_match("/\bdailymotion\b/i", $url)) $type="dailymotion";
	else return false;
	
	//Détermination de l'"ID" de la vidéo :
	if($type=="youtube"){
		$debut_id = explode("v=",$url,2);
		$id_et_fin_url = explode("&",$debut_id[1],2);
		$id = $id_et_fin_url[0];
	}
	else if($type=="dailymotion"){
		$debut_id = explode("/video/",$url,2);
		$id_et_fin_url = explode("_",$debut_id[1],2);
		$id = $id_et_fin_url[0];
	}
    
	//Analyse et stockage des informations de la vidéo
	if($type=="youtube"){
		$xml = @file_get_contents("http://gdata.youtube.com/feeds/api/videos/". $id);
		
		//titre
		preg_match('#<title(.*?)>(.*)<\/title>#is',$xml,$resultTitre);
		$titre = addslashes($resultTitre[count($resultTitre)-1]);
		
		//description
		preg_match("#<content(.*?)>(.*)<\/content>#is",$xml,$resultDescription);
		$description = addslashes($resultDescription[count($resultDescription)-1]);
		
		//Image
		$img = "http://img.youtube.com/vi/".$id."/1.jpg";
		
		//Code HTML			
		$code =	'<object class="video" width="700" height="500">' .
				'<param name="movie" value="http://www.youtube.com/v/'.$id.'&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param>' .
				'<param name="allowFullScreen" value="true"></param>' .
				'<param name="allowScriptAccess" value="always"></param>' .
				'<embed class="video" src="http://www.youtube.com/v/'.$id.'&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed>' .
    			'</object>';
	}
	else if ($type=="dailymotion"){
		$tags = get_meta_tags("http://www.dailymotion.com/video/".$id);
		
		//titre
		$t = explode(" - ", addslashes(trim(str_replace("Dailymotion -","",$tags["title"]))));
		$titre = str_replace('"','', $t[0]);
		
		//description
		$description = addslashes($tags["description"]);
		
		//image 
		$feedURL = 'http://www.dailymotion.com/atom/video/'.$id;
		$sxml = @simplexml_load_file($feedURL);
		$linksurl = $sxml->entry->children();
		$split_data = explode('http://ak2.static.dailymotion.com/static/video/', $linksurl[7]);
		$get_img_url = explode(':jpeg_preview_medium.jpg?', $split_data[1]);
		$img = 'http://ak2.static.dailymotion.com/static/video/'.$get_img_url[0].':jpeg_preview_large.jpg';
		
		// code HTML
		$code = '<object class="video" width="700" height="500">' .
    			'<param name="movie" value="http://www.dailymotion.com/swf/video/'.$id.'?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param>' .
    			'<param name="allowFullScreen" value="true"></param>' .
    			'<param name="allowScriptAccess" value="always"></param>' .
    			'<embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/'.$id.'?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed>' .
				'</object>';

	}
    
	return array("id"=>$id,"type"=>$type,"titre"=>$titre,"description"=>$description,"img"=>$img,"code"=>$code);
}
?>