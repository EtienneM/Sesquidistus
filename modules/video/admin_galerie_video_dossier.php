<?php
/*
 * Affichage des vidéos d'un dossier vidéo
*/

if(isset($_SESSION['id']) && $_SESSION['lvl']==1 && strtolower($_GET['dossier'])!="default") {

	// Fichier de fonctions liée à la galerie
	include("./modules/video/fonctions.php");
	// Configuration de la galerie
	include("./config/config_galerie.php");
	// Objet MySQL
	include("./config/mysql.class.php");
	// Configuration des variables de liaison avec la DB
	include("./config/mysql.php");

	$sql = new MySQL($host, $user, $passwd, $db);
	$sql2 = new MySQL($host, $user, $passwd, $db);

	$dossier = $_GET['dossier'];
	$id_dossier = getIdDossier($dossier, $sql);

	if (verif_if_dossier_exist($sql, $dossier)) {
?>

<?php
		$query = 'SELECT * FROM videos WHERE id_dossier = (SELECT id_dossier FROM dossiers_video WHERE nom_dossier = "' . $dossier . '")';
		$tableau = array();
	
		if($sql->connection()) {
			//echo "Connexion réussie !";
			if($sql->execute($query)){
				//echo "<br />Requete bien executée!<br />";
				echo '<form id="form" action="?categorie=admin_galerie_video_dossier&dossier=' . htmlspecialchars(stripslashes($dossier)) . '" method="post"/>' . "\n";
				echo '<div style="display: block;"><a href="?categorie=admin_galerie_video" style="float: right"><span class="bouton1">Retour aux dossiers</span></a></div><br /><br />' . "\n";
				// choix du traitement : Accepter ou refuser
				echo '<div class="bouton2 dataForm">' . "\n";
					echo '<input type="radio" name="action" id="radio_del" value="delete"/>' . 'Supprimer une(des) vidéo(s)' . '<span style="margin-left:30px;"/>' . "\n";
					echo '<input type="radio" name="action" id="radio_move" value="move"/>' . 'Déplacer une(des) vidéo(s) vers ' . "\n";
					// liste déroulante de choix du dossier
					listeDossier($sql2);
					echo "\n" . '<input type="button" class="bouton1" id="Valider" name="Valider" value="Valider" style="float:right;"/>';
				echo '</div>';
?>
<br />
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Administration du dossier vidéo "<?php echo stripslashes(stripslashes($dossier)); ?>"</div>
<?php
				$ok = false;
				echo '<table id="albumVideo" style="margin-left:auto;margin-right:auto;">' . "\n";
					for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
						$ok = true;
						if($i % $nbColonne == 0) {
							echo '<tr>' . "\n";
						}
						echo '<td id="' . $s->id . '">';
					
						$href = '?categorie=video&video=' . $s->id;
					
						echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . $href . '"><img width="120" src="' . $s->image . '" alt="' . $s->titre . '" /></a></div>' . "\n";
					
						// si le titre est trop long, on affiche qu'un morceau
						if (strlen($s->titre) > 12) {
							echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->titre . '" href="' . $href . '">' . substr(htmlspecialchars_decode($s->titre),0,10) . '.. </a><input type="checkbox" name="del[]" value="' . $s->id_video . '"/></span></div>' . "\n";
						}
						else {
							echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->titre . '" href="' . $href . '">' . htmlspecialchars_decode($s->titre) . '</a><input type="checkbox" name="del[]" value="' . $s->id_video . '"/></span></div>' . "\n";
						}
						echo '</div>';
						echo '</td>' . "\n";
						if($i % $nbColonne == ($nbColonne - 1)) {
							echo '</tr>' . "\n";
						}
					}
				echo '</table>' . "\n";
				// si il n'y a pas de vidéos dans le dossier
				if ($s == NULL && !($ok)) {
					echo "Il n'y a pas de vidéos dans ce dossier";
				}
			}                  
			else{ $erreur = "Erreur: ".$sql->getError(); }

			if($sql->close()) { 
				//echo "<br>Déconnexion réussie!";
			}
		}
		else { $erreur = "Connexion échouée :".$sql->getError(); }
		
?>
		<div style="position: absolute; top: 0px; right: 0px;"><a target="_blank" href="./doc/doc_galerie/doc_admin_galerie.html"><img style="width: 25px;" alt="aide" src="./images/help.png"></a></div>
	</div>
</div>

<?php
				echo '</form>';

		// Dialog de confirmation de suppression
		echo '<div id="confirmationDelete" title="Confirmation" style="display: none;">' . "\n";
			echo '<p>Etes vous sur de vouloir supprimer cette(ces) vidéo(s) ?</p>' . "\n";
		echo '</div>' . "\n";

		// Dialog de confirmation de déplacement
		echo '<div id="confirmationMove" title="Confirmation" style="display: none;">' . "\n";
			echo '<p>Etes vous sur de vouloir déplacer cette(ces) vidéo(s) ?</p>' . "\n";
		echo '</div>' . "\n";
	
		// Accordion d'ajout d'un vidéo dans ce dossier vidéo
		echo '<div id="accordion">';
			echo '<h4 class="header titreSaison"><span>Ajouter une vidéo à ce dossier</span></h4>';
			echo '<div class="box2" style="vertical-align:left;">';
				echo '<form action="?categorie=admin_galerie_video_dossier&dossier=' . htmlspecialchars(stripslashes($dossier)) . '" method="post" enctype="multipart/form-data">';
				echo '<span style="font-style:italic">Uniquement les vidéos Youtube et Dailymotion</span>';
				echo '<p>';
					echo "Entrez l'adresse url de la vidéo : <input type=\"text\" name=\"lien\" />";
				echo '</p>';
				echo '<input type="submit" class="bouton1" name="go_video" value="Envoyer" style="float: right;"/> <br /><br />';
				echo '</form>';
			echo '</div>';
		echo '</div>';
?>

<?php

		if (isset($_POST['action'])) {
			if ( $_POST['action'] == "delete" ) { //traitement Suppression
				if (count($_POST['del'])>0) { // si des vidéos ont été cochées
					$tableau = $_POST['del'];
					foreach($tableau as $id_video) {
						delVideo($id_video, $sql);
					}

					echo '<script language="Javascript">';
					echo 'document.location.replace("?categorie=admin_galerie_video_dossier&dossier=' . $_GET['dossier'] . '");';
					echo '</script>';
				}
				else { //sinon on affiche un message d'erreur
					echo "Aucune vidéo à été sélectionné pour la suppression";
				}
			}
			else if ( $_POST['action'] == "move") { // traitement Déplacement
				if (count($_POST['del'])>0) { // si des vidéos ont été cochées
					$tableau = $_POST['del'];
					foreach($tableau as $id_video) {
						moveToDossier($id_video, $_POST['listeDossier'], $sql);
					}
					
					echo '<script language="Javascript">';
					echo 'document.location.replace("?categorie=admin_galerie_video_dossier&dossier=' . $_GET['dossier'] . '");';
					echo '</script>';
				}
				else { //sinon on affiche un message d'erreur
					echo "Aucune vidéo à été sélectionné pour le déplacement";
				}
			}
		}

		if (isset($_POST['go_video'])) { // traitement ajout vidéo dans ce dossier
			if (empty($_POST['lien'])) {
				$erreur = 'Aucun lien envoyé.';
			}
			else {
				$lien = $_POST['lien'];
				$video = getVideoInfo($lien);
				if ($video['type'] == "") { //message d'erreur si ce n'est pas une vidéo youtube ou dailymotion
					$erreur = 'Type de vidéo non valide';
				}
				else if ($video['id'] == "") { //si lien pas valide
					$erreur = 'Lien invalide';
				}
				else {
					$query = "INSERT INTO videos(type, id, titre, description, code, image, id_dossier) VALUES ('" . $video["type"] . "', '" . $video["id"] . "', '" . $video["titre"] . "', '" . $video["description"] . "', '" . $video["code"] . "', '" . $video["img"] . "', " . $id_dossier . ")";
					if($sql->connection()) {
						//echo "Connexion réussie !";
						if($sql->execute($query)){
							//echo "<br>Requete bien executée!";
						}                  
						else{ $erreur = "Erreur: ".$sql->getError(); }
			
						if($sql->close()) { 
							//echo "<br>Déconnexion réussie!";
						}
						
						echo '<script language="Javascript">';
						echo 'document.location.replace("?categorie=admin_galerie_video_dossier&dossier=' . $dossier . '");';
						echo '</script>';
					}
					else { $erreur = "Connexion échouée :".$sql->getError(); }
				}
			}
		}
?>

		<script type="text/javascript" src="./modules/video/admin_galerie_video_dossier.js"></script>

<?php
		// si un message d'erreur est défini, on l'affiche
		if (isset($erreur)) echo '<br />' , $erreur;
	}
	else { // message d'erreur dossier non existant dans la DB
		echo '<div class="totalBox">
			<div class="box">
			<div class="titreNews">Erreur :</div>
				<span>Dossier inconnu</span>
			</div>
		</div>';
	}
}
else { // si pas admin
	if (strtolower($_GET['dossier'])!="default") { 
		echo '<div class="totalBox">
			<div class="box">
			<div class="titreNews">Erreur :</div>
				<span>Cette page est uniquement accessible aux administrateurs du site...</span>
			</div>
		</div>';
	}
	else {
		echo '<script language="Javascript">';
        echo 'document.location.replace("?categorie=galerie_accept_video");';
       	echo '</script>';
	}
}	
?>
