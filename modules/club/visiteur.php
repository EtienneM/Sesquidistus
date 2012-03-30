<?php
//-On regarde si la langue est définie---
if(isset($_GET['lang']) && !empty($_GET['lang']))
{
	 $titre ="Erreur";
	 //-On détermni le fichier à charger---
	 if($_GET['lang'] == "de")
	 {
		$nom_fichier = "./modules/club/de.txt";
		$lg = "de";
		$titre = "Das Club";
	 }
	 else if($_GET['lang'] == "en")
	 {
		$nom_fichier = "./modules/club/en.txt";
		$lg = "en";
		$titre = "The Club";	
	 }
	 //---
	 //-On ouvre est on affiche le texte désiré---
	 echo '<div class="totalBox">'.
				'<div class="box">'.
					'<div class="titreNews">'.$titre.'</div>';
	 $fichier = @fopen($nom_fichier, "r+");
	 $contenu = @fread($fichier, filesize($nom_fichier));
	fclose($fichier);
	 //$contenu = file_exists($nom_fichier) ? "Erreur de traitement!" : "Page en construction...!";
	 echo stripslashes($contenu);
			
	 echo		'</div>'.
			'</div>';
	 //---
	 //-On, détermine les actions possibles---
	 if(isset($_SESSION['id']) && $_SESSION['lvl'] == 1)
	 {
	 	echo '<form method="POST" action="./?categorie=admin_visiteur" style="float:right">'.
	 				'<input type="hidden" class="lang" name="lg"  id="lg" value="'.$lg.'"/>'.
					'<input type="submit" class="bouton1" value="Modifier le contenu"/>'.
				'</form>';
	 }
	 //---
}
else
{
	//-Si la valeur de $_GET['lang'] n'est pas bonne on redirige---
	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
	//---
}


?>