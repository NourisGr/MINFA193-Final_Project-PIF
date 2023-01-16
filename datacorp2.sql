DROP Database datacorp2;

CREATE Database datacorp2;

USE  datacorp2;
-- Database: `datacorp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `Badgeid` int(11) NOT NULL,
  `RFIDkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`Badgeid`, `RFIDkey`) VALUES
(1, '7418529638'),
(2, 'AB123'),
(3, 'AB123F'),
(4, 'AB57FC'),
(5, 'FC12'),
(6, 'FCA12'),
(7, 'ABC14'),
(8, 'ACV17');

-- --------------------------------------------------------

--
-- Table structure for table `conference_rooms`
--

CREATE TABLE `conference_rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `room_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conference_rooms`
--

INSERT INTO `conference_rooms` (`room_id`, `room_number`, `room_capacity`, `room_description`) VALUES
(1, 'B04', 20, 'The Room has a projector and 20 laptops with docking stations');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`first_name`, `email`, `last_name`, `password`, `group`, `RFIDBadge`) VALUES
('Fanourios Gerasimos', 'minfa193@365.education.lu', 'Miniatis', 'LPEM', 1, 1),
('Test', 'test123@gmail.com', 'User', '$2y$10$PRHncSB5eS/fLz9ui9s7IuaBJD8b0rC596LD1THTTmGbE75SQt5jm', 1, 6),
('Test52', 'test52@gmail.com', 'Test52', '$2y$10$vOzlmhtb4BtPm.51eZ3Aw.g0nBpYKnn2LD9MtyU.OV/4fBWwuvK42', 1, 4),
('TestUser', 'testuser2@gmail.com', 'TestUser', '$2y$10$CRqScjSzPQtAlJrWhrf3AuQJZdeTKUzrDuHFeTg2/OuGxgFE0gFRC', 1, 3),
('TestUser', 'testuser@gmail.com', 'TestUser', '$2y$10$vALlzsh6Rbg49.rDpnfXvOXLbJBcJmMhi/J8gAfOvayO/ZN8N501a', 1, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups_permitions`
--

INSERT INTO `groups_permitions` (`group_id`, `group_name`, `administrator`, `open_doors_when_free`, `can_reserv`, `view_sensitive_data`) VALUES
(1, 'Administrator', 1, 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_reservation`
--

INSERT INTO `info_reservation` (`res_room`, `res_date`, `res_purpose`, `res_id`, `res_userEmail`) VALUES
(1, '2022-12-16', 'Meeting with Microsoft for the presentation of the surfaces', 1, 'minfa193@365.education.lu'),
(1, '0000-00-00', '2023-01-12', 7, 'test123@gmail.com'),
(1, '0000-00-00', '                       test123 ', 8, 'test123@gmail.com'),
(1, '0000-00-00', '                       test123 ', 9, 'test123@gmail.com'),
(1, '2023-01-12', '                       test123 ', 10, 'test123@gmail.com'),
(1, '2023-01-12', '                       test123 ', 12, 'test123@gmail.com'),
(1, '2023-01-13', '                        test123', 13, 'test123@gmail.com'),
(1, '2023-01-17', 'abc123', 14, 'test123@gmail.com'),
(1, '2023-01-17', '                        test123', 15, 'test123@gmail.com'),
(1, '2023-01-17', '                        test123', 16, 'test123@gmail.com'),
(1, '2023-01-17', '                        test123', 17, 'test123@gmail.com'),
(1, '2023-01-17', '                        test123', 18, 'test123@gmail.com'),
(1, '2023-01-17', '                        test123', 19, 'test123@gmail.com'),
(1, '2023-01-17', '                        test123', 20, 'test123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_reservations`
--

CREATE TABLE `list_of_reservations` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `res_time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_of_reservations`
--

INSERT INTO `list_of_reservations` (`id`, `res_id`, `res_time_id`) VALUES
(1, 1, 2),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `time_of_reservation`
--

CREATE TABLE `time_of_reservation` (
  `id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `Badgeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conference_rooms`
--
ALTER TABLE `conference_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups_permitions`
--
ALTER TABLE `groups_permitions`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info_reservation`
--
ALTER TABLE `info_reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `list_of_reservations`
--
ALTER TABLE `list_of_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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