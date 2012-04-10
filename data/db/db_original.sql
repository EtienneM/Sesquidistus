DROP TABLE IF EXISTS albums;
DROP TABLE IF EXISTS videos;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS club;
DROP TABLE IF EXISTS dossiers_video;
DROP TABLE IF EXISTS inscription_tournoi;
DROP TABLE IF EXISTS evenement;
DROP TABLE IF EXISTS type_event;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS lieu_ultimate;
DROP TABLE IF EXISTS membre;
DROP TABLE IF EXISTS reponse_inscription_tournoi;
DROP TABLE IF EXISTS profil;
DROP TABLE IF EXISTS reponse_sondage;
DROP TABLE IF EXISTS sondage;
DROP TABLE IF EXISTS ultimate;



CREATE TABLE `images` (
  `id_image` int(11) NOT NULL auto_increment,
  `nom_image` varchar(100) NOT NULL,
  `link_picture` varchar(100) NOT NULL,
  `link_mini` varchar(100) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `description` text,
  `id_album` int(11) NOT NULL default '1',
  `slideshow` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id_image`),
  UNIQUE KEY `nom_image` (`nom_image`,`link_picture`,`link_mini`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8;

CREATE TABLE `albums` (
  `id_album` int(11) NOT NULL auto_increment,
  `nom_album` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_album`),
  UNIQUE KEY `nom_album` (`nom_album`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

CREATE TABLE `article` (
  `id` int(11) NOT NULL auto_increment,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date_article` date NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

CREATE TABLE `club` (
  `id` tinyint(4) NOT NULL auto_increment COMMENT 'id de la catégorie',
  `titre` varchar(50) NOT NULL COMMENT 'titre',
  `contenu` text NOT NULL COMMENT 'contenu',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations du module club';

CREATE TABLE `dossiers_video` (
  `id_dossier` int(11) NOT NULL auto_increment,
  `nom_dossier` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_dossier`),
  UNIQUE KEY `nom_dossier` (`nom_dossier`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

CREATE TABLE `type_event` (
  `numero` int(11) NOT NULL auto_increment,
  `nom` text NOT NULL,
  `color` tinytext NOT NULL,
  PRIMARY KEY  (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL auto_increment,
  `id_membre` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `titre` tinytext NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `duree` int(11) NOT NULL default '1',
  `horaire_debut` tinytext NOT NULL,
  `horaire_fin` tinytext NOT NULL,
  `lieu` text NOT NULL,
  `id_lieu` int(11) NOT NULL,
  `contenu_photo` text NOT NULL,
  `contenu_video` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type_event` (`numero`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=utf8;

CREATE TABLE `inscription_tournoi` (
  `id_formulaire` int(11) NOT NULL auto_increment,
  `id_event` int(11) NOT NULL,
  `questions` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_formulaire`),
  KEY `id_event` (`id_event`),
  CONSTRAINT `inscription_tournoi_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

CREATE TABLE `lieu_ultimate` (
  `numero` int(11) NOT NULL auto_increment,
  `nom` text NOT NULL,
  `adresse` text NOT NULL,
  PRIMARY KEY  (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE `membre` (
  `ID` int(11) NOT NULL auto_increment,
  `LOGIN` varchar(25) character set latin1 NOT NULL,
  `PASSWD` varchar(255) character set latin1 NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `LOGIN` (`LOGIN`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les membres.';

CREATE TABLE `profil` (
  `ID` int(4) NOT NULL auto_increment,
  `ID_MEMBRE` int(4) NOT NULL COMMENT 'Clef étrangère vers la table membre',
  `NOM` varchar(50) NOT NULL COMMENT 'Nom du joueur',
  `PRENOM` varchar(50) NOT NULL COMMENT 'Prénom du joueur',
  `MAIL` varchar(100) NOT NULL COMMENT 'Adresse mail',
  `MAIN` varchar(8) NOT NULL COMMENT 'Gaucher ou droitier',
  `POSTE` varchar(50) NOT NULL COMMENT 'poste occupé',
  `COUP` varchar(50) NOT NULL COMMENT 'coup préféré',
  `ADHESION` date NOT NULL COMMENT 'Date d''adhésion au club',
  `SOUVENIR` text NOT NULL COMMENT 'Meilleur souvenir',
  `POURQUOI` text NOT NULL COMMENT 'Pourqui l''ultimate',
  `AVATAR` tinytext NOT NULL,
  `AVATAR_MIN` tinytext NOT NULL,
  `QUESTION` varchar(100) NOT NULL COMMENT 'Question secrète',
  `REPONSE` varchar(100) NOT NULL COMMENT 'Réponse à la question secrète',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID_MEMBRE` (`ID_MEMBRE`),
  CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations sur les membres.';

CREATE TABLE `reponse_inscription_tournoi` (
  `id_reponse` int(11) NOT NULL auto_increment,
  `id_formulaire` int(11) NOT NULL,
  `questions` text NOT NULL,
  `reponses` text NOT NULL,
  `date` date NOT NULL,
  `lu` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id_reponse`),
  KEY `id_formulaire` (`id_formulaire`),
  CONSTRAINT `reponse_inscription_tournoi_ibfk_1` FOREIGN KEY (`id_formulaire`) REFERENCES `inscription_tournoi` (`id_formulaire`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `sondage` (
  `id_formulaire` int(11) NOT NULL auto_increment,
  `question` text NOT NULL,
  `reponse_possible` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_formulaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reponse_sondage` (
  `id_reponse` int(11) NOT NULL auto_increment,
  `id_sondage` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `reponse` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_reponse`),
  KEY `id_sondage` (`id_sondage`),
  CONSTRAINT `reponse_sondage_ibfk_1` FOREIGN KEY (`id_sondage`) REFERENCES `sondage` (`id_formulaire`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ultimate` (
  `id` tinyint(4) NOT NULL auto_increment COMMENT 'id de la catégorie',
  `titre` varchar(50) NOT NULL COMMENT 'titre',
  `contenu` text NOT NULL COMMENT 'contenu',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations du module club';

CREATE TABLE `videos` (
  `id_video` int(11) NOT NULL auto_increment,
  `type` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `code` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_dossier` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_video`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS forum_cat;

/*CREATE TABLE `forum_cat` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant de la catégorie.',
  `LIBELLE` varchar(255) character set latin1 NOT NULL COMMENT 'titre de la catégorie.', 
  `RANG` tinyint(4) NOT NULL COMMENT 'position de la liste lors de l''affichage.', 
  PRIMARY KEY  (`ID`) 
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='Table contenant les catégories.';*/

DROP TABLE IF EXISTS forum_msg;

/*CREATE TABLE `forum_msg` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant du message', 
  `CONTENU` text character set latin1 NOT NULL COMMENT 'Contenu du message.', 
  `DATE_PUB` int(11) NOT NULL, 
  `ID_TOPIC` int(11) NOT NULL COMMENT 'Id du topic dans lequel le msg est posté.', 
  `ID_MEMBRE` int(11) NOT NULL COMMENT 'ID du membre postant.', 
  PRIMARY KEY  (`ID`),
  KEY `ID_MEMBRE` (`ID_MEMBRE`),
  KEY `ID_TOPIC` (`ID_TOPIC`),
  CONSTRAINT `forum_msg_ibfk_1` FOREIGN KEY (`ID_TOPIC`) REFERENCES `forum_topic` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les messages.';*/

DROP TABLE IF EXISTS forum_scat; 

/*CREATE TABLE `forum_scat` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant de la sous-cat�gorie.',
  `LIBELLE` varchar(255) character set latin1 NOT NULL COMMENT 'titre de la sous-cat�gorie.',
  `RANG` int(11) NOT NULL COMMENT 'position de la liste lors de l''affichage.', 
  `ID_CAT` int(11) NOT NULL COMMENT 'clef vers l''id primaire de la table cat�gorie', 
  `DESC` varchar(255) NOT NULL, 
  PRIMARY KEY  (`ID`), 
  KEY `ID_CAT` (`ID_CAT`), 
  CONSTRAINT `forum_scat_ibfk_1` FOREIGN KEY (`ID_CAT`) REFERENCES `forum_cat` (`ID`) ON DELETE CASCADE 
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='Table contenant les sous-cat�gories.';*/


DROP TABLE IF EXISTS forum_topic;

/*CREATE TABLE `forum_topic` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant du topic.',
  `LIBELLE` varchar(255) character set latin1 NOT NULL COMMENT 'titre du topic.',
  `ID_SCAT` int(11) NOT NULL COMMENT 'identifiant de la cat�gorie.',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `LIBELLE` (`LIBELLE`),
  KEY `ID_SCAT` (`ID_SCAT`),
  CONSTRAINT `forum_topic_ibfk_1` FOREIGN KEY (`ID_SCAT`) REFERENCES `forum_scat` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les topics de toutes les cat�gories.';*/




