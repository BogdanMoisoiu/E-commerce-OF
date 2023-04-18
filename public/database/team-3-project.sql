-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 11:23 AM
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
CREATE DATABASE IF NOT EXISTS `team-3-project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `team-3-project`;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
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
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `quantity_left` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `special_features` varchar(255) DEFAULT NULL,
  `style` varchar(50) DEFAULT NULL,
  `sale` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `phone_number` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `str_number_ap_number` varchar(10) NOT NULL,
  `post_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `date_of_birth`, `picture`, `phone_number`, `city`, `street`, `str_number_ap_number`, `post_code`) VALUES
(1, 'user@gmail.com', '[]', '$2y$13$RZ6fFVV3zF/rAAtvYa2RoO5fNGfhQXvFeZY8HLVTj0kzWXhbbmU6u', 'John', 'Doe', '1927-01-01', 'https://cdn.pixabay.com/photo/2016/01/08/18/48/kitten-1129026_960_720.png', '+436701231212', 'Vienna', 'Kettenbrükckengasse', '23/2/12', '1050'),
(2, 'user2@gmail.com', '[]', '$2y$13$SsCvcqYGrJRB9vhRkIqR2efpy5ADXdHxjOfELarLn5qgFdyms2LX6', 'Jane', 'Doe', '1940-06-01', 'https://cdn.pixabay.com/photo/2016/01/08/18/48/kitten-1129026_960_720.png', '+436701232222', 'Vienna', 'Kettenbrükckengasse', '23/2/12', '1050'),
(3, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$1kugxeUm7qPVEyqjoA3XWO1fyCGEPxc66X7bEpSaREwbjXCaS0ewG', 'James', 'Doe', '1981-10-01', 'https://cdn.pixabay.com/photo/2016/01/08/18/48/kitten-1129026_960_720.png', '+436701231222', 'Vienna', 'Kettenbrükckengasse', '23/2/12', '1050'),
(4, 'user3@gmail.com', '[\"BANNED\"]', '$2y$13$Gq48KAtpB3HmGOmBRNge8.BTQdJhSK.jFkBnO3lnDp.DA/AJnbgLW', 'Emily', 'Mill', '1937-05-01', 'https://cdn.pixabay.com/photo/2016/01/08/18/48/kitten-1129026_960_720.png', '+436701233212', 'Vienna', 'Kettenbrükckengasse', '23/2/12', '1050');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
