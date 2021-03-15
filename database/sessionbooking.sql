-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 06:12 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antara`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessionbooking`
--

CREATE TABLE `sessionbooking` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_no` bigint(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `amount` int(6) NOT NULL,
  `bookdate` date NOT NULL DEFAULT current_timestamp(),
  `expirydate` date NOT NULL,
  `session1` tinyint(1) NOT NULL,
  `session2` tinyint(1) NOT NULL,
  `paystatus` tinyint(1) NOT NULL,
  `paymode` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessionbooking`
--

INSERT INTO `sessionbooking` (`sr_no`, `name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`, `paymode`) VALUES
(1, 'shadab', 998765409, 'shady@gmail.com', 10000, '2021-03-13', '2021-03-13', 1, 0, 1, ''),
(2, 'shadab', 9876543210, 'demo@test.com', 3244, '0000-00-00', '2021-06-10', 1, 0, 1, 'online'),
(3, 'shadab', 9876543210, 'demo@test.com', 3244, '0000-00-00', '0000-00-00', 1, 0, 1, 'online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessionbooking`
--
ALTER TABLE `sessionbooking`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessionbooking`
--
ALTER TABLE `sessionbooking`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
