-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 02:44 AM
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
-- Database: `body_goals`
--

-- --------------------------------------------------------

--
-- Table structure for table `strength`
--

CREATE TABLE `strength` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `times` varchar(50) NOT NULL,
  `type` text NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strength`
--

INSERT INTO `strength` (`id`, `date`, `times`, `type`, `cost`) VALUES
(12, '2024-07-16', '8 - 9 AM, 2 - 3 PM', '', 0),
(13, '2024-07-02', '8 - 9 AM, 10 - 11 AM, 2 - 3 PM', '', 0),
(14, '2024-07-02', '10 - 11 AM, 2 - 3 PM', '', 0),
(15, '2024-07-09', '4 - 5 PM, 8 - 9 PM', '', 0),
(16, '2024-07-23', '8 - 9 AM, 10 - 11 AM', '', 0),
(17, '2024-07-02', '4 - 5 PM, 8 - 9 PM', '', 16),
(18, '2024-07-09', '8 - 9 AM, 10 - 11 AM', '', 0),
(19, '2024-07-03', '8 - 9 PM', '', 0),
(20, '2024-07-09', '2 - 3 PM, 4 - 5 PM', '', 0),
(21, '2024-07-23', '10 - 11 AM, 8 - 9 PM', '', 0),
(22, '2024-07-09', '2 - 3 PM, 4 - 5 PM', 'Daily', 16),
(23, '2024-07-13', '8 - 9 AM, 10 - 11 AM, 2 - 3 PM, 4 - 5 PM', 'Daily', 16),
(24, '2024-07-06', '10 - 11 AM, 2 - 3 PM, 4 - 5 PM, 8 - 9 PM', 'Daily', 36),
(25, '2024-07-10', 'Monday - Tuesday AM, Wednesday - Thursday AM', 'Weekly', 45);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `uname` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `uname`, `phone`, `email`, `password`) VALUES
(1, 'c', 'vv', '6657766', 'mmjm@gmail.com', 'vv'),
(2, 'aasas', 'vvssssss', '87887777', 'pipago7887@fsouda.com', 'vvvv');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `strength`
--
ALTER TABLE `strength`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `strength`
--
ALTER TABLE `strength`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
