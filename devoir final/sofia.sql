-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2024 at 09:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

use Sofia;
--

-- --------------------------------------------------------

--
-- Table structure for table `CLIENTS`
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
-- Dumping data for table `CLIENTS`
--

INSERT INTO `CLIENTS` (`idClient`, `nomClient`, `typeClient`, `telClient`, `login`, `motPasse`) VALUES
(1, 'CompanyA', 0, '123456789', 'companyA_login', 'companyA_password'),
(2, 'GroupX', 1, '987654321', 'groupX_login', 'groupX_password'),
(3, 'zack', 0, ' 0632544', 'zack@gmail.com', '123'),
(4, 'hibouche', 0, ' 025525925', 'hibou@gmail.com', '12345'),
(5, 'hibah', 1, ' 0612463172', 'hibarochdi22@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `RESERVATIONS`
--

CREATE TABLE `RESERVATIONS` (
  `idReservation` INT(11) NOT NULL AUTO_INCREMENT,
  `dateMatch` DATE NOT NULL,
  `heureMatch` TIME NOT NULL,
  `idTerrain` INT(11) DEFAULT NULL,
  `idClient` INT(11) DEFAULT NULL,
  `duration` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idReservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT * FROM RESERVATIONS WHERE idReservation = 1;

ALTER TABLE RESERVATIONS
MODIFY COLUMN `heureMatch` TIME NOT NULL;




--
-- Dumping data for table `RESERVATIONS`
--

INSERT INTO `RESERVATIONS` (`dateMatch`, `heureMatch`, `heureFin`, `idTerrain`, `idClient`, `duration`) 
VALUES 
('2023-11-21', '18:00:00', '20:00:00', 1, 1, 2),
('2023-11-22', '20:00:00', '23:00:00', 2, 2, 3),
('2018-01-15', '18:00:00', '19:00:00', 1, 1, 1),
('2018-02-20', '20:00:00', '22:00:00', 2, 2, 2),
('2018-03-25', '18:00:00', '19:00:00', 1, 1, 1),
('2018-04-10', '20:00:00', '22:00:00', 2, 2, 2),
('2018-01-15', '18:00:00', '19:00:00', 1, 1, 1),
('2018-02-20', '20:00:00', '22:00:00', 2, 2, 2),
('2018-03-25', '18:00:00', '19:00:00', 1, 1, 1),
('2018-04-10', '20:00:00', '23:00:00', 2, 2, 3),
('2018-05-12', '15:00:00', '17:00:00', 1, 1, 2),
('2018-06-18', '22:00:00', '01:00:00', 2, 2, 3),
('2018-07-09', '16:00:00', '17:00:00', 1, 1, 1),
('2018-08-14', '21:00:00', '23:00:00', 2, 2, 2);




ALTER TABLE RESERVATIONS ADD heureFin TIME;
SELECT idReservation, dateMatch, heureMatch, heureFin, idTerrain, idClient, duration
FROM RESERVATIONS;
ALTER TABLE RESERVATIONS MODIFY idReservation INT AUTO_INCREMENT;
ALTER TABLE RESERVATIONS MODIFY idReservation INT AUTO_INCREMENT;




-- --------------------------------------------------------

--
-- Table structure for table `TARIFS`
--

CREATE TABLE `TARIFS` (
  `idTarif` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `TARIFS`
--

INSERT INTO `TARIFS` (`idTarif`, `categorie`, `prix`) VALUES
(1, 'Synthétique 5 joueurs', 400),
(2, 'Synthétique 7 joueurs', 500),
(3, 'Sol Plat 5 joueurs', 200),
(4, 'Sol Plat 7 joueurs', 300);

-- --------------------------------------------------------

--
-- Table structure for table `TERRAINS`
--

CREATE TABLE `TERRAINS` (
  `idTerrain` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `idTarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
UPDATE `RESERVATIONS`
SET `duration` = 
    CASE `idReservation`
        WHEN 1 THEN 2
        WHEN 2 THEN 3
        WHEN 3 THEN 1
        WHEN 4 THEN 2
        WHEN 5 THEN 1
        WHEN 6 THEN 3
        WHEN 7 THEN 1
        WHEN 8 THEN 2
        WHEN 9 THEN 1
        WHEN 10 THEN 3
        WHEN 11 THEN 2
        WHEN 12 THEN 3
        WHEN 13 THEN 1
        WHEN 14 THEN 2
    END
WHERE `idReservation` IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);

--
-- Dumping data for table `TERRAINS`
--

INSERT INTO `TERRAINS` (`idTerrain`, `etat`, `idTarif`) VALUES
(1, 0, 1),
(2, 0, 2),
(3, 1, 3),
(4, 2, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  ADD PRIMARY KEY (`idClient`);

--
-- Indexes for table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `idTerrain` (`idTerrain`),
  ADD KEY `idClient` (`idClient`);

--
-- Indexes for table `TARIFS`
--
ALTER TABLE `TARIFS`
  ADD PRIMARY KEY (`idTarif`);

--
-- Indexes for table `TERRAINS`
--
ALTER TABLE `TERRAINS`
  ADD PRIMARY KEY (`idTerrain`),
  ADD KEY `idTarif` (`idTarif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `TARIFS`
--
ALTER TABLE `TARIFS`
  MODIFY `idTarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `TERRAINS`
--
ALTER TABLE `TERRAINS`
  MODIFY `idTerrain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  ADD CONSTRAINT `RESERVATIONS_ibfk_1` FOREIGN KEY (`idTerrain`) REFERENCES `TERRAINS` (`idTerrain`),
  ADD CONSTRAINT `RESERVATIONS_ibfk_2` FOREIGN KEY (`idClient`) REFERENCES `CLIENTS` (`idClient`);

--
-- Constraints for table `TERRAINS`
--
ALTER TABLE `TERRAINS`
  ADD CONSTRAINT `TERRAINS_ibfk_1` FOREIGN KEY (`idTarif`) REFERENCES `TARIFS` (`idTarif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
