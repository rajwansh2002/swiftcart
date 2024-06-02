-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 01:12 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address_line_1`, `address_line_2`, `city`, `state`, `country`, `postal_code`, `created_at`) VALUES
(8, 1002, 'Swami Dayanand Marg', '', 'Gorakhpur', 'Uttar Pradesh', 'India', '273015', '2024-05-20 03:54:40'),
(9, 1003, 'Swami Dayanand Marg', '', 'Gorakhpur', 'Uttar Pradesh', 'India', '273015', '2024-05-20 05:23:02'),
(10, 1004, 'Raghav Nagar', '', 'Deoria', 'UP', 'India', '274001', '2024-05-22 07:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'T-Shirts', '0000-00-00 00:00:00'),
(2, 'Track-Pants', '0000-00-00 00:00:00'),
(3, 'Caps & Hats', '0000-00-00 00:00:00'),
(4, 'Eye-Wear', '0000-00-00 00:00:00'),
(5, 'Shoes', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`) VALUES
(1424, 1002, 23695.00, 'New', '2024-05-20 03:54:49'),
(1425, 1003, 19998.00, 'Delivered', '2024-05-20 05:23:10'),
(1426, 1004, 2098.00, 'Delivered', '2024-05-22 07:31:19'),
(1427, 1004, 1399.00, 'New', '2024-05-23 18:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(46, 35, 9, 3, 1222.00, '2024-05-18 01:09:43'),
(47, 35, 10, 3, 1210.00, '2024-05-18 01:09:43'),
(48, 35, 11, 5, 666.00, '2024-05-18 01:09:43'),
(49, 36, 9, 5, 1222.00, '2024-05-18 01:10:13'),
(50, 37, 9, 8, 1222.00, '2024-05-18 01:11:05'),
(51, 38, 9, 1, 1222.00, '2024-05-18 01:12:13'),
(52, 39, 9, 1, 1222.00, '2024-05-18 01:16:58'),
(53, 40, 9, 1, 1222.00, '2024-05-18 01:26:46'),
(54, 41, 9, 3, 1222.00, '2024-05-18 01:27:37'),
(55, 42, 9, 3, 1222.00, '2024-05-18 01:28:43'),
(56, 43, 9, 1, 1222.00, '2024-05-18 01:35:31'),
(57, 44, 9, 2, 1222.00, '2024-05-18 01:39:16'),
(58, 45, 9, 2, 1222.00, '2024-05-18 01:50:01'),
(59, 46, 9, 1, 1222.00, '2024-05-18 01:53:18'),
(60, 47, 10, 1, 1210.00, '2024-05-18 01:53:58'),
(61, 48, 11, 1, 666.00, '2024-05-18 01:54:41'),
(62, 49, 9, 1, 1222.00, '2024-05-18 02:40:05'),
(63, 50, 9, 1, 1222.00, '2024-05-18 02:40:56'),
(64, 51, 9, 1, 1222.00, '2024-05-18 02:41:28'),
(65, 52, 9, 3, 1222.00, '2024-05-18 02:44:09'),
(66, 53, 9, 3, 1222.00, '2024-05-18 02:45:00'),
(67, 54, 9, 2, 1222.00, '2024-05-18 05:32:30'),
(68, 54, 10, 2, 1210.00, '2024-05-18 05:32:30'),
(69, 55, 12, 1, 222.00, '2024-05-18 17:23:39'),
(70, 55, 10, 4, 1210.00, '2024-05-18 17:23:39'),
(71, 55, 9, 3, 1222.00, '2024-05-18 17:23:39'),
(72, 56, 13, 1, 1452.00, '2024-05-18 19:13:27'),
(73, 57, 10, 1, 1210.00, '2024-05-19 12:17:50'),
(74, 57, 13, 5, 1452.00, '2024-05-19 12:17:50'),
(75, 57, 14, 1, 2456.00, '2024-05-19 12:17:50'),
(76, 58, 61, 1, 3099.00, '2024-05-19 15:56:53'),
(77, 59, 28, 2, 299.00, '2024-05-19 23:44:00'),
(78, 59, 29, 2, 1399.00, '2024-05-19 23:44:00'),
(79, 59, 30, 1, 399.00, '2024-05-19 23:44:00'),
(80, 60, 28, 1, 299.00, '2024-05-19 23:49:22'),
(81, 1424, 28, 1, 299.00, '2024-05-20 03:54:49'),
(82, 1424, 38, 1, 999.00, '2024-05-20 03:54:49'),
(83, 1424, 19, 1, 899.00, '2024-05-20 03:54:49'),
(84, 1424, 55, 1, 2499.00, '2024-05-20 03:54:49'),
(85, 1424, 63, 1, 18999.00, '2024-05-20 03:54:49'),
(86, 1425, 27, 1, 999.00, '2024-05-20 05:23:10'),
(87, 1425, 63, 1, 18999.00, '2024-05-20 05:23:10'),
(88, 1426, 60, 1, 1799.00, '2024-05-22 07:31:19'),
(89, 1426, 28, 1, 299.00, '2024-05-22 07:31:19'),
(90, 1427, 29, 1, 1399.00, '2024-05-23 18:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`) VALUES
(17, 'CRICKET CAP DARK GREY', 'Our cricket passionate team has developed this cricket cap for you to play safely and comfortably outdoor under the sun.', 299.00, 'photo_9_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:03:05'),
(18, 'Ventilated Travel Cap', 'Our trekker team has designed this ventilated, compact and super lightweight trekking cap to accompany you on your outings in the mountains!', 599.00, 'photo_7_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:04:11'),
(19, 'Desert Trekking Cap', 'Our passionate team of desert trekking enthusiasts created this cap after a trek which alternated sandstorm and sun!', 899.00, 'photo_1_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:07:00'),
(20, 'Kids\' Cap - Printed Navy', 'Kids\' cotton cap for activities at home and school.', 399.00, 'photo_3_2024-05-19_19-55-37.jpg', 3, '2024-05-19 14:07:56'),
(21, 'Kids’ Trucker Cap', 'Our team, made up of parents of young hikers, developed this cap to protect your children from the sun on beautiful sunny days', 499.00, 'photo_5_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:09:08'),
(22, 'Kids\' Cap W500', 'A breathable, unisex, anti-UV cap for active kids.', 399.00, 'photo_1_2024-05-19_19-55-37.jpg', 3, '2024-05-19 14:11:11'),
(23, 'CRICKET HAT BLUE', 'Our cricket passionate team has developed this cricket hat for you to play safely and comfortably outdoor under the sun.', 599.00, 'photo_4_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:15:29'),
(24, 'Trekking Hat 100', '\r\nThis hat is designed to offer the best protection against the sun with its wide brim and anti-UV fabric.', 799.00, 'photo_2_2024-05-19_19-55-37.jpg', 3, '2024-05-19 14:16:34'),
(25, 'Men Trekking Hat', 'adventure seekers! Our team, who love trekking and hiking, has designed a hat that provides maximum sun protection but won\'t overheat you!', 999.00, 'photo_8_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:17:40'),
(26, 'Felt Hat 100', 'Designed for all types of wildlife watching in cool or cold weather. Warm and water repellent.', 1299.00, 'photo_10_2024-05-19_19-27-55.jpg', 3, '2024-05-19 14:18:27'),
(27, 'Men\'s Tennis T-Shirt', 'Our designers created this T-shirt for tennis players looking for a breathable top they can wear year round.\r\n\r\n', 999.00, 'p2364128.avif', 1, '2024-05-19 14:40:18'),
(28, 'Men Running T-shirt', 'Men\'s breathable running T-shirt keeps you dry when running in hot weather.', 299.00, 'p2043080.avif', 1, '2024-05-19 14:42:10'),
(29, 'Men Hiking T-Shirt', 'At the foot of Mont Black, our team of enthusiasts designed this long-sleeved, moisture wicking t-shirt for regular mountain walking.', 1399.00, 'p1787595.avif', 1, '2024-05-19 14:43:44'),
(30, 'Men\'s Cotton Gym Tank', 'Great deal for high-quality, this tank top offers excellent freedom of movement. Perfect for looking stylish in the gym and beyond!', 399.00, 'p2073032.avif', 1, '2024-05-19 14:45:20'),
(31, 'Men Blend T-shirt', 'This comfy, stretchy, slim-fit T-shirt and its 180 g/m² fabric show your body at its best. You can easily wear it to exercise, or for everyday life.', 699.00, 'p1951220.avif', 1, '2024-05-19 14:46:59'),
(32, 'Men\'s Fitness T-Shirt', 'This printed crew neck sweatshirt, made from 190 g/m² fabric, is designed for both fitness classes and relaxing walks through town.', 699.00, 'p2672545.avif', 1, '2024-05-19 14:48:31'),
(33, 'Compression T-Shirt', 'Our design team of bodybuilding enthusiasts created this stringer tank top to keep you feeling at ease through all your workout movements.', 799.00, 'p2415521.avif', 1, '2024-05-19 14:49:27'),
(34, 'H.RDY POLO T-Shirt', 'Look and feel the part when you\'re on the court. Created for the adidas Club collection and ideal for hot days, this tennis polo shirt incorporates cooling HEAT.RDY and breathable mesh details. Its Free Lift design and underarm gussets ensure you stay confident through every serve and smash.\r\n\r\nMade with 100% recycled materials, this product represents just one of our solutions to help end plastic waste. Created for the adidas Club collection and ideal for hot days, this tennis polo shirt incorporates cooling HEAT', 3299.00, 'm16270158.avif', 1, '2024-05-19 14:53:31'),
(35, 'CLUBHOUSE TEE', 'This Product Has Been Made With Primegreen A Series Of High Performance Recycled Materials.', 2799.00, 'm16231374.avif', 1, '2024-05-19 14:56:16'),
(36, 'Football Jersey white', 'Our football product designers have created this responsibly designed Viralto football shirt for training sessions and matches up to three times a week.', 2699.00, 'm16086648.avif', 1, '2024-05-19 14:58:30'),
(37, 'Gym Trackpant', 'This breathable and quick dry trackpant is designed for any fitness activity - indoor or outdoor. It is equipped with two zip pockets and mesh for ventilation.', 799.00, 'p1724744.avif', 2, '2024-05-19 15:24:59'),
(38, 'Trackpant Grey', 'These soft, breathable, stretch fabric fitness bottoms provide comfort and freedom of movement while exercising and in everyday life. It has two zip pockets.', 999.00, 'p2273716.avif', 2, '2024-05-19 15:26:01'),
(39, 'Men Tennis Pant', 'Our design teams created these very light and breathable pants for tennis players.', 1199.00, 'p1775096.avif', 2, '2024-05-19 15:27:29'),
(40, 'Running Track Pant', 'This pair of running trousers provides good breathability and comfort while running or jogging.', 999.00, 'p1975268.avif', 2, '2024-05-19 15:28:54'),
(41, 'CRICKET TROUSERS', 'Our cricket passionate team has developed this sweat managing cricket white trouser for you to start practicing cricket comfortably under the sun.\r\n\r\n', 699.00, 'p2261749.avif', 2, '2024-05-19 15:29:57'),
(42, 'Convertible Cargo', 'The Mens NosiLife Convertible Pants from Craghoppers are a must-have for hot-climate travel. Their lightweight design and versatile zip-off legs allow you to adapt to changing temperatures effortlessly. With permanent protection against midges and mosquito.', 9000.00, 'm15692107.avif', 2, '2024-05-19 15:30:57'),
(43, 'Trackpant Grey', 'These 190 g/m² bottoms are the basic that you need right now.', 799.00, 'p2008017.avif', 2, '2024-05-19 15:32:07'),
(44, 'Insulated Pants', 'Synthetic insulated pant with PrimaLoft® Gold Insulation, Recycled Pertex® Quantum outer, Recycled 20D nylon inner and Recycled Pertex®Shield reinforcement panels. An ideal high Mountain pant for cold weather expeditions.', 12800.00, 'm15692355.avif', 2, '2024-05-19 15:33:19'),
(45, 'Trackpant Khaki', 'These joggers made from 305 g/m² fabric are timeless!', 1299.00, 'p2404974.avif', 2, '2024-05-19 15:34:49'),
(46, 'CTS 500 TROUSER', 'Our cricket passionate team has developed this sweat managing straight fit trouser for you to practice cricket comfortably under the sun.', 699.00, 'p2623242.avif', 2, '2024-05-19 15:35:57'),
(47, 'Hiking Sunglasses', 'Our optical engineers developed these sunglasses for hiking. Ideal for regular mountain use thanks to their lightness & support', 1499.00, 'p2579379.avif', 4, '2024-05-19 15:37:30'),
(48, 'Cycling Sunglasses', 'These MTB cycling sunglasses shield against sunlight, wind and splashes on occasional rides. The lenses are category 0, with a 100% UV protection filter.', 399.00, 'p1251708.avif', 4, '2024-05-19 15:38:37'),
(49, 'Cycling Sunglasses', 'Our engineers have designed these sunglasses with Category 3 100% anti-UV lenses for use in sunny weather.', 1399.00, 'p1675253.avif', 4, '2024-05-19 15:39:31'),
(50, 'Hiking Sunglasses', 'Outdoor activities in sunny weather, for children over the age of 10.', 799.00, 'p2579400.avif', 4, '2024-05-19 15:40:23'),
(51, 'Hiking Sunglasses', 'Our optical engineers developed these sunglasses for hiking. Ideal for regular mountain use thanks to their lightness & support.', 999.00, 'p2611370.avif', 4, '2024-05-19 15:41:09'),
(52, 'Cycling Glasses Perf', '3rd generation for these must-have glasses. This new version is defined by a more modern line with a wider screen and lighter weight.', 2799.00, 'p2448254.avif', 4, '2024-05-19 15:42:02'),
(53, 'Tifosi Swick Satin', 'LENS TECHNOLOGY ➤ Shatterproof polycarbonate lenses with 100% UVA / UVB protection from harmful UV Rays, ULTRA LIGHT FRAME ➤ Light only 26 grams and durable Grilamid TR90. Features integrated hinge which never pulls hair, hydrophilic nose pads for increase.', 4265.00, 'm15686035.avif', 4, '2024-05-19 15:43:10'),
(54, 'Polarised Sunglasses', 'Our designers have developed these glasses for sailing and nautical activities. Floating glasses with polarized category-3 lenses for 100% UV protection.', 1999.00, 'p2515488.avif', 4, '2024-05-19 15:44:15'),
(55, 'Sunglasses MH 900', 'Make the most of the mountains with these full-coverage category 4 sunglasses offering excellent quality of vision with high-definition lenses.\r\n\r\n', 2499.00, 'p2678469.avif', 4, '2024-05-19 15:45:00'),
(56, 'Tifosi Swank XL', 'Frame features integrated hinge which never pulls hair, hydrophilic nose pads for increased gripping, and Tifosi Glide technology allows the frame to slide on comfortably and provide a no-slip fit.', 2840.00, 'm15686283.avif', 4, '2024-05-19 15:46:08'),
(57, 'Men Running Shoes', 'These lightweight basic men\'s running shoes provide good cushioning and are comfortable for running up to 10 km per week.', 2299.00, 'p2155506.avif', 5, '2024-05-19 15:47:27'),
(58, 'Trekking Boots', 'letting you progress on trails with good support and hiking/trekking comfort.', 6999.00, 'p1692773.avif', 5, '2024-05-19 15:48:28'),
(59, 'Hiking Shoes', 'We designed these shoes for your occasional hikes. Essential to enjoy the mountains.', 4999.00, 'p1800776.avif', 5, '2024-05-19 15:49:12'),
(60, 'Hiking Shoes', 'Our hiking designers have created these NH100 Mid boots for your occasional hikes on the lowlands, in the forest or on the coast in dry weather.', 1799.00, 'p2164506.avif', 5, '2024-05-19 15:50:26'),
(61, 'Breathable Shoes', 'We designed these shoes to prevent the risk of injury and provide you with maximum sensation during your runs of up to 25km.', 3099.00, 'p2717156.avif', 5, '2024-05-19 15:51:21'),
(62, 'Running Shoes', 'Our design teams developed this men\'s running shoe to offer you a more natural stride and new sensations when running.\r\n\r\n', 5499.00, 'p2041615.avif', 5, '2024-05-19 15:52:22'),
(63, 'Marathon Shoes', 'Our design teams developed this lightweight and stable Unisex running shoe for running outings and racing up to marathon distance.\r\n\r\n', 18999.00, 'm15698156.avif', 5, '2024-05-19 16:01:33'),
(64, 'Shoes (Carbon Plate)', 'Our design teams developed these dynamic, lightweight and durable running shoes for performance in training and competition.', 14999.00, 'p2359428.avif', 5, '2024-05-19 16:02:42'),
(65, 'SUPERNOVA RISE ', 'These shoes are the solution for wide feet and can run comfortability for long-distance up to 21km.', 14999.00, 'm15685897.avif', 5, '2024-05-19 16:03:41'),
(66, 'Running Shoes', 'Lighter than ever Propulsive power, For the long haul.', 9599.00, 'm15691466.avif', 5, '2024-05-19 16:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `username`, `password`) VALUES
(11, 'admin', '$2y$10$V14cAguAkwQxVS.y8j9BPe7z9kcoBh1AdhEattIYIkPsLn6a6hSF2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1002, 'rajwansh', '$2y$10$AH/YyNWgckAWAjGOOd9V9etML5xBDIQNkERXDT/bS2MCI1nd5uHpy', 'rajwanshmodanwal@gmail.com', '2024-05-20 03:53:52'),
(1003, 'skd', '$2y$10$jnR7qKV.W4WjTApeKpk4ouU8TDBEaV61vHY3IuaQ//cVwwUoJn0ga', 'skd@gmail.com', '2024-05-20 05:22:17'),
(1004, 'nikhil', '$2y$10$M48purnUjt06uPZZb9R6fObaRCRPLDhKQJleltlPvQAp3WhYrpIZ.', 'nikhil@gmail.com', '2024-05-22 07:29:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1428;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
