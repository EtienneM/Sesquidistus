<?php
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

$video = $_GET['video']; //id de la vidéo

if(verif_if_video_exist($sql2, $video)) {
?>

<?php
	$query = 'SELECT * FROM videos WHERE id="' . $video . '"';
	if($sql->connection()) {
		//echo "Connexion réussie !";
		if($sql->execute($query)){
			//echo "<br>Requete bien executée!";
			echo '<div style="display: block;"><a href="?categorie=galerie_video" style="float: right"><span class="bouton1">Retour aux vidéos</span></a></div><br /><br />';
?>
<div class="totalBox">
	<div class="box">
		<div id="titreNews" class="titreNews"></div>
		<div style="width:700px; margin:0 auto;">
<?php
			for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
				$nom_video = htmlspecialchars_decode($s->titre);
				// titre de la vidéo
				echo '<script type="text/javascript">' . "\n";
				echo 'var titreNews = document.getElementById("titreNews");' . "\n";
				echo 'titreNews.innerHTML = "' . addslashes($nom_video) . '";' . "\n";
				echo '</script>' . "\n";
				// intégration du code html de la vidéo
				echo '<div>' . "\n";
					echo $s->code . "\n";
				echo '</div>' . "\n";
				// description de la vidéo
				if ($s->description != "") {
					echo '<div>' . "\n";
						echo '<div class="bouton6" style="background-color:#DDD; cursor:auto; padding:6px; color:#333; margin-top:6px;">' . htmlspecialchars_decode($s->description) . '</div>';
					echo '</div>' . "\n";
				}
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
			<span>Vidéo inconnu</span>
		</div>
	</div>
<?php
}	
?>