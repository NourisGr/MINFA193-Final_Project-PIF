-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 10:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datacorp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `Badgeid` int(11) NOT NULL,
  `RFIDkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`Badgeid`, `RFIDkey`) VALUES
(2, 'AB123'),
(3, 'AB123F'),
(4, 'AB57FC'),
(7, 'ABC14'),
(8, 'ACV17'),
(1, 'BC218'),
(9, 'BNC568'),
(5, 'CS123'),
(6, 'FCA12'),
(10, 'LWS198');

-- --------------------------------------------------------

--
-- Table structure for table `conference_rooms`
--

CREATE TABLE `conference_rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `room_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conference_rooms`
--

INSERT INTO `conference_rooms` (`room_id`, `room_number`, `room_capacity`, `room_description`) VALUES
(1, 'A01', 20, 'The Room has a projector and 20 laptops with docking stations'),
(2, 'A02', 15, 'The Room has a projector and 15 laptops with docking stations'),
(3, 'A03', 20, 'The Room has a projector and 20 laptops with docking stations'),
(4, 'A04', 15, 'The Room has a projector and 15 laptops with docking stations'),
(5, 'A05', 20, 'The Room has a projector and 20 laptops with docking stations'),
(6, 'A06', 15, 'The Room has a projector and 15 laptops with docking stations'),
(7, 'A07', 20, 'The Room has a projector and 20 laptops with docking stations'),
(8, 'A08', 15, 'The Room has a projector and 15 laptops with docking stations'),
(9, 'A09', 20, 'The Room has a projector and 20 laptops with docking stations'),
(10, 'A10', 15, 'The Room has a projector and 15 laptops with docking stations'),
(11, 'A11', 20, 'The Room has a projector and 20 laptops with docking stations'),
(12, 'A12', 15, 'The Room has a projector and 15 laptops with docking stations'),
(13, 'A13', 20, 'The Room has a projector and 20 laptops with docking stations'),
(14, 'A14', 15, 'The Room has a projector and 15 laptops with docking stations'),
(15, 'A15', 20, 'The Room has a projector and 20 laptops with docking stations'),
(16, 'A16', 15, 'The Room has a projector and 15 laptops with docking stations'),
(17, 'A17', 20, 'The Room has a projector and 20 laptops with docking stations'),
(18, 'A18', 15, 'The Room has a projector and 15 laptops with docking stations'),
(19, 'A19', 20, 'The Room has a projector and 20 laptops with docking stations'),
(20, 'A20', 15, 'The Room has a projector and 15 laptops with docking stations'),
(21, 'A21', 20, 'The Room has a projector and 20 laptops with docking stations'),
(22, 'A22', 15, 'The Room has a projector and 15 laptops with docking stations'),
(23, 'A23', 20, 'The Room has a projector and 20 laptops with docking stations'),
(24, 'A24', 15, 'The Room has a projector and 15 laptops with docking stations'),
(25, 'A25', 20, 'The Room has a projector and 20 laptops with docking stations'),
(26, 'A26', 15, 'The Room has a projector and 15 laptops with docking stations'),
(27, 'A27', 20, 'The Room has a projector and 20 laptops with docking stations'),
(28, 'A28', 15, 'The Room has a projector and 20 laptops with docking stations'),
(29, 'A29', 20, 'The Room has a projector and 20 laptops with docking stations'),
(30, 'A30', 15, 'The Room has a projector and 15 laptops with docking stations'),
(31, 'A31', 20, 'The Room has a projector and 20 laptops with docking stations'),
(32, 'A32', 15, 'The Room has a projector and 15 laptops with docking stations'),
(33, 'A33', 20, 'The Room has a projector and 20 laptops with docking stations'),
(34, 'A34', 15, 'The Room has a projector and 15 laptops with docking stations'),
(35, 'A35', 20, 'The Room has a projector and 20 laptops with docking stations'),
(36, 'A36', 15, 'The Room has a projector and 15 laptops with docking stations'),
(37, 'A37', 20, 'The Room has a projector and 20 laptops with docking stations'),
(38, 'A38', 15, 'The Room has a projector and 15 laptops with docking stations'),
(39, 'A39', 20, 'The Room has a projector and 20 laptops with docking stations'),
(40, 'A40', 15, 'The Room has a projector and 15 laptops with docking stations'),
(41, 'A41', 20, 'The Room has a projector and 20 laptops with docking stations'),
(42, 'A42', 15, 'The Room has a projector and 15 laptops with docking stations'),
(43, 'A43', 20, 'The Room has a projector and 20 laptops with docking stations'),
(44, 'A44', 15, 'The Room has a projector and 15 laptops with docking stations'),
(45, 'A45', 20, 'The Room has a projector and 20 laptops with docking stations'),
(46, 'A46', 15, 'The Room has a projector and 15 laptops with docking stations'),
(47, 'A47', 20, 'The Room has a projector and 20 laptops with docking stations'),
(48, 'A48', 15, 'The Room has a projector and 15 laptops with docking stations'),
(49, 'A49', 20, 'The Room has a projector and 20 laptops with docking stations'),
(50, 'A50', 15, 'The Room has a projector and 15 laptops with docking stations');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) NOT NULL,
  `RFIDBadge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`first_name`, `email`, `last_name`, `password`, `group`, `RFIDBadge`) VALUES
('Fanourios', 'minfa193@gmail.com', 'Miniatis', '$2y$10$b91tDdJtkj.jxGS2FVJV6OQ69zclzN8SqwREEK7.RWZFblYcVxrJ2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups_permitions`
--

CREATE TABLE `groups_permitions` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `administrator` tinyint(1) NOT NULL,
  `open_doors_when_free` tinyint(1) NOT NULL,
  `can_reserv` tinyint(1) NOT NULL,
  `view_sensitive_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups_permitions`
--

INSERT INTO `groups_permitions` (`group_id`, `group_name`, `administrator`, `open_doors_when_free`, `can_reserv`, `view_sensitive_data`) VALUES
(1, 'Administrator', 1, 1, 1, 1),
(2, 'CleaningStaff', 0, 1, 0, 0),
(3, 'Employee', 0, 1, 1, 0),
(4, 'EmployeeNotAdmitted', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `info_reservation`
--

CREATE TABLE `info_reservation` (
  `res_room` int(11) NOT NULL,
  `res_date` date NOT NULL,
  `res_purpose` varchar(255) NOT NULL,
  `res_id` int(11) NOT NULL,
  `res_userEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_of_reservations`
--

CREATE TABLE `list_of_reservations` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `res_time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_of_reservation`
--

CREATE TABLE `time_of_reservation` (
  `id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_of_reservation`
--

INSERT INTO `time_of_reservation` (`id`, `start_time`, `end_time`) VALUES
(1, 8, 9),
(2, 9, 10),
(3, 10, 11),
(4, 11, 12),
(5, 12, 13),
(6, 13, 14),
(7, 14, 15),
(8, 15, 16),
(9, 16, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`Badgeid`),
  ADD UNIQUE KEY `RFIDkey` (`RFIDkey`);

--
-- Indexes for table `conference_rooms`
--
ALTER TABLE `conference_rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `RFIDBadge` (`RFIDBadge`),
  ADD KEY `employees_group_foreign` (`group`);

--
-- Indexes for table `groups_permitions`
--
ALTER TABLE `groups_permitions`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `info_reservation`
--
ALTER TABLE `info_reservation`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `info_reservation_res_useremail_foreign` (`res_userEmail`),
  ADD KEY `info_reservation_res_room_foreign` (`res_room`);

--
-- Indexes for table `list_of_reservations`
--
ALTER TABLE `list_of_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_of_reservations_res_id_foreign` (`res_id`),
  ADD KEY `list_of_reservations_res_time_id_foreign` (`res_time_id`);

--
-- Indexes for table `time_of_reservation`
--
ALTER TABLE `time_of_reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `Badgeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conference_rooms`
--
ALTER TABLE `conference_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `groups_permitions`
--
ALTER TABLE `groups_permitions`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `info_reservation`
--
ALTER TABLE `info_reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `list_of_reservations`
--
ALTER TABLE `list_of_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `time_of_reservation`
--
ALTER TABLE `time_of_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_group_foreign` FOREIGN KEY (`group`) REFERENCES `groups_permitions` (`group_id`),
  ADD CONSTRAINT `employees_rfidBadge_foreign` FOREIGN KEY (`RFIDBadge`) REFERENCES `badge` (`Badgeid`);

--
-- Constraints for table `info_reservation`
--
ALTER TABLE `info_reservation`
  ADD CONSTRAINT `info_reservation_res_room_foreign` FOREIGN KEY (`res_room`) REFERENCES `conference_rooms` (`room_id`),
  ADD CONSTRAINT `info_reservation_res_useremail_foreign` FOREIGN KEY (`res_userEmail`) REFERENCES `employees` (`email`);

--
-- Constraints for table `list_of_reservations`
--
ALTER TABLE `list_of_reservations`
  ADD CONSTRAINT `list_of_reservations_res_id_foreign` FOREIGN KEY (`res_id`) REFERENCES `info_reservation` (`res_id`),
  ADD CONSTRAINT `list_of_reservations_res_time_id_foreign` FOREIGN KEY (`res_time_id`) REFERENCES `time_of_reservation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
