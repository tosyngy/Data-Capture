-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2021 at 03:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yctcudatacapture`
--
CREATE DATABASE IF NOT EXISTS `yctcudatacapture` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `yctcudatacapture`;

-- --------------------------------------------------------

--
-- Table structure for table `aboutyou`
--

CREATE TABLE `aboutyou` (
  `id` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `othernames` varchar(100) NOT NULL,
  `department` varchar(255) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `quote` text NOT NULL,
  `dob` varchar(255) NOT NULL,
  `level` varchar(100) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `img` text NOT NULL,
  `pix` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aboutyou`
--

INSERT INTO `aboutyou` (`id`, `surname`, `othernames`, `department`, `unit`, `quote`, `dob`, `level`, `mobileno`, `img`, `pix`, `email`, `address`, `user_id`) VALUES
(1, 'Oginni', 'Tosin', 'Computer Science', 'Chosen Vessel', 'I love CU', '2000-02-29', 'ND I', '08028466355', '', '15214798694159272512.png', 'tosyngy@gmail.com', '53, Owodunni Street,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutyou`
--
ALTER TABLE `aboutyou`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutyou`
--
ALTER TABLE `aboutyou`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
