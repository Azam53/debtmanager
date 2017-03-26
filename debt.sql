-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2017 at 12:45 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `debt`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `balance` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cus_name`, `email`, `address`, `balance`, `created_date`) VALUES
(7, 'Azam Mohd Ansari', 'aliazam005@gmail.com', 'chawl 54 / Room no 843\r\nBharat Nagar Bandra East', 47000, '2017-03-24 19:10:33'),
(11, 'Ali Alan', 'ali.alan@gmail.com', 'Riga , Latvia', 2758, '2017-03-25 07:08:44'),
(12, 'John Kallis', 'john@gmail.com', 'California , USA', 55840, '2017-03-25 12:15:45'),
(13, 'Anna Panin', 'anna.panin@gmail.com', 'Kiev , Ukraine', 300000, '2017-03-25 15:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE IF NOT EXISTS `debt` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `loan_amount` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `years` int(11) NOT NULL,
  `emi` int(11) NOT NULL,
  `due_date` varchar(20) NOT NULL,
  `given_date` varchar(20) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `debt`
--

INSERT INTO `debt` (`transaction_id`, `customer_id`, `loan_amount`, `interest`, `years`, `emi`, `due_date`, `given_date`) VALUES
(2, 7, 50000, 10, 2, 3000, '2017-04-25', '2017-03-25'),
(4, 11, 4000, 4, 12, 414, '2017-04-25', '2017-03-25'),
(5, 12, 60000, 8, 36, 4860, '2017-03-24', '2017-02-24'),
(6, 13, 300000, 11, 120, 34350, '2017-04-25', '2017-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_transaction_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `payment_month` varchar(50) NOT NULL,
  `capital_paid` int(11) NOT NULL,
  `interest_paid` int(11) NOT NULL,
  `penalty` enum('Yes','No') NOT NULL,
  `payment_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `loan_transaction_no`, `customer_id`, `payment_amount`, `balance`, `payment_month`, `capital_paid`, `interest_paid`, `penalty`, `payment_date`) VALUES
(2, 4, 11, 414, 3586, 'March 2017', 397, 17, 'No', '2017-03-25'),
(3, 2, 7, 3000, 47000, 'March 2017', 2700, 300, 'No', '2017-03-25'),
(4, 5, 12, 4860, 55840, 'March 2017', 4471, 389, 'Yes', '2017-03-25'),
(15, 4, 11, 414, 3172, 'April 2017', 777, 34, 'No', '2017-03-25'),
(16, 4, 11, 414, 2758, 'Jan 2017', 1140, 51, 'No', '2017-03-25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
