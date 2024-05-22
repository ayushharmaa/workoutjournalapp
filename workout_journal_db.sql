-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 07:56 AM
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
-- Database: `workout_journal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activities`
--

CREATE TABLE `tbl_activities` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `time_spent` varchar(50) DEFAULT NULL,
  `distance` varchar(50) DEFAULT NULL,
  `set_count` int(11) DEFAULT NULL,
  `reps` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_activities`
--

INSERT INTO `tbl_activities` (`activity_id`, `user_id`, `date`, `time_start`, `time_end`, `activity`, `time_spent`, `distance`, `set_count`, `reps`, `note`, `created_at`) VALUES
(1, 1, '2024-01-05', '13:00:00', '15:00:00', 'Jogging', '30 mins', '5 km', 0, 0, 'House to Market', '2024-01-05 06:53:40'),
(2, 1, '2024-01-05', '13:00:00', '15:00:00', 'Push Up', '0', '0', 3, 15, '', '2024-01-05 06:53:40'),
(3, 1, '2024-01-05', '13:00:00', '15:00:00', 'Bench Press', '0', '0', 3, 15, '', '2024-01-05 06:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `tbl_user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `contact_number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`tbl_user_id`, `first_name`, `last_name`, `weight`, `height`, `birthday`, `contact_number`, `email`, `username`, `password`) VALUES
(1, 'Lorem', 'Ipsum', 12, 12, '2023-11-23', 2147483647, 'lorem.ipsum@gmail.com', 'admin', 'admin'),
(2, 'John', 'Doe', 12, 232, '2024-01-05', 2147483647, 'remyandrade123@gmail.com', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`tbl_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `tbl_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD CONSTRAINT `tbl_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`tbl_user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
