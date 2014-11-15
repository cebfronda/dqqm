-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2014 at 02:10 PM
-- Server version: 5.6.12
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dq_crm`
--
CREATE DATABASE IF NOT EXISTS `dq_crm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dq_crm`;

-- --------------------------------------------------------

--
-- Table structure for table `dq_account_verifications`
--

CREATE TABLE IF NOT EXISTS `dq_account_verifications` (
  `account_verification_id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(3) NOT NULL,
  `reference` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `script` text COLLATE utf8_unicode_ci NOT NULL,
  `points` int(10) NOT NULL DEFAULT '1',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` datetime NOT NULL,
  PRIMARY KEY (`account_verification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `dq_account_verifications`
--

INSERT INTO `dq_account_verifications` (`account_verification_id`, `order`, `reference`, `script`, `points`, `modified`, `created`) VALUES
(1, 1, 'title', 'script goes here', 1, '2014-11-02 13:26:04', '2014-11-02 13:26:04'),
(2, 2, 'first_name', 'script goes here', 1, '2014-11-02 13:29:29', '2014-11-02 13:29:29'),
(3, 3, 'last_name', 'script goes here', 1, '2014-11-02 13:29:29', '2014-11-02 13:29:29'),
(4, 4, 'middle_initial', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(5, 5, 'gender', 'sex goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(6, 6, 'alt_phone', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(7, 7, 'email', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(8, 8, 'address1', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(9, 9, 'address2', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(10, 10, 'address3', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(11, 11, 'city', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(12, 12, 'state', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(13, 13, 'province', 'script goes here', 1, '2014-11-02 13:38:32', '2014-11-02 13:38:32'),
(22, 0, 'postal_code', 'wergwe', 0, '2014-11-08 23:54:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dq_call_logs`
--

CREATE TABLE IF NOT EXISTS `dq_call_logs` (
  `call_log_id` bigint(50) NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(50) NOT NULL COMMENT 'user_id of agent users',
  `customer_id` bigint(50) NOT NULL,
  `call_duration` time NOT NULL,
  `points` int(11) NOT NULL,
  `call_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`call_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dq_call_records`
--

CREATE TABLE IF NOT EXISTS `dq_call_records` (
  `call_log_id` bigint(50) NOT NULL,
  `refernce` enum('dq_account_verifications','dq_survey_questions') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'dq_survey_questions',
  `reference_id` bigint(50) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `record_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dq_customers`
--

CREATE TABLE IF NOT EXISTS `dq_customers` (
  `customer_id` bigint(50) NOT NULL COMMENT 'This is the customers telephone number.',
  `title` enum('Mr','Ms','Mrs','Dr','Atty') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Mr',
  `first_name` text COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8_unicode_ci NOT NULL,
  `middle_initial` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Male',
  `alt_phone` int(20) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `address1` text COLLATE utf8_unicode_ci NOT NULL,
  `address2` text COLLATE utf8_unicode_ci NOT NULL,
  `address3` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `province` text COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dq_logic`
--

CREATE TABLE IF NOT EXISTS `dq_logic` (
  `logical_id` bigint(50) NOT NULL AUTO_INCREMENT,
  `logic_id` bigint(50) NOT NULL,
  `survey_question_id` bigint(50) NOT NULL,
  `inclusion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`logical_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dq_logic`
--

INSERT INTO `dq_logic` (`logical_id`, `logic_id`, `survey_question_id`, `inclusion`) VALUES
(1, 1, 46, '["unanswered","AL","B","BH"]'),
(2, 50, 46, '["18-24","25-34","45-54"]');

-- --------------------------------------------------------

--
-- Table structure for table `dq_survey_questions`
--

CREATE TABLE IF NOT EXISTS `dq_survey_questions` (
  `survey_question_id` int(20) NOT NULL AUTO_INCREMENT,
  `set_id` text COLLATE utf8_unicode_ci NOT NULL,
  `qcode` text COLLATE utf8_unicode_ci NOT NULL,
  `campaign` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(100) NOT NULL,
  `type` enum('basic','main') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'basic',
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `points` int(3) NOT NULL DEFAULT '1',
  `options` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'This contains the possible options for the questions and must be in JSON format',
  `parent_rules` enum('t','f') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'f',
  `dependent` int(20) NOT NULL COMMENT 'if this is the child of a parent rule, the value must point to the id of the parent questionnaie',
  `cap_type` enum('capped','uncapped') CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL DEFAULT 'capped',
  `cap` int(10) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `effectivity_date` date NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`survey_question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Dumping data for table `dq_survey_questions`
--

INSERT INTO `dq_survey_questions` (`survey_question_id`, `set_id`, `qcode`, `campaign`, `order`, `type`, `question`, `points`, `options`, `parent_rules`, `dependent`, `cap_type`, `cap`, `status_id`, `effectivity_date`, `remarks`, `created`, `modified`) VALUES
(1, '1111A', '11111A', 'PRE-QUALIFYING', 1, 'basic', 'POST CODE INCLUSION', 1, '["unanswered","+AL","+B","BH","BN","BR"]', 'f', 0, 'capped', 150, 0, '0000-00-00', 'some', '0000-00-00 00:00:00', '2014-11-09 13:29:42'),
(46, '31267', '73124', 'Scottish Power', 7, 'main', 'Who is your electric supplier?', 1, '', 'f', 0, 'uncapped', 0, 1, '2014-09-18', 'No Remarks', '0000-00-00 00:00:00', '2014-11-14 22:59:33'),
(50, '213231', '6378290', 'PRE-QUALIFYING', 2, 'basic', 'Please Indicate your age bracket?', 1, '["Not Answered","18-24","25-34","45-54","55-64","65-74","75 and above"]', 'f', 0, 'capped', 0, 1, '0000-00-00', 'Age', '0000-00-00 00:00:00', '2014-11-14 23:34:21'),
(53, '31267-A', '73122', 'Scottish Power', 0, 'main', 'Who is your Current Supplier?', 1, '', 'f', 46, 'capped', 100, 1, '2014-09-18', 'No Remarks', '0000-00-00 00:00:00', '2014-11-15 10:56:03'),
(54, '111111', '1237834', 'NPower', 0, 'main', 'some script', 12, '', 'f', 46, 'capped', 12, 2, '2014-11-30', '123', '0000-00-00 00:00:00', '2014-11-15 10:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `dq_survey_question_options`
--

CREATE TABLE IF NOT EXISTS `dq_survey_question_options` (
  `option_id` bigint(50) NOT NULL AUTO_INCREMENT,
  `survey_question_id` bigint(50) NOT NULL,
  `option` text COLLATE utf8_unicode_ci NOT NULL,
  `positive` enum('t','f') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'f',
  `linkto` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=155 ;

--
-- Dumping data for table `dq_survey_question_options`
--

INSERT INTO `dq_survey_question_options` (`option_id`, `survey_question_id`, `option`, `positive`, `linkto`) VALUES
(5, 28, 'unanswered', 'f', ''),
(6, 28, 'New Option', 'f', ''),
(7, 29, 'Not Answered', 'f', ''),
(8, 33, 'Not Answered', 'f', ''),
(9, 27, 'unanswered', 'f', ''),
(10, 21, 'New Option 1', 'f', ''),
(11, 21, 'New Option 2', 't', ''),
(12, 21, 'New Option 3', 'f', ''),
(13, 21, 'Unanswered', 'f', ''),
(14, 23, 'unanswered', 'f', ''),
(15, 23, 'New Option', 't', ''),
(16, 23, 'New Option', 'f', ''),
(17, 37, 'Not Answered', 'f', ''),
(18, 37, 'British Gas', 't', ''),
(19, 37, 'EDF Energy', 't', ''),
(20, 37, 'EOF\\N', 't', ''),
(21, 37, 'NPower', 't', ''),
(22, 37, 'Other', 't', ''),
(23, 37, 'Scottish Power', 'f', ''),
(24, 38, 'Not Answered', 'f', ''),
(25, 38, 'Bristish Gas', 'f', ''),
(26, 38, 'EDF Energy', 'f', ''),
(27, 38, 'EON', 'f', ''),
(28, 38, 'NPower', 'f', ''),
(29, 38, 'Other', 'f', ''),
(30, 38, 'Scottish Power', 'f', ''),
(31, 40, 'Not Answered', 'f', ''),
(32, 40, 'British Gas', 't', ''),
(33, 40, 'EDF Energy', 't', ''),
(34, 40, 'EOF\\N', 't', ''),
(35, 40, 'NPower', 't', ''),
(36, 40, 'Other', 't', ''),
(37, 40, 'Scottish Power', 'f', ''),
(38, 41, 'Not Answered', 'f', ''),
(39, 41, 'Bristish Gas', 'f', ''),
(40, 41, 'EDF Energy', 'f', ''),
(41, 41, 'EON', 'f', ''),
(42, 41, 'NPower', 'f', ''),
(43, 41, 'Other', 'f', ''),
(44, 41, 'Scottish Power', 'f', ''),
(45, 42, 'Not Answered', 'f', ''),
(46, 42, 'British Gas', 't', ''),
(47, 42, 'EDF Energy', 't', ''),
(48, 42, 'EOF\\N', 't', ''),
(49, 42, 'NPower', 't', ''),
(50, 42, 'Other', 't', ''),
(51, 42, 'Scottish Power', 'f', ''),
(52, 43, 'Not Answered', 'f', ''),
(53, 43, 'Bristish Gas', 'f', ''),
(54, 43, 'EDF Energy', 'f', ''),
(55, 43, 'EON', 'f', ''),
(56, 43, 'NPower', 'f', ''),
(57, 43, 'Other', 'f', ''),
(58, 43, 'Scottish Power', 'f', ''),
(59, 44, 'Not Answered', 'f', ''),
(60, 44, 'British Gas', 't', ''),
(61, 44, 'EDF Energy', 't', ''),
(62, 44, 'EOF\\N', 't', ''),
(63, 44, 'NPower', 't', ''),
(64, 44, 'Other', 't', ''),
(65, 44, 'Scottish Power', 'f', ''),
(66, 45, 'Not Answered', 'f', ''),
(67, 45, 'Bristish Gas', 'f', ''),
(68, 45, 'EDF Energy', 'f', ''),
(69, 45, 'EON', 'f', ''),
(70, 45, 'NPower', 'f', ''),
(71, 45, 'Other', 'f', ''),
(72, 45, 'Scottish Power', 'f', ''),
(103, 1, 'unanswered', 'f', ''),
(104, 1, 'AL', 't', ''),
(105, 1, 'B', 't', ''),
(106, 1, 'BH', 'f', ''),
(107, 1, 'BN', 'f', ''),
(108, 1, 'BR', 'f', ''),
(109, 50, 'Not Answered', 'f', ''),
(110, 50, '18-24', 'f', ''),
(111, 50, '25-34', 'f', ''),
(112, 50, '45-54', 'f', ''),
(113, 50, '55-64', 'f', ''),
(114, 50, '65-74', 'f', ''),
(115, 50, '75 and above', 'f', ''),
(139, 46, 'Not Answered', 'f', ''),
(140, 46, 'British Gas', 't', ''),
(141, 46, 'EDF Energy', 't', ''),
(142, 46, 'EOFN', 't', ''),
(143, 46, 'NPower', 't', ''),
(144, 46, 'Other', 't', ''),
(145, 46, 'Scottish Power', 'f', ''),
(146, 53, 'Not Answered', 'f', ''),
(147, 53, 'Bristish Gas', 'f', ''),
(148, 53, 'EDF Energy', 'f', ''),
(149, 53, 'EON', 'f', ''),
(150, 53, 'NPower', 'f', ''),
(151, 53, 'Other', 'f', ''),
(152, 53, 'Scottish Power', 't', ''),
(153, 54, 'Not Answered', 'f', ''),
(154, 54, 'New Option', 't', '');

-- --------------------------------------------------------

--
-- Table structure for table `dq_survey_question_status`
--

CREATE TABLE IF NOT EXISTS `dq_survey_question_status` (
  `status_id` int(2) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dq_survey_question_status`
--

INSERT INTO `dq_survey_question_status` (`status_id`, `status`, `mark`) VALUES
(1, 'ACTIVE', 1),
(2, 'INACTIVE', 1),
(3, 'PAUSED', 1),
(4, 'PAUSED', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dq_users`
--

CREATE TABLE IF NOT EXISTS `dq_users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8_unicode_ci NOT NULL,
  `first_name` text COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_status_id` int(10) NOT NULL,
  `position` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_details` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `dq_users`
--

INSERT INTO `dq_users` (`user_id`, `username`, `password`, `last_name`, `first_name`, `middle_name`, `user_status_id`, `position`, `contact_details`, `photo`, `created`, `modified`) VALUES
(1, 'silver', '97f014516561ef487ec368d6158eb3f4', 'Fronda', 'Christian Earl', 'Belvis', 1, 'Software Engineer', '#9058 Hormiga St., Brgy. Olympia, \nMakati City\n\nCP# 09999944202', '', '2014-11-07 22:24:29', '2014-11-07 22:24:29'),
(6, 'earl.fronda', '21232f297a57a5a743894a0e4a801fc3', '', 'xxxx', '', 1, '', '', '', '0000-00-00 00:00:00', '2014-11-12 14:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `dq_user_status`
--

CREATE TABLE IF NOT EXISTS `dq_user_status` (
  `user_status_id` int(2) NOT NULL AUTO_INCREMENT,
  `user_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dq_user_status`
--

INSERT INTO `dq_user_status` (`user_status_id`, `user_status`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Agent');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
