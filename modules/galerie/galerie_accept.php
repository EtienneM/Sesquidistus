<?php
/*
 * Interface d'acceptation des photos
*/

if(isset($_SESSION['id']) && $_SESSION['lvl']==1) {

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
   $query = 'SELECT * FROM images WHERE id_album = (SELECT id_album FROM albums WHERE nom_album = "default")';
   $tableau = array();

   if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)) {
			//echo "<br />Requete bien executée!<br />";
			echo '<form id="form" action="?categorie=galerie_accept" method="post"/>' . "\n";
			echo "<div style=\"display: block;\"><span id=\"photo\" class=\"bouton1\" onclick=\"javascript:document.location='./?categorie=galerie_accept'\">Acceptation Photo</span>";
			echo "<span id=\"video\" class=\"bouton1\" onclick=\"javascript:document.location='./?categorie=galerie_accept_video'\">Acceptation Vidéo</span>";
			echo '<a href="?categorie=admin_galerie" style="float: right"><span class="bouton1">Retour aux albums</span></a></div><br /><br />' . "\n";
			echo '<div class="bouton2 dataForm">' . "\n";
            echo '<input type="radio" name="action" id="radio_del" value="delete"/>' . 'Refuser une(des) image(s)' . '<span style="margin-left:30px;"/>' . "\n";
            echo '<input type="radio" name="action" id="radio_move" value="move"/>' . 'Accepter une(des) image(s) vers ' . "\n";
            listeAlbum($sql2);
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
   <div class="titreNews">Interface d'acceptation des images</div>
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
					
					if (strlen($nom_image) > 20) {
						echo '<div style="padding-top: 15px;"><span title="' . $nom_image . '">' . substr($nom_image,0,15) . '.. <input type="checkbox" name="del[]" value="' . $nom_image . '"></span></div>' . "\n";
					}
					else {
						echo '<div style="padding-top: 15px;"><span title="' . $nom_image . '">' . $nom_image . '<input type="checkbox" name="del[]" value="' . $nom_image . '"></span></div>' . "\n";
					}
					echo '</div>';
				echo '</td>' . "\n";
				if($i % $nbColonne == ($nbColonne - 1)) {
				   echo '</tr>' . "\n";
			   	}
			}
			echo '</table>' . "\n";
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

	echo '<div id="confirmationDelete" title="Confirmation" style="display: none;">' . "\n";
		echo '<p>Etes vous sur de vouloir refuser cette(ces) photo(s) ?</p>' . "\n";
	echo '</div>' . "\n";

	echo '<div id="confirmationMove" title="Confirmation" style="display: none;">' . "\n";
		echo '<p>Etes vous sur de vouloir accepter cette(ces) photo(s) ?</p>' . "\n";
	echo '</div>' . "\n";
?>

<?php
	if (isset($_POST['action'])) {
		if ( $_POST['action'] == "delete" ) {
			if (count($_POST['del'])>0) {
				$tableau = $_POST['del'];
				foreach($tableau as $nom_photo) {
					delImg($nom_photo, $dir_mini, $dir, $sql);
				}

				echo '<script language="Javascript">';
				echo 'document.location.replace("?categorie=galerie_accept");';
				echo '</script>';
			}
			else {
				echo "Aucune photo à été sélectionné pour la suppression";
			}
		}
		else if ( $_POST['action'] == "move") {
			if (count($_POST['del'])>0) {
				$tableau = $_POST['del'];
				foreach($tableau as $nom_photo) {
					moveToAlbum($nom_photo, $_POST['listeAlbum'], $sql);
				}
				
				echo '<script language="Javascript">';
				echo 'document.location.replace("?categorie=galerie_accept");';
				echo '</script>';
			}
			else {
				echo "Aucune photo à été sélectionné pour le déplacement";
			}
		}
	}
	
	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) echo '<br />' , $erreur;
?>

<script type="text/javascript" src="./modules/galerie/galerie_accept.js"></script>

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
