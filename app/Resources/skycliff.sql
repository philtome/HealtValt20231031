-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 09, 2023 at 05:50 PM
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
-- Table structure for table `care_plans`
--

CREATE TABLE `care_plans` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `editDate` datetime NOT NULL,
  `presentHealth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assistiveDevices` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `care_plans`
--

INSERT INTO `care_plans` (`id`, `date`, `editDate`, `presentHealth`, `assistiveDevices`, `notes`) VALUES
(8, '2023-06-11 00:00:00', '2023-07-27 20:16:52', 'Workout', 'Peddle Bike', 'work out for about 75 min'),
(10, '2023-06-08 00:00:00', '2023-06-27 20:16:52', 'office', 'The doctor', 'testing query'),
(11, '2023-06-05 00:00:00', '2023-07-27 20:19:27', 'Blood Draw', 'TCH Lab', 'Went in for her quarterly blood draw'),
(12, '2023-06-07 00:00:00', '2023-07-27 20:19:28', 'Pulmanary', 'Dr Wellington', 'There are a few notes');

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
(1, 'Tome', 'Philip', 'Family', '', 'phil@tome.net', '3038591164', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Fosdic', 'Marie', 'some type', '', 'email@email.com', '878787', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Fahmy', 'Anthony', 'kksdks', '', 'phil@tome.net', '878888', 1, 1, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Gunter', 'Pat', 'some time', '', '007@tomel.net', '888', 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Heinz', 'Thomas', 'kksdks', '', 'phil@tome.net', '878888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Driver', 'John', 'kksdks', 'Driver John', 'phil@tome.net', '878888', 1, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Someother', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Yetanother', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'AnotherButter', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Smith', 'Philipppppppp', 'Family', 'Self', 'phil@gmail.com', '3038591164', 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `streetAddress1` varchar(50) DEFAULT NULL,
  `streetAddress2` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `zip` varchar(12) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `notes` longtext,
  `responsibleParty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `lastName`, `firstName`, `streetAddress1`, `streetAddress2`, `city`, `state`, `zip`, `phone`, `notes`, `responsibleParty_id`) VALUES
(1, 'Tome', 'Philip', '123 Street', 'Unit 10', 'Castle Rock', 'CO', '80108', '3038591164', NULL, NULL),
(2, 'Boekes', 'Chad', '456 Street', 'Secondline', 'Larkspur', 'CO', '', '99999999', NULL, 16),
(3, 'tome', 'Leah', '789 Street', '', '', '', '', '3038591000', NULL, 1),
(6, 'Boekes', 'Chad', '456 Street', '', '', '', '', '99999999', NULL, NULL),
(9, 'tome8', 'Leah8', '789 Street', '', '', '', '', '3038591000', NULL, NULL),
(20, 'Wayne', 'John', '1 John Wayne Place', '1 Mansion', 'Santa Anna', 'CA', '77777', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `care_plans`
--
ALTER TABLE `care_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_71697092B6C1597F` (`responsibleParty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `care_plans`
--
ALTER TABLE `care_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `FK_716970924132DC1E` FOREIGN KEY (`responsibleParty_id`) REFERENCES `contacts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
