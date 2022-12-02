-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 12:13 PM
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
('carmelomelvincent2@gmail.com', '$2y$10$AXaCLs6uMlMEY/2aPALm5.kc72zsETRXx7/CqdqZcdG.980j7PU3a', 0),
('carmelomelvincent@gmail.com', '$2y$10$zlKOHK1qQ1Os/h8MAi/fFO3xCCpzUKfJG9QIJp7XQsK5iKvQAtUSq', 0),
('test@email.com', '$2y$10$B602TJx63yjEP64b/r4d4e001RxLfXRqlCG2ervxDlGJ5hCo7lSGW', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_ID` int(10) NOT NULL,
  `emp_ID` int(10) NOT NULL,
  `pat_ID` int(10) NOT NULL,
  `service` enum('clean','pasta','d_crown','wisdom') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `state` enum('pending','accepted','completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE `emp_info` (
  `emp_ID` int(10) NOT NULL,
  `emp_fname` varchar(50) NOT NULL,
  `emp_lname` varchar(50) NOT NULL,
  `contactNo` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`emp_ID`, `emp_fname`, `emp_lname`, `contactNo`, `email`, `active`) VALUES
(4, 'Juan', 'Dela Cruz', '9254994400', 'test@email.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `pat_ID` int(10) NOT NULL,
  `pat_fname` varchar(30) NOT NULL,
  `pat_lname` varchar(30) NOT NULL,
  `contactNo` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`pat_ID`, `pat_fname`, `pat_lname`, `contactNo`, `email`) VALUES
(3, 'Mel Vincent', 'Carmelo', '9254976600', 'carmelomelvincent@gmail.com'),
(5, 'Carmelo, Mel Vincent T.', 'Carmelo', '9254976600', 'carmelomelvincent2@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_ID`),
  ADD KEY `EmpIdFK` (`emp_ID`),
  ADD KEY `PatIdFK` (`pat_ID`);

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD PRIMARY KEY (`emp_ID`),
  ADD KEY `EmpEmFK` (`email`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`pat_ID`),
  ADD KEY `PatEmFK` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_info`
--
ALTER TABLE `emp_info`
  MODIFY `emp_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `pat_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `EmpIdFK` FOREIGN KEY (`emp_ID`) REFERENCES `emp_info` (`emp_ID`),
  ADD CONSTRAINT `PatIdFK` FOREIGN KEY (`pat_ID`) REFERENCES `patient_info` (`pat_ID`);

--
-- Constraints for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD CONSTRAINT `EmpEmFK` FOREIGN KEY (`email`) REFERENCES `accounts` (`email`);

--
-- Constraints for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD CONSTRAINT `PatEmFK` FOREIGN KEY (`email`) REFERENCES `accounts` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
