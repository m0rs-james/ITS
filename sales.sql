-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 08:33 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `activity_id` int NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`activity_id`, `entry_date`, `permission`, `user`, `area`, `description`) VALUES
(1, '2021-01-13 15:32:33', 'Admin', 'Super Admin', 'Sales', 'Super Admin has added new a new sales with ID of: 1');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int NOT NULL,
  `brand_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `login_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `login_id`, `created_at`) VALUES
(1, 'Kit', 1, '2020-12-12 10:32:55'),
(2, 'Toner', 1, '2020-12-12 10:33:03'),
(3, 'Cream / Tint / Serum', 1, '2020-12-12 10:33:27'),
(4, 'Soap', 1, '2020-12-12 10:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `cust_first_name` varchar(50) NOT NULL,
  `cust_last_name` varchar(50) NOT NULL,
  `cust_street` varchar(50) NOT NULL,
  `cust_barangay` varchar(50) NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_zip_code` varchar(4) NOT NULL,
  `cust_number` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int NOT NULL,
  `delivery_name` varchar(100) NOT NULL,
  `shipping_fee` int NOT NULL,
  `login_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_name`, `shipping_fee`, `login_id`, `created_at`, `updated_at`) VALUES
(3, 'Neri&#039;s Courier Services', 100, 1, '2021-01-11 03:23:18', '2021-01-11 18:50:49'),
(4, 'Lalamove', 100, 1, '2021-01-11 19:26:23', '2021-01-11 23:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int NOT NULL,
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privileges_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `user_id`, `username`, `password`, `privileges_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin123', '$2y$10$sZxODa5AnMPy8cnEvhBD0.TohBooXdauPDQD9hSiXuVNaz9wDkEfi', 1, '2020-12-09 12:50:05', '2020-12-17 02:18:23'),
(3, 2, 'emp123', '$2y$10$K.8QtIS0VwzJj0EAJ.fOTOJJivra2YfaqZZkIgR9cAANW0jJJZX6.', 2, '2020-12-09 22:58:07', '2021-01-13 15:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `payment_type` int NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `customer_name`, `address`, `product_id`, `quantity`, `payment_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'James Michael Faelden', 'Makati City', 2, 3, 2, 0, '2021-01-11 12:55:12', '2021-01-12 03:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `privileges_id` int NOT NULL,
  `privileges_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`privileges_id`, `privileges_name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_quantity` int NOT NULL,
  `product_price` double NOT NULL,
  `login_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_size`, `product_quantity`, `product_price`, `login_id`, `created_at`, `updated_at`) VALUES
(2, 1, 'Rejuvenating SET #2', 'N/A', 34, 250, 1, '2020-12-12 10:52:34', '2021-01-11 23:32:42'),
(3, 1, 'Rejuvenating SET #1 (BIG)', 'N/A', 0, 420, 1, '2020-12-12 10:55:01', '2021-01-03 14:28:23'),
(4, 1, 'Rejuvenating SET #3', 'N/A', 15, 250, 1, '2020-12-12 10:58:54', '2021-01-09 13:56:14'),
(5, 1, 'Rejuvenating SET Zero', 'N/A', 21, 280, 1, '2020-12-12 11:02:07', '2020-12-17 12:09:50'),
(6, 1, 'Rejuvenating SET #4 (Lemon Tomato Set)', 'N/A', 18, 280, 1, '2020-12-12 11:02:07', '2021-01-09 14:02:35'),
(7, 1, 'Orange Cucumber Rejuvenating SET', 'N/A', 20, 280, 1, '2020-12-12 11:07:59', '2021-01-09 14:02:44'),
(8, 1, 'Anti-Melasma SET', 'N/A', 18, 530, 1, '2020-12-12 11:10:16', '2021-01-09 13:56:48'),
(9, 1, 'Underarm Whitening Antiperspirant &amp;amp; Peeling Kit', 'N/A', 19, 450, 1, '2020-12-12 11:14:55', '2021-01-09 14:02:58'),
(10, 1, 'Ultra Body Bleaching Kit', 'N/A', 20, 595, 1, '2020-12-12 11:16:18', '2021-01-09 14:03:18'),
(11, 1, 'Local Obagi Kit', 'N/A', 18, 495, 1, '2020-12-12 11:17:29', '2021-01-11 04:27:36'),
(12, 1, 'Flawless Set', 'N/A', 17, 300, 1, '2020-12-12 11:18:28', '2021-01-13 15:32:33'),
(13, 1, 'Magical Kili-Kili SET (NEW)', 'N/A', 19, 500, 1, '2020-12-12 11:20:02', '2021-01-09 14:03:55'),
(14, 2, 'Rejuvenating Facial Toner #1/#2/#3', '60ML', 20, 100, 1, '2020-12-12 11:22:16', '2020-12-12 11:22:16'),
(15, 2, 'Rejuvenating  Facial Toner #1/#2/#3', '150ML', 20, 180, 1, '2020-12-12 11:24:10', '2020-12-12 11:24:10'),
(16, 2, 'Clarifying Solution (included in local Obagi kit)', '60ML', 20, 90, 1, '2020-12-12 11:26:50', '2020-12-12 11:26:50'),
(17, 2, 'Clarifying Solution (included in local Obagi kit)', '120ML', 20, 120, 1, '2020-12-12 11:28:15', '2020-12-12 11:28:15'),
(18, 2, 'Medicated Astringent (included in local obagi kit)', '60ML', 20, 100, 1, '2020-12-12 11:30:14', '2020-12-12 11:34:36'),
(19, 2, 'Micellar  Water (Make up Removal)(NEW)', '200ML', 19, 350, 1, '2020-12-12 11:36:19', '2021-01-06 09:30:18'),
(20, 3, 'Rejuvenating Cream#1/#2/#3', '10G', 20, 70, 1, '2020-12-12 11:38:18', '2020-12-12 11:38:18'),
(21, 3, 'Rejuvenating Cream #1', '20G', 20, 95, 1, '2020-12-12 11:39:15', '2020-12-12 12:25:54'),
(22, 3, 'Sunblock Cream', '10G', 20, 65, 1, '2020-12-12 11:40:33', '2020-12-12 12:30:10'),
(23, 3, 'Sunblock Cream', '20G', 20, 80, 1, '2020-12-12 11:41:59', '2020-12-12 12:30:39'),
(24, 3, 'Age-Defying Collagen cream', '10G', 18, 75, 1, '2020-12-12 11:45:20', '2021-01-12 03:02:42'),
(25, 3, 'Age-Defying Collagen cream', '20G', 13, 90, 1, '2020-12-12 11:46:27', '2021-01-10 09:07:37'),
(26, 3, 'Mousse Cream(PINK )(SPF15)', '5G', 20, 140, 1, '2020-12-12 11:48:47', '2020-12-12 11:48:47'),
(27, 3, 'Mousse Cream(Skintone )(SPF15)', '5G', 15, 140, 1, '2020-12-12 11:50:47', '2021-01-11 17:46:37'),
(28, 3, 'Restore & Polish Underarm Cream', '15G', 19, 180, 1, '2020-12-12 11:52:50', '2021-01-12 03:00:36'),
(29, 3, 'Purest Tawas Cream', '100G', 18, 160, 1, '2020-12-12 11:54:12', '2021-01-06 09:29:17'),
(30, 3, 'Purest Tawas Cream', '10G', 20, 65, 1, '2020-12-12 11:55:05', '2020-12-12 11:55:05'),
(31, 3, 'Magic Pinkish Tint (Soft touch & kissy)', '10ML', 20, 120, 1, '2020-12-12 11:57:17', '2020-12-12 11:57:17'),
(32, 3, 'Magical Cream Tint (RED)', '10G', 20, 120, 1, '2020-12-12 11:59:20', '2020-12-12 11:59:20'),
(33, 3, 'Magical Cream Tint (PINK)', '10G', 20, 120, 1, '2020-12-12 12:00:16', '2020-12-12 12:00:16'),
(34, 3, 'Top Scar & Stretchmark Cream', '50G', 20, 420, 1, '2020-12-12 12:02:44', '2020-12-12 12:02:44'),
(35, 3, 'Warts Exfo Cream', '20G', 20, 300, 1, '2020-12-12 12:04:55', '2020-12-12 12:04:55'),
(36, 3, 'Spider Vein Gel/ Varicose Vein Gel', '20G', 19, 250, 1, '2020-12-12 12:06:42', '2021-01-12 03:00:36'),
(37, 3, 'Inner Thigh Whitening Cream (For sensitive Skin)', '20G', 20, 160, 1, '2020-12-12 12:08:21', '2020-12-12 12:08:21'),
(38, 3, 'AHA/BHA Fruit Body Peeling Serum', '30ML', 20, 150, 1, '2020-12-12 12:10:15', '2020-12-12 12:10:15'),
(39, 3, 'AHA/BHA Skin Glow Body Serum', '30ML', 20, 150, 1, '2020-12-12 12:11:41', '2020-12-12 12:11:41'),
(40, 3, 'Magic Blurring Serum', '50G', 20, 450, 1, '2020-12-12 12:12:45', '2020-12-12 12:12:45'),
(41, 3, 'Wipe OFF Facial Cleanser Cream ', '80G', 20, 450, 1, '2020-12-12 12:14:38', '2020-12-12 12:14:38'),
(42, 4, 'Extra Strength Rejuvenating Soap', '150G', 20, 70, 1, '2020-12-12 12:35:00', '2020-12-12 12:35:00'),
(43, 4, 'Rejuvenating Maintenance Soap', '150G', 21, 65, 1, '2020-12-12 12:35:34', '2020-12-17 02:16:42'),
(44, 4, 'Premium Glutathione Soap', '135G', 20, 65, 1, '2020-12-12 12:36:13', '2020-12-12 12:36:13'),
(45, 4, 'Bleaching Black Soap', '135G', 18, 65, 1, '2020-12-12 12:36:44', '2021-01-06 09:30:18'),
(46, 4, 'Gluta-Mango Peel Soap', '135G', 19, 68, 1, '2020-12-12 12:37:13', '2021-01-06 09:30:18'),
(47, 4, 'Carrot with Oatmeal Soap', '135G', 18, 70, 1, '2020-12-12 12:37:44', '2021-01-11 04:13:05'),
(48, 4, 'Kojic Acid Soap', '135G', 18, 65, 1, '2020-12-12 12:38:02', '2020-12-17 01:20:04'),
(49, 1, 'Rejuvenating SET #1', 'N/A', 15, 250, 1, '2020-12-17 16:04:50', '2020-12-17 16:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `payment_type` int NOT NULL,
  `sales_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sales_status` int NOT NULL,
  `login_id` int NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `customer_name`, `address`, `payment_type`, `sales_date`, `sales_status`, `login_id`, `updated_at`) VALUES
(1, 'Juan Dela Cruz', 'Philippines', 2, '2021-01-13 15:32:33', 0, 1, '2021-01-13 15:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `sales_products`
--

CREATE TABLE `sales_products` (
  `sales_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales_products`
--

INSERT INTO `sales_products` (`sales_id`, `product_id`, `quantity`, `total`) VALUES
(1, 12, 1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `shipment_id` int NOT NULL,
  `sales_id` int NOT NULL,
  `delivery_id` int NOT NULL,
  `status` int NOT NULL,
  `login_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipment_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_number` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_address`, `user_number`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'Admin City', '09123456789', '2020-12-08 21:42:08', '2021-01-13 15:15:18'),
(2, 'Employee', 'User', 'User', '09123456789', '2020-12-08 22:18:11', '2021-01-13 15:15:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `delivery_ibfk_1` (`login_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `privileges_id` (`privileges_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notification_ibfk_1` (`product_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`privileges_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `sales_ibfk_3` (`login_id`);

--
-- Indexes for table `sales_products`
--
ALTER TABLE `sales_products`
  ADD PRIMARY KEY (`sales_id`,`product_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `shipment_ibfk_2` (`delivery_id`),
  ADD KEY `shipment_ibfk_3` (`login_id`),
  ADD KEY `shipment_ibfk_1 sales_id` (`sales_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `activity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `privileges_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`privileges_id`) REFERENCES `privileges` (`privileges_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_products`
--
ALTER TABLE `sales_products`
  ADD CONSTRAINT `sales_products_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1 sales_id` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipment_ibfk_2` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`delivery_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipment_ibfk_3` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
