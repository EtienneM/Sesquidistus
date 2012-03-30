<?php
/* 
 * Affichage des pages "Contact", "Mentions légales", "A propos du site"
*/
?>

<?php
$designBy ="";
	if (isset($_GET['page'])){ // Si il y a une variable $_GET['page'] dans l'url
		if ($_GET['page'] == 'mentions'){ // si la page ciblé est la page "Mentions légales"
			$nom_fichier = "./modules/contact/mentions.txt";
			$titre = "Informations légales";
			$href = "?categorie=admin_contact&page=mentions";
?>
			<script type="text/javascript">
			//Enleve l'effet de sélection du module Contact dans la barre de menu
				$("#menuDrop").find('span.selected').each(function(){
					$(this).replaceWith($(this).html());
				});
			</script>
<?php
		}
		elseif ($_GET['page'] == 'apropos'){ // si la page ciblé est la page "A propos du site"
			$nom_fichier = "./modules/contact/apropos.txt";
			$titre = "A propos du site";
			$href = "?categorie=admin_contact&page=apropos";
			$designBy ="<hr style=\"margin-top:100px;\"/><div>Ce site a été réalisé dans le cadre d'un <b>projet Universitaire</b> (Université de Strasbourg) par 
						les trois étudiants suivants:
							<table style=\"margin-left:30px; margin-top:30px;\">
								<tr>
									<td><img src=\"../../favicon.ico\"/ style=\"width:10px; height:10px\"> Benoît SOUFFLET :</td>
									<td><a href=\"mailto:benoit.soufflet@gmail.com\">benoit.soufflet@gmail.com</a></td>
								</tr>
								<tr>
									<td><img src=\"../../favicon.ico\"/ style=\"width:10px; height:10px\"> Pierre LEROY:</td>
									<td><a href=\"mailto:pleroy@etu.unistra.fr\">pleroy@etu.unistra.fr</a></td>
								</tr>
								<tr>
									<td><img src=\"../../favicon.ico\"/ style=\"width:10px; height:10px\"> Steve DURRHEIMER:</td>
									<td><a href=\"mailto:durrheimer@etu.unistra.fr\">durrheimer@etu.unistra.fr</a></td>
								</tr>
							</table>
						</div>";
?>
			<script type="text/javascript">
			//Enleve l'effet de sélection du module Contact dans la barre de menu
				$("#menuDrop").find('span.selected').each(function(){
					$(this).replaceWith($(this).html());
				});
			</script>
<?php
		}
		else { // sinon tous les autres cas cible la page "Contact"
			$nom_fichier = "./modules/contact/contact.txt";
			$titre = "Comment nous contacter ?";
			$href = "?categorie=admin_contact&page=contact";
		}
	}
	else { // Sinon affiche la page contact par défaut pour tout autre variable $_GET[''] dans l'url ou s'il n'y en a pas
		$nom_fichier = "./modules/contact/contact.txt";
		$titre = "Comment nous contacter ?";
		$href = "?categorie=admin_contact";
	}
?>

<div class="totalBox">
	<div class="box" style="margin-bottom:20px">
		<div class="titreNews"><?php echo $titre; ?></div>
		
<?php		
		// Récupération et affichage du contenu du fichier
		$fichier = fopen($nom_fichier, "r+");
		$contenu = fread($fichier, filesize($nom_fichier));
		fclose($fichier);
		echo stripslashes($contenu);
		echo $designBy;
?>
	</div>
<?php
	// Si l'utilisateur est connecté et est administrateur
	if(isset($_SESSION['id']) && $_SESSION['lvl'] == 1){
		echo '<div><a href="' . $href . '" style="float: right"><span class="bouton1">Modifier le contenu</span></a></div>';
	}
?>
</div>