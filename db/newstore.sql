-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 07:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_product`
--

CREATE TABLE `activity_product` (
  `activityId` int(11) NOT NULL,
  `userId` longtext NOT NULL,
  `productId` longtext NOT NULL,
  `numberofvisit` longtext NOT NULL,
  `status` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_product`
--

INSERT INTO `activity_product` (`activityId`, `userId`, `productId`, `numberofvisit`, `status`) VALUES
(11, 'acc66ed97d206d08', 'prod-66edb54f95d7f', '2', 'active'),
(12, 'acc66ed97d206d08', 'prod-66edb48a371fe', '1', 'active'),
(13, 'acc68028899836c7', 'prod-66edb54f95d7f', '1', 'active'),
(14, 'acc66ed97d206d08', 'prod-68028ad3db8ee', '1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `cart_no` int(11) NOT NULL,
  `cartId` longtext NOT NULL,
  `productId` longtext NOT NULL,
  `price` longtext NOT NULL,
  `userId` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `salesId` longtext NOT NULL,
  `status` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`cart_no`, `cartId`, `productId`, `price`, `userId`, `quantity`, `salesId`, `status`) VALUES
(54, 'cart-680256248d4eb', 'prod-66edb48a371fe', '20000', 'acc66ed97d206d08', 1, 'sales_68025633642bd', 'success'),
(56, 'cart-680288b1b1eb1', 'prod-66edb54f95d7f', '10000', 'acc68028899836c7', 1, 'sales_680288e49f9b6', 'success'),
(57, 'cart-68028aeb6094a', 'prod-68028ad3db8ee', '40000', 'acc66ed97d206d08', 1, '', 'oncart');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deli_no` int(11) NOT NULL,
  `userId` longtext NOT NULL,
  `salesId` longtext NOT NULL,
  `code_now` longtext NOT NULL,
  `status` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deli_no`, `userId`, `salesId`, `code_now`, `status`) VALUES
(3, 'acc670e2ae3474ff', 'sales_680288e49f9b6', '680289a159be3', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `paymentnow`
--

CREATE TABLE `paymentnow` (
  `pay` int(11) NOT NULL,
  `salesId` longtext NOT NULL,
  `payMentGateWay` longtext NOT NULL,
  `paymentphpone` longtext NOT NULL,
  `status` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentnow`
--

INSERT INTO `paymentnow` (`pay`, `salesId`, `payMentGateWay`, `paymentphpone`, `status`) VALUES
(22, 'sales_68025633642bd', 'MOMO PAY', '0780733806', 'online'),
(23, 'sales_680288e49f9b6', 'MOMO PAY', '0780733806', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_no` int(11) NOT NULL,
  `productId` longtext NOT NULL,
  `product_name` longtext NOT NULL,
  `product_image` longtext NOT NULL,
  `product_size` longtext NOT NULL,
  `product_color` longtext NOT NULL,
  `product_description` longtext NOT NULL,
  `product_cover` longtext NOT NULL,
  `product_price` longtext NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `status` longtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_no`, `productId`, `product_name`, `product_image`, `product_size`, `product_color`, `product_description`, `product_cover`, `product_price`, `product_quantity`, `status`, `date_added`) VALUES
(1, 'prod-66edb48a371fe', 'Vetgetables Package', 'http://localhost/newstore/assets/product/images/prod-66edb48a371fe.jpg', 'XX Large', 'blue', 'Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Proin eget tortor risus.', '[\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66edb48a371fe_cover0.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66edb48a371fe_cover1.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66edb48a371fe_cover2.jpg\"]', '20000', 0, 'active', '2024-09-22 16:44:44'),
(2, 'prod-66edb54f95d7f', 'new onions', 'http://localhost/newstore/assets/product/images/prod-66edb54f95d7f.jpg', 'X Large', 'green', 'Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Proin eget tortor risus.', '[\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66edb54f95d7f_cover0.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66edb54f95d7f_cover1.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66edb54f95d7f_cover2.jpg\"]', '10000', -1, 'active', '2024-09-22 16:44:44'),
(3, 'prod-66fdcb35664b1', 'Nike Shoes', 'http://localhost/newstore/assets/product/images/prod-66fdcb35664b1.jpg', 'Large', 'Navy', 'thiss  kajdkajdk akdjakdjkajd adakdjakdjka dkajdkjakdjak ndkajdk', '[\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66fdcb35664b1_cover0.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66fdcb35664b1_cover1.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-66fdcb35664b1_cover2.jpg\"]', '5000', 1, 'active', '2024-10-02 22:37:41'),
(4, 'prod-670419f69f43e', 'Nike Shoes kj', 'http://localhost/newstore/assets/product/images/prod-670419f69f43e.jpg', 'X Large', 'Navy', 'kjkjkjjkjk jkjkj', '[\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-670419f69f43e_cover0.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-670419f69f43e_cover1.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-670419f69f43e_cover2.jpg\"]', '50000', 1, 'active', '2024-10-07 17:27:18'),
(5, 'prod-68028ad3db8ee', 'nike', 'http://localhost/newstore/assets/product/images/prod-68028ad3db8ee.jpg', 'XX Large', 'Navy', 'fjshfhsfhsfjhs  fhsfhsfs shfshfshfjs fushfusfjshfjhsj', '[\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-68028ad3db8ee_cover0.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-68028ad3db8ee_cover1.jpg\",\"http:\\/\\/localhost\\/newstore\\/assets\\/product\\/images\\/prod-68028ad3db8ee_cover2.jpg\"]', '40000', 1, 'active', '2025-04-18 17:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `salesId` longtext NOT NULL,
  `userId` longtext NOT NULL,
  `country` longtext NOT NULL,
  `address` longtext NOT NULL,
  `town` longtext NOT NULL,
  `state` longtext NOT NULL,
  `zip` longtext NOT NULL,
  `status` longtext NOT NULL,
  `dateadded` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `salesId`, `userId`, `country`, `address`, `town`, `state`, `zip`, `status`, `dateadded`) VALUES
(19, 'sales_68025633642bd', 'acc66ed97d206d08', 'Rwanda', 'kk 12', 'kigali', 'kigali', '00000', 'paid', '2025-04-18 15:40:03'),
(20, 'sales_680288e49f9b6', 'acc68028899836c7', 'Rwanda', 'kk 12', 'kigali', 'sasa', '00000', 'paid', '2025-04-18 19:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_no` int(11) NOT NULL,
  `userId` longtext NOT NULL,
  `first_name` longtext NOT NULL,
  `last_name` longtext NOT NULL,
  `email` longtext NOT NULL,
  `phonenumber` longtext NOT NULL,
  `passwords` longtext NOT NULL,
  `access` int(11) NOT NULL,
  `status` longtext NOT NULL,
  `profilepicture` longtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `userId`, `first_name`, `last_name`, `email`, `phonenumber`, `passwords`, `access`, `status`, `profilepicture`, `date_added`) VALUES
(7, 'acc66ed97d206d08', 'bizimana', 'king', 'szouckmen@gmail.com', '0780733806', 'b2086154f101464aab3328ba7e060deb', 1, 'online', '', '2024-09-22 16:45:52'),
(8, 'acc66ed98d3a53af', 'szoixm', 'sjska', 'b.kingsharoon@gmail.com', '0780733801', 'b2086154f101464aab3328ba7e060deb', 2, 'online', '', '2024-09-22 16:45:52'),
(9, 'acc66fdc8fa1fc3a', 'David', 'Niyomwungeri', 'jacky@gmail.com', '0788318707', 'b2086154f101464aab3328ba7e060deb', 2, 'online', '', '2024-10-02 22:28:10'),
(10, 'acc670e2ae3474ff', 'Bizimana', 'devierte', 'raissa@elohimhcs.com', '250788234198', 'b2086154f101464aab3328ba7e060deb', 3, 'online', '', '2024-10-15 08:42:11'),
(11, 'acc67d920ea71842', 'bizimana', 'sharoon', 'tonyjames.soft@gmail.com', '2507882341984', 'e10adc3949ba59abbe56e057f20f883e', 2, 'online', '', '2025-03-18 07:29:46'),
(12, 'acc68028899836c7', 'Ndayishimiye', 'Jean', 'jean@gmail.com', '0788888888', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'online', '', '2025-04-18 17:15:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_product`
--
ALTER TABLE `activity_product`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`cart_no`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deli_no`);

--
-- Indexes for table `paymentnow`
--
ALTER TABLE `paymentnow`
  ADD PRIMARY KEY (`pay`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_no`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_product`
--
ALTER TABLE `activity_product`
  MODIFY `activityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `cart_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deli_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentnow`
--
ALTER TABLE `paymentnow`
  MODIFY `pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
