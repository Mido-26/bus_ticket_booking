-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 09:19 AM
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
-- Database: `bus_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `customerNo` varchar(255) NOT NULL,
  `busId` int(11) DEFAULT NULL,
  `seatNumber` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customerName`, `customerNo`, `busId`, `seatNumber`, `created_at`) VALUES
(1, 'Hamidu', '0628435704', 1, 26, '2024-07-25 18:09:13'),
(2, 'Hamidu', '0628435704', 1, 27, '2024-07-25 18:10:11'),
(3, 'Hamidu', '0628435704', 1, 28, '2024-07-25 18:10:11'),
(4, 'Dullah Omar', '0713694867', 1, 57, '2024-07-27 05:24:48');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `updateAvailableSeats` AFTER INSERT ON `booking` FOR EACH ROW BEGIN
    DECLARE T_b_seats INT;
    
    SELECT COUNT(*) INTO T_b_seats 
    FROM Booking 
    WHERE booking.busId = NEW.busId;
    
    UPDATE bus 
    SET bus.bookedSeats = T_b_seats 
    WHERE bus.id = NEW.busId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `busName` varchar(255) NOT NULL,
  `busNo` varchar(255) NOT NULL,
  `busModel` varchar(100) NOT NULL,
  `seatCapacity` int(11) NOT NULL,
  `bookedSeats` int(11) DEFAULT 0,
  `RouteId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `busName`, `busNo`, `busModel`, `seatCapacity`, `bookedSeats`, `RouteId`) VALUES
(1, 'Ratco Exp', 'T 267 EDF', '', 57, 4, 4),
(2, 'Aboud Exp', 'T 337 EFF', '', 57, 0, 4),
(3, 'Nacharo Express', 'T 287 DZZ', '', 57, 0, 4),
(4, 'Achimwene Express', 'T 450 EPF', 'Youtong  F12 Plus', 57, 0, 9),
(5, 'Achimwene Express', 'T 728 EPF', 'Youtong  F12 Plus', 57, 0, 10),
(6, 'Shabiby Express', 'T 545 EGG', 'ZHONGTONG', 57, 0, 8),
(7, 'Shabiby Express', 'T 545 EGL', 'ZHONGTONG', 57, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `bus_features`
--

CREATE TABLE `bus_features` (
  `id` int(11) NOT NULL,
  `busId` int(11) DEFAULT NULL,
  `feature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_features`
--

INSERT INTO `bus_features` (`id`, `busId`, `feature`) VALUES
(1, 2, 'Air Conditioning'),
(2, 2, 'WiFi'),
(3, 3, 'Air Conditioning'),
(4, 3, 'WiFi'),
(5, 4, 'Air Conditioning'),
(6, 4, 'WiFi'),
(7, 5, 'Air Conditioning'),
(8, 5, 'WiFi'),
(9, 6, 'Air Conditioning'),
(10, 6, 'WiFi'),
(11, 7, 'Air Conditioning'),
(12, 7, 'WiFi');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `roleName`) VALUES
(1, 'Admin'),
(2, 'BusOwner');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `pickupLocation` varchar(255) DEFAULT NULL,
  `dropLocation` varchar(255) DEFAULT NULL,
  `via` varchar(255) DEFAULT NULL,
  `DepartureTime` time NOT NULL,
  `ETA` time NOT NULL,
  `Price` float NOT NULL,
  `seat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `origin`, `destination`, `pickupLocation`, `dropLocation`, `via`, `DepartureTime`, `ETA`, `Price`, `seat_id`) VALUES
(4, 'Dar Es Salam', 'Tanga', 'Magufuli Stand kimara', 'Mkwakwani Stadium', 'Bagamoyo', '18:30:00', '23:30:00', 40000, 1),
(5, 'Dar Es Salam', 'Morogoro', 'Magufuli Stand kimara', 'Msamvu Stand', 'Morogoro', '10:00:00', '13:00:00', 17000, 2),
(6, 'Tanga', 'Dar Es Salam', 'Kange Stand', 'Mbezi Stand', 'Bagamoyo', '05:30:00', '11:30:00', 40000, 1),
(7, 'Tanga', 'Dar Es Salam', 'Kange Stand', 'Mbezi Stand', 'Bagamoyo', '12:30:00', '17:30:00', 22000, 2),
(8, 'Morogoro', 'Dodoma', 'Msamvu Stand', 'Dodoma Stand', 'Mdaula', '08:00:00', '12:00:00', 20000, 2),
(9, 'Mbeya', 'Dar Es Salam', 'Stand Kuu', 'Mbezi Stand', 'Makambako', '05:30:00', '20:30:00', 45000, 1),
(10, 'Mbeya', 'Dar Es Salam', 'Stand Kuu', 'Mbezi Stand', 'Makambako', '05:30:00', '20:30:00', 55000, 3),
(11, 'Dodoma', 'Dar Es Salam', 'Dodoma Stand', 'Mbezi Stand', 'Morogoro', '05:30:00', '17:30:00', 55000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `seat_type`
--

CREATE TABLE `seat_type` (
  `id` int(11) NOT NULL,
  `seatTypeName` varchar(255) NOT NULL,
  `columns` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat_type`
--

INSERT INTO `seat_type` (`id`, `seatTypeName`, `columns`) VALUES
(1, 'Luxury', 4),
(2, 'Semi-Luxury', 4),
(3, 'Vip', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `roleID`, `pass`) VALUES
(1, 'ochu', 2, 'd0a1f6b5f7841e9d33eb8606822d4ac2'),
(2, 'mido', 1, 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `busId` (`busId`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RouteId` (`RouteId`);

--
-- Indexes for table `bus_features`
--
ALTER TABLE `bus_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `busId` (`busId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seat` (`seat_id`);

--
-- Indexes for table `seat_type`
--
ALTER TABLE `seat_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bus_features`
--
ALTER TABLE `bus_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seat_type`
--
ALTER TABLE `seat_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`busId`) REFERENCES `bus` (`id`);

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`RouteId`) REFERENCES `route` (`id`);

--
-- Constraints for table `bus_features`
--
ALTER TABLE `bus_features`
  ADD CONSTRAINT `bus_features_ibfk_1` FOREIGN KEY (`busId`) REFERENCES `bus` (`id`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `fk_seat` FOREIGN KEY (`seat_id`) REFERENCES `seat_type` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
