-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 02:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` varchar(10) NOT NULL,
  `roomNumber` int(4) NOT NULL,
  `reservedStartDate` datetime NOT NULL,
  `reservedEndDate` datetime NOT NULL,
  `reservedStartTime` datetime NOT NULL,
  `reservedEndTime` datetime NOT NULL,
  `memberID` varchar(10) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `lastName` varchar(200) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `mailingAddress` varchar(200) NOT NULL,
  `phoneNumber` varchar(200) NOT NULL,
  `memberID` varchar(10) NOT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`lastName`, `firstName`, `mailingAddress`, `phoneNumber`, `memberID`, `emailAddress`, `password`) VALUES
('Cheung', 'Victor', 'taipo', '12345678', '0000000001', 'VictorCheung@testing.com', '123456'),
('Cheung', 'Victor', 'taipo', '12345678', '0000000002', 'VictorCheung', '123');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomNumber` int(4) NOT NULL,
  `roomGrade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `roomGrade` varchar(20) NOT NULL,
  `roomSpec` varchar(200) NOT NULL,
  `roomPrice` decimal(10,2) NOT NULL,
  `roomIMG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`roomGrade`, `roomSpec`, `roomPrice`, `roomIMG`) VALUES
('Deluxe', 'Deluxe Spec\r\n\r\nBed x2\r\nBathroom x2\r\n...', 800.00, 'Deluxe-01.jpg'),
('Executive', 'Executive Spec\r\n\r\nBed x3\r\n...', 1000.00, 'Executive-01.jpg'),
('Presidential', 'Presidential Spec\r\n\r\ntesting 123\r\n...', 3000.00, 'Presidential-01.jpg'),
('Standard', 'Standard Spec\r\n\r\n123456\r\nabcde\r\n....', 500.00, 'Standard-01.jpg'),
('Suite', 'Suite Spec\r\n\r\ntesting abc 123....\r\n...', 1500.00, 'Suite-01.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `roomNumber` (`roomNumber`),
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomNumber`),
  ADD KEY `roomGrade` (`roomGrade`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD PRIMARY KEY (`roomGrade`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`roomNumber`) REFERENCES `room` (`roomNumber`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`roomGrade`) REFERENCES `room_details` (`roomGrade`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
