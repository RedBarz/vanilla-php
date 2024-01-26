-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 jan. 2024 à 12:53
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vanilla`
--

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE IF NOT EXISTS `rendez_vous` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `date_heure` datetime DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `motif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `utilisateur_id`, `date_heure`, `heure`, `motif`) VALUES
(13, 9, '2024-01-25 09:00:00', '09:00:00', 'motif 1.1'),
(12, 7, '2024-02-03 12:00:00', '12:00:00', 'motif 3'),
(11, 7, '2024-01-25 09:00:00', '09:00:00', 'motif 2'),
(10, 7, '2024-01-25 09:00:00', '09:00:00', 'motif 1'),
(9, 7, '2024-01-27 00:00:00', '10:00:00', 'changement motif test');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous2`
--

DROP TABLE IF EXISTS `rendez_vous2`;
CREATE TABLE IF NOT EXISTS `rendez_vous2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `date_heure` datetime DEFAULT NULL,
  `motif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(7, 'test', 'red', 'connexion@fr.fr', '$2y$10$Tdk8AxfzuQrUFTRq2nHxiuPD6SOpYGhySGc4PSjrc9OQhSspFoME6'),
(3, 'test4', 'red2', 'test@test.fr', '$2y$10$6lCHW.wZf/WGmZEl5.ZF4ud8uMDs4/bGJKsTYS1po7Mi4KgDseOGm'),
(6, 'test', 'red', 'za@za.fr', '$2y$10$ezyEEBIrrqNkThZ1JUgzNO3S7/j9M1/kAH4HWxTfan0VVijReOOJK'),
(5, 'salut2', 'cestmoi2', 'barzcorp.fx2@gmail.com', '$2y$10$M/VSqYMHwvtUgmLW7nnNp.ifK8tudDAMV13adYotOtzTg9N2Xz8cq'),
(8, 'salut', 'cestmoi', 'test@test.fr', '$2y$10$JNvU4ylPRBMO5mc3l5k/SuYGJVGgZ1DmyNh8xrjfaCnF2AocOgl/S'),
(9, 'red1', 'red1', 'email1@mail.com', '$2y$10$v4Kb3saHPUU4Tq9GdUfzweViFRebZr1XhcNwP8zEnCf1BBUIPHVia');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
