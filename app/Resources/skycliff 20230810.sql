-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 10, 2023 at 03:08 PM
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
  `notes` text NOT NULL,
  `participants_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `care_plans`
--

INSERT INTO `care_plans` (`id`, `careplan_date`, `careplan_edit_date`, `careplan_edit_time`, `present_health`, `assistive_devices`, `notes`, `participants_id`) VALUES
(8, '2023-06-11', NULL, '07:30:00', 'Workout', 'Peddle Bike', 'work out for about 75 min', 1),
(10, '2023-06-08', NULL, '06:36:00', 'office', 'the doctor', 'tesing query', NULL),
(11, '2023-06-05', NULL, '07:52:00', 'Blood Draw', 'TCH Lab', 'Went in for her quarterly blood draw', NULL),
(12, '2023-06-07', NULL, '23:13:00', 'Pulmanary', 'Dr wellington', 'These are a few notes', NULL),
(13, '2023-06-09', NULL, '20:27:00', 'fist of the day and then sunday', 'some doctor at like 8:27 pm', 'No notes needed today', NULL),
(14, '2023-06-09', NULL, '06:10:00', 'this is the visit type', 'This is the visit with', 'These are the notes', NULL),
(15, '2023-06-11', NULL, '20:00:00', 'na na what?', 'visithng with', 'short', NULL),
(16, '2023-06-10', NULL, '06:13:00', 'testing type update', 'visithng with update', 'more notes this time they should but I updated', NULL),
(17, '2023-06-10', NULL, '06:13:00', 'robe man', 'visithng withttyyyyyyyyyyy', 'more notes this time they should showbut will they?huhhhh', NULL);

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
  `phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `last_name`, `first_name`, `contact_type`, `company_practice`, `email`, `phone`) VALUES
(1, 'Tome', 'Philip', 'Family', 'Self', 'phil@tome.net', '3038591164'),
(9, 'contact4', 'contact4', 'some type', ';lkj;ljk;lj;', 'email@email.com', '878787'),
(14, 'contact3', 'Contacdt3', 'kksdks', ';alkj;alksdfjal;kjfd ;alsdkjfa ;sdlfkjad s;flaksjdf a;lkj', 'phil@tome.net', '878888'),
(15, 'another', 'contact', 'some time', '', '007@tomel.net', '888'),
(16, 'contact5', 'Contacdt5', 'kksdks', ';alkj;alksdfjal;k', 'phil@tome.net', '878888'),
(17, 'contact6', 'Contacdt6', 'kksdks', ';apppppppppppp', 'phil@tome.net', '878888'),
(18, 'another', 'contact', 'some time', '', '007@tomel.net', '888'),
(20, 'another', 'contact', 'some time', '', '007@tomel.net', '888'),
(22, 'another', 'contact', 'some time', '', '007@tomel.net', '888');

-- --------------------------------------------------------

--
-- Table structure for table `participantsController`
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
-- Dumping data for table `participantsController`
--

INSERT INTO `participants` (`id`, `last_name`, `first_name`, `street_address_1`, `street_address_2`, `city`, `state`, `zip`, `responsible_party`, `phone`) VALUES
(1, 'Tome', 'Philip', '123 Street', '', '', '', '', 'Dad Tome and Mom Tome', '3038591164'),
(2, 'Boekes', 'Chad', '456 Street', '', '', '', '', 'Mr and Mrs Boekes', '99999999'),
(3, 'tome', 'Leah', '789 Street', '', '', '', '', 'Lois Simmons', '3038591000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `care_plans`
--
ALTER TABLE `care_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_id_key` (`participants_id`) USING BTREE;

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participantsController`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `care_plans`
--
ALTER TABLE `care_plans`
  ADD CONSTRAINT `care_plans_ibfk_1` FOREIGN KEY (`participants_id`) REFERENCES `participants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
