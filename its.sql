-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2020 at 09:40 AM
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
-- Database: `its`
--

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `cust_first_name`, `cust_last_name`, `cust_street`, `cust_barangay`, `cust_city`, `cust_zip_code`, `cust_number`, `created_at`, `updated_at`) VALUES
(1, 'James Michael', 'Faelden', 'Amapola Street', 'Pembo', 'Makati City', '1218', '09611260372', '2020-12-10 08:00:27', '2020-12-10 08:18:56'),
(3, 'Miguelito', 'Munsod', '123 Street', 'Bambang', 'Pasig City', '1234', '09669948107', '2020-12-10 15:47:25', '2020-12-10 15:47:25');

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
(1, 1, 'admin123', '$2y$10$c.E3kdu1ehHm.UaOCoeKf.0ZohYjpbnEhtsAzJMiVrwIXZ/pGpztO', 1, '2020-12-09 12:50:05', '2020-12-10 02:39:25'),
(3, 2, 'emp123', '$2y$10$6SzxIztptSlX2GzpdUItJOV5GJ1OtpCnW78VT//kl.fl.VrWTmt9u', 2, '2020-12-09 22:58:07', '2020-12-10 05:26:35');

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
  `product_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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
(1, 1, 'Rejuvenating SET #1', 'N/A', 15, 250, 1, '2020-12-12 10:50:15', '2020-12-16 16:37:13'),
(2, 1, 'Rejuvenating SET #2', 'N/A', 20, 250, 1, '2020-12-12 10:52:34', '2020-12-16 14:33:23'),
(3, 1, 'Rejuvenating SET #1 (BIG)', 'N/A', 20, 420, 1, '2020-12-12 10:55:01', '2020-12-16 14:33:26'),
(4, 1, 'Rejuvenating SET #3', '', 20, 250, 1, '2020-12-12 10:58:54', '2020-12-12 10:58:54'),
(5, 1, 'Rejuvenating SET Zero', '', 20, 280, 1, '2020-12-12 11:02:07', '2020-12-12 11:02:07'),
(6, 1, 'Rejuvenating SET #4 (Lemon Tomato Set)', '', 20, 280, 1, '2020-12-12 11:02:07', '2020-12-12 11:02:56'),
(7, 1, 'Orange Cucumber Rejuvenating SET', '', 20, 280, 1, '2020-12-12 11:07:59', '2020-12-12 11:07:59'),
(8, 1, 'Anti-Melasma SET', '', 18, 530, 1, '2020-12-12 11:10:16', '2020-12-16 16:37:13'),
(9, 1, 'Underarm Whitening Antiperspirant & Peeling Kit', '', 20, 450, 1, '2020-12-12 11:14:55', '2020-12-12 11:14:55'),
(10, 1, 'Ultra Body Bleaching Kit', '', 20, 595, 1, '2020-12-12 11:16:18', '2020-12-12 11:16:18'),
(11, 1, 'Local Obagi Kit', '', 20, 495, 1, '2020-12-12 11:17:29', '2020-12-12 11:17:29'),
(12, 1, 'Flawless Set', '', 19, 300, 1, '2020-12-12 11:18:28', '2020-12-16 16:37:13'),
(13, 1, 'Magical Kili-Kili SET (NEW)', '', 20, 500, 1, '2020-12-12 11:20:02', '2020-12-12 12:23:05'),
(14, 2, 'Rejuvenating Facial Toner #1/#2/#3', '60ML', 20, 100, 1, '2020-12-12 11:22:16', '2020-12-12 11:22:16'),
(15, 2, 'Rejuvenating  Facial Toner #1/#2/#3', '150ML', 20, 180, 1, '2020-12-12 11:24:10', '2020-12-12 11:24:10'),
(16, 2, 'Clarifying Solution (included in local Obagi kit)', '60ML', 20, 90, 1, '2020-12-12 11:26:50', '2020-12-12 11:26:50'),
(17, 2, 'Clarifying Solution (included in local Obagi kit)', '120ML', 20, 120, 1, '2020-12-12 11:28:15', '2020-12-12 11:28:15'),
(18, 2, 'Medicated Astringent (included in local obagi kit)', '60ML', 20, 100, 1, '2020-12-12 11:30:14', '2020-12-12 11:34:36'),
(19, 2, 'Micellar  Water (Make up Removal)(NEW)', '200ML', 20, 350, 1, '2020-12-12 11:36:19', '2020-12-12 11:36:19'),
(20, 3, 'Rejuvenating Cream#1/#2/#3', '10G', 20, 70, 1, '2020-12-12 11:38:18', '2020-12-12 11:38:18'),
(21, 3, 'Rejuvenating Cream #1', '20G', 20, 95, 1, '2020-12-12 11:39:15', '2020-12-12 12:25:54'),
(22, 3, 'Sunblock Cream', '10G', 20, 65, 1, '2020-12-12 11:40:33', '2020-12-12 12:30:10'),
(23, 3, 'Sunblock Cream', '20G', 20, 80, 1, '2020-12-12 11:41:59', '2020-12-12 12:30:39'),
(24, 3, 'Age-Defying Collagen cream', '10G', 20, 75, 1, '2020-12-12 11:45:20', '2020-12-12 11:45:20'),
(25, 3, 'Age-Defying Collagen cream', '20G', 20, 90, 1, '2020-12-12 11:46:27', '2020-12-12 11:46:27'),
(26, 3, 'Mousse Cream(PINK )(SPF15)', '5G', 20, 140, 1, '2020-12-12 11:48:47', '2020-12-12 11:48:47'),
(27, 3, 'Mousse Cream(Skintone )(SPF15)', '5G', 20, 140, 1, '2020-12-12 11:50:47', '2020-12-12 11:50:47'),
(28, 3, 'Restore & Polish Underarm Cream', '15G', 20, 180, 1, '2020-12-12 11:52:50', '2020-12-12 11:52:50'),
(29, 3, 'Purest Tawas Cream', '100G', 20, 160, 1, '2020-12-12 11:54:12', '2020-12-12 11:54:12'),
(30, 3, 'Purest Tawas Cream', '10G', 20, 65, 1, '2020-12-12 11:55:05', '2020-12-12 11:55:05'),
(31, 3, 'Magic Pinkish Tint (Soft touch & kissy)', '10ML', 20, 120, 1, '2020-12-12 11:57:17', '2020-12-12 11:57:17'),
(32, 3, 'Magical Cream Tint (RED)', '10G', 20, 120, 1, '2020-12-12 11:59:20', '2020-12-12 11:59:20'),
(33, 3, 'Magical Cream Tint (PINK)', '10G', 20, 120, 1, '2020-12-12 12:00:16', '2020-12-12 12:00:16'),
(34, 3, 'Top Scar & Stretchmark Cream', '50G', 20, 420, 1, '2020-12-12 12:02:44', '2020-12-12 12:02:44'),
(35, 3, 'Warts Exfo Cream', '20G', 20, 300, 1, '2020-12-12 12:04:55', '2020-12-12 12:04:55'),
(36, 3, 'Spider Vein Gel/ Varicose Vein Gel', '20G', 20, 250, 1, '2020-12-12 12:06:42', '2020-12-12 12:06:42'),
(37, 3, 'Inner Thigh Whitening Cream (For sensitive Skin)', '20G', 20, 160, 1, '2020-12-12 12:08:21', '2020-12-12 12:08:21'),
(38, 3, 'AHA/BHA Fruit Body Peeling Serum', '30ML', 20, 150, 1, '2020-12-12 12:10:15', '2020-12-12 12:10:15'),
(39, 3, 'AHA/BHA Skin Glow Body Serum', '30ML', 20, 150, 1, '2020-12-12 12:11:41', '2020-12-12 12:11:41'),
(40, 3, 'Magic Blurring Serum', '50G', 20, 450, 1, '2020-12-12 12:12:45', '2020-12-12 12:12:45'),
(41, 3, 'Wipe OFF Facial Cleanser Cream ', '80G', 20, 450, 1, '2020-12-12 12:14:38', '2020-12-12 12:14:38'),
(42, 4, 'Extra Strength Rejuvenating Soap', '150G', 20, 70, 1, '2020-12-12 12:35:00', '2020-12-12 12:35:00'),
(43, 4, 'Rejuvenating Maintenance Soap', '150G', 41, 65, 1, '2020-12-12 12:35:34', '2020-12-16 07:40:12'),
(44, 4, 'Premium Glutathione Soap', '135G', 20, 65, 1, '2020-12-12 12:36:13', '2020-12-12 12:36:13'),
(45, 4, 'Bleaching Black Soap', '135G', 20, 65, 1, '2020-12-12 12:36:44', '2020-12-12 12:36:44'),
(46, 4, 'Gluta-Mango Peel Soap', '135G', 20, 68, 1, '2020-12-12 12:37:13', '2020-12-12 12:37:13'),
(47, 4, 'Carrot with Oatmeal Soap', '135G', 20, 70, 1, '2020-12-12 12:37:44', '2020-12-12 12:37:44'),
(48, 4, 'Kojic Acid Soap', '135G', 20, 65, 1, '2020-12-12 12:38:02', '2020-12-12 12:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `quantity_total` int DEFAULT NULL,
  `payment_type` int NOT NULL,
  `sales_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_id` int NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `customer_name`, `address`, `quantity_total`, `payment_type`, `sales_date`, `login_id`, `updated_at`) VALUES
(1, 'James Faelden', 'Makati City', NULL, 2, '2020-12-16 16:37:13', 1, '2020-12-16 16:37:13');

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
(1, 1, 5, 1250),
(1, 8, 2, 1060),
(1, 12, 1, 300);

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
(1, 'James', 'Faelden', 'Comembo, Makati City', '09611260372', '2020-12-08 21:42:08', '2020-12-09 00:36:47'),
(2, 'Miguelito', 'Munsod', 'Bambang, Pasig City', '09669948107', '2020-12-08 22:18:11', '2020-12-09 00:32:50');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `privileges_id` (`privileges_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `sales_products`
--
ALTER TABLE `sales_products`
  ADD PRIMARY KEY (`sales_id`,`product_id`),
  ADD UNIQUE KEY `sales_id` (`sales_id`,`product_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `privileges_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`privileges_id`) REFERENCES `privileges` (`privileges_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sales_products`
--
ALTER TABLE `sales_products`
  ADD CONSTRAINT `sales_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `sales_products_ibfk_3` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
