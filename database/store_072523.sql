-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 07:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT '0',
  `brand_status` int(11) NOT NULL DEFAULT '0',
  `price` varchar(50) NOT NULL,
  `actual_weight` varchar(50) NOT NULL,
  `brand_type` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`, `price`, `actual_weight`, `brand_type`) VALUES
(4, '18k', 1, 1, '3900', '470.78', 1),
(5, '21k', 1, 1, '4200', '460.4', 1),
(6, 'Per Piece', 1, 1, '0', '238', 2),
(7, 'Test', 1, 1, '3000', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT '0',
  `categories_status` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`, `brand_id`) VALUES
(20, 'Default', 0, 0, 0),
(21, 'Necklace', 1, 1, 4),
(22, 'Pendant', 1, 1, 4),
(23, 'Ring', 1, 1, 4),
(24, 'Necklace', 1, 1, 5),
(25, 'Pendant', 1, 1, 5),
(26, 'Dia Deroskas .5ct', 1, 1, 6),
(27, 'Dia pendant 2.0ct', 1, 1, 6),
(28, 'Earrings', 1, 1, 4),
(29, 'Bracelet', 1, 1, 4),
(30, 'HQ VCA earrings', 1, 1, 6),
(31, 'Big vca pendant', 1, 1, 6),
(32, 'Bracelet', 1, 1, 5),
(33, 'Ring', 1, 1, 5),
(34, 'Earrings', 1, 1, 5),
(35, 'Dia Engagement Ring', 1, 1, 6),
(36, 'Dia Long Earrings', 1, 1, 6),
(37, '18k earrings/pc cartier', 1, 1, 6),
(38, 'LV Dia Pendant', 1, 1, 6),
(39, 'Onyx Pendant', 1, 1, 6),
(40, 'Wedding Ring', 1, 1, 6),
(41, 'B1T1', 1, 1, 6),
(42, '18K piyao', 1, 1, 6),
(43, '24K Piyao', 1, 1, 6),
(44, 'Bri Ring Rectangle', 1, 1, 6),
(45, 'Bri Ring Square', 1, 1, 6),
(46, 'Bri Ring Horse Shoe', 1, 1, 6),
(47, 'Ball earrings/pc', 1, 1, 6),
(48, 'test1', 1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `contact_number`, `status`, `created_date`) VALUES
(1, 'Carlo De Leon', 'Herrera Subdivision Lian Batangas', '09067034478', '1', '2023-05-23 02:39:15'),
(2, 'Mark Anthony Delas Alas', 'Baldeyo Bungahan Lian Batangas', '09159208872', '1', '2023-06-02 10:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `eod_revenue`
--

CREATE TABLE `eod_revenue` (
  `id` int(11) NOT NULL,
  `cash` varchar(100) NOT NULL,
  `ewallet` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `credit_card` varchar(100) NOT NULL,
  `user_id` int(50) NOT NULL,
  `cur_date` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eod_revenue`
--

INSERT INTO `eod_revenue` (`id`, `cash`, `ewallet`, `bank`, `credit_card`, `user_id`, `cur_date`, `created_date`) VALUES
(1, '77238', '0', '0', '0', 1, '06/02/2023', '2023-06-02 11:12:21'),
(2, '255000', '500', '92', '0', 13, '06/11/2023', '2023-06-11 01:24:29'),
(3, '10000', '5000', '1000', '10000', 13, '06/28/2023', '2023-06-28 03:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `ex_id` int(11) NOT NULL,
  `details` varchar(200) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `paid_by` varchar(100) NOT NULL,
  `received_by` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `reference_no` varchar(100) NOT NULL,
  `payment_type` int(50) NOT NULL,
  `status` int(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`ex_id`, `details`, `amount`, `paid_by`, `received_by`, `date`, `reference_no`, `payment_type`, `status`, `created_date`) VALUES
(1, 'test', '100', 'Lanie', 'Test', '06/28/2023', '', 1, 1, '2023-06-28 03:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `categories_id` int(50) NOT NULL,
  `brand_id` int(50) NOT NULL,
  `categories_name` varchar(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `categories_id`, `brand_id`, `categories_name`, `qty`, `date`, `created_date`) VALUES
(1, 21, 4, 'Necklace', 491, '06/11/2023', '2023-06-11 01:27:28'),
(2, 22, 4, 'Pendant', 0, '06/11/2023', '2023-06-11 01:27:28'),
(3, 23, 4, 'Ring', 0, '06/11/2023', '2023-06-11 01:27:28'),
(4, 28, 4, 'Earrings', 0, '06/11/2023', '2023-06-11 01:27:28'),
(5, 29, 4, 'Bracelet', 0, '06/11/2023', '2023-06-11 01:27:28'),
(6, 24, 5, 'Necklace', 160, '06/11/2023', '2023-06-11 01:27:28'),
(7, 25, 5, 'Pendant', 0, '06/11/2023', '2023-06-11 01:27:28'),
(8, 26, 6, 'Dia Deroskas', 80, '06/11/2023', '2023-06-11 01:27:28'),
(9, 27, 6, 'Dia pendant', 0, '06/11/2023', '2023-06-11 01:27:28'),
(10, 30, 6, 'HQ VCA earrings', 0, '06/11/2023', '2023-06-11 01:27:28'),
(11, 31, 6, 'Big vca pendant', 0, '06/11/2023', '2023-06-11 01:27:28'),
(12, 21, 4, 'Necklace', 10, '06/28/2023', '2023-06-28 03:39:44'),
(13, 22, 4, 'Pendant', 15, '06/28/2023', '2023-06-28 03:39:44'),
(14, 23, 4, 'Ring', 10, '06/28/2023', '2023-06-28 03:39:44'),
(15, 28, 4, 'Earrings', 10, '06/28/2023', '2023-06-28 03:39:44'),
(16, 29, 4, 'Bracelet', 10, '06/28/2023', '2023-06-28 03:39:44'),
(17, 24, 5, 'Necklace', 15, '06/28/2023', '2023-06-28 03:39:44'),
(18, 25, 5, 'Pendant', 10, '06/28/2023', '2023-06-28 03:39:44'),
(19, 32, 5, 'Bracelet', 10, '06/28/2023', '2023-06-28 03:39:44'),
(20, 33, 5, 'Ring', 10, '06/28/2023', '2023-06-28 03:39:44'),
(21, 34, 5, 'Earrings', 10, '06/28/2023', '2023-06-28 03:39:44'),
(22, 26, 6, 'Dia Deroskas .5ct', 10, '06/28/2023', '2023-06-28 03:39:44'),
(23, 27, 6, 'Dia pendant 2.0ct', 10, '06/28/2023', '2023-06-28 03:39:44'),
(24, 30, 6, 'HQ VCA earrings', 10, '06/28/2023', '2023-06-28 03:39:44'),
(25, 31, 6, 'Big vca pendant', 10, '06/28/2023', '2023-06-28 03:39:44'),
(26, 35, 6, 'Dia Engagement Ring', 10, '06/28/2023', '2023-06-28 03:39:44'),
(27, 36, 6, 'Dia Long Earrings', 10, '06/28/2023', '2023-06-28 03:39:44'),
(28, 37, 6, '18k earrings/pc cartier', 10, '06/28/2023', '2023-06-28 03:39:44'),
(29, 38, 6, 'LV Dia Pendant', 10, '06/28/2023', '2023-06-28 03:39:44'),
(30, 39, 6, 'Onyx Pendant', 10, '06/28/2023', '2023-06-28 03:39:44'),
(31, 40, 6, 'Wedding Ring', 10, '06/28/2023', '2023-06-28 03:39:44'),
(32, 41, 6, 'B1T1', 10, '06/28/2023', '2023-06-28 03:39:44'),
(33, 42, 6, '18K piyao', 10, '06/28/2023', '2023-06-28 03:39:44'),
(34, 43, 6, '24K Piyao', 10, '06/28/2023', '2023-06-28 03:39:44'),
(35, 44, 6, 'Bri Ring Rectangle', 10, '06/28/2023', '2023-06-28 03:39:44'),
(36, 45, 6, 'Bri Ring Square', 10, '06/28/2023', '2023-06-28 03:39:44'),
(37, 46, 6, 'Bri Ring Horse Shoe', 10, '06/28/2023', '2023-06-28 03:39:44'),
(38, 47, 6, 'Ball earrings/pc', 10, '06/28/2023', '2023-06-28 03:39:44'),
(39, 48, 7, 'test1', 10, '06/28/2023', '2023-06-28 03:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `layaway`
--

CREATE TABLE `layaway` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `paid_date` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_today` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `layaway_orders`
--

CREATE TABLE `layaway_orders` (
  `order_id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_place` int(11) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `cash` varchar(50) NOT NULL,
  `gcash` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `date_today` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `credit_card` varchar(100) NOT NULL,
  `order_type` int(10) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `release_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layaway_orders`
--

INSERT INTO `layaway_orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`, `cash`, `gcash`, `bank`, `date_today`, `credit_card`, `order_type`, `due_date`, `release_date`) VALUES
(1, '06/11/2023', '1', '09067034478', '25500.00', '0.00', '25500.00', '0', '25500.00', '25500', '0', 1, 4, 1, '0.00', 1, 1, '', '20000', '', '2023-06-28 03:28:12', '', 1, '08/11/2023', '06/28/2023'),
(2, '06/11/2023', '2', '09159208872', '24000.00', '0.00', '24000.00', '0', '24000.00', '24000.00', '0.00', 1, 4, 1, '0.00', 0, 1, '', '', '24000', '2023-06-11 00:59:26', '', 2, '06/15/2023', '06/11/2023'),
(3, '06/11/2023', '2', '09159208872', '240000.00', '0.00', '240000.00', '0', '240000.00', '200000.00', '40000.00', 1, 4, 1, '0.00', 0, 1, '', '', '200000', '2023-06-11 01:07:55', '', 2, '06/12/2023', '06/11/2023'),
(4, '06/28/2023', '2', '09159208872', '4800.00', '0.00', '4800.00', '0', '4800.00', '4800', '0', 1, 4, 1, '0.00', 1, 1, '', '800', '', '2023-06-28 03:35:46', '', 2, '06/29/2023', '06/28/2023'),
(5, '06/28/2023', '1', '09067034478', '3900.00', '0.00', '3900.00', '0', '3900.00', '900.00', '3000.00', 1, 2, 1, '0.00', 1, 1, '900', '', '', '2023-06-28 03:37:53', '', 1, '09/28/2023', '');

-- --------------------------------------------------------

--
-- Table structure for table `layaway_order_item`
--

CREATE TABLE `layaway_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layaway_order_item`
--

INSERT INTO `layaway_order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 1, 47, '1', '0', '5500.00', 1),
(2, 1, 37, '5', '3600', '20000.00', 1),
(3, 2, 40, '6', '4000', '24000.00', 1),
(4, 3, 41, '60', '4000', '240000.00', 1),
(5, 4, 42, '1', '4800', '4800.00', 1),
(6, 5, 37, '1', '3900', '3900.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_place` int(11) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `cash` varchar(50) NOT NULL,
  `gcash` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `date_today` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `credit_card` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`, `cash`, `gcash`, `bank`, `date_today`, `credit_card`) VALUES
(1, '06/11/2023', 'April', '09157003478', '11592.00', '0.00', '11592.00', '0', '11592.00', '2000.00', '9592.00', 0, 1, 0, '0.00', 1, 1, '', '2000', '', '2023-06-11 00:36:23', ''),
(2, '06/28/2023', 'April', '09157003478', '40950.00', '0.00', '40950.00', '3150', '37800.00', '56000.00', '18200.00', 0, 1, 0, '0.00', 1, 1, '34000', '20000', '2000', '2023-06-28 02:10:32', ''),
(3, '06/28/2023', 'April', '09157003478', '40950.00', '0.00', '40950.00', '3150', '37800.00', '38000.00', '200.00', 0, 1, 1, '0.00', 1, 1, '34000', '2000', '2000', '2023-06-28 02:12:16', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 1, 37, '3.22', '3600', '11592.00', 1),
(2, 2, 37, '10.5', '3900', '40950.00', 1),
(3, 3, 37, '10.5', '3900', '40950.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `pay_amount` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paid_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `order_id`, `pay_amount`, `type`, `status`, `paid`, `due`, `created_date`, `paid_date`) VALUES
(1, 1, '44343.00', '1', 2, 14000, 30343, '2023-06-02 10:31:03', '06/02/2023'),
(2, 2, '44000.00', '1', 3, 10000, 34000, '2023-06-02 10:39:49', '06/02/2023'),
(3, 1, '25500.00', '1', 2, 20000, 5500, '2023-06-11 00:45:31', '06/11/2023'),
(4, 2, '24000.00', '1', 1, 24000, 0, '2023-06-11 00:52:00', '06/11/2023'),
(5, 3, '240000.00', '1', 2, 200000, 40000, '2023-06-11 00:57:15', '06/11/2023'),
(6, 1, '5500.00', '1', 1, 5500, 0, '2023-06-28 03:26:30', '06/28/2023'),
(7, 4, '4800.00', '1', 2, 800, 4000, '2023-06-28 03:33:16', '06/28/2023'),
(8, 4, '4000.00', '1', 1, 4000, 0, '2023-06-28 03:33:56', '06/28/2023'),
(9, 5, '3900.00', '1', 2, 900, 3000, '2023-06-28 03:37:53', '06/28/2023');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`, `status`) VALUES
(36, 'Default', '', 0, 0, '', '', 0, 0),
(37, 'Necklace', '', 4, 21, '75.78', '3900', 1, 1),
(38, 'Pendant', '', 4, 22, '50', '3900', 1, 1),
(39, 'Ring', '', 4, 23, '45', '3900', 1, 1),
(40, 'Necklace', '', 5, 24, '100', '4200', 1, 1),
(41, 'Pendant', '', 5, 25, '60.4', '4200', 1, 1),
(42, 'Diamonds', '', 6, 26, '50', '4800', 1, 1),
(43, 'VCA', '', 6, 27, '10', '5900', 1, 1),
(44, 'Earrings', '', 4, 28, '100', '3900', 1, 1),
(45, 'Bracelet', '', 4, 29, '200', '3900', 1, 1),
(46, 'HQ VCA earrings', '', 6, 30, '10', '3900', 1, 1),
(47, 'Big vca pendant', '', 6, 31, '10', '3800', 1, 1),
(48, 'Bracelet', '', 5, 32, '100', '4200', 1, 1),
(49, 'Ring', '', 5, 33, '100', '4200', 1, 1),
(50, 'Earrings', '', 5, 34, '100', '4200', 1, 1),
(51, 'Dia Engagement Ring', '', 6, 35, '31', '6900', 1, 1),
(52, 'Dia Long Earrings', '', 6, 36, '1', '4500', 1, 1),
(53, '18k earrings/pc cartier', '', 6, 37, '2', '4300', 1, 1),
(54, 'LV Dia Pendant', '', 6, 38, '1', '11500', 1, 1),
(55, 'Onyx Pendant', '', 6, 39, '1', '3000', 1, 1),
(56, 'Wedding Ring', '', 6, 40, '19', '6500', 1, 1),
(57, 'B1T1', '', 6, 41, '3', '7700', 1, 1),
(58, '18K piyao', '', 6, 42, '50', '1000', 1, 1),
(59, '24K Piyao', '', 6, 43, '47', '1250', 1, 1),
(60, 'Bri Ring Rectangle', '', 6, 44, '1', '48393', 1, 1),
(61, 'Bri Ring Square', '', 6, 45, '1', '39526', 1, 1),
(62, 'Bri Ring Horse Shoe', '', 6, 46, '1', '49647', 1, 1),
(63, 'Ball earrings/pc', '', 6, 47, '0', '1308', 1, 1),
(64, 'test1', '', 7, 48, '0', '3000', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', ''),
(13, 'Lanie', '1253208465b1efa876f982d8a9e73eef', 'lanie@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eod_revenue`
--
ALTER TABLE `eod_revenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layaway`
--
ALTER TABLE `layaway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layaway_orders`
--
ALTER TABLE `layaway_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `layaway_order_item`
--
ALTER TABLE `layaway_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eod_revenue`
--
ALTER TABLE `eod_revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `layaway`
--
ALTER TABLE `layaway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layaway_orders`
--
ALTER TABLE `layaway_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `layaway_order_item`
--
ALTER TABLE `layaway_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
