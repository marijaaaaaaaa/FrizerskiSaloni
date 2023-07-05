-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 02:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frizerskisaloni`
--

-- --------------------------------------------------------

--
-- Table structure for table `salon`
--

CREATE TABLE `salon` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salon`
--

INSERT INTO `salon` (`id`, `userid`, `name`, `city`, `type`, `address`) VALUES
(1, 1, 'Beauty centar', 'Belgrade', 'Zenski', 'Majke Jevrosime 35'),
(2, 1, 'S Beauty', 'Belgrade', 'Farbanje', 'Požeška 48'),
(3, 2, 'Wow', 'Belgrade', 'Muski', 'Bulevar Zorana Djindjica 45'),
(4, 2, 'Studio Benvenuto', 'Belgrade', 'Pletenice', 'Vojvode Stepe 343'),
(5, 1, 'Beauty by Masha', 'Belgrade', 'Svecane frizure', 'Jurija Gagarina 14e');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `nationality`) VALUES
(1, 'marija.radic@gmail.com', 'marija', 'marija123', 'Serbia'),
(2, 'jelena@gmail.com', 'jelena', 'jelena123', 'Serbia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salon`
--
ALTER TABLE `salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salon`
--
ALTER TABLE `salon`
  ADD CONSTRAINT `salon_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
