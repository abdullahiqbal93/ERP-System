-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2024 at 06:05 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `district` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `title`, `first_name`, `middle_name`, `last_name`, `contact_no`, `district`) VALUES
(1, 'Mr', 'saman', 'shantha', 'kumara', '0724468955', '5'),
(2, 'Mr', 'Ruwan', 'nishantha', 'bandara', '0786598526', '7'),
(3, 'Mrs', 'Nishani', 'dhammika', 'bandara', '0753256589', '6'),
(4, 'Miss', 'Samanthi', 'kumari', 'kulathunga', '0762354576', '22');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district` varchar(50) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district`, `active`) VALUES
(1, 'Ampara', 'yes'),
(2, 'Anuradhapura', 'yes'),
(3, 'Badulla', 'yes'),
(4, 'Batticaloa', 'yes'),
(5, 'Colombo', 'yes'),
(6, 'Galle', 'yes'),
(7, 'Gampaha', 'yes'),
(8, 'Hambantota', 'yes'),
(9, 'Jaffna', 'yes'),
(10, 'Kalutara', 'yes'),
(11, 'Kalutara', 'yes'),
(12, 'Kandy', 'yes'),
(13, 'Kegalle', 'yes'),
(14, 'Kilinochchi', 'yes'),
(15, 'Kurunegala', 'yes'),
(16, 'Mannar', 'yes'),
(17, 'Matale', 'yes'),
(18, 'Matara', 'yes'),
(19, 'Moneragala', 'yes'),
(20, 'Mullaitivu', 'yes'),
(21, 'Nuwara Eliya', 'yes'),
(22, 'Polonnaruwa', 'yes'),
(23, 'Puttalam', 'yes'),
(24, 'Rathnapura', 'yes'),
(25, 'Vavuniya', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `customer` varchar(10) NOT NULL,
  `item_count` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `date`, `time`, `invoice_no`, `customer`, `item_count`, `amount`) VALUES
(1, '2021-04-01', '07:00:14', '1001', '1', '2', '7500'),
(2, '2021-04-01', '14:23:12', '1002', '2', '1', '75000'),
(3, '2021-04-02', '10:12:55', '1003', '3', '1', '117000'),
(4, '2021-04-04', '15:44:22', '1004', '1', '2', '21000'),
(5, '2021-04-06', '13:15:52', '1005', '3', '4', '15000'),
(6, '2021-04-07', '14:22:36', '1006', '4', '10', '117500'),
(7, '2021-04-07', '16:11:48', '1006', '2', '32', '24016'),
(8, '2021-04-09', '12:11:55', '1007', '2', '2', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

DROP TABLE IF EXISTS `invoice_master`;
CREATE TABLE IF NOT EXISTS `invoice_master` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(50) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`id`, `invoice_no`, `item_id`, `quantity`, `unit_price`, `amount`) VALUES
(1, '1001', '1', '1', '5000', '5000'),
(2, '1001', '4', '1', '2500', '2500'),
(3, '1002', '2', '1', '75000', '75000'),
(4, '1003', '5', '2', '58500', '117000'),
(5, '1004', '3', '1', '18500', '18500'),
(6, '1004', '4', '1', '2500', '2500'),
(7, '1004', '1', '2', '5000', '10000'),
(8, '1004', '4', '2', '2500', '5000'),
(9, '1005', '3', '5', '18500', '92500'),
(10, '1005', '1', '5', '5000', '25000'),
(11, '1006', '6', '32', '750.50', '24016'),
(12, '1007', '2', '2', '75000', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(20) NOT NULL,
  `item_category` varchar(20) NOT NULL,
  `item_subcategory` varchar(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `unit_price` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_code`, `item_category`, `item_subcategory`, `item_name`, `quantity`, `unit_price`) VALUES
(1, 'JK007', '1', '1', 'HP Laser printer', '10', '5000'),
(2, 'CS6656', '2', '3', 'Lenovo Ideapad 300', '5', '75000'),
(3, 'KL9956', '3', '5', 'Samsung touch displa', '6', '18500'),
(4, 'HH7565', '4', '1', 'Colour ink', '5', '2500'),
(5, 'SM3534', '2', '2', 'Dell latitude', '5', '58500'),
(6, 'KM6526', '3', '5', 'Samsung headset', '50', '750.50');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category`) VALUES
(1, 'Printers'),
(2, 'Laptops'),
(3, 'Gadgets'),
(4, 'Ink bottels'),
(5, 'Cartridges');

-- --------------------------------------------------------

--
-- Table structure for table `item_subcategory`
--

DROP TABLE IF EXISTS `item_subcategory`;
CREATE TABLE IF NOT EXISTS `item_subcategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sub_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_subcategory`
--

INSERT INTO `item_subcategory` (`id`, `sub_category`) VALUES
(1, 'HP'),
(2, 'Dell'),
(3, 'Lenovo'),
(4, 'Acer'),
(5, 'Samsung');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
