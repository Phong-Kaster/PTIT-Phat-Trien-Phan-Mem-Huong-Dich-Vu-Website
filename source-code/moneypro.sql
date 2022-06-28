-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2022 at 02:18 PM
-- Server version: 10.4.19-MariaDB-1:10.4.19+maria~bionic
-- PHP Version: 7.3.33-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneypro`
--

-- --------------------------------------------------------

--
-- Table structure for table `mp_accounts`
--

CREATE TABLE `mp_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` decimal(65,2) NOT NULL,
  `accountnumber` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_accounts`
--

INSERT INTO `mp_accounts` (`id`, `user_id`, `name`, `balance`, `accountnumber`, `description`, `created_at`, `updated_at`) VALUES
(81, 1, 'Prudential Bank', '12500065.00', '0312000076160000', 'Ngan Hang Trung Uong Viet Nam', '2022-05-12 15:52:04', '2022-05-18 09:39:24'),
(91, 88, 'hshshd', '21548.00', '1255', 'hdhdhd', '2022-05-17 21:00:00', '2022-05-17 21:00:00'),
(93, 1, 'BIDV', '20000.00', '3123123', 'Tài khoản ngân hàng BIDV', '2022-05-18 09:05:52', '2022-05-28 16:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `mp_budgets`
--

CREATE TABLE `mp_budgets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_budgets`
--

INSERT INTO `mp_budgets` (`id`, `user_id`, `category_id`, `amount`, `fromdate`, `todate`, `description`) VALUES
(1, 1, 20, '1500000.00', '2025-01-01', '2025-01-31', 'Tiết kiệm mua xe tăng hạng nhẹ T-34'),
(4, 1, 2, '125000.00', '2022-01-01', '2022-01-30', 'Tiền tiết kiệm mua xe tăng Thụy Điển EMIL 1951'),
(5, 1, 20, '23.00', '2022-02-10', '2022-02-12', 'Tiết kiệm mua xe tăng hạng nhẹ RU-215'),
(44, 80, 40, '50000.00', '2022-05-01', '2022-05-31', 'hâhha'),
(45, 80, 40, '50000.00', '2022-05-01', '2022-05-31', 'hâhha');

-- --------------------------------------------------------

--
-- Table structure for table `mp_categories`
--

CREATE TABLE `mp_categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mp_categories`
--

INSERT INTO `mp_categories` (`id`, `user_id`, `description`, `name`, `color`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Phương tiện chiến đấu bọc thép', 'Panzerkampfwagen', 'C5FF3F', 1, '2022-01-14 00:00:00', '2022-05-10 10:11:13'),
(2, 1, 'Xe tăng hạng nặng', 'Heavy Tank', '4C97FF', 1, '2022-01-15 10:22:27', '2022-03-31 23:55:08'),
(3, 1, 'Pháo tự hành chống tăng', 'Anti-tank destroyer', 'AE44FF', 1, '2022-01-15 10:22:46', '2022-05-12 19:55:28'),
(13, 1, 'Phương tiện chiến đấu bọc thép', 'Panzerkampfwagen', 'B92D5C', 2, '2022-02-07 11:42:57', '2022-04-06 07:53:36'),
(19, 1, 'A submarine is a ship capable of operation under-water', 'U-boat', '831100', 2, '2022-02-07 17:00:57', '2022-05-14 09:12:57'),
(20, 1, 'Pháo chống tăng', 'Tank Destroyer', '6CFF5B', 2, '2022-02-07 17:01:45', '2022-05-12 14:49:45'),
(40, 80, 'desfritio', 'test', '626000', 1, '2022-05-10 16:12:03', '2022-05-10 16:12:03'),
(52, 1, 'An aircraft carries is a war ship', 'Aircraft Carrier', '2E343F', 1, '2022-05-12 22:09:52', '2022-05-14 09:06:40'),
(53, 1, 'A submarine is a watercraft capable of independent operation under-water', 'Submarine', 'FF0000', 1, '2022-05-14 09:11:04', '2022-05-14 09:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `mp_general_data`
--

CREATE TABLE `mp_general_data` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mp_general_data`
--

INSERT INTO `mp_general_data` (`id`, `name`, `data`) VALUES
(1, 'settings', '{\"site_name\":\"Money Pro\",\"site_description\":\"Access to track daily expenses and manage your budgets from PC\\u2019s browsers. It\\u2019s super fast and convenient, no installation required. Seamless experience across devices, from mobile app to computer.\",\"site_keywords\":\"money lover, money manager, budgeting app, personal finance management, expense tracker, money management web, budgeting web app\",\"currency\":\"\\u0111\",\"logomark\":\"https:\\/\\/timeswriter.xyz\\/assets\\/uploads\\/images\\/logo.png\",\"logotype\":\"https:\\/\\/timeswriter.xyz\\/assets\\/uploads\\/images\\/logo.png\",\"site_slogan\":\"Your personal finance manager on browser\",\"language\":\"vi-VN\"}'),
(2, 'integrations', '{\"analytics\":{\"property_id\":\"\"}}'),
(3, 'smtp', '{\"host\":\"smtp.gmail.com\",\"port\":\"587\",\"encryption\":\"tls\",\"auth\":true,\"username\":\"mailservernoreply01@gmail.com\",\"password\":\"def5020022892c589c95c51e6c350e6e013c18922149e0c5b81c06f520ececf34dacffcbee6030f4b3bd77a667bd3b7c998b20f6f2057cf3ab8c0c95ae516ff6fbf4d4591130b52c5effab99a1b3bea5acea39287b6d4ef5fb0a2ab904a61ac0\",\"from\":\"mailservernoreply01@gmail.com\"}');

-- --------------------------------------------------------

--
-- Table structure for table `mp_goals`
--

CREATE TABLE `mp_goals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `deadline` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_goals`
--

INSERT INTO `mp_goals` (`id`, `user_id`, `name`, `balance`, `amount`, `deposit`, `deadline`, `status`) VALUES
(1, 1, 'Mua pháo', '10000.00', '2000000.00', '23341.00', '2022-05-29', 1),
(2, 1, 'Mua xe tăng chiến đấu chủ lực Type 71', '19000000.00', '535000.00', '12302246.00', '2022-01-31', 2),
(21, 1, 'Nghiên cứu modules E-100', '82000.00', '259000.00', '761.00', '2022-05-28', 1),
(22, 1, 'Chi phí lắp ráp E-100', '20242.00', '6100000.00', '0.00', '2022-05-30', 1),
(24, 1, 'Test', '456123.00', '123123.00', '0.00', '2022-05-30', 2),
(25, 1, 'Mua nhà sửa', '10000.00', '100000.00', '0.00', '2022-02-28', 1),
(26, 1, 'Test2', '12.00', '123.00', '110.00', '2022-05-30', 1),
(28, 1, 'Test', '123456.00', '123.00', '0.00', '2022-05-30', 2),
(36, 1, 'Mua nhà 2', '10000.00', '100000.00', '999.00', '2022-05-30', 1),
(37, 1, 'TestTest', '12345.00', '123.00', '0.00', '2022-05-30', 2),
(44, 1, 'Complete target', '100000.00', '100000.00', '0.00', '2022-05-14', 2),
(46, 1, 'Mua 1 suat Hadilao', '100000.00', '500000.00', '150184.00', '2022-05-15', 1),
(50, 1, 'outdated target', '400000.00', '1000000.00', '0.00', '2022-05-13', 3),
(55, 1, 'Test', '1.00', '10000000.00', '0.00', '2022-05-30', 1),
(56, 1, 'Test format', '10000000.00', '10000000.00', '0.00', '2022-05-31', 2),
(57, 1, 'Test limit', '99999999.00', '99999999.00', '0.00', '2022-05-23', 2),
(59, 1, 'Mua nhà 456', '10000.00', '100000.00', '0.00', '2022-05-30', 1),
(60, 1, 'hsh', '67.00', '6679.00', '0.00', '2022-05-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mp_notifications`
--

CREATE TABLE `mp_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_notifications`
--

INSERT INTO `mp_notifications` (`id`, `user_id`, `title`, `content`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mục tiêu hết hạn', 'Mục tiêu đã hết hạn', 1, '2022-05-15 00:00:00', '2022-05-15 00:00:00'),
(2, 1, 'Mục tiêu sắp hết hạn', 'Mục tiêu sắp hết hạn', 1, '2022-05-15 00:00:00', '2022-05-15 00:00:00'),
(3, 1, 'Mục tiêu đã hoàn thành', 'Bạn đã hoàn thành mục tiêu', 1, '2022-05-15 00:00:00', '2022-05-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mp_transactions`
--

CREATE TABLE `mp_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `transactiondate` date NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_transactions`
--

INSERT INTO `mp_transactions` (`id`, `user_id`, `category_id`, `account_id`, `name`, `amount`, `reference`, `transactiondate`, `type`, `description`) VALUES
(213, 1, 2, 81, 'Bán Air Blade', '2500.00', 'Việt Nam', '2022-06-04', 1, 'Bán xe máy Honda Airblade'),
(214, 1, 20, 81, 'E-100: Nâng cấp pháo', '150.00', 'Việt Nam', '2022-05-15', 2, 'Nâng cấp lên pháo 140mm'),
(216, 1, 53, 81, 'Lương tháng', '200000.00', 'VietNam', '2022-06-04', 1, ''),
(217, 1, 20, 81, 'Đổ xăng', '30000.00', 'Petrolimex', '2022-05-18', 2, 'Đổ xăng'),
(219, 1, 19, 81, 'Đổ xăng', '75000.00', 'Petrolimex', '2022-06-04', 2, 'Đổ 2.7 lít xăng RON-92 giá 75 nghìn'),
(220, 1, 13, 81, 'Nước giải khát StrongBow', '47000.00', 'Coca-Cola', '2022-06-04', 2, 'Nước giải khát StrongBow chai'),
(221, 1, 53, 81, 'Nhận lương', '10000000.00', 'VN', '2022-06-04', 1, 'Lương'),
(222, 1, 19, 81, 'Đóng tiền', '1000000.00', 'VN', '2022-06-04', 2, 'Hóa đơn'),
(223, 1, 1, 81, 'Ăn sáng', '15000.00', 'Vietnam', '2022-06-04', 1, ''),
(224, 1, 53, 93, 'abc', '250.00', 'Vietnam', '2022-06-04', 1, 'fhk'),
(225, 1, 1, 81, 'Mauschen', '50000.00', 'Soviet', '2022-05-08', 1, 'Bán xe giá 50.000 bạc');

-- --------------------------------------------------------

--
-- Table structure for table `mp_users`
--

CREATE TABLE `mp_users` (
  `id` int(11) NOT NULL,
  `account_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mp_users`
--

INSERT INTO `mp_users` (`id`, `account_type`, `email`, `password`, `firstname`, `lastname`, `is_active`, `date`, `secret`, `avatar`, `data`, `language`) VALUES
(1, 'admin', '00xshen00@gmail.com', '$2y$10$d8ycN183bswLeHzGrwbwv.8abhV4H.Dyodnihmk5Mcf3uG3ccrzhW', 'Johnny', 'Depp', 1, '2022-01-13 04:16:59', '3AB4XDKFZCMB4KSDSNZU7B3GTNQYUL723F6JE4U5HQZOK3CVO34QDGZQ4IFAE23K5IZYZR3H6KFBEGI7DONVWVDLKOGEWIPUM5INIUI', 'avatar_user_1.jpg', '{}', 'vi-VN'),
(77, 'admin', 'phongkaster@gmail.com', '$2y$10$Zhbzk/rLRdxJUIFQIlz6BOOGjkk.eNWDc9SOAhQ.AyPSar1uqhrmO', 'ph', 'ong', 1, '2022-04-21 20:26:34', '', '', '{}', 'vi-VN'),
(78, 'member', '123123@gmail.com', '$2y$10$6JtEjoj58Bat4hxCC0HBwe4S48YrPtua/QE.dQs9tj7dKz99H5z4a', '123', '123', 0, '2022-04-27 22:34:15', '', '', '{}', 'vi-VN'),
(79, 'member', 'dinhkhang151@gmail.com', '$2y$10$Imx2giuXTglw06G7Z/.k9uVI8ERdxtrbltCLaf8rcxZNMDrIG4yaK', 'Khang', 'Nguyen', 0, '2022-04-30 11:04:06', '', '', '{}', 'vi-VN'),
(80, 'member', 'dinhkhang1511@gmail.com', '$2y$10$7vm77adaKloHhmHlgnqLgOGP..dV4xIU3wedsxM6vMOGVV9N3m7ly', 'Khang', 'Luong', 1, '2022-05-03 18:03:43', 'T55FLKKGHRULTJSUIEJ6MYGY5BB7KBFS23OV4FSNB7Z45QG5OOPDRB7NHLJHWFAEY26G34IIXRZUNRWMMZGMUII5X23BYQTINDKZ3QQ', '', '{\"recoveryhash\":\"f1d68567b75cd4810acfd6a7db06915e282d6619\"}', 'vi-VN'),
(81, 'member', 'fqwfqwf@gmail.com', '$2y$10$uUUyaXcnwc08ThUDqso4Nu5MxROsDhdOWzpGD2hte59DJ5i4T8l8S', 'dwqfqfwqf', 'qwfqwfqwf', 0, '2022-05-12 13:01:29', '', '6273a92488d5b.png', '{}', 'vi-VN'),
(82, 'member', 'fewvwvwef@gmail.com', '$2y$10$lFSqjMrVRHuVqcPeGMfice3EN1JBLsRHPZwEIWUmRVo.9QilcvxGi', 'wvwevwe', 'vwevwevew', 1, '2022-05-12 13:02:32', '', '6273a92488d5b.png', '{}', 'vi-VN'),
(86, 'member', 'qesxrhuxiov@hotmail.com', '$2y$10$dyPgaLlAineI4yuITUHDiu6T/YbBQjU2JacdNtRtfwFUPjn.9UwC2', 'Ngọc', 'Thanh', 1, '2022-05-14 11:14:16', '', '627f2c97caf34.jpeg', '{}', 'vi-VN'),
(87, 'member', 'taollao201@gmail.com', '$2y$10$N7FbdjNdkhrFPZRwuqNdtuL3N.DfTirgsC.l/sfSWgmT7VK0/.9ES', 'Nhà Thuốc Lương Y', 'Lý Thị Thu Hà', 1, '2022-05-14 11:20:15', '', '627f2dff92398.png', '{}', 'vi-VN'),
(88, 'member', 'open_rhiqozl_user@tfbnw.net', '$2y$10$w9qX9zSJtpW9upc.bCoOs.tzHlJjHvlL0s9BKGI3mFZhNg0wsiWRC', 'Open', 'User', 1, '2022-05-17 20:51:37', '', '6283a86942672.jpeg', '{}', 'vi-VN'),
(89, 'member', 'vipro47333@gmail.com', '$2y$10$2GLvrKsdFlsVTcH0ZMePpOPsO31IEBCVLyuli/x1ZfEj.AH0EdpIa', 'Tuyên', 'Thanh', 1, '2022-05-17 21:01:02', '', '6283aa9e7d4ea.png', '{}', 'en-US');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mp_accounts`
--
ALTER TABLE `mp_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accountnumber` (`accountnumber`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mp_budgets`
--
ALTER TABLE `mp_budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `mp_categories`
--
ALTER TABLE `mp_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_type_idx` (`user_id`,`type`) USING BTREE;

--
-- Indexes for table `mp_general_data`
--
ALTER TABLE `mp_general_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `mp_goals`
--
ALTER TABLE `mp_goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mp_notifications`
--
ALTER TABLE `mp_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mp_transactions`
--
ALTER TABLE `mp_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `type_user_id_transactiondate` (`type`,`user_id`,`transactiondate`) USING BTREE;

--
-- Indexes for table `mp_users`
--
ALTER TABLE `mp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mp_accounts`
--
ALTER TABLE `mp_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `mp_budgets`
--
ALTER TABLE `mp_budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `mp_categories`
--
ALTER TABLE `mp_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `mp_general_data`
--
ALTER TABLE `mp_general_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mp_goals`
--
ALTER TABLE `mp_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `mp_transactions`
--
ALTER TABLE `mp_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `mp_users`
--
ALTER TABLE `mp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mp_accounts`
--
ALTER TABLE `mp_accounts`
  ADD CONSTRAINT `mp_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_budgets`
--
ALTER TABLE `mp_budgets`
  ADD CONSTRAINT `mp_budgets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_budgets_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `mp_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_categories`
--
ALTER TABLE `mp_categories`
  ADD CONSTRAINT `mp_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_goals`
--
ALTER TABLE `mp_goals`
  ADD CONSTRAINT `mp_goals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_notifications`
--
ALTER TABLE `mp_notifications`
  ADD CONSTRAINT `mp_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mp_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `mp_transactions`
--
ALTER TABLE `mp_transactions`
  ADD CONSTRAINT `mp_transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `mp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_transactions_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `mp_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_transactions_ibfk_4` FOREIGN KEY (`account_id`) REFERENCES `mp_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
