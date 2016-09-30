-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2016 at 06:37 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(11) NOT NULL,
  `free` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `username`, `password`, `role`, `free`) VALUES
(1, 'Rohit Kumar', 'rohitkumar@workplace.com', 'rohit123', 1, -1),
(2, 'Harsh Bajaj', 'harshbajaj@workplace.com', 'harsh123', 1, -1),
(3, 'Rohit Kumar Boga', 'rohitkumarboga@workplace.com', 'rohitb123', 1, -1),
(4, 'Ankit Saini', 'ankitsaini@workplace.com', 'ankit123', 1, -1),
(5, 'Himanshu Dongre', 'himanshudongre@workplace.com', 'himanshu123', 1, -1),
(6, 'Harshit Bansal', 'harshitbansal@workplace.com', 'harshit123', 0, 0),
(7, 'Pradhumn Goyal', 'pradhumngoyal@workplace.com', 'pradhumn123', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `des` varchar(300) NOT NULL,
  `updated` varchar(50) NOT NULL,
  `completed` varchar(50) NOT NULL DEFAULT 'Not completed.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `t_id`, `sub_id`, `head_id`, `topic`, `des`, `updated`, `completed`) VALUES
(12, 1, 6, 1, 'aasd', 'adadas', '', 'Not completed.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
