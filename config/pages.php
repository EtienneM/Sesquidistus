<?php
	/*
	 * Déclarion des variables.
	 */
	$pages = array(
		// Pages qui s'affichent dans le menu en haut sur toutes les pages
		'accueil' => array('./modules/accueil/accueil.php', 'Accueil', './?categorie=accueil'),
		'calendrier' => array('./modules/calendrier/calendrier.php', 'Calendrier', './?categorie=calendrier'),
		'club' => array('./modules/club/accueil.php', 'Le club', './?categorie=club'),
		'ultimate' => array('./modules/ultimate/accueil.php', 'Ultimate Frisbee', './?categorie=ultimate'),
		'galerie_accueil' => array('./modules/galerie/galerie_accueil.html', 'Galeries', './?categorie=galerie_accueil'),
		'event' => array('./modules/event/event.php', 'nos évènements', './?categorie=event'),
		'kym12' => array('./?categorie=event&page=lecture&id=', 'KYM \'12', './?categorie=event&page=lecture&id='),
		'contact' => array('./modules/contact/accueil.php', 'Contact', './?categorie=contact'),
		// Association entre clé de la variable $_GET['categorie'] et l'url
		'login' => './modules/membres/login.php',
		'deconnexion' => './modules/membres/deconnexion.php',
		'edit_profil' => './modules/membres/edit_profil.php',
		'article' => './modules/event/article.php',
		'forum' => './modules/forum/forum.php',
		'topics' => './modules/forum/topics.php',
		'sondage' => './modules/sondage/formulaire.php',
		'admin_forum' => './modules/forum/admin_forum.php',
		'traitements_forum' => './modules/forum/traitements_forum.php',
		'topic' => './modules/forum/topic.php',
		'member_galerie' => './modules/galerie/member_galerie.php',
		'admin_galerie' => './modules/galerie/admin_galerie.php',
		'admin_galerie_album' => './modules/galerie/admin_galerie_album.php',
		'galerie' => './modules/galerie/galerie.php',
		'galerie_album' => './modules/galerie/galerie_album.php',
		'inscription' => './modules/inscription/inscription.php',
		'admin_membres' => './modules/membres/admin_membres.php',
		'traitements_membres' => './modules/membres/traitements_membres.php',
		'actions_forum' => './modules/forum/actions_forum.php',
		'ajout_sondage' => './modules/sondage/ajout_sondage.php',
		'actions_profil' => './modules/membres/actions_profil.php',
		'action_inscription' => './modules/inscription/action_inscription.php',
		'galerie_accept' => './modules/galerie/galerie_accept.php',
		'member_video' => './modules/video/member_video.php',
		'galerie_video' => './modules/video/galerie_video.php',
		'video' => './modules/video/video.php',
		'admin_club' => './modules/club/change_contenu.php',
		'admin_ultimate' => './modules/ultimate/change_contenu.php',
		'mdp_oublie' => './modules/membres/lostpasswd.php',
		'galerie_video_dossier' => './modules/video/galerie_video_dossier.php',
		'admin_galerie_video' => './modules/video/admin_galerie_video.php',
		'admin_galerie_video_dossier' => './modules/video/admin_galerie_video_dossier.php',
		'galerie_accept_video' => './modules/video/galerie_accept_video.php',
		'inscription_tournoi' => './modules/inscription_tournoi/form.php',
		'ajout_form_inscription' => './modules/inscription_tournoi/ajout_form.php',
		'visualisation_inscription' => './modules/inscription_tournoi/view_inscription.php',
		'topic_update' => './modules/forum/topic_update.php',
		'topic_ajout' => './modules/forum/topic_ajout.php',
		'admin_contact' => './modules/contact/admin_contact.php',
		'view_profil' => './modules/membres/view_profil.php',
		'avatar' => './modules/membres/avatar.php',
		'trombi' => './modules/membres/trombi.php',
		'visiteur' => './modules/club/visiteur.php',
		'admin_visiteur' => './modules/club/admin_visiteur.php',
	);
	
	if(!isset($_GET['categorie']) or !isset($pages[$_GET['categorie']])){
		$_GET['categorie'] = 'accueil';
	}
	if (is_array($pages[$_GET['categorie']])) {
		$linkPage = $pages[$_GET['categorie']][0];
	} else {
		$linkPage = $pages[$_GET['categorie']];
	}

/**
 * Génère le menu en haut donnant accès aux différentes sections.
 * 
 * @param $pages tableau des pages existantes
 */
function generationMenu($pages) {
	// Compte le nombre de pages à afficher dans le menu
	$menu = array();
	foreach ($pages as $data) {
		if (is_array($data)) {
			if (count($data) != 3) {
				throw new InvalidArgumentException();
			}
			$menu[] = $data;
		}
	}
	// Affiche les pages du menu
	$i = 0;
	$nbPagesMenu = count($menu);
	foreach ($menu as $data) {
		$class = '';
		switch($i) {
			case 0:
				$class = 'first';
				break;
			case $nbPagesMenu - 1:
				$class = 'last';
				break;
		}
		echo "<li class=\"$class\">";
		echo '<a href="'.$data[2].'">'.ucwords($data[1]).'</a>';
		echo '</li>';
		if ($i == $nbPagesMenu - 1) {
			break;
		}
		$i++;
	}
}

