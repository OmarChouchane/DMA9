-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 02 avr. 2024 à 15:51
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
(21, 756.00, 'not paid', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-03-28 08:14:13'),
(22, 780.00, 'delivered', 1, 52834833, 'tunis', 'Centre urbain nord, INSAT ( institut nationale des sciences', '2024-03-28 08:25:36'),
(23, 935.00, 'not paid', 1, 22222222, 'Monastir', 'c1 n° 47', '2024-03-28 08:30:57'),
(24, 824.00, 'on-hold', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-03-29 12:39:36'),
(30, 603.00, 'on-hold', 1, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-04-02 10:39:04'),
(31, 110.00, 'on-hold', 8, 22222222, 'Monastir', 'c2 n° 47, cccc', '2024-04-02 10:57:22');

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
(36, 31, '5', 'Black Coat', 'burger3.png', 110.00, 1, 8, '2024-04-02 10:57:22');

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
(8, 'Black Dress', 'burger', 'Black women dress', 'burger1.png', 'burger1.png', 'burger1.png', 'burger1.png', 119.00, 0, 'black'),
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
(9, 'emna walha', 'emnawalha03@gmail.com', '96e79218965eb72c92a549dd5a330112');

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
