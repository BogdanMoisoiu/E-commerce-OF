-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 02:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team-3-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `prod_dimensions` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `power_max` varchar(50) DEFAULT NULL,
  `power_source` varchar(50) DEFAULT NULL,
  `availability` tinyint(1) NOT NULL,
  `quantity_left` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `special_features` varchar(255) DEFAULT NULL,
  `style` varchar(50) DEFAULT NULL,
  `fk_brand_id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `discount` varchar(50) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `type`, `prod_dimensions`, `short_description`, `description`, `color`, `power_max`, `power_source`, `availability`, `quantity_left`, `material`, `special_features`, `style`, `fk_brand_id`, `picture`, `discount`, `approved`) VALUES
(5, 'Spitfire DC 72', 249.99, 'Ceiling Fan', '120 cm', 'The Spitfire DC Custom is a stunning ceiling fan that boasts a beautiful three bladed design and a variety of finish options to suit any room. Available in four different blade sizes, this fan can be customized to fit your space perfectly. Additionally, i', 'The Spitfire DC Custom is a strikingly beautiful ceiling fan that exudes elegance and sophistication. Its exquisite three-bladed design adds a touch of drama to any space, while its rich finish options allow you to customize it to suit your unique style. With options like Dark Bronze, Brushed Nickel, Matte Black, and Gloss White, you can choose the perfect finish to complement your home decor.  Available in a range of sizes, the Spitfire DC Custom can be purchased with a 64-inch, 72-inch, 84-inch, or 96-inch blade sweep, allowing you to select the perfect size for your room. The blades themselves are made from high-quality wood, which not only adds to the fan\'s visual appeal but helps to ensure its durability.  For added convenience and versatility, the Spitfire DC Custom also offers an optional LED light kit. This kit features the innovative Correlated Color Temperature (CCT) Select functionality, allowing you to adjust the color temperature of the light output to suit your preferences. Whether you prefer a cool, daylight-like glow or a warmer, more inviting ambiance, the Spitfire DC Custom can deliver.  Overall, the Spitfire DC Custom is a top-of-the-line ceiling fan that offers unbeatable style, functionality, and customization options. Whether you\'re looking to add a touch of glamour to your living room or create a comfortable and stylish environment in your bedroom, the Spitfire DC Custom is sure to exceed your expectations.', 'Brushed Nickel', '21 Watts', 'Cable', 1, 30, 'Wood', 'Remote Control, LED', 'modern', 2, 'fan5-644910b54266f.jpg', '0', 1),
(6, 'TriAire Custom Marine Grade', 549.99, 'Ceiling Fan', '72 cm', 'The TriAire Custom Marine Grade by OnlyFans is a versatile fan that can fit into any space and style. You can choose from eight different blade sweeps to create a custom look in your choice of finishes. This fan is suitable for both indoor and outdoor use', 'The TriAire Custom Marine Grade by OnlyFans is an exceptional blend of style and functionality. No matter what your interior or exterior design preferences are, this fan is made to perfectly match your taste. With eight different blade sweeps to choose from, the TriAire Custom allows you to configure it to fit any size of space that you have. Whether you prefer a classic or modern look, its Black, Dark Walnut, Matte White, Silver and Weathered Wood finishes will undoubtedly suit your aesthetic preferences.  Moreover, this fan is Wet Rated for indoor and outdoor use, so you don\'t have to worry about the weather or harsh climates. You can use it in any space, and it will keep you cool in the hot summer months. The TriAire Custom\'s quality and durability are unmatched, making it a reliable and long-lasting investment. Its robust structure makes it perfect for marine environments like yachts or beach houses with saline air exposure.  In summary, the TriAire Custom Marine Grade by OnlyFans is a versatile and customizable fan that perfectly fits any space or style. Its various blade sweeps and finishes, coupled with its indoor and outdoor usage capability, make it a reliable and functional addition to your home or business.', 'Matte Black', '17 Watts', 'Cable', 1, 10, 'Wood', 'water resistent', 'Classic', 2, 'bluefan-644913037998d.png', '0', 1),
(7, 'Smartweb Floor Fan', 19.15, 'Floor Fan', '125 cm', 'The Smartweb Floor Fan is a high-quality and efficient standing fan that comes equipped with multiple speed settings, oscillation functionality and a sleek design to provide a cool and comfortable environment during hot summer days.', 'The Smartweb Floor Fan is an innovative standing fan designed to offer exceptional performance and convenience. Made from durable materials, this fan is built to last and can withstand regular use while delivering optimal results. The Smartweb Floor Fan features an adjustable height, an oscillating head, and multiple speed settings that can be adjusted according to your preferences.  The oscillating feature allows the fan to rotate back and forth, ensuring that air is circulated evenly across the room, while the multiple speed settings ensure that you can tailor airflow to your needs. You can also adjust the angle of the fan head to direct the airflow in your preferred direction. Additionally, the Smartweb Floor Fan comes with a remote control, so you can easily adjust the settings without leaving your seat.  The Smartweb Floor Fan has a sleek and modern design that complements any home decor. The pedestal base ensures stability, while the adjustable height feature means you can place it in any room and adjust its height to suit your specific needs. The fan is also easy to assemble, making it a hassle-free addition to your home.  Overall, the Smartweb Floor Fan is a high-quality and efficient standing fan that offers excellent performance, convenience, and value for money. Whether you need to cool down during hot summer days or just want to improve the quality of air in your home, this fan is an investment you won\'t regret.', 'Brushed Nickel', '90 Watts', 'Cable', 1, 150, 'painted steel and plastic', 'Adjustable speed control, manual, tilt head', 'modern', 3, 'Floor-Fan-6449178dc4584.jpg', '0', 1),
(8, 'Folding Hand Fan Transparent Hand Fans Chiffon with Beautiful Fabric For Party Wedding Gift White', 10, 'Folding Fan', '30 cm', 'This folding hand fan is crafted with transparent chiffon fabric and adorned with a beautiful white pattern. Perfect for weddings and parties, this fan is a unique gift that adds a touch of elegance to any occasion.', 'Elevate your next event with this stunning folding hand fan made from delicate chiffon fabric and embellished with a beautiful white pattern. This fan is perfect for weddings, parties, and other special occasions where a touch of sophistication is required. Measuring approximately 30 cm when unfolded, it is the perfect size to keep you cool and comfortable on a hot summer day. The transparent chiffon fabric creates a soft and delicate effect, while the intricate pattern adds a unique touch of elegance. This fan is also lightweight and easy to carry, making it a practical addition to any purse or clutch. Its foldable design also allows for easy storage and portability. This hand fan is not only practical, but also a thoughtful gift for bridesmaids, guests, or anyone who appreciates a touch of beauty and sophistication. Add this beautiful fan to your wedding favors or party favors and create a lasting impression for your guests.', 'Gloss White', NULL, 'Just use your hands baby', 1, 50, 'Chiffon', 'water resistent', 'Classic', 4, 'fan10-644919b96fa7b.png', '0', 1),
(9, 'IRIS USA WOOZOO Air Circulator Fan', 34.99, 'Table Fan', '42 cm', 'The IRIS USA WOOZOO Air Circulator Fan is a small yet powerful fan designed to circulate air in any room. It features a compact and stylish design with three adjustable fan speeds to customize your air circulation needs.', 'The IRIS USA WOOZOO Air Circulator Fan is a versatile fan that can be used for a wide range of settings. Its compact size and sleek design make it a perfect fit for any room, whether it be a bedroom, living room, or office. The fan is designed with an innovative vortex technology that provides a strong, consistent airflow, making it an ideal choice for hot and stuffy rooms. With three adjustable fan speeds, you can easily customize the air circulation to your preference. The oscillating feature also ensures that the fan reaches every corner of the room. The IRIS USA WOOZOO fan is energy efficient, with low power consumption and a timer function that automatically shuts off after four hours. It comes with a removable front grille for easy cleaning and maintenance. Overall, the IRIS USA WOOZOO Air Circulator Fan is a reliable and powerful fan that provides a comfortable and refreshing environment in any room.', 'Dark Bronze', '72 Watts', 'battery, cable', 1, 40, 'plastic', 'timer function', 'modern', 3, 'fan15-64491b25698b5.png', '0.20', 1),
(10, 'JISULIFE Handheld Fan', 35.99, 'Handheld Fan', '30 cm', 'The JISULIFE Handheld Fan is a portable, rechargeable fan that can be held in the hand and used to cool down on hot days. It is compact and easy to carry around', 'The JISULIFE Handheld Fan is a powerful and lightweight fan that is perfect for keeping cool on hot summer days. It is rechargeable, which means you don\'t have to worry about replacing batteries. The fan has three speed settings, so you can adjust the airflow to your preference. It also has a built-in LED light, which can be used as a flashlight.\r\n\r\nThe JISULIFE Handheld Fan is compact and easy to carry around, making it the perfect companion for outdoor activities such as hiking, camping, or picnicking. It can also be used indoors, such as in the office, bedroom, or living room. The fan is made from high-quality materials and has a sleek, stylish design. It is available in a range of colors to suit your taste.\r\n\r\nOverall, the JISULIFE Handheld Fan is a versatile and convenient device that is ideal for keeping cool and comfortable wherever you go. It is easy to use, easy to carry, and provides reliable cooling power when you need it most.', 'Matte Black', '2000 milliamp_hours', 'battery', 1, 85, 'plastic', 'water resistent', 'modern', 2, 'fan14-64491cb1d3c96.jpg', '0.05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD76DD93D6` (`fk_brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD76DD93D6` FOREIGN KEY (`fk_brand_id`) REFERENCES `brand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
