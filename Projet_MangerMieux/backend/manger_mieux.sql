-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 nov. 2023 à 13:43
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `manger_mieux`
--

-- --------------------------------------------------------

--
-- Structure de la table `aliments`
--

DROP TABLE IF EXISTS `aliments`;
CREATE TABLE IF NOT EXISTS `aliments` (
  `ID_ALIMENT` int NOT NULL,
  `ID_TYPE` int NOT NULL,
  `NOM_ALIMENT` varchar(100) DEFAULT NULL,
  `Kcal` int NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`),
  KEY `NOM_ALIMENT` (`NOM_ALIMENT`),
  KEY `FK_ASSOCIATION_ALIMENT` (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `aliments`
--

INSERT INTO `aliments` (`ID_ALIMENT`, `ID_TYPE`, `NOM_ALIMENT`, `Kcal`) VALUES
(1, 4, 'Poulet', 106),
(2, 2, 'Tomates', 0),
(3, 3, 'P?tes', 0);

-- --------------------------------------------------------

--
-- Structure de la table `composition_aliment`
--

DROP TABLE IF EXISTS `composition_aliment`;
CREATE TABLE IF NOT EXISTS `composition_aliment` (
  `ID_ALIMENT` int NOT NULL,
  `ID_NUTRIMENT` int NOT NULL,
  `QUANTITE_POUR_100G` float DEFAULT NULL,
  PRIMARY KEY (`ID_ALIMENT`,`ID_NUTRIMENT`),
  KEY `FK_COMPOSITION_ALIMENT2` (`ID_NUTRIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `composition_aliment`
--

INSERT INTO `composition_aliment` (`ID_ALIMENT`, `ID_NUTRIMENT`, `QUANTITE_POUR_100G`) VALUES
(1, 1, 23),
(1, 3, 1.5);

-- --------------------------------------------------------

--
-- Structure de la table `composition_plat`
--

DROP TABLE IF EXISTS `composition_plat`;
CREATE TABLE IF NOT EXISTS `composition_plat` (
  `ID_PLAT` int NOT NULL,
  `ID_ALIMENT` int NOT NULL,
  `POURCENTAGE` float DEFAULT NULL,
  PRIMARY KEY (`ID_PLAT`,`ID_ALIMENT`),
  KEY `FK_COMPOSITION_PLAT2` (`ID_ALIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `composition_plat`
--

INSERT INTO `composition_plat` (`ID_PLAT`, `ID_ALIMENT`, `POURCENTAGE`) VALUES
(1, 2, 50),
(1, 3, 50),
(2, 1, 100);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (

  `ID_HISTORIQUE` int NOT NULL,	
  `ID_USER` int NOT NULL,
  `ID_PLAT` int NOT NULL,
  `DATE` date DEFAULT NULL,
  `QUANTITE` int DEFAULT NULL,
  PRIMARY KEY (`ID_HISTORIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`ID_USER`, `ID_PLAT`, `DATE`, `ID_HISTORIQUE`, `QUANTITE`) VALUES
(1, 1, '2023-11-09', 1, NULL),
(2, 1, '2023-11-09', 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nutriments`
--

DROP TABLE IF EXISTS `nutriments`;
CREATE TABLE IF NOT EXISTS `nutriments` (
  `ID_NUTRIMENT` int NOT NULL,
  `NOM_NUTRIMENT` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_NUTRIMENT`),
  KEY `NOM_NUTRIMENT` (`NOM_NUTRIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `nutriments`
--

INSERT INTO `nutriments` (`ID_NUTRIMENT`, `NOM_NUTRIMENT`) VALUES
(6, 'calcium'),
(3, 'fat'),
(4, 'fiber'),
(7, 'iron'),
(10, 'potassium'),
(1, 'proteins'),
(2, 'sugars'),
(8, 'vitamin-a'),
(5, 'vitamin-c'),
(9, 'vitamin-d');

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

DROP TABLE IF EXISTS `plats`;
CREATE TABLE IF NOT EXISTS `plats` (
  `ID_PLAT` int NOT NULL,
  `NOM_PLAT` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_PLAT`),
  KEY `NOM_PLAT` (`NOM_PLAT`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`ID_PLAT`, `NOM_PLAT`) VALUES
(1, 'Pates bolo'),
(2, 'Poulet');

-- --------------------------------------------------------

--
-- Structure de la table `pratique_sportive`
--

DROP TABLE IF EXISTS `pratique_sportive`;
CREATE TABLE IF NOT EXISTS `pratique_sportive` (
  `ID_PRATIQUE` int NOT NULL,
  `NIVEAU` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_PRATIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `pratique_sportive`
--

INSERT INTO `pratique_sportive` (`ID_PRATIQUE`, `NIVEAU`) VALUES
(1, 'Faible');

-- --------------------------------------------------------

--
-- Structure de la table `type_aliment`
--

DROP TABLE IF EXISTS `type_aliment`;
CREATE TABLE IF NOT EXISTS `type_aliment` (
  `ID_TYPE` int NOT NULL,
  `NOM_TYPE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `type_aliment`
--

INSERT INTO `type_aliment` (`ID_TYPE`, `NOM_TYPE`) VALUES
(1, 'unsweetened-beverages'),
(2, 'vegetables'),
(3, 'cereals'),
(4, 'poultry');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_USER` int NOT NULL,
  `ID_PRATIQUE` int NOT NULL,
  `NOM` varchar(100) DEFAULT NULL,
  `PRENOM` varchar(100) DEFAULT NULL,
  `GENRE` varchar(100) DEFAULT NULL,
  `TAILLE` float DEFAULT NULL,
  `POIDS` float DEFAULT NULL,
  `AGE` int DEFAULT NULL,
  `LOGIN` varchar(100) DEFAULT NULL,
  `MOT_DE_PASSE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `NOM` (`NOM`),
  KEY `LOGIN` (`LOGIN`),
  KEY `FK_ASSOCIATION_SPORT` (`ID_PRATIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_USER`, `ID_PRATIQUE`, `NOM`, `PRENOM`, `GENRE`, `TAILLE`, `POIDS`, `AGE`, `LOGIN`, `MOT_DE_PASSE`) VALUES
(1, 1, 'Test', 'test', 'test', 100, 100, 30, 'a', 'b'),
(2, 1, 'm', 'm', 'masculin', 178, 78, 23, 'm', 'm'),
(3, 1, 'Delsart', 'Martin', 'masculin', 178, 80, 22, 'Marty', 'a'),
(4, 1, 'Delsart', 'Martin', 'masculin', 180, 80, 22, 'Armand', 'a'),
(5, 1, 'test', 'client', 'masculin', 183, 79, 22, 'Client', 'azert');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aliments`
--
ALTER TABLE `aliments`
  ADD CONSTRAINT `FK_ASSOCIATION_ALIMENT` FOREIGN KEY (`ID_TYPE`) REFERENCES `type_aliment` (`ID_TYPE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `composition_aliment`
--
ALTER TABLE `composition_aliment`
  ADD CONSTRAINT `FK_COMPOSITION_ALIMENT` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliments` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_COMPOSITION_ALIMENT2` FOREIGN KEY (`ID_NUTRIMENT`) REFERENCES `nutriments` (`ID_NUTRIMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `composition_plat`
--
ALTER TABLE `composition_plat`
  ADD CONSTRAINT `FK_COMPOSITION_PLAT` FOREIGN KEY (`ID_PLAT`) REFERENCES `plats` (`ID_PLAT`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_COMPOSITION_PLAT2` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliments` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_HISTORIQUE` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_HISTORIQUE2` FOREIGN KEY (`ID_PLAT`) REFERENCES `plats` (`ID_PLAT`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_ASSOCIATION_SPORT` FOREIGN KEY (`ID_PRATIQUE`) REFERENCES `pratique_sportive` (`ID_PRATIQUE`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
