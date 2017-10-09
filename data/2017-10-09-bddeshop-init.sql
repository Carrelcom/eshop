-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 09 oct. 2017 à 07:50
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bddeshop`
--
CREATE DATABASE IF NOT EXISTS `bddeshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bddeshop`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `label_en` varchar(255) DEFAULT NULL,
  `label_fr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `label_en`, `label_fr`) VALUES
(1, 'Surgelés', 'Frozen'),
(2, 'Boissons', 'Beverages');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `label`, `quantity`, `category_id`, `liste_id`) VALUES
(4, 'poisson', '2 boites', 1, 1),
(5, 'poisson', '2 boites', 1, 1),
(6, 'frites', '1', 1, 2),
(7, 'Bières', '1 pack', 2, 4),
(9, 'poisson', '2 boites', 1, 1),
(10, 'frites', '1', 1, 2),
(11, 'Bières', '1 pack', 2, 4),
(12, 'glaces', '?', 1, 4),
(13, 'jus d\'orange', '2 boites', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

DROP TABLE IF EXISTS `listes`;
CREATE TABLE `listes` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_echeance` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `commentaires` text,
  `nom_admin` varchar(255) NOT NULL,
  `mail_admin` varchar(255) NOT NULL,
  `public` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listes de shopping';

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`id`, `label`, `date_creation`, `date_echeance`, `commentaires`, `nom_admin`, `mail_admin`, `public`) VALUES
(1, 'Liste Test in db 1 - public', '2017-10-09 05:40:17', '2018-01-01 09:00:00', 'test commentaires', 'Ben', 'bteilard@gmail.Com', 1),
(2, 'test liste DB 2 private', '2017-10-09 05:41:06', '2018-05-18 02:00:00', 'Commentaire liste 2', 'John Doe', 'bteillard@gmail.com', 0),
(3, 'test liste DB 3 private', '2017-10-09 05:41:29', '2018-05-18 02:00:00', 'Commentaire liste 2', 'Simba', 'carrelcom@gmail.com', 0),
(4, 'test liste DB 4 public', '2017-10-09 05:42:10', '2018-09-18 02:00:00', 'Commentaire liste 2', 'Alladin', 'carrelcom@gmail.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat-foreign-key` (`category_id`),
  ADD KEY `liste_id` (`liste_id`);

--
-- Index pour la table `listes`
--
ALTER TABLE `listes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail` (`mail_admin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `listes`
--
ALTER TABLE `listes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat-foreign-key` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`liste_id`) REFERENCES `listes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
