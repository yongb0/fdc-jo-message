-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2017 at 11:58 AM
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
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_id`, `from_id`, `content`, `created`, `modified`) VALUES
(1, 1, 5, 'sample message', '2017-06-29 00:00:00', '2017-06-29 00:01:00'),
(2, 1, 5, 'Two', '2017-06-29 00:02:00', '2017-06-29 00:02:00'),
(3, 2, 5, 'hey', '2017-06-29 00:00:00', '2017-06-29 00:02:00'),
(4, 2, 5, 'Yow...', '2017-06-29 00:04:00', '2017-06-29 00:04:00'),
(5, 5, 1, 'blha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 1, 'asdfsdaf', '2017-06-29 02:00:00', '2017-06-29 02:03:00'),
(7, 5, 1, 'lates', '2017-06-29 03:00:00', '2017-06-29 03:03:00'),
(8, 1, 3, 'waala', '2017-06-30 00:00:00', '2017-06-30 04:00:00'),
(9, 0, 0, '', '2017-06-29 11:08:19', '2017-06-29 11:08:19'),
(10, 1, 5, 'mao b kaha ni', '2017-06-29 11:11:32', '2017-06-29 11:11:32'),
(11, 2, 5, 'asdfds', '2017-06-29 11:47:18', '2017-06-29 11:47:18'),
(12, 5, 2, 'ako ni', '2017-06-29 11:52:42', '2017-06-29 11:52:42'),
(13, 5, 2, 'mao japon', '2017-06-29 17:56:32', '2017-06-29 17:56:32');

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
(1, 'test1', 'test1@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', NULL, NULL, NULL, NULL, '2017-06-28 09:26:58', '2017-06-27 11:14:54', '2017-06-28 09:26:58', '::1', ''),
(2, 'test2', 'test2@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', NULL, NULL, NULL, NULL, '2017-06-29 17:50:27', '2017-06-28 03:51:41', '2017-06-29 17:50:27', '::1', ''),
(5, 'Jo, Antipala', 'jo@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', NULL, '1', '1994-05-29', 'asdfs sdfs sdf sf sfsdfsd fsd sd dsfsdfsdfsdf\r\nsdf  sd\r\nsdf sdf\r\nsd fsd\r\n fsdf sfsd ', '2017-06-29 14:53:31', '2017-06-28 05:19:48', '2017-06-29 14:53:31', '::1', ''),
(8, 'Sample, Name', 'test3@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', NULL, NULL, NULL, NULL, '2017-06-28 07:27:36', '2017-06-28 13:27:26', '2017-06-28 07:27:36', '::1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
