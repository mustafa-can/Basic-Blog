-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2016 at 12:45 ÖÖ
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `username`, `mail`, `password`) VALUES
(1, 'user1', 'user1@abc.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'user2', 'asd@asd.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'user3', 'aasdasd', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'asd', 'asd', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `writer_name` varchar(255) NOT NULL,
  `writer_mail` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `writer_name`, `writer_mail`, `text`, `comment_time`) VALUES
(1, 15, 'Mustafa', 'abc@abc.com', 'Benim yorumum bu...', '2016-12-28 12:44:23'),
(8, 15, 'Mustafa', 'abc@abc.com', 'Benim yorumum bu...', '2016-12-28 12:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `blog_id`, `sort_order`, `tag`, `text`, `post_time`) VALUES
(15, 1, 1, 'Makale 1', '<p>123123</p>', '2016-12-27 17:46:32'),
(33, 1, 1, 'Makale 3', '<p>asd</p>', '2016-12-27 22:25:46'),
(36, 1, 3, 'asd', '<p>asd</p>', '2016-12-29 23:04:10'),
(37, 1, 3, 'qwe', '<p>qwe</p>', '2016-12-29 23:04:23'),
(38, 1, 2, 'qw', '<p>qw</p>', '2016-12-29 23:04:35'),
(39, 1, 1, 'wer', '<p>wer</p>', '2016-12-29 23:04:48'),
(40, 1, 1, 'zxc', '<p>zxc</p>', '2016-12-29 23:22:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_index` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_index` (`blog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
