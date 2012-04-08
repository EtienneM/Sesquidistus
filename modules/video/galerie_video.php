<?php
/*
 * Affichage de la galerie des dossiers vidéos
*/

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
?>


<?php
$query = 'SELECT * FROM dossiers_video WHERE id_dossier != 1 AND id_dossier != 0';
if($sql->connection()) {
	//echo "Connexion réussie !";
	if($sql->execute($query)){
		//echo "<br>Requete bien executée!";
		if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
			echo '<div><a href="?categorie=member_galerie"><span class="bouton1">Soumettre une vidéo</span></a>' . "\n";
			echo '<a href="?categorie=admin_galerie_video" style="float: right"><span class="bouton1">Administration des dossiers</span></a></div><br/>';
		}
		else {
			if(isset($_SESSION['id'])){
				echo '<div><a href="?categorie=member_video"><span class="bouton1">Soumettre une vidéo</span></a></div><br />' . "\n";
			}
		}
?>
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Galerie des dossiers vidéo</div>
<?php
		echo '<table id="albumVideo" style="margin-left:auto;margin-right:auto;">' . "\n";
			for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
				if($i % $nbColonne == 0) {
					echo '<tr>' . "\n";
				}
				echo '<td id="' . $s->nom_dossier . '">';
			
				// image preview de la première video du dossier
				$src_img = selectFirstVideoDossier($s->id_dossier, $sql2);
				if ($src_img == '') { //si il n'y a pas de vidéo dans le dossier
					$src_img = './modules/video/small_noImage.gif';
				}
			
				$href = '?categorie=galerie_video_dossier&dossier=' . $s->nom_dossier;
			
				echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . htmlspecialchars($href) . '"><img width="120" src="' . $src_img . '" alt="' . $s->nom_album . '" /></a></div>' . "\n";
			
				// si le nom du dossier est trop long, on affiche qu'un morceau
				if (strlen($s->nom_dossier) > 18) {
					echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->nom_dossier . '" href="' . htmlspecialchars($href) . '">' . stripslashes(substr($s->nom_dossier)) . '..</a></span></div>' . "\n";
				}
				else {
					echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->nom_dossier . '" href="' . htmlspecialchars($href) . '">' . stripslashes($s->nom_dossier) . '</a></span></div>' . "\n";
				}
				echo '</div>';
				echo '</td>' . "\n";
				if($i % $nbColonne == ($nbColonne - 1)) {
					echo '</tr>' . "\n";
				}
			}
		echo '</table>' . "\n";
	}                  
	else{ $erreur = "Erreur: ".$sql->getError(); }

	if($sql->close()) { 
		//echo "<br>Déconnexion réussie!";
	}
}
else { $erreur = "Connexion échouée :" . $sql->getError(); }
?>
	</div>
</div>

<?php
// si un message d'erreur est défini, on l'affiche
if (isset($erreur)) echo '<br />' . $erreur;
?>
