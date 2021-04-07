-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 avr. 2021 à 15:01
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizzip`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `NumCom` int NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `HeureDispo` time NOT NULL,
  `TypeEmbal` enum('carton','thermo') NOT NULL DEFAULT 'carton',
  `A_Livrer` enum('O','N') NOT NULL DEFAULT 'N',
  `EtatLivraison` enum('O','N') DEFAULT 'N',
  `CoutLiv` float(6,2) DEFAULT NULL,
  `IdLivreur` int DEFAULT NULL,
  `NomCli` varchar(200) NOT NULL,
  `PrenomCli` varchar(200) NOT NULL,
  `Tel` varchar(200) NOT NULL,
  `Adresse` varchar(200) DEFAULT NULL,
  `CodePostal` varchar(200) DEFAULT NULL,
  `Ville` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`NumCom`),
  UNIQUE KEY `ID_COMMANDE_IND` (`NumCom`),
  KEY `FKLivre` (`IdLivreur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_option`
--

DROP TABLE IF EXISTS `commande_option`;
CREATE TABLE IF NOT EXISTS `commande_option` (
  `Num_OF` int NOT NULL,
  `Quant` int NOT NULL,
  `NumCom` int NOT NULL,
  PRIMARY KEY (`Num_OF`),
  UNIQUE KEY `FKCon_OPT_IND` (`Num_OF`),
  KEY `FKCon_COM` (`NumCom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `NomFourn` char(25) NOT NULL,
  `Adresse` char(30) NOT NULL,
  `CodePostal` char(5) NOT NULL,
  `Ville` char(20) NOT NULL,
  `Tel` char(12) NOT NULL,
  `ParDefaut` enum('O','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`NomFourn`),
  UNIQUE KEY `ID_FOURNISSEUR_IND` (`NomFourn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur_ingredient`
--

DROP TABLE IF EXISTS `fournisseur_ingredient`;
CREATE TABLE IF NOT EXISTS `fournisseur_ingredient` (
  `NomFourn` char(25) NOT NULL,
  `NomIngred` char(20) NOT NULL,
  PRIMARY KEY (`NomFourn`,`NomIngred`),
  UNIQUE KEY `ID_Provient_IND` (`NomFourn`,`NomIngred`),
  KEY `FKPro_ING` (`NomIngred`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `NomIngred` char(20) NOT NULL,
  `Frais` char(1) NOT NULL,
  `Unite` char(10) NOT NULL DEFAULT 'sans',
  `StockMin` int NOT NULL,
  `StockReel` float NOT NULL,
  `PrixUHT` float NOT NULL,
  `Q_A_Com` int NOT NULL,
  PRIMARY KEY (`NomIngred`),
  UNIQUE KEY `ID_INGREDIENT_IND` (`NomIngred`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

DROP TABLE IF EXISTS `livreur`;
CREATE TABLE IF NOT EXISTS `livreur` (
  `IdLivreur` int NOT NULL AUTO_INCREMENT,
  `Nom` char(20) NOT NULL,
  `Prenom` char(20) NOT NULL,
  `Tel` char(16) NOT NULL,
  PRIMARY KEY (`IdLivreur`),
  UNIQUE KEY `ID_LIVREUR_IND` (`IdLivreur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `Num_OF` int NOT NULL AUTO_INCREMENT,
  `IngBase1` char(20) NOT NULL,
  `IngBase2` char(20) DEFAULT NULL,
  `IngBase3` char(20) DEFAULT NULL,
  `IngBase4` char(20) DEFAULT NULL,
  `IngOpt1` char(20) DEFAULT NULL,
  `IngOpt2` char(20) DEFAULT NULL,
  `IngOpt3` char(20) DEFAULT NULL,
  `IngOpt4` char(20) DEFAULT NULL,
  `NomPizza` char(25) NOT NULL,
  PRIMARY KEY (`Num_OF`),
  UNIQUE KEY `ID_OPTION_IND` (`Num_OF`),
  KEY `FKEstChoisi` (`NomPizza`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `option_ingredient`
--

DROP TABLE IF EXISTS `option_ingredient`;
CREATE TABLE IF NOT EXISTS `option_ingredient` (
  `NomIngred` char(20) NOT NULL,
  `Num_OF` int NOT NULL,
  PRIMARY KEY (`NomIngred`,`Num_OF`),
  UNIQUE KEY `ID_Utilise_IND` (`NomIngred`,`Num_OF`),
  KEY `FKUti_OPT` (`Num_OF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
CREATE TABLE IF NOT EXISTS `pizza` (
  `NomPizza` char(25) NOT NULL,
  `Taille` char(1) DEFAULT NULL,
  `NbIngBase` int DEFAULT NULL,
  `NbIngOpt` int DEFAULT NULL,
  `PrixUTTC` float NOT NULL,
  `Image` char(60) DEFAULT NULL,
  `IngBase1` char(20) NOT NULL,
  `IngBase2` char(20) DEFAULT NULL,
  `IngBase3` char(20) DEFAULT NULL,
  `IngBase4` char(20) DEFAULT NULL,
  `IngBase5` char(20) DEFAULT NULL,
  `IngOpt1` char(20) DEFAULT NULL,
  `IngOpt2` char(20) DEFAULT NULL,
  `IngOpt3` char(20) DEFAULT NULL,
  `IngOpt4` char(20) DEFAULT NULL,
  `IngOpt5` char(20) DEFAULT NULL,
  `IngOpt6` char(20) DEFAULT NULL,
  `NbOptMax` int DEFAULT '0',
  PRIMARY KEY (`NomPizza`),
  UNIQUE KEY `ID_PIZZA_IND` (`NomPizza`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pizza_ingredient`
--

DROP TABLE IF EXISTS `pizza_ingredient`;
CREATE TABLE IF NOT EXISTS `pizza_ingredient` (
  `NomIngred` char(20) NOT NULL,
  `NomPizza` char(25) NOT NULL,
  `Quant` int NOT NULL,
  PRIMARY KEY (`NomIngred`,`NomPizza`),
  UNIQUE KEY `ID_Comporte_IND` (`NomIngred`,`NomPizza`),
  KEY `FKCom_PRO` (`NomPizza`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
