<?php
/*
 * Affichage de la galerie des albums
*/

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

?>

<?php
$query = 'SELECT * FROM albums WHERE id_album != 1 AND id_album != 0';

if ($sql->connection()) {
	//echo "Connexion réussie !";
	if ($sql->execute($query)){
		//echo "<br />Requete bien executée!<br />";
		if(isset($_SESSION['id']) && $_SESSION['lvl']==1) { // Si l'utilisateur est administrateur
			echo '<div><a href="?categorie=member_galerie"><span class="bouton1">Soumettre une image</span></a>' . "\n";
			echo '<a href="?categorie=admin_galerie" style="float: right"><span class="bouton1">Administration des albums</span></a></div><br/>';
		}
		else {
			if(isset($_SESSION['id'])) { // Sinon si c'est un membre
				echo '<div><a href="?categorie=member_galerie"><span class="bouton1">Soumettre une image</span></a></div><br />' . "\n";
			}
		}
?>
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Galerie des albums</div>
<?php
		echo '<table id="albumContainer" style="margin-left:auto;margin-right:auto;">' . "\n";
			for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
				if($i % $nbColonne == 0) {
					echo '<tr>' . "\n";
				}
				echo '<td id="' . $s->nom_album . '">';
					$nomFirstImg = selectFirstImgAlbum($s->id_album, $sql2);
					$href = '?categorie=galerie_album&album=' . $s->nom_album;
					if ($nomFirstImg == '') {
						$nomFirstImg = '/small_noImage.gif';
					}
					$src_img = $dir_mini . '/' . $nomFirstImg;
				
					echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . htmlspecialchars($href) . '"><img src="' . $src_img . '" alt="' . $nomFirstImg . '" /></a></div>' . "\n";
				
					// Si le nom de l'album est trop long, on affiche qu'un morceau
					if (strlen($s->nom_album) > 18) {
						echo '<div style="padding-top: 15px;"><span><a title="' . $s->nom_album . '" href="' . htmlspecialchars($href) . '">' . stripslashes(substr($s->nom_album,0,16)) . '..</a></span></div>' . "\n";
					}
					else {
						echo '<div style="padding-top: 15px;"><span><a title="' . $s->nom_album . '" href="' . htmlspecialchars($href) . '">' . stripslashes($s->nom_album) . '</a></span></div>' . "\n";
					}
					echo '</div>';
				echo '</td>' . "\n";
				if($i % $nbColonne == ($nbColonne - 1)) {
					echo '</tr>' . "\n";
				}
			}
		echo '</table>' . "\n";
	}
	//$sql->free();
	else { $erreur = 'Erreur: ' . $sql->getError(); }
	  
	if($sql->close()) { 
		//echo "<br />Déconnexion réussie!";
	}
}
else { $erreur = 'Connexion échouée :' . $sql->getError(); }

?>
	</div>
</div>    
