-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 11:27 AM
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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `fk_author_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `fk_author_id`, `fk_product_id`, `rating`, `title`, `type`, `review`) VALUES
(18, 2, 8, 5, 'Perfect', 'review', 'Perfect size to carry it around and very elegant!'),
(19, 2, 7, NULL, NULL, 'question', 'How can I get a discount?'),
(20, 2, 7, 1, 'The Worst', 'review', 'This has got to be THE worst thing to come out since Adolf!!!'),
(21, 1, 9, 4, 'Amazing', 'review', 'I love it!'),
(22, 1, 6, NULL, NULL, 'question', 'How long is the battery duration?'),
(23, 3, 6, NULL, NULL, 'answer', 'it doesn´t have a battery. It´s connected with a cable.'),
(24, 7, 7, NULL, NULL, 'answer', 'Only our on sale products have a discount. For more informations, contact us!'),
(25, 2, 5, 2, 'Not my type', 'review', 'I don´t like the colors you can choose from, and it is kinda loud');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6970EB0F972C248B` (`fk_author_id`),
  ADD KEY `IDX_6970EB0FB5EAACC9` (`fk_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_6970EB0F972C248B` FOREIGN KEY (`fk_author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6970EB0FB5EAACC9` FOREIGN KEY (`fk_product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
