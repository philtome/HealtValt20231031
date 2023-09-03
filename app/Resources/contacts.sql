-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 03, 2023 at 03:05 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skycliff`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `contactType` varchar(255) DEFAULT NULL,
  `companyPractice` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `isDriver` tinyint(1) NOT NULL,
  `isEmployee` tinyint(1) NOT NULL,
  `isCaregiver` tinyint(1) NOT NULL,
  `isCna` tinyint(1) NOT NULL,
  `isRn` tinyint(1) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `zip` varchar(12) DEFAULT NULL,
  `phone1` varchar(11) DEFAULT NULL,
  `phone1x` varchar(6) DEFAULT NULL,
  `phone2` varchar(11) DEFAULT NULL,
  `phone2x` varchar(6) DEFAULT NULL,
  `phone3` varchar(11) DEFAULT NULL,
  `phone3x` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `lastName`, `firstName`, `contactType`, `companyPractice`, `email`, `phone`, `isDriver`, `isEmployee`, `isCaregiver`, `isCna`, `isRn`, `address1`, `address2`, `city`, `state`, `zip`, `phone1`, `phone1x`, `phone2`, `phone2x`, `phone3`, `phone3x`) VALUES
(1, 'Tome', 'Philip', 'Family', 'Self', 'phil@tome.net', '3038591164', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'contact4', 'contact4', 'some type', ';lkj;ljk;lj;', 'email@email.com', '878787', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'contact3', 'Contacdt3', 'kksdks', 'yyyy', 'phil@tome.net', '878888', 1, 1, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'contact5', 'Contacdt5', 'kksdks', ';alkj;alksdfjal;k', 'phil@tome.net', '878888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Driver', 'John', 'kksdks', 'Driver John', 'phil@tome.net', '878888', 1, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Smith', 'Philipppppppp', 'Family', 'Self', 'phil@gmail.com', '3038591164', 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
