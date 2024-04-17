-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 avr. 2024 à 16:09
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dma9`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@email.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
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
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(21, 756.00, 'paid', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-03-28 08:14:13'),
(22, 780.00, 'paid', 1, 52834833, 'tunis', 'Centre urbain nord, INSAT ( institut nationale des sciences', '2024-03-28 08:25:36'),
(23, 935.00, 'not paid', 1, 22222222, 'Monastir', 'c1 n° 47', '2024-03-28 08:30:57'),
(24, 824.00, 'on-hold', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-03-29 12:39:36'),
(30, 603.00, 'on-hold', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-04-02 10:39:04'),
(31, 110.00, 'on-hold', 8, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-04-02 10:57:22'),
(32, 76.00, 'on-hold', 9, 2147483647, 'c', 'a', '2024-04-02 16:34:28'),
(33, 117.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-04 13:12:38'),
(34, 117.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-04 13:13:20'),
(35, 117.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-04 13:14:22'),
(36, 117.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-04 13:17:23'),
(37, 117.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-04 13:25:40'),
(38, 117.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-04 13:29:51'),
(39, 19.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 13:35:14'),
(40, 21.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 16:01:21'),
(41, 21.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 23:14:04'),
(42, 40.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 23:42:39'),
(43, 40.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 23:44:18'),
(44, 40.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 23:45:17'),
(45, 97.00, 'on-hold', 10, 2147483647, 'c', 'a', '2024-04-04 23:46:30'),
(46, 97.00, 'on-hold', 12, 2147483647, 'c', 'a', '2024-04-04 23:56:26'),
(47, 38.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-05 00:52:11'),
(48, 38.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-05 00:52:30'),
(49, 38.00, 'on-hold', 10, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-05 01:13:05'),
(50, 108.00, 'on-hold', 12, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-07 14:48:13'),
(51, 57.00, 'on-hold', 12, 2147483647, 'Cite Olymique', 'Tunis', '2024-04-07 22:43:49');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
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
-- Déchargement des données de la table `order_items`
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
(36, 31, '5', 'Black Coat', 'burger3.png', 110.00, 1, 8, '2024-04-02 10:57:22'),
(37, 32, '11', 'Avocado Bliss Fries', 'fries3.png', 19.00, 3, 9, '2024-04-02 16:34:28'),
(38, 32, '2', 'Classic Margherita', 'pizza2.png', 19.00, 1, 9, '2024-04-02 16:34:28'),
(39, 33, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 2, 10, '2024-04-04 13:12:38'),
(40, 33, '10', 'Spice n\' Meat Fries', 'fries2.png', 19.00, 1, 10, '2024-04-04 13:12:38'),
(41, 33, '15', 'Chicken Sandwich', 'sandwich2.png', 18.00, 1, 10, '2024-04-04 13:12:38'),
(42, 33, '3', 'DMA9 Roll-Up', 'sandwich3.png', 21.00, 2, 10, '2024-04-04 13:12:38'),
(43, 34, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 2, 10, '2024-04-04 13:13:20'),
(44, 34, '10', 'Spice n\' Meat Fries', 'fries2.png', 19.00, 1, 10, '2024-04-04 13:13:20'),
(45, 34, '15', 'Chicken Sandwich', 'sandwich2.png', 18.00, 1, 10, '2024-04-04 13:13:20'),
(46, 34, '3', 'DMA9 Roll-Up', 'sandwich3.png', 21.00, 2, 10, '2024-04-04 13:13:20'),
(47, 35, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 2, 10, '2024-04-04 13:14:22'),
(48, 35, '10', 'Spice n\' Meat Fries', 'fries2.png', 19.00, 1, 10, '2024-04-04 13:14:22'),
(49, 35, '15', 'Chicken Sandwich', 'sandwich2.png', 18.00, 1, 10, '2024-04-04 13:14:22'),
(50, 35, '3', 'DMA9 Roll-Up', 'sandwich3.png', 21.00, 2, 10, '2024-04-04 13:14:22'),
(51, 36, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 2, 10, '2024-04-04 13:17:23'),
(52, 36, '10', 'Spice n\' Meat Fries', 'fries2.png', 19.00, 1, 10, '2024-04-04 13:17:23'),
(53, 36, '15', 'Chicken Sandwich', 'sandwich2.png', 18.00, 1, 10, '2024-04-04 13:17:23'),
(54, 36, '3', 'DMA9 Roll-Up', 'sandwich3.png', 21.00, 2, 10, '2024-04-04 13:17:23'),
(55, 37, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 2, 10, '2024-04-04 13:25:40'),
(56, 37, '10', 'Spice n\' Meat Fries', 'fries2.png', 19.00, 1, 10, '2024-04-04 13:25:40'),
(57, 37, '15', 'Chicken Sandwich', 'sandwich2.png', 18.00, 1, 10, '2024-04-04 13:25:40'),
(58, 37, '3', 'DMA9 Roll-Up', 'sandwich3.png', 21.00, 2, 10, '2024-04-04 13:25:40'),
(59, 38, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 2, 10, '2024-04-04 13:29:51'),
(60, 38, '10', 'Spice n\' Meat Fries', 'fries2.png', 19.00, 1, 10, '2024-04-04 13:29:51'),
(61, 38, '15', 'Chicken Sandwich', 'sandwich2.png', 18.00, 1, 10, '2024-04-04 13:29:51'),
(62, 38, '3', 'DMA9 Roll-Up', 'sandwich3.png', 21.00, 2, 10, '2024-04-04 13:29:51'),
(63, 39, '2', 'Classic Margherita', 'pizza2.png', 19.00, 1, 10, '2024-04-04 13:35:14'),
(64, 40, '6', 'Meatquake', 'burger2.png', 21.00, 1, 10, '2024-04-04 16:01:21'),
(65, 41, '7', 'Double DMA9', 'burger4.png', 21.00, 1, 10, '2024-04-04 23:14:04'),
(66, 42, '7', 'Double DMA9', 'burger4.png', 21.00, 1, 10, '2024-04-04 23:42:39'),
(67, 42, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 1, 10, '2024-04-04 23:42:39'),
(68, 43, '7', 'Double DMA9', 'burger4.png', 21.00, 1, 10, '2024-04-04 23:44:18'),
(69, 43, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 1, 10, '2024-04-04 23:44:18'),
(70, 44, '7', 'Double DMA9', 'burger4.png', 21.00, 1, 10, '2024-04-04 23:45:17'),
(71, 44, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 1, 10, '2024-04-04 23:45:17'),
(72, 45, '7', 'Double DMA9', 'burger4.png', 21.00, 1, 10, '2024-04-04 23:46:30'),
(73, 45, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 1, 10, '2024-04-04 23:46:30'),
(74, 45, '2', 'Classic Margherita', 'pizza2.png', 19.00, 3, 10, '2024-04-04 23:46:30'),
(75, 46, '7', 'Double DMA9', 'burger4.png', 21.00, 1, 12, '2024-04-04 23:56:26'),
(76, 46, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 1, 12, '2024-04-04 23:56:26'),
(77, 46, '2', 'Classic Margherita', 'pizza2.png', 19.00, 3, 12, '2024-04-04 23:56:26'),
(78, 47, '2', 'Classic Margherita', 'pizza2.png', 19.00, 2, 10, '2024-04-05 00:52:11'),
(79, 48, '2', 'Classic Margherita', 'pizza2.png', 19.00, 2, 10, '2024-04-05 00:52:30'),
(80, 49, '2', 'Classic Margherita', 'pizza2.png', 19.00, 2, 10, '2024-04-05 01:13:05'),
(81, 50, '4', 'Meatball Madness Fries', 'fries4.png', 19.00, 1, 12, '2024-04-07 14:48:13'),
(82, 50, '2', 'Classic Margherita', 'pizza2.png', 19.00, 1, 12, '2024-04-07 14:48:13'),
(83, 50, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 1, 12, '2024-04-07 14:48:13'),
(84, 50, '5', 'Bread Master', 'burger3.png', 17.00, 3, 12, '2024-04-07 14:48:13'),
(85, 51, '1', 'Prime Beef Classic', 'burger1.png', 19.00, 3, 12, '2024-04-07 22:43:49');

-- --------------------------------------------------------

--
-- Structure de la table `products`
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
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Prime Beef Classic', 'burger', 'A beefy classic with lettuce, tomato, pickles, and secret sauce on a soft bun', 'burger1.png', 'burger1.png', 'burger1.png', 'burger1.png', 19.00, 18, 'white'),
(2, 'Classic Margherita', 'pizza', 'Thin crust, tomato sauce, melted mozzarella.', 'pizza2.png', 'pizza2.png', 'pizza2.png', 'pizza2.png', 19.00, 0, 'white'),
(3, 'DMA9 Roll-Up', 'sandwich', 'Spicy chicken, zesty sauces, crisp lettuce, and juicy tomato, all in one tasty wrap!', 'sandwich3.png', 'sandwich3.png', 'sandwich3.png', 'sandwich3.png', 21.00, 20, 'yellow'),
(4, 'Meatball Madness Fries', 'fries', 'Bowl of savory satisfaction with our meatball-topped fries.', 'fries4.png', 'fries4.png', 'fries4.png', 'fries4.png', 19.00, 18, 'yellow'),
(5, 'Bread Master', 'burger', 'Grilled beef on our signature bread with lettuce, tomato, and secret sauce.', 'burger3.png', 'burger3.png', 'burger3.png', 'burger3.png', 17.00, 16, 'white'),
(6, 'Meatquake', 'burger', 'Two mouthwatering beef patties, layered with crispy bacon, melted cheddar cheese, caramelized onions, and our signature sauce.', 'burger2.png', 'burger2.png', 'burger2.png', 'burger2.png', 21.00, 20, 'white'),
(7, 'Double DMA9', 'burger', 'Double the meat, double the lettuce, and double the cheese, all crowned with our secret harissa sauce and a kick of pickles.', 'burger4.png', 'burger4.png', 'burger4.png', 'burger4.png', 21.00, 20, 'white'),
(10, 'Spice n\' Meat Fries', 'fries', 'Golden fries topped with savory minced meat, a delightful blend of flavors in every bite!', 'fries2.png', 'fries2.png', 'fries2.png', 'fries2.png', 19.00, 18, 'yellow'),
(11, 'Avocado Bliss Fries', 'fries', 'Creamy avocado slices mingle with tangy tomato salsa, drizzled in a decadent cheese sauce.', 'fries3.png', 'fries3.png', 'fries3.png', 'fries3.png', 19.00, 18, 'yellow'),
(13, 'Extra Cheese & Pepperoni', 'pizza', 'Packed with extra slices and cheesy goodness', 'pizza4.png', 'pizza4.png', 'pizza4.png', 'pizza4.png', 21.00, 20, 'red'),
(14, 'Veggie Pepperoni', 'pizza', 'A classic pizza topped with savory pepperoni and a colorful array of fresh vegetables.', 'pizza1.png', 'pizza1.png', 'pizza1.png', 'pizza1.png', 24.00, 22, 'red'),
(15, 'Chicken Sandwich', 'sandwich', 'Chicken sandwich, topped with spicy sauce, crisp lettuce, and juicy tomato.', 'sandwich2.png', 'sandwich2.png', 'sandwich2.png', 'sandwich2.png', 18.00, 17, 'yellow'),
(16, 'Ham & Cheese Bliss', 'sandwich', 'Thinly sliced ham, creamy cheese, crisp lettuce, and juicy tomato.', 'sandwich1.png', 'sandwich1.png', 'sandwich1.png', 'sandwich1.png', 17.00, 16, 'red'),
(17, 'Chicken Fries', 'fries', ' Crispy fries with juicy chicken, topped with zesty Spicy Sauce and creamy Cheese Sauce', 'fries1.png', 'fries1.png', 'fries1.png', 'fries1.png', 19.00, 18, 'yellow');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'a', 'a@b.c', '96e79218965eb72c92a549dd5a330112'),
(4, 'a', 'a1@b.c', '96e79218965eb72c92a549dd5a330112'),
(5, 'a', 'a2@b.c', '96e79218965eb72c92a549dd5a330112'),
(6, 'b', 'c@d.e', '96e79218965eb72c92a549dd5a330112'),
(7, '1', '2@3.4', 'c8837b23ff8aaa8a2dde915473ce0991'),
(8, 'omar', 'omar@omar.omar', '96e79218965eb72c92a549dd5a330112'),
(12, 'sahar', 'ksahar071@gmail.com', 'af15d5fdacd5fdfea300e88a8e253e82'),
(17, 'emna walha', 'emna.walha@insat.ucar.tn', '96e79218965eb72c92a549dd5a330112'),
(18, 'emna walha', 'emnawalha03@gmail.com', '96e79218965eb72c92a549dd5a330112');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `product_id`, `product_name`, `product_price`, `product_image`, `added_date`) VALUES
(81, 12, 1, 'Prime Beef Classic', 19.00, 'burger1.png', '2024-04-07 13:46:03'),
(82, 12, 2, 'Classic Margherita', 19.00, 'pizza2.png', '2024-04-07 13:46:13'),
(83, 12, 4, 'Meatball Madness Fries', 19.00, 'fries4.png', '2024-04-07 13:46:23'),
(84, 12, 5, 'Bread Master', 17.00, 'burger3.png', '2024-04-07 13:47:13'),
(85, 18, 2, 'Classic Margherita', 19.00, 'pizza2.png', '2024-04-08 03:24:10'),
(86, 18, 3, 'DMA9 Roll-Up', 21.00, 'sandwich3.png', '2024-04-08 03:24:16'),
(93, 17, 1, 'Prime Beef Classic', 19.00, 'burger1.png', '2024-04-09 01:48:05'),
(94, 17, 2, 'Classic Margherita', 19.00, 'pizza2.png', '2024-04-09 01:48:07'),
(95, 17, 3, 'DMA9 Roll-Up', 21.00, 'sandwich3.png', '2024-04-09 01:48:09'),
(96, 17, 6, 'Meatquake', 21.00, 'burger2.png', '2024-04-09 01:53:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
