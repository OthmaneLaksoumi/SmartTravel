-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 09:56 PM
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
-- Database: `smarttravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `matricule` varchar(255) NOT NULL,
  `number_of_bus` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`matricule`, `number_of_bus`, `capacity`, `company_name`) VALUES
('AA-1234-56', 430001, 45, 'ctm'),
('AC-1234-56', 420002, 47, 'Pullman Du Sud'),
('AD-1234-56', 42001, 50, 'ctm');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`name`) VALUES
('Agadir'),
('Al Hoceima'),
('Azrou'),
('Beni Mellal'),
('Berkane'),
('Bouznika'),
('Casablanca'),
('Chefchaouen'),
('Dakhla'),
('El Jadida'),
('Errachidia'),
('Essaouira'),
('Fès'),
('Guelmim'),
('Ifrane'),
('Kénitra'),
('Khémisset'),
('Khénifra'),
('Khouribga'),
('Laâyoune'),
('Larache'),
('Marrakech'),
('Meknès'),
('Mohammedia'),
('Nador'),
('Ouarzazate'),
('Oujda'),
('Oulad Teima'),
('Oulmès'),
('Rabat'),
('Safi'),
('Salé'),
('Sefrou'),
('Settat'),
('Sidi Ifni'),
('Sidi Kacem'),
('Sidi Slimane'),
('Sidi Yahia El Gharb'),
('Skhirat'),
('Tamesna'),
('Tan-Tan'),
('Tanger'),
('Taza'),
('Témara'),
('Tétouan'),
('Tiflet'),
('Tinghir'),
('Tiznit'),
('Youssoufia'),
('Zagora');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`name`, `img`) VALUES
('ctm', 'public/images/company/ctm.jpg'),
('Pullman Du Sud', 'public/images/company/boulman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `horaire`
--

CREATE TABLE `horaire` (
  `departure_time` time NOT NULL,
  `destination_time` time NOT NULL,
  `matricule` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `available_seats` int(11) NOT NULL,
  `departure_city` varchar(255) NOT NULL,
  `destination_city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `departure_city` varchar(255) NOT NULL,
  `destination_city` varchar(255) NOT NULL,
  `distance` int(11) NOT NULL,
  `duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`departure_city`, `destination_city`, `distance`, `duration`) VALUES
('Marrakech', 'Casablanca', 300, '03:30:00'),
('Safi', 'El Jadida', 230, '02:20:00'),
('Safi', 'Essaouira', 150, '02:00:00'),
('Safi', 'Marrakech', 250, '02:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `company_name_fk` (`company_name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`departure_time`,`destination_time`,`matricule`),
  ADD KEY `matricule_fk` (`matricule`),
  ADD KEY `horaire_depart_fk` (`departure_city`),
  ADD KEY `horaire_destin_fk` (`destination_city`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`departure_city`,`destination_city`),
  ADD KEY `destination_city_fk` (`destination_city`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `company_name_fk` FOREIGN KEY (`company_name`) REFERENCES `company` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `horaire`
--
ALTER TABLE `horaire`
  ADD CONSTRAINT `horaire_depart_fk` FOREIGN KEY (`departure_city`) REFERENCES `route` (`departure_city`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `horaire_destin_fk` FOREIGN KEY (`destination_city`) REFERENCES `route` (`destination_city`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricule_fk` FOREIGN KEY (`matricule`) REFERENCES `bus` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `departure_city_fk` FOREIGN KEY (`departure_city`) REFERENCES `city` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destination_city_fk` FOREIGN KEY (`destination_city`) REFERENCES `city` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
