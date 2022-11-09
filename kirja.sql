-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2022 at 12:50 PM
-- Server version: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp_TRTKP21A3_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `kirja`
--

CREATE TABLE `kirja` (
  `id` int(11) NOT NULL,
  `kommentti` varchar(100) NOT NULL,
  `arvosana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kirja`
--

INSERT INTO `kirja` (`id`, `kommentti`, `arvosana`) VALUES
(50, 'Nice', 5),
(51, 'PHP is fun', 8),
(53, 'Great!', 9),
(54, 'Amazing!', 10),
(55, 'Cool', 8),
(56, 'it just works ', 10),
(57, 'okay', 7),
(58, 'good!', 9),
(59, 'nice work!', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kirja`
--
ALTER TABLE `kirja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kirja`
--
ALTER TABLE `kirja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
