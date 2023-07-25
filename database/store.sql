-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 11:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0,
  `price` varchar(50) NOT NULL,
  `actual_weight` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`, `price`, `actual_weight`) VALUES
(1, '18k Saudi Gold', 1, 1, '3400', '-36656.020000000004'),
(2, '18k Japan Gold', 1, 1, '3500', '5'),
(3, '21k Saudi Gold', 1, 1, '3800', '0');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0,
  `brand_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`, `brand_id`) VALUES
(8, 'Necklace', 1, 1, 1),
(9, 'Earrings', 1, 1, 1),
(10, 'Pendant', 1, 1, 1),
(11, 'Bracelet', 1, 1, 1),
(12, 'Anklet', 1, 1, 1),
(13, 'Rings', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
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
  `order_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `cash` varchar(50) NOT NULL,
  `gcash` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `date_today` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`, `cash`, `gcash`, `bank`, `date_today`) VALUES
(37, '2023-05-08', 'Juan Delacruz', '23213213123', '10300.00', '0.00', '10300.00', '300', '10000.00', '10000.00', '0.00', 0, 1, 1, '0.00', 1, 1, '5000', '2000', '3000', '2023-05-08 19:07:57'),
(38, '2023-05-08', 'Maria', '0909090909', '65500.00', '0.00', '65500.00', '500', '65000.00', '65000.00', '0.00', 0, 1, 1, '0.00', 1, 1, '60000', '5000', '', '2023-05-08 19:07:57'),
(39, '2023-05-08', 'Juan Delacruz', '091925378945', '96200.00', '0.00', '96200.00', '200', '96000.00', '96000.00', '0.00', 0, 1, 1, '0.00', 1, 1, '', '', '96000', '2023-05-08 19:07:57'),
(40, '2023-05-08', 'Juan Delacruz', '09091234567', '34000.00', '0.00', '34000.00', '4000', '30000.00', '30000.00', '0.00', 0, 1, 1, '0.00', 1, 1, '', '30000', '', '2023-05-08 19:09:27'),
(41, '2023-05-08', 'test', '23123123', '4080.00', '0.00', '4080.00', '0', '4080.00', '4080.00', '0.00', 0, 1, 1, '0.00', 1, 1, '500', '3580', '', '2023-05-08 21:03:47'),
(42, '2023-05-08', 'test', '34234324', '64566.00', '0.00', '64566.00', '0', '64566.00', '64566.00', '0.00', 0, 1, 1, '0.00', 1, 1, '64566', '', '', '2023-05-08 21:13:57'),
(43, '2023-05-08', 'agsdf', '2354234', '3400.00', '0.00', '3400.00', '0', '3400.00', '3400.00', '0.00', 0, 1, 1, '0.00', 1, 1, '3400', '', '', '2023-05-08 21:14:44'),
(44, '2023-05-08', 'sadf', '41324', '34000.00', '0.00', '34000.00', '0', '34000.00', '34000.00', '0.00', 0, 2, 1, '0.00', 1, 1, '30000', '', '4000', '2023-05-08 21:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(45, 37, 11, '1', '3400', '3400.00', 1),
(46, 37, 13, '1', '3500', '3500.00', 1),
(47, 37, 12, '1', '3400', '3400.00', 1),
(48, 38, 12, '10', '3400', '34000.00', 1),
(49, 38, 13, '9', '3500', '31500.00', 1),
(50, 39, 11, '9', '3400', '30600.00', 1),
(51, 39, 13, '10', '3500', '35000.00', 1),
(52, 39, 12, '9', '3400', '30600.00', 1),
(53, 40, 11, '10', '3400', '34000.00', 1),
(54, 41, 12, '1.20', '3400', '4080.00', 1),
(55, 42, 11, '18.99', '3400', '64566.00', 1),
(56, 43, 11, '1', '3400', '3400.00', 1),
(57, 44, 11, '10', '3400', '34000.00', 1);

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
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`, `status`) VALUES
(11, 'Necklace 1', '', 1, 8, '940.01', '3400', 1, 1),
(12, 'Necklace 2', '', 1, 8, '6978.8', '3400', 1, 1),
(13, 'Ring1', '', 2, 13, '480', '3500', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', ''),
(11, 'maria', '5f4dcc3b5aa765d61d8327deb882cf99', 'maria.clara@gmail.com');

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
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
