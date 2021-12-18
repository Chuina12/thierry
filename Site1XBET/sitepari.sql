-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 04 mai 2021 à 11:06
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sitepari`
--

-- --------------------------------------------------------

--
-- Structure de la table `actu`
--

CREATE TABLE `actu` (
  `id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_bin NOT NULL,
  `statut` varchar(15) COLLATE utf8_bin NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `actu`
--

INSERT INTO `actu` (`id`, `message`, `statut`, `date`) VALUES
(1, 'voici le premier message actu', 'online', 1620060534),
(2, 'bonjour voici le deuxieme message actu', 'online', 1620103746),
(3, 'bonjour voici le troisieme message actu', 'online', 1620103766);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `telephone` int(11) NOT NULL,
  `password` char(40) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `telephone`, `password`) VALUES
(1, 698284957, '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `methode_paiement` varchar(40) COLLATE utf8_bin NOT NULL,
  `total` double NOT NULL,
  `statut` varchar(15) COLLATE utf8_bin NOT NULL,
  `id_coupon` int(11) NOT NULL,
  `client_email` varchar(40) COLLATE utf8_bin NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `methode_paiement`, `total`, `statut`, `id_coupon`, `client_email`, `date`) VALUES
(1, 'orange money', 1000, 'process', 3, 'machele@gmail.com', 1620116127),
(2, 'mobile money', 5200, 'process', 7, 'paulhenry@gmail.com', 1620116373);

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(100) COLLATE utf8_bin NOT NULL,
  `type` varchar(12) COLLATE utf8_bin NOT NULL,
  `date` int(11) NOT NULL,
  `validite` int(11) NOT NULL,
  `statut` varchar(15) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin NOT NULL,
  `prix` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `type`, `date`, `validite`, `statut`, `description`, `prix`) VALUES
(3, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', 'melbet', 1620056635, 1118611800, 'online', 'code bonus 1x bet pour votre pari', 1000),
(4, '45f5f8/t85g5fed5e8d5', 'melbet', 1620057889, 1118599200, 'online', 'code bonus 1x bet pour votre pari', 800),
(5, '45f5f8/t85g5fed5e8d5', 'melbet', 1620057941, 1762887600, 'online', 'code bonus 1x bet pour votre pari', 800),
(6, 'd25e4rf5r8r5re5e5ee5hh8g5g8gh', '1xbet', 1620059516, 1257931800, 'online', 'code bonus 1x bet pour votre pari', 900),
(7, 'd25e4rf5r8r5re5e5ee5', 'melbet', 1620059781, 1620149700, 'online', 'code bonus 1x bet pour votre pari', 5200),
(8, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', '1xbet', 1620059911, 1620149700, 'online', 'code bonus 1x bet pour votre pari', 500),
(9, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', '1xbet', 1620059972, 1620149700, 'online', 'code bonus 1x bet pour votre pari', 500),
(10, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', '1xbet', 1620059983, 1620149700, 'online', 'code bonus 1x bet pour votre pari', 500),
(11, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', '1xbet', 1620060016, 1620149700, 'online', 'code bonus 1x bet pour votre pari', 500),
(12, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', '1xbet', 1620060185, 1620405660, 'online', 'code bonus 1x bet pour votre pari', 500),
(13, 'd25e4rf5r8r5re5e5ee5q5d8d5ddf', '1xbet', 1620060221, 1620405660, 'online', 'code bonus 1x bet pour votre pari', 500);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` varchar(60) COLLATE utf8_bin NOT NULL,
  `statut` varchar(15) COLLATE utf8_bin NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `path`, `statut`, `date`) VALUES
(2, '9a077b01c7fc4d294869fc597cea7ebb.jpg', 'offline', 1620068795),
(3, '69e4ae5bc13aab365913ac75dab58ac3.jpg', 'offline', 1620109481),
(4, '11e7ce264b0c9a1f2e874ed34e8e5cb5.jpg', 'online', 1620109638);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `Nom` varchar(40) COLLATE utf8_bin NOT NULL,
  `email` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id`, `Nom`, `email`) VALUES
(1, 'michelle sianto', 'machele@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actu`
--
ALTER TABLE `actu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_commande_fk` (`id_coupon`);

--
-- Index pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actu`
--
ALTER TABLE `actu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
