-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 09:09 PM
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
-- Database: `supermarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Cid` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Cid`, `Name`, `image`) VALUES
(1, 'Fruits & vegetables', 'fv.jpg'),
(2, 'Choclates', 'chocolates.jpg'),
(3, 'Bakery', 'bakery.webp'),
(4, 'Tea & Coffe ', 'tea.webp');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `Username`, `Date`, `Status`) VALUES
(2, 'AliAhmed223', '2024-05-08', 'Order Placed'),
(3, 'AliAhmed223', '2024-05-11', 'Order Placed'),
(4, 'AliAhmed223', '2024-05-11', 'Order Placed');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `orderid`, `pid`, `quantity`) VALUES
(1, 2, 2, 2),
(2, 2, 5, 1),
(3, 3, 1, 2),
(4, 3, 2, 2),
(5, 4, 5, 1),
(6, 4, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Pid` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Description` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Cid` int(12) NOT NULL,
  `Picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Pid`, `Name`, `Price`, `Description`, `Quantity`, `Cid`, `Picture`) VALUES
(1, 'Yemen Mango 1KG', 0.74, 'Sit back and savor the rich flavor with these Fresh Mango Kalbathoor Yemen. Enriched with natural sugars, carbohydrates and tons of other essential nutrients like multivitamins, these mangoes provide you with daily nutritional intake. The unique creamy texture with a mild aroma is sure to shake your taste buds at the right time. You can eat it raw, blend it for a yummy smoothie, add in the fruit salad, or use it as toppings on yoghurt, ice cream and more. These mangoes are carefully hand-picked from the organic farms, finely sorted, and precisely packed, following the safety standards to deliver the healthiest and the best-tasting mangoes to you.\r\n', 9, 1, 'mango.jpg'),
(2, 'Blueberry Morocco 125g', 0.89, 'Make a healthy and delicious addition to your meals with the Fresh blueberry. These blueberries offer a sweet taste and can be enjoyed by kids and adults alike. They are ideal for use at home or carrying outdoors. Blueberries can be eaten fresh or incorporated into a variety of dishes. It’s a unique and ideal addition to your weekly diet. We strive to ensure that the products are of a high standard of quality and meet the requirements of food safety. Our team constantly and carefully monitor what we have in stock to recognize the freshest items and to assure it’s of the best possible quality.\r\n', 11, 1, 'blueberry.jpg'),
(5, 'Galaxy Jewels Assortment Chocolate Box 900g\r\n', 8.215, 'Genuine taste and precious moments with Galaxy Jewels. Experience the miniatures crafted from smooth Galaxy chocolate with variants of flavors, ideal for sharing with friends and loved ones. The assorted chocolates cater to all taste buds, featuring rich pralines and classic chocolate filling combinations. Galaxy Jewels offers you a range of diverse flavors like Hazelnut, Milk Chocolate, Crispy, Mixed Nuts, and Caramel. Each Galaxy Jewels piece is meticulously wrapped, enhancing the luxurious experience of savoring these premium chocolates. Elevate ordinary evenings with a premium touch by unwinding with a Galaxy Jewels chocolate, making this chocolate assortment a decadent choice for diverse flavors and indulgent moments.', 8, 2, 'galaxy.jpg'),
(6, 'Nestle KitKat 2 Finger Milk Chocolate Wafer Bar Value Pack 8 pcs', 1, 'Nestle KitKat 2 Finger Milk Chocolate Wafer is made of delicious milk chocolate and extra crispy wafer that delights your taste buds. When you\'re looking to enjoy a quick snack, KitKat 4 Finger is your go-to choice. Its unique combination of textures and flavors makes it a delightful treat suitable for vegetarians.', 8, 2, 'kitkat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Uid` int(11) NOT NULL,
  `Username` varchar(80) NOT NULL,
  `Password` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `User-Type` varchar(20) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Uid`, `Username`, `Password`, `Fname`, `Lname`, `User-Type`, `Email`, `Contact`) VALUES
(1, 'AliAhmed223', 0, 'Ali', 'Ahmed', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Cid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`orderid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Pid`),
  ADD KEY `CT` (`Cid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK` FOREIGN KEY (`orderid`) REFERENCES `orders` (`Order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `CT` FOREIGN KEY (`Cid`) REFERENCES `category` (`Cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
