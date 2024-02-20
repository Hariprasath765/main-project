-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 02:50 PM
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
-- Database: `data2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `ID` int(11) NOT NULL,
  `busNumber` varchar(100) NOT NULL,
  `route` varchar(100) NOT NULL,
  `timing` text NOT NULL,
  `busStopName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`ID`, `busNumber`, `route`, `timing`, `busStopName`) VALUES
(14, '10001', 'Udumalai - Pollachi', '10:00AM', 'Udumalai'),
(15, '10002', 'Tiruppur - Coimbatore', '08:00AM', 'Tiruppur'),
(16, '10003', 'Tiruppur - Erode', '06:00AM', 'Tiruppur'),
(17, '78', 'tiruchi', '10.00', 'Tiruppur'),
(18, '18', 'tirchi', '17.00', 'udumalai'),
(19, '18', 'tirchi', '17.00', 'udumalai'),
(20, '18', 'tirchi', '17.00', 'udumalai');

-- --------------------------------------------------------

--
-- Table structure for table `busstop`
--

CREATE TABLE `busstop` (
  `ID` int(11) NOT NULL,
  `busStopName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `busstop`
--

INSERT INTO `busstop` (`ID`, `busStopName`) VALUES
(1, 'Udumalai'),
(2, 'Tiruppur'),
(3, 'Tiruppur'),
(4, 'cheenai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `busstop`
--
ALTER TABLE `busstop`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `busstop`
--
ALTER TABLE `busstop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
