<?php

	/*
	 * Déclarion des variables.
	 */
	 
	//------
	$tabPages 	= array("./modules/accueil/accueil.php", "./modules/calendrier/calendrier.php", "./modules/club/accueil.php",
	"./modules/ultimate/accueil.php", "./modules/galerie/galerie_accueil.html", "./modules/event/event.php",
	"./modules/contact/accueil.php", "./modules/membres/login.php", "./modules/membres/deconnexion.php",
	"./modules/membres/edit_profil.php", "./modules/event/article.php", "./modules/forum/forum.php",
	"./modules/forum/topics.php", "./modules/sondage/formulaire.php", "./modules/forum/admin_forum.php",
	"./modules/forum/traitements_forum.php", "./modules/forum/topic.php", "./modules/galerie/member_galerie.php",
	"./modules/galerie/admin_galerie.php", "./modules/galerie/admin_galerie_album.php", "./modules/galerie/galerie.php",
	"./modules/galerie/galerie_album.php", "./modules/inscription/inscription.php", "./modules/membres/admin_membres.php",
	"./modules/membres/traitements_membres.php", "./modules/forum/actions_forum.php", "./modules/sondage/ajout_sondage.php",
	"./modules/membres/actions_profil.php", "./modules/inscription/action_inscription.php", "./modules/galerie/galerie_accept.php",
	"./modules/video/member_video.php", "./modules/video/galerie_video.php", "./modules/video/video.php",
	"./modules/club/change_contenu.php", "./modules/ultimate/change_contenu.php", "./modules/membres/lostpasswd.php",
	"./modules/video/galerie_video_dossier.php", "./modules/video/admin_galerie_video.php", "./modules/video/admin_galerie_video_dossier.php",
	"./modules/video/galerie_accept_video.php", "./modules/inscription_tournoi/form.php","./modules/inscription_tournoi/ajout_form.php",
	"./modules/inscription_tournoi/view_inscription.php", "./modules/forum/topic_update.php", "./modules/forum/topic_ajout.php",
	"./modules/contact/admin_contact.php", "./modules/membres/view_profil.php", "./modules/membres/avatar.php",
	"./modules/membres/trombi.php", "./modules/club/visiteur.php", "./modules/club/admin_visiteur.php");

	$liensCat = array("./?categorie=accueil", "./?categorie=calendrier", "./?categorie=club", "./?categorie=ultimate", "./?categorie=galerie_accueil",
	"./?categorie=event", "./?categorie=contact");

	$tabPageName = array(		"accueil", "calendrier", "le club",
						"ultimate Frisbee", "galeries", "nos evenements",
						"contact", "login", "deconnexion",
						"edit_profil", "article", "forum",
						"topics","sondage", "admin_forum",
						"traitements_forum", "topic", "member_galerie",
						"admin_galerie", "admin_galerie_album", "galerie",
						"galerie_album", "inscription", "admin_membres",
						"traitements_membres", "actions_forum", "ajout_sondage",
						"actions_profil", "action_inscription", "galerie_accept",
						"member_video", "galerie_video", "video",
						"admin_club", "admin_ultimate", "mdp_oublie",
						"galerie_video_dossier", "admin_galerie_video", "admin_galerie_video_dossier",
						"galerie_accept_video", "inscription_tournoi", "ajout_form_inscription",
						"visualisation_inscription", "topic_update", "topic_ajout",
						"admin_contact", "view_profil", "avatar", 
						"trombi", "visiteur", "admin_visiteur");
	$linkPage=$tabPages[0];
	
	$tpnMenu = 8;
	$tpnNb = count($tabPageName); //Nombre d'éléments du tableau $tabPageName.
	//------
	
	
	//Si la variable GET catégorie est vide on charge la page d'accueil.
	if(!isset($_GET['categorie'])){
		$_GET['categorie']=$tabPageName[0];
	}
	else if($_GET['categorie']=="event"){
		$_GET['categorie']= $tabPageName[5];
	}
	else if($_GET['categorie'] == "club"){
		$_GET['categorie']= $tabPageName[2];
	}
	else if($_GET['categorie'] == "ultimate"){
		$_GET['categorie']= $tabPageName[3];
	}
       else if($_GET['categorie'] == "galerie_accueil"){
		$_GET['categorie']= $tabPageName[4];
	}
	//Détermination de la page à charger.
	$res=false;	
	
	for($i=0; $i<$tpnNb && !$res; $i++){
	  if($tabPageName[$i] == $_GET['categorie']){
		$res = true;
		$linkPage = $tabPages[$i];
	  }
	 }
	 
	 //Procédure de la génération du menu.
	 function generationMenu($tpnNb, $tabPageName, $liensCat){
	 		
			for($i=0; $i<7; $i++){	
	 			
				if($i==0) {echo "<li class=\"first\">";}
				else if($i==6) {echo "<li class=\"last\">";}
				else {echo "<li>";}
				if($tabPageName[$i] == $_GET['categorie']){
					echo "<span class=\"selected\"><a href=\"".$liensCat[$i]."\">".ucwords($tabPageName[$i])."</a></span>";
				}
				else{
					echo "<a href=\"".$liensCat[$i]."\">".ucwords($tabPageName[$i])."</a>";
			    }
				echo "</li>\n";
			}
			
	 }
?>
