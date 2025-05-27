-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 03:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wentworthcanteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ct_id` int(11) NOT NULL,
  `ct_amount` int(11) NOT NULL,
  `ct_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ct_id`, `ct_amount`, `ct_note`, `s_id`, `f_id`, `c_id`) VALUES
(1, 1, '', 0, 0, 0),
(18, 1, '', 0, 0, 0),
(29, 3, '', 0, 0, 0),
(84, 1, '', 3, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_pwd` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M for Male, F for Female',
  `c_type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type of customer in this canteen (STD for student,STF for staff, GUE for guest, ADM for admin, OTH for other)',
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_username`, `c_pwd`, `c_firstname`, `c_lastname`, `c_email`, `c_gender`, `c_type`, `c_id`) VALUES
('gautam', '10262730', 'Gautam', 'Shrestha', 'gautam@gmail.com', 'M', 'STD', 1),
('suman', '12344321', 'Suman', 'Rai', 'suman@gmail.com', 'M', 'STD', 2),
('priya', '12344321', 'Priya', 'Khatri', 'priya@gmail.com', 'F', 'STD', 3),
('sampadmin', 'sampa@admin', 'Sampada', 'Deoju', 'sampada@gmail.com', 'F', 'ADM', 4),
('nirmal', '12344321', 'Nirmal', 'Adhikari', 'nirmal@gmail.com', 'M', 'STD', 5),
('jaya', '87654321', 'Jaya', 'Gurung', 'jaya@gmail.com', 'F', 'STD', 6);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `f_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_price` decimal(6,2) NOT NULL,
  `f_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`f_id`, `s_id`, `f_name`, `f_price`, `f_pic`) VALUES
-- Wentworth Tea & Snacks
(7, 2, 'Herbal Tea', '5.00', '7_2.jpg'),
(8, 2, 'Chai Latte', '7.00', '8_2.jpg'),
(9, 3, 'Cheese Sandwich', '8.00', '9_3.jpg'),
(10, 3, 'Egg Salad Wrap', '12.00', '10_3.jpg'),
(11, 2, 'Cinnamon Roll', '4.00', NULL),
(12, 2, 'Scones with Jam', '5.00', '12_2.png'),
(13, 2, 'Fruit Tart', '6.00', '13_2.png'),
(14, 2, 'Carrot Cake', '4.50', '14_2.png'),
(15, 2, 'Biscuits', '3.50', '15_2.png'),
(16, 2, 'Lemon Meringue Pie', '7.00', '16_2.png'),

-- Wentworth Bakery
(17, 2, 'Croissants', '6.50', '17_2.png'),
(18, 2, 'Quiches', '9.00', NULL),
(19, 2, 'Baguette Sandwich', '8.00', NULL),
(20, 2, 'Baked Potatoes', '5.00', NULL),
(22, 3, 'Cheese Pizza', '12.00', '22_3.png'),
(23, 3, 'French Bread', '4.00', '23_3.png'),
(24, 3, 'Spinach and Cheese Pie', '7.00', '24_3.png'),
(25, 3, 'Garlic Bread', '3.50', '25_3.png'),
(26, 3, 'Pasta Salad', '6.50', NULL),
(27, 3, 'Muffins', '4.00', NULL),

-- Wentworth Food Court
(29, 6, 'Fresh Juice', '5.00', '29_6.png'),
(30, 6, 'Smoothie Bowl', '8.00', '30_6.png'),
(31, 6, 'Grilled Cheese Sandwich', '7.00', '31_6.png'),
(32, 6, 'Chicken Wrap', '9.50', '32_6.png'),
(33, 6, 'Veggie Burger', '8.50', '33_6.png'),
(34, 6, 'Chips and Dip', '4.00', '34_6.png'),
(35, 6, 'Falafel Wrap', '9.00', '35_6.png'),
(36, 6, 'Pita Bread with Hummus', '6.00', '36_6.png'),
(37, 6, 'Fruit Salad', '5.50', '37_6.png'),
(38, 6, 'Ice Cream Cone', '3.50', '38_6.png'),

-- Wentworth Tiffins
(39, 5, 'Dal Tadka', '8.00', '39_5.jpg'),
(40, 5, 'Palak Paneer', '9.00', '40_5.png'),
(41, 5, 'Aloo Gobi', '7.00', '41_5.jpg'),
(42, 5, 'Naan Bread', '3.00', '42_5.jpg'),
(44, 5, 'Samosas', '4.00', '44_5.png'),
(45, 5, 'Chole Bhature', '9.50', '45_5.jpg'),
(46, 5, 'Paneer Tikka', '10.00', NULL),
(47, 5, 'Vegetable Biryani', '10.50', '47_5.jpg'),
(48, 5, 'Butter Chicken', '12.00', NULL),
(49, 5, 'Lassi', '3.50', '49_5.jpg'),

-- Wentworth Juice Corner
(50, 5, 'Orange Juice', '4.50', '50_5.jpg'),
(51, 5, 'Apple Juice', '4.00', '51_5.jpg'),
(52, 4, 'Carrot Juice', '3.50', '52_4.jpg'),
(53, 4, 'Mango Smoothie', '5.50', '53_4.png'),
(54, 4, 'Pineapple Juice', '4.00', '54_4.png'),
(55, 4, 'Green Juice', '5.00', '55_4.png'),
(56, 4, 'Watermelon Juice', '4.00', '56_4.jpg'),
(57, 4, 'Peach Smoothie', '5.00', '57_4.jpg'),
(58, 4, 'Strawberry Smoothie', '5.50', '58_4.jpg'),
(59, 4, 'Coconut Water', '3.00', '59_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ord_id` int(11) NOT NULL,
  `orh_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `ord_amount` int(11) NOT NULL,
  `ord_buyprice` decimal(6,2) NOT NULL,
  `ord_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`ord_id`, `orh_id`, `f_id`, `ord_amount`, `ord_buyprice`, `ord_note`) VALUES
(102, 72, 22, 1, '100.00', ''),
(103, 0, 25, 1, '35.00', ''),
(106, 47, 29, 1, '40.00', ''),
(107, 75, 15, 1, '25.00', ''),
(108, 49, 13, 1, '25.00', ''),
(109, 50, 16, 3, '10.00', ''),
(110, 51, 10, 1, '80.00', ''),
(112, 77, 11, 1, '25.00', ''),
(113, 54, 36, 1, '60.00', ''),
(114, 79, 24, 1, '25.00', ''),
(115, 80, 27, 1, '40.00', ''),
(116, 81, 17, 1, '25.00', ''),
(117, 82, 62, 1, '120.00', ''),
(118, 83, 25, 1, '35.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `orh_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `orh_ordertime` timestamp NOT NULL DEFAULT current_timestamp(),
  `orh_orderstatus` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orh_finishedtime` datetime DEFAULT NULL,
  `t_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`orh_id`, `c_id`, `s_id`, `p_id`, `orh_ordertime`, `orh_orderstatus`, `orh_finishedtime`, `t_id`) VALUES
(72, 2, 3, 45, '2022-11-13 13:54:40', 'CNCL', '0000-00-00 00:00:00', ''),
(81, 3, 2, 57, '2022-11-14 13:42:35', 'FNSH', '2022-11-14 19:39:59', 'T041012345678'),
(82, 1, 4, 58, '2022-11-15 02:17:22', 'VRFY', NULL, 'T041076543210'),
(83, 1, 3, 59, '2022-11-15 02:19:16', 'VRFY', NULL, 'T041087654321');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_amount` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `c_id`, `p_amount`) VALUES
(45, 2, '100.00'),
(46, 5, '140.00'),
(47, 1, '40.00'),
(48, 1, '25.00'),
(49, 1, '25.00'),
(50, 1, '30.00'),
(51, 3, '80.00'),
(52, 3, '100.00'),
(53, 3, '25.00'),
(54, 3, '60.00'),
(55, 3, '25.00'),
(56, 3, '40.00'),
(57, 3, '25.00'),
(58, 1, '120.00'),
(59, 1, '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `s_username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pwd` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_phoneno` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`s_username`, `s_pwd`, `s_name`, `s_location`, `s_email`, `s_phoneno`, `s_pic`, `s_id`) VALUES
('shop1', 'Shop1@wentworth', 'Wentworth Tea & Snacks', 'Main Campus', 'shop01@email.com', '7569395349', 'shop2.png', 2),
('shop2', '12344321', 'Wentworth Bakery', 'C Building', 'shop02@email.com', '7569395349', 'shop-2.png', 3),
('shop3', '12121212', 'Wentworth Food Court', 'Library Area', 'shop3@gmail.com', '7569395349', 'shop4.png', 4),
('shop4', '34343434', 'Wentworth Tiffins', 'Student Hub', 'shop4@gmail.com', '7569395349', 'shop5.jpg', 5),
('shop5', '56565656', 'Wentworth Juice Corner', 'Health Centre', 'shop5@gmail.com', '7569395349', 'shop6.jpg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_username` (`c_username`),
  ADD UNIQUE KEY `c_email` (`c_email`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `orh_id` (`orh_id`) USING BTREE,
  ADD KEY `f_id` (`f_id`) USING BTREE;

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`orh_id`),
  ADD KEY `c_id` (`c_id`) USING BTREE,
  ADD KEY `s_id` (`s_id`) USING BTREE,
  ADD KEY `p_id` (`p_id`) USING BTREE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `orh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
