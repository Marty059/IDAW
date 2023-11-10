-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- HÃ´te : 127.0.0.1:3306
-- GÃ©nÃ©rÃ© le : ven. 10 nov. 2023 Ã  21:32
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
-- Base de donnÃ©es : `manger_mieux`
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
  `CODE` bigint NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`),
  KEY `NOM_ALIMENT` (`NOM_ALIMENT`),
  KEY `FK_ASSOCIATION_ALIMENT` (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- DÃ©chargement des donnÃ©es de la table `aliments`
--

INSERT INTO `aliments` (`ID_ALIMENT`, `ID_TYPE`, `NOM_ALIMENT`, `Kcal`, `CODE`) VALUES
(1, 1, 'pasta', 359, 8076800195057),
(2, 1, 'filet de poulet blanc', 106, 3266980123994),
(3, 5, 'Prince Chocolat biscuits au ble complet', 467, 7622210449283),
(4, 1, 'Mes Carottes rapees a la ciboulette', 79, 3281780894950),
(5, 1, 'Haricots Verts Extra-fins Precuits Vapeur', 32, 3083680019408),
(6, 6, 'Nutella', 539, 3017620422003),
(7, 7, 'Le Pur Boeuf - Steaks haches surgeles', 209, 3227061000023),
(8, 8, 'Bananes', 90, 3347761000670),
(9, 1, 'Kiwi', 54, 94009569),
(11, 10, '6 oeufs frais de poules elevees au sol', 140, 3560071098278),
(12, 1, 'Tropicana 100% oranges pressees sans pulpe format familial 1,5 L', 43, 3502110006790);

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
-- DÃ©chargement des donnÃ©es de la table `composition_aliment`
--

INSERT INTO `composition_aliment` (`ID_ALIMENT`, `ID_NUTRIMENT`, `QUANTITE_POUR_100G`) VALUES
(1, 1, 13),
(1, 2, 3.5),
(1, 3, 2),
(1, 4, 3),
(2, 1, 23),
(2, 3, 1.5),
(3, 1, 6.3),
(3, 2, 32),
(3, 3, 17),
(3, 4, 4),
(4, 1, 1.1),
(4, 2, 5),
(4, 3, 5.2),
(4, 4, 2.8),
(5, 1, 2),
(5, 2, 1.7),
(5, 3, 0.2),
(5, 4, 3.1),
(6, 1, 6.3),
(6, 2, 56.3),
(6, 3, 30.9),
(7, 1, 18.5),
(7, 3, 15),
(7, 7, 0.0023),
(8, 1, 0.98),
(8, 2, 14.8),
(8, 3, 0.25),
(8, 4, 1.9),
(9, 1, 0.9),
(9, 2, 11),
(9, 3, 0.3),
(9, 4, 1.1),
(9, 5, 0.152),
(11, 1, 13),
(11, 2, 0.5),
(11, 3, 9.8),
(12, 1, 0.8),
(12, 2, 8.9),
(12, 4, 0.6),
(12, 5, 0.022);

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
-- DÃ©chargement des donnÃ©es de la table `composition_plat`
--

INSERT INTO `composition_plat` (`ID_PLAT`, `ID_ALIMENT`, `POURCENTAGE`) VALUES
(1, 1, 100),
(2, 2, 100),
(3, 3, 100),
(4, 4, 100),
(5, 5, 100),
(6, 6, 100),
(7, 7, 100),
(8, 8, 100),
(9, 9, 100),
(11, 11, 100),
(12, 12, 100);

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
  PRIMARY KEY (`ID_HISTORIQUE`),
  KEY `FK_HISTORIQUE` (`ID_USER`),
  KEY `FK_HISTORIQUE2` (`ID_PLAT`)
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- DÃ©chargement des donnÃ©es de la table `historique`
--

INSERT INTO `historique` (`ID_HISTORIQUE`, `ID_USER`, `ID_PLAT`, `DATE`, `QUANTITE`) VALUES
(3, 1, 1, '2023-11-10', 1),
(4, 1, 1, '2023-11-10', 76),
(5, 1, 2, '2023-11-10', 100),
(6, 1, 1, '2023-11-10', 65),
(7, 1, 1, '2023-11-10', 45);

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
-- DÃ©chargement des donnÃ©es de la table `nutriments`
--

INSERT INTO `nutriments` (`ID_NUTRIMENT`, `NOM_NUTRIMENT`) VALUES
(6, 'calcium'),
(3, 'gras'),
(4, 'fibre'),
(7, 'fer'),
(10, 'potassium'),
(1, 'proteins'),
(2, 'sucres'),
(8, 'vitamine-a'),
(5, 'vitamine-c'),
(9, 'vitamine-d');

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
-- DÃ©chargement des donnÃ©es de la table `plats`
--

INSERT INTO `plats` (`ID_PLAT`, `NOM_PLAT`) VALUES
(11, '6Oufs frais de poules elevees au sol'),
(8, 'Bananes'),
(2, 'filet de poulet blanc'),
(5, 'Haricots Verts Extra-fins Precuits Vapeur'),
(9, 'Kiwi'),
(7, 'Le Pur Boeuf - Steaks haches surgeles'),
(4, 'Mes Carottes rapees a la ciboulette'),
(6, 'Nutella'),
(1, 'pasta'),
(3, 'Prince Chocolat biscuits au ble complet'),
(12, 'Tropicana 100% oranges pressees sans pulpe format familial 1,5 L');

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
-- DÃ©chargement des donnÃ©es de la table `pratique_sportive`
--

INSERT INTO `pratique_sportive` (`ID_PRATIQUE`, `NIVEAU`) VALUES
(1, 'Faible'),
(2, 'Moyen'),
(3, 'Fort');

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
-- DÃ©chargement des donnÃ©es de la table `type_aliment`
--

INSERT INTO `type_aliment` (`ID_TYPE`, `NOM_TYPE`) VALUES
(1, 'boissons-non-sucrees'),
(2, 'legumes'),
(3, 'cereales'),
(4, 'poultry'),
(5, 'biscuits-et-gateaux'),
(6, 'bonbons'),
(7, 'viandes-autres-que-la-volaille'),
(8, 'fruits'),
(9, 'desserts-lactes'),
(10, 'oeufs');

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
-- DÃ©chargement des donnÃ©es de la table `users`
--

INSERT INTO `users` (`ID_USER`, `ID_PRATIQUE`, `NOM`, `PRENOM`, `GENRE`, `TAILLE`, `POIDS`, `AGE`, `LOGIN`, `MOT_DE_PASSE`) VALUES
(1, 1, 'Test', 'test', 'test', 100, 100, 30, 'a', 'b'),
(2, 1, 'm', 'm', 'masculin', 178, 78, 23, 'm', 'm'),
(3, 1, 'Delsart', 'Martin', 'masculin', 178, 80, 22, 'Marty', 'a'),
(4, 1, 'Delsart', 'Martin', 'masculin', 180, 80, 22, 'Armand', 'a'),
(5, 1, 'test', 'client', 'masculin', 183, 79, 22, 'Client', 'azert'),
(6, 1, 'admin', 'admin', 'homme', 1, 1, 1, 'admin', 'admin'),
(7, 3, 'piat', 'antonin', 'masculin', 170, 60, 21, 'antoninpiat', 'piat'),
(8, 1, 'p', 'p', 'masculin', 1, 1, 1, 'p', 'p'),
(9, 2, 'a', 'a', 'masculin', 1, 1, 1, 'a', 'a');

--
-- Contraintes pour les tables dÃ©chargÃ©es
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