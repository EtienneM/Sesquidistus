<?php
/*
 * Fonctions utiles à la galerie photo
*/

// Récupère la largeur d'une photo dans la DB
function getImgWidth($linkImg, $sql) {
	$query = "SELECT width FROM images WHERE link_picture = \"" . $linkImg . "\"";
	if($sql->connection()) {
		if($sql->execute($query)){
			while($r = $sql->getRowResult()){
				$res = $r['width'];
			}
		}
		else{ $erreur = "Erreur: " . $sql->getError(); }
      $sql->close();
	}
	else { $erreur = "Connexion échouée :" . $sql->getError(); }
	//$sql->free();
	
	return $res;
}

// Récupère la hauteur d'une photo dans la DB
function getImgHeight($linkImg, $sql) {
	$query = "SELECT height FROM images WHERE link_picture = \"" . $linkImg . "\"";
	if($sql->connection()) {
		if($sql->execute($query)){
			while($r = $sql->getRowResult()){
				$res = $r['height'];
			}
		}
		else{ $erreur = "Erreur: ".$sql->getError(); }
                $sql->close();
	}
	else { $erreur = "Connexion échouée :".$sql->getError(); }
	//$sql->free();
	
	return $res;
}

// Supprime une image dans la DB et dans les fichiers
function delImg($pic_a_del, $dir_mini, $dir, $sql) {
    // si l'image existe ainsi que sa miniature, on les supprime
    if (is_file($dir_mini . "/" . $pic_a_del) && is_file($dir . "/" . $pic_a_del)) {
        // Suppression de la photo et sa miniature dans les dossiers picture et mini
		unlink($dir_mini . "/" . $pic_a_del);
        unlink($dir . "/" . $pic_a_del);

        // Suppression de la photo dans la DB
        $query = "DELETE FROM images WHERE nom_image=\"" . $pic_a_del . "\"";
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
    }
    // si l'image ou la miniature n'existe pas, on affiche un message d'erreur
    else {
        $erreur = "Image non reconnue";
    }
    return $erreur;
}

// Ajoute un albumd dans la DB
function ajouterAlbum($nom_album, $sql) {
    $query = "INSERT INTO albums(nom_album) VALUES (\"" . addslashes($nom_album) . "\")";
    
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

// Supprime un album  dans la DB et les photos dans cet album
function delAlbum($id_album, $sql, $dir_mini, $dir, $sql2) {

   // Suppression des photos dans cet album
	$query = "SELECT * FROM images WHERE id_album = " . $id_album;
    if ($sql->connection()) {
        if ($sql->execute($query)) {
            while ($s = $sql->getObjectResult()) {
					delImg(addslashes($s->nom_image), $dir_mini, $dir, $sql2);
            }
        }
        else{ $erreur = "Erreur: ".$sql->getError(); }
    }
    else { $erreur = "Connexion échouée :".$sql->getError(); }

	// Suppression de l'album dans la DB
    $query = 'DELETE FROM albums WHERE id_album="' . $id_album . '"';
	 echo $query;
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

// Selectionne la première image dans un album
function selectFirstImgAlbum($id_album, $sql) {
    $query = "SELECT * FROM images WHERE id_album = " . $id_album . " LIMIT 1";

    if ($sql->connection()) {
        if ($sql->execute($query)) {
            while ($s = $sql->getObjectResult()) {
                $res = $s->nom_image;
            }
        }
        else{ $erreur = "Erreur: ".$sql->getError(); }
        
//        if($sql->close()) {
//            //echo "<br>Déconnexion réussie!";
//        }
    }
    else { $erreur = "Connexion échouée :".$sql->getError(); }
    
    return $res;
}

// Affiche la liste des albums dans liste déroulante de choix
function listeAlbum($sql) {
	$query = "SELECT * FROM albums WHERE id_album != 1 AND id_album != 0";
	
    if ($sql->connection()) {
        if ($sql->execute($query)) {
            echo "<select id=\"listeAlbum\" name=\"listeAlbum\">\n";
            while ($s = $sql->getObjectResult()) {
				echo "<option value=\"" . $s->id_album . "\">" . stripslashes($s->nom_album) . "</option>";
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

// Déplace une photo vers l'album ciblé
function moveToAlbum($nom_image, $id_album, $sql) {
    $query = "UPDATE images SET id_album = " . $id_album . " WHERE nom_image = \"" . $nom_image ."\"";

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

// Retourne l'ID de l'album dans la DB
function getIdAlbum($nom_album, $sql) {
	$query = 'SELECT id_album FROM albums WHERE nom_album="' . $nom_album . '"';
	
	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br>Requete bien executée!";
			while ($s = $sql->getObjectResult()) {
                $res = $s->id_album;
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

// Vérifie un album existe dans la DB
function verif_if_album_exist($sql, $nom_album) {
	$query = 'SELECT id_album FROM albums WHERE nom_album = "' . $nom_album . '"';
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
	else { $erreur = "Connexion échouée :".$sql->getError(); }
	
	return $res;
}

?>