-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2016 at 03:21 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reco`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Activity', '2016-05-23 00:00:00', '0000-00-00 00:00:00'),
(2, 'Food & Drink', '2016-05-23 00:00:00', '0000-00-00 00:00:00'),
(3, 'Must-see Attraction', '2016-05-23 00:00:00', '0000-00-00 00:00:00'),
(4, 'Arts & Culture', '2016-05-23 00:00:00', '0000-00-00 00:00:00'),
(5, 'Shopping', '2016-05-23 00:00:00', '0000-00-00 00:00:00'),
(6, 'Place to stay', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `story_id` int(11) unsigned NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `story_id`, `photo`, `created`) VALUES
(1, 1, '1463906104_Lighthouse.jpg', '2016-05-22 14:05:04'),
(2, 1, '1463906104_Penguins.jpg', '2016-05-22 14:05:04'),
(3, 2, '1463911567_Chrysanthemum.jpg', '2016-05-22 15:36:06'),
(4, 2, '1463911567_Desert.jpg', '2016-05-22 15:36:06'),
(5, 3, '1463911606_Jellyfish.jpg', '2016-05-22 15:36:46'),
(6, 3, '1463911606_Koala.jpg', '2016-05-22 15:36:46'),
(7, 4, '1463943489_Screen Shot 2016-05-18 at 5.21.29 PM.png', '2016-05-23 00:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `story_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `story_id` int(11) unsigned NOT NULL,
  `place_id` varchar(255) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `formatted_address` text NOT NULL,
  `latitude` varchar(65) NOT NULL,
  `longitude` varchar(65) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `story_id`, `place_id`, `place_name`, `formatted_address`, `latitude`, `longitude`, `created`) VALUES
(1, 1, 'ChIJezVzMaTlDDkRP8B8yDDO_zc', 'Noida', 'Noida, Uttar Pradesh 201301, India', '28.5355161', '77.39102649999995', '2016-05-22 14:05:04'),
(2, 2, 'ChIJLbZ-NFv9DDkRzk0gTkm3wlI', 'New Delhi', 'New Delhi, Delhi 110001, India', '28.6139391', '77.20902120000005', '2016-05-22 15:36:06'),
(4, 3, 'ChIJWYjjgtUZDTkRHkvG5ehfzwI', 'Gurgaon', 'Gurgaon, Haryana 122001, India', '28.4594965', '77.02663830000006', '2016-05-22 21:24:08'),
(5, 4, 'ChIJ2fUkDpRZwokRUfmdRhH-Czg', 'Joseph Leonard', '170 Waverly Pl, New York, NY 10014, United States', '40.7335794', '-74.00169670000002', '2016-05-23 00:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `story_categories`
--

CREATE TABLE IF NOT EXISTS `story_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `story_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `story_categories`
--

INSERT INTO `story_categories` (`id`, `story_id`, `category_id`, `created`, `modified`) VALUES
(1, 1, 1, '2016-05-22 14:05:04', '2016-05-22 14:05:04'),
(2, 2, 2, '2016-05-22 15:36:06', '2016-05-22 15:36:07'),
(4, 3, 3, '2016-05-22 21:24:08', '2016-05-22 21:24:08'),
(5, 4, 2, '2016-05-23 00:28:09', '2016-05-23 00:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `category_id`, `tag`) VALUES
(1, 1, 'urbanhike'),
(2, 1, 'bikeride'),
(4, 1, 'workout'),
(5, 1, 'hike'),
(6, 1, 'indoors'),
(7, 1, 'outdoors'),
(8, 1, 'nature'),
(9, 1, 'amazingviews'),
(10, 2, 'bestforbrunch'),
(11, 2, 'happyhour'),
(12, 2, 'cocktails'),
(13, 2, 'epicwinelist'),
(14, 2, 'lightbites'),
(15, 2, 'dinner'),
(16, 2, 'lunch'),
(17, 2, 'comehungry'),
(18, 2, 'dimlighting'),
(19, 2, 'loud&lively'),
(20, 2, 'peace&quiet'),
(21, 2, 'coffee'),
(22, 2, 'youngscene'),
(23, 2, 'familyscene'),
(24, 2, 'biggroups'),
(25, 2, 'romantic'),
(26, 2, 'bottomlessbeverages'),
(27, 2, 'freewater'),
(28, 3, 'quickstop'),
(29, 3, 'crazycrowds'),
(30, 3, 'historical'),
(31, 3, 'beautiful'),
(32, 3, 'lotstolearn'),
(33, 3, 'guidedtour'),
(34, 3, 'comeearly'),
(35, 3, 'indoors'),
(36, 3, 'outdoors'),
(37, 3, 'wasteoftime'),
(38, 3, 'buytixbeforehand'),
(39, 3, 'park'),
(40, 4, 'quickstop'),
(41, 4, 'crazycrowds'),
(42, 4, 'historical'),
(43, 4, 'beautiful'),
(44, 4, 'lotstolearn'),
(45, 4, 'guidedtour'),
(46, 4, 'comeearly'),
(47, 4, 'indoors'),
(48, 4, 'outdoors'),
(49, 4, 'wasteoftime'),
(50, 4, 'buytixbeforehand'),
(51, 4, 'museum'),
(52, 4, 'show'),
(53, 4, 'theatre'),
(54, 4, 'musical'),
(55, 4, 'gallery'),
(56, 4, 'modernart'),
(57, 5, 'budgetfriendly'),
(58, 5, 'boutique'),
(59, 5, 'hiddengems'),
(60, 5, 'bigbrandnames'),
(61, 5, 'bags'),
(62, 5, 'shoes'),
(63, 5, 'clothes'),
(64, 5, 'accessories'),
(65, 5, 'highend'),
(66, 5, 'lowend'),
(67, 5, 'highfashion'),
(68, 5, 'trendy'),
(69, 5, 'giftshop'),
(70, 5, 'souvenirs'),
(71, 5, 'localgarb'),
(72, 5, 'localartists'),
(73, 5, 'crafts'),
(74, 5, 'uniquefinds'),
(75, 5, 'textiles'),
(76, 6, 'airbnb'),
(77, 6, 'hotel'),
(78, 6, 'boutiquehotel'),
(79, 6, 'hostel'),
(80, 6, 'campsite'),
(81, 6, 'luxuryhotel'),
(82, 6, 'allinclusive'),
(83, 6, 'homestay');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `user_id`, `title`, `notes`, `status`, `created`, `modified`) VALUES
(1, 10, 'fun trip', 'test', 1, '2016-05-22 15:04:36', '2016-05-23 00:17:35'),
(2, 10, 'new trip12', 'test', 1, '2016-05-22 20:06:47', '2016-05-22 21:50:20'),
(4, 10, '', '', 0, '2016-05-22 21:39:09', '2016-05-22 22:31:24'),
(5, 10, 'new trip', 'test', 1, '2016-05-23 00:18:18', '2016-05-23 00:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `trip_cards`
--

CREATE TABLE IF NOT EXISTS `trip_cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) unsigned NOT NULL,
  `day` tinyint(4) NOT NULL,
  `card_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `trip_cards`
--

INSERT INTO `trip_cards` (`id`, `trip_id`, `day`, `card_id`, `created`) VALUES
(45, 2, 1, 3, '2016-05-22 21:50:20'),
(46, 2, 1, 2, '2016-05-22 21:50:20'),
(47, 2, 2, 3, '2016-05-22 21:50:20'),
(48, 1, 1, 2, '2016-05-23 00:17:35'),
(49, 1, 2, 3, '2016-05-23 00:17:35'),
(50, 5, 1, 1, '2016-05-23 00:18:18'),
(51, 5, 1, 2, '2016-05-23 00:18:18'),
(52, 5, 2, 2, '2016-05-23 00:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) DEFAULT NULL,
  `about` text,
  `contact_info` text,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `state` varchar(155) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `facebook_id` varchar(255) DEFAULT NULL,
  `twitter_id` varchar(255) DEFAULT NULL,
  `google_profile_id` varchar(255) DEFAULT NULL,
  `profile_pic` text,
  `fb_access_token` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `image` text,
  `city` varchar(500) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `user_description` text,
  `user_added_date` datetime DEFAULT NULL,
  `user_modified_date` datetime DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_role_id`, `about`, `contact_info`, `first_name`, `last_name`, `state`, `username`, `email`, `password`, `user_status`, `facebook_id`, `twitter_id`, `google_profile_id`, `profile_pic`, `fb_access_token`, `phone`, `image`, `city`, `zipcode`, `user_description`, `user_added_date`, `user_modified_date`, `last_login_date`, `last_login_ip`) VALUES
(1, 1, NULL, NULL, 'Admin', '', '', 'admin', 'admin@admin.com', '47c0cbc5a45294b7d76d1e3497d80135880f22b9', 'Active', NULL, NULL, NULL, NULL, NULL, '7503015546', '57152351-2eb4-4a9d-8a1b-1ba8b0aa0a8d.png', 'Noida', '201301', 'Super Admin User....', '2014-01-31 07:47:45', '2016-04-20 00:38:34', '2016-05-01 12:37:59', '::1'),
(3, 2, '', NULL, 'naveen', 'joshi', NULL, 'joshinaveen', 'joshinaveen263@gmail.com', 'c96c6b263c3dbf2dd655bdccdd9fc3f0c0a34c79', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4556', '1123233', NULL, '2016-04-19 22:57:13', NULL, NULL, NULL),
(4, 2, NULL, NULL, 'test', 'test', NULL, 'test123', 'test@gmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '2016-04-19 23:00:16', '2016-04-19 23:01:37', NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, '', 'a@a.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-01 12:39:19', NULL, NULL, NULL),
(6, NULL, NULL, NULL, 'vivek', 'sh', NULL, '', 'vivek@yopmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-01 12:43:27', NULL, NULL, NULL),
(7, NULL, NULL, NULL, 'vivek', 'sh', NULL, '', 'vivek1@yopmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-01 12:48:28', NULL, NULL, NULL),
(8, NULL, NULL, NULL, 'vivek', 'sh', NULL, '', 'v2@yopmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-01 12:53:19', NULL, NULL, NULL),
(9, NULL, NULL, NULL, 'vivek', 'sh', NULL, '', 'v3@yopmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-01 12:55:40', NULL, NULL, NULL),
(10, NULL, NULL, NULL, 'vivek', 'sh', NULL, '', 'v4@yopmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-01 12:56:14', NULL, '2016-05-23 00:03:58', NULL),
(11, NULL, NULL, NULL, 'Vivek', 'Sh', NULL, '', 'viveksh0987@gmail.com', 'ad65b7b356657d5d02915d4f4b9fa51e3dbd9510', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-11 11:50:50', NULL, NULL, NULL),
(12, NULL, NULL, NULL, 'Rollo', 'Tomassi', NULL, '', 'killeratti@yahoo.com', 'c060996b5bc83488e167d53891585fb1450cd8a0', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-18 05:14:18', NULL, '2016-05-19 05:35:45', NULL),
(13, NULL, NULL, NULL, 'Orian', 'Almog', NULL, '', 'orian.almog@gmail.com', 'b8988061c24682faafd522a7959aab306a8d1026', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-18 23:50:02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(255) NOT NULL,
  `user_role_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `user_role_description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role_name`, `user_role_status`, `user_role_description`) VALUES
(1, 'Admin', 'Active', 'Super Admin'),
(2, 'Sub Admin', 'Active', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_stories`
--

CREATE TABLE IF NOT EXISTS `user_stories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notes` text,
  `time_spent` varchar(150) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `is_recommended` tinyint(4) NOT NULL DEFAULT '1',
  `views` int(11) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_stories`
--

INSERT INTO `user_stories` (`id`, `user_id`, `title`, `notes`, `time_spent`, `tags`, `is_recommended`, `views`, `status`, `created`, `modified`) VALUES
(1, 10, 'test', 'etestst', '1 hr', NULL, 1, 6, 1, '2016-05-22 14:05:04', '2016-05-22 14:05:04'),
(2, 10, 'fun', 'test', '1 hr', NULL, 1, 0, 1, '2016-05-22 15:36:06', '2016-05-22 15:36:07'),
(3, 10, 'full fun', 'test', '2 hr', NULL, 1, 5, 1, '2016-05-22 21:24:08', '2016-05-22 21:24:08'),
(4, 13, 'alsfioi', 'jjuju', 'ad', NULL, 1, 5, 1, '2016-05-23 00:28:09', '2016-05-23 00:28:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
