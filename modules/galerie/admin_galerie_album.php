<?php
/*
 * Administration des photos d'un album
*/


if(isset($_SESSION['id']) && $_SESSION['lvl']==1 && strtolower($_GET['album'])!="default"){


	// Fichier de fonctions liée à la galerie
	include("./modules/galerie/fonctions.php");
	// Configuration de la galerie
	include("./config/config_galerie.php");
	// Objet MySQL
	include("./config/mysql.class.php");
	// Configuration des variables de liaison avec la DB
	include("./config/mysql.php");

	$sql = new MySQL($host, $user, $passwd, $db);
	$sql2 = new MySQL($host, $user, $passwd, $db);

	$element = $_GET['album'];
	$id_album = getIdAlbum($element, $sql);
	
	if (verif_if_album_exist($sql, $element)) { // Si le nom de l'album existe dans la DB
?>

<?php
		$query = 'SELECT * FROM images WHERE id_album = (SELECT id_album FROM albums WHERE nom_album = "' . $_GET['album'] . '")';
		$tableau = array();

		if ($sql->connection()) {
			//echo "Connexion réussie !";
			if ($sql->execute($query)) {
				//echo "<br />Requete bien executée!<br />";
				echo '<form id="form" action="?categorie=admin_galerie_album&album=' . htmlspecialchars(stripslashes($element)) . '" method="post"/>' . "\n";
				echo '<div style="display: block;"><a href="?categorie=admin_galerie" style="float: right"><span class="bouton1">Retour aux albums</span></a></div><br /><br />' . "\n";
				echo '<div class="bouton2 dataForm">' . "\n";
				echo '<input type="radio" name="action" id="radio_del" value="delete"/>' . 'Supprimer une(des) photo(s)' . '<span style="margin-left:30px;"/>' . "\n";
				echo '<input type="radio" name="action" id="radio_move" value="move"/>' . 'Déplacer une(des) photo(s) vers ' . "\n";
				listeAlbum($sql2);
				echo "\n" . '<input type="button" class="bouton1" id="Valider" name="Valider" value="Valider" style="float:right;"/>';
				echo '</div>';
?>
<br />
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Administration de l'album "<?php echo stripslashes(stripslashes($element));?>"</div>
<?php
				$ok = false;
				echo '<table id="imageContainer" style="margin-left:auto;margin-right:auto;">' . "\n";
				for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
					$ok = true;
					$nom_image = $s->nom_image;
					if($i % $nbColonne == 0) {
						echo '<tr>' . "\n";
					}
					echo '<td id="' . $nom_image . '">' . "\n";
						echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><img src="' . $dir_mini . '/' . addslashes($nom_image) . '" alt="' . $nom_image . '" /></div>' . "\n";
						
						// Si le nom de l'image est trop long, on affiche qu'un morceau
						if (strlen($nom_image) > 12) {
							echo '<div style="padding-top: 15px;"><span title="' . $nom_image . '">' . substr($nom_image,0,10) . '.. <input type="checkbox" name="del[]" value="' . $nom_image . '"/></span></div>' . "\n";
						}
						else {
							echo '<div style="padding-top: 15px;"><span title="' . $nom_image . '">' . $nom_image . '<input type="checkbox" name="del[]" value="' . $nom_image . '"/></span></div>' . "\n";
						}
						echo '</div>';
					echo '</td>' . "\n";
					if($i % $nbColonne == ($nbColonne - 1)) {
						echo '</tr>' . "\n";
				   }
				}
				echo '</table>' . "\n";
				if ($s == NULL && !($ok)) {
					echo "Il n'y a pas d'images dans cet album";
				}
			}
			else { $erreur = 'Erreur: ' . $sql->getError(); }

			if($sql->close()) {
				//echo "<br />Déconnexion réussie!";
			}
		}
		else { $erreur = 'Connexion échouée : ' . $sql->getError(); }
?>
		<div style="position: absolute; top: 0px; right: 0px;"><a target="_blank" href="./doc/doc_galerie/doc_admin_galerie.html"><img style="width: 25px;" alt="aide" src="./images/help.png"></a></div>
	</div>
</div>

<?php
				echo '</form>';
				
		// Dialog de confirmation de suppression de photos
		echo '<div id="confirmationDelete" title="Confirmation" style="display: none;">' . "\n";
			echo '<p>Etes vous sur de vouloir supprimer cette(ces) photo(s) ?</p>' . "\n";
		echo '</div>' . "\n";

		// Dialog de confirmation de déplacement de photos
		echo '<div id="confirmationMove" title="Confirmation" style="display: none;">' . "\n";
			echo '<p>Etes vous sur de vouloir déplacer cette(ces) photo(s) ?</p>' . "\n";
		echo '</div>' . "\n";
	
		// Accordion d'ajout d'un photo dans cet album
		echo '<div id="accordion">';
			echo '<h4 class="header titreSaison"><span>Ajouter une image à cet album</span></h4>';
			echo '<div class="box2" style="vertical-align:left;">';
				echo '<form action="?categorie=admin_galerie_album&album=' . htmlspecialchars(stripslashes($element)) . '" method="post" enctype="multipart/form-data">';
				echo '<p>';
					echo 'Veuillez sélectionner votre image : <input type="file" name="mon_image" /> <br />';
					echo 'Entrez une description (facultatif) : <input type="text" name="ma_description" />';
				echo '</p>';
				echo '<input type="submit" class="bouton1" id="go" name="go" value="Envoyer" style="float: right;"/> <br /><br />';
				echo '</form>';
			echo '</div>';
		echo '</div>';
?>

<?php
		// Traitement sur les photos
		if (isset($_POST['action'])) {
			if ( $_POST['action'] == "delete" ) { // suppression de photos
				if (count($_POST['del'])>0) {
					$tableau = $_POST['del'];
					foreach($tableau as $nom_photo) {
						delImg($nom_photo, $dir_mini, $dir, $sql);
					}
					echo '<script language="Javascript">';
					echo 'document.location.replace("?categorie=admin_galerie_album&album=' . $element . '");';
					echo '</script>';
				}
				else {
					echo "Aucune photo à été sélectionné pour la suppression";
				}
			}
			else if ( $_POST['action'] == "move") { // déplacement de photos
				if (count($_POST['del'])>0) {
					$tableau = $_POST['del'];
					foreach($tableau as $nom_photo) {
						moveToAlbum($nom_photo, $_POST['listeAlbum'], $sql);
					}
					echo '<script language="Javascript">';
					echo 'document.location.replace("?categorie=admin_galerie_album&album=' . $element . '");';
					echo '</script>';
				}
				else {
					echo "Aucune photo à été sélectionné pour le déplacement";
				}
			}
		}

		// on teste si le formulaire permettant d'uploader un fichier a été soumis
		if (isset($_POST['go'])) {
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
						// si on a déjà un fichier qui porte le même nom que le fichier que l'on tente d'uploader, on modifie le nom du fichier que l'on upload
						if (is_file("./picture/" . $_FILES['mon_image']['name'])) { $file_upload = "_" . $_FILES['mon_image']['name']; }
						else { $file_upload = $_FILES['mon_image']['name']; }

						// on copie le fichier que l'on vient d'uploader dans le répertoire des images de grande taille
						copy ($_FILES['mon_image']['tmp_name'], $dir . "/" . $file_upload);

						##############################
						## Génération des miniatures
						##############################
						
						if ($tableau[2] == 2 || $tableau[2] == 3) {
							// on crée une image à partir de notre grande image Ã  l'aide de la librairie GD
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
							if($tableau[2] == 2){ //jpg
								imagejpeg ($im, $dir_mini . "/" . $file_upload);
							}
							
							if($tableau[2] == 3){ //png
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
						
						if (strlen($description) != 0) { // si il y a une description
							$query = 'INSERT INTO images(nom_image, link_picture, link_mini, height, width, description, id_album) VALUES ("' . $nom_image . '", "' . $link_picture . '", "' . $link_mini . '", ' . $height . ', ' . $width . ', "' . $description . '", ' . $id_album . ')';
						}
						else {
							$query = 'INSERT INTO images(nom_image, link_picture, link_mini, height, width, id_album) VALUES ("' . $nom_image . '", "' . $link_picture . '", "' . $link_mini . '", ' . $height . ', ' . $width . ', ' . $id_album . ')';
						}

						if ($sql->connection()) {
							//echo "Connexion réussie !";
							if($sql->execute($query)){
								//echo "<br>Requete bien executée!";
							}                  
							else { $erreur = "Erreur: ".$sql->getError(); }

							if($sql->close()) { 
								//echo "<br>Déconnexion réussie!";
							}
						}
						else { $erreur = "Connexion échouée :".$sql->getError(); }
						
						echo '<script language="Javascript">';
						echo 'document.location.replace("?categorie=admin_galerie_album&album=' . $element . '");';
						echo '</script>';

					}
					else {
						// si notre image n'est pas de type jpeg ou png, on supprime le fichier uploadé et on affiche un petit message d'erreur
						unlink($_FILES['mon_image']['tmp_name']);
						$erreur = "Votre image est d'un format non supporté.";
					}
				}
			}
		}

		// si un message d'erreur est défini, on l'affiche
		if (isset($erreur)) echo '<br />' , $erreur;
?>

<script type="text/javascript" src="./modules/galerie/admin_galerie_album.js"></script>

<?php 
	}
	else {
		echo '<div class="totalBox">
			<div class="box">
			<div class="titreNews">Erreur :</div>
				<span>Album inconnu</span>
			</div>
		</div>';
	}
}
else {
	if (strtolower($_GET['album'])!="default") {
		echo '<div class="totalBox">
			<div class="box">
			<div class="titreNews">Erreur :</div>
				<span>Cette page est uniquement accessible aux administrateurs du site...</span>
			</div>
		</div>';
	}
	else {
		echo '<script language="Javascript">';
		echo 'document.location.replace("?categorie=galerie_accept");';
		echo '</script>';
	}
}	
?>
