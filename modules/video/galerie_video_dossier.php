<?php
/*
 * Affichage des vidéos d'un dossier vidéo
*/

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

$dossier = $_GET['dossier'];

if($_GET['dossier']!="default" && verif_if_dossier_exist($sql, $dossier)) {
?>

<?php
	$query = 'SELECT * FROM videos WHERE id_dossier = (SELECT id_dossier FROM dossiers_video WHERE nom_dossier = "' . $dossier . '")';
	if($sql->connection()) {
		//echo "Connexion réussie !";
		if($sql->execute($query)){
			//echo "<br>Requete bien executée!";
			if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
				echo '<div><a href="?categorie=galerie_video"><span class="bouton1">Retour aux dossiers</span></a>' . "\n";
				echo '<a href="?categorie=admin_galerie_video_dossier&dossier=' . htmlspecialchars(stripslashes($dossier)) . '" style="float: right"><span class="bouton1">Administration ce dossier</span></a></div><br/>';
			}
			else {
				if(isset($_SESSION['id'])){
					echo '<div><a href="?categorie=galerie_video"><span class="bouton1">Retour aux dossiers</span></a></div><br />' . "\n";
				}
			}
?>
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Dossier vidéo "<?php echo stripslashes(stripslashes($dossier)); ?>"</div>
<?php
			echo '<table id="albumVideo" style="margin-left:auto;margin-right:auto;">' . "\n";
            for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
					$ok = true;
					if($i % $nbColonne == 0) {
						echo '<tr>' . "\n";
					}
					echo '<td id="' . $s->id . '">';
				
					$href = '?categorie=video&video=' . $s->id;
				
					// image preview de la vidéo
					echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . $href . '"><img width="120" src="' . $s->image . '" alt="' . $s->titre . '" /></a></div>' . "\n";
				
					// si le titre est trop long, on affiche qu'un morceau
					if (strlen($s->titre) > 18) {
						echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->titre . '" href="' . $href . '">' . substr(htmlspecialchars_decode($s->titre),0,16) . '..</a></span></div>' . "\n";
					}
					else {
						echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->titre . '" href="' . $href . '">' . htmlspecialchars_decode($s->titre) . '</a></span></div>' . "\n";
					}
					echo '</div>';
					echo '</td>' . "\n";
					if($i % $nbColonne == ($nbColonne - 1)) {
						echo '</tr>' . "\n";
					}
            }
			echo '</table>' . "\n";
			// message par défaut lorsqu'il n'y a pas de vidéos danss le dossier
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
	</div>
</div>

<?php
	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) echo '<br />' . $erreur;

}
else { // sinon afficher le message d'erreur
?>
	<div class="totalBox">
		<div class="box">
			<div class="titreNews">Erreur :</div>
			<span>Dossier vidéo inconnu</span>
		</div>
	</div>
<?php
}	
?>