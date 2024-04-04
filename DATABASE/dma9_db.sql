-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 05:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dma9`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@email.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(21, 756.00, 'not paid', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-03-28 08:14:13'),
(22, 780.00, 'delivered', 1, 52834833, 'tunis', 'Centre urbain nord, INSAT ( institut nationale des sciences', '2024-03-28 08:25:36'),
(23, 935.00, 'not paid', 1, 22222222, 'Monastir', 'c1 n° 47', '2024-03-28 08:30:57'),
(24, 824.00, 'on-hold', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-03-29 12:39:36'),
(30, 603.00, 'on-hold', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-04-02 10:39:04'),
(31, 110.00, 'on-hold', 8, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-04-02 10:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(16, 21, '3', 'Black Bag', 'sandwich3.png', 68.00, 2, 3, '2024-03-28 08:14:13'),
(17, 21, '1', 'White Shoes', 'burger1.png', 155.00, 4, 3, '2024-03-28 08:14:13'),
(18, 22, '4', 'White Nike Blazer', 'fries4.png', 195.00, 4, 1, '2024-03-28 08:25:36'),
(19, 23, '4', 'White Nike Blazer', 'fries4.png', 195.00, 4, 1, '2024-03-28 08:30:57'),
(20, 23, '2', 'Black Shoes', 'pizza2.png', 155.00, 1, 1, '2024-03-28 08:30:57'),
(21, 24, '1', 'White Shoes', 'burger1.png', 155.00, 3, 1, '2024-03-29 12:39:36'),
(22, 24, '2', 'Black Shoes', 'pizza2.png', 155.00, 1, 1, '2024-03-29 12:39:36'),
(23, 24, '3', 'Black Bag', 'sandwich3.png', 68.00, 3, 1, '2024-03-29 12:39:36'),
(34, 30, '3', 'Black Bag', 'sandwich3.png', 68.00, 6, 1, '2024-04-02 10:39:04'),
(35, 30, '4', 'White Nike Blazer', 'fries4.png', 195.00, 1, 1, '2024-04-02 10:39:04'),
(36, 31, '5', 'Black Coat', 'burger3.png', 110.00, 1, 8, '2024-04-02 10:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'White Shoes', 'burger', 'Some description', 'burger1.png', 'burger1.png', 'burger1.png', 'burger1.png', 155.00, 0, 'white'),
(2, 'Black Shoes', 'pizza', 'Some description', 'pizza2.png', 'pizza2.png', 'pizza2.png', 'pizza2.png', 155.00, 0, 'white'),
(3, 'Black Bag', 'sandwich', 'awesome black bag', 'sandwich3.png', 'sandwich3.png', 'sandwich3.png', 'sandwich3.png', 68.00, 0, 'black'),
(4, 'White Blazer', 'fries', 'awesome nike blazer', 'fries4.png', 'fries4.png', 'fries4.png', 'fries4.png', 195.00, 0, 'white'),
(5, 'Black Coat', 'burger', 'Black coat for men', 'burger3.png', 'burger3.png', 'burger3.png', 'burger3.png', 110.00, 0, 'black'),
(6, 'Black Jacket', 'burger', 'Black men jacket', 'burger2.png', 'burger2.png', 'burger2.png', 'burger2.png', 200.00, 0, 'black'),
(7, 'White Dress', 'burger', 'White women dress', 'burger4.png', 'burger4.png', 'burger4.png', 'burger4.png', 89.00, 0, 'white'),
(8, 'Black Dress', 'burger', 'Black women dress', 'burger1.png', 'burger1.png', 'burger1.png', 'burger1.png', 119.00, 0, 'black'),
(9, 'Black Watch', 'fries', 'smart black watch', 'fries2.png', 'fries1.png', 'fries3.png', 'fries4.png', 210.00, 0, 'black'),
(10, 'Red Watch', 'fries', 'smart red watch', 'fries2.png', 'fries2.png', 'fries2.png', 'fries2.png', 140.00, 0, 'red'),
(11, 'Purple Watch', 'fries', 'purple smart watch', 'fries3.png', 'fries3.png', 'fries3.png', 'fries3.png', 200.00, 0, 'purple'),
(12, 'Black Watch', 'fries', 'black smart watch', 'fries4.png', 'fries4.png', 'fries4.png', 'fries4.png', 180.00, 0, 'black'),
(13, 'Grey Adidas', 'pizza', 'classy grey adidas', 'pizza4.png', 'pizza4.png', 'pizza4.png', 'pizza4.png', 100.00, 0, 'grey'),
(14, 'Grey Adidas', 'pizza', 'classy grey adidas', 'pizza1.png', 'pizza1.png', 'pizza1.png', 'pizza1.png', 100.00, 0, 'grey'),
(15, 'Chicken Sandwich', 'sandwich', 'delicious spicy chicken sandwich', 'sandwich2.png', 'sandwich2.png', 'sandwich2.png', 'sandwich2.png', 8.00, 0, 'yellow'),
(16, 'Beef Sandwich', 'sandwich', 'a delicious beef spicy sandwich', 'sandwich1.png', 'sandwich1.png', 'sandwich1.png', 'sandwich1.png', 12.00, 0, 'red');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'a', 'a@b.c', '3540dcebea88eb546c9daab09d47fbf9'),
(4, 'a', 'a1@b.c', '3540dcebea88eb546c9daab09d47fbf9'),
(5, 'a', 'a2@b.c', '3540dcebea88eb546c9daab09d47fbf9'),
(6, 'b', 'c@d.e', '3540dcebea88eb546c9daab09d47fbf9'),
(7, '1', '2@3.4', 'c8837b23ff8aaa8a2dde915473ce0991'),
(8, 'omar', 'omar@omar.omar', '3540dcebea88eb546c9daab09d47fbf9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
