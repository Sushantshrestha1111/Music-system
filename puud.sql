-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2022 at 03:20 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puud`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(10) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `artist_view` int(255) NOT NULL,
  `artist_cover` varchar(255) NOT NULL,
  `artist_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_song` int(255) NOT NULL,
  `total_album` int(255) NOT NULL,
  `a_day` int(2) NOT NULL,
  `a_month` int(2) NOT NULL,
  `a_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_view`, `artist_cover`, `artist_reg_date`, `total_song`, `total_album`, `a_day`, `a_month`, `a_year`) VALUES
(52, 'Weekend', 0, 'profile61e3e17a88c4bcb4b538f283bdbefdbb.jpg', '2022-08-12 06:38:53', 0, 0, 0, 0, 0),
(53, 'BrunoMars', 0, 'profileb3aba5042da5aa4f74718d206bcd4f6c.jpg', '2022-08-13 07:18:25', 0, 0, 0, 0, 0),
(54, 'Maroon 5', 0, 'profile27075469a23654ef3aba9833c663a5b4.jpg', '2022-09-02 23:48:11', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `g_id` int(10) NOT NULL,
  `g_name` varchar(255) NOT NULL,
  `g_day` int(2) DEFAULT NULL,
  `g_month` int(2) DEFAULT NULL,
  `g_year` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`g_id`, `g_name`, `g_day`, `g_month`, `g_year`) VALUES
(2, 'classic', 4, 5, 2021),
(3, 'jazz', 10, 7, 2021),
(4, 'vintage', 25, 7, 2021),
(5, 'lofi', 30, 7, 2021),
(6, 'hip-hop', 21, 8, 2021),
(8, 'chill', 9, 11, 2021),
(42, 'pop', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `s_id` int(10) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `s_cover` varchar(255) NOT NULL,
  `s_audioFile` varchar(255) NOT NULL,
  `s_size` varchar(255) NOT NULL,
  `s_day` int(2) NOT NULL,
  `s_month` int(2) NOT NULL,
  `s_year` int(4) NOT NULL,
  `artist_id` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  `count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`s_id`, `s_name`, `s_reg_date`, `s_cover`, `s_audioFile`, `s_size`, `s_day`, `s_month`, `s_year`, `artist_id`, `g_id`, `count`) VALUES
(76, 'starboy', '2022-09-02 05:43:33', 'profileff8be8c454192b5812f26ecbae163e20.jpg', 'profile9f17054cf9473db2bbc607a54f0a1368.mp3', '', 0, 0, 0, 52, 6, 10),
(78, 'save your tears', '2022-09-02 05:43:24', 'profile4de1d584401287d6418df20c28bc71d3.jpg', 'profile8cdf671bf426ffdd3fae69dbbebeaddd.mp3', '', 0, 0, 0, 52, 6, 1),
(79, 'Uptown Funk', '2022-09-02 05:43:23', 'profilea1d90843b4589a59a58845592b3eb34b.jpg', 'profile9cb122c9be1ac1b46dbad4d02fa6f450.mp3', '', 0, 0, 0, 53, 6, 6),
(80, 'binding lights', '2022-09-02 05:44:41', 'profile418c9073927fe91f7dd5d8a610ba96f8.jpg', 'profile16c1d57025ed11f4d2f5fecad10e76b0.mp3', '', 0, 0, 0, 52, 42, 3),
(81, '24k magic', '2022-09-02 23:38:16', 'profilef8b4f063ca5dc064f87d34f421a5d515.jpg', 'profilebf40abf6178710209bafcbe7dcd164a7.mp3', '', 0, 0, 0, 53, 42, 0),
(82, 'lazy song', '2022-09-02 23:54:56', 'profile6acb9e47618ddb7ffd5c15765a5a8179.jpg', 'profile0f59cf045fb61d7eae7d65819e3e520b.mp3', '', 0, 0, 0, 53, 42, 0),
(83, 'sugar', '2022-09-02 23:50:54', 'profile7055bd8a24f258f9897b9ff962c8c569.jpeg', 'profile7c864967f22c575bdc08619dc6b8b93d.mp3', '', 0, 0, 0, 54, 42, 0),
(84, 'memories', '2022-09-03 03:54:09', 'profile33f22fffa9f3bf7f999f2cc4305e35fe.jpg', 'profile7afe4d57e856b322628f7024858130e8.mp3', '', 0, 0, 0, 54, 42, 2),
(85, 'payphone', '2022-09-02 23:57:15', 'profile32c3194c44e3970a7e18f29c55060b0a.jpg', 'profile83a61bbd34b5c69f9bcf9bf9e13c1506.mp3', '', 0, 0, 0, 54, 42, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` varchar(10) NOT NULL,
  `u_month` int(2) NOT NULL,
  `u_day` int(2) NOT NULL,
  `u_year` int(4) NOT NULL,
  `user_cover` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`, `reg_date`, `type`, `u_month`, `u_day`, `u_year`, `user_cover`) VALUES
(41, 'dipu', 'dipu@dipu.com', '87385ad0b9953e81dfcf0c5270ccbd50c4cad9f4c571f39ecf96a333aa529d39', '2022-08-12 06:30:19', '', 8, 12, 2022, 'profile958fc073b5147184fce9fca56ed8f70d.jpg'),
(42, 'admin', 'admin@admin.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '2022-08-13 07:21:29', 'admin', 8, 12, 2022, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `g_id` (`g_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `g_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `song_ibfk_2` FOREIGN KEY (`g_id`) REFERENCES `genre` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
