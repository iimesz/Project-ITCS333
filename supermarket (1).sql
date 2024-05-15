-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 08:13 PM
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
  `Cname` varchar(255) NOT NULL,
  `image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Cid`, `Cname`, `image`) VALUES
(1, 'Fruits & vegetables', 'fv.jpg'),
(2, 'Choclates', 'chocolates.jpg'),
(3, 'Bakery', 'bakery.webp'),
(4, 'Tea & Coffe ', 'tea.webp'),
(5, 'Snacks', 'snack.jpg'),
(6, 'Canned Foods', 'canned.jpg');

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
(4, 'AliAhmed223', '2024-05-11', 'Order Placed'),
(5, 'AliAhmed223', '2024-05-14', 'Order Placed');

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
(6, 4, 6, 2),
(7, 5, 2, 2);

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
(2, 'Blueberry Morocco 125g', 0.89, 'Make a healthy and delicious addition to your meals with the Fresh blueberry. These blueberries offer a sweet taste and can be enjoyed by kids and adults alike. They are ideal for use at home or carrying outdoors. Blueberries can be eaten fresh or incorporated into a variety of dishes. It’s a unique and ideal addition to your weekly diet. We strive to ensure that the products are of a high standard of quality and meet the requirements of food safety. Our team constantly and carefully monitor what we have in stock to recognize the freshest items and to assure it’s of the best possible quality.\r\n', 9, 1, 'blueberry.jpg'),
(5, 'Galaxy Jewels Assortment Chocolate Box 900g\r\n', 8.215, 'Genuine taste and precious moments with Galaxy Jewels. Experience the miniatures crafted from smooth Galaxy chocolate with variants of flavors, ideal for sharing with friends and loved ones. The assorted chocolates cater to all taste buds, featuring rich pralines and classic chocolate filling combinations. Galaxy Jewels offers you a range of diverse flavors like Hazelnut, Milk Chocolate, Crispy, Mixed Nuts, and Caramel. Each Galaxy Jewels piece is meticulously wrapped, enhancing the luxurious experience of savoring these premium chocolates. Elevate ordinary evenings with a premium touch by unwinding with a Galaxy Jewels chocolate, making this chocolate assortment a decadent choice for diverse flavors and indulgent moments.', 8, 2, 'galaxy.jpg'),
(6, 'Nestle KitKat 2 Finger Milk Chocolate Wafer Bar Value Pack 8 pcs', 1, 'Nestle KitKat 2 Finger Milk Chocolate Wafer is made of delicious milk chocolate and extra crispy wafer that delights your taste buds. When you\'re looking to enjoy a quick snack, KitKat 4 Finger is your go-to choice. Its unique combination of textures and flavors makes it a delightful treat suitable for vegetarians.', 8, 2, 'kitkat.jpg'),
(7, 'Tomato 1kg', 0.54, 'The Tomatoes are full of minerals and vitamins that promote good health. In addition, these tomatoes are an excellent source of vitamin C that helps you maintain a balanced diet. With a slightly tart and sour taste, these tomatoes are ideal for adding to various dishes. You can add the Lulu Fresh tomatoes to savoury items, burgers, and snacks, meanwhile, they also make for a great salad option. You can have the tomato directly or pair it with other complementary veggies. They are freshly sourced from Saudi/Jordan that ensures safe and reliable consumption.', 15, 1, 'tomato.jpg'),
(8, 'Onion Big Bag', 1.3, 'Add a unique flavour to your everyday dishes with Fresh Onion. These onions provide a unique taste and texture. They are rich in fibre, antioxidants, vitamin C, potassium, and other nutrients that your body needs for maintaining proper overall health. These onions are carefully hand-picked from organic farms, finely sorted, and precisely packed, following the safety standards to deliver the healthiest and the best-tasting ones to you. We strive to ensure that the products are of a high standard of quality and meet the requirements of food safety. Our team constantly and carefully monitor what we have in stock to recognize the freshest items and to assure it\'s of the best possible quality. You can add them to soups, meats, guacamole, and baked dishes as seasoning agents. Thanks to the low-calorie contents, these onions make for an ideal addition to your diet.\r\n', 12, 1, 'onion.jpg'),
(9, 'Cucumber 1kg', 0.69, 'Forge ahead in your fitness journey by including delicious and healthy salads of Fresh Cucumbers. They have a high water content to take care of your hydration needs. In addition, the cucumbers contain a significant percentage of vitamins and minerals, making them one of the major food sources to support essential bodily functions. Implementing high-level agricultural expertise and well-established farming techniques, these cucumbers are cultivated in optimum conditions and selectively harvested for their superior quality and a good texture. They will work miracles for your health and enrich your lifestyle when involved in the regular diet. In addition, the cucumbers are known for their versatile application in the global food culture.', 14, 1, 'cucumber.jpg'),
(10, 'Apple Royal Gala USA 1 kg\r\n', 1.275, 'Curb the craving for nutritious diet food with the Fresh Royal Gala Apples. Sourced fresh from USA, these sweet, fine-textured, and aromatic fruit offer exceptional taste and texture with every bite. Moreover, these apples are filled with antioxidants and nutrients to satisfy the nutritional requirements of your body.', 10, 1, 'apple.jpg'),
(14, 'Maxwell House Smooth Blend Instant Coffee 47.5 g', 1.3, 'Give your mornings a refreshing start with the Maxwell House Soluble Coffee Smooth Blend. It is made from carefully sourced coffee beans to ensure the perfect taste and flavour in every sip. The delicious taste and refreshing aroma make this coffee stand out. It easily and quickly mixes with milk or water to give you a rich colour. It is sure to put you in a better mood instantly, no matter if it is day or night! You can relish a cup during late-night meetings, a perfect accompaniment while reading a book or for kick-starting the day in the right way.', 7, 4, 'maxwell.jpg'),
(15, 'Alicafe Classic 3in1 Regular Coffee 22 x 20 g', 1.56, 'Alicafe Classic 3 in 1 Regular Coffee 22 Sachets 440g', 5, 4, 'alicafe.jpg'),
(16, 'Lipton Yellow Label Black Tea 25 Teabags', 0.815, 'Lipton Black Tea has real tea leaves specially blended to enjoy hot or iced. Take a sip and let our tea brighten your day, uplift your mood and awaken you to what really matters.', 16, 4, 'lipton.jpg'),
(17, 'Luna Green Peas 284 g', 0.24, '', 7, 6, 'luna.jpg'),
(18, 'Libby\'s Baked Beans In Tomato Sauce 220 g', 0.31, '', 9, 6, 'libby.jpg'),
(19, 'California Garden Canned Peeled Fava Beans Secret Recipe 450 g', 0.455, 'Stock up your pantry with California Garden Canned Peeled Fava Beans Secret Recipe 450g. Our high quality fava beans are perfect for any meal occasion, delicious for breakfast, lunch or dinner. Some popular foul medammes recipes are Fava Bean Bessara, Fatteh or added to a fresh salad.  A healthy source of vitamins and fibre, essential for a balanced diet and lifestyle - in a quick and easy way.  California Garden has been providing high quality food products at great prices from 1980. A much loved brand in the Middle East providing freshly sealed canned food products, perfect for your family, home cooking recipes. Whether your recipe asks for fava beans, foul medammes, foul medames, foul madamas, ful medames or ful mudammas, California Garden has the highest quality canned Fava Beans for you. ', 4, 6, 'garden.jpg'),
(20, 'Lusine Sesame Seed Burger Bun 6 pcs', 0.4, '', 17, 3, 'lusine.jpg'),
(21, 'Lusine White Sliced Bread 600 g', 0.5, '', 17, 3, 'lusine2.jpg'),
(22, 'Lusine Cheese Puff 70 g\r\n', 0.2, 'Fresh croissant', 12, 3, 'lusine3.jpg'),
(23, '7 Days Croissant With Strawberry 55 g', 0.2, 'Fresh strawberry croissant', 8, 3, 'lusine4.jpg'),
(24, 'Cadbury Time Out Crunch Wafer 20.8 g', 0.1, 'Perfect for kicking back on the couch with. Tuck into layer upon layer of light textured crispy wafer and smooth cocoa filling, coated in Cadbury milk chocolate. Ahhh, that’s better isn’t it? And only 106 calories too! Made with sustainably sourced cocoa. Vegetarian friendly.', 20, 2, 'cadbury.jpg'),
(25, 'Skittles Smoothies Fruit And Yogurt Flavoured Chocolate 38 g\n', 0.275, 'ndulge your taste buds in the vibrant and fruity explosion of Skittles Smoothies Fruit and Yogurt Flavored Chocolate. This delightful 38g treat combines the iconic chewy texture of Skittles with the creamy goodness of yogurt, creating a unique and satisfying taste experience. Each piece is a burst of fruity flavors complemented by the smoothness of yogurt, making it a delightful and colorful snack for any occasion. The convenient and shareable pack ensures that you can enjoy this playful fusion of tastes wherever and whenever the craving strikes. Skittles Smoothies Fruit and Yogurt Flavored Chocolate are a fun and delicious twist on the classic candy that will leave you reaching for more.', 19, 2, 'skittles.jpg'),
(26, 'Ferrero Kinder Bueno 2 pcs', 0.3, 'Ferrero Kinder Bueno is made of creamy milk chocolate and luscious hazelnut filling. Each bite is a mouthful of rich flavors and crunchy texture, making it a blissful snack for any occasion.', 11, 2, 'kinder.jpg'),
(27, 'Basmah Bahrain Pufak Flamin Hot Flavour 14g', 0.05, 'The best chips made in Bharain', 14, 5, 'basmah.jpg'),
(28, 'Mega Potato Chips Chilli & Salsa 13g', 0.1, 'Made from carefully sourced potatoes to ensure optimum quality and taste; Rich in fresh chilli & salsa taste; Added no preservatives and artificial colors; Nitrogen packed for freshness; These much loved treats are fun to enjoy at lunch, as an after-school snack, or party refreshment; Made in Bahrain', 17, 5, 'mega.jpg');

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
  MODIFY `Cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
