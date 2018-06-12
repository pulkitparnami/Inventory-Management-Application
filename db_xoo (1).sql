-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2016 at 03:35 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_xoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_attachments`
--

CREATE TABLE `admin_attachments` (
  `id` int(11) NOT NULL,
  `dealer_code` varchar(32) DEFAULT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_attachments`
--

INSERT INTO `admin_attachments` (`id`, `dealer_code`, `details`) VALUES
(50, NULL, '{"name":"desserts_2.jpg","title":"","alt":"","lastModified":"18th November 2016","dimensions":{"main":{"link":"http:\\/\\/localhost\\/Bitbucket\\/Xoorepo\\/website\\/uploads\\/desserts_2.jpg","width":"671","height":"381","size":59},"110X110":{"link":"http:\\/\\/localhost\\/Bitbucket\\/Xoorepo\\/website\\/uploads\\/110X110\\/desserts_2.jpg","width":"110","height":"110","size":4}}}'),
(51, NULL, '{"name":"front-1-1008x500.jpg","title":"","alt":"","lastModified":"18th November 2016","dimensions":{"main":{"link":"http:\\/\\/localhost\\/Bitbucket\\/Xoorepo\\/website\\/uploads\\/front-1-1008x500.jpg","width":"1008","height":"500","size":154},"110X110":{"link":"http:\\/\\/localhost\\/Bitbucket\\/Xoorepo\\/website\\/uploads\\/110X110\\/front-1-1008x500.jpg","width":"110","height":"110","size":6},"80X80":{"link":"http:\\/\\/localhost\\/Bitbucket\\/Xoorepo\\/website\\/uploads\\/80X80\\/front-1-1008x500.jpg","width":"80","height":"80","size":4}}}');

-- --------------------------------------------------------

--
-- Table structure for table `inventory98_xoo`
--

CREATE TABLE `inventory98_xoo` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL,
  `quantity` varchar(150) NOT NULL,
  `image` varchar(300) NOT NULL,
  `dealer_code` varchar(32) DEFAULT NULL,
  `pc_code` varchar(20) NOT NULL,
  `edited_time` datetime NOT NULL,
  `edited_quantity` varchar(150) NOT NULL,
  `location` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory98_xoo`
--

INSERT INTO `inventory98_xoo` (`id`, `category`, `quantity`, `image`, `dealer_code`, `pc_code`, `edited_time`, `edited_quantity`, `location`) VALUES
(114, 'wedding', '5124', 'placeholder.png', NULL, 'aaa', '2016-11-19 13:48:16', '', '{"first floor":"5000","basement":"124"}'),
(118, 'wedding', '0', 'placeholder.png', NULL, 'aabb', '2016-11-18 17:04:21', '', '[]'),
(124, 'wedding', '700', 'placeholder.png', '124', 'asdasd', '2016-11-19 15:05:59', '', '{"shop":"200","basement":"100","first floor":"400"}'),
(117, 'wedding', '124', 'placeholder.png', NULL, 'assss', '2016-11-18 16:34:38', '', '{"shop":"124"}'),
(109, 'wedding', '124', 'placeholder.png', 'asd', 'dfaf', '2016-11-18 16:22:43', '', '{"shop":"124"}'),
(113, 'wedding', '100', 'placeholder.png', '1', 'fghgh', '2016-11-18 16:24:52', '', '{"shop":"100"}'),
(122, 'wedding', '100', 'placeholder.png', '1000', 'new product', '2016-11-19 13:13:33', '', '{"shop":"100"}'),
(116, 'wedding', '100', 'placeholder.png', NULL, 'pass', '2016-11-18 16:34:10', '', '{"shop":"100"}'),
(123, 'wedding', '435', 'placeholder.png', NULL, 'pc1011', '2016-11-19 19:13:47', '', '{"home":"335","basement":"100"}'),
(101, 'wedding', '100', 'desserts_2.jpg', 'N-1001', 'PC_100', '2016-11-18 14:48:32', '', '{"shop":"100"}'),
(102, 'wedding', '0', 'front-1-1008x500.jpg', NULL, 'Pc_199', '2016-11-19 13:09:13', '', '[]'),
(120, 'wedding', '0', 'placeholder.png', NULL, 'ppp', '2016-11-19 13:12:25', '', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_changelog`
--

CREATE TABLE `inventory_changelog` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `pc_code` varchar(32) NOT NULL,
  `qty_edited` varchar(32) NOT NULL,
  `old_qty` varchar(32) NOT NULL,
  `new_qty` varchar(32) NOT NULL,
  `edited_by` varchar(32) NOT NULL,
  `edit_notes` varchar(500) NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_changelog`
--

INSERT INTO `inventory_changelog` (`id`, `image`, `pc_code`, `qty_edited`, `old_qty`, `new_qty`, `edited_by`, `edit_notes`, `edited_on`) VALUES
(242, 'desserts_2.jpg', 'PC_100', '-', '-', '100', 'pulkit', 'Product Added', '2016-11-18 14:47:02'),
(243, 'desserts_2.jpg', 'PC_100', '0', '100', '100', 'pulkit', 'Product Image updated.<br>', '2016-11-18 14:48:32'),
(244, 'front-1-1008x500.jpg', 'Pc_199', '-', '-', '0', 'pulkit', 'Product Added', '2016-11-18 14:50:14'),
(245, 'placeholder.png', 'dfaf', '-', '-', '124', 'pulkit', 'Product Added', '2016-11-18 16:22:43'),
(246, 'placeholder.png', 'fghgh', '-', '-', '100', 'pulkit', 'Product Added', '2016-11-18 16:24:52'),
(247, 'placeholder.png', 'aaa', '-', '-', '124', 'pulkit', 'Product Added', '2016-11-18 16:25:46'),
(248, 'placeholder.png', 'pass', '-', '-', '100', 'pulkit', 'Product Added', '2016-11-18 16:34:10'),
(249, 'placeholder.png', 'assss', '-', '-', '124', 'pulkit', 'Product Added', '2016-11-18 16:34:38'),
(250, 'placeholder.png', 'aabb', '-', '-', '0', 'pulkit', 'Product Added', '2016-11-18 16:40:25'),
(251, 'placeholder.png', 'aabb', '0', '0', '0', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-18 17:04:21'),
(252, 'front-1-1008x500.jpg', 'Pc_199', '0', '0', '0', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:09:14'),
(253, 'placeholder.png', 'ppp', '-', '-', '0', 'pulkit', 'Product Added', '2016-11-19 13:11:51'),
(254, 'placeholder.png', 'ppp', '0', '0', '0', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:12:26'),
(255, 'placeholder.png', 'new product', '-', '-', '0', 'pulkit', 'Product Added', '2016-11-19 13:13:06'),
(256, 'placeholder.png', 'new product', '500', '0', '500', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:13:30'),
(257, 'placeholder.png', 'new product', '-400', '500', '100', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:13:33'),
(258, 'placeholder.png', 'pc1011', '-', '-', '0', 'pulkit', 'Product Added', '2016-11-19 13:14:49'),
(259, 'placeholder.png', 'pc1011', '200', '0', '200', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:15:00'),
(260, 'placeholder.png', 'aaa', '124', '124', '248', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:27:48'),
(261, 'placeholder.png', 'aaa', '0', '248', '248', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:27:51'),
(262, 'placeholder.png', 'aaa', '0', '248', '248', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:28:00'),
(263, 'placeholder.png', 'aaa', '-124', '248', '124', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:28:04'),
(264, 'placeholder.png', 'aaa', '124', '124', '248', 'pulkit', 'Stock Location/Qty Updated.', '2016-11-19 13:28:22'),
(265, 'placeholder.png', 'aaa', '376', '248', '624', 'pulkit', 'Stock Location/Qty Updated.<br>Increased by -500 New Qty: 500Increased by -124 New Qty: 124', '2016-11-19 13:45:13'),
(266, 'placeholder.png', 'aaa', '4500', '624', '5124', 'pulkit', 'Stock Location/Qty Updated.<br>Increased by -5000 New Qty: 5000Increased by -124 New Qty: 124', '2016-11-19 13:48:16'),
(267, 'placeholder.png', 'asdasd', '-', '-', '100', 'pulkit', 'Product Added', '2016-11-19 13:50:03'),
(268, 'placeholder.png', 'asdasd', '400', '100', '500', 'pulkit', 'Stock Location/Qty Updated.<br>Increased by -500 New Qty: 500', '2016-11-19 13:50:32'),
(269, 'placeholder.png', 'asdasd', '-400', '500', '100', 'pulkit', 'Stock Location/Qty Updated.<br>Increased by -100 || New Qty: 100', '2016-11-19 13:51:33'),
(270, 'placeholder.png', 'asdasd', '400', '100', '500', 'pulkit', 'Stock Location/Qty Updated.<br>Increased by -400 || New Qty: 500', '2016-11-19 13:54:28'),
(271, 'placeholder.png', 'asdasd', '100', '500', '600', 'pulkit', 'Stock Location/Qty Updated.<br>Increased by 100 || New Qty: 600', '2016-11-19 13:56:31'),
(272, 'placeholder.png', 'asdasd', '600', '600', '1200', 'pulkit', 'basement || Increased by 600 || New Qty: 600', '2016-11-19 14:32:34'),
(273, 'placeholder.png', 'asdasd', '-1000', '1200', '200', 'pulkit', 'shop || Decreased by 500 || New Qty: 100basement || Decreased by 500 || New Qty: 100', '2016-11-19 14:32:47'),
(274, 'placeholder.png', 'asdasd', '400', '200', '600', 'pulkit', 'shop || Increased by 100 || New Qty: 200<br>basement || Increased by 100 || New Qty: 200<br>first floor || Increased by 200 || New Qty: 200<br>', '2016-11-19 14:33:22'),
(275, 'placeholder.png', 'asdasd', '-100', '600', '500', 'pulkit', 'first floor || Decreased by 100 || New Qty: 100<br>', '2016-11-19 14:37:43'),
(276, 'placeholder.png', 'asdasd', '300', '500', '800', 'pulkit', 'first floor <i class="fa fa-arrow-up" aria-hidden="true"></i> 300 || New Qty: 400<br>', '2016-11-19 14:37:55'),
(277, 'placeholder.png', 'asdasd', '0', '800', '800', 'pulkit', 'SHOP-100 <i class="fa fa-arrow-down" aria-hidden="true"></i> || New Qty: 100<br>BASEMENT-100 <i class="fa fa-arrow-up" aria-hidden="true"></i> || New Qty: 300<br>', '2016-11-19 15:02:06'),
(278, 'placeholder.png', 'asdasd', '-100', '800', '700', 'pulkit', 'SHOP- <i class="fa fa-arrow-up" aria-hidden="true"></i>100 || New Qty: 200<br>BASEMENT- <i class="fa fa-arrow-down" aria-hidden="true"></i>200 || New Qty: 100<br>', '2016-11-19 15:05:59'),
(279, 'placeholder.png', 'pc1011', '-100', '200', '100', 'pulkit', 'Order created<br>From: home = 50<br>From: basement = 50<br>', '2016-11-19 18:13:26'),
(280, 'placeholder.png', 'pc1011', '125', '100', '225', 'pulkit', 'Order created<br>From: home = 25<br>From: basement = 50<br>', '2016-11-19 18:19:19'),
(281, 'placeholder.png', 'pc1011', '-50', '225', '175', 'pulkit', 'Order created<br>From: home = 100<br>From: basement = 50<br>', '2016-11-19 18:21:25'),
(282, 'placeholder.png', 'pc1011', '40', '175', '215', 'pulkit', 'Order created<br>From: home = 10<br>From: basement = 50<br>', '2016-11-19 18:43:17'),
(283, 'placeholder.png', 'pc1011', '-450', '215', '-235', 'pulkit', 'Order created<br>From: home = 500<br>From: basement = 50<br>', '2016-11-19 18:56:33'),
(284, 'placeholder.png', 'pc1011', '0', '-235', '-235', 'pulkit', 'Order created<br>From: basement = 50<br>', '2016-11-19 18:57:05'),
(285, 'placeholder.png', 'pc1011', '670', '-235', '435', 'pulkit', 'HOME- <i class="fa fa-arrow-up" aria-hidden="true"></i>670 || New Qty: 335<br>', '2016-11-19 19:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_location`
--

CREATE TABLE `inventory_location` (
  `id` int(11) NOT NULL,
  `pc_code` varchar(32) NOT NULL,
  `location` varchar(32) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders98_xoo`
--

CREATE TABLE `orders98_xoo` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pc_code` varchar(32) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_qty` int(11) NOT NULL,
  `to_print` tinytext NOT NULL,
  `to_assemble` tinytext NOT NULL,
  `order_status` varchar(10) NOT NULL,
  `tracking_details` varchar(400) NOT NULL,
  `retr_location` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders98_xoo`
--

INSERT INTO `orders98_xoo` (`order_id`, `user_id`, `pc_code`, `order_date`, `order_qty`, `to_print`, `to_assemble`, `order_status`, `tracking_details`, `retr_location`) VALUES
(1, 36, 'pc1011', '2016-11-19 18:13:25', 50, 'true', 'true', '1', '{"1":"19-Nov-2016 06:13 pm","3":"","5":"","7":"","9":""}', '{"basement":"50"}');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `vendor_name` int(100) NOT NULL,
  `qty_ordered` int(11) NOT NULL,
  `qty_recieved` varchar(5000) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users98_xoo`
--

CREATE TABLE `users98_xoo` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `permission` varchar(1) NOT NULL,
  `date_added` varchar(32) NOT NULL,
  `mobile_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users98_xoo`
--

INSERT INTO `users98_xoo` (`id`, `first_name`, `last_name`, `email_id`, `password`, `permission`, `date_added`, `mobile_no`) VALUES
(35, 'pulkit', 'parnami', 'asda@gmail.com', '$2y$12$BXfX8O.XOV6Ys4z3.tlQnO.p9IxpuAXvpy6Dz59pAVRrHOsMG.6gi', '1', '2016-08-09 18:57:25', '8955126789'),
(36, 'Archit', 'Parnami', 'archit@gmail.com', '$2y$12$dbDZwZjSEZE5cKWG1A0WhOtcKnwdzwLxpSAbE06M9DyNIKbGV7HkG', '3', '19-11-2016 06:04:pm', '8955126780');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_address` varchar(500) NOT NULL,
  `vendor_city` varchar(50) NOT NULL,
  `vendor_info` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `vendor_address`, `vendor_city`, `vendor_info`) VALUES
(1, 'Nice cards pvt ltd.', '198-B gurunanak Pura raja park', 'Delhi', '198-B gurunanak Pura raja park'),
(2, 'Parnami', 'asdsadasd', 'Jaipur', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_attachments`
--
ALTER TABLE `admin_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory98_xoo`
--
ALTER TABLE `inventory98_xoo`
  ADD PRIMARY KEY (`pc_code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `dealer_code_2` (`dealer_code`),
  ADD KEY `dealer_code` (`dealer_code`),
  ADD KEY `image` (`image`),
  ADD KEY `id_2` (`id`),
  ADD KEY `pc_code` (`pc_code`);

--
-- Indexes for table `inventory_changelog`
--
ALTER TABLE `inventory_changelog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer_code` (`pc_code`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `inventory_location`
--
ALTER TABLE `inventory_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pc_code` (`pc_code`);

--
-- Indexes for table `orders98_xoo`
--
ALTER TABLE `orders98_xoo`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`),
  ADD KEY `product_id` (`pc_code`);

--
-- Indexes for table `users98_xoo`
--
ALTER TABLE `users98_xoo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_attachments`
--
ALTER TABLE `admin_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `inventory98_xoo`
--
ALTER TABLE `inventory98_xoo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `inventory_changelog`
--
ALTER TABLE `inventory_changelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
--
-- AUTO_INCREMENT for table `inventory_location`
--
ALTER TABLE `inventory_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders98_xoo`
--
ALTER TABLE `orders98_xoo`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users98_xoo`
--
ALTER TABLE `users98_xoo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_changelog`
--
ALTER TABLE `inventory_changelog`
  ADD CONSTRAINT `FK_inventory` FOREIGN KEY (`pc_code`) REFERENCES `inventory98_xoo` (`pc_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inventory_image` FOREIGN KEY (`image`) REFERENCES `inventory98_xoo` (`image`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_location`
--
ALTER TABLE `inventory_location`
  ADD CONSTRAINT `FK_pc_code` FOREIGN KEY (`pc_code`) REFERENCES `inventory98_xoo` (`pc_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders98_xoo`
--
ALTER TABLE `orders98_xoo`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`pc_code`) REFERENCES `inventory98_xoo` (`pc_code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users98_xoo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
