-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2019 at 12:14 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gingerhire`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`) VALUES
(1, 'Banking/Mortgage'),
(2, 'Accounting'),
(3, 'Architecture/Planning'),
(4, 'Arts/Crafts'),
(5, 'Automotive'),
(6, 'Airlines/Aviation'),
(7, 'Chemicals'),
(8, 'Computer Hardware'),
(9, 'Computer Networking'),
(10, 'Information Technology'),
(11, 'Construction'),
(12, 'Management Consulting'),
(13, 'Consumer Electronics'),
(14, 'Consumer Goods'),
(15, 'Defense/Space'),
(16, 'Education/Training'),
(17, 'Motion Pictures/Film'),
(18, 'Farming'),
(19, 'Apparel/Fashion'),
(20, 'Financial Services'),
(21, 'Fishery'),
(22, 'Food/Restaurant'),
(23, 'Furniture'),
(24, 'Renewables/Environment'),
(25, 'Health/Fitness'),
(26, 'Hospital/HealthCare'),
(27, 'Import/Export'),
(28, 'Insurance'),
(29, 'Judiciary'),
(30, 'Maritime'),
(31, 'Broadcast Media'),
(32, 'Mining/Metals'),
(33, 'Civic/Social Organization'),
(34, 'Pharmaceuticals'),
(35, 'Commercial Real Estate'),
(36, 'Staffing/Recruiting'),
(37, 'Semiconductors'),
(38, 'Ship building'),
(39, 'Space'),
(40, 'Sports'),
(41, 'Sporting Goods'),
(42, 'Telecommunications'),
(43, 'Tobacco'),
(44, 'Transportation'),
(45, 'Wholesale'),
(46, 'Wine/Spirits');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
