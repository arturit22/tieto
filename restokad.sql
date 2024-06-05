-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 11:06 AM
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
(20, 'FOTOGRAFISKA', 'Telliskivi 60a-8', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `restokad`
--
ALTER TABLE `restokad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restokad`
--
ALTER TABLE `restokad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
