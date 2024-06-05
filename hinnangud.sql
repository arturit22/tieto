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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hinnangud`
--
ALTER TABLE `hinnangud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restoran_id` (`restoran_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hinnangud`
--
ALTER TABLE `hinnangud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
