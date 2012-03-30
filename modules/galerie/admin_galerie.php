<?php
/*
 * Administration des albums
*/
	
if(isset($_SESSION['id']) && $_SESSION['lvl']==1){

	// Fichier de fonctions liée à la galerie
	include("./modules/galerie/fonctions.php");
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
   $query = 'SELECT * FROM albums WHERE id_album != 1 AND id_album != 0';
   $tableau = array();

   if ($sql->connection()) {
		//echo 'Connexion réussie !';
		if ($sql->execute($query)){
			//echo 'Requete bien executée!';
			echo '<div>';
				echo '<input type="button" class="bouton1" id="btn_confirm_del" name="btn_confirm_del" value="Supprimer Album(s)"/>' . "\n";
				echo '<input type="button" class="bouton1" id="ajoutAlbum" value="Ajouter un Album"/>' . "\n";
				echo '<a href="?categorie=galerie" style="float: right"><span class="bouton1">Retour à la galerie</span></a>';
			echo '</div>';
?>
<br />
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Administration des albums</div>
<?php
			// Affichage des albums
			echo '<form id="form" action="?categorie=admin_galerie" method="post"/>';
			echo '<input type="hidden" id="delAlbums" name="delAlbums" />' . "\n";
			echo '<table id="albumContainer" style="margin-left:auto;margin-right:auto;">' . "\n";
			for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
				if($i % $nbColonne == 0) {
					echo '<tr>' . "\n";
				}
				echo '<td id="' . $s->nom_album . '">';

				$nomFirstImg = selectFirstImgAlbum($s->id_album, $sql2);
				$href = '?categorie=admin_galerie_album&album=' . $s->nom_album;
				
				// Si il n'y a pas d'images dans l'album
				if ($nomFirstImg == '') {
					$nomFirstImg = 'small_noImage.gif'; // image par défaut
				}
				$src_img = $dir_mini . '/' . $nomFirstImg;

				echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . htmlspecialchars($href) . '"><img src="' . addslashes($src_img) . '" alt=' . addslashes($nomFirstImg) . '" /></a></div>' . "\n";
				
				// Si le nom de l'album est trop long on affiche qu'un morceau
				if (strlen($s->nom_album) > 12) {
					echo '<div style="padding-top: 15px;"><span><a title="' . $s->nom_album . '" href="' . htmlspecialchars($href) . '">' . stripslashes(substr($s->nom_album,0,10)) . '..</a><input type="checkbox" name="del[]" value="' . $s->id_album . '"/></span></div>' . "\n";
				}
				else {
					echo '<div style="padding-top: 15px;"><span><a title="' . $s->nom_album . '" href="' . htmlspecialchars($href) . '">' . stripslashes($s->nom_album) . '</a><input type="checkbox" name="del[]" value="' . $s->id_album . '"/></span></div>' . "\n";
				}
				echo '</div>';
				echo '</td>' . "\n";
				if($i % $nbColonne == ($nbColonne - 1)) {
					echo '</tr>' . "\n";
				}
			}
			echo '</table>' . "\n";
			echo '</form>';
      }
      //$sql->free();
      else { $erreur = 'Erreur: ' . $sql->getError(); }

      if($sql->close()) { 
         //echo "<br />Déconnexion réussie!";
      }
   }
   else { $erreur = 'Connexion échouée : ' . $sql->getError(); }
?>
	</div>
</div>
<?php
	// Dialog d'ajout d'un album
	echo '<div id="ajoutAlbumDialog" title="Ajouter un Album" style="display: none;">' . "\n";
		echo '<p>Nom du nouvel Album ?</p>' . "\n";
	   echo '<form id="formDialog" action="?categorie=admin_galerie" method="post"/>' . "\n";
			echo '<input type="text" name="nomNouvelAlbum"/>' . "\n";
		echo '<br />';
			echo '<input type="submit" class="bouton1" id="ajouterAlbum" name="ajouterAlbum" value="Ajouter" style="float: right;"/>' . "\n";
		echo '</form>' . "\n";
	echo '</div>' . "\n";

	// Dialog de confirmation de suppression d'albums
	echo '<div id="confirmationDelete" title="Confirmation" style="display: none;">' . "\n";
		echo '<p>Etes vous sur de vouloir supprimer cet(ces) album(s) ainsi que ses(leurs) photos(s) ?</p>' . "\n";
	echo '</div>' . "\n";


	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) { echo '<br />' . $erreur; }
?>

<?php
// Traitement de suppression d'albums
if (isset($_POST['delAlbums'])) {
   if (count($_POST['del'])>0) {
      $tableau = $_POST['del'];
	   foreach($tableau as $id_album) {
			delAlbum($id_album, $sql, $dir_mini, $dir, $sql2);
      }
		echo '<script language="Javascript">';
		echo 'document.location.replace("?categorie=admin_galerie");';
		echo '</script>';
   }
   else {
		echo "Aucun album à été sélectionné pour la suppression";
   }
}
// Traitement d'ajout d'un album
if (isset($_POST['ajouterAlbum'])) {
   if ($_POST['nomNouvelAlbum'] != "") {
		ajouterAlbum($_POST['nomNouvelAlbum'], $sql);

		echo '<script language="Javascript">';
		echo 'document.location.replace("?categorie=admin_galerie");';
		echo '</script>';
   }
   else {
      echo "Le nom du nouvel album n'a pas été saisie";
   }
}
?>

	<script type="text/javascript" src="./modules/galerie/admin_galerie.js"></script>

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