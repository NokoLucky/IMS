-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2017 at 03:00 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned`
--

CREATE TABLE `assigned` (
  `a_id` int(10) NOT NULL,
  `callNum` int(10) NOT NULL,
  `t_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned`
--

INSERT INTO `assigned` (`a_id`, `callNum`, `t_id`, `user_id`) VALUES
(13, 2000517574, 1, 1),
(14, 2000516418, 1, 2),
(15, 2000516945, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `callog`
--

CREATE TABLE `callog` (
  `c_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `callNum` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `d_id` int(10) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `similar` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Open',
  `dd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `callog`
--

INSERT INTO `callog` (`c_id`, `user_id`, `callNum`, `name`, `d_id`, `priority`, `similar`, `description`, `status`, `dd`) VALUES
(1, 1, '2000517574', 'lucky', 2, '1: High', 'deployment', 'blahh blahh balhhh', 'In Progress', '0000-00-00'),
(2, 3, '2000516549', 'matlibo', 4, '2: Medium', 'network down', 'please come troubleshoot my network, because it is down', 'Open', '0000-00-00'),
(3, 1, '2000519541', 'mlakhana', 1, '3: Low', 'system''s developed', 'come develop a new system for me', 'In Progress', '0000-00-00'),
(4, 2, '2000514598', 'Smee', 1, '2: Medium', 'configuration', 'here we go again, your applications are giving me problems yet again, aii you guys mara why???', 'Open', '0000-00-00'),
(5, 3, '2000513342', 'Shakes', 3, '2: Medium', 'installation problem', 'install the two configuration files to be used in the later stages of the project lekgau', 'Open', '0000-00-00'),
(6, 2, '2000516418', 'shirnee', 2, '1: High', 'dont know', 'have a rblem that i dont know...', 'Resolved', '0000-00-00'),
(7, 2, '2000516945', 'shee', 4, '3: Low', 'fix errors', 'my speakers are not producing sound', 'In Progress', '0000-00-00'),
(8, 6, '2000516746', 'sweswe', 2, '3: Low', 'inserting new stock', 'i need new stock to be added to the current system', 'Open', '0000-00-00'),
(9, 6, '2000510796', 'breezy', 3, '1: High', 'installation', 'i need to install a new sap crm system on my laptop, as soon as today', 'Open', '2017-11-21'),
(10, 1, '2000514204', '', 3, '2: Medium', '', '', 'Open', '0000-00-00'),
(11, 1, '2000517075', 'Lucky', 3, '2: Medium', 'Configuration', 'blah blabh', 'Open', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(10) NOT NULL,
  `dname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `dname`) VALUES
(1, 'Config/Develop'),
(2, 'Deployment'),
(3, 'Install/Repair'),
(4, 'Troubleshoot');

-- --------------------------------------------------------

--
-- Table structure for table `resolved`
--

CREATE TABLE `resolved` (
  `id` int(10) NOT NULL,
  `callNum` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `closedDate` date NOT NULL,
  `similar` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resolved`
--

INSERT INTO `resolved` (`id`, `callNum`, `user_id`, `name`, `status`, `closedDate`, `similar`, `description`) VALUES
(1, 0, 4, '', '-Select status-', '0000-00-00', '', ''),
(2, 0, 4, 'dfffff', 'Resolved', '2017-11-17', 'ssss', 'sdfdfdfdf'),
(3, 0, 4, 'ddd', 'Resolved', '2017-11-17', 'dssd', 'wewe'),
(4, 2000519541, 4, 'smeeee', 'In Progress', '2017-11-18', 'nrrr', 'comeee onnnnnn dudeeee'),
(5, 2000516418, 2, 'Jack', 'Resolved', '2017-11-23', 'unknown cause', 'your unknown problem has been resolved by applying unknown solutions, cheers');

-- --------------------------------------------------------

--
-- Table structure for table `techs`
--

CREATE TABLE `techs` (
  `t_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `repassword` varchar(100) NOT NULL,
  `d_id` int(10) NOT NULL,
  `role` varchar(100) NOT NULL,
  `hiredate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `techs`
--

INSERT INTO `techs` (`t_id`, `name`, `username`, `email`, `password`, `repassword`, `d_id`, `role`, `hiredate`) VALUES
(1, 'jackT', 'jackT', 'jackt@gmail.com', 'Jackt12', 'Jackt12', 2, 'technician', '2017-11-22'),
(2, 'shiela', 'shiela', 'shiela@gmail.com', 'Shiela12', 'Shiela12', 4, 'technician', '2017-11-23'),
(3, 'Wildah', 'wildah', 'wildah@gmail.com', 'Wildah12', 'Wildah12', 4, 'technician', '2017-11-23'),
(4, 'Tebogo', 'tebogo', 'tebza@gmail.com', 'Tebogo12', 'Tebogo12', 2, 'technician', '2017-11-23'),
(5, 'lerato', 'lerato', 'Lerato@gmail.com', 'Lerato12', 'Lerato12', 1, 'technician', '2017-11-23'),
(6, 'Maesela', 'maesela', 'maesela@gmail.com', 'Maesela12', 'Maesela12', 3, 'technician', '2017-11-23'),
(7, 'Mahesu', 'mahesu', 'mahesu@gmial.com', 'Mahesu12', 'Mahesu12', 2, 'technician', '2017-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `repassword` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `repassword`, `role`) VALUES
(1, 'lucky', 'breezy', 'breezy@yahoo.co.za', 'Password12', 'Password12', 'user'),
(2, 'smee', 'smee', 'smee@gmail.com', 'Password123', 'Password123', 'user'),
(3, 'kevin', 'matlibo', 'shakesmatlibo@gmail.com', 'Shakes12', 'Shakes12', 'user'),
(4, 'joe ', 'johannes', 'johannes@jdg.co.za', 'Johannes12', 'Johannes12', 'user'),
(5, '', 'Admin', '', 'Admin@IMS', '', 'admin'),
(6, 'tshepo', 'sweswe', 'sweswe@gmail.com', 'Password12', 'Password12', 'user'),
(8, 'lervin', 'lervin', 'lervin@gmail.com', 'Lervin12', 'Lervin12', 'technician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned`
--
ALTER TABLE `assigned`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `callog`
--
ALTER TABLE `callog`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `resolved`
--
ALTER TABLE `resolved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `techs`
--
ALTER TABLE `techs`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned`
--
ALTER TABLE `assigned`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `callog`
--
ALTER TABLE `callog`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `resolved`
--
ALTER TABLE `resolved`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `techs`
--
ALTER TABLE `techs`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
