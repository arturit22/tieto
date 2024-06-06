-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 01:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restod`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `kasutajanimi` varchar(50) NOT NULL,
  `parool` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `kasutajanimi`, `parool`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441');

-- --------------------------------------------------------

--
-- Table structure for table `hinnangud`
--

CREATE TABLE `hinnangud` (
  `id` int(11) NOT NULL,
  `kasutajanimi` varchar(255) NOT NULL,
  `hinnang` int(11) NOT NULL,
  `kommentaar` text DEFAULT NULL,
  `restoran_id` int(11) DEFAULT NULL,
  `loodud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hinnangud`
--

INSERT INTO `hinnangud` (`id`, `kasutajanimi`, `hinnang`, `kommentaar`, `restoran_id`, `loodud`) VALUES
(1, 'asdasdad', 10, 'asdsadasd', NULL, '2024-06-03 20:07:31'),
(2, 'asdasda', 10, 'asdasdsad', 1, '2024-06-03 20:11:55'),
(3, 'asdadad', 6, 'asdasdad', 1, '2024-06-03 20:12:02'),
(4, 'asdasdasd', 3, 'asdasdadasd', 2, '2024-06-03 20:14:52'),
(5, 'asdasdasd', 6, 'asdasdasd', 2, '2024-06-03 20:15:01'),
(6, 'asdasdda', 10, 'asdasdada', 2, '2024-06-03 21:03:23'),
(7, 'sadfasdfsa', 3, 'asdfasfs', 3, '2024-06-05 07:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `restokad`
--

CREATE TABLE `restokad` (
  `id` int(11) NOT NULL,
  `Nimi` varchar(255) NOT NULL,
  `Asukoht` varchar(255) NOT NULL,
  `Keskmine_hinne` int(11) DEFAULT 0,
  `Hinnatud_kordi` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restokad`
--

INSERT INTO `restokad` (`id`, `Nimi`, `Asukoht`, `Keskmine_hinne`, `Hinnatud_kordi`) VALUES
(1, '180 DEGREES BY MATTHIAS DIETHER', 'Staapli 4', 8, 2),
(2, '38', 'Olevimägi 9', 6, 3),
(3, 'ALEXANDER RESTAURANT AT PÄDASTE MANOR', 'Pädaste Mõist, Muhu saar', 3, 1),
(4, 'ÂME', 'Nunne 14', 0, 0),
(5, 'ANNO, KODURESTORAN & VEININURK', 'Poldri 3', 0, 0),
(6, 'ANTONIUS', 'Ülikooli 15', 0, 0),
(7, 'ART PRIORI', 'Olevimägi 7', 0, 0),
(8, 'BAOJAAM', 'Kopli 1', 0, 0),
(9, 'BARBAREA', 'Marati 5', 0, 0),
(10, 'BOTTENGARN', 'Koguva sadam, Muhu saar', 0, 0),
(11, 'CAFE TRUFFE', 'Raekoja plats 16', 0, 0),
(12, 'CASTELLO', 'Lossi 11, Kuressaare', 0, 0),
(13, 'CHEDI', 'Sulevimägi 1', 0, 0),
(14, 'CITY GRILL HOUSE', 'A. Laikmaa 5', 0, 0),
(15, 'CRU', 'Viru tn 8', 0, 0),
(16, 'DIRHAMI KALAKOHVIK', 'Dirhami sadam, Lääne-Nigula vald, Läänemaa', 0, 0),
(17, 'DOMINIC', 'Vene 10', 0, 0),
(18, 'F.BURGER', 'Viru Väljak 4-6', 0, 0),
(19, 'FII', 'Lääneringtee 39', 0, 0),
(21, 'framare', 'paralepa', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hinnangud`
--
ALTER TABLE `hinnangud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restoran_id` (`restoran_id`);

--
-- Indexes for table `restokad`
--
ALTER TABLE `restokad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hinnangud`
--
ALTER TABLE `hinnangud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `restokad`
--
ALTER TABLE `restokad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hinnangud`
--
ALTER TABLE `hinnangud`
  ADD CONSTRAINT `hinnangud_ibfk_1` FOREIGN KEY (`restoran_id`) REFERENCES `restokad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
