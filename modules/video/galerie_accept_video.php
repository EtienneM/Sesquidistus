<?php
/*
 * Interface d'acceptation des vidéos
*/
if(isset($_SESSION['id']) && $_SESSION['lvl']==1) {

	// Fichier de fonctions liée à la galerie
	include("./modules/video/fonctions.php");
	// Configuration de la galerie
	include("./config/config_galerie.php");
	// Objet MySQL
	include("./config/mysql.class.php");
	// Configuration des variables de liaison avec la DB
	include("./config/mysql.php");

	$sql = new MySQL($host, $user, $passwd, $bdd);
	$sql2 = new MySQL($host, $user, $passwd, $bdd);
?>

<?php
	$query = 'SELECT * FROM videos WHERE id_dossier = (SELECT id_dossier FROM dossiers_video WHERE nom_dossier = "default")';
	$tableau = array();

	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br />Requete bien executée!<br />";
			echo '<form id="form" action="?categorie=galerie_accept_video" method="post"/>' . "\n";
			
			// liens pour switcher entre l'interface d'acceptation des photos et des vidéos
			echo "<div style=\"display: block;\"><span id=\"photo\" class=\"bouton1\" onclick=\"javascript:document.location='./?categorie=galerie_accept'\">Acceptation Photo</span>";
			echo "<span id=\"video\" class=\"bouton1\" onclick=\"javascript:document.location='./?categorie=galerie_accept_video'\">Acceptation Vidéo</span>";
			
			echo '<a href="?categorie=admin_galerie_video" style="float: right"><span class="bouton1">Retour aux dossiers</span></a></div><br /><br />' . "\n";
			// choix du traitement : Accepter ou refuser
			echo '<div class="bouton2 dataForm">' . "\n";
				echo '<input type="radio" name="action" id="radio_del" value="delete"/>' . 'Refuser une(des) vidéo(s)' . '<span style="margin-left:30px;"/>' . "\n";
            echo '<input type="radio" name="action" id="radio_move" value="move"/>' . 'Accepter une(des) vidéo(s) vers ' . "\n";
            // liste déroulante de choix du dossier
				listeDossier($sql2);
            echo "\n" . '<input type="button" class="bouton1" id="Valider" name="Valider" value="Valider" style="float:right;"/>';
			echo '</div>';
			
			if ($_GET['categorie'] == "galerie_accept") {
?>
				<script type="text/javascript">
					$("#photo").addClass("boutonPageCourante").attr("onclick",""); 
				</script>
<?php
			}
			else {
?>
				<script type="text/javascript">
					$("#video").addClass("boutonPageCourante").attr("onclick",""); 
				</script>
<?php
			}
?>
<br />

<div class="totalBox">
	<div class="box">
		<div class="titreNews">Interface d'acceptation des vidéos</div>
<?php
			$ok = false;
			echo '<table id="imageContainer" style="margin-left:auto;margin-right:auto;">' . "\n";
				for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
					$ok = true;
					if($i % $nbColonne == 0) {
						echo '<tr>' . "\n";
					}
					echo '<td id="' . $s->id . '">' . "\n";
						if ($s->type == "youtube") { //si c'est une vidéo youtube
							$href = "http://www.youtube.com/watch?v=" . $s->id;
						}
						else { // sinon c'est une vidéo dailymotion
							$href = "http://www.dailymotion.com/video/" . $s->id;
						}
						echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . $href . '"><img width="120px" src="' . $s->image . '" alt="' . $s->titre . '" /></a></div>' . "\n";
						
						// si le titre est trop long, alors on affiche qu'un morceau
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
			// Si il n'y a pas de vidéos dans le dossier
			if ($s == NULL && !($ok)) {
				echo "Il n'y a pas d'images";
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
	// Dialog de confirmation de suppression
	echo '<div id="confirmationDelete" title="Confirmation" style="display: none;">' . "\n";
		echo '<p>Etes vous sur de vouloir refuser cette(ces) vidéo(s) ?</p>' . "\n";
	echo '</div>' . "\n";

	// Dialog de confirmation de déplacement
	echo '<div id="confirmationMove" title="Confirmation" style="display: none;">' . "\n";
		echo '<p>Etes vous sur de vouloir accepter cette(ces) vidéo(s) ?</p>' . "\n";
	echo '</div>' . "\n";
?>

<?php
	if (isset($_POST['action'])) {
		if ( $_POST['action'] == "delete" ) { //traitement pour le refus
			if (count($_POST['del'])>0) { // si des vidéos ont été cochées
				$tableau = $_POST['del'];
				foreach($tableau as $id_video) {
					delVideo($id_video, $sql);
				}

				echo '<script language="Javascript">';
				echo 'document.location.replace("?categorie=galerie_accept_video");';
				echo '</script>';
			}
			else { //sinon on affiche un message d'erreur
				echo "Aucune vidéo à été sélectionné pour la suppression";
			}
		}
		else if ( $_POST['action'] == "move") { //traitement pour l'acceptation
			if (count($_POST['del'])>0) { // si des vidéos ont été cochées
				$tableau = $_POST['del'];
				foreach($tableau as $id_video) {
					moveToDossier($id_video, $_POST['listeDossier'], $sql);
				}
				
				echo '<script language="Javascript">';
				echo 'document.location.replace("?categorie=galerie_accept_video");';
				echo '</script>';
			}
			else { //sinon on affiche un message d'erreur
				echo "Aucune vidéo à été sélectionné pour le déplacement";
			}
		}
	}
	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) echo '<br />' . $erreur;
?>

	<script type="text/javascript" src="./modules/video/galerie_accept_video.js"></script>
<?php
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