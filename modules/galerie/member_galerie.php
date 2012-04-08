<?php
/*
 * Interface de soumission de photo et de vidéo
*/

if(isset($_SESSION['id']) && ($_SESSION['lvl']==0 || $_SESSION['lvl']==1)) {

	// Fichier de fonctions liée à la galerie
	include("./modules/galerie/fonctions.php");
	include("./modules/video/fonctions.php");
	// Configuration de la galerie
	include("./config/config_galerie.php");
	// Objet MySQL
	include("./config/mysql.class.php");
	// Configuration des variables de liaison avec la DB
	include("./config/mysql.php");

	$sql = new MySQL($host, $user, $passwd, $db);
?>

<?php

	// Soumission de photo
	if (isset($_POST['go_photo'])) {
		// on teste si le champ permettant de soumettre un fichier est vide ou non
		if (empty($_FILES['mon_image']['tmp_name'])) {
			// si oui, on affiche un petit message d'erreur
			$erreur = 'Aucun fichier envoyé.';
		}
		else {
			// on examine le fichier uploadé en récupérant de nombreuses informations sur ce fichier
			$tableau = @getimagesize($_FILES['mon_image']['tmp_name']);
			if ($tableau == FALSE) {
				// si le fichier uploadé n'est pas une image, on efface le fichier uploadé et on affiche un petit message d'erreur
				unlink($_FILES['mon_image']['tmp_name']);
				$erreur = "Votre fichier n'est pas une image.";
			}
			else {
				// on teste le type de notre image : jpeg ou png
				if ($tableau[2] == 2 || $tableau[2] == 3) {
					// si on a déjà  un fichier qui porte le mÃªme nom que le fichier que l'on tente d'uploader, on modifie le nom du fichier que l'on upload
					if (is_file("./picture/" . $_FILES['mon_image']['name'])) { $file_upload = "_" . $_FILES['mon_image']['name']; }
					else { $file_upload = $_FILES['mon_image']['name']; }
					// on copie le fichier que l'on vient d'uploader dans le répertoire des images de grande taille
					copy ( $_FILES['mon_image']['tmp_name'], $dir . "/" . $file_upload);

					##############################
					## Génération des miniatures
					##############################

					// si notre image est de type jpeg
					if ($tableau[2] == 2 || $tableau[2] == 3) {
						// on crée une image Ã  partir de notre grande image Ã  l'aide de la librairie GD
						if ($tableau[2] == 3) {
							$src = imagecreatefrompng($dir . "/" . $file_upload);
						}
						else {
							$src = imagecreatefromjpeg($dir . "/" . $file_upload);
						}
						// on teste si notre image est de type paysage ou portrait
						if ($tableau[0] > $tableau[1]) {
							$ratio=150;
							$im = imagecreatetruecolor($ratio, round($tableau[1]/($tableau[0]/$ratio)));
							imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio, round($tableau[1]/($tableau[0]/$ratio)) ,$tableau[0], $tableau[1]);
						}
						else {
							$ratio=120;
							$im = imagecreatetruecolor(round($tableau[0]/($tableau[1]/$ratio)), $ratio);
							imagecopyresampled($im, $src, 0, 0, 0, 0, round($tableau[0]/($tableau[1]/$ratio)),$ratio, $tableau[0], $tableau[1]);
						}
						// on copie notre fichier généré dans le répertoire des miniatures
						if($tableau[2] == 2) { //jpg
							imagejpeg ($im, $dir_mini . "/" . $file_upload);
						}
						
						if($tableau[2] == 3) { //png
							imagepng ($im, $dir_mini . "/" . $file_upload);
						}
					}

					#############################################
					## création de la ligne dans la table images
					#############################################

					$nom_image = $_FILES['mon_image']['name'];
					$link_picture = "./picture/" . $_FILES['mon_image']['name'];
					$link_mini = "./mini/" . $_FILES['mon_image']['name'];
					$height = $tableau[1];
					$width = $tableau[0];
					$description = $_POST['ma_description'];
					if ( strlen($description) != 0 ) {
						$query = "INSERT INTO images(nom_image, link_picture, link_mini, height, width, description) VALUES (\"" . $nom_image . "\", \"" . $link_picture . "\", \"" . $link_mini . "\", " . $height . ", " . $width . ", \"" . $description . "\")";
					}
					else {
						$query = "INSERT INTO images(nom_image, link_picture, link_mini, height, width) VALUES (\"" . $nom_image . "\", \"" . $link_picture . "\", \"" . $link_mini . "\", " . $height . ", " . $width . ")";
					}

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
				else {
					// si notre image n'est pas de type jpeg ou png, on supprime le fichier uploadé et on affiche un petit message d'erreur
					unlink($_FILES['mon_image']['tmp_name']);
					$erreur = "Votre image est d'un format non supporté.";
				}
			}
		}
	}

	// Soumission de vidéo
	if (isset($_POST['go_video'])) {
		if (empty($_POST['lien'])) {
			$erreur = 'Aucun lien envoyé.';
		}
		else {
			$lien = $_POST['lien'];
			$video = getVideoInfo($lien);
			if ($video['type'] == "") {
				$erreur = 'Type de vidéo non valide';
			}
			else if ($video['id'] == "") {
				$erreur = 'Lien invalide';
			}
			else {
				$query = "INSERT INTO videos(type, id, titre, description, code, image) VALUES ('" . $video["type"] . "', '" . $video["id"] . "', '" . $video["titre"] . "', '" . $video["description"] . "', '" . $video["code"] . "', '" . $video["img"] . "')";
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
		}
	}
?>

<div><a href="?categorie=galerie"><span class="bouton1">Galerie Photo</span></a>
<a href="?categorie=galerie_video"><span class="bouton1">Galerie Video</span></a></div>
<br />
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Soumettre une image</div>
		<!-- on affiche un formulaire permettant d'uploader une image -->

		<form action="?categorie=member_galerie" method="post" enctype="multipart/form-data">
			<p>
				Veuillez sélectionner votre image : <input type="file" name="mon_image" /> <br />
				Entrez une description (facultatif) : <input type="text" name="ma_description" />
			</p>
			<input type="submit" class="bouton1" name="go_photo" value="Envoyer" style="float: right;"/> <br /><br />
		</form>
		<div style="position: absolute; top: 0px; right: 0px;"><a target="_blank" href="./doc/doc_galerie/doc_galerie.html#submit_photo"><img style="width: 25px;" alt="aide" src="./images/help.png"></a></div>
   </div>
   <br />
   <div class="box">
    	<div class="titreNews">Soumettre une video</div>
		<form action="?categorie=member_galerie" method="post" enctype="multipart/form-data">
    		<span style="font-style:italic">Uniquement les vidéos Youtube et Dailymotion</span>
			<p>
				Entrez l'adresse url de la vidéo : <input type="text" name="lien" />
        	</p>
			<input type="submit" class="bouton1" name="go_video" value="Envoyer" style="float: right;"/> <br /><br />
		</form>
		<div style="position: absolute; top: 0px; right: 0px;"><a target="_blank" href="./doc/doc_galerie/doc_galerie.html#submit_video"><img style="width: 25px;" alt="aide" src="./images/help.png"></a></div>
	</div>
</div>    
<?php
	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) echo '<br />' , $erreur;
}
else { // sinon afficher le message d'erreur
?>
	<div class="totalBox">
		<div class="box">
			<div class="titreNews">Erreur :</div>
			<span>Cette page est uniquement accessible aux administrateurs du site...</span>
		</div>
	</div>
<?php
}	
?>
