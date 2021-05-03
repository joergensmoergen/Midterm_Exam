-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 03:47 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sir_reboya`
--

-- --------------------------------------------------------

--
-- Table structure for table `auhentication_code`
--

CREATE TABLE `auhentication_code` (
  `ID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `RandomCode` int(255) NOT NULL,
  `Created` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `Expiration` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auhentication_code`
--

INSERT INTO `auhentication_code` (`ID`, `UserID`, `RandomCode`, `Created`, `Expiration`) VALUES
(1, 1, 300438, '2021-04-26 21:10:58.000000', '2021-04-26 21:15:58.000000'),
(2, 1, 227861, '2021-04-26 21:12:00.000000', '2021-04-26 21:17:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE `event_log` (
  `ID` int(11) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Date_Time` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_log`
--

INSERT INTO `event_log` (`ID`, `Activity`, `Username`, `Date_Time`) VALUES
(1, 'LOGIN', 'Neliza', '2021-04-26 13:10:58.000000'),
(2, 'LOGIN SUCCESS', 'Neliza', '2021-04-26 13:11:10.000000'),
(3, 'CHANGE PASSWORD', 'Neliza', '2021-04-26 13:11:39.000000'),
(4, 'LOGIN', 'Neliza', '2021-04-26 13:12:00.000000'),
(5, 'LOGIN SUCCESS', 'Neliza', '2021-04-26 13:12:05.000000'),
(6, 'LOGOUT', 'Neliza', '2021-04-26 13:12:08.000000'),
(7, 'RESET PASSWORD', 'Neliza', '2021-04-26 13:13:26.000000'),
(8, 'LOGIN', 'Admin', '2021-04-26 13:14:23.000000'),
(9, 'LOGOUT', 'Admin', '2021-04-26 13:14:42.000000');

-- --------------------------------------------------------

--
-- Table structure for table `sign_up`
--

CREATE TABLE `sign_up` (
  `NumberID` int(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sign_up`
--

INSERT INTO `sign_up` (`NumberID`, `Username`, `Email`, `Password`) VALUES
(1, 'Neliza', 'Neliza@gmail.com', 'Mema'),
(2, 'Admin', 'Admin@gmail.com', 'Admin.123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auhentication_code`
--
ALTER TABLE `auhentication_code`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `event_log`
--
ALTER TABLE `event_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sign_up`
--
ALTER TABLE `sign_up`
  ADD PRIMARY KEY (`NumberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auhentication_code`
--
ALTER TABLE `auhentication_code`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_log`
--
ALTER TABLE `event_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sign_up`
--
ALTER TABLE `sign_up`
  MODIFY `NumberID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
