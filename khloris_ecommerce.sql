-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 05:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khloris_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$UCKnmHQ9IBQB57.mDohFlO1Ml/ZPFI4fCEkmQwgASWdo.kPILyk7.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(500) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `product_name`, `product_price`, `quantity`, `added_at`, `image_url`, `total`) VALUES
(62, 17, 14, 'Sunshine Serenade', 7000.00, 2, '2024-09-13 12:20:06', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509926/images/sunflower/ldqdudh7gtzpzch5ssx4.jpg', 14000.00),
(63, 17, 31, 'Pure Radiance', 9000.00, 1, '2024-09-13 12:24:30', 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527225/beautiful-lilies-bouquet_3_tdc4m7.jpg', 9000.00),
(64, 17, 12, 'White Tulips Bouquet', 15000.00, 1, '2024-09-22 09:45:52', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509904/images/sunflower/xb69l4rl7ou1zrf1q7ji.jpg', 15000.00),
(71, 12, 11, 'Sunflower Bouquet', 12000.00, 1, '2024-09-22 10:47:19', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509898/images/sunflower/fwso4b9f6wjmuqwwkrmb.jpg', 12000.00);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'flower'),
(2, 'occasion');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_num` varchar(15) DEFAULT NULL,
  `delivery_option` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `delivery` datetime DEFAULT NULL,
  `order_status` enum('ordered','pending','completed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `address`, `phone_num`, `delivery_option`, `qty`, `total`, `order_date`, `delivery`, `order_status`) VALUES
(1, 12, NULL, NULL, NULL, 1, 9000.00, '2024-09-22 18:42:02', NULL, 'ordered'),
(2, 12, NULL, NULL, NULL, 1, 7000.00, '2024-09-22 18:43:31', NULL, 'ordered'),
(3, 12, NULL, NULL, NULL, 1, 3000.00, '2024-09-22 18:43:51', NULL, 'ordered'),
(4, 12, NULL, NULL, NULL, 1, 10000.00, '2024-09-22 18:44:37', NULL, 'ordered'),
(5, 12, NULL, NULL, NULL, 1, 0.00, '2024-09-22 18:46:17', NULL, 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock`, `image_url`, `category_id`, `type_id`) VALUES
(11, 'Sunflower Bouquet', '', 12000.00, 49, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509898/images/sunflower/fwso4b9f6wjmuqwwkrmb.jpg', 1, 2),
(12, 'White Tulips Bouquet', '', 15000.00, 100, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509904/images/sunflower/xb69l4rl7ou1zrf1q7ji.jpg', 1, 2),
(13, 'Golden Sunshine Bliss', '', 10000.00, 87, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509919/images/sunflower/muadbqi0e7c45vft7jpr.jpg', 1, 2),
(14, 'Sunshine Serenade', '', 7000.00, 71, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509926/images/sunflower/ldqdudh7gtzpzch5ssx4.jpg', 1, 2),
(15, 'Sunflower Delight', '', 20000.00, 14, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509933/images/sunflower/xrw5gybjrj6vlisynhi3.jpg', 1, 2),
(16, 'Golden Glow Harmony', '', 5000.00, 40, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509998/images/sunflower/fe7bc7ootsfe3kns2mdo.jpg', 1, 2),
(17, 'Tulip Elegance', '', 3500.00, 65, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510132/images/tulips/euxenjxze3amuu6q7zfh.webp', 1, 4),
(18, 'Tulip Garden Delight', '', 8600.00, 60, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510139/images/tulips/sem08xxrgexfn9p9czul.webp', 1, 4),
(19, 'Peach and White Bouquet', '', 15000.00, 50, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510157/images/tulips/nt46g1smhnl5le1qarrh.jpg', 1, 4),
(20, 'Blue Tulips Bouquet', '', 5500.00, 35, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510207/images/tulips/eoy2rjygcebsvqjcht1v.jpg', 1, 4),
(21, 'Orange Tulip Bouquet', '', 1200.00, 100, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510234/images/tulips/zaym6mrpavpkesggvudf.webp', 1, 4),
(22, 'Peachy Tulip Bouquet', '', 2600.00, 45, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510249/images/tulips/foyikbwklbc6hxpwlbnj.jpg', 1, 4),
(23, 'Blissful Blossoms', '', 5800.00, 35, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510354/images/rose/lcbyvmogxq4wyjrrnneo.jpg', 1, 1),
(24, 'Timeless Romance', '', 25000.00, 90, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510372/images/rose/ubn1zoyojxbift2yr2ta.webp', 1, 1),
(25, 'Velvet Embrace', '', 4999.00, 39, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510440/images/rose/jfzpre2mhpbrukgvy6kr.jpg', 1, 1),
(26, 'Elegant Affair', '', 8500.00, 20, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510446/images/rose/f2qmdjlksxi6cx7fu5p4.jpg', 1, 1),
(27, 'Passionate Charm', '', 9000.00, 53, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510414/images/rose/ewvk6nzfeskumx3nxn51.jpg', 1, 1),
(28, 'Enchanted Garden', '', 3000.00, 10, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510429/images/rose/wxbwjfkvmzloa8h9w0lj.jpg', 1, 1),
(29, 'Lily Serenity', '', 6999.00, 60, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527225/HB-3893_r640-1824x2384_wqs4ce.jpg', 1, 3),
(30, 'Majestic Bloom', '', 10500.00, 90, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527224/FTD-PCV_fpvsst.webp', 1, 3),
(31, 'Pure Radiance', '', 9000.00, 35, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527225/beautiful-lilies-bouquet_3_tdc4m7.jpg', 1, 3),
(32, 'Luminous Garden', '', 12000.00, 55, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527227/4665b4d2ec0b4b236dbea1ebd68bfa70_gdlzuw.jpg', 1, 3),
(33, 'Elegant Harmony', '', 2500.00, 10, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527226/lily35b1-scaled_cevi14.jpg', 1, 3),
(34, 'Opulent Splendor', '', 3500.00, 25, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527224/34198900b2d5482ceef4fcceadec0985_uvgewp.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `category_id`) VALUES
(1, 'Rose', 1),
(2, 'Sunflower', 1),
(3, 'Lily', 1),
(4, 'Tulip', 1),
(5, 'Birthday', 2),
(6, 'Valentine', 2),
(7, 'Funeral', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `username`, `email`, `password`) VALUES
(6, 'ss', 'ssss', 'ss', 'ssss'),
(12, 'ayheca', 'ayheca', 'ayheca', 'ayheca'),
(17, 'new', 'new', 'new', 'new');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
