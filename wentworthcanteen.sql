-- Database: `WentworthCanteen`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for table `cart`

CREATE TABLE `cart` (
  `ct_id` INT NOT NULL AUTO_INCREMENT,
  `ct_amount` INT NOT NULL,
  `ct_note` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_id` INT NOT NULL,
  `f_id` INT NOT NULL,
  `c_id` INT NOT NULL,
  PRIMARY KEY (`ct_id`),
  KEY `c_id` (`c_id`),
  KEY `f_id` (`f_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cart` (`ct_id`, `ct_amount`, `ct_note`, `s_id`, `f_id`, `c_id`) VALUES
(1, 1, '', 0, 0, 0),
(18, 1, '', 0, 0, 0),
(29, 3, '', 0, 0, 0),
(84, 1, '', 3, 10, 1);

-- Table structure for table `customer`

CREATE TABLE `customer` (
  `c_username` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_pwd` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_firstname` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_lastname` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_email` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_gender` VARCHAR(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M for Male, F for Female',
  `c_type` VARCHAR(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'STD=Student, STF=Staff, GUE=Guest, ADM=Admin, OTH=Other',
  `c_id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_username` (`c_username`),
  UNIQUE KEY `c_email` (`c_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customer` (`c_username`, `c_pwd`, `c_firstname`, `c_lastname`, `c_email`, `c_gender`, `c_type`, `c_id`) VALUES
('bipana', '12344321', 'Bipana', 'Shrestha', 'bipana@gmail.com', 'F', 'STD', 1),
('akriti', '12344321', 'Akriti', 'Paudel', 'akriti@gmail.com', 'F', 'STD', 2),
('priya', '12344321', 'Priya', 'Khatri', 'priya@gmail.com', 'F', 'STD', 3),
('sampadmin', 'sampa@admin', 'Sampada', 'Deoju', 'sampada@gmail.com', 'F', 'ADM', 4),
('nirmal', '12344321', 'Nirmal', 'Purja', 'nirmal@gmail.com', 'M', 'STD', 5),
('jaya', '87654321', 'Jaya', 'Gurung', 'jaya@gmail.com', 'F', 'STD', 6);

-- Table structure for table `food`

CREATE TABLE `food` (
  `f_id` INT NOT NULL AUTO_INCREMENT,
  `s_id` INT NOT NULL,
  `f_name` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_price` DECIMAL(6,2) NOT NULL,
  `f_pic` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`f_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Food 
INSERT INTO `food` (`f_id`, `s_id`, `f_name`, `f_price`, `f_pic`) VALUES
-- Wentworth Tea & Snacks
(7, 2, 'Herbal Tea', '5.00', '7_2.jpg'),
(8, 2, 'Chai Latte', '7.00', '8_2.jpg'),
(9, 2, 'Cheese Sandwich', '8.00', '9_3.jpg'),
(10, 2, 'Egg Salad Wrap', '12.00', '10_3.jpg'),
(11, 2, 'Cinnamon Roll', '4.00', '1_1.jpg'),
(12, 2, 'Scones with Jam', '5.00', '12_2.jpg'),
(13, 2, 'Fruit Tart', '6.00', '13_2.jpg'),
(14, 2, 'Carrot Cake', '4.50', '14_2.jpg'),
(15, 2, 'Biscuits', '3.50', '15_2.jpg'),
(16, 2, 'Lemon Meringue Pie', '7.00', '16_2.png'),

-- Wentworth Bakery
(17, 3, 'Croissants', '6.50', '17_2.png'),
(18, 3, 'Quiches', '9.00', 'q.png'),
(19, 3, 'Baguette Sandwich', '8.00', 'b.png'),
(20, 3, 'Baked Potatoes', '5.00', 'potato.png'),
(22, 3, 'Cheese Pizza', '12.00', 'pizza.png'),
(23, 3, 'French Bread', '4.00', '23_3.jpg'),
(24, 3, 'Spinach and Cheese Pie', '7.00', '24_3.jpg'),
(25, 3, 'Garlic Bread', '3.50', '25_3.jpg'),
(26, 3, 'Pasta Salad', '6.50', 'pasta.jpg'),
(27, 3, 'Muffins', '4.00', 'muffins.jpg'),

-- Wentworth Food Court
(29, 4, 'Fresh Juice', '5.00', '29_6.png'),
(30, 4, 'Smoothie Bowl', '8.00', '30_6.png'),
(31, 4, 'Grilled Cheese Sandwich', '7.00', '9_3.jpg'),
(32, 4, 'Chicken Wrap', '9.50', '32_6.jpg'),
(33, 4, 'Veggie Burger', '8.50', '33_6.jpg'),
(34, 4, 'Chips and Dip', '4.00', '34_6.png'),
(35, 4, 'Falafel Wrap', '9.00', '32_6.jpg'),
(36, 4, 'Pita Bread with Hummus', '6.00', '36_6.jpg'),
(37, 4, 'Fruit Salad', '5.50', '37_6.jpg'),
(38, 4, 'Ice Cream Cone', '3.50', '38_6.jpg'),

-- Wentworth Tiffins
(39, 5, 'Dal Tadka', '8.00', '39_5.jpg'),
(40, 5, 'Palak Paneer', '9.00', '40_5.jpg'),
(41, 5, 'Aloo Gobi', '7.00', '41_5.jpg'),
(42, 5, 'Naan Bread', '3.00', '42_5.jpg'),
(44, 5, 'Samosas', '4.00', '44_5.jpg'),
(45, 5, 'Chole Bhature', '9.50', '45_5.jpg'),
(46, 5, 'Paneer Tikka', '10.00', 'paneer.jpg'),
(47, 5, 'Vegetable Biryani', '10.50', '47_5.png'),
(48, 5, 'Butter Chicken', '12.00', 'chicken.jpg'),
(49, 5, 'Lassi', '3.50', '30_6.png'),

-- Wentworth Juice Corner
(50, 6, 'Orange Juice', '4.50', '33_6.png'),
(51, 6, 'Apple Juice', '4.00', '51_5.png'),
(52, 6, 'Carrot Juice', '3.50', '29_6.png'),
(53, 6, 'Mango Smoothie', '5.50', '53_4.png'),
(54, 6, 'Pineapple Juice', '4.00', '54_4.jpg'),
(55, 6, 'Green Juice', '5.00', '55_4.png'),
(56, 6, 'Watermelon Juice', '4.00', '56_4.jpg'),
(57, 6, 'Peach Smoothie', '5.00', '57_4.png'),
(58, 6, 'Strawberry Smoothie', '5.50', '58_4.png'),
(59, 6, 'Coconut Water', '3.00', '59_4.jpg');


-- Table structure for table `order_detail`

CREATE TABLE `order_detail` (
  `ord_id` INT NOT NULL AUTO_INCREMENT,
  `orh_id` INT NOT NULL,
  `f_id` INT NOT NULL,
  `ord_amount` INT NOT NULL,
  `ord_buyprice` DECIMAL(6,2) NOT NULL,
  `ord_note` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ord_id`),
  KEY `orh_id` (`orh_id`),
  KEY `f_id` (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- data for table `order_detail`

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

-- Table structure for table `order_header`

CREATE TABLE `order_header` (
  `orh_id` INT NOT NULL AUTO_INCREMENT,
  `c_id` INT NOT NULL,
  `s_id` INT NOT NULL,
  `p_id` INT NOT NULL,
  `orh_ordertime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orh_orderstatus` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orh_finishedtime` DATETIME DEFAULT NULL,
  `t_id` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`orh_id`),
  KEY `c_id` (`c_id`),
  KEY `s_id` (`s_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- data for table `order_header`

INSERT INTO `order_header` (`orh_id`, `c_id`, `s_id`, `p_id`, `orh_ordertime`, `orh_orderstatus`, `orh_finishedtime`, `t_id`) VALUES
(72, 2, 3, 45, '2025-05-20 13:54:40', 'CNCL', '0000-00-00 00:00:00', ''),
(81, 3, 2, 57, '2025-05-20 13:42:35', 'FNSH', '2025-05-20 19:39:59', 'T041012345678'),
(82, 1, 4, 58, '2025-05-20 02:17:22', 'VRFY', NULL, 'T041076543210'),
(83, 1, 3, 59, '2025-05-20 02:19:16', 'VRFY', NULL, 'T041087654321');

-- Table structure for table `payment`

CREATE TABLE `payment` (
  `p_id` INT NOT NULL AUTO_INCREMENT,
  `c_id` INT NOT NULL,
  `p_amount` DECIMAL(7,2) NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `c_id` (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- data for table `payment`

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

-- Table structure for table `shop`

CREATE TABLE `shop` (
  `s_username` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pwd` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_location` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_email` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_phoneno` VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pic` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `shop`

INSERT INTO `shop` (`s_username`, `s_pwd`, `s_name`, `s_location`, `s_email`, `s_phoneno`, `s_pic`, `s_id`) VALUES
('shop1', 'Shop1@wentworth', 'Wentworth Tea & Snacks', 'Main Campus', 'shop01@email.com', '123456543', 'shop2.png', 2),
('shop2', '12344321', 'Wentworth Bakery', 'C Building', 'shop02@email.com', '123456543', 'shop3.png', 3),
('shop3', '12121212', 'Wentworth Food Court', 'Library Area', 'shop3@gmail.com', '123456543', 'shop4.png', 4),
('shop4', '34343434', 'Wentworth Tiffins', 'Student Hub', 'shop4@gmail.com', '123456543', 'shop5.jpg', 5),
('shop5', '56565656', 'Wentworth Juice Corner', 'Health Centre', 'shop5@gmail.com', '123456543', 'shop6.jpg', 6);


-- Foreign Keys (Optional - add only if you want strict DB relationships)
-- ALTER TABLE `cart` ADD FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);
-- ALTER TABLE `cart` ADD FOREIGN KEY (`f_id`) REFERENCES `food` (`f_id`);
-- ALTER TABLE `cart` ADD FOREIGN KEY (`s_id`) REFERENCES `shop` (`s_id`);
-- ALTER TABLE `order_detail` ADD FOREIGN KEY (`orh_id`) REFERENCES `order_header` (`orh_id`);
-- ALTER TABLE `order_detail` ADD FOREIGN KEY (`f_id`) REFERENCES `food` (`f_id`);
-- ALTER TABLE `order_header` ADD FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);
-- ALTER TABLE `order_header` ADD FOREIGN KEY (`s_id`) REFERENCES `shop` (`s_id`);
-- ALTER TABLE `order_header` ADD FOREIGN KEY (`p_id`) REFERENCES `payment` (`p_id`);
-- ALTER TABLE `payment` ADD FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

-- --------------------------------------------------------
COMMIT;
