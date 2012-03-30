<?php
/*
 * Ce fichier regroupe les différentes instructions
 * pour générer les différents miniatures du membre.
 *
 * Auteur : -
 */


	//-Fichier de fonctions liée à la galerie---
	include("./modules/galerie/fonctions.php");
	// Objet MySQL
	include("./config/mysql.class.php");
	//-Configuration des variables de liaison avec la DB---
	include("./config/mysql.php");
	
	$sql = new MySQL($host, $user, $passwd, $bdd);
	$sql2 = new MySQL($host, $user, $passwd, $bdd);
	
	$dir_mini = "./modules/membres/mini_avatar";
	$dir = "./modules/membres/avatar";
	
	//-div dialog---
	echo '<div id="changeImg" title="Changer sa photo de profil:" style="display: none;">'.
				'<form action="./?categorie=avatar" method="post" enctype="multipart/form-data">'.
					'<p>Veuillez sélectionner votre nouvel avatar : <br/><br/> <input type="file" name="mon_image" /></p>'.
					'<input type="submit" class="bouton1" id="go" name="go" value="Envoyer" style="float: right;"/> <br /><br />'.
				'</form>'.
			'</div>';
	//---
	
	//On teste si le formulaire permettant d'uploader un fichier a été soumis---
	if (isset($_POST['go']))
	{
		//-On ajoute les fonctions utiles du module---
		include("./modules/membres/fonctions.php");
	
		//-On teste si le champ permettant de soumettre un fichier est vide ou non---
		if(empty($_FILES['mon_image']['tmp_name']))
		{
			//-si oui, on affiche un petit message d'erreur---
			profil_form("Edition du profil : changement d'avatar","Aucun fichier envoyé!", 0);
			//---
		}
		else 
		{
			//-On examine le fichier uploadé en récupérant de nombreuses informations sur ce fichier (cf la documentation de la fonction)---
			$tableau = @getimagesize($_FILES['mon_image']['tmp_name']);
			if($tableau == FALSE)
			{
				//-Si le fichier uploadé n'est pas une image, on efface le fichier uploadé et on affiche un petit message d'erreur---
				unlink($_FILES['mon_image']['tmp_name']);
				profil_form("Edition du profil : changement d'avatar","Votre fichier n'est pas une image!", 0);
			}
			else
			{
				//-On teste le type de notre image : jpeg ou png---
				if ($tableau[2] == 2 || $tableau[2] == 3)
				{
					//-Attribution des noms
					$file_upload1 = $_SESSION['login'];
					$file_upload2 = "mini_" . $_SESSION['login'];
	
					//-Creation de la mini 25x25---
					if ($tableau[2] == 2 || $tableau[2] == 3)
					{
						//-On crée une image à partir de notre grande image à l'aide de la librairie GD---
						if ($tableau[2] == 3){
							$src = imagecreatefrompng($_FILES['mon_image']['tmp_name']);
						}
						else{
							$src = imagecreatefromjpeg($_FILES['mon_image']['tmp_name']);
						}
						
						$im = imagecreatetruecolor(25, 25);
						imagecopyresampled($im, $src, 0, 0, 0, 0, 25, 25, $tableau[0], $tableau[1]);
						
						//-On copie notre fichier généré dans le répertoire des miniatures---
						if($tableau[2] == 2){
							$file_upload2 = $file_upload2.".jpg";
							imagejpeg ($im, $dir_mini . "/" . $file_upload2);
						}
						else if($tableau[2] == 3){
							$file_upload2 = $file_upload2.".png";
							imagepng ($im, $dir_mini . "/" . $file_upload2);
						}
					}
					
					//-Creation de la photo---
					if ($tableau[2] == 2 || $tableau[2] == 3)
					{
						if ($tableau[2] == 3){
							$src = imagecreatefrompng($_FILES['mon_image']['tmp_name']);
						}
						else{
							$src = imagecreatefromjpeg($_FILES['mon_image']['tmp_name']);
						}
						$im = imagecreatetruecolor(120, 140);
						imagecopyresampled($im, $src, 0, 0, 0, 0, 120, 140, $tableau[0], $tableau[1]);
						
						if($tableau[2] == 2){
							$file_upload1 = $file_upload1.".jpg";
							imagejpeg ($im, $dir . "/" . $file_upload1);
						}
						else if($tableau[2] == 3){
							$file_upload1 = $file_upload1.".png";
							imagepng ($im, $dir . "/" . $file_upload1);
						}
					}
	
					#############################################
					## Mise à jour des champs dans la table profil
					#############################################
	
					$link_avatar = $dir."/".$file_upload1;
					$link_mini = $dir_mini."/".$file_upload2;
					$query = 'UPDATE profil SET AVATAR = "' . $link_avatar . '", AVATAR_MIN = "' . $link_mini . '" WHERE ID_MEMBRE = ' . $_SESSION['id'];
	
					if($sql->connection()) {
						//echo "Connexion réussie !";
						//$sql->setDb($bdd);
						if($sql->execute($query)){
							//echo "<br>Requete bien executée!";
							profil_form("Edition du profil : changement d'avatar", "Votre image a été changée avec succès!", 1);
						}                  
						else{ $erreur = "Erreur: ".$sql->getError(); }
	
	                    if($sql->close()) { 
							//echo "<br>Déconnexion réussie!";
						}
					}
					else { $erreur = "Connexion échouée :".$sql->getError(); }
				}
				else {
					// si notre image n'est pas de type jpeg ou png, on supprime le fichier uploadé et on affiche un petit message d'erreur
					unlink($_FILES['mon_image']['tmp_name']);
					profil_form("Edition du profil : changement d'avatar", "Votre image est d'un format non supporté!", 0);
				}
			}
		}
	}
?>