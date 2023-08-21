-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 21, 2023 at 11:28 AM
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
  `careplan_date` date DEFAULT NULL,
  `careplan_edit_date` date DEFAULT NULL,
  `careplan_edit_time` time DEFAULT NULL,
  `present_health` varchar(255) DEFAULT NULL,
  `assistive_devices` varchar(100) DEFAULT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `care_plans`
--

INSERT INTO `care_plans` (`id`, `careplan_date`, `careplan_edit_date`, `careplan_edit_time`, `present_health`, `assistive_devices`, `notes`) VALUES
(8, '2023-06-11', NULL, '07:30:00', 'Workout', 'Peddle Bike', 'work out for about 75 min'),
(10, '2023-06-08', NULL, '06:36:00', 'office', 'the doctor', 'tesing query'),
(11, '2023-06-05', NULL, '07:52:00', 'Blood Draw', 'TCH Lab', 'Went in for her quarterly blood draw'),
(12, '2023-06-07', NULL, '23:13:00', 'Pulmanary', 'Dr wellington', 'These are a few notes'),
(13, '2023-06-09', NULL, '20:27:00', 'fist of the day and then sunday', 'some doctor at like 8:27 pm', 'No notes needed today'),
(14, '2023-06-09', NULL, '06:10:00', 'this is the visit type', 'This is the visit with', 'These are the notes'),
(15, '2023-06-11', NULL, '20:00:00', 'na na what?', 'visithng with', 'short'),
(16, '2023-06-10', NULL, '06:13:00', 'testing type update', 'visithng with update', 'more notes this time they should but I updated'),
(17, '2023-06-10', NULL, '06:13:00', 'robe man', 'visithng withttyyyyyyyyyyy', 'more notes this time they should showbut will they?huhhhh');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `contact_type` varchar(50) DEFAULT NULL,
  `company_practice` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `is_driver` tinyint(1) DEFAULT '0',
  `is_employee` tinyint(1) DEFAULT '0',
  `is_caregiver` tinyint(1) DEFAULT '0',
  `is_cna` tinyint(1) DEFAULT '0',
  `is_rn` tinyint(1) DEFAULT '0',
  `address_1` varchar(50) DEFAULT NULL,
  `address_2` varchar(50) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
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

INSERT INTO `contacts` (`id`, `last_name`, `first_name`, `contact_type`, `company_practice`, `email`, `phone`, `is_driver`, `is_employee`, `is_caregiver`, `is_cna`, `is_rn`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone1`, `phone1x`, `phone2`, `phone2x`, `phone3`, `phone3x`) VALUES
(1, 'Tome', 'Philip', 'Family', 'Self', 'phil@tome.net', '3038591164', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'contact4', 'contact4', 'some type', ';lkj;ljk;lj;', 'email@email.com', '878787', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'contact3', 'Contacdt3', 'kksdks', 'yyyy', 'phil@tome.net', '878888', 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'contact5', 'Contacdt5', 'kksdks', ';alkj;alksdfjal;k', 'phil@tome.net', '878888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Driver', 'John', 'kksdks', 'Driver John', 'phil@tome.net', '878888', 1, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'another', 'contact', 'some time', '', '007@tomel.net', '888', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Smith', 'Philipppppppp', 'Family', 'Self', 'phil@gmail.com', '3038591164', 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `street_address_1` varchar(50) DEFAULT NULL,
  `street_address_2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(25) NOT NULL,
  `zip` varchar(12) NOT NULL,
  `responsible_party` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `last_name`, `first_name`, `street_address_1`, `street_address_2`, `city`, `state`, `zip`, `responsible_party`, `phone`) VALUES
(1, 'Tome', 'Philip', '123 Street', '', '', '', '', 'Dad Tome and Mom Tome', '3038591164'),
(2, 'Boekes', 'Chad', '456 Street', '', '', '', '', 'Mr and Mrs Boekes', '99999999'),
(3, 'tome', 'Leah', '789 Street', '', '', '', '', 'Lois Simmons', '3038591000'),
(4, 'lkj;l', 'fist name', '', '', '', '', '', '', ''),
(5, 'COpied', 'fist name', '', '', '', '', '', '', ''),
(6, 'Boekes', 'Chad', '456 Street', '', '', '', '', 'Mr and Mrs Boekes', '99999999');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `care_plans`
--
ALTER TABLE `care_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
