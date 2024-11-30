-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 28 nov. 2024 à 05:12
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sofia`
--

-- --------------------------------------------------------

--
-- Structure de la table `CLIENTS`
--

CREATE TABLE `CLIENTS` (
  `idClient` int(11) NOT NULL,
  `nomClient` varchar(100) NOT NULL,
  `typeClient` int(11) NOT NULL,
  `telClient` varchar(20) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `motPasse` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `CLIENTS`
--

INSERT INTO `CLIENTS` (`idClient`, `nomClient`, `typeClient`, `telClient`, `login`, `motPasse`) VALUES
(1, 'CompanyA', 0, '123456789', 'companyA_login', 'companyA_password'),
(2, 'GroupX', 1, '987654321', 'groupX_login', 'groupX_password'),
(3, 'zack', 0, ' 0632544', 'zack@gmail.com', '123');

-- --------------------------------------------------------

--
-- Structure de la table `RESERVATIONS`
--

CREATE TABLE `RESERVATIONS` (
  `idReservation` int(11) NOT NULL,
  `dateMatch` date NOT NULL,
  `heureMatch` int(11) NOT NULL,
  `idTerrain` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `RESERVATIONS`
--

INSERT INTO `RESERVATIONS` (`idReservation`, `dateMatch`, `heureMatch`, `idTerrain`, `idClient`) VALUES
(1, '2023-11-21', 18, 1, 1),
(2, '2023-11-22', 20, 2, 2),
(3, '2018-01-15', 18, 1, 1),
(4, '2018-02-20', 20, 2, 2),
(5, '2018-03-25', 18, 1, 1),
(6, '2018-04-10', 20, 2, 2),
(7, '2018-01-15', 18, 1, 1),
(8, '2018-02-20', 20, 2, 2),
(9, '2018-03-25', 18, 1, 1),
(10, '2018-04-10', 20, 2, 2),
(11, '2018-05-12', 15, 1, 1),
(12, '2018-06-18', 22, 2, 2),
(13, '2018-07-09', 16, 1, 1),
(14, '2018-08-14', 21, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `TARIFS`
--

CREATE TABLE `TARIFS` (
  `idTarif` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `TARIFS`
--

INSERT INTO `TARIFS` (`idTarif`, `categorie`, `prix`) VALUES
(1, 'Synthétique 5 joueurs', 400),
(2, 'Synthétique 7 joueurs', 500),
(3, 'Sol Plat 5 joueurs', 200),
(4, 'Sol Plat 7 joueurs', 300);

-- --------------------------------------------------------

--
-- Structure de la table `TERRAINS`
--

CREATE TABLE `TERRAINS` (
  `idTerrain` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `idTarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `TERRAINS`
--

INSERT INTO `TERRAINS` (`idTerrain`, `etat`, `idTarif`) VALUES
(1, 0, 1),
(2, 0, 2),
(3, 1, 3),
(4, 2, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `idTerrain` (`idTerrain`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `TARIFS`
--
ALTER TABLE `TARIFS`
  ADD PRIMARY KEY (`idTarif`);

--
-- Index pour la table `TERRAINS`
--
ALTER TABLE `TERRAINS`
  ADD PRIMARY KEY (`idTerrain`),
  ADD KEY `idTarif` (`idTarif`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `TARIFS`
--
ALTER TABLE `TARIFS`
  MODIFY `idTarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `TERRAINS`
--
ALTER TABLE `TERRAINS`
  MODIFY `idTerrain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  ADD CONSTRAINT `RESERVATIONS_ibfk_1` FOREIGN KEY (`idTerrain`) REFERENCES `TERRAINS` (`idTerrain`),
  ADD CONSTRAINT `RESERVATIONS_ibfk_2` FOREIGN KEY (`idClient`) REFERENCES `CLIENTS` (`idClient`);

--
-- Contraintes pour la table `TERRAINS`
--
ALTER TABLE `TERRAINS`
  ADD CONSTRAINT `TERRAINS_ibfk_1` FOREIGN KEY (`idTarif`) REFERENCES `TARIFS` (`idTarif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
