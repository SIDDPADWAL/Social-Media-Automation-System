-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 07:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prj_social_media_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `end_user`
--

CREATE TABLE `end_user` (
  `euid` int(9) NOT NULL,
  `euname` varchar(100) NOT NULL,
  `eumob` varchar(13) NOT NULL,
  `eupass` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `city` varchar(200) NOT NULL,
  `imgpath` varchar(200) NOT NULL,
  `regdate` date NOT NULL,
  `eustatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `end_user`
--

INSERT INTO `end_user` (`euid`, `euname`, `eumob`, `eupass`, `email`, `dob`, `gender`, `city`, `imgpath`, `regdate`, `eustatus`) VALUES
(2, 'Vaishnavi Takalkar', '8888789402', '123', 'zelosinfotech@gmail.com', '1990-02-19', 'Male', 'Manchar', './uploads/profile_photo/20230407053539.png', '2023-04-07', 1),
(4, 'Vaishnavi Takalkar', '9975508577', '123', 'zelosinfotech@gmail.com', '2023-04-01', 'Male', 'Manchar', './uploads/profile_photo/avatar_male.png', '2023-04-07', 1),
(5, 'Zelos Infotech', '8698208208', '123', 'zelosinfotech@gmail.com', '2000-04-07', 'Male', 'Manchar', './uploads/profile_photo/20230407093215.jpg', '2023-04-07', 1),
(6, 'Xyz', '9022763350', '123', 'rohansandipkadam01@gmail.com', '2004-04-07', 'Male', 'Pune', './uploads/profile_photo/avatar_male.png', '2023-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `lid` int(11) NOT NULL,
  `post_id` int(9) NOT NULL,
  `euid` int(9) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`lid`, `post_id`, `euid`, `status`) VALUES
(6, 9, 2, 1),
(9, 8, 2, 1),
(10, 10, 2, 1),
(13, 7, 2, 1),
(15, 13, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(9) NOT NULL,
  `post_desc` varchar(5000) NOT NULL,
  `post_type` varchar(200) NOT NULL,
  `post_privacy` varchar(100) NOT NULL,
  `post_date` date NOT NULL,
  `post_path` varchar(200) NOT NULL,
  `post_status` tinyint(1) NOT NULL,
  `euid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_desc`, `post_type`, `post_privacy`, `post_date`, `post_path`, `post_status`, `euid`) VALUES
(1, 'sfsdf', 'Photo', '1', '2023-04-07', '', 1, 2),
(2, 'sdfsdfsdf', 'Photo', '3', '2023-04-07', '', 1, 2),
(3, 'sdfasdasd', 'Photo', '3', '2023-04-07', './uploads/post/2_20230407080118.jpg', 1, 2),
(4, 'sdfsdfd', 'Link', '1', '2023-04-07', 'https://google.com', 1, 2),
(5, 'sdfsdfs', 'None', '1', '2023-04-07', '#', 0, 2),
(6, 'sdfsdf', 'Photo', '1', '2023-04-07', './uploads/post/2_20230407080824.webp', 1, 2),
(7, 'dfgdfgdfgfd', 'Video', '2', '2023-04-07', './uploads/post/2_20230407080843.mp4', 1, 2),
(8, 'dceceev\r\nervervrvevev', 'None', '2', '2023-04-07', '#', 1, 2),
(9, 'dceceev ervervrvevev', 'None', '1', '2023-04-07', '#', 1, 2),
(10, 'sample test', 'Photo', '3', '2023-04-07', './uploads/post/5_20230407093455.jpg', 1, 5),
(11, 'Xyz', 'Photo', '2', '2023-04-07', './uploads/post/6_20230407095100.jpg', 0, 6),
(12, 'Www', 'None', '2', '2023-04-07', '#', 0, 6),
(13, 'Ghshh', 'None', '2', '2023-04-07', '#', 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `end_user`
--
ALTER TABLE `end_user`
  ADD PRIMARY KEY (`euid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `euid` (`euid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `euid` (`euid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `end_user`
--
ALTER TABLE `end_user`
  MODIFY `euid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
