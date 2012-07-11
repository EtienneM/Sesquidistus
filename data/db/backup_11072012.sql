-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 11 Juillet 2012 à 23:57
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sesquidistus`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_album` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'id de la catégorie',
  `titre` varchar(50) NOT NULL COMMENT 'titre',
  `contenu` text NOT NULL COMMENT 'contenu',
  PRIMARY KEY (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations du module club' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `titre` tinytext NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `duree` int(11) NOT NULL DEFAULT '1',
  `horaire_debut` tinytext NOT NULL,
  `horaire_fin` tinytext NOT NULL,
  `lieu` text NOT NULL,
  `id_lieu` int(11) NOT NULL,
  `contenu_photo` text NOT NULL,
  `contenu_video` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=397 ;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `description` text,
  `id_album` int(11) NOT NULL DEFAULT '1',
  `slideshow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=238 ;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_ultimate`
--

CREATE TABLE IF NOT EXISTS `lieu_ultimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `adresse` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) CHARACTER SET latin1 NOT NULL,
  `passwd` varchar(255) CHARACTER SET latin1 NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `LOGIN` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les membres.';

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_membre` int(4) NOT NULL COMMENT 'Clef étrangère vers la table membre',
  `prenom` varchar(50) NOT NULL COMMENT 'Prénom du joueur',
  `numero` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL COMMENT 'Adresse mail',
  `adhesion` date NOT NULL COMMENT 'Date d''adhésion au club',
  `avatar` tinytext NOT NULL,
  `question` varchar(100) NOT NULL COMMENT 'Question secrète',
  `reponse` varchar(100) NOT NULL COMMENT 'Réponse à la question secrète',
  `ancien` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_MEMBRE` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations sur les membres.' AUTO_INCREMENT=126 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_event`
--

CREATE TABLE IF NOT EXISTS `type_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `color` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `ultimate`
--

CREATE TABLE IF NOT EXISTS `ultimate` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'id de la catégorie',
  `titre` varchar(50) NOT NULL COMMENT 'titre',
  `contenu` text NOT NULL COMMENT 'contenu',
  PRIMARY KEY (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations du module ultimate' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `id_site` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `code` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_album` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type_event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
