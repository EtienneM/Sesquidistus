<?php
/*
 * Affichage des photos d'un album
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


$album = $_GET['album'];
$id_album = getIdAlbum($album, $sql);
$images = '';
?>
<script type="text/javascript">
    var imgInfos = new Array();
</script>

<?php
if($_GET['album']!="default" && verif_if_album_exist($sql, $album)) {

	$query = 'SELECT * FROM images WHERE id_album = (SELECT id_album FROM albums WHERE nom_album = "' . $_GET['album'] . '")';
	$tableau = array();

	if ($sql->connection()) {
		//echo "Connexion réussie !";
		if ($sql->execute($query)){
			//echo "<br />Requete bien executée!<br />";
			if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
				echo '<div style="display: block;"><a href="?categorie=admin_galerie_album&album=' . htmlspecialchars(stripslashes($album)) . '"><span class="bouton1">Administrer cet album</span></a>';
				echo '<a href="?categorie=galerie" style="float: right"><span class="bouton1">Retour aux albums</span></a></div><br />';
			}
			else {
				echo '<div style="display: block;"><a href="?categorie=galerie" style="float: right"><span class="bouton1">Retour aux albums</span></a></div><br /><br />';
			}
?>
<div class="totalBox">
	<div class="box">
    	<div class="titreNews">Album "<?php echo stripslashes(stripslashes($album));?>"</div>
<?php
			$ok = false;
			echo '<table id="imageContainer" style="margin-left:auto;margin-right:auto;">' . "\n";
				for ($i = 0 ; $s = $sql->getObjectResult() ; $i++) {
					$ok = true;
					$nom_image = $s->nom_image;
					if ($images == "") {$images = $nom_image;}
					else {$images .= ";" . $nom_image;}
					$height = intval($s->height);
					$width = intval($s ->width);
						
					if($i % $nbColonne == 0) {
						echo '<tr>' . "\n";
					}
					echo '<td>' . "\n";
						echo '<div class="bouton4 albumBox" style="padding-top: 6px;"><div style="height: 120px;"><img id="' . $nom_image . '" src="' . $dir_mini . '/' . addslashes($nom_image) . '"style="cursor:pointer;" alt="' . $nom_image . '" /></div>' . "\n";
?>
						<script type="text/javascript">
						var windowHeight=($(window).height())/1.5;
						var windowWidth=($(window).width())/2.5;
						var imgWidth = 0;
						var imgHeight = 0;
						
<?php 
						if ($width > $height) {
							echo 'if(' . $width . '>windowWidth){';
								echo 'imgWidth = windowWidth;' . 'imgHeight = Math.round(' . $height . '/(' . $width . '/imgWidth));';
							echo '}else{';
								echo 'imgWidth = '.$width.';';
								echo 'imgHeight = '.$height.';';
							echo '}';
						}
						else if($width < $height) {
							echo 'if(' . $height . '>windowHeight){';
								echo 'imgHeight = windowHeight;' . 'imgWidth = Math.round(' . $width . '/(' . $height . '/imgHeight));';
							echo '}else{';
								echo 'imgWidth = '.$width.';';
								echo 'imgHeight = '.$height.';';
							echo '}';
						}
						else{
							echo 'imgWidth = windowHeight;';
							echo 'imgHeight = windowHeight;';
						}
?>
						var eventPicture = document.getElementById("<?php echo $nom_image;?>");
						imgInfos['<?php echo addslashes($nom_image);?>'] = new Array("<?php echo $dir . "/" . addslashes($nom_image);?>",
																											imgHeight,
																											imgWidth,
																											"<?php echo $s->description;?>",
																											"<?php echo $nom_image;?>");
						
						// Ouverture de la dialog avec la photo en grand
						eventPicture.onclick = function() {
							$(document).ready(function(){
								$( "#picture" ).attr( "src", imgInfos['<?php echo addslashes($nom_image);?>'][0].replace(/\'/g,"\\\'").replace(/\"/g,"\\\"") );
								$( "#picture" ).width(imgInfos['<?php echo addslashes($nom_image);?>'][2]);
								$( "#picture" ).height(imgInfos['<?php echo addslashes($nom_image);?>'][1]);
								$( "#picture" ).attr( "alt", "<?php echo $nom_image;?>" );
								
								$( "#commentaire" ).html( imgInfos['<?php echo addslashes($nom_image);?>'][3] );
								if ($( "#commentaire" ).html() == "") {
									$( "#imageComment" ).css("display","none");
								}
								else {
									$( "#imageComment" ).css("display","block");
								}
								$( "#dialogContainer" ).dialog( "open" );
								$( "#dialogContainer" ).dialog( "option", "width", ($( "#picture" ).width() + 120));
								$( "#dialogContainer" ).dialog( "option", "position", 'center' );
								$( "#dialogContainer" ).dialog( "option", "title", imgInfos['<?php echo addslashes($nom_image);?>'][4]);
								updateMvtDialogButton("<?php echo $nom_image;?>");
							});
						};		
						</script>
<?php
						if (strlen($nom_image) > 18) {
							echo '<div style="padding-top: 15px;"><span title="' . $nom_image . '">' . substr($nom_image,0,16) . '..</span></div>' . "\n";
						}
						else {
							echo '<div style="padding-top: 15px;"><span title="' . $nom_image . '">' . $nom_image . '</span></div>' . "\n";
						}
						echo '</div';
					echo '</td>' . "\n";
					if($i % $nbColonne == ($nbColonne - 1)) {
						echo '</tr>' . "\n";
					}	
				}
			echo '</table>' . "\n";
			echo '<input type="hidden" id="allImg" name="allImg" value="' . $images .'"/>';
			if ($s == NULL && !($ok)) {
				echo "Il n'y a pas d'images dans cet album";
			}
		}
		else { $erreur = 'Erreur: ' . $sql->getError(); }

		if($sql->close()) {
			//echo "<br />Déconnexion réussie!";
		}
	}
	else { $erreur = 'Connexion échouée :' . $sql->getError(); }
	
	// si un message d'erreur est défini, on l'affiche
	if (isset($erreur)) echo '<br />' , $erreur;
?>
	</div>
</div>

<?php
	// Dialog utilisé pour affiché les images lorsqu'il clique dessus
	echo '<div id="dialogContainer" style="display:none; overflow:hidden;">' . "\n";
		echo '<table><tr>' . "\n";
			echo '<td><div id="prevLink">' . "\n";
				echo '<img id="prev" src="./images/gallery/prev.png"/>' . "\n";
			echo '</div></td>' . "\n";
			echo '<td><div id="imageContainer">' . "\n";
				echo '<img id="picture" src="./modules/galerie/loading.gif" alt="loading"/>' . "\n";
			echo '</td></div>' . "\n";
			echo '<td><div id="nextLink">' . "\n";
				echo '<img id="next" src="./images/gallery/next.png"/>' . "\n";
			echo '</td></div>' . "\n";
		echo '</tr></table>' . "\n";
		echo '<div id="imageComment">' . "\n";
				echo '<div class="bouton6" style="background-color:#DDD; cursor:auto; padding:6px; color:#333; margin-top:6px;"><span id="commentaire">Default</span></div>' . "\n";
		echo '</div>' . "\n";
	echo '</div>' . "\n";
?>

<script type="text/javascript" src="./modules/galerie/galerie_album.js"></script>

<?php 
}
else { // sinon afficher le message d'erreur
?>
	<div class="totalBox">
		<div class="box">
			<div class="titreNews">Erreur :</div>
			<span>Album inconnu</span>
		</div>
	</div>
<?php
}	
?>
