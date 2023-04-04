-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 02:26 AM
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
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateAdded` varchar(50) NOT NULL,
  `dateModified` varchar(50) NOT NULL,
  `retrievedDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `adminName`, `role`, `username`, `password`, `dateAdded`, `dateModified`, `retrievedDate`) VALUES
(73, 'deither Mantilla', 'super admin', 'deither@000', '$2y$10$rw90n8vOgzc.wuVnj2YMYOoGCV9LZduf8kj4vJDtLo5nVJL.agR.2', 'February 13, 2023, 9:44 am', 'April 1, 2023, 9:47 pm', 'February 14, 2023, 2:49 pm'),
(74, 'Gerald Esurena', 'admin', 'gerald@000', '$2y$10$jtfvyaQXWCiJsp/GjfqleeVDC9TjG8CzUKt8bl9Pr0V3sbxLE2aOC', 'February 14, 2023, 2:52 pm', 'February 14, 2023, 2:53 pm', ''),
(76, 'amiler Joel', 'super admin', 'amiler@000', '$2y$10$Zr0FdYPRG5JGoz.MhhJvi.G29Vv..2FoOSXa5d7tGSC2oasxJdcxu', 'February 8, 2023, 1:46 pm', 'February 14, 2023, 2:50 pm', 'February 28, 2023, 12:10 pm');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `csNumber` varchar(100) NOT NULL,
  `model` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `dateAdded` varchar(50) NOT NULL,
  `dateModified` varchar(50) NOT NULL,
  `retrievedDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `client_id`, `img_path`, `customerName`, `csNumber`, `model`, `company`, `dateAdded`, `dateModified`, `retrievedDate`) VALUES
(33, '4789889631', 'IMG-64284ebd9fd9b7.78885364.jpg', 'Madera, Marvin C.', 'awd', 'awdaw', 'bmw', 'April 1, 2023, 11:33 pm', 'April 1, 2023, 11:35 pm', ''),
(34, '2562619197', 'IMG-64284ed1186eb3.69550158.jpg', 'Guinoo, Cherry A.', 'wadaw', 'dawd', 'bmw', 'April 1, 2023, 11:33 pm', 'April 1, 2023, 11:36 pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_admin_account`
--

CREATE TABLE `deleted_admin_account` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateAdded` varchar(50) NOT NULL,
  `dateModified` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_admin_account`
--

INSERT INTO `deleted_admin_account` (`adminID`, `adminName`, `role`, `username`, `password`, `dateAdded`, `dateModified`) VALUES
(71, 'jericho Cruz', 'super admin', 'jeric@000', '$2y$10$BOqfX/qrkyR/YeUPzq6IheeFeE7QZEOwAYZhCjElKCH20X7mWOcKK', 'February 8, 2023, 1:47 pm', ''),
(75, 'Princess Jean', 'super admin', 'princessjean', '$2y$10$/.LVz4YCue3.RThG5QRegO2vm32CFKK4n9xckd.EXv/E0x4gACb2q', 'February 28, 2023, 12:04 pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `loginID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `adminName` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `login` varchar(100) NOT NULL,
  `logout` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`loginID`, `adminID`, `adminName`, `username`, `role`, `login`, `logout`) VALUES
(20, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 13, 2023, 6:14 am', 'February 13, 2023, 6:14 am'),
(21, 73, 'deither Mantilla', 'deither@000', 'super admin', 'February 22, 2023, 10:48 am', 'February 22, 2023, 10:49 am'),
(22, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 24, 2023, 10:11 am', 'February 24, 2023, 10:48 am'),
(23, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 24, 2023, 11:05 am', 'February 24, 2023, 3:43 pm'),
(24, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 24, 2023, 3:49 pm', ''),
(25, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 25, 2023, 3:25 am', ''),
(26, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 25, 2023, 3:02 pm', ''),
(27, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 27, 2023, 3:27 am', ''),
(28, 59, 'amiler Joel', 'amiler@000', 'super admin', 'February 28, 2023, 12:01 pm', ''),
(29, 75, 'Princess Jean', 'princessjean', 'super admin', 'February 28, 2023, 12:08 pm', ''),
(30, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 3, 2023, 4:09 pm', ''),
(31, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 4, 2023, 5:11 am', ''),
(32, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 4, 2023, 6:38 am', ''),
(33, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 20, 2023, 9:04 pm', ''),
(34, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 23, 2023, 9:31 am', ''),
(35, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 26, 2023, 2:55 pm', ''),
(36, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 31, 2023, 9:06 pm', ''),
(37, 76, 'amiler Joel', 'amiler@000', 'super admin', 'March 31, 2023, 9:07 pm', ''),
(38, 76, 'amiler Joel', 'amiler@000', 'super admin', 'April 1, 2023, 6:21 am', ''),
(39, 76, 'amiler Joel', 'amiler@000', 'super admin', 'April 1, 2023, 6:21 am', ''),
(40, 76, 'amiler Joel', 'amiler@000', 'super admin', 'April 1, 2023, 6:22 am', ''),
(41, 76, 'amiler Joel', 'amiler@000', 'super admin', 'April 1, 2023, 8:44 pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_history`
--

CREATE TABLE `transactions_history` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `reciept` varchar(255) NOT NULL,
  `customerName` varchar(250) NOT NULL,
  `csNumber` varchar(50) NOT NULL,
  `paymentStatus` varchar(50) NOT NULL,
  `dateAdded` varchar(50) NOT NULL,
  `date_paid` varchar(50) NOT NULL,
  `dateRetrieved` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions_history`
--

INSERT INTO `transactions_history` (`id`, `client_id`, `reciept`, `customerName`, `csNumber`, `paymentStatus`, `dateAdded`, `date_paid`, `dateRetrieved`) VALUES
(27, '4789889631', 'default_img.jpg', 'Madera, Marvin C.', 'awd', 'unpaid', 'April 1, 2023, 11:33 pm', '', ''),
(28, '2562619197', 'default_img.jpg', 'Guinoo, Cherry A.', 'wadaw', 'unpaid', 'April 1, 2023, 11:33 pm', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_admin_account`
--
ALTER TABLE `deleted_admin_account`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions_history`
--
ALTER TABLE `transactions_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `loginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions_history`
--
ALTER TABLE `transactions_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
