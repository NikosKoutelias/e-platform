-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2022 at 11:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Courses'),
(2, 'Seafarers'),
(3, 'Enrolments'),
(4, 'Completions');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`) VALUES
(1, 'Personal Survival Techniques Course', 'To give all persons intending to go to sea the essential basic knowledge and experience of personal survival principles and techniques that can be applied to maximize their chances of survival in the event of a marine casualty. Based on IMO Model Courses 1.19'),
(2, 'Port State Control Course', 'To provide office and sea going personnel with all the required information in order to prepare and respond properly to Port State Control Inspections.'),
(3, 'Risk Management Course', 'To provide useful insight to all those involved in shipping operations regarding Risk Assessment & Hazard Identification.'),
(4, 'Risk Management / Incident Investigation Course', 'To provide useful insight to all those involved in shipping operations regarding Risk Assessment & Incident Investigation.'),
(5, 'Dry Bulk Vetting (Rightship Requirements) Course', 'To provide useful insight to all those involved in the implementation of the Safety Management System for all day to day operational aspects with respect to the subject.'),
(6, 'EU GDPR Course', 'To analyze the EU regulation 2016/679 regarding personal data, provide guidance on maritime cyber security issues, present relevant legislation and demonstrate best practice approach.'),
(7, 'EU MRV Awareness Course\r\n', 'To provide useful insignt into the EU Monitoring Reporting and Verification (MRV) Regulation offering feedback on the latest developements, clarifications over the EU MRV vs the IMO data collection system and advice on how owners may get prepared for the smooth implementation and develop their EU MRV Monitoring Plan as per requirements.'),
(8, 'Environmental Compliance Course\r\n', 'To provide all office and sea going personnel with the necessary requirements and understanding with respect to Environmental Compliance regime.'),
(9, 'Experience Transfer Workshops Course', 'To provide knowledge, examples (experience based) and lessons learned on major Shipping Industry\'s issues.'),
(10, 'Elementary First Aid Course\r\n', 'To give all seafarers the education and training for working relationships on board, health and hygiene, drugs and alcohol, shipboard management structure and responsibilities, emergencies and safe working practices, with enhanced coverage of communications, control of fatigue, teamwork and marine environmental awareness issues. Based on IMO Model Courses 1.21'),
(11, 'Cyber Security Awareness Course', 'To analyze the Cyber Security Threat, provide guidance on maritime cyber security issues, present relevant legislation and demonstrate best practice approach.'),
(12, 'EU MRV Awareness Course\r\n', 'To provide useful insignt into the EU Monitoring Reporting and Verification (MRV) Regulation offering feedback on the latest developements, clarifications over the EU MRV vs the IMO data collection system and advice on how owners may get prepared for the smooth implementation and develop their EU MRV Monitoring Plan as per requirements.');

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE `enrolments` (
  `enrolment_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolments`
--

INSERT INTO `enrolments` (`enrolment_id`, `course_id`, `user_id`, `completed`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 1, 2, 0),
(4, 5, 2, 0),
(5, 6, 2, 0),
(6, 9, 2, 0),
(7, 4, 1, 0),
(9, 3, 1, 0),
(10, 5, 1, 0),
(11, 6, 1, 1),
(12, 1, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `position` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `firstname`, `lastname`, `position`) VALUES
(1, 'Nick', '$2y$10$VvANFJXfeAzyRHqmgkSAYeEpQ3JJh8IEiYb4bIqQC6zH9Ffpa96zS', 'nick@mail.com', 'Nick', 'Kout', 'Rating'),
(2, 'manos', '$2y$10$00EDOk2QPK3x1QdE/3/Zq.VHAvhef0eBF8qlSPdNmnKjIaRiOi0Jy', 'manos@mail.com', 'Manos', 'Kout', 'Captain'),
(3, 'Effie', '$2y$10$yIQoy0GFd9bZ236vhtbk8OqCdIYFt6Bm8xdhNCUI8J3ykRsE/OoJK', 'effie@mail.com', 'Effie', 'Eco', 'Rating'),
(4, 'Kostas', '$2y$10$qftWPFVb4Qpq0eYlT2K4JenrJXgkceDkKchtdwvmGdJUIdSfq3UAC', 'kostas@mail.com', 'Kostas', 'Gian', 'Officer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD PRIMARY KEY (`enrolment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrolments`
--
ALTER TABLE `enrolments`
  MODIFY `enrolment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
