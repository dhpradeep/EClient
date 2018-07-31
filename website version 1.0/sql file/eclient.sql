-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 06:54 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclient`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `ID` int(11) NOT NULL,
  `fName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_address` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`ID`, `fName`, `lName`, `company_full_name`, `company_registration_number`, `company_email_address`, `company_website`, `company_country`, `company_address`) VALUES
(8, 'Pradip', 'Dhakal', 'eversoft', '123456789', 'admin@gmail.com', 'eversoftnepal.com', 'Nepal', 'Pokhara');

-- --------------------------------------------------------

--
-- Table structure for table `company_rejected`
--

CREATE TABLE `company_rejected` (
  `ID` int(11) NOT NULL,
  `fName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_address` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_rejected`
--

INSERT INTO `company_rejected` (`ID`, `fName`, `lName`, `company_full_name`, `company_registration_number`, `company_email_address`, `company_website`, `company_country`, `company_address`) VALUES
(1, 'Pradip', 'Dhakal', 'Eversoft', '987989786', 'dhpradeep25@gmail.com', 'https://eversoftgroup.com', 'Nepal', 'Pokhara'),
(3, 'Pradip', 'Dhakal', 'eversoft', '897969594', 'dhpradeep25@gmail.com', 'https://www.eversoftgroup.com', 'Nepal', 'Pokhara'),
(4, 'Pradip', 'Dhakal', 'eversoft', '123321123', 'dhpradeep25@gmail.com', 'rajusoft.com', 'Nepal', 'Pokhara'),
(15, 'Pradip', 'Dhakal', 'eversoft', '123453789', 'dhpradeep25@gmail.com', 'puspa.com.np', 'Nepal', 'Pokhara'),
(18, 'Prabhu', 'Gurung', 'Prabhu company', '564378943', 'dhpradeep25@gmail.com', 'http://eversoftgroup.com', 'Nepal', 'Pokhara');

-- --------------------------------------------------------

--
-- Table structure for table `company_temp`
--

CREATE TABLE `company_temp` (
  `ID` int(11) NOT NULL,
  `fName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_address` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `message_body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_sender_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_receiver_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_creation_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID`, `message_body`, `message_sender_ID`, `message_receiver_ID`, `message_creation_date`) VALUES
(2, 'Hello oscar', '6', '33', '2018-07-28 23:55:52'),
(3, 'Hi pradip', '33', '6', '2018-07-28 23:55:52'),
(4, 'Whats up!!', '6', '33', '2018-07-29 00:50:59'),
(5, 'whats goin on ??', '6', '33', '2018-07-29 00:52:56'),
(11, 'Hey safal.', '6', '31', '2018-07-29 00:57:58'),
(17, 'I\'m here now..', '6', '33', '2018-07-29 01:02:42'),
(19, 'Hello pradip dhakal', '6', '5', '2018-07-29 01:05:40'),
(20, 'yoo ', '5', '34', '2018-07-29 08:35:13'),
(21, 'hhh', '5', '6', '2018-07-29 08:44:14'),
(22, 'jjkjk', '6', '5', '2018-07-29 08:44:43'),
(23, 'Hello safal', '6', '31', '2018-07-29 10:00:43'),
(24, 'abc', '6', '33', '2018-07-29 21:50:26'),
(25, 'Fine here..', '6', '33', '2018-07-29 22:24:59'),
(26, 'Fine too!', '33', '6', '2018-07-29 22:27:02'),
(27, 'Sure na??', '6', '33', '2018-07-29 22:27:17'),
(28, 'Yah Yah sure :)', '33', '6', '2018-07-29 22:27:42'),
(29, ':)', '6', '33', '2018-07-29 22:37:06'),
(30, ';)', '6', '33', '2018-07-29 22:37:55'),
(31, 'Hi kritika.', '5', '32', '2018-07-31 12:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `module_by`
--

CREATE TABLE `module_by` (
  `ID` int(11) NOT NULL,
  `mID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `module_by`
--

INSERT INTO `module_by` (`ID`, `mID`, `uID`, `title`, `remarks`, `link`) VALUES
(1, 4, 6, 'Module 1 complete ', 'This is module 1 complete data', 'https://github.com/dhpradeep/cmt'),
(2, 4, 6, 'Module 1 file 2', '', 'https://google.com');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `ID` int(11) NOT NULL,
  `by_whom` int(11) NOT NULL,
  `to_who` int(25) NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`ID`, `by_whom`, `to_who`, `data`, `room`) VALUES
(14, 6, 22, 'admin1 calling you', '7wfg6u7'),
(15, 6, 22, 'admin1 calling you', '35y1b52');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ID` int(11) NOT NULL,
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_main_handler` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ID`, `project_name`, `company_id`, `project_start_date`, `project_end_date`, `project_main_handler`) VALUES
(12, 'Website Development', 8, '', '', '\'pradip\''),
(13, 'App development', 8, '', '', 'kritika'),
(14, 'Software Development', 8, '', '', 'admin1'),
(17, 'This is literally best project', 8, '2018-07-27', '2018-07-31', 'kritika'),
(19, 'Blood bank software development', 8, '2018-07-29', '2018-08-15', 'kritika');

-- --------------------------------------------------------

--
-- Table structure for table `project_handler`
--

CREATE TABLE `project_handler` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_handler`
--

INSERT INTO `project_handler` (`id`, `project_id`, `role`, `username`) VALUES
(118, 12, 'Developer', 'admin1'),
(121, 18, 'Developer', 'rajusoft'),
(124, 13, 'Developer', 'admin1'),
(125, 13, 'Developer', 'kritika'),
(126, 14, 'Developer', 'admin1'),
(127, 19, 'Developer', 'admin1'),
(128, 19, 'Developer', 'kritika'),
(129, 17, 'Developer', 'kritika'),
(130, 17, 'Developer', 'admin1'),
(132, 12, 'Designer', 'kritika');

-- --------------------------------------------------------

--
-- Table structure for table `project_module`
--

CREATE TABLE `project_module` (
  `ID` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  `assign_to` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `module_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_sub_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preset` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_module`
--

INSERT INTO `project_module` (`ID`, `pID`, `assign_to`, `module_title`, `module_sub_title`, `module_desc`, `preset`) VALUES
(4, 12, 'admin1', 'Data validation module', 'Input data validation', 'A website has the different type of input validation like user input validation, file validation etc.', 'to_do'),
(6, 19, 'kritika', 'Data validation module', 'Input data validation', 'user data validation', 'progress'),
(7, 19, 'kritika', 'Data validation module', 'Input data validation', 'user data validation', 'progress'),
(8, 13, 'admin1', 'Data validation module', 'Input data validation', 'lorem lorem', 'progress'),
(9, 17, 'admin1', 'abc', 'def', 'dfrsfsd', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `time_track`
--

CREATE TABLE `time_track` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_account_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'deactive',
  `joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `related_company` int(255) NOT NULL,
  `related_project` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `fName`, `lName`, `email`, `phone`, `password`, `role`, `user_account_status`, `joined`, `related_company`, `related_project`) VALUES
(5, 'admin', 'Pradip', 'Dhakal', 'admin@gmail.com', '9846751280', 'admin', 'admin', 'deactive', '2018-07-25 13:36:06', 0, 0),
(6, 'admin1', 'Pradip', 'Dhakal', 'dhpradeep25@gmail.com', '9846751280', 'admin1', 'company', 'deactive', '2018-07-25 14:14:44', 8, 0),
(25, 'sapana', 'Sapana', 'Timilsina', 'sapana@sapana.com', '', 'sapana', 'client', 'deactive', '2018-07-27 08:29:23', 8, 12),
(29, 'poudel_me', 'pradeep', 'Poudel', 'systemanalyst2054@gmail.com', '', 'poudel', 'client', 'deactive', '2018-07-27 09:05:36', 8, 12),
(30, 'prabhu_me', 'Prabhu', 'Gurung', 'grg@prabhu.com', '', 'prabhu', 'client', 'deactive', '2018-07-27 09:08:03', 8, 13),
(31, 'safal_me', 'Safal', 'shrestha', 'admin@admin.com', '', 'safal', 'client', 'deactive', '2018-07-27 09:08:51', 8, 13),
(32, 'kritika', 'Kritika', 'Bhattachan', 'kritika@gmail.com', '', 'kritika', 'company', 'deactive', '2018-07-27 13:53:05', 8, 0),
(33, 'oscar_me', 'Oscar', 'Pun', 'admin@admin.com', '', 'ascar', 'client', 'deactive', '2018-07-27 21:42:49', 8, 14),
(35, 'arjun', 'Arjun', 'subedi', 'arjun@gmail.com', '', 'arjun', 'client', 'deactive', '2018-07-29 10:39:11', 8, 12),
(36, 'arjun_me', 'Arjun', 'subedi', 'arjun@gmail.com', '', 'arjun', 'client', 'deactive', '2018-07-29 10:51:38', 8, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `company_rejected`
--
ALTER TABLE `company_rejected`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `company_temp`
--
ALTER TABLE `company_temp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `module_by`
--
ALTER TABLE `module_by`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project_handler`
--
ALTER TABLE `project_handler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_module`
--
ALTER TABLE `project_module`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `time_track`
--
ALTER TABLE `time_track`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_rejected`
--
ALTER TABLE `company_rejected`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `company_temp`
--
ALTER TABLE `company_temp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `module_by`
--
ALTER TABLE `module_by`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `project_handler`
--
ALTER TABLE `project_handler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `project_module`
--
ALTER TABLE `project_module`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `time_track`
--
ALTER TABLE `time_track`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
