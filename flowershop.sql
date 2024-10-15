-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 10:38 AM
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
-- Database: `flowershop`
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
  `product_name` varchar(100) DEFAULT NULL,
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
(16, 20, 3, 'Pastel Breeze', 12000.00, 1, '2024-10-08 13:45:27', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509498/images/annivflowers/be2wu1hvd2w4qtvofbbt.jpg', 360000.00),
(18, 20, 71, 'Heavenly Principles', 19000.00, 1, '2024-10-08 13:52:04', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509745/images/funeralflowers/ss29acpkcf8liwc29tkf.jpg', 285000.00),
(20, 20, 13, 'Golden Sunshine Bliss', 10000.00, 3, '2024-10-08 13:52:31', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509919/images/sunflower/muadbqi0e7c45vft7jpr.jpg', 10000.00),
(23, 20, 61, 'Petal Poetry', 13000.00, 2, '2024-10-09 09:04:11', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509186/images/BIRTHDAYFLOWERS/rjiv8evs1l0tcafoavxf.jpg', 26000.00),
(24, 20, 60, 'Pixie Dream', 12000.00, 3, '2024-10-09 09:26:54', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509168/images/BIRTHDAYFLOWERS/br21gmyop5xo1f3ip4mo.jpg', 36000.00),
(27, 20, 2, 'Meadow Fresh', 12000.00, 2, '2024-10-09 17:14:34', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509484/images/annivflowers/q71bnrloldejh2wm8zvf.jpg', 24000.00),
(29, 20, 5, 'Cherry Blossom', 9000.00, 1, '2024-10-09 17:18:25', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509548/images/annivflowers/zih6wpg2zubrbzg8uden.jpg', 9000.00),
(30, 20, 70, 'Farewell to you my friend', 12000.00, 1, '2024-10-09 17:18:30', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509739/images/funeralflowers/tvxh5o7ft70gawoaodej.jpg', 12000.00),
(32, 20, 94, 'jab', 1.00, 1, '2024-10-10 10:32:09', 'https://res.cloudinary.com/dsfcl09md/image/upload/v1728539458/drawings/ea06yhlqglojragpq7ag.jpg', 1.00),
(33, 20, 12, 'Sunshine in a Bouquet', 15000.00, 1, '2024-10-15 06:34:40', 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509904/images/sunflower/xb69l4rl7ou1zrf1q7ji.jpg', 15000.00);

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
(2, 'occasion'),
(3, 'customize');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `delivery_option` enum('delivery','pickup') NOT NULL,
  `qnty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `address`, `phone_num`, `delivery_option`, `qnty`, `total`, `order_status`, `created_at`) VALUES
(0, 20, 16, '1', '1', 'delivery', 1, 5000.00, 'pending', '2024-10-09 08:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock`, `image_url`, `category_id`, `type_id`) VALUES
(1, 'Green Flover', 'Anniversary Boquet', 12000.00, 20, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509476/images/annivflowers/dn7ouvmkvaetdvfdhh5y.jpg', 2, 6),
(2, 'Meadow Fresh', 'Anniverary Boquet', 12000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509484/images/annivflowers/q71bnrloldejh2wm8zvf.jpg', 2, 6),
(3, 'Pastel Breeze', 'Anniverary Boquet', 12000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509498/images/annivflowers/be2wu1hvd2w4qtvofbbt.jpg', 2, 6),
(4, 'Romance Fantasy', 'Anniverary Boquet', 10000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509504/images/annivflowers/lxeee0g5c0svjqwdwkgx.jpg', 2, 6),
(5, 'Cherry Blossom', 'Anniverary Boquet', 9000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509548/images/annivflowers/zih6wpg2zubrbzg8uden.jpg', 2, 6),
(6, 'Peach Perfection', 'Anniverary Boquet', 9000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509559/images/annivflowers/telh8ozwxjzyavqbf82t.jpg', 2, 6),
(11, 'Sunflower Bouquet', '', 12000.00, 50, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509898/images/sunflower/fwso4b9f6wjmuqwwkrmb.jpg', 1, 2),
(12, 'Sunshine in a Bouquet', '', 15000.00, 100, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509904/images/sunflower/xb69l4rl7ou1zrf1q7ji.jpg', 1, 2),
(13, 'Golden Sunshine Bliss', '', 10000.00, 90, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509919/images/sunflower/muadbqi0e7c45vft7jpr.jpg', 1, 2),
(14, 'Sunshine Serenade', '', 7000.00, 70, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509926/images/sunflower/ldqdudh7gtzpzch5ssx4.jpg', 1, 2),
(15, 'Sunflower Delight', '', 20000.00, 10, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509933/images/sunflower/xrw5gybjrj6vlisynhi3.jpg', 1, 2),
(16, 'Golden Glow Harmony', '', 5000.00, 40, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509998/images/sunflower/fe7bc7ootsfe3kns2mdo.jpg', 1, 2),
(17, 'Tulip Elegance', '', 3500.00, 65, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510132/images/tulips/euxenjxze3amuu6q7zfh.webp', 1, 4),
(18, 'Tulip Garden Delight', '', 8600.00, 60, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510139/images/tulips/sem08xxrgexfn9p9czul.webp', 1, 4),
(19, 'Peach and White Bouquet', '', 15000.00, 50, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510157/images/tulips/nt46g1smhnl5le1qarrh.jpg', 1, 4),
(20, 'Blue Tulips Bouquet', '', 5500.00, 35, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510207/images/tulips/eoy2rjygcebsvqjcht1v.jpg', 1, 4),
(21, 'Orange Tulip Bouquet', '', 1200.00, 100, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510234/images/tulips/zaym6mrpavpkesggvudf.webp', 1, 4),
(22, 'Peachy Tulip Bouquet', '', 2600.00, 45, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510249/images/tulips/foyikbwklbc6hxpwlbnj.jpg', 1, 4),
(23, 'Blissful Blossoms', '', 5800.00, 35, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510354/images/rose/lcbyvmogxq4wyjrrnneo.jpg', 1, 1),
(24, 'Timeless Romance', '', 25000.00, 90, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510372/images/rose/ubn1zoyojxbift2yr2ta.webp', 1, 1),
(25, 'Velvet Embrace', '', 4999.00, 40, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510440/images/rose/jfzpre2mhpbrukgvy6kr.jpg', 1, 1),
(26, 'Elegant Affair', '', 8500.00, 20, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510446/images/rose/f2qmdjlksxi6cx7fu5p4.jpg', 1, 1),
(27, 'Passionate Charm', '', 9000.00, 55, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510414/images/rose/ewvk6nzfeskumx3nxn51.jpg', 1, 1),
(28, 'Enchanted Garden', '', 3000.00, 10, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725510429/images/rose/wxbwjfkvmzloa8h9w0lj.jpg', 1, 1),
(29, 'Lily Serenity', '', 6999.00, 60, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527225/HB-3893_r640-1824x2384_wqs4ce.jpg', 1, 3),
(30, 'Majestic Bloom', '', 10500.00, 90, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527224/FTD-PCV_fpvsst.webp', 1, 3),
(31, 'Pure Radiance', '', 9000.00, 35, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527225/beautiful-lilies-bouquet_3_tdc4m7.jpg', 1, 3),
(32, 'Luminous Garden', '', 12000.00, 55, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527227/4665b4d2ec0b4b236dbea1ebd68bfa70_gdlzuw.jpg', 1, 3),
(33, 'Elegant Harmony', '', 2500.00, 10, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527226/lily35b1-scaled_cevi14.jpg', 1, 3),
(34, 'Opulent Splendor', '', 3500.00, 25, 'https://res.cloudinary.com/dzvd6o0og/image/upload/v1725527224/34198900b2d5482ceef4fcceadec0985_uvgewp.jpg', 1, 3),
(35, 'Red Rose', 'rose stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723270009/flowers/lbxdapwfesoogo1tbi8s.png', 3, 11),
(36, 'White Rose', 'white rose stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723359130/flowers/whiterose.png', 3, 11),
(37, 'Red Tulip', 'red tulips stem', 70.00, 60, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723359191/flowers/ms9xtemytwlhyyhqeabb.png', 3, 11),
(38, 'Yellow Tulip', 'tulip stem', 70.00, 60, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723359199/flowers/yellowtulips.png', 3, 11),
(39, 'White Tulip', 'tulip stem', 70.00, 60, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723359203/flowers/whitetulips.png', 3, 11),
(40, 'Red Carnation', 'carnation stem', 70.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723880362/flowers/redcarnation.png', 3, 11),
(41, 'White Carnation', 'carnation stem', 70.00, 70, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723880362/flowers/stm3btzql1daz3mobly5.png', 3, 11),
(42, 'Pink Carnation', 'carnation stem', 70.00, 60, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723880363/flowers/vsu5tp0qduzpnt6c4wjd.png', 3, 11),
(43, 'White Lily', 'Lily stem', 60.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725817506/flowers/emj9un5g1kt7fwhh0ogx.png', 3, 11),
(44, 'Pink Lily', 'lily stem', 60.00, 90, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725820010/flowers/lily.png', 3, 11),
(45, 'Orange Dahlia', 'dahlia stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725824085/flowers/rttpojbctuub3nssek3n.png', 3, 11),
(46, 'White Dahlia', 'dahlia stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725824085/flowers/qvjekv39v4g04idwwyu8.png', 3, 11),
(47, 'Pink Dahlia', 'dahlia stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725824086/flowers/uywfmvp2mlxuonwgdesh.png', 3, 11),
(48, 'Violet Iris', 'iris stem', 70.00, 70, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725824294/flowers/j52tsqq0xfvt1z4kgzwe.png', 3, 11),
(49, 'Blue Iris', 'iris stem', 70.00, 80, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725824294/flowers/fjublfznvmpfabnxkhyu.png', 3, 11),
(50, 'Pink Hydrangea', 'hydrangea stem', 150.00, 40, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826061/flowers/imdgxzj7aakq1d4cpxso.png', 3, 11),
(51, 'Blue Hydrangea', 'hydrangea stem', 150.00, 40, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826067/flowers/h4v3aali5jdaw1qlhokj.png', 3, 11),
(52, 'Purple Anemone', 'anemone stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826062/flowers/y82usejj2ac2i90jldzc.png', 3, 11),
(53, 'Red Anemone', 'anemone stem', 100.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826753/flowers/voikv1769whr33lkm645.png', 3, 11),
(54, 'Lilac', 'lilac stem', 70.00, 70, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826744/flowers/wzqu2frxrdh8e4uiu6j2.png', 3, 11),
(55, 'Peach Peony', 'peony stem', 100.00, 60, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826062/flowers/jfmqz2y1dbifiulcvbdk.png', 3, 11),
(56, 'Pink Peony', 'peony stem', 100.00, 65, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1725826752/flowers/bvbnyqmudbkqh0bd5zjj.png', 3, 11),
(57, 'Sunflower', 'sunflower stem', 50.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1726073109/flowers/ms3vruapnyhspj8hbejv.png', 3, 11),
(58, 'Daisy', 'daisy stem', 30.00, 70, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727787473/flowers/jphjliisocba3y8jehxr.png', 3, 11),
(59, 'Simple Brown Wrapper', 'brown wrapper', 50.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1723359520/flowers/kjy5hmwbf14bxt0c4qox.png', 3, 9),
(60, 'Pixie Dream', 'hydrangea bday', 12000.00, 20, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509168/images/BIRTHDAYFLOWERS/br21gmyop5xo1f3ip4mo.jpg', 2, 5),
(61, 'Petal Poetry', 'birthday', 13000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509186/images/BIRTHDAYFLOWERS/rjiv8evs1l0tcafoavxf.jpg', 2, 5),
(62, 'Crimson Kiss', 'bday', 11000.00, 20, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509196/images/BIRTHDAYFLOWERS/b3ik1hj0ujq0ongymvgs.jpg', 2, 5),
(63, 'Blossom Granduer', 'bday', 10000.00, 30, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509294/images/BIRTHDAYFLOWERS/hyxfzseaxhtpjhn5talu.webp', 2, 5),
(64, 'Blushing Dreamscape', 'bday', 11500.00, 24, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509311/images/BIRTHDAYFLOWERS/xnksmff0umawglcuqwoz.jpg', 2, 5),
(65, 'Springtime Fantasy', 'bday', 12000.00, 12, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509319/images/BIRTHDAYFLOWERS/vryvirl13wmuilttqjos.jpg', 2, 5),
(66, 'Eternal Grace', 'Funeral Standing Spray', 20000.00, 15, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509696/images/funeralflowers/rcs671cxf0s3tum42ptn.jpg', 2, 7),
(67, 'Peaceful Memories', 'Funeral Flower Basket', 15000.00, 15, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509708/images/funeralflowers/p6qon6rrhko9vabucw3b.jpg', 2, 7),
(68, 'Timeless Piece', 'Funeral Flower Basket', 12000.00, 15, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509720/images/funeralflowers/my8nnikmjsccjnp7c7g1.jpg', 2, 7),
(69, 'Restful Blooms', 'Funeral Flower Basket', 12000.00, 15, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509731/images/funeralflowers/udnelilkmatzt2i0wenu.jpg', 2, 7),
(70, 'Farewell to you my friend', 'Funeral Flower Basket', 12000.00, 15, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509739/images/funeralflowers/tvxh5o7ft70gawoaodej.jpg', 2, 7),
(71, 'Heavenly Principles', 'Funeral Flower', 19000.00, 15, 'https://res.cloudinary.com/dogrgo15f/image/upload/v1725509745/images/funeralflowers/ss29acpkcf8liwc29tkf.jpg', 2, 7),
(79, 'Pink Wrapper', 'Wrapper', 60.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610828/flowers/idxv4n2mcsw7bd8gcqpm.png', 3, 9),
(80, 'Light Blue Wrapper', 'Wrapper', 50.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610826/flowers/kb6e8agzyunrp1hmxpyh.png', 3, 9),
(81, 'Deep Blue Wrapper', 'Wrapper', 50.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610826/flowers/h0ztnmomgqhj5pajrv2s.png', 3, 9),
(82, 'Deep Green Wrapper', 'Wrapper', 50.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610825/flowers/vpx3oioy2ic8egownobj.png', 3, 9),
(83, 'Orange Wrapper', 'Wrapper', 50.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610825/flowers/j5lrbbdugdw8zeu0qju3.png', 3, 9),
(84, 'Royal Blue Wrapper', 'Wrapper', 50.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610825/flowers/xryxglitkdjmrpv9sete.png', 3, 9),
(85, 'Chocolate Brown Wrapper', 'Wrapper', 50.00, 50, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610825/flowers/nyhg5w8slfqupthpsfo8.png', 3, 9),
(86, 'Blue Ruffled Ribbon', ' Ruffled Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727615490/flowers/fszxofh4syyb7d7busz4.png', 3, 10),
(87, 'Red Ruffle Ribbon', 'Ruffle Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610779/flowers/bynsoxifrfymlzk0iivt.png', 3, 10),
(88, 'Grey Bow', 'Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610777/flowers/tzpafyl4ullj2zqzeyac.png', 3, 10),
(89, 'Black-Pink Ruffle Ribbon', 'Ruffle Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610783/flowers/o4ofcv9epffcrilhkx0b.png', 3, 10),
(90, 'Barbie Pink Ribbon', 'Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610785/flowers/hfdlkhtyokgaurwoxexb.png', 3, 10),
(91, 'Short Black Bow', 'Bow Ribbbon', 30.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610784/flowers/hi1flpios13nk4mvsa7p.png', 3, 10),
(92, 'Short Red Bow', 'Bow Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610784/flowers/lakx4xuktwfx0olxoajk.png', 3, 10),
(93, 'Short Deep Red Bow', 'Ribbon', 40.00, 100, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1727610770/flowers/xwv2ivheclx1vyvcxyre.png', 3, 10),
(94, 'jab', 'jab', 1.00, 1, 'https://res.cloudinary.com/dsfcl09md/image/upload/v1728539458/drawings/ea06yhlqglojragpq7ag.jpg', 2, 7);

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
(6, 'Anniversary', 2),
(7, 'Funeral', 2),
(9, 'wrappers', 3),
(10, 'ribbons', 3),
(11, 'flower', 3);

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
(13, '', 'ss', 'sss', 'rrr'),
(14, 'louise', 'louise', 'louise', 'louise'),
(16, 'qqqq', 'qqqq', 'qqqq', 'qqqq'),
(17, 'new', 'new', 'new', 'new'),
(18, 'qq', 'qq', 'qq', 'qq'),
(20, 'bea', 'beicoleene', 'bea', 'bea'),
(21, 'jjj', 'jjj', 'jjj', 'jjj');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

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
