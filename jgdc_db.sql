-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 11:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jgdc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissionLvl` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`email`, `password`, `permissionLvl`) VALUES
('carmelomelvincent@gmail.com', '$2y$10$zlKOHK1qQ1Os/h8MAi/fFO3xCCpzUKfJG9QIJp7XQsK5iKvQAtUSq', 0),
('test2@gmail.com', '$2y$10$GHWEPjdVMcL7GMttBXIuoOU8FAegaFyBS4/bur7prYkzJ9.bVI6ai', 2),
('test3@gmail.com', '$2y$10$L45ACn9xQKA4w4Z8vFDVXubg3nSiAuyj/uWS8ERiz7ol8g03x8F1q', 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `account_ID` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `contactNo` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`account_ID`, `fname`, `lname`, `contactNo`, `email`) VALUES
(3, 'Mel Vincent', 'Carmelo', '9254976600', 'carmelomelvincent@gmail.com'),
(6, 'John', 'Doe', '9254976600', 'test2@gmail.com'),
(10, 'John', 'Doe', '9254976600', 'test3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_ID` int(10) NOT NULL,
  `account_ID` int(10) NOT NULL,
  `service` enum('clean','pasta','d_crown','wisdom') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `state` enum('pending','accepted','completed','declined','cancelled') NOT NULL,
  `branch` enum('s_simon','mexico') NOT NULL,
  `note` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_ID`, `account_ID`, `service`, `date`, `time`, `state`, `branch`, `note`) VALUES
(6, 3, 'clean', '2022-12-07', '21:30:00', 'accepted', 's_simon', ''),
(8, 3, 'pasta', '2022-12-09', '09:00:00', 'accepted', 'mexico', ''),
(9, 3, 'd_crown', '2022-12-14', '12:30:00', 'accepted', 's_simon', ''),
(10, 3, 'wisdom', '2022-12-21', '12:30:00', 'accepted', 'mexico', ''),
(11, 3, 'clean', '2023-01-11', '09:00:00', 'accepted', 's_simon', ''),
(12, 3, 'pasta', '2022-12-01', '09:00:00', 'declined', 'mexico', 'unnavailable'),
(13, 3, 'clean', '2022-12-06', '22:06:23', 'accepted', 's_simon', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`account_ID`),
  ADD KEY `EmFK` (`email`) USING BTREE;

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_ID`),
  ADD KEY `AccountIdFK` (`account_ID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_info`
--
ALTER TABLE `account_info`
  MODIFY `account_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_info`
--
ALTER TABLE `account_info`
  ADD CONSTRAINT `EmFK` FOREIGN KEY (`email`) REFERENCES `accounts` (`email`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `AccountIdFK` FOREIGN KEY (`account_ID`) REFERENCES `account_info` (`account_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
