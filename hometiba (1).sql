-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 12:29 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hometiba`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `status` enum('Pending','Rejected','Approved') NOT NULL DEFAULT 'Pending',
  `applicationdate` timestamp NULL DEFAULT current_timestamp(),
  `cv` varchar(50) DEFAULT NULL,
  `Role` enum('doctor','nurse') NOT NULL,
  `Telphone` varchar(12) NOT NULL,
  `whychooseyou` text DEFAULT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `firstname`, `lastname`, `status`, `applicationdate`, `cv`, `Role`, `Telphone`, `whychooseyou`, `password`) VALUES
(1, 'Okiondo', 'Masereti', 'Approved', '2023-01-15 17:36:47', 'csv.pdf', 'doctor', '743435258', 'I am the best of the best and am very hard working given this role i will perform the best and give the best output to the company, within a short time my impact will be realized.Please consider me in the position.', '919e682cac825d430a580e842ff0bbc4'),
(2, 'Mayaka', 'Lewis', 'Approved', '2023-01-15 17:36:47', 'Company Payroll Report.pdf', 'doctor', '7458692', 'I am the best of the best and am very hard working...\n', '919e682cac825d430a580e842ff0bbc4'),
(3, 'Ontiobe', 'Kebeno', 'Approved', '2023-01-15 17:36:47', 'Company Payroll Report.pdf', 'doctor', '8541268', 'I am the best of the best and am very hard working...\n', '919e682cac825d430a580e842ff0bbc4'),
(4, 'shem', 'mwale', 'Approved', '2023-01-29 15:38:45', 'Company Payroll Report.pdf', 'doctor', '254785211354', 'Your skills and qualifications. If you can prove that you\'ve got all the skills that the company is looking for in a candidate, you\'ll have effectively answered the question. Your passion and motivation. You can highlight how good of a company fit you\'d be and how much you love working in your field or industry                    ', '919e682cac825d430a580e842ff0bbc4'),
(5, 'robert', 'wayode', 'Approved', '2023-01-29 15:42:29', '001_504_01_Dec_01_Dec (4).pdf', 'nurse', '254785246222', 'I am the best of the best and am very hard working...\r\n', '919e682cac825d430a580e842ff0bbc4'),
(6, 'wick', 'wafula', 'Approved', '2023-01-29 15:45:12', '001_504_01_Dec_01_Dec.pdf', 'nurse', '254711225524', 'I am the best of the best and am very hard working...\r\n                    ', 'e2a1715ac00b5e872a2191fb13f69a69'),
(7, 'Elisha', 'Njenche', 'Approved', '2023-02-15 02:57:48', 'Resume (updated).pdf', 'doctor', '254777777756', '  am the best doctor in town                  ', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `uId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `uId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`, `status`) VALUES
(3, 'Internal Medicine', 4, 4, NULL, '2023-01-17', '08:00', '2023-01-17 20:02:06', 1, 1, NULL, 'Pending'),
(4, 'Ophthalmologsian', 4, 4, NULL, '2023-01-17', '09:00', '2023-01-17 20:03:05', 1, 1, NULL, 'Pending'),
(5, 'Internal Medicine', 4, 4, NULL, '2023-02-26', '20:00', '2023-01-26 19:45:24', 1, 1, NULL, 'Pending'),
(6, 'Internal Medicine', 31, 92, NULL, '2023-02-16', '09:00', '2023-02-15 02:48:31', 1, 1, NULL, 'Pending'),
(7, 'Endocrinologists', 32, 92, NULL, '2023-02-16', '10:00', '2023-02-15 03:06:04', 1, 1, NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `docid` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `county` varchar(15) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `status` enum('Approved','Disabled','Pending','Rejected') NOT NULL DEFAULT 'Pending',
  `id` int(13) NOT NULL,
  `cv` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `Availability` enum('NotAvailable','Available') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`docid`, `firstname`, `email`, `lastname`, `county`, `phone`, `status`, `id`, `cv`, `password`, `Availability`) VALUES
(7, 'mocheche', 'kem@gmail.com', 'kemunto', 'Machakos', 254785222224, 'Disabled', 45857857, NULL, '202cb962ac59075b964b07152d234b70', 'NotAvailable'),
(23, 'shem', 'shemmwale@gmail.com', 'mwale', '', 254785211354, 'Disabled', 0, 'Company Payroll Report.pdf', '919e682cac825d430a580e842ff0bbc4', 'NotAvailable'),
(26, 'robert', 'robertwayode@gmail.com', 'wayode', '', 254785246222, 'Disabled', 0, '001_504_01_Dec_01_Dec (4).pdf', '919e682cac825d430a580e842ff0bbc4', 'NotAvailable'),
(27, 'shem', 'shemmwale@gmail.com', 'mwale', '', 254785211354, 'Disabled', 0, 'Company Payroll Report.pdf', '919e682cac825d430a580e842ff0bbc4', 'NotAvailable'),
(28, 'shem', 'shemmwale@gmail.com', 'mwale', '', 254785211354, 'Disabled', 0, 'Company Payroll Report.pdf', '919e682cac825d430a580e842ff0bbc4', 'NotAvailable'),
(29, 'shem', 'shemmwale@gmail.com', 'mwale', '', 254785211354, 'Disabled', 0, 'Company Payroll Report.pdf', '919e682cac825d430a580e842ff0bbc4', 'NotAvailable'),
(30, 'shem', 'shemmwale@gmail.com', 'mwale', '', 254785211354, 'Disabled', 0, 'Company Payroll Report.pdf', '919e682cac825d430a580e842ff0bbc4', 'NotAvailable'),
(31, 'shem', 'shemmwale@gmail.com', 'mwale', '', 254785211354, 'Approved', 0, 'Company Payroll Report.pdf', '919e682cac825d430a580e842ff0bbc4', 'Available'),
(32, 'Elisha', 'ElishaNjenche@gmail.com', 'Njenche', '', 254777777756, 'Approved', 0, 'Resume (updated).pdf', '5f4dcc3b5aa765d61d8327deb882cf99', 'Available'),
(33, 'robert', 'robertwayode@gmail.com', 'wayode', '', 254785246222, 'Approved', 0, '001_504_01_Dec_01_Dec (4).pdf', '919e682cac825d430a580e842ff0bbc4', 'Available'),
(34, 'wick', 'wickwafula@gmail.com', 'wafula', '', 254711225524, 'Approved', 0, '001_504_01_Dec_01_Dec.pdf', 'e2a1715ac00b5e872a2191fb13f69a69', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(2, 'Internal Medicine', '2023-01-08 15:09:57', NULL),
(3, 'Obstetrics and Gynecology', '2023-01-08 15:10:57', NULL),
(4, 'Dermatology', '2023-01-08 15:10:28', NULL),
(6, 'Radiology', '2023-01-08 15:10:46', NULL),
(7, 'General Surgery', '2023-01-08 15:10:56', NULL),
(8, 'Ophthalmologsian', '2023-01-08 15:11:03', '2023-01-15 16:36:05'),
(9, 'Anesthesia', '2023-01-08 15:11:15', '2023-01-15 16:33:37'),
(10, 'Pathology', '2023-01-08 15:11:22', NULL),
(12, 'Dental Care', '2023-01-08 15:11:39', NULL),
(13, 'Dermatologists', '2023-01-08 15:12:02', NULL),
(14, 'Endocrinologists', '2023-01-08 15:12:10', NULL),
(15, 'Neurologists', '2023-01-08 15:12:30', NULL),
(38, 'blood pressure', '2023-02-15 02:39:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE `medicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(20) NOT NULL,
  `dc_id` int(20) DEFAULT NULL,
  `usr_id` int(11) NOT NULL,
  `age` decimal(15,0) DEFAULT NULL,
  `weight` decimal(15,0) DEFAULT NULL,
  `bloodpressure` decimal(11,0) DEFAULT NULL,
  `temperature` decimal(13,0) DEFAULT NULL,
  `bloodsugar` int(20) DEFAULT NULL,
  `visitingdate` date DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `medication` text DEFAULT NULL,
  `cost` decimal(30,0) DEFAULT NULL,
  `creationdate` timestamp NULL DEFAULT current_timestamp(),
  `updateddate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `dc_id`, `usr_id`, `age`, `weight`, `bloodpressure`, `temperature`, `bloodsugar`, `visitingdate`, `prescription`, `medication`, `cost`, `creationdate`, `updateddate`) VALUES
(7, NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-29 18:03:16', NULL),
(8, NULL, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 02:35:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Admin','Doctor','Nurse','Patient') NOT NULL DEFAULT 'Patient',
  `Telphone` bigint(20) NOT NULL,
  `creationdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `FirstName`, `LastName`, `email`, `Password`, `Role`, `Telphone`, `creationdate`) VALUES
(2, 'moseti', 'matara', 'doc@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Doctor', 22222, '2023-01-03'),
(3, 'nurse', 'nurse', 'nurse@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nurse', 33333, '2023-01-03'),
(6, 'john', 'doe', 'john@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin', 11111, '2023-01-03'),
(75, 'mgonjwa', 'mgonjwa', '', '919e682cac825d430a580e842ff0bbc4', 'Patient', 44444, '2023-01-29'),
(92, 'Mboga', 'Vincente', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Patient', 99999999, '2023-02-15'),
(95, 'shem', 'mwale', 'shemmwale@gmail.com', '919e682cac825d430a580e842ff0bbc4', 'Doctor', 254785211354, '2023-02-15'),
(96, 'Elisha', 'Njenche', 'ElishaNjenche@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Doctor', 254777777756, '2023-02-15'),
(97, 'mocheche', 'kemunto', 'kemmoche@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin', 254777777999, '2023-02-15'),
(98, 'robert', 'wayode', 'robertwayode@gmail.com', '919e682cac825d430a580e842ff0bbc4', 'Nurse', 254785246222, '2023-02-15'),
(99, 'wick', 'wafula', 'wickwafula@gmail.com', 'e2a1715ac00b5e872a2191fb13f69a69', 'Nurse', 254711225524, '2023-02-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
