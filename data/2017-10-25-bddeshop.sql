-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 25 oct. 2017 à 06:41
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
-- Base de données :  `bddeshop2`
--
CREATE DATABASE IF NOT EXISTS `bddeshop2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bddeshop2`;

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
  `liste_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `label`, `quantity`, `category_id`, `liste_id`, `author`) VALUES
(4, 'poisson', '2 boites', 1, 1, 'Ben'),
(5, 'poisson', '2 boites', 1, 1, 'Ben'),
(6, 'frites', '1', 1, 2, 'Ben'),
(7, 'Bières', '1 pack', 2, 4, 'Ben'),
(10, 'frites', '1', 1, 2, 'Ben'),
(11, 'Bières', '1 pack', 2, 4, 'Maxence'),
(12, 'glaces', '?', 1, 4, 'Ben'),
(13, 'jus d\'orange', '2 boites', 2, 1, 'Ben'),
(15, 'Champagne', '12', 2, 4, 'Ben'),
(17, 'glace batman', '3', 1, 6, 'Ben'),
(18, 'herbe de provence', '4', 1, 2, 'Ben'),
(19, 'Tutu', '3', 2, 1, 'Ben'),
(20, 'citron glacé', '3', 1, 3, 'Ben'),
(21, 'jus d\'orange', '34', 2, 4, 'Ben'),
(22, 'fraise', '2kg', 1, 23, 'Ben'),
(23, 'Jus de Pomme', '3', 2, 23, 'Ben'),
(26, 'perrier', '2 bouteilles', 2, 2, 'Ben'),
(27, 'poulet frit', '2', 1, 2, 'Ben'),
(35, 'poisson pané', '9', 1, 29, 'ben');

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
  `public` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `admin_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listes de shopping';

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`id`, `label`, `date_creation`, `date_echeance`, `commentaires`, `nom_admin`, `mail_admin`, `public`, `url`, `admin_url`) VALUES
(1, 'Liste Test in db 1 - avion', '2017-10-09 05:40:17', '2017-10-26 22:00:00', 'test commentaires 2', 'Caen', 'bteillard@gmail.com', 1, 'azerty', 'Z'),
(2, 'test liste DB 2 private', '2017-10-09 05:41:06', '2018-05-18 02:00:00', 'Commentaire liste 2', 'John Doe', 'bteillard@gmail.com', 0, 'ZERTTY', 'E'),
(3, 'test liste DB 3 private', '2017-10-09 05:41:29', '2018-05-18 02:00:00', 'Commentaire liste 2', 'Simba', 'carrelcom@gmail.com', 0, 'LKJL', 'P'),
(4, 'test liste DB 4 public', '2017-10-09 05:42:10', '2018-09-18 02:00:00', 'Commentaire liste 2', 'Alladin', 'carrelcom@gmail.com', 1, 'KLJLKJKJDH', 'Q'),
(5, 'Creation liste from IHM', '2017-10-09 05:55:42', '2018-03-28 22:00:00', 'test', 'musika.academy@gmail.com', 'musika.academy@gmail.com', 1, 'LJKS976', 'D'),
(6, 'test liste Maxence', '2017-10-09 16:59:29', '2021-10-29 22:00:00', 'AA', 'petitM@mail.com', 'petitM@mail.com', 1, 'KJ6SIUYD0', 'F'),
(7, 'TEST AVEC URL', '2017-10-09 18:26:23', '2019-03-01 23:00:00', 'dslkdsj lqk', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, '4519ac', 'R'),
(8, 'TEST AVEC URL 2', '2017-10-09 18:27:36', '2020-03-01 23:00:00', 'Test commentaire', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, '134bteillard@gmail.comb38', 'T'),
(9, 'TEST AVEC URL 2', '2017-10-09 18:28:05', '2020-03-01 23:00:00', 'Test commentaire', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, '1348130cceb0ea446a4634fa69135ae266c2a418452b38', 'Y'),
(10, 'TEST AVEC URL 2', '2017-10-09 18:29:44', '2020-03-01 23:00:00', 'Test commentaire', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, 'DSlskj9', 'U'),
(11, 'TEST AVEC URL 2', '2017-10-09 18:30:17', '2020-03-01 23:00:00', 'Test commentaire', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, 'MTM0ODEzMGNjZWIwZWE0NDZhNDYzNGZhNjkxMzVhZTI2NmMyYTQxODQ1MmIzOA==', 'I'),
(12, 'TEST AVEC URL 2', '2017-10-09 18:31:27', '2020-03-01 23:00:00', 'Test commentaire', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, '134a428871071995c2a1fd44535dfff6712b38', 'O'),
(13, 'liste dimanche matin', '2017-10-09 19:50:06', '2019-03-01 23:00:00', 'lskdjq lkdj', 'berengere.cerna@gmail.com', 'berengere.cerna@gmail.com', 1, '60b96293b3e344c45615b7b8b1f87031eb19ac', 'A'),
(16, 'Aventure', '2017-10-09 20:00:38', '2019-03-01 23:00:00', 'Mike Horn & Shym', 'mhorn@mail.com', 'mhorn@mail.com', 1, '82d3e05e779be65ad0f5af1b742ca9a25469ac', 'S'),
(20, 'Shym', '2017-10-09 20:04:45', '2023-01-31 23:00:00', 'dsqmldqkmlk', 'roziu@oiuo.com', 'roziu@oiuo.com', 1, 'ac1c0ae10b7d6fab2280c47bd8fec75898d467', 'G'),
(21, 'tutu', '2017-10-12 05:07:36', '2021-04-02 22:00:00', 'lklkjkl ', 'toto@toto.com', 'toto@toto.com', 1, '48712066d09d36067a2b1b528fd6e1365b776d', '48712066d09d36067a2b1b528fd6e1365b77dd'),
(22, 'tintin test listemanagement', '2017-10-12 05:09:17', '2021-01-31 23:00:00', 'tintin', 'toto', 'toto@toto.com', 1, 'c1d12066d09d36067a2b1b528fd6e1365b795a', '46d6d0eea90ee2891a3b88167d60e2581027dd'),
(23, 'la liste de tutu', '2017-10-16 15:16:37', '2020-02-01 23:00:00', 'djdkdj', 'tutu@tutu.com', 'tutu@tutu.com', 1, '61bd2125960adb3796d12038d36b10410c3a89', '05df066add4411a95d2748644d73e3b8b2a7dd'),
(24, 'liste super U', '2017-10-20 21:12:04', '2020-11-29 23:00:00', 'tuitoiut oiu ltkj ', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, '591a428871071995c2a1fd44535dfff671219e', '813ace1e9ed8b6c1a227944e38b3d3dffea7dd'),
(25, 'liste intermarché', '2017-10-20 21:14:12', '2018-01-01 23:00:00', 'tuitoiut oiu ltkj lkj ', 'bteillard@gmail.com', 'bteillard@gmail.com', 1, 'b4ba428871071995c2a1fd44535dfff6712a78', '81396d69088626e51c016d07a9400f311407dd'),
(26, 'test Montauban', '2017-10-24 16:12:21', '2017-10-19 22:00:00', 'totot', 'ben', 'bteillard@gmail.com', 1, '5cd9583d59f00220e37bcc7aef27962f', 'b2ae21d86c6d7cf5384fb89a1139a5bf'),
(27, 'test Montauban', '2017-10-24 16:14:06', '2017-10-19 22:00:00', 'totot', 'ben', 'bteillard@gmail.com', 1, '8f477c9be1978fa9a4231a3070479cc3', 'd2de06d285adf292ae0013d999811953'),
(28, 'test Montauban 2', '2017-10-24 16:16:21', '2017-10-17 22:00:00', 'totot', 'ben', 'bteillard@gmail.com', 1, '52960e4b8749ed82a80737313c640ec1', 'e3a89b118eac977b7ff8569db31601b2'),
(29, 'test optique 2000', '2017-10-24 16:16:40', '2017-10-12 22:00:00', 'totot', 'benjamin', 'bteillard@gmail.com', 1, 'fddcd4c7aff95858dabf176cc0e6f43e', '9bbd2eaf732ab03452af358d39c8c7e8');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `date-inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `pwd`, `nickname`, `group_id`, `date-inscription`) VALUES
(8, 'bteillard@gmail.com', '0bdc9d2d256b3ee9daae347be6f4dc835a467ffe', 'ben', NULL, '2017-10-10 04:59:26'),
(9, 'carrelcom@gmail.com', '62908abb42d4ef8e997b97c579d18d90861a5ec7', 'carrel', NULL, '2017-10-10 15:12:11'),
(10, 'musika.academy@gmail.com', 'f9e2ac08676fc80b367b4babbab16e1b0b513b51', 'musika', NULL, '2017-10-10 19:28:09'),
(14, 'per@linmpi.pin', 'f77a698632aa3ae1c3a61652dca538d40672f279', 'perlimpimpin', NULL, '2017-10-21 16:09:54'),
(12, 'toto@toto.com', '5dd22b8b0610a48b81bb400732a0fb299d48c21f', 'toto', NULL, '2017-10-12 04:54:39'),
(13, 'tutu@tutu.com', '4873311e42f511918457d57fbce9eed93481875b', 'TUTU', NULL, '2017-10-16 15:14:38');

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
  ADD UNIQUE KEY `url` (`url`),
  ADD KEY `mail` (`mail_admin`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`mail`),
  ADD UNIQUE KEY `id` (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `listes`
--
ALTER TABLE `listes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
