-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 06:13 PM
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
-- Table structure for table `sessiontxn`
--

CREATE TABLE `sessiontxn` (
  `sr_no` int(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(13) NOT NULL,
  `orderid` varchar(15) NOT NULL,
  `mid` varchar(25) NOT NULL,
  `txnid` int(50) NOT NULL,
  `tamount` float NOT NULL,
  `paymode` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `tdate` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `respmsg` varchar(20) NOT NULL,
  `gatewayname` varchar(30) NOT NULL,
  `banktxnid` int(50) NOT NULL,
  `bankname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessiontxn`
--

INSERT INTO `sessiontxn` (`sr_no`, `name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES
(0, 'shadab', 'as@df.com', 9632587410, '1223', '213sdd', 22343, 13234, 'sadas', 'sdas', '2021-03-15 21:12:24', 'sd', 'sdas', 'sdas', 345345, 'dsfsd');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
