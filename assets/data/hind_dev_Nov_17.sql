-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 11:48 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hind_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `deals_category`
--

CREATE TABLE IF NOT EXISTS `deals_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `deals_category`
--

INSERT INTO `deals_category` (`catid`, `name`, `description`) VALUES
(1, 'AudioVisual', ''),
(2, 'Mobile', ''),
(3, 'Gaming', ''),
(4, 'Computer', ''),
(5, 'Entertainment', ''),
(6, 'Home', ''),
(7, 'Fashion', ''),
(8, 'Kids', ''),
(9, 'Groceries', ''),
(10, 'Travel', ''),
(11, 'Restaurant', '');

-- --------------------------------------------------------

--
-- Table structure for table `deals_details`
--

CREATE TABLE IF NOT EXISTS `deals_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `catid` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount` varchar(255) NOT NULL,
  `voucher_code` varchar(100) NOT NULL,
  `minimum_spend` varchar(200) NOT NULL,
  `instruction` text NOT NULL,
  `rules_link` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `deals_details`
--

INSERT INTO `deals_details` (`id`, `did`, `title`, `price`, `catid`, `image`, `desc`, `tags`, `start_date`, `end_date`, `discount`, `voucher_code`, `minimum_spend`, `instruction`, `rules_link`, `location`, `area`, `pincode`, `userid`, `views`) VALUES
(1, 1, 'Assassin''s Creed IV 4: Black Flag Xbox One - Digital Code - 5.99 - CDKeys', '5.99', 1, '/assets/img/images.jpg', 'Seems like a nice price going for an Assassins Creed game set in the pirate era.', 'Xbox One, CD, Assassins Creed IV', '2015-11-16', '2016-11-30', '10%', 'HIND10', '100', 'Get an extra 10% off sale items during Debenhams winter spectacular sale.\r\nEnter VL93 in before paying.', '#', 'Madurai', 'Alangulam', '625017', 1, 456);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
