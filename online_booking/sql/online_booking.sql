-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 04:52 PM
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
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` varchar(10) NOT NULL,
  `memberID` int(10) DEFAULT NULL,
  `guestEmail` varchar(200) DEFAULT NULL,
  `guestFirstName` varchar(200) DEFAULT NULL,
  `guestLastName` varchar(200) DEFAULT NULL,
  `commentText` text NOT NULL,
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
  `memberID` int(10) NOT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`lastName`, `firstName`, `mailingAddress`, `phoneNumber`, `memberID`, `emailAddress`, `password`) VALUES
('admin', 'super', 'Room A, Floor 10,\r\nABC Building,\r\nHello World Street,\r\nHK', '12345678', 1, 'admin@testing.com', '$2y$10$Y7Go6CL35CFEHhh7xcaNpuMjm2E9Kms6RGHlVKCszvEy7PtjbteBq');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `roomGrade` varchar(255) NOT NULL,
  `checkIn` datetime NOT NULL,
  `checkOut` datetime NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `totalCost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `roomGrade` varchar(20) NOT NULL,
  `roomSpec` varchar(600) NOT NULL,
  `roomPrice` decimal(10,2) NOT NULL,
  `roomIMG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`roomGrade`, `roomSpec`, `roomPrice`, `roomIMG`) VALUES
('Deluxe', 'Deluxe Rooms offer deluxe and detailed settings for every fabric. The room is designed to be as relaxing as possible, the extra space in the room is crucial for a comfortable stay.\r\n\r\nRoom details:\r\n1 Queen size bed,\r\n1 Bathroom,\r\nAccommodation for 2 adults,\r\nHigh-speed Wi-Fi, In-room TV, \r\nand Work desk with an ergonomic chair', 800.00, 'Deluxe-01.jpg'),
('Executive', 'Executive rooms offer business-class luxury fully equipped with IoTs, which let our guests set up the room with ease. The spacious room also has all kinds of designer furniture.\r\n\r\nRoom details:\r\n2 King size bed,\r\n2 Bathroom,\r\nAccommodation for 2 adults,\r\n1 Gbps Wi-Fi, In-room TV with all world channels, \r\nand Work desk with top-of-the-line computers.', 1000.00, 'Executive-01.jpg'),
('Presidential', 'Presidential rooms are world-class standard rooms in terms of luxury and space. The 2500 sq. ft room will provide in-room spas, a gym, a movie room, and more. The private entertainment and luxurious comfort will grant you the best stay.\r\n\r\nRoom details:\r\n4 King size beds,\r\n4 Bathroom,\r\nAccommodation for 8 adults,\r\n1 Gbps Wi-Fi, In-room TV with all world channels, \r\nand 2 Work desks with top-of-the-line computers.', 3000.00, 'Presidential-01.jpg'),
('Standard', 'Standard Rooms offer basic luxury for both leisure and business travelers. Every room has enormous windows that capture the scenic ocean view.\r\n\r\nRoom details:\r\n1 Queen size bed,\r\n1 Bathroom,\r\nAccommodation for 2 adults,\r\nHigh-speed Wi-Fi, In-room TV, \r\nand Work desk with an ergonomic chair', 500.00, 'Standard-01.jpg'),
('Suite', 'Suite rooms are designed to provide luxury with as much space as possible. The separated living and sleeping areas, allow guests to entertain families or visitors and relax in a more spacious environment.\r\n\r\nRoom details:\r\n2 King size beds,\r\n1 Queen size bed,\r\n3 Bathroom,\r\nAccommodation for 6 adults,\r\n1 Gbps Wi-Fi, In-room TV with all world channels, \r\nand 2 Work desks with top-of-the-line computers.', 1500.00, 'Suite-01.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomGrade` (`roomGrade`),
  ADD KEY `emailAddress` (`emailAddress`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD PRIMARY KEY (`roomGrade`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`roomGrade`) REFERENCES `room_details` (`roomGrade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`emailAddress`) REFERENCES `member` (`emailAddress`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
