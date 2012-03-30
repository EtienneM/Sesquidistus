<?php

//-On vérifie les droits d'administration---
if(isset($_SESSION['id']) && $_SESSION['lvl']==1)
{
	if(isset($_POST['txt']) && isset($_POST['lg']))
	{
		$nom_fichier = "./modules/club/".$_POST['lg'].".txt";
		//-Si le formulaire a été soumis--- 
		if ($_POST['txt'] == "") {
			$_POST['txt'] = "Cette page est en cours de construction...";
		}
		$fichier = fopen($nom_fichier, "w+");
		if($fichier)
		{
			fwrite($fichier, $_POST['txt']);
			fclose($fichier);
		}
		//---
		echo '<script type="text/javascript">window.location.href="./?categorie=login";</script>';	
	}
	//-On vérifie l'exactitude de la valeur de la variable $_POST['lg']---
	if(isset($_POST['lg']) && !isset($_POST['txt']) && !empty($_POST['lg']) && $_POST['lg'] == "de" || $_POST['lg'] == "en")
	{
		if($_POST['lg'] == "de")
		{
			$titre = "Das Club";
			$nom_fichier = "./modules/club/de.txt"; 
		}
		else if($_POST['lg'] == "en")
		{
			$titre = "The Club";
			$nom_fichier = "./modules/club/en.txt";			
		}
		
		echo '<form id="form" method="post" style="margin-bottom:200px" action="./?categorie=admin_visiteur">'.
					'<div class="totalBox">'.
						'<div class="box">'.
							'<div class="titreNews">'.$titre.'</div>';
		
		@$fichier = fopen($nom_fichier, "r+");
		if($fichier)
		{
			$contenu = fread($fichier, filesize($nom_fichier));
			fclose($fichier);		
		}

		echo '<div id="tinyMceBox" style="margin-top:30px;">'.
					'<textarea id="txt" name="txt" rows="15" cols="80" class="tinymce">'.
						stripslashes($contenu).
					'</textarea>'.
				'</div>'.
			'</div>';
		echo '<input type="hidden" id="lg" name="lg" value="'.$_POST['lg'].'" />';
		echo '<input type="submit" class="bouton1" value="Valider le contenu" style="margin-top:30px;float: right;"/>';
		
		echo 		'</div>'.
				'</form>';
				
		//-On charge les fichiers js utiles---
		echo '<script type="text/javascript" src="./js/tinymce/jquery.tinymce.js"></script>';
		echo '<script type="text/javascript" src="./modules/club/tinymce.js"></script>';
		//---	
	}
	else
	{
		//-Sinon on redirige---
		echo '<script type="text/javascript">window.location.href="./?categorie=login";</script>';
		//---
	}
}
else
{
	//-Si les drotis ne sont pas corrects on redirige vers l'accueil---
	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
	//---
}


?>
