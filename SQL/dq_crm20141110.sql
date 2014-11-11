-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2014 at 06:43 AM
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
-- Table structure for table `dq_survey_questions`
--

CREATE TABLE IF NOT EXISTS `dq_survey_questions` (
  `survey_question_id` int(20) NOT NULL AUTO_INCREMENT,
  `qcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(100) NOT NULL,
  `type` enum('basic','main') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'basic',
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `points` int(3) NOT NULL DEFAULT '1',
  `options` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'This contains the possible options for the questions and must be in JSON format',
  `parent_rules` enum('t','f') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'f',
  `dependent` int(20) NOT NULL COMMENT 'if this is the child of a parent rule, the value must point to the id of the parent questionnaie',
  `cap` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`survey_question_id`),
  UNIQUE KEY `qcode` (`qcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `dq_survey_questions`
--

INSERT INTO `dq_survey_questions` (`survey_question_id`, `qcode`, `order`, `type`, `question`, `points`, `options`, `parent_rules`, `dependent`, `cap`, `created`, `modified`) VALUES
(1, '20130111', 1, 'basic', 'Sample Survey question', 10, '["unanswered","+Option 1","+Option 2","Option 3"]', 'f', 0, 150, '0000-00-00 00:00:00', '2014-11-09 13:29:42'),
(11, 'Q1234', 2, 'main', 'Sample Question with dependency', 1, '["New Option 1","+New Option 2","New Option 3","Unanswered"]', 'f', 0, 100, '0000-00-00 00:00:00', '2014-11-09 19:55:23'),
(20, 'Q1234-A', 0, 'main', 'Supporting Question qqqdew', 1, '["Child Option 1","+Child Option 2","Unanswered","Option 3"]', 'f', 11, 0, '0000-00-00 00:00:00', '2014-11-09 20:20:34'),
(21, 'Q1234-B', 0, 'main', 'Supporting Question B qqq', 1, '["+2 Child Option 2 ","Unanswered"]', 'f', 11, 0, '0000-00-00 00:00:00', '2014-11-09 20:20:34'),
(22, 'Q1234-C', 0, 'main', 'Q1234-B Question', 1, '["Q1234-B 1","+Q1234-B 2","Q1234-B 3","Unanswered"]', 'f', 11, 0, '0000-00-00 00:00:00', '2014-11-09 20:20:34'),
(23, 'Q9090', 10, 'main', 'Fir deletion', 10, '["unanswered","+New Option","New Option"]', 'f', 0, 10, '0000-00-00 00:00:00', '2014-11-09 20:41:55'),
(24, 'Q9090-A', 0, 'main', 'ertwet', 1, '["unanswered","New 2 Option","+New 1 Option"]', 'f', 23, 0, '0000-00-00 00:00:00', '2014-11-09 20:41:55'),
(27, '7236489', 10, 'main', 'another for delete', 19, '["unanswered"]', 'f', 0, 10, '0000-00-00 00:00:00', '2014-11-09 20:46:53'),
(28, '8907890', 100, 'basic', 'for deleyion', 10, '["unanswered","New Option"]', 'f', 0, 1999, '0000-00-00 00:00:00', '2014-11-09 21:03:06');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dq_users`
--

INSERT INTO `dq_users` (`user_id`, `username`, `password`, `last_name`, `first_name`, `middle_name`, `user_status_id`, `position`, `contact_details`, `photo`, `created`, `modified`) VALUES
(1, 'silver', '97f014516561ef487ec368d6158eb3f4', 'Fronda', 'Christian Earl', 'Belvis', 1, 'Software Engineer', '#9058 Hormiga St., Brgy. Olympia, \nMakati City\n\nCP# 09999944202', '', '2014-11-07 22:24:29', '2014-11-07 22:24:29'),
(3, 'earl.fronda', 'Admin123!@#', 'Fronda', 'Earl', 'Belvis', 2, 'senior', '09999944202', '', '0000-00-00 00:00:00', '2014-11-08 22:19:50');

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
