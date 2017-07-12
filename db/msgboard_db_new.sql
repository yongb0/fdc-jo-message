-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2017 at 05:02 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msgboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `msg_group` varchar(2) NOT NULL,
  `owner_stat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_id`, `from_id`, `content`, `created`, `modified`, `msg_group`, `owner_stat`) VALUES
(1, 5, 1, 'asdfs', '2017-07-11 17:55:23', '2017-07-11 17:55:23', '15', '5,1'),
(2, 5, 1, 'asdfsd', '2017-07-11 18:03:27', '2017-07-11 18:03:27', '15', '5,1'),
(3, 2, 7, 'asdfadsf', '2017-07-12 10:20:31', '2017-07-12 10:20:31', '27', '2,7'),
(4, 2, 7, 'asdfasf', '2017-07-12 10:20:47', '2017-07-12 04:21:13', '27', '2,'),
(5, 6, 7, 'aSDas', '2017-07-12 10:21:00', '2017-07-12 10:21:00', '67', '6,7');

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `sub_title` varchar(128) NOT NULL,
  `comment` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`id`, `title`, `sub_title`, `comment`) VALUES
(1, 'aaaaa', 'aaaaa', ''),
(2, 'bbbb', 'bbbb', ''),
(3, 'cccc', 'cccc', ''),
(4, 'ddd', 'ddd', ''),
(5, 'eeee', 'eee', ''),
(6, 'fff', 'ffff', ''),
(7, 'gggg', 'gggg', ''),
(8, 'hhhhh', 'hhh', ''),
(9, 'iii', 'iii', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hubby` text,
  `last_login_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `modified_ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(1, 'Jo, Antipala', 'jo@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', '1.png', '1', '1977-07-01', 'Wala koy hubby', '2017-07-12 09:24:03', '2017-07-10 09:18:04', '2017-07-12 09:24:03', '', ''),
(2, 'test1, test1', 'test1@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', '2.png', '1', '2016-03-01', '', '2017-07-10 09:29:10', '2017-07-10 09:29:10', '2017-07-10 03:29:41', '', ''),
(5, 'Aasdf, asfd', 'asdf@gmail.com', '912ec803b2ce49e4a541068d495ab570', NULL, NULL, NULL, NULL, '2017-07-11 10:51:04', '2017-07-11 10:51:04', '2017-07-11 10:51:04', '', ''),
(6, 'aaaaaa', 'a@gmail.com', '912ec803b2ce49e4a541068d495ab570', NULL, NULL, NULL, NULL, '2017-07-11 11:36:37', '2017-07-11 11:36:37', '2017-07-11 11:36:37', '', ''),
(7, 'Sample, Name', 'jo21@gmail.com', '912ec803b2ce49e4a541068d495ab570', '7.png', '1', '1978-07-03', 'vfsdfsdf', '2017-07-12 10:18:04', '2017-07-12 10:18:04', '2017-07-12 04:20:12', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
