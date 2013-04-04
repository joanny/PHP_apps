-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Sam 05 Novembre 2011 à 18:59
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `my_stick`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `id_admin` int(11) NOT NULL DEFAULT '0',
  `nom_utilisateur` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `nom_utilisateur`, `mot_de_passe`) VALUES
(0, 'toto', 'toto');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_type_tel` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_type_tel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_type_tel`, `libelle`) VALUES
(5, 'iphone 3G'),
(6, 'iphone 4'),
(7, 'iphone 3GS');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `num_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_commande`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`num_commande`, `date`, `id_utilisateur`) VALUES
(1, '2011-11-03', 1),
(2, '2011-11-03', 1),
(3, '2011-11-03', 1),
(4, '2011-11-03', 1),
(5, '2011-11-04', 1),
(6, '2011-11-04', 1),
(7, '2011-11-04', 1),
(8, '2011-11-04', 1),
(9, '2011-11-05', 5),
(10, '2011-11-05', 5);

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `num_commande` int(11) NOT NULL DEFAULT '0',
  `id_produit` int(11) NOT NULL DEFAULT '0',
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`num_commande`,`id_produit`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenir`
--

INSERT INTO `contenir` (`num_commande`, `id_produit`, `quantite`) VALUES
(3, 452, 1),
(4, 451, 1),
(4, 453, 1),
(4, 454, 1),
(5, 448, 1),
(5, 449, 1),
(5, 450, 1),
(6, 447, 1),
(6, 451, 1),
(6, 452, 1),
(6, 453, 1),
(7, 448, 1),
(7, 449, 1),
(7, 450, 1),
(8, 448, 1),
(8, 449, 1),
(8, 450, 1),
(9, 455, 1),
(10, 448, 1),
(10, 449, 1);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE IF NOT EXISTS `couleur` (
  `id_couleur` int(11) NOT NULL DEFAULT '0',
  `libelle_couleur` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_couleur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `couleur`
--

INSERT INTO `couleur` (`id_couleur`, `libelle_couleur`) VALUES
(0, 'bleu'),
(1, 'rouge');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `num_newsletter` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num_newsletter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `newsletter`
--

INSERT INTO `newsletter` (`num_newsletter`, `adresse_mail`) VALUES
(1, 'moo@aza.com'),
(2, 'azer@gmail.com'),
(3, 'maa@mm.pll');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) DEFAULT NULL,
  `description` text,
  `image_produit` varchar(255) DEFAULT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `id_couleur` int(11) DEFAULT NULL,
  `id_type_tel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_couleur` (`id_couleur`),
  KEY `id_type_tel` (`id_type_tel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=481 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `description`, `image_produit`, `prix`, `id_couleur`, `id_type_tel`) VALUES
(447, 'nomm', 'ouverains . 	 	 	 	 	 	 	', 'images_produits/image_test/angry_girl_iphone_3g_1.jpg', '39.00', 0, 6),
(448, 'nom', 'ouverains . 	', 'images_produits/image_test/bacchanale_iphone_3g_1.jpg', '7.00', 0, 5),
(449, 'nom', 'ouverains . 	 	 	 	 	', 'images_produits/image_test/big_baldaquin_iphone_3g.jpg', '18.00', 0, 5),
(450, 'nom', 'ouverains . 	 	 	 	 	 	 	 	 	', 'images_produits/image_test/big_book_iphone_3g.jpg', '1.00', 0, 5),
(451, 'nom', 'ouverains . 	', 'images_produits/image_test/big_breaking_iphone_3g.jpg', '27.00', 0, 6),
(452, 'nom', 'ouverains . 	 	', 'images_produits/image_test/big_clouds_iphone_3g.jpg', '22.00', 0, 7),
(453, 'nom', 'ouverains . 	 	', 'images_produits/image_test/big_debilz_iphone_3g.jpg', '20.00', 0, 6),
(454, 'nom', 'ouverains . 	 	', 'images_produits/image_test/big_denied_iphone_3g.jpg', '36.00', 0, 6),
(455, 'nom', 'ouverains . 	 	 	 	 	', 'images_produits/image_test/big_ego_iphone_3g.jpg', '41.00', 0, 5),
(456, 'nom', 'ouverains . 	', 'images_produits/image_test/big_helvetica_iphone_3g.jpg', '14.00', 0, 6),
(457, 'nom', 'ouverains . 	 	 	 	', 'images_produits/image_test/big_high-noon_iphone_3g.jpg', '29.00', 0, 5),
(458, 'nom', 'ouverains .', 'images_produits/image_test/big_iphone3g_bellaluna.jpg', '37.00', 0, 5),
(459, 'nom', 'ouverains . 	', 'images_produits/image_test/big_ladybug_iphone_3g.jpg', '35.00', 0, 6),
(460, 'nom', 'ouverains .', 'images_produits/image_test/big_la_iphone3g-2.jpg', '10.00', 0, 5),
(461, 'nom', 'ouverains .', 'images_produits/image_test/big_leto_iphone_3g.jpg', '31.00', 0, 5),
(462, 'nom', 'ouverains .', 'images_produits/image_test/big_mariana_iphone_3g.jpg', '13.00', 0, 5),
(463, 'nom', 'ouverains .', 'images_produits/image_test/big_melancolia_iphone_3g.jpg', '31.00', 0, 5),
(464, 'nom', 'ouverains .', 'images_produits/image_test/angry_girl_iphone_3g_1.jpg', '33.00', 0, 5),
(465, 'nom', 'ouverains . 	', 'images_produits/image_test/bacchanale_iphone_3g_1.jpg', '39.00', 0, 5),
(466, 'nom', 'ouverains .mmm 	', 'images_produits/image_test/big_baldaquin_iphone_3g.jpg', '38.00', 0, 5),
(467, 'nom', 'ouverains . 	 	 	', 'images_produits/image_test/big_book_iphone_3g.jpg', '47.00', 0, 5),
(468, 'nom', 'ouverains .', 'images_produits/image_test/big_breaking_iphone_3g.jpg', '30.00', 0, 5),
(469, 'nom', 'ouverains .', 'images_produits/image_test/big_clouds_iphone_3g.jpg', '42.00', 0, 5),
(470, 'nom', 'ouverains .', 'images_produits/image_test/big_debilz_iphone_3g.jpg', '37.00', 0, 5),
(471, 'nom', 'ouverains .', 'images_produits/image_test/big_denied_iphone_3g.jpg', '40.00', 0, 5),
(472, 'nom', 'ouverains .', 'images_produits/image_test/big_ego_iphone_3g.jpg', '8.00', 0, 5),
(473, 'nom', 'ouverains . 	', 'images_produits/image_test/big_helvetica_iphone_3g.jpg', '8.00', 0, 5),
(474, 'nom', 'ouverains .', 'images_produits/image_test/big_high-noon_iphone_3g.jpg', '26.00', 0, 5),
(475, 'nom', 'ouverains .', 'images_produits/image_test/big_iphone3g_bellaluna.jpg', '31.00', 0, 5),
(476, 'nom', 'ouverains . 	 	', 'images_produits/image_test/big_ladybug_iphone_3g.jpg', '25.00', 0, 6),
(477, 'nom', 'ouverains .', 'images_produits/image_test/big_la_iphone3g-2.jpg', '23.00', 0, 5),
(478, 'nom', 'ouverains .', 'images_produits/image_test/big_leto_iphone_3g.jpg', '50.00', 0, 5),
(479, 'nom', 'ouverains .', 'images_produits/image_test/big_mariana_iphone_3g.jpg', '46.00', 0, 5),
(480, 'nom', 'ouverains .', 'images_produits/image_test/big_melancolia_iphone_3g.jpg', '20.00', 0, 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(35) DEFAULT NULL,
  `prenom` varchar(35) DEFAULT NULL,
  `rue` varchar(35) DEFAULT NULL,
  `ville` varchar(35) DEFAULT NULL,
  `code_postale` varchar(35) DEFAULT NULL,
  `pays` varchar(35) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse_electronique` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(35) DEFAULT NULL,
  `newsletter` char(3) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom`, `rue`, `ville`, `code_postale`, `pays`, `date_naissance`, `adresse_electronique`, `mot_de_passe`, `newsletter`) VALUES
(3, 'simporé', 'joanny', ' 9 av gaston monmousseau', 'aa', '12232', 'France', '1975-01-01', 'azer@gmail.com', 'aaaaaa', 'oui'),
(5, 'nom', 'joanny', ' 9 av gaston monmousseau', 'stain', '93240', 'France', '1975-01-01', 'moo@aza.com', '', 'non'),
(6, 'nom', 'joanny', ' 9 av gaston monmousseau', 'stain', '93240', 'France', '1975-01-01', 'moo@aza.com', '', 'non'),
(7, 'zzZZZZZZ', 'ZZ', 'ZZZ', 'aa', '93240', 'France', '1975-01-03', 'azer@gmail.com', 'ZZZZZZZZ', 'oui'),
(8, 'aa', 'aa', 'aa', 'aa', '93240', 'France', '1975-05-05', 'moo@aza.com', 'aa', 'oui');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`num_commande`) REFERENCES `commande` (`num_commande`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_couleur`) REFERENCES `couleur` (`id_couleur`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`id_type_tel`) REFERENCES `categorie` (`id_type_tel`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
