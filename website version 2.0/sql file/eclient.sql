-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2018 at 06:50 PM
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
(1, 'Prabhu', 'Gurung', 'prabhu', '432345653', 'grg_prabhu@yahoo.com', 'rajusoft.com', 'Nepal', 'Pokhara'),
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
  `pID` int(11) NOT NULL,
  `mID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `ID` int(11) NOT NULL,
  `to_whom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`ID`, `to_whom`, `data`, `link`, `active`) VALUES
(1, 'admin1', 'You are in a project 12', 'http://localhost/eclient/00.final%20site/requirement.php?id=12', 'read'),
(2, 'kritika', 'You are a project 12 main handler', 'http://localhost/eclient/00.final%20site/requirement.php?id=12', 'read'),
(3, 'admin1', 'You have a new module \"Data validation module\"', 'http://localhost/eclient/00.final%20site/individual_module.php', 'read'),
(4, 'kritika', 'You are a project 12 main handler', 'http://localhost/eclient/00.final%20site/requirement.php?id=12', 'read'),
(5, 'kritika', 'You are in a project 12', 'http://localhost/eclient/00.final%20site/requirement.php?id=12', 'read'),
(6, 'kritika', 'You are in a project 19', 'http://localhost/eclient/00.final%20site/requirement.php?id=19', 'read'),
(7, 'kritika', 'You are a project 19 main handler', 'http://localhost/eclient/00.final%20site/requirement.php?id=19', 'read'),
(8, 'admin1', 'You are in a project 17', 'http://localhost/eclient/00.final%20site/requirement.php?id=17', 'read'),
(9, 'admin1', 'You have a new module \"Data validation module\"', 'http://localhost/eclient/00.final%20site/individual_module.php', 'read'),
(10, 'kritika', 'You are in a project 17', 'http://localhost/eclient/00.final%20site/requirement.php?id=17', 'read'),
(11, 'kritika', 'You have a new module \"Data validation module\"', 'http://localhost/eclient/00.final%20site/individual_module.php', 'read'),
(61, 'arjun_me', 'You project are set as done. Please contact to company employee.', 'http://localhost/eclient/00.final%20site/dashboard.php', 'unread'),
(62, 'kritika', 'Project is said to be done where you are envolved.', 'http://localhost/eclient/00.final%20site/requirement.php?id=19', 'unread'),
(63, 'sapana', 'You project are set as done. Please contact to company employee.', 'http://localhost/eclient/00.final%20site/dashboard.php', 'unread'),
(64, 'poudel_me', 'You project are set as done. Please contact to company employee.', 'http://localhost/eclient/00.final%20site/dashboard.php', 'unread'),
(65, 'admin1', 'Project is said to be done where you are envolved.', 'http://localhost/eclient/00.final%20site/requirement.php?id=12', 'unread'),
(66, 'kritika', 'Project is said to be done where you are envolved.', 'http://localhost/eclient/00.final%20site/requirement.php?id=12', 'unread'),
(67, 'admin1', 'You are in a project 20', 'http://localhost/eclient/00.final%20site/requirement.php?id=20', 'unread'),
(68, 'company', 'You are in a project 20', 'http://localhost/eclient/00.final%20site/requirement.php?id=20', 'read'),
(69, 'admin1', 'You have a new module \"Data validation module\"', 'http://localhost/eclient/00.final%20site/individual_module.php', 'unread'),
(70, 'admin1', 'You are a project 20 main handler', 'http://localhost/eclient/00.final%20site/requirement.php?id=20', 'unread'),
(71, 'company', 'You have a new module \"Design Module\"', 'http://localhost/eclient/00.final%20site/individual_module.php', 'read'),
(72, 'arjun_me', 'You project are set as done. Please contact to company employee.', 'http://localhost/eclient/00.final%20site/dashboard.php', 'unread'),
(73, 'kritika', 'Project is said to be done where you are envolved.', 'http://localhost/eclient/00.final%20site/requirement.php?id=19', 'unread');

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
  `project_main_handler` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `progress` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ID`, `project_name`, `company_id`, `project_start_date`, `project_end_date`, `project_main_handler`, `progress`) VALUES
(19, 'Blood bank software development', 8, '2018-07-29', '2018-08-15', 'kritika', 'done'),
(20, 'Website development', 8, '2018-08-01', '2018-08-04', 'admin1', 'progress');

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
(121, 18, 'Developer', 'rajusoft'),
(124, 13, 'Developer', 'admin1'),
(125, 13, 'Developer', 'kritika'),
(135, 19, 'designer', 'kritika'),
(137, 20, 'developer', 'admin1'),
(138, 20, 'designer', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `project_log`
--

CREATE TABLE `project_log` (
  `ID` int(11) NOT NULL,
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_main_handler` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `progress` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(6, 19, 'kritika', 'Data validation module', 'Input data validation', 'user data validation', 'done'),
(7, 19, 'kritika', 'Data validation module', 'Input data validation', 'user data validation', 'done'),
(8, 13, 'admin1', 'Data validation module', 'Input data validation', 'lorem lorem', 'progress'),
(18, 20, 'admin1', 'Data validation module', 'Input data validation', 'Input data should be validate.', 'progress'),
(19, 20, 'company', 'Design Module', 'All pictures and banner design', 'All pictures and banner should be design in 10*10 size.', 'progress');

-- --------------------------------------------------------

--
-- Table structure for table `temp_token`
--

CREATE TABLE `temp_token` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `insert_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(6, 'admin1', 'Pradip', 'Dhakal', 'dhpradeep25@gmail.com', '9846751280', 'admin12345', 'company', 'active', '2018-07-25 14:14:44', 8, 0),
(32, 'kritika', 'Kritika', 'Bhattachan', 'kritika@gmail.com', '', 'kritika', 'company', 'deactive', '2018-07-27 13:53:05', 8, 0),
(36, 'arjun_me', 'Arjun', 'subedi', 'arjun@gmail.com', '', 'arjun', 'client', 'deactive', '2018-07-29 10:51:38', 8, 19),
(37, 'prabhu', 'Prabhu', 'Gurung', 'grg_prabhu@yahoo.com', '9846728507', 'jQz4iDiZ', 'company', 'deactive', '2018-08-02 07:56:50', 1, 0),
(38, 'company', 'Pradeep', 'Poudel', 'systemanalyst2054@gmail.com', '', 'company123', 'company', 'deactive', '2018-08-03 19:42:24', 8, 0),
(39, 'prabhu_me', 'prabhu', 'gurung', 'grg_prabhu@yahoo.com', '', 'prabhu_me', 'client', 'deactive', '2018-08-03 19:44:50', 8, 20);

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
-- Indexes for table `notice`
--
ALTER TABLE `notice`
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
-- Indexes for table `project_log`
--
ALTER TABLE `project_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project_module`
--
ALTER TABLE `project_module`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `temp_token`
--
ALTER TABLE `temp_token`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `project_module`
--
ALTER TABLE `project_module`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `temp_token`
--
ALTER TABLE `temp_token`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
