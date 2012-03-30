<?php
/*
 * Administration des dossiers
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
	$query = 'SELECT * FROM dossiers_video WHERE id_dossier != 1 AND id_dossier != 0';
	$tableau = array();
	
	if($sql->connection()) {
		//echo "Connexion réussie !";
		if($sql->execute($query)){
			//echo "<br>Requete bien executée!";
			echo '<div>';
            echo '<input type="button" class="bouton1" id="btn_confirm_del" name="btn_confirm_del" value="Supprimer Dossier(s)"/>' . "\n";
            echo '<input type="button" class="bouton1" id="ajoutDossier" value="Ajouter un Dossier"/>' . "\n";
				echo '<a href="?categorie=galerie_video" style="float: right"><span class="bouton1">Retour à la galerie</span></a>';
			echo '</div>';
?>
<br />
<div class="totalBox">
	<div class="box">
		<div class="titreNews">Administration des dossiers vidéo</div>
<?php
			echo '<form id="form" action="?categorie=admin_galerie_video" method="post"/>';
			echo '<input type="hidden" id="delDossiers" name="delDossiers" />' . "\n";
			echo '<table id="albumVideo" style="margin-left:auto;margin-right:auto;">' . "\n";
            for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
					if($i % $nbColonne == 0) {
						echo '<tr>' . "\n";
					}
					echo '<td id="' . $s->nom_dossier . '">';
				
					$src_img = selectFirstVideoDossier($s->id_dossier, $sql2);
					if ($src_img == '') {
						$src_img = './modules/video/small_noImage.gif';
					}
				
					$href = '?categorie=admin_galerie_video_dossier&dossier=' . $s->nom_dossier;
				
					echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><a href="' . htmlspecialchars($href) . '"><img width="120" src="' . $src_img . '" alt="' . $s->nom_album . '" /></a></div>' . "\n";
				
					// si le nom du dossier est trop long, on affiche qu'un morceau
					if (strlen($s->nom_dossier) > 12) {
						echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->nom_dossier . '" href="' . htmlspecialchars($href) . '">' . stripslashes(substr($s->nom_dossier)) . '..</a><input type="checkbox" name="del[]" value="' . $s->id_dossier . '"/></span></div>' . "\n";
					}
					else {
						echo '<div style="padding-top: 15px; text-align: center;"><span><a title="' . $s->nom_dossier . '" href="' . htmlspecialchars($href) . '">' . stripslashes($s->nom_dossier) . '</a><input type="checkbox" name="del[]" value="' . $s->id_dossier . '"/></span></div>' . "\n";
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
	// Dialog d'ajout d'un dossier vidéo
	echo '<div id="ajoutDossierDialog" title="Ajouter un Dossier" style="display: none;">' . "\n";
		echo '<p>Nom du nouveau Dossier ?</p>' . "\n";
		echo '<form id="formDialog" action="?categorie=admin_galerie_video" method="post"/>' . "\n";
			echo '<input type="text" name="nomNouveauDossier"/>' . "\n";
			echo '<br />';
			echo '<input type="submit" class="bouton1" id="ajouterDossier" name="ajouterDossier" value="Ajouter" style="float: right;"/>' . "\n";
		echo '</form>' . "\n";
    echo '</div>' . "\n";

   // Dialog de confirmation de suppression 
	echo '<div id="confirmationDelete" title="Confirmation" style="display: none;">' . "\n";
		echo '<p>Etes vous sur de vouloir supprimer ce(ces) dossier(s) ainsi que ses(leurs) vidéo(s) ?</p>' . "\n";
	echo '</div>' . "\n";
?>

<?php
	// Traitement suppression de dossiers
	if (isset($_POST['delDossiers'])) {
		if (count($_POST['del'])>0) { // si des dossiers ont été cochées
			$tableau = $_POST['del'];
			foreach($tableau as $id_dossier) {
				delDossier($id_dossier, $sql, $sql2);
			}

			echo '<script language="Javascript">';
			echo 'document.location.replace("?categorie=admin_galerie_video");';
			echo '</script>';
		}
		else {
			echo "Aucun dossier à été sélectionné pour la suppression";
		}
	}
	// Traitement ajout d'un dossier
	if (isset($_POST['ajouterDossier'])) {
		if ($_POST['nomNouveauDossier'] != "") { // si un nom d'album a été saisie
			ajouterDossier($_POST['nomNouveauDossier'], $sql);

			echo '<script language="Javascript">';
			echo 'document.location.replace("?categorie=admin_galerie_video");';
			echo '</script>';
		}
		else { // sinon un message d'erreur
			echo "Le nom du nouveau dossier n'a pas été saisie";
		}
	}
?>

	<script type="text/javascript" src="./modules/video/admin_galerie_video.js"></script>

<?php
	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) echo '<br />' . $erreur; 
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