-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 19, 2024 at 12:19 PM
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
-- Database: `health_history`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_pressures`
--

CREATE TABLE `blood_pressures` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `systolicPressure` int(11) DEFAULT NULL,
  `diastolicPressure` int(11) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `armUsed` varchar(255) DEFAULT NULL,
  `deviceUsed` varchar(255) DEFAULT NULL,
  `bloodPressureNotes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyPractice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isDriver` tinyint(1) NOT NULL,
  `isEmployee` tinyint(1) NOT NULL,
  `isCaregiver` tinyint(1) NOT NULL,
  `isCna` tinyint(1) NOT NULL,
  `isRn` tinyint(1) NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone1` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone1x` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2x` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone3` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone3x` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dateStarted` date NOT NULL,
  `dateStopped` date DEFAULT NULL,
  `medicationName` varchar(255) NOT NULL,
  `strength` varchar(255) DEFAULT NULL,
  `dose` varchar(255) DEFAULT NULL,
  `howTaken` varchar(255) DEFAULT NULL,
  `howOften` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `userID`, `dateStarted`, `dateStopped`, `medicationName`, `strength`, `dose`, `howTaken`, `howOften`, `reason`, `notes`) VALUES
(2, 2, '2024-03-03', NULL, 'ampicillion', '100 mg', '1 pill', NULL, NULL, NULL, 'notes'),
(3, 2, '2024-03-05', NULL, 'amoxicillian', '500 mg', '1 tab', NULL, NULL, 'bad in fection', '');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `procedureDate` date NOT NULL,
  `procedureType` varchar(255) NOT NULL,
  `procedurePhysician` varchar(255) DEFAULT NULL,
  `procedureFacility` varchar(255) DEFAULT NULL,
  `procedureDescription` varchar(255) DEFAULT NULL,
  `procedureResults` varchar(255) DEFAULT NULL,
  `procedureInstructions` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `procedureMode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`id`, `userID`, `procedureDate`, `procedureType`, `procedurePhysician`, `procedureFacility`, `procedureDescription`, `procedureResults`, `procedureInstructions`, `notes`, `procedureMode`) VALUES
(1, 2, '2024-02-26', 'Back MRI', '', 'MRI Center Castle Rock', 'MRI of lower back', 'L4 and L5 problem', '', 'No notes at this time', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visitDesc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patientDesc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactsDesc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwdHint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `lastSignon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `pwd`, `lastName`, `firstName`, `pwdHint`, `email`, `admin`, `active`, `lastSignon`) VALUES
(1, 'sysadmin', '$2y$10$WtXLLxTK869dsWtT6BH50uWCgykKF4raopIdNBRCP2IftX.6/bMN.', NULL, NULL, NULL, 'phil@tome.net', 0, 0, NULL),
(2, 'ptome', '$2y$10$2PIidJ.sJk56Np.nw..zduDChmjYBi0yD0M7BDblzR/0f6GfPyUNe', '', '', 'freddy', 'freddy reddy again', 0, 0, NULL),
(3, 'lexitome', '$2y$10$T9iSV9gqI2/OKWM/fF6aJ.YlA.U38xQaR15dHQngMYp5o1qhDDy2e', 'tome', 'lexi', 'Lusah005', 'lexi@tome.net', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `typeVisit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `withWho` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `date`, `typeVisit`, `withWho`, `notes`, `userID`) VALUES
(1, '2024-02-28 09:00:00', 'Neph clinic', 'Dr change', 'creiatinian levels are off', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_pressures`
--
ALTER TABLE `blood_pressures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_pressures`
--
ALTER TABLE `blood_pressures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
