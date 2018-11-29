-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 03:05 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zechat`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_messages`
--

CREATE TABLE `test_messages` (
  `message_id` int(11) UNSIGNED NOT NULL,
  `from_id` varchar(40) NOT NULL DEFAULT '',
  `to_id` varchar(50) NOT NULL DEFAULT '',
  `from_uname` varchar(225) NOT NULL DEFAULT '',
  `to_uname` varchar(255) NOT NULL DEFAULT '',
  `message_content` text NOT NULL,
  `message_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` tinyint(1) NOT NULL DEFAULT '0',
  `seen` enum('0','1') NOT NULL DEFAULT '0',
  `message_type` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_userdata`
--

CREATE TABLE `test_userdata` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `joined` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `country` text COLLATE utf8_unicode_ci,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` text COLLATE utf8_unicode_ci NOT NULL,
  `skype` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `last_active_timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `oauth_provider` enum('','facebook','google','twitter') COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_userdata`
--

INSERT INTO `test_userdata` (`id`, `status`, `username`, `password`, `email`, `name`, `joined`, `country`, `about`, `sex`, `dob`, `skype`, `facebook`, `twitter`, `googleplus`, `instagram`, `picname`, `online`, `last_active_timestamp`, `oauth_provider`, `oauth_uid`, `oauth_link`) VALUES
(1, '0', 'Wchat', 'e10adc3949ba59abbe56e057f20f883e', 'bylancertheme@gmail.com', 'Wchatdeveloper', '2016-05-14 08:46:04', 'Canada', 'Developed with  by Deven Katariya for developers', 'female', '', 'zeunix.com', 'https://www.facebook.com/zeunix.in/', 'https://twitter.com/zeunixtech', 'https://plus.google.com/+devkatariya', 'instagram222', 'Wchat.jpg', 1, '2017-06-07 18:34:43', '', '', ''),
(2, '0', 'hellow', 'e10adc3949ba59abbe56e057f20f883e', 'hello@gmaol.com', 'Hellow', '2016-12-02 13:46:20', '', 'Whatsup', 'male', '', '', '', '', '', '', '', 0, '2017-01-17 11:10:29', '', '', ''),
(3, '0', 'Beenny', 'e10adc3949ba59abbe56e057f20f883e', 'beenny@gmail.com', 'Beenny', '2016-12-10 14:24:48', '', 'Hello I am Buzy', 'male', '', '', '', '', '', '', '5306068812.jpg', 0, '2017-06-07 14:00:08', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_messages`
--
ALTER TABLE `test_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `test_userdata`
--
ALTER TABLE `test_userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test_messages`
--
ALTER TABLE `test_messages`
  MODIFY `message_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_userdata`
--
ALTER TABLE `test_userdata`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
