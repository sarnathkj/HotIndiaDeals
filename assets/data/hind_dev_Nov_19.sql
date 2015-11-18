-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2015 at 11:57 PM
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
-- Table structure for table `deal_state`
--

CREATE TABLE IF NOT EXISTS `deal_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `state` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `deal_state`
--

INSERT INTO `deal_state` (`id`, `state`) VALUES
(3, 'DISCUSSED'),
(2, 'HOT'),
(1, 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `thread_details`
--

CREATE TABLE IF NOT EXISTS `thread_details` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_type_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deal_url` varchar(255) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `catid` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `voucher_code` varchar(100) DEFAULT NULL,
  `minimum_spend` varchar(200) DEFAULT NULL,
  `instruction` text,
  `rules_link` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `tempertature` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`thread_id`),
  KEY `thread_type_FK` (`thread_type_id`),
  KEY `deals_cateogory_FK` (`catid`),
  KEY `user_details_FK` (`userid`),
  KEY `deal_state_FK` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `thread_details`
--

INSERT INTO `thread_details` (`thread_id`, `thread_type_id`, `title`, `deal_url`, `price`, `catid`, `image`, `description`, `tags`, `start_date`, `end_date`, `discount`, `voucher_code`, `minimum_spend`, `instruction`, `rules_link`, `location`, `area`, `pincode`, `userid`, `views`, `tempertature`, `state`) VALUES
(1, 1, 'Assassin''s Creed IV 4: Black Flag Xbox One - Digital Code - 5.99 - CDKeys', NULL, '5.99', 1, '/assets/img/images.jpg', 'Seems like a nice price going for an Assassins Creed game set in the pirate era.', 'Xbox One, CD, Assassins Creed IV', '2015-11-16', '2016-11-30', '10%', 'HIND10', '100', 'Get an extra 10% off sale items during Debenhams winter spectacular sale.\r\nEnter VL93 in before paying.', '#', 'Madurai', 'Alangulam', '625017', 1, 456, 0, 1),
(3, 2, '3 x OnePlus Two invites up for grabs', NULL, '', 6, '', 'Hi all.,  Some of you may know the OnePlus 2 phones. The Mrs got one last week, very nice indeed.  I''ve got three invites here for the OnePlus 2 phones for anybody who would like one - free of course (apparently some people flog them on eBay - cheeky really).  First come, first served. Just reply to the thread and I''ll PM the code a bit later.  Please note, from point of use you have 24 hours to proceed with your purchase otherwise they self-destruct.  Regards,  SP', 'oneplus, two, deals, mobile, smartphone', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', 1, 0, 0, 1),
(5, 6, 'Would you sign this petition', NULL, NULL, 8, NULL, 'Would you back the petition to get free school meals for all primary children in the UK from nursery to primary 7. Regardless of there parents financial background.  Do you think this is a good idea?', 'uk, petitions, free, school, meals', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, -1, 1),
(11, 1, 'HOT COLD Star Wars Battlefront (PC) £22.55 from Origin Brazil', 'https://www.origin.com/en-in/store/buy/star-wars-battlefront/pc-download/base-game/standard-edition', '22.55', 3, '/assets/img/deal_images/deal.jpg', 'A lot of people mention Origin Mexico when buying VPN, but Battlefront is currently £5 on the Brazilian version of the site. Use a VPN service like TunnelBear (500MB free every month, Chrome extension) to select Brazil and purchase for R$ 129.90, or £22.55 (according to Google).  Alternatively, £45.10 for the game and season pass (Ultimate edition)', 'PC, Star, Wars, Battlefront', '2015-11-19', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1),
(12, 1, 'HOT COLD Star Wars Battlefront (PC) £22.55 from Origin Brazil', 'https://www.origin.com/en-in/store/buy/star-wars-battlefront/pc-download/base-game/standard-edition', '22.55', 3, '/assets/img/deal_images/deal.jpg', 'A lot of people mention Origin Mexico when buying VPN, but Battlefront is currently £5 on the Brazilian version of the site. Use a VPN service like TunnelBear (500MB free every month, Chrome extension) to select Brazil and purchase for R$ 129.90, or £22.55 (according to Google).  Alternatively, £45.10 for the game and season pass (Ultimate edition)', 'PC, Star, Wars, Battlefront', '2015-11-19', '2015-11-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1),
(13, 1, 'HOT COLD Star Wars Battlefront (PC) £22.55 from Origin Brazil', 'https://www.origin.com/en-in/store/buy/star-wars-battlefront/pc-download/base-game/standard-edition', '22.55', 3, '/assets/img/deal_images/deal.jpg', 'A lot of people mention Origin Mexico when buying VPN, but Battlefront is currently £5 on the Brazilian version of the site. Use a VPN service like TunnelBear (500MB free every month, Chrome extension) to select Brazil and purchase for R$ 129.90, or £22.55 (according to Google).  Alternatively, £45.10 for the game and season pass (Ultimate edition)', 'PC, Star, Wars, Battlefront', '0000-00-00', '2015-11-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1),
(14, 1, 'HOT COLD Star Wars Battlefront (PC) £22.55 from Origin Brazil', 'https://www.origin.com/en-in/store/buy/star-wars-battlefront/pc-download/base-game/standard-edition', '22.55', 3, '/assets/img/deal_images/deal.jpg', 'A lot of people mention Origin Mexico when buying VPN, but Battlefront is currently £5 on the Brazilian version of the site. Use a VPN service like TunnelBear (500MB free every month, Chrome extension) to select Brazil and purchase for R$ 129.90, or £22.55 (according to Google).  Alternatively, £45.10 for the game and season pass (Ultimate edition)', 'PC, Star, Wars, Battlefront', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1),
(15, 1, 'HOT COLD Star Wars Battlefront (PC) £22.55 from Origin Brazil', 'https://www.origin.com/en-in/store/buy/star-wars-battlefront/pc-download/base-game/standard-edition', '22.55', 3, '/assets/img/deal_images/deal.jpg', 'A lot of people mention Origin Mexico when buying VPN, but Battlefront is currently £5 on the Brazilian version of the site. Use a VPN service like TunnelBear (500MB free every month, Chrome extension) to select Brazil and purchase for R$ 129.90, or £22.55 (according to Google).  Alternatively, £45.10 for the game and season pass (Ultimate edition)', 'PC, Star, Wars, Battlefront', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thread_type`
--

CREATE TABLE IF NOT EXISTS `thread_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `thread_type`
--

INSERT INTO `thread_type` (`id`, `type`, `description`) VALUES
(1, 'Deals', 'Deals'),
(2, 'Vouchers', 'Vouchers'),
(3, 'Freebies', 'Freebies'),
(4, 'Ask', 'Ask'),
(5, 'Competitions', 'Competitions'),
(6, 'Misc', 'Miscellanous'),
(7, 'Ask', 'Ask'),
(8, 'Feedback', 'Feedback'),
(9, 'FSFT', 'For Sale/For Trade');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_image` varchar(255) DEFAULT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `followers` longtext,
  `buddy_list` longtext,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`uid`, `username`, `email`, `description`, `location`, `date_joined`, `profile_image`, `login_timestamp`, `followers`, `buddy_list`) VALUES
(1, 'sarnathkj', 'sarnathkj@gmail.com', 'Mokka Description', 'S. Alangulam, Madurai', '2015-11-17 20:04:39', '/assets/img/profile_pictures/saran.jpg', '2015-11-17 20:04:39', NULL, NULL),
(2, 'abrahamk', 'abrahamrkj@gmail.com', 'Description nyabagam varliyae.', 'Selva Gardens, Madurai', '2015-11-17 20:10:33', '/assets/img/profile_pictures/abu.jpg', '2015-11-17 20:10:33', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `thread_details`
--
ALTER TABLE `thread_details`
  ADD CONSTRAINT `deals_cateogory_FK` FOREIGN KEY (`catid`) REFERENCES `deals_category` (`catid`),
  ADD CONSTRAINT `deal_state_FK` FOREIGN KEY (`state`) REFERENCES `deal_state` (`id`),
  ADD CONSTRAINT `thread_type_FK` FOREIGN KEY (`thread_type_id`) REFERENCES `thread_type` (`id`),
  ADD CONSTRAINT `user_details_FK` FOREIGN KEY (`userid`) REFERENCES `user_details` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
