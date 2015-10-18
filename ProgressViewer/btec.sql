-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2014 at 12:13 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `btec`
--
CREATE DATABASE IF NOT EXISTS `btec` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `btec`;

-- --------------------------------------------------------

--
-- Table structure for table `classlist`
--

CREATE TABLE IF NOT EXISTS `classlist` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `teacherid` int(11) NOT NULL,
  `classname` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`classid`),
  KEY `teacherid` (`teacherid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `classlist`
--

INSERT INTO `classlist` (`classid`, `teacherid`, `classname`) VALUES
(1, 1, 'A-TEA'),
(3, 2, 'C-DCD');

-- --------------------------------------------------------

--
-- Table structure for table `classstudent`
--

CREATE TABLE IF NOT EXISTS `classstudent` (
  `userid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  PRIMARY KEY (`userid`,`classid`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classstudent`
--

INSERT INTO `classstudent` (`userid`, `classid`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `moodleid` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `username`, `password`, `moodleid`) VALUES
(1, 'Admin', 'p', 0),
(2, '1', 'p', 3),
(3, '2', 'p', 4),
(4, 'TEA', 'p', 0),
(5, 'DCD', 'p', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacherid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`teacherid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacherid`, `userid`) VALUES
(3, 1),
(1, 4),
(2, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
