-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 11:43 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tede_Shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address_userEmail` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_name` varchar(100) NOT NULL,
  `address_city` varchar(100) DEFAULT NULL,
  `address_street` varchar(100) DEFAULT NULL,
  `address_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Use, 1:wait'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_userEmail`, `address_name`, `address_city`, `address_street`, `address_status`) VALUES
(1, 'jane.smith@example.com', '1111', 'Tỉnh Quảng Bình', 'Nguyen Tri Phuong', 1),
(2, 'michael.lee@example.com', 'company', 'ádassa', 'ádasd', 0),
(3, 'emma.jones@example.com', 'Home', 'New York', '123 Main St', 0),
(9, 'ndt2201@gmail.com', 'Ha Van Tinh', 'TP Da Nang', '8', 1),
(10, 'jane.smith@example.com', 'home', 'Tỉnh Lạng Sơn', '15464356', 1),
(11, 'jane.smith@example.com', 'homeee', 'Tỉnh Vĩnh Phúc', '15464356', 1),
(12, 'maithy090@gmail.com', 'kkkk', 'Tỉnh Bắc Giang', '9', 1),
(13, 'khacduy584@gmail.com', 'duy', 'hoi an', 'nguyen tri phuong', 0),
(14, 'khacduy584@gmail.com', 'aaa', 'aaa', 'aa', 1),
(15, 'maithy2006@gmail.com', 'homeee123', '22', '9', 0),
(16, 'maithy123@gmail.com', 'khongbit5555', '26', '9', 0),
(17, 'maithy09082006@gmail.com', 'kkkk', '19', '9', 0),
(18, 'maithy123456789@gmail.com', 'khongbit', '1', '9', 0),
(19, 'maithybbb666@gmail.com', 'hhh', '30', '9', 0),
(21, 'tuancuong@gmail.com', 'rrrr', '44', 'xa Lien Truong huyen Quang Trach', 0),
(22, 'maithy09082001@gmail.com', 'khongbit', '25', '9', 0),
(23, 'nguyenvy01052005@gmail.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Thái Nguyên', '9', 1),
(24, 'nguyenvy01052005@gmail.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Lạng Sơn', '9', 1),
(25, 'nguyenvy01052005@gmail.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Lai Châu', '9', 1),
(26, 'nguyenvy01052005@gmail.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Sơn La', '9', 0),
(27, 'jane.smith@example.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Yên Bái', '9', 1),
(28, 'jane.smith@example.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Thái Nguyên', '9', 0),
(29, 'jane.smith@example.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Thái Nguyên', '9', 1),
(30, 'jane.smith@example.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Quảng Ninh', '9', 1),
(31, 'jane.smith@example.com', 'Nguyễn Trần Mai Thy', 'Tỉnh Thái Nguyên', '9', 1),
(48, 'jane.smith@example.com', 'Nguyễn Trần Hạnh Vy', 'Thành phố Đà Nẵng', '9', 1),
(49, 'Admin@gmail.com', 'DN', 'DN', 'DN', 0),
(50, 'maithy09082005@gmail.com', '111', 'Đà Nẵng', 'Trần Quang Khải', 0),
(51, 'maithy09082000@gmail.com', 'hhhhh', 'Tỉnh Hoà Bình', '9', 0),
(52, 'Admin@gmail.com', 'DN', 'DN', 'DN', 1),
(53, 'duynkps37404@fpt.edu.vn', 'Duy', 'Hoi An ', '30 Nguyen Tri Phuong', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `bill_var_id` varchar(50) NOT NULL,
  `bill_userEmail` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bill_phone` varchar(12) NOT NULL,
  `bill_address` int(11) NOT NULL,
  `bill_priceDelivery` int(11) NOT NULL,
  `bill_price` int(11) NOT NULL,
  `bill_totalPrice` int(11) NOT NULL,
  `bill_coupon` int(11) DEFAULT NULL,
  `bill_payment` tinyint(1) NOT NULL COMMENT '2Banking-3CreditCart-4Momo-ZaloPay-1Cash',
  `bill_status` tinyint(1) NOT NULL COMMENT '1 => ''Unpaid'', \r\n                                        2 => ''Paid'', \r\n                                        3 => ''Pending'', \r\n                                        4 => ''Approved'', \r\n                                        5 => ''Delivering'', \r\n                                        6 => ''Delivered'', \r\n                                        7 => ''Completed'', \r\n                                        8 => ''Archive'' ',
  `bill_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_var_id`, `bill_userEmail`, `bill_phone`, `bill_address`, `bill_priceDelivery`, `bill_price`, `bill_totalPrice`, `bill_coupon`, `bill_payment`, `bill_status`, `bill_time`) VALUES
(3, 'INV001', 'jane.smith@example.com', '', 1, 30000, 35990000, 36020000, 1, 1, 6, '2024-10-10 11:46:39'),
(4, 'INV002', 'emma.jones@example.com', '', 3, 30000, 24990000, 25020000, 1, 2, 6, '2024-11-10 11:46:39'),
(5, 'INV003', 'michael.lee@example.com', '', 2, 30000, 39990000, 40020000, 1, 0, 6, '2024-11-10 11:46:39'),
(9, '', 'ndt2201@gmail.com', '', 9, 3000, 10000, 1000000, 4, 3, 6, '2024-11-22 11:54:43'),
(11, 'BILL001', 'ndt2201@gmail.com', '', 1, 30000, 1000000, 1030000, 1, 1, 6, '2024-11-25 08:52:40'),
(12, 'BILL002', 'ndt2201@gmail.com', '', 1, 30000, 1000000, 1030000, 1, 1, 6, '2024-11-25 09:00:29'),
(13, '', 'ndt2201@gmail.com', '', 9, 1000, 100000, 0, 5, 1, 6, '2024-11-25 10:13:12'),
(14, 'TEXT', 'ndt2201@gmail.com', '', 9, 200000, 10000, 300000, 5, 1, 6, '2024-11-25 10:16:51'),
(15, 'tt', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 6, '2024-11-25 12:17:34'),
(16, 'ttt', 'ndt2201@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 6, '2024-11-25 12:29:46'),
(17, 'tet', 'ndt2201@gmail.com', '', 9, 200000, 10000, 1000000, 1, 0, 6, '2024-11-25 17:24:15'),
(18, 'cc', 'ndt2201@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 6, '2024-11-25 17:57:26'),
(19, 'txt', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 7, '2024-11-26 16:37:57'),
(20, 'tet xiu', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 7, '2024-11-26 16:48:48'),
(21, 't2', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 6, '2024-11-26 17:05:04'),
(22, 't3', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 6, '2024-11-26 17:23:38'),
(23, 't4', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 7, '2024-11-26 17:32:10'),
(24, 't5', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 7, '2024-11-26 17:46:21'),
(26, 't6', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 7, '2024-11-26 18:08:27'),
(27, 't7', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 8, '2024-11-26 18:51:00'),
(28, 't8', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 7, '2024-11-26 19:18:16'),
(29, 'hffhmvhvh', 'thanhndpd11083@gmail.com', '', 9, 200000, 10000, 1000000, 5, 0, 8, '2024-11-26 19:27:34'),
(30, 't10', 'ndt01@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 7, '2024-11-27 14:34:49'),
(31, 't11', 'ndt01@gmail.com', '', 9, 200000, 100000, 1000000, 2, 0, 8, '2024-11-27 14:37:37'),
(32, 't12', 'ndt01@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 8, '2024-11-27 14:54:56'),
(33, 't21', 'ndt01@gmail.com', '', 9, 22, 22, 33, 5, 0, 7, '2024-11-27 17:12:39'),
(34, 'ducthanh', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 7, '2024-11-29 14:57:02'),
(35, 'thanh', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 8, '2024-11-29 15:49:53'),
(36, 'txet', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 7, '2024-11-29 17:28:30'),
(37, 'xong', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 8, '2024-11-29 17:30:46'),
(38, 'tttt', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 8, '2024-11-29 17:32:18'),
(39, 'vyngu', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 3, 0, 7, '2024-12-02 09:03:51'),
(40, 'nguvy', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 3, 0, 8, '2024-12-02 09:18:31'),
(42, 'l', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 7, '2024-12-04 14:49:58'),
(43, 'i', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 7, '2024-12-04 14:52:28'),
(44, 'm', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 7, 0, 7, '2024-12-04 14:57:41'),
(45, 'n', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 7, 0, 7, '2024-12-04 17:32:19'),
(46, '', 'Admin@gmail.com', '', 9, 534, 43, 345, 1, 0, 7, '2024-12-04 21:05:05'),
(47, '', 'ndt2201@gmail.com', '', 9, 200000, 100000, 1000000, 5, 0, 7, '2024-12-04 21:19:10'),
(48, 'aaaaaaa', 'khacduy584@gmail.com', '', 13, 200000, 2000000, 2200000, 1, 0, 7, '2024-12-05 13:45:57'),
(53, 'Tede-kjhac duy-20241205172633', 'khacduy584@gmail.com', '22222', 13, 20000, 436820000, 432471800, 2, 2, 3, '2024-12-05 23:26:34'),
(55, 'Tede-kjhac duy-20241205173553', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 2, 3, '2024-12-05 23:35:53'),
(56, 'Tede-kjhac duy-20241205174753', 'khacduy584@gmail.com', '22222', 13, 20000, 436820000, 432471800, 2, 2, 3, '2024-12-05 23:47:54'),
(57, 'Tede-kjhac duy-20241206015903', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-06 07:59:03'),
(58, 'Tede-kjhac duy-20241206020003', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-06 08:00:03'),
(59, 'Tede-kjhac duy-20241206021330', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-06 08:13:30'),
(60, 'Tede-kjhac duy-20241206021821', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-06 08:18:21'),
(61, 'Tede-kjhac duy-20241206022111', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 1, 3, '2024-12-06 08:21:11'),
(62, 'Tede-kjhac duy-20241206022747', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-06 08:27:47'),
(63, 'Tede-kjhac duy-20241206023335', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 3, 3, '2024-12-06 08:33:35'),
(64, 'Tede-kjhac duy-20241206023749', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 4, 3, '2024-12-06 08:37:50'),
(65, 'Tede-kjhac duy-20241206030357', 'khacduy584@gmail.com', '22222', 13, 20000, 436820000, 432471800, 2, 1, 3, '2024-12-06 09:03:58'),
(66, 'Tede-kjhac duy-20241206041659', 'khacduy584@gmail.com', '22222', 13, 20000, 208910000, 206840900, 2, 3, 3, '2024-12-06 10:17:00'),
(67, 'Tede-kjhac duy-20241206043657', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 2, 3, '2024-12-06 10:36:57'),
(68, 'Tede-kjhac duy-20241206043802', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 2, 3, '2024-12-06 10:38:02'),
(69, 'Tede-kjhac duy-20241206044107', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 1, 3, '2024-12-06 10:41:08'),
(70, 'Tede-kjhac duy-20241206044330', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 4, 3, '2024-12-06 10:43:31'),
(71, 'Tede-kjhac duy-20241206045002', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 2, 3, '2024-12-06 10:50:03'),
(72, 'Tede-kjhac duy-20241206111504', 'khacduy584@gmail.com', '22222', 13, 20000, 328870000, 325601300, 2, 2, 3, '2024-12-06 17:15:07'),
(73, 'Tede-kjhac duy-20241207071326', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-07 13:13:26'),
(74, 'Tede-kjhac duy-20241207071531', 'khacduy584@gmail.com', '22222', 13, 20000, 263920000, 261300800, 2, 2, 3, '2024-12-07 13:15:30'),
(75, 'Tede-kjhac duy-20241207071849', 'khacduy584@gmail.com', '22222', 13, 20000, 208910000, 206840900, 2, 3, 3, '2024-12-07 13:18:48'),
(76, 'Tede-kjhac duy-20241207072327', 'khacduy584@gmail.com', '22222', 13, 20000, 208910000, 206840900, 2, 3, 3, '2024-12-07 13:23:27'),
(84, 'Tede-kjhac duy-20241208054458', 'khacduy584@gmail.com', '22222', 13, 20000, 107950000, 107970000, NULL, 1, 3, '2024-12-08 11:44:58'),
(85, 'Tede-kjhac duy-20241208135609', 'khacduy584@gmail.com', '22222', 13, 20000, 149950000, 149970000, NULL, 3, 3, '2024-12-08 19:56:10'),
(86, 'Tede-kjhac duy-20241208153920', 'khacduy584@gmail.com', '22222', 13, 20000, 492870000, 492890000, NULL, 2, 3, '2024-12-08 21:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `id_bill` int(11) NOT NULL,
  `bill_id` varchar(50) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`id_bill`, `bill_id`, `pro_id`, `pro_price`, `pro_count`) VALUES
(3, 'INV001', 6, 35990000, 1),
(4, 'INV002', 6, 24990000, 1),
(5, 'INV003', 9, 39990000, 3),
(9, 'BILL001', 7, 1000000, 1),
(11, 'BILL001', 6, 1000000, 1),
(12, 'BILL002', 11, 1000000, 1),
(13, '', 8, 1000000, 1),
(14, 'TEXT', 8, 1000000, 1),
(15, '15', 9, 10000000, 1),
(16, 'ttt', 9, 10000000, 1),
(17, 'tet', 8, 10000000, 1),
(18, 'cc', 8, 10000000, 1),
(19, 'txt', 8, 10000000, 1),
(20, 'tet xiu', 7, 10000000, 1),
(21, 't2', 7, 10000000, 1),
(22, 't2', 7, 10000000, 1),
(23, 't2', 6, 10000000, 1),
(24, 't2', 6, 10000000, 1),
(26, 't6', 6, 10000000, 1),
(27, 't7', 6, 10000000, 1),
(28, 't8', 6, 10000000, 1),
(29, 'hffhmvhvh', 6, 10000000, 1),
(30, 'hffhmvhvh', 6, 10000000, 1),
(31, 'hffhmvhvh', 6, 10000000, 1),
(32, 'hffhmvhvh', 7, 10000000, 1),
(33, 'tt', 7, 33, 20),
(34, 'hffhmvhvh', 6, 10000000, 1),
(35, 't', 7, 10000000, 1),
(36, 't', 7, 10000000, 1),
(37, 't', 8, 10000000, 1),
(38, 'tttt', 8, 10000000, 1),
(39, 'tttt', 12, 10000000, 1),
(40, 'tttt', 13, 10000000, 1),
(42, 'tttt', 7, 10000000, 1),
(43, 'tttt', 7, 10000000, 1),
(44, 'tttt', 7, 10000000, 1),
(45, 'tttt', 7, 10000000, 1),
(46, 'k', 12, 345, 1),
(47, 'tttt', 7, 10000000, 1),
(48, '', 9, 10000000, 1),
(53, 'Tede-kjhac duy-20241205172633', 22, 12990000, 5),
(55, 'Tede-kjhac duy-20241205173553', 22, 12990000, 5),
(62, 'Tede-kjhac duy-20241206022747', 6, 35990000, 4),
(62, 'Tede-kjhac duy-20241206022747', 7, 29990000, 4),
(63, 'Tede-kjhac duy-20241206023335', 6, 35990000, 4),
(63, 'Tede-kjhac duy-20241206023335', 7, 29990000, 4),
(64, 'Tede-kjhac duy-20241206023749', 6, 35990000, 4),
(64, 'Tede-kjhac duy-20241206023749', 7, 29990000, 4),
(65, 'Tede-kjhac duy-20241206030357', 22, 12990000, 5),
(65, 'Tede-kjhac duy-20241206030357', 6, 35990000, 4),
(65, 'Tede-kjhac duy-20241206030357', 7, 29990000, 4),
(65, 'Tede-kjhac duy-20241206030357', 13, 16990000, 4),
(65, 'Tede-kjhac duy-20241206030357', 23, 39990000, 1),
(66, 'Tede-kjhac duy-20241206041659', 22, 12990000, 5),
(66, 'Tede-kjhac duy-20241206041659', 6, 35990000, 4),
(68, 'Tede-kjhac duy-20241206043802', 22, 12990000, 5),
(68, 'Tede-kjhac duy-20241206043802', 6, 35990000, 4),
(68, 'Tede-kjhac duy-20241206043802', 7, 29990000, 4),
(69, 'Tede-kjhac duy-20241206044107', 22, 12990000, 5),
(69, 'Tede-kjhac duy-20241206044107', 6, 35990000, 4),
(69, 'Tede-kjhac duy-20241206044107', 7, 29990000, 4),
(71, 'Tede-kjhac duy-20241206045002', 22, 12990000, 5),
(71, 'Tede-kjhac duy-20241206045002', 6, 35990000, 4),
(71, 'Tede-kjhac duy-20241206045002', 7, 29990000, 4),
(72, 'Tede-kjhac duy-20241206111504', 22, 12990000, 5),
(72, 'Tede-kjhac duy-20241206111504', 6, 35990000, 4),
(72, 'Tede-kjhac duy-20241206111504', 7, 29990000, 4),
(73, 'Tede-kjhac duy-20241207071326', 6, 35990000, 4),
(73, 'Tede-kjhac duy-20241207071326', 7, 29990000, 4),
(74, 'Tede-kjhac duy-20241207071531', 6, 35990000, 4),
(74, 'Tede-kjhac duy-20241207071531', 7, 29990000, 4),
(75, 'Tede-kjhac duy-20241207071849', 22, 12990000, 5),
(75, 'Tede-kjhac duy-20241207071849', 6, 35990000, 4),
(76, 'Tede-kjhac duy-20241207072327', 22, 12990000, 5),
(76, 'Tede-kjhac duy-20241207072327', 6, 35990000, 4),
(84, 'Tede-kjhac duy-20241208054458', 13, 16990000, 4),
(84, 'Tede-kjhac duy-20241208054458', 23, 39990000, 1),
(85, 'Tede-kjhac duy-20241208135609', 7, 29990000, 4),
(85, 'Tede-kjhac duy-20241208135609', 21, 29990000, 1),
(86, 'Tede-kjhac duy-20241208153920', 8, 25990000, 1),
(86, 'Tede-kjhac duy-20241208153920', 18, 25990000, 1),
(86, 'Tede-kjhac duy-20241208153920', 23, 39990000, 10),
(86, 'Tede-kjhac duy-20241208153920', 17, 40990000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_image` varchar(200) NOT NULL,
  `blog_pro_id` int(11) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_view` int(10) NOT NULL,
  `author_email` varchar(50) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_image`, `blog_pro_id`, `blog_content`, `blog_view`, `author_email`, `active`) VALUES
(1, 'Laptop Dell XPS: Sự kết hợp giữa thiết kế cao cấp và hiệu năng mạnh mẽ.', '510.jpg', 6, '<p><span class=\"text-huge\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><i><strong>Máy Tính Dell: Sự Kết Hợp Hoàn Hảo Giữa Hiệu Năng và Độ Bền</strong></i></span></p><p><span class=\"text-huge\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Giới Thiệu</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell là một trong những thương hiệu hàng đầu trong ngành công nghệ máy tính với lịch sử hơn 35 năm phát triển. Từ máy tính cá nhân, laptop đến các dòng máy trạm chuyên nghiệp, Dell luôn giữ vững vị thế nhờ chất lượng sản phẩm, độ bền và hiệu năng ổn định.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Trong bài viết này, chúng ta sẽ tìm hiểu sâu hơn về các dòng sản phẩm máy tính Dell, lý do vì sao thương hiệu này lại nổi tiếng trên toàn cầu, và cách Dell đáp ứng nhu cầu đa dạng của người dùng từ cá nhân, doanh nghiệp nhỏ đến các tổ chức lớn.</span></p><p><span class=\"text-big\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>1. Lịch Sử Thương Hiệu Dell</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Thành lập vào năm 1984 bởi <strong>Michael Dell</strong>, thương hiệu này bắt đầu với mục tiêu đơn giản: cung cấp máy tính cá nhân chất lượng cao với giá cả phải chăng. Trải qua nhiều thập kỷ, Dell đã chuyển mình từ một nhà sản xuất máy tính cá nhân trở thành một công ty công nghệ toàn cầu, chuyên cung cấp giải pháp từ phần cứng đến dịch vụ IT.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell hiện nay nổi tiếng với việc áp dụng công nghệ hiện đại, thiết kế tinh tế và khả năng đáp ứng các yêu cầu chuyên biệt của khách hàng. Những dòng sản phẩm nổi bật của Dell bao gồm:</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Laptop Dell XPS</strong>: Sự kết hợp giữa thiết kế cao cấp và hiệu năng mạnh mẽ.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Dell Inspiron</strong>: Lựa chọn phổ biến cho người dùng cá nhân và sinh viên.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Dell Latitude</strong>: Laptop doanh nhân với độ bền và bảo mật tối ưu.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Máy tính để bàn Dell OptiPlex</strong>: Dành cho văn phòng và các tổ chức lớn.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Dell Alienware</strong>: Dòng máy tính chơi game hàng đầu thế giới.</span></p><p><span class=\"text-big\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>2. Các Dòng Sản Phẩm Dell Nổi Bật</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>2.1. Dell XPS: Biểu Tượng Của Sự Cao Cấp</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell XPS được xem là dòng sản phẩm cao cấp nhất của hãng, được thiết kế để cạnh tranh trực tiếp với các dòng máy tính cao cấp như MacBook Pro.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Thiết kế:</strong> Vỏ máy bằng nhôm nguyên khối, viền màn hình mỏng với công nghệ <strong>InfinityEdge</strong>.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Màn hình:</strong> Độ phân giải lên đến <strong>4K Ultra HD</strong> với khả năng hiển thị HDR sắc nét.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Hiệu năng:</strong> Chip Intel thế hệ mới nhất, RAM từ 16GB đến 64GB, SSD tốc độ cao.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Ứng dụng:</strong> Phù hợp cho người sáng tạo nội dung, lập trình viên và người dùng cần hiệu năng cao.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>2.2. Dell Inspiron: Phổ Thông Nhưng Đầy Tiện Ích</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Inspiron là dòng laptop phổ thông phù hợp với mọi đối tượng, từ học sinh, sinh viên đến người dùng gia đình.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Giá cả hợp lý:</strong> Inspiron được thiết kế với mục tiêu đáp ứng nhu cầu cơ bản nhưng vẫn đảm bảo hiệu năng ổn định.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Đa dạng cấu hình:</strong> Từ Intel Core i3 đến Core i7, đáp ứng các nhu cầu khác nhau như làm việc văn phòng, học tập hoặc giải trí.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Thiết kế hiện đại:</strong> Mỏng nhẹ và dễ mang theo.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>2.3. Dell Latitude: Dành Riêng Cho Doanh Nhân</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Latitude là dòng laptop được thiết kế dành riêng cho môi trường doanh nghiệp với độ bền cao, thời lượng pin lâu và các tính năng bảo mật tiên tiến.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Bảo mật:</strong> Hỗ trợ vPro, TPM 2.0, và nhận diện vân tay.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Độ bền:</strong> Đạt tiêu chuẩn quân đội MIL-STD 810G.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Kết nối:</strong> Đa dạng cổng kết nối, từ USB-C, HDMI đến Ethernet.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>2.4. Dell Alienware: Thiên Đường Của Game Thủ</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Alienware là dòng sản phẩm nổi tiếng dành cho các game thủ chuyên nghiệp. Đây là một trong những thương hiệu máy tính chơi game mạnh mẽ nhất thế giới.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Hiệu năng tối ưu:</strong> Trang bị GPU NVIDIA RTX mới nhất, bộ xử lý Intel và AMD cao cấp.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Hệ thống tản nhiệt:</strong> Công nghệ <strong>Cryo-Tech Cooling</strong>, giúp duy trì nhiệt độ thấp khi chơi game trong thời gian dài.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Thiết kế:</strong> Đèn RGB cá nhân hóa, mang đậm phong cách gaming.</span></p><p><span class=\"text-big\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>3. Ưu Điểm Của Máy Tính Dell</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>3.1. Độ Bền Vượt Trội</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Máy tính Dell nổi tiếng với độ bền cao, đặc biệt ở các dòng Latitude và OptiPlex. Những sản phẩm này thường trải qua các bài kiểm tra khắc nghiệt để đảm bảo hoạt động ổn định trong nhiều điều kiện môi trường.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>3.2. Hiệu Năng Ổn Định</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell liên tục cập nhật cấu hình với những công nghệ mới nhất. Từ dòng phổ thông đến cao cấp, máy tính Dell luôn mang lại trải nghiệm mượt mà và đáng tin cậy.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>3.3. Bảo Hành và Hỗ Trợ Khách Hàng</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell cung cấp các dịch vụ bảo hành linh hoạt, bao gồm <strong>ProSupport</strong> cho doanh nghiệp, với khả năng hỗ trợ kỹ thuật 24/7 và thay thế phần cứng nhanh chóng.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>3.4. Giá Cả Cạnh Tranh</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dù bạn cần một chiếc laptop giá rẻ hay máy tính cao cấp, Dell đều có sản phẩm phù hợp với ngân sách.</span></p><p><span class=\"text-big\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>4. Ứng Dụng Của Máy Tính Dell</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>4.1. Trong Công Việc</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Máy tính Dell Latitude và OptiPlex là lựa chọn lý tưởng cho doanh nghiệp nhờ tính năng bảo mật và độ ổn định cao.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>4.2. Trong Học Tập</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dòng Inspiron là bạn đồng hành của nhiều học sinh, sinh viên nhờ giá cả phải chăng và thiết kế nhẹ nhàng, phù hợp với việc di chuyển.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>4.3. Trong Sáng Tạo Nội Dung</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell XPS và Precision được các nhà sáng tạo nội dung, như designer và video editor, đánh giá cao nhờ hiệu năng mạnh mẽ và màn hình hiển thị chân thực.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>4.4. Trong Giải Trí và Gaming</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell Alienware là lựa chọn không thể thiếu cho game thủ với khả năng xử lý đồ họa và tốc độ vượt trội.</span></p><p><span class=\"text-big\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>5. Những Cải Tiến Đáng Mong Đợi Trong Tương Lai</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Dell không ngừng đổi mới và hứa hẹn sẽ mang đến nhiều công nghệ tiên tiến trong các sản phẩm sắp tới:</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Màn hình OLED với tốc độ làm mới cao hơn.</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Chip xử lý AI tích hợp.</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Cải tiến hệ thống tản nhiệt.</strong></span></p><p><span class=\"text-big\" style=\"color:hsl(30,75%,60%);font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>6. Kết Luận</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Máy tính Dell đã khẳng định vị trí của mình trên thị trường công nghệ nhờ chất lượng vượt trội, hiệu năng ổn định và giá trị xứng đáng với mức đầu tư. Từ người dùng phổ thông đến doanh nghiệp và game thủ, Dell luôn có sản phẩm phù hợp với mọi nhu cầu.</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\">Nếu bạn đang tìm kiếm một chiếc máy tính đáng tin cậy, Dell chắc chắn là cái tên không thể bỏ qua. Hãy chia sẻ ý kiến của bạn về dòng sản phẩm Dell mà bạn yêu thích nhất ở phần bình luận nhé!</span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>Hashtag:</strong></span></p><p><span class=\"text-big\" style=\"font-family:\'Trebuchet MS\', Helvetica, sans-serif;\"><strong>#Dell #LaptopDell #MáyTínhDell #HiệuNăngỔnĐịnh #ĐộBềnCao #GamingPC</strong></span></p>', 71, 'john.doe@example.com', b'1'),
(2, 'chế độ quay video hỗ trợ ProRes 8K', '111-1.jpg', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 94, 'william.brown@example.com', b'1'),
(3, 'Hệ Thống Camera Đỉnh Cao', 'Hình-ảnh-phong-cảnh-yên-bình.jpg', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 78, 'michael.lee@example.com', b'1'),
(20, 'Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển', 'th (3).jpg', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 23, 'tuancuong@gmail.com', b'1'),
(21, 'Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ.', '409990679_886814872807005_3229579983401464647_n.jpg', 13, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 11, 'tuancuong@gmail.com', b'1'),
(23, 'Super Retina XDR OLED 6.9 inch, độ phân giải 4K.', 'th (1).jpg', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 14, 'khduy584@gmail.com', b'1'),
(24, 'Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console', 'john-smith-1.jpg', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 16, 'khduy584@gmail.com', b'1');
INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_image`, `blog_pro_id`, `blog_content`, `blog_view`, `author_email`, `active`) VALUES
(25, 'Hiệu Năng Siêu Việt với Chip A18 Bionic', 'online-coding-classes.jpg', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 18, 'khduy584@gmail.com', b'1'),
(26, 'I just spent a week with the iPhone 16 Pro Max — here’s my pros and cons', 'all_colors__fdpduog7urm2_xlarge.jpg', 6, '<p><span class=\"text-huge\" style=\"color:hsl(30,75%,60%);\"><strong>I just spent a week with the iPhone 16 Pro Max — here’s my pros and cons</strong></span></p><p><span class=\"text-huge\">When you purchase through links on our site, we may earn an affiliate commission. Here’s how it works.</span></p><p><span class=\"text-huge\">I wasn\'t lucky enough to get an iPhone 16 Pro Max on launch day, but seven days ago it finally appeared at my door. I already had a good idea of what to expect when it did arrive thanks to Tom\'s Guide\'s reviews and hands-ons with the different models and their new features, but now I\'ve had a chance to try these all for myself.</span></p><p><span class=\"text-huge\">I basically always have an iPhone in my pocket to accompany the Android device I\'m testing, so since iPhones generally come out once every year, I\'ve still got a long time left with the iPhone 16 Pro Max. But here are my thoughts after one week using the phone as my daily driver, featuring plenty of points of praise — there\'s a reason why it\'s on our list of the best phones — but also a few areas I\'d love to see Apple address for the iPhone 17 next year.</span></p><p><span class=\"text-huge\" style=\"color:rgb(255,255,255);\">iPhone 16 Pro &amp; Pro Max EXPERT Review: Worth the Upgrade? - YouTube</span></p><p><span class=\"text-huge\">Watch On</span></p><p><span class=\"text-huge\"><strong>The screen looks incredible — and it\'s not just me</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\">With its new 6.9-inch display, impressively-high brightness and class-leading color accuracy, the iPhone 16 Pro Max is tied with the Google Pixel 9 Pro XL for my favorite smartphone screen of the year. In fact I\'ve had two of my family members — people who normally glaze over as soon as I mention anything like color gamuts or delta-E measurements — admire how bright, sharp and colorful the screen of the iPhone 16 Pro Max is. They couldn\'t point to what aspect of the display they like, but needless to say the quality is obvious even to non-techy people in your life.</span></p><p><span class=\"text-huge\" style=\"color:rgb(0,0,0);\"><strong>Sponsored Links</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\" style=\"color:rgb(51,51,51);\"><strong>Trade Bitcoin &amp; Ethereum – No Wallet Needed!</strong></span><span class=\"text-huge\" style=\"color:rgb(153,153,153);\"><strong>IC Markets</strong></span></p><p><span class=\"text-huge\"><strong>Start Now</strong></span></p><p>&nbsp;</p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>iPhone 16 Pro Max: for $0.01 + $65/month with Unlimited @ Amazon</strong></span><br><span class=\"text-huge\">Amazon is offering the iPhone 16 Pro Max for just $0.01 when you purchase it with a Boost Infinite plan, including the 1TB iPhone 16 Pro Max. You\'ll have to commit to a 36-month payment plan, but you\'ll be saving more than with a traditional wireless carrier.</span></p><p><span class=\"text-huge\" style=\"color:var(--white);\"><strong>View Deal</strong></span></p><p><span class=\"text-huge\">That said, it\'s a little disappointing that Apple didn\'t upgrade more aspects of the screen. It can now scale its refresh rate all the way down to 1Hz for greater battery efficiency, but even Apple notes the screen is no brighter than before. And while the Ceramic Shield material is apparently tougher, an added anti-glare layer like Samsung users for the Galaxy S24 Ultra would have been an excellent addition.</span></p><p><span class=\"text-huge\"><strong>LATEST VIDEOS FROM tomsguide</strong></span></p><p><span class=\"text-huge\" style=\"background-color:transparent;color:rgb(255,255,255);font-family:Arial, Helvetica, sans-serif;\">Loading</span></p><p><span class=\"text-huge\"><strong>Photography is as strong as you\'d hope</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\" style=\"color:rgb(51,51,51);\">(Image credit: Tom\'s Guide)</span></p><p><span class=\"text-huge\">This is something I could have guessed without even touching the phone, but the iPhone 16 Pro Max is an awesome camera phone. While its cameras don\'t quite match up to the megapixel total of Android flagships like the Galaxy S24 Ultra or Pixel 9 Pro XL, Apple\'s focused on consistency, something we see reflected in its success in our photo face-offs. (Check out our 200-shot competition between the iPhone 16 Pro Max vs. Galaxy S24 Ultra).</span></p><p><span class=\"text-huge\">The new 48MP ultrawide camera is already improving my zoomed-out shots with additional detail when needed, and the massive upgrade to Photographic Styles is fun to experiment with. While I haven\'t tried it properly myself yet, having 120fps 4K video recording abilities is something I\'m keen to try as a fan of both high frame rates and the option to enable slo-mo on any clip.&nbsp;</span></p><p><span class=\"text-huge\"><strong>iOS runs smoother and snappier than ever</strong></span></p><p><span class=\"text-huge\">I\'ve been using iOS 18 since the second developer beta, so I\'m quite familiar with how its features all work. But since moving into the iPhone 16 Pro Max, its A18 Pro chip seems to have smoothed everything out even more. Everything from opening apps to the speed with which Apple Pay pops up and processes my purchases feels more slick, and I hope this continues to be the case when we eventually get iOS 19 and later versions.&nbsp;</span></p><p><span class=\"text-huge\">It\'s possible this is just a matter of optimisation over time rather than the A18 Pro meeting a certain power threshold. But whatever the reason, the iPhone 16 Pro Max does truly feel built for iOS 18, and for Apple Intelligence features like Writing Tools and Clean Up. It\'s just a shame these features didn\'t launch at the same time as the phone.</span></p><p><span class=\"text-huge\"><strong>Desert Titanium looks and feels classy</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\">I\'m always uncertain about the look of gold phones. They can easily look tacky rather than sophisticated, but Desert Titanium brings in a less glitzy bronze tone that has made me confident I picked the best available color.</span></p><p><span class=\"text-huge\">Not only is it easy on the eye, the phone also feels better to hold than the iPhone 15 Pro Max I was using before. The glossier titanium side rails feel nicer whether against your fingertips or in your palm, while still offering the same weight and durability benefits as last year\'s original titanium-clad Pro iPhones.</span></p><p><span class=\"text-huge\"><strong>A 6.9-inch iPhone may have been a size increase too far</strong></span></p><p><span class=\"text-huge\">Despite the positive words I had for the bigger screen of the iPhone 16 Pro Max, I\'m uncertain about the phone\'s size in general. It could be that I am just very used to the 6.7-inch iPhone shape after using Pro Max iPhones for the past three years. But I am finding it difficult to reach distant areas of the display when trying to handle the phone one-handed, even compared to similarly large Android phones.</span></p><p><span class=\"text-huge\">Apple\'s Reachability tool, the often-forgotten iOS tool that slides the interface down the screen for easier access, helps with this somewhat. But this is making me wonder if I made a mistake in choosing the Pro Max rather than the 6.3-inch iPhone 16 Pro, or if I just need some more time with the phone.</span></p><p><span class=\"text-huge\"><strong>Gaming is better — and cooler</strong></span></p><p><span class=\"text-huge\">I\'m one of the few people who\'ve actually been playing Resident Evil: Village on iPhone. While I know I could get a better experience on an actual console, having this AAA game available to play right out of my pocket on one of the best gaming phones is plain fun, whether it\'s just on the phone or with the help of a Backbone One controller.</span></p><p><span class=\"text-huge\">It\'s all the more fun on the iPhone 16 Pro Max. The larger display, extra power in the A18 Pro chip make the game more visually impressive, while improved cooling (thanks to new graphite and aluminum parts) makes it much more comfortable to hold than the iPhone 15 Pro was.</span></p><p><span class=\"text-huge\"><strong>Battery life is fantastic</strong></span></p><p><span class=\"text-huge\">Whether it\'s because Apple enlarged the battery capacity of the iPhone 16 Pro Max, or it improved the power efficiency of the A18 Pro chipset, but I\'ve seen huge improvements in battery life. On days I\'d previously use up 80% of my iPhone\'s battery, I\'m now using 65 - 70%, a considerable improvement.</span></p><p><span class=\"text-huge\">On our best phone battery life list, the iPhone 16 Pro Max comes in third behind the OnePlus 12R and Asus ROG Phone 8 Pro. But considering it already lasts over 18 hours on the TG battery test, and only lasts 42 minutes less than then ROG Phone, the iPhone 16 Pro Max has more than enough battery life for anyone.</span></p>', 9, 'khduy584@gmail.com', b'1'),
(27, 'The Apple iPhone 16 Pro / Pro Max Review for Photographers', 'th (1).jpg', 6, '<p><span class=\"text-huge\" style=\"color:hsl(30,75%,60%);\"><i><strong>The Apple iPhone 16 Pro / Pro Max Review for Photographers</strong></i></span></p><p><span class=\"text-huge\"><strong>Sep 18, 2024</strong></span></p><p><span class=\"text-huge\"><strong>Chris Niccolls</strong></span></p><p><span class=\"text-huge\"><strong>After Apple concluded its keynote featuring the iPhone 16 Pro and Pro Max, I dove into my review of this new smartphone as a photographic and videographic tool in the sunshine of California. Jordan Drake shot our entire video review on the iPhone 16 Pro and I scoured the area around Monterey and Santa Cruz to take pictures with the iPhone 16 Pro Max.</strong></span></p><p><span class=\"text-huge\"><strong>We are looking at only the iPhone 16 Pro and Pro Max models because we feel these are the most capable tools possible for anyone serious about creating with the latest iPhone. As compelling as these phones might be for the casual user, we also focused almost entirely on the shooting experience, as we want to evaluate these devices as the cameras that they potentially can be.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(30,75%,60%);\"><strong>iPhone 16 Pro Review: How it Handles</strong></span></p><p><span class=\"text-huge\"><strong>One of the things that frustrates me most about any smartphone is the rather poor ergonomics of simply holding and photographing with one. Short of getting a custom case designed for photography, most people will instead struggle with the inherent flatness of a smartphone and learn how to push buttons effectively without dropping the device. Of course, we still end up dropping them all the time.</strong></span></p><p>&nbsp;</p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>The latest iPhone is here and it promises to be more rugged and capable than ever before.</strong></span></p><p><span class=\"text-huge\"><strong>This year, Apple has done something quite interesting by introducing the Camera Control button that not only functions as a shutter button but also brings up the camera app with a simple press. It also allows for adjusting manual exposure and zoom thanks to a handy sliding interface that operates similarly to a camera dial. You can also use the button as a touch interface on the menu the Camera Control button brings up, so there are many ways to make quick adjustments. Having used the new controls extensively, I can say that I like the additional level of control that it provides. With practice, the operation became predictable and repeatable, and it is always good to have more ways to manipulate a camera at your fingertips.</strong></span></p><p><span class=\"text-huge\"><strong>The Camera Control button is new on the iPhone 16 series and it turns out to be a very useful feature.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>Thanks to the faster A18 processor, the shutter lag is negligible and I found the response time to be much more predictable than before even when shooting RAW photos rapidly. The iPhone 15 always had a delay when taking pictures and I find the ability to time my shots to be much more like a standalone camera now.</strong></span></p><p><span class=\"text-huge\"><strong>I appreciated the lack of shutter lag when shooting pictures quickly.In situations where I wanted to capture fast movement across the frame, the new iPhone 16 is more responsive.</strong></span></p><p><span class=\"text-huge\"><strong>There has been a noticeable improvement in battery life but I have never had an issue with the iPhone 15 for what it’s worth. Apple knows how to do battery life well but the charging speeds are still capped at just under 30 watts of draw. There is an improvement to the MagSafe wireless charging speeds which now rival what the USB-C port can do, however. I will likely rely on the wireless charger now instead of relegating its use to overnight charging as a result. The iPhone 16 can draw extra power beyond this level but only to facilitate the use of apps that need power while charging the phone simultaneously. The iPhone 16 can still follow Apple’s claim that a 50% charge can be achieved in half an hour.</strong></span></p><p><span class=\"text-huge\"><strong>The camera suite and display brightness are identical between the Pro and Pro Max models. You can clearly see the difference in size, though.</strong></span></p><p><span class=\"text-huge\"><strong>The iPhone 16 Pro now has a slightly larger 6.3-inch screen and the Pro Max has a massive 6.9-inch display. I nit-picked the lack of any improvement in brightness on the iPhone 16 screens in my initial impressions as they are the same 2,000 nits of peak brightness as before. However, in use, they are perfectly usable in bright and glaring conditions, and although other manufacturers are making brighter screens, the iPhone displays do just fine in practical terms. I stand corrected.</strong></span></p><p><span class=\"text-huge\"><strong>iPhone 16 Pro Review: How it Shoots</strong></span></p><p><span class=\"text-huge\"><strong>Having used the iPhone 15 Pro Max extensively, I wanted to see how much the image quality has improved on this year’s model and there are some noteworthy improvements on paper. Unfortunately, the upgrades are relatively minor when applied in the real world.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>The iPhone 16 Pro can record excellent levels of detail, but it is no better than its predecessor.We toured the Santa Cruz boardwalk as well to catch the colorful scenes it has to offer.</strong></span></p><p><span class=\"text-huge\"><strong>The Pro models get an identical suite of cameras, whether you choose the Pro or Pro Max model, with some notable improvements over the iPhone 15 Pro series. First is a new main camera that features the same 48-megapixel resolution and f/1.78 aperture but is roughly twice as fast when it comes to readout speeds. This makes it possible to unlock 4K at 120 frames per second in video mode but I hoped it would also improve photographic image quality. We’ll come back to this.</strong></span></p><p><span class=\"text-huge\"><strong>The new ultra-wide camera now adds 48-megapixels which brings it more on par with the main camera and the competitors too.I like the exaggerated sense of perspective that the ultra-wide lens delivers.</strong></span></p><p><span class=\"text-huge\"><strong>The ultra-wide camera has also been improved to a new 48-megapixel sensor with autofocus that can deliver decent macro capabilities with more detail than before. The aperture is the same as before at f/2.2. I like now having the option of 48-megapixel RAW files although, in real-world situations, the resolution does not match that of a standard Bayer pattern sensor at 48 megapixels. Oddly, Apple also decided not to implement the option for a 24-megapixel HEIF file, which it does have on the main fusion camera. The extra megapixels are unnecessary for social media applications but at least landscape and macro photographers can squeeze some more detail out of their RAW files.</strong></span></p><p><span class=\"text-huge\"><strong>The ultra-wide can capture the occasional close-up shot with pretty decent resolution thanks to the new sensor.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>You can see that the extra megapixels in the new ultra-wide camera make a difference when you need to get more detail.</strong></span></p><p><span class=\"text-huge\"><strong>The only camera module reused from the iPhone 15 Pro Max is the 5x telephoto f/2.8 lens which is now present on both the Pro and Pro Max (some users will probably miss the 3x camera on the 15 Pro). I would have liked to have seen an improvement here because this camera has limitations. Unfortunately, this camera module is still the weakest of the rear-facing cameras, with somewhat noisy images in low light and maxing out at 12 megapixels of resolution.</strong></span></p><p><span class=\"text-huge\"><strong>The 5X telephoto lens is handy and I find myself using it often.The 5X telephoto camera is still one that I use often, but it hasn’t improved this year.</strong></span></p><p><span class=\"text-huge\"><strong>In regards to all the camera modules, I did notice an improvement when it came to flare resistance in bright light. Older iPhones are plagued with vibrant rainbow reflections across the frame, which is much less pronounced on the iPhone 16 series. This is thanks in no small part to the new lens coatings Apple has added to its optics. However, due to the similar optical formulas being used, distinct and distracting ghosts are still visible when shooting towards bright light sources.</strong></span></p><p><span class=\"text-huge\"><strong>There is much less rainbow flare from the sun, and contrast is retained well. Still has that weird ghosting in the corner though.The black and white filters are nice to use, and I can access them quickly through the touch screen now.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>The portrait mode has been tweaked and I noticed slight improvements to the subtlety of the depth maps and how accurately they separate hair from the background. While pixel peepers will spot the difference, I don’t think the improvement will translate to social media. Low-light performance was something I hypothesized might be improved due to the faster scanning sensor in the iPhone 16 main camera. If the sensor reads out faster, it should be able to stack more images and improve quality even further. Looking at the photos, though, any difference between the older iPhone 15 Pro phones and the new 16 series is not apparent.</strong></span></p><p><span class=\"text-huge\"><strong>While Apple stuck with the same nine image stacks as before despite the faster readout speeds, there is some benefit to the shooting experience.</strong></span></p><p><span class=\"text-huge\"><strong>Portrait mode is improved in a very subtle way on the iPhone 16 Pro. Apple still tends to do the best job with depth maps compared to other manufacturers.Darker conditions can be difficult for smartphones to deal with and the main camera of the iPhone 16 Pro doesn’t seem to improve things much.</strong></span></p><p><span class=\"text-huge\"><strong>The faster readout speeds mean that the iPhone 16 stacks images with less delay in between them. In faster action situations this will lead to less ghosting and overlapping of imagery when the frames are stacked and less wasted frames, too. Still, if there are any improvements to the low-light quality in dark situations just due to a new sensor and processing engine, I certainly didn’t notice it.</strong></span></p><p><span class=\"text-huge\"><strong>Monterey Bay Aquarium is one of the finest around and represents a very typical venue for smartphone photography.The low-light potential of the iPhone 16 Pro is decent but I was hoping for some improvement this year.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>The revamped portrait styles are good — Apple has made some important efforts to maintain accurate skin tones — and the ultra-wide camera is improved to some degree. I appreciate that these picture styles can be applied in live-view mode and can always be changed to a different style later. This may provide the ease of use and convenience to convince more people to try them out and ultimately get more use out of them. I also like the new touchscreen interface for accessing them and the ability to customize them fully for tone and opacity.</strong></span></p><p><span class=\"text-huge\"><strong>Here you can see the realistic-looking separation from the background and the Amber undertone being used. Despite my naturally warm skin tone, the Amber setting doesn’t go over the top.The Rose Gold undertone gives a subtle warmth but the skin tones are still natural looking.Using the Cold Rose undertone gives a cool feel to the entire image but doesn’t overdo blue tones in the skin.</strong></span></p><p><span class=\"text-huge\"><strong>Kudos to Apple for offering the option to switch to the JPEG-XL standard. Apple ProRAW images can now be set to the JPEG-XL format, which renders as a DNG RAW file but also has an easy-to-share embedded JPEG image. Even more importantly, file size is now far reduced to roughly 45 megabytes in a lossless format and only 20 megabytes in a lossy format that is, despite its name, perceptively lossless. This will substantially reduce storage space needed both on the phone and in the cloud for anyone who wants to have the benefits of RAW files at hand.</strong></span></p><p><span class=\"text-huge\"><strong>Carmel-By-The-Sea is always a charming place to take a smartphone.A phone lets you stay discreet, and the new camera controls are quick to manipulate.</strong></span></p><p>&nbsp;</p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>iPhone 16 Pro Review: The Best Smartphone for Video Gets a Bit Better</strong></span></p><p><span class=\"text-huge\"><strong>On the video front, the headline addition is the ability to record up to 4K 120p with a very high-quality look thanks to ProRes Log. You can also retime the 120p footage down to 1/5 speed for a 24-frame-per-second timeline right on the phone and it will show it to you in real-time as it is rendering. Speed ramping can be done very simply within the same interface allowing for some dramatic looking slow motion shots.</strong></span></p><p><span class=\"text-huge\"><strong>The retime tool for the new 4K 120P mode is intuitive and powerful.</strong></span></p><p><span class=\"text-huge\"><strong>With four microphones embedded in the iPhone 16 Pro, you can now record spatial audio for your video work. This means that the iPhone 16 can pick up sounds from in front and behind the camera and then provide the option to creatively mix them as you desire. There is a new audio mixing interface that allows you to focus the sound only on what is in the composition or minimize ambient noise and maximize vocal sound almost as if your subjects are in a sound booth. You can also have the camera send out individual sound channels to an audio output that supports spatial audio and get basically a surround sound kind of effect.</strong></span></p><p><span class=\"text-huge\"><strong>You would be hard-pressed to notice any difference in sharpness when it comes to the video footage from the iPhone 15 Pro against the iPhone 16 Pro.</strong></span></p><p><span class=\"text-huge\"><strong>When it comes to the actual video quality we didn’t notice much improvement versus the iPhone 15 Pro from last year. Now keep in mind, the iPhone 15 Pro delivers some of the best log recording video a smartphone can deliver so the new iPhone 16 Pro is still at the top of the list. But with the exception of the new 4K 120p recording mode, there isn’t much reason to upgrade. The new ultra-wide lens absolutely delivers more resolution for stills but when it comes to video the detail between the older iPhone 15 and newer 16, we couldn’t see a difference.</strong></span></p><p>&nbsp;</p><p>&nbsp;</p><p><span class=\"text-huge\" style=\"color:hsl(30,75%,60%);\"><strong>iPhone 16 Pro Review: Apple Eschews AI</strong></span></p><p><span class=\"text-huge\"><strong>Let’s talk about AI for a bit because there is no denying that generative AI technology is advancing in the smartphone world. Apple has a very different approach to AI, which translates into a far more conservative approach.</strong></span></p><p><span class=\"text-huge\"><strong>Currently, the only generative AI tool they are implementing is an eraser tool. Something that Google has offered for multiple generations now. Apple states that its approach to AI is based on a philosophical choice to maintain the integrity of the photograph and believes that photographers will appreciate this decision in the long run.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>Apple needs a better long-exposure tool. Switching to Live Photo mode and applying the filter is cumbersome, and the results are still not ideal.</strong></span></p><p><span class=\"text-huge\"><strong>I agree that Google may have gone too far in its approach with generative AI, but the technology is here to stay and will only get better. I don’t use any of the prompt-based tools that Google offers, but I think there is legitimate value in some of the other tools such as auto-framing and moving subjects within the frame.</strong></span></p><p><span class=\"text-huge\"><strong>When a photographer wants to maintain the integrity of their images, they can shoot RAW and traditionally edit their pictures. Still, I feel that many users will want to have additional tools available to help them be creative, especially with social media posts. Apple users may find themselves looking elsewhere in these situations</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\" style=\"color:hsl(30,75%,60%);\"><strong>The iPhone 16 Pro and Pro Max: Good but Familiar</strong></span></p><p><span class=\"text-huge\"><strong>From an image quality standpoint, a lot has stayed the same from the iPhone 15 Pro models. Essentially, we have very similar cameras to the iPhone 15 Pro Max. That does mean that those upgrading from older devices have a choice between jumping to the iPhone 16 Pro series and getting top-of-the-line or opting for a cheaper but still quite good iPhone 15 Pro series phone.</strong></span></p><p><span class=\"text-huge\"><strong>From a photographic standpoint, not much has changed in a way that will “wow” iPhone 15 Pro users. If you just upgraded last year, you can stand to wait for next year’s changes before considering an upgrade if photography is your main and most pressing consideration.</strong></span></p><p><span class=\"text-huge\"><strong>I like the images and capabilities of the new phone, but I don’t feel like we are getting a significant step up in image quality.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>Are There Alternatives?</strong></span></p><p><span class=\"text-huge\"><strong>An existing Apple user will likely stay in the Apple ecosystem. Due to the image quality being so similar, the main competition to the iPhone 16&nbsp;Pro is the older iPhone 15 Pro and Pro Max. For anyone who wants to test the Android waters, the Google Pixel 9 Pro also has significant upgrades to its camera modules and AI-based technology. Samsung’s S24 Ultra didn’t do much on the hardware front this year, so it’s less of a compelling alternative.</strong></span></p><p>&nbsp;</p><p><span class=\"text-huge\"><strong>Should You Buy It?</strong></span></p><p><span class=\"text-huge\"><strong>Maybe — it depends on how old your current phone is. The new controls are beneficial and some users will enjoy the new Picture Styles, making the iPhone 16 Pro and Pro Max more compelling upgrades if you’re coming from the iPhone 14 series or older.</strong></span></p>', 10, 'khduy584@gmail.com', b'1'),
(28, 'Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.', 'Symbol-Youtube.png', 6, '<p><span class=\"text-huge\" style=\"background-color:hsl(0,0%,100%);color:hsl(0,75%,60%);\"><strong>Giới thiệu</strong></span></p><p><span class=\"text-big\"><strong>Apple chưa bao giờ làm chúng ta thất vọng khi nói đến sự đột phá trong công nghệ. Với sự ra mắt của iPhone 16 Pro Max, hãng tiếp tục khẳng định vị thế dẫn đầu trong ngành công nghệ di động. Đây không chỉ là một chiếc điện thoại thông minh, mà còn là biểu tượng của sự tinh tế và đổi mới.</strong></span></p><p><span class=\"text-big\"><strong>Trong bài viết này, chúng ta sẽ khám phá chi tiết những điểm nổi bật của iPhone 16 Pro Max, từ thiết kế đến hiệu năng, và lý do tại sao nó lại là chiếc điện thoại được mong chờ nhất năm.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>1. Thiết Kế Sang Trọng và Đột Phá</strong></span></p><p><span class=\"text-big\"><strong>Apple đã luôn chú trọng đến thiết kế và iPhone 16 Pro Max không phải ngoại lệ. Với chất liệu Titanium 2.0 mới, máy không chỉ bền bỉ mà còn nhẹ hơn đáng kể so với các phiên bản trước. Khung viền mỏng hơn và màn hình tràn viền hoàn toàn mang đến cảm giác liền mạch tuyệt đối.</strong></span></p><p><span class=\"text-big\"><strong>Màn hình: Super Retina XDR OLED 6.9 inch, độ phân giải 4K.</strong></span></p><p><span class=\"text-big\"><strong>Màu sắc: Giới thiệu màu mới \"Midnight Blue\" bên cạnh các tùy chọn cổ điển.</strong></span></p><p><span class=\"text-big\"><strong>Dynamic Island: Được cải tiến để tương tác mượt mà hơn.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>2. Hiệu Năng Siêu Việt với Chip A18 Bionic</strong></span></p><p><span class=\"text-big\"><strong>Trái tim của iPhone 16 Pro Max là chip A18 Bionic, sản xuất trên tiến trình 3nm thế hệ thứ hai. Đây là con chip mạnh nhất từng được sản xuất bởi Apple, mang lại hiệu năng vượt trội và khả năng tiết kiệm năng lượng đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng CPU: Tăng 20% so với A17 Pro.</strong></span></p><p><span class=\"text-big\"><strong>Hiệu năng GPU: Hỗ trợ Ray Tracing thời gian thực, mang đến trải nghiệm game như trên console.</strong></span></p><p><span class=\"text-big\"><strong>RAM: 12GB, tối ưu đa nhiệm hoàn hảo.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>3. Hệ Thống Camera Đỉnh Cao</strong></span></p><p><span class=\"text-big\"><strong>Một trong những cải tiến lớn nhất trên iPhone 16 Pro Max nằm ở hệ thống camera. Máy được trang bị cụm camera 4 ống kính, bao gồm:</strong></span></p><p><span class=\"text-big\"><strong>Camera chính: 48MP, khẩu độ f/1.5, công nghệ Quad-Pixel.</strong></span></p><p><span class=\"text-big\"><strong>Camera tele: Zoom quang học 10x, nâng tầm chụp ảnh từ xa.</strong></span></p><p><span class=\"text-big\"><strong>Camera góc siêu rộng: 24MP, tối ưu chụp phong cảnh và ánh sáng yếu.</strong></span></p><p><span class=\"text-big\"><strong>Camera macro: Chụp cận cảnh chi tiết đáng kinh ngạc.</strong></span></p><p><span class=\"text-big\"><strong>Ngoài ra, chế độ quay video hỗ trợ ProRes 8K, biến iPhone 16 Pro Max thành một công cụ quay phim chuyên nghiệp.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>4. Pin và Thời Lượng Sử Dụng</strong></span></p><p><span class=\"text-big\"><strong>Apple đã nâng cấp dung lượng pin để iPhone 16 Pro Max trở thành một trong những thiết bị có thời lượng pin lâu nhất.</strong></span></p><p><span class=\"text-big\"><strong>Dung lượng pin: 5.000mAh.</strong></span></p><p><span class=\"text-big\"><strong>Sạc nhanh: Công nghệ MagSafe 2.0 hỗ trợ sạc không dây 35W.</strong></span></p><p><span class=\"text-big\"><strong>Thời gian sử dụng: Lên đến 30 giờ xem video liên tục.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>5. iOS 18: Trải Nghiệm Mượt Mà và Đầy Tính Tùy Biến</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max được cài đặt sẵn iOS 18, với nhiều cải tiến vượt trội:</strong></span></p><p><span class=\"text-big\"><strong>Tính năng AI: Siri thông minh hơn, tự động gợi ý lịch trình và trả lời câu hỏi phức tạp.</strong></span></p><p><span class=\"text-big\"><strong>Widget tương tác: Cho phép thực hiện hành động trực tiếp từ màn hình chính.</strong></span></p><p><span class=\"text-big\"><strong>Tùy biến giao diện: Nhiều tùy chọn mới cho màn hình khóa.</strong></span></p><p><span class=\"text-huge\" style=\"color:hsl(0,75%,60%);\"><strong>6. Giá Bán và Ngày Ra Mắt</strong></span></p><p><span class=\"text-big\"><strong>Giá khởi điểm: $1,299 cho phiên bản 256GB.</strong></span></p><p><span class=\"text-big\"><strong>Các tùy chọn: 256GB, 512GB, 1TB và lần đầu tiên, phiên bản 2TB.</strong></span></p><p><span class=\"text-big\"><strong>Ngày mở bán: Dự kiến vào tháng 9 năm 2024.</strong></span></p><p><span class=\"text-big\"><strong>Kết Luận</strong></span></p><p><span class=\"text-big\"><strong>iPhone 16 Pro Max không chỉ là một chiếc điện thoại mà còn là một kiệt tác công nghệ. Với những cải tiến vượt trội từ thiết kế, hiệu năng đến camera, sản phẩm này chắc chắn sẽ chinh phục cả những khách hàng khó tính nhất.</strong></span></p><p><span class=\"text-big\"><strong>Nếu bạn là một tín đồ công nghệ hoặc đang tìm kiếm một thiết bị \"all-in-one\", iPhone 16 Pro Max là lựa chọn không thể bỏ qua. Bạn có đang hào hứng để sở hữu siêu phẩm này? Hãy chia sẻ ý kiến của bạn bên dưới!</strong></span></p>', 0, 'khduy584@gmail.com', b'1'),
(29, '', 'Blue Waves Surfing Club Logo.png', 18, 'a\r\n                                ', 0, 'khduy584@gmail.com', b'0'),
(30, 'Máy Tính Dell: Sự Kết Hợp Hoàn Hảo Giữa Hiệu Năng và Độ Bền', 'Ảnh-nền-biển-đẹp-trong-xanh.jpg', 6, '<p><span class=\"text-huge\"><i><strong>Máy Tính Dell: Sự Kết Hợp Hoàn Hảo Giữa Hiệu Năng và Độ Bền</strong></i></span></p><p><span class=\"text-huge\" style=\"color:rgb(230,153,77);\"><strong>Giới Thiệu</strong></span></p><p><span class=\"text-big\">Dell là một trong những thương hiệu hàng đầu trong ngành công nghệ máy tính với lịch sử hơn 35 năm phát triển. Từ máy tính cá nhân, laptop đến các dòng máy trạm chuyên nghiệp, Dell luôn giữ vững vị thế nhờ chất lượng sản phẩm, độ bền và hiệu năng ổn định.</span></p><p><span class=\"text-big\">Trong bài viết này, chúng ta sẽ tìm hiểu sâu hơn về các dòng sản phẩm máy tính Dell, lý do vì sao thương hiệu này lại nổi tiếng trên toàn cầu, và cách Dell đáp ứng nhu cầu đa dạng của người dùng từ cá nhân, doanh nghiệp nhỏ đến các tổ chức lớn.</span></p><p><span class=\"text-big\" style=\"color:rgb(230,153,77);\"><strong>1. Lịch Sử Thương Hiệu Dell</strong></span></p><p><span class=\"text-big\">Thành lập vào năm 1984 bởi <strong>Michael Dell</strong>, thương hiệu này bắt đầu với mục tiêu đơn giản: cung cấp máy tính cá nhân chất lượng cao với giá cả phải chăng. Trải qua nhiều thập kỷ, Dell đã chuyển mình từ một nhà sản xuất máy tính cá nhân trở thành một công ty công nghệ toàn cầu, chuyên cung cấp giải pháp từ phần cứng đến dịch vụ IT.</span></p><p><span class=\"text-big\">Dell hiện nay nổi tiếng với việc áp dụng công nghệ hiện đại, thiết kế tinh tế và khả năng đáp ứng các yêu cầu chuyên biệt của khách hàng. Những dòng sản phẩm nổi bật của Dell bao gồm:</span></p><p><span class=\"text-big\"><strong>Laptop Dell XPS</strong>: Sự kết hợp giữa thiết kế cao cấp và hiệu năng mạnh mẽ.</span></p><p><span class=\"text-big\"><strong>Dell Inspiron</strong>: Lựa chọn phổ biến cho người dùng cá nhân và sinh viên.</span></p><p><span class=\"text-big\"><strong>Dell Latitude</strong>: Laptop doanh nhân với độ bền và bảo mật tối ưu.</span></p><p><span class=\"text-big\"><strong>Máy tính để bàn Dell OptiPlex</strong>: Dành cho văn phòng và các tổ chức lớn.</span></p><p><span class=\"text-big\"><strong>Dell Alienware</strong>: Dòng máy tính chơi game hàng đầu thế giới.</span></p><p><span class=\"text-big\" style=\"color:rgb(230,153,77);\"><strong>2. Các Dòng Sản Phẩm Dell Nổi Bật</strong></span></p><p><span class=\"text-big\"><strong>2.1. Dell XPS: Biểu Tượng Của Sự Cao Cấp</strong></span></p><p><span class=\"text-big\">Dell XPS được xem là dòng sản phẩm cao cấp nhất của hãng, được thiết kế để cạnh tranh trực tiếp với các dòng máy tính cao cấp như MacBook Pro.</span></p><p><span class=\"text-big\"><strong>Thiết kế:</strong> Vỏ máy bằng nhôm nguyên khối, viền màn hình mỏng với công nghệ <strong>InfinityEdge</strong>.</span></p><p><span class=\"text-big\"><strong>Màn hình:</strong> Độ phân giải lên đến <strong>4K Ultra HD</strong> với khả năng hiển thị HDR sắc nét.</span></p><p><span class=\"text-big\"><strong>Hiệu năng:</strong> Chip Intel thế hệ mới nhất, RAM từ 16GB đến 64GB, SSD tốc độ cao.</span></p><p><span class=\"text-big\"><strong>Ứng dụng:</strong> Phù hợp cho người sáng tạo nội dung, lập trình viên và người dùng cần hiệu năng cao.</span></p><p><span class=\"text-big\"><strong>2.2. Dell Inspiron: Phổ Thông Nhưng Đầy Tiện Ích</strong></span></p><p><span class=\"text-big\">Inspiron là dòng laptop phổ thông phù hợp với mọi đối tượng, từ học sinh, sinh viên đến người dùng gia đình.</span></p><p><span class=\"text-big\"><strong>Giá cả hợp lý:</strong> Inspiron được thiết kế với mục tiêu đáp ứng nhu cầu cơ bản nhưng vẫn đảm bảo hiệu năng ổn định.</span></p><p><span class=\"text-big\"><strong>Đa dạng cấu hình:</strong> Từ Intel Core i3 đến Core i7, đáp ứng các nhu cầu khác nhau như làm việc văn phòng, học tập hoặc giải trí.</span></p><p><span class=\"text-big\"><strong>Thiết kế hiện đại:</strong> Mỏng nhẹ và dễ mang theo.</span></p><p><span class=\"text-big\"><strong>2.3. Dell Latitude: Dành Riêng Cho Doanh Nhân</strong></span></p><p><span class=\"text-big\">Latitude là dòng laptop được thiết kế dành riêng cho môi trường doanh nghiệp với độ bền cao, thời lượng pin lâu và các tính năng bảo mật tiên tiến.</span></p><p><span class=\"text-big\"><strong>Bảo mật:</strong> Hỗ trợ vPro, TPM 2.0, và nhận diện vân tay.</span></p><p><span class=\"text-big\"><strong>Độ bền:</strong> Đạt tiêu chuẩn quân đội MIL-STD 810G.</span></p><p><span class=\"text-big\"><strong>Kết nối:</strong> Đa dạng cổng kết nối, từ USB-C, HDMI đến Ethernet.</span></p><p><span class=\"text-big\"><strong>2.4. Dell Alienware: Thiên Đường Của Game Thủ</strong></span></p><p><span class=\"text-big\">Alienware là dòng sản phẩm nổi tiếng dành cho các game thủ chuyên nghiệp. Đây là một trong những thương hiệu máy tính chơi game mạnh mẽ nhất thế giới.</span></p><p><span class=\"text-big\"><strong>Hiệu năng tối ưu:</strong> Trang bị GPU NVIDIA RTX mới nhất, bộ xử lý Intel và AMD cao cấp.</span></p><p><span class=\"text-big\"><strong>Hệ thống tản nhiệt:</strong> Công nghệ <strong>Cryo-Tech Cooling</strong>, giúp duy trì nhiệt độ thấp khi chơi game trong thời gian dài.</span></p><p><span class=\"text-big\"><strong>Thiết kế:</strong> Đèn RGB cá nhân hóa, mang đậm phong cách gaming.</span></p><p><span class=\"text-big\" style=\"color:rgb(230,153,77);\"><strong>3. Ưu Điểm Của Máy Tính Dell</strong></span></p><p><span class=\"text-big\"><strong>3.1. Độ Bền Vượt Trội</strong></span></p><p><span class=\"text-big\">Máy tính Dell nổi tiếng với độ bền cao, đặc biệt ở các dòng Latitude và OptiPlex. Những sản phẩm này thường trải qua các bài kiểm tra khắc nghiệt để đảm bảo hoạt động ổn định trong nhiều điều kiện môi trường.</span></p><p><span class=\"text-big\"><strong>3.2. Hiệu Năng Ổn Định</strong></span></p><p><span class=\"text-big\">Dell liên tục cập nhật cấu hình với những công nghệ mới nhất. Từ dòng phổ thông đến cao cấp, máy tính Dell luôn mang lại trải nghiệm mượt mà và đáng tin cậy.</span></p><p><span class=\"text-big\"><strong>3.3. Bảo Hành và Hỗ Trợ Khách Hàng</strong></span></p><p><span class=\"text-big\">Dell cung cấp các dịch vụ bảo hành linh hoạt, bao gồm <strong>ProSupport</strong> cho doanh nghiệp, với khả năng hỗ trợ kỹ thuật 24/7 và thay thế phần cứng nhanh chóng.</span></p><p><span class=\"text-big\"><strong>3.4. Giá Cả Cạnh Tranh</strong></span></p><p><span class=\"text-big\">Dù bạn cần một chiếc laptop giá rẻ hay máy tính cao cấp, Dell đều có sản phẩm phù hợp với ngân sách.</span></p><p><span class=\"text-big\" style=\"color:rgb(230,153,77);\"><strong>4. Ứng Dụng Của Máy Tính Dell</strong></span></p><p><span class=\"text-big\"><strong>4.1. Trong Công Việc</strong></span></p><p><span class=\"text-big\">Máy tính Dell Latitude và OptiPlex là lựa chọn lý tưởng cho doanh nghiệp nhờ tính năng bảo mật và độ ổn định cao.</span></p><p><span class=\"text-big\"><strong>4.2. Trong Học Tập</strong></span></p><p><span class=\"text-big\">Dòng Inspiron là bạn đồng hành của nhiều học sinh, sinh viên nhờ giá cả phải chăng và thiết kế nhẹ nhàng, phù hợp với việc di chuyển.</span></p><p><span class=\"text-big\"><strong>4.3. Trong Sáng Tạo Nội Dung</strong></span></p><p><span class=\"text-big\">Dell XPS và Precision được các nhà sáng tạo nội dung, như designer và video editor, đánh giá cao nhờ hiệu năng mạnh mẽ và màn hình hiển thị chân thực.</span></p><p><span class=\"text-big\"><strong>4.4. Trong Giải Trí và Gaming</strong></span></p><p><span class=\"text-big\">Dell Alienware là lựa chọn không thể thiếu cho game thủ với khả năng xử lý đồ họa và tốc độ vượt trội.</span></p><p><span class=\"text-big\" style=\"color:rgb(230,153,77);\"><strong>5. Những Cải Tiến Đáng Mong Đợi Trong Tương Lai</strong></span></p><p><span class=\"text-big\">Dell không ngừng đổi mới và hứa hẹn sẽ mang đến nhiều công nghệ tiên tiến trong các sản phẩm sắp tới:</span></p><p><span class=\"text-big\"><strong>Màn hình OLED với tốc độ làm mới cao hơn.</strong></span></p><p><span class=\"text-big\"><strong>Chip xử lý AI tích hợp.</strong></span></p><p><span class=\"text-big\"><strong>Cải tiến hệ thống tản nhiệt.</strong></span></p><p><span class=\"text-big\" style=\"color:rgb(230,153,77);\"><strong>6. Kết Luận</strong></span></p><p><span class=\"text-big\">Máy tính Dell đã khẳng định vị trí của mình trên thị trường công nghệ nhờ chất lượng vượt trội, hiệu năng ổn định và giá trị xứng đáng với mức đầu tư. Từ người dùng phổ thông đến doanh nghiệp và game thủ, Dell luôn có sản phẩm phù hợp với mọi nhu cầu.</span></p><p><span class=\"text-big\">Nếu bạn đang tìm kiếm một chiếc máy tính đáng tin cậy, Dell chắc chắn là cái tên không thể bỏ qua. Hãy chia sẻ ý kiến của bạn về dòng sản phẩm Dell mà bạn yêu thích nhất ở phần bình luận nhé!</span></p><p><span class=\"text-big\"><strong>Hashtag:</strong></span></p><p><span class=\"text-big\"><strong>#Dell #LaptopDell #MáyTínhDell #HiệuNăngỔnĐịnh #ĐộBềnCao #GamingPC</strong></span></p>', 0, 'khduy584@gmail.com', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_userEmail` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_userEmail`, `created_at`) VALUES
(1, 'jane.smith@example.com', '2024-11-10 11:46:17'),
(2, 'emma.jones@example.com', '2024-11-10 11:46:17'),
(3, 'michael.lee@example.com', '2024-11-10 11:46:17'),
(4, 'khacduy584@gmail.com', '2024-11-12 20:27:47'),
(5, 'khduy584@gmail.com', '2024-11-14 19:27:42'),
(6, 'nguyennguyenthanh2201@gmail.com', '2024-11-15 16:39:42'),
(7, 'vy123@gmail.com', '2024-11-15 17:22:26'),
(8, 'ndt2201@gmail.com', '2024-11-22 11:50:38'),
(9, 'ndt2201@gmail.com', '2024-11-22 16:48:38'),
(10, 'maithy09082005@gmail.com', '2024-12-02 08:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `cart_id`, `pro_id`, `quantity`) VALUES
(1, 1, 6, 1),
(2, 1, 7, 1),
(3, 2, 8, 1),
(4, 3, 9, 1),
(21, 6, 8, 5),
(22, 6, 12, 1),
(23, 7, 21, 1),
(25, 8, 6, 2),
(26, 10, 25, 1),
(27, 10, 8, 5),
(28, 8, 7, 2),
(29, 10, 23, 1),
(30, 10, 16, 1),
(38, 5, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_desc` text DEFAULT NULL,
  `category_img` varchar(100) NOT NULL DEFAULT 'x-mark.png',
  `parent_id` int(11) DEFAULT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`, `category_img`, `parent_id`, `category_status`) VALUES
(1, 'Smartphones', 'Các loại điện thoại thông minh', 'Smartphones_1732285923.jpg', NULL, 1),
(2, 'Tablets', 'Các loại máy tính bảng', 'Tablets_1732285894.jpg', NULL, 1),
(3, 'Laptops', 'Các loại máy tính xách tay', 'Laptops_1732285864.jpg', NULL, 1),
(4, 'iPhone', 'Điện thoại Apple iPhone', 'iPhone_1732285825.jpg', 1, 1),
(5, 'Samsung', 'Điện thoại Samsung Galaxy', 'samsung.png', 1, 1),
(6, 'Xiaomi', 'Điện thoại Xiaomi', 'Xiaomi_1732285727.jpg', 1, 1),
(7, 'OPPO', 'Điện thoại OPPO', 'OPPO_1732285692.jpg', 1, 1),
(8, 'iPad', 'Máy tính bảng Apple iPad', 'ipad_1732285658.jpg', 2, 1),
(9, 'Samsung Tablets', 'Máy tính bảng Samsung', 'Samsung Tablets_1732285622.jpg', 2, 1),
(10, 'Xiaomi Tablets', 'Máy tính bảng Xiaomi', 'Xiaomi Tablets_1732285587.jpg', 2, 1),
(11, 'MacBook', 'Laptop Apple MacBook', 'macbook_1732285521.jpg', 3, 1),
(12, 'Gaming Laptops', 'Laptop chuyên gaming', 'laptopgaming_1732285464.jpg', 3, 1),
(13, 'Business Laptops', 'Laptop văn phòng', 'laptopvanphong_1732285424.jpg', 3, 1),
(14, 'Creator Laptops', 'Laptop sáng tạo nội dung', 'laptop_1732285373.jpg', 3, 1),
(15, 'Đồ Điện Tử', 'Các loại máy móc đồ điện tử', 'đồ điện tử_1732285324.jpg', NULL, 0),
(16, 'Không Xác Định Other', 'Các loại sản phẩm khác nằm ngoài các loại Danh Mục Sản Phẩm Trên', 'khongxacdinh_1732284999.jpg', NULL, 0),
(21, 'Demo cat', 'bjkbkj', 'PVFInal.png', NULL, 0),
(22, 'Demo lâst', 'aaaa', 'Flowchart - Page 1 (11).png', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_blog_id` int(11) NOT NULL,
  `comment_userEmail` varchar(50) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_blog_id`, `comment_userEmail`, `comment_content`, `comment_dateTime`, `active`) VALUES
(2, 1, 'emma.jones@example.com', 'Thanks for sharing your thoughts!', '2024-11-10 11:46:17', b'1'),
(3, 2, 'michael.lee@example.com', 'Very helpful comparison with previous models.', '2024-11-10 11:46:17', b'1'),
(4, 3, 'william.brown@example.com', 'Looking forward to more performance tests.', '2024-11-10 11:46:17', b'1'),
(5, 1, 'maithy09082006@gmail.com', 'hhhaaa', '2024-11-21 13:23:47', b'1'),
(6, 2, 'tuancuong@gmail.com', 'aaaa', '2024-11-21 16:03:06', b'1'),
(7, 2, 'tuancuong@gmail.com', 'cccccc', '2024-11-21 16:03:24', b'0'),
(8, 3, 'tuancuong@gmail.com', 'aaa', '2024-11-21 18:25:13', b'1'),
(9, 1, 'khduy222@gmail.com', 'Nguyen Khac Duy da den day ', '2024-11-21 18:34:05', b'1'),
(10, 1, 'khduy584@gmail.com', 'aaaaaaaaaaaaa', '2024-11-25 21:12:53', b'0'),
(11, 20, 'tuancuong@gmail.com', 'ssssss', '2024-11-25 22:11:19', b'0'),
(12, 1, 'khduy584@gmail.com', 'lololololol ????????????????????', '2024-12-04 13:57:30', b'1'),
(13, 3, 'khduy584@gmail.com', 'hihi', '2024-12-04 14:58:25', b'1'),
(14, 2, 'khacduy584@gmail.com', 'Nhất', '2024-12-07 18:06:09', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(50) NOT NULL,
  `coupon_count` int(11) NOT NULL,
  `coupon_discount` smallint(6) NOT NULL,
  `coupon_expiredate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_name`, `coupon_count`, `coupon_discount`, `coupon_expiredate`) VALUES
(1, 'giamsau', 8, 20, '2024-11-29 11:09:00'),
(2, 'WELCOME2024', 2, 5, '2024-12-31 23:59:00'),
(3, 'SPRING2024', 9, 25, '2024-03-31 23:59:00'),
(4, 'SUMMER2024', 5, 20, '2024-06-30 23:59:00'),
(5, 'MATEST', 10, 10, '2024-12-25 08:52:00'),
(7, 'MienPhi2', 3, 10, '2024-11-29 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `favorite_userEmail` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `favorite_proid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `favorite_userEmail`, `favorite_proid`) VALUES
(12, 'jane.smith@example.com', 7),
(13, 'emma.jones@example.com', 8),
(14, 'michael.lee@example.com', 9),
(15, 'william.brown@example.com', 10),
(23, 'maithy09082005@gmail.com', 21),
(24, 'maithy09082005@gmail.com', 22),
(25, 'maithy09082005@gmail.com', 23),
(27, 'maithy09082005@gmail.com', 24),
(28, 'maithy09082005@gmail.com', 25),
(30, 'maithy09082005@gmail.com', 19),
(31, 'maithy09082005@gmail.com', 15),
(33, 'maithy09082005@gmail.com', 20),
(34, 'maithy09082005@gmail.com', 18),
(35, 'maithy09082005@gmail.com', 17),
(39, 'maithy09082005@gmail.com', 14),
(40, 'maithy09082005@gmail.com', 16),
(41, 'maithy09082005@gmail.com', 13),
(42, 'maithy09082005@gmail.com', 12),
(43, 'maithy09082005@gmail.com', 10);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `act_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `privilege_act` varchar(100) NOT NULL,
  `position` int(10) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `group_id`, `act_name`, `name`, `privilege_act`, `position`, `created_time`, `last_updated`) VALUES
(1, 1, 'List blogs', 'blog', 'list', 1, 1732610795, 1732610795),
(2, 1, 'Edit blog', 'blog', 'edit', 3, 1732610795, 1732610795),
(3, 2, 'Edit product', 'product', 'edit', 3, 1732610795, 1732610795),
(4, 1, 'Add blog', 'blog', 'add', 2, 1732610795, 1732610795),
(5, 1, 'Delete blog', 'blog', 'delete', 4, 1732610795, 1732610795),
(6, 2, 'Add product', 'product', 'add', 2, 1732610795, 1732610795),
(7, 2, 'Delete product', 'product', 'delete', 4, 1732610795, 1732610795),
(8, 2, 'List products', 'product', 'list', 1, 1732610795, 1732610795),
(9, 3, 'List bills', 'bill', 'list', 1, 1732610795, 1732610795),
(10, 4, 'List user', 'user', 'list', 1, 1732610795, 1732610795),
(11, 4, 'Add user', 'user', 'add', 2, 1732610795, 1732610795),
(12, 4, 'Edit user', 'user', 'edit', 3, 1732610795, 1732610795),
(13, 4, 'Delete user', 'user', 'delete', 4, 1732610795, 1732610795),
(15, 3, 'Status bill', 'bill', 'edit', 4, 1732610795, 1732610795),
(16, 3, 'Bill Details', 'bill', 'detail', 4, 1732610795, 1732610795),
(17, 5, 'List categories', 'category', 'list', 1, 0, 0),
(18, 8, 'List comment', 'comment', 'list', 1, 1732610795, 1732610795),
(22, 8, 'Delete comment', 'comment', 'delete', 3, 1732610795, 1732610795),
(23, 6, 'List review', 'review', 'list', 1, 1732610795, 1732610795),
(24, 6, 'Delete review', 'review', 'delete', 2, 1732610795, 1732610795),
(28, 10, 'List address', 'address', 'list', 7, 0, 0),
(30, 10, 'Status address', 'address', 'updateStatus', 9, 0, 0),
(33, 5, 'Add Category', 'category', 'add', 2, 1732610795, 1732610795),
(35, 5, 'Edit category', 'category', 'edit', 3, 0, 0),
(37, 5, 'Delete category', 'category', 'delete', 5, 0, 0),
(39, 7, 'List coupon', 'coupon', 'list', 1, 0, 0),
(40, 7, 'add coupon', 'coupon', 'add', 2, 0, 0),
(41, 7, 'edit coupon', 'coupon', 'edit', 3, 0, 0),
(43, 7, 'delete coupon', 'coupon', 'delete', 4, 0, 0),
(45, 10, 'Add address', 'address', 'add', 11, 0, 0),
(46, 6, 'Detail', 'review', 'detail', 3, 0, 0),
(48, 11, 'List favorite', 'favorite', 'list', 1, 0, 0),
(49, 11, 'Add favorite', 'favorite', 'add', 2, 0, 0),
(50, 11, 'Store favorite', 'favorite', 'store', 3, 0, 0),
(51, 11, 'Delete favorite', 'favorite', 'delete', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `privilege_group`
--

CREATE TABLE `privilege_group` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` int(10) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privilege_group`
--

INSERT INTO `privilege_group` (`id`, `name`, `position`, `created_time`, `last_update`) VALUES
(1, 'blog', 1, 1732610795, 1732610795),
(2, 'product', 2, 1732610795, 1732610795),
(3, 'bill', 3, 1732610795, 1732610795),
(4, 'user', 4, 1732610795, 1732610795),
(5, 'category', 5, 0, 0),
(6, 'review', 6, 0, 0),
(7, 'coupon', 7, 0, 0),
(8, 'comment', 8, 0, 0),
(10, 'address', 9, 0, 0),
(11, 'favorite', 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_img` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'x-mark.png',
  `product_discount` smallint(6) DEFAULT 0,
  `product_count` smallint(6) DEFAULT 0,
  `product_cat` int(11) NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 là hiện thị, 0 là ko hiện ',
  `screen_cam` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `os` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gpu` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cpu` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pin` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `colors` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sizes` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ram` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bluetooth` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_img`, `product_discount`, `product_count`, `product_cat`, `product_status`, `screen_cam`, `os`, `gpu`, `cpu`, `pin`, `colors`, `sizes`, `ram`, `rom`, `bluetooth`, `created_at`) VALUES
(6, 'iPhone 15 Pro Max', 35990000, '15-pro-max_1732199896.png', 5, 26, 4, 1, '6.7\" Super Retina XDR OLED', 'iOS 17', 'Apple GPU', 'A17 Pro', '4422 mAh', 'Black', '6.7\"', '8GB', '256GB', '5.3', '2024-11-10 11:40:32'),
(7, 'iPhone 15 Pro', 29990000, '15-pro-max_1732199888.png', 5, 25, 4, 1, '6.1\" Super Retina XDR OLED', 'iOS 17', 'Apple GPU', 'A17 Pro', '3274 mAh', 'Blue', '6.1\"', '8GB', '128GB', '5.3', '2024-11-10 11:40:32'),
(8, 'iPhone 15 Plus', 25990000, 'iphone-15-plus_1732199855.png', 3, 39, 4, 1, '6.7\" Super Retina XDR OLED', 'iOS 17', 'Apple GPU', 'A16 Bionic', '4383 mAh', 'Pink', '6.7\"', '6GB', '128GB', '5.3', '2024-11-10 11:40:32'),
(9, 'iPhone 15', 22990000, 'iphone-15_1732199839.png', 3, 55, 4, 1, '6.1\" Super Retina XDR OLED', 'iOS 17', 'Apple GPU', 'A16 Bionic', '3719 mAh', 'Blue', '6.1\"', '6GB', '128GB', '5.3', '2024-11-10 11:40:32'),
(10, 'Samsung Galaxy S24 Ultra', 31990000, 's24_1732200052.png', 7, 35, 5, 1, '6.8\" Dynamic AMOLED 2X', 'Android 14', 'Adreno 750', 'Snapdragon 8 Gen 3', '5000 mAh', 'Black', '6.8\"', '12GB', '256GB', '5.3', '2024-11-10 11:40:32'),
(11, 'Samsung Galaxy S24plus', 25990000, 's24plus_1732200389.png', 5, 30, 5, 1, '6.7\" Dynamic AMOLED 2X', 'Android 14', 'Adreno 750', 'Snapdragon 8 Gen 3', '4900 mAh', 'Gray', '6.7\"', '12GB', '256GB', '5.3', '2024-11-10 11:40:32'),
(12, 'iPad Pro M2', 24990000, 'ipad-m2-pro-den-2_1732199681.png', 10, 25, 8, 1, '12.9\" Liquid Retina XDR', 'iPadOS 17', 'Apple GPU', 'Apple M2', '10758 mAh', 'Silver', '12.9\"', '8GB', '256GB', '5.0', '2024-10-15 11:40:32'),
(13, 'iPad Air M1', 16990000, 'ipad-air-5-5g-den-1_1732199659.png', 8, 26, 8, 1, '10.9\" Liquid Retina', 'iPadOS 17', 'Apple GPU', 'Apple M1', '8827 mAh', 'Blue', '10.9\"', '8GB', '128GB', '5.0', '2024-10-11 11:40:32'),
(14, 'MacBook Pro M3', 39990000, 'macbook-pro-14-inch-m3-pro-den-1_1732199646.png', 5, 20, 11, 1, '14.2\" Liquid Retina XDR', 'macOS', 'Apple GPU', 'Apple M3', '70Wh', 'Space Gray', '14.2\"', '16GB', '512GB', '5.0', '2024-11-10 11:40:32'),
(15, 'MacBook Air M2', 29990000, 'macbook-m2-xam-1_1732199625.png', 7, 25, 11, 1, '13.6\" Liquid Retina', 'macOS', 'Apple GPU', 'Apple M2', '52.6Wh', 'Midnight', '13.6\"', '8GB', '256GB', '5.0', '2024-11-06 11:40:32'),
(16, 'Samsung Galaxy S24', 20990000, 's24-ultra-den_1732199596.png', 5, 40, 5, 1, '6.7\" Dynamic AMOLED 2X', 'Android 13', 'Adreno 740', 'Snapdragon 8 Gen 2', '4400 mAh', 'Cream', '7.6\"', '12GB', '512GB', '5.3', '2024-11-10 21:14:43'),
(17, 'Samsung Galaxy Z Fold5', 40990000, 'z-fold5-3_1732199547.png', 10, 24, 5, 1, '6.2\" Dynamic AMOLED 2X', 'Android 14', 'Adreno 750', 'Snapdragon 8 Gen 3', '4000 mAh', 'Black', '6.2\"', '8GB', '256GB', '5.3', '2024-10-21 21:14:43'),
(18, 'Samsung Galaxy Z Flip5', 25990000, 'z-flip5-xam_1732199397.png', 50, 29, 5, 1, '6.7\" Dynamic AMOLED 2X', 'Android 13', 'Adreno 730', 'Snapdragon 8+ Gen 1', '8600 mAh', 'Black', '11.2\"', '8GB', '256GB', '5.2', '2024-09-15 21:14:43'),
(19, 'Xiaomi 14 Pro', 19990000, 'xiaomi-14-pro_1732199205.png', 12, 35, 6, 1, '6.73\" AMOLED', 'Android 14', 'Adreno 750', 'Snapdragon 8 Gen 3', '4880 mAh', 'Black', '6.73\"', '12GB', '256GB', '5.3', '2024-09-24 21:14:43'),
(20, 'OPPO Find X7 Pro', 24990000, 'oppofindx7pro_1732199188.jpg', 7, 28, 7, 1, '6.8\" AMOLED', 'Android 14', 'Dimensity 9300', 'Snapdragon 8 Gen 3', '5000 mAh', 'Blue', '6.8\"', '12GB', '256GB', '5.3', '2024-10-15 21:14:43'),
(21, 'Samsung Galaxy Tab S9 Ultra', 29990000, 's24-samsum_1732198974.png', 50, 19, 9, 1, '14.6\" Dynamic AMOLED 2X', 'Android 14', 'Adreno 750', 'Snapdragon 8 Gen 3', '8000 mAh', 'Black', '14.6\"', '12GB', '256GB', '5.3', '2024-11-10 21:14:43'),
(22, 'Xiaomi Pad 6 Pro', 12990000, 'Xiaomi Pad 6 Pro_1732199367.jpg', 15, 20, 10, 1, '11.5\" Liquid Retina', 'Android 14', 'MediaTek Dimensity 9000+', 'Snapdragon 8 Gen 2', '8600 mAh', 'Silver', '11.5\"', '12GB', '256GB', '5.3', '2024-11-10 21:14:43'),
(23, 'ASUS ROG Strix G16', 39990000, 'asus_1732198826.png', 8, 4, 12, 1, '16.1\" IPS', 'Windows 11', 'NVIDIA GeForce RTX 4060', 'Intel Core i7-13700H', '51Wh', 'Black', '16.1\"', '16GB', '512GB', '5.3', '2024-11-10 21:14:43'),
(24, 'Dell XPS 15', 45990000, 'del_1732198820.jpeg', 5, 18, 13, 1, '15.6\" IPS', 'Windows 11', 'NVIDIA GeForce RTX 4070', 'Intel Core i7-14700H', '56Wh', 'Silver', '15.6\"', '16GB', '1TB', '5.3', '2024-11-10 21:14:43'),
(25, 'MSI Creator Z17', 49990000, 'msi-creator-16-ai-studio-a1vig-078vn-1_1732198731.png', 7, 12, 14, 1, '16.1\" IPS', 'Windows 11', 'NVIDIA GeForce RTX 4070', 'Intel Core i7-14700H', '56Wh', 'Silver', '16.1\"', '16GB', '1TB', '5.3', '2024-11-10 21:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `review_userEmail` varchar(50) NOT NULL,
  `review_category` int(11) NOT NULL,
  `review_content` text NOT NULL,
  `review_dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `helpful` int(11) DEFAULT 0,
  `unhelpful` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `pro_id`, `review_userEmail`, `review_category`, `review_content`, `review_dateTime`, `helpful`, `unhelpful`) VALUES
(11, 12, 'khduy584@gmail.com', 4, 'adadas', '2024-11-21 13:20:01', 0, 1),
(13, 6, 'ndt2201@gmail.com', 4, 'tốt', '2024-11-22 11:56:31', 1, 0),
(14, 7, 'ndt2201@gmail.com', 1, 'sản phẩm chất lượng', '2024-11-25 09:45:46', 0, 0),
(15, 8, 'ndt2201@gmail.com', 3, 'Sản phẩm ọk', '2024-11-25 10:45:20', 1, 0),
(16, 8, 'ndt2201@gmail.com', 4, 'Sản phẩm chất lượng', '2024-11-25 10:46:31', 1, 0),
(17, 9, 'ndt2201@gmail.com', 5, 'sản phẩm đẹp', '2024-11-25 12:25:20', 1, 0),
(18, 9, 'ndt2201@gmail.com', 5, 'sản phẩm chất lượng', '2024-11-25 12:31:39', 2, 0),
(19, 8, 'ndt2201@gmail.com', 5, 'san pham dep', '2024-11-25 17:26:43', 0, 1),
(20, 8, 'thanhndpd11083@gmail.com', 5, 'Sản phẩm ngon lành', '2024-11-26 16:45:37', 2, 0),
(21, 7, 'thanhndpd11083@gmail.com', 5, 'san pham ôk', '2024-11-26 16:50:10', 0, 0),
(22, 6, 'thanhndpd11083@gmail.com', 2, 'sản phẩm cũng được', '2024-11-26 17:43:46', 1, 0),
(23, 6, 'thanhndpd11083@gmail.com', 3, 'sản phẩm ok', '2024-11-26 17:49:47', 1, 0),
(24, 6, 'thanhndpd11083@gmail.com', 5, 'Lên sao cho a', '2024-11-26 18:32:32', 1, 0),
(25, 6, 'thanhndpd11083@gmail.com', 3, 'ậdfdkajfhadkfhakdjfhfa', '2024-11-26 18:52:45', 0, 2),
(26, 6, 'ndt01@gmail.com', 4, 'Sản phẩm tạm ổn', '2024-11-27 14:35:58', 0, 2),
(27, 6, 'ndt01@gmail.com', 1, 'sản pjhaamr tệ', '2024-11-27 15:03:26', 1, 1),
(28, 7, 'ndt01@gmail.com', 5, 'san pham nhu cc', '2024-11-27 17:14:10', 1, 0),
(29, 7, 'ndt2201@gmail.com', 5, 'sản phẩm chất lượng', '2024-11-29 20:33:48', 0, 0),
(30, 13, 'ndt2201@gmail.com', 3, 'sản phẩm tạm được', '2024-12-02 09:19:40', 0, 1),
(31, 12, 'ndt2201@gmail.com', 3, 'san pham duoc', '2024-12-02 09:22:10', 0, 0),
(32, 7, 'ndt2201@gmail.com', 3, 'tu van nhiet tinh', '2024-12-04 14:53:53', 0, 0),
(33, 7, 'ndt2201@gmail.com', 2, 'tu van k nhiet tinh', '2024-12-04 14:58:24', 1, 0),
(34, 7, 'ndt2201@gmail.com', 2, 'ầkjaksdjasdapodwpodas', '2024-12-04 17:32:58', 1, 0),
(35, 12, 'Admin@gmail.com', 4, 'shop qua hay', '2024-12-04 21:06:15', 0, 0),
(36, 7, 'ndt2201@gmail.com', 1, 'fix da xong', '2024-12-04 21:20:01', 0, 1),
(37, 9, 'khacduy584@gmail.com', 5, 'Quá đẹp lun', '2024-12-05 13:47:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_categories`
--

CREATE TABLE `review_categories` (
  `review_categoryId` int(11) NOT NULL,
  `review_name` varchar(10) NOT NULL,
  `review_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review_categories`
--

INSERT INTO `review_categories` (`review_categoryId`, `review_name`, `review_count`) VALUES
(1, '1 Star', 3),
(2, '2 Star', 3),
(3, '3 Star', 5),
(4, '4 Star', 3),
(5, '5 Star', 4);

-- --------------------------------------------------------

--
-- Table structure for table `review_votes`
--

CREATE TABLE `review_votes` (
  `id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `vote_type` enum('like','dislike') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `review_votes`
--

INSERT INTO `review_votes` (`id`, `review_id`, `user_email`, `vote_type`, `created_at`) VALUES
(1, 20, 'ndt01@gmail.com', 'like', '2024-11-27 10:56:05'),
(3, 19, 'ndt01@gmail.com', 'dislike', '2024-11-27 11:00:37'),
(5, 15, 'ndt01@gmail.com', 'like', '2024-11-27 11:01:30'),
(11, 27, 'ndt2201@gmail.com', 'like', '2024-11-29 07:53:41'),
(14, 25, 'ndt2201@gmail.com', 'dislike', '2024-11-29 08:07:29'),
(15, 26, 'ndt2201@gmail.com', 'dislike', '2024-11-29 08:14:04'),
(16, 28, 'ndt2201@gmail.com', 'like', '2024-11-29 08:53:45'),
(21, 20, 'ndt2201@gmail.com', 'like', '2024-11-29 10:34:48'),
(24, 11, 'ndt2201@gmail.com', 'dislike', '2024-12-02 02:03:04'),
(25, 30, 'ndt2201@gmail.com', 'dislike', '2024-12-02 02:19:52'),
(26, 34, 'ndt2201@gmail.com', 'like', '2024-12-04 10:33:06'),
(30, 33, 'Admin@gmail.com', 'like', '2024-12-04 14:00:43'),
(31, 37, 'ndt2201@gmail.com', 'like', '2024-12-05 06:50:09'),
(32, 18, 'ndt2201@gmail.com', 'like', '2024-12-05 06:50:41'),
(33, 17, 'ndt2201@gmail.com', 'like', '2024-12-05 06:50:48'),
(35, 18, 'khacduy584@gmail.com', 'like', '2024-12-06 07:47:03'),
(36, 37, 'khacduy584@gmail.com', 'dislike', '2024-12-06 07:47:33'),
(37, 27, 'khduy584@gmail.com', 'dislike', '2024-12-07 15:15:49'),
(38, 26, 'khduy584@gmail.com', 'dislike', '2024-12-07 15:16:00'),
(39, 25, 'khduy584@gmail.com', 'dislike', '2024-12-07 15:16:08'),
(40, 24, 'khduy584@gmail.com', 'like', '2024-12-07 15:16:18'),
(41, 23, 'khduy584@gmail.com', 'like', '2024-12-07 15:16:28'),
(42, 22, 'khduy584@gmail.com', 'like', '2024-12-07 15:16:51'),
(43, 13, 'khduy584@gmail.com', 'like', '2024-12-07 15:17:10'),
(44, 36, 'nguyennguyenthanh2201@gmail.com', 'dislike', '2024-12-08 16:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(100) DEFAULT NULL,
  `user_full_name` varchar(61) DEFAULT NULL,
  `user_images` varchar(61) DEFAULT NULL,
  `user_password` varchar(110) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(12) DEFAULT NULL,
  `user_role` tinyint(1) NOT NULL DEFAULT 0,
  `google_id` varchar(61) DEFAULT NULL,
  `user_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 là Hiện\r\n0 là Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `user_full_name`, `user_images`, `user_password`, `user_email`, `user_phone`, `user_role`, `google_id`, `user_status`) VALUES
('Admin', '', 'thungo2023_Include_timeless_holi.png', '0192023a7bbd73250516f069df18b500', 'Admin@gmail.com', '0367716957 ', 1, NULL, 1),
('cuongtuan@gmail.com', NULL, '', '6ffbe72a9382364c3cdb0005fb870b13', 'cuongtuan@gmail.com', '1111', 2, NULL, 0),
('Nguyen Khac Duy', '', 'Blue Waves Surfing Club Logo.png', '', 'duynkps37404@fpt.edu.vn', '093241241', 0, '107109047711058407061', 1),
('emma_jonesAAA', 'Nguyễn Trần Mai Thyhhhhh', '', 'ee1c70c3e6d419b65e7d4f9b14a3e5d2', 'emma.jones@example.com', '5555', 2, NULL, 1),
('vypro1525056', 'Nguyễn Trần Mai Thy', '', '1f872071431b4c790aa266c4dc65f83a', 'jane.smith@example.com', '15555ggg', 0, NULL, 1),
('john_doe', '', '', '482c811da5d5b4bc6d497ffa98491e38', 'john.doe@example.com', '1234567890', 1, NULL, 1),
('kjhac duy', '', 'user.png', '25d55ad283aa400af464c76d713c07ad', 'khacduy584@gmail.com', '22222', 0, NULL, 1),
('khacduy', '', '', '25d55ad283aa400af464c76d713c07ad', 'khacduy5844@gmail.com', '1234567890', 0, NULL, 1),
('khac duy', '', '', '25d55ad283aa400af464c76d713c07ad', 'khduy222@gmail.com', '1234567890as', 0, NULL, 1),
('khacduy', '', 'user.png', '25d55ad283aa400af464c76d713c07ad', 'khduy584@gmail.com', NULL, 1, NULL, 1),
('Khoadeptrai', '', 'user.png', '5b004591d163ab53312ed4438e551f9d', 'Khoa@gmail.com', '123', 6, NULL, 0),
('khoadz123', '', 'user.png', '49c7723559fe27c6d9a767dcd00a196f', 'khoadz@123', NULL, 0, NULL, 0),
('Z0FrMzJxNXZ2WEQ1cFZRcmJNMXBwUT09', 'Z0FrMzJxNXZ2WEQ1cFZRcmJNMXBwUT09', 'd3UyYWFtalpVVUhtOU5lRS82bUZGMHJxTXd5c0ptNG1ta2J3WjhDQ1pLQT0=', 'e6771514b65079285528aecbe83deb52', 'leduylong3@gmail.com', NULL, 9, NULL, 1),
('le duy long', '', 'user.png', 'eee597277fa0e31a2bac3dff22e873e4', 'leduylongAdmin@gmail.com', NULL, 1, '114374951914294437080', 1),
('nguyenvy01052005', 'Nguyễn Trần Mai Thy', '', '123456789', 'maithy090@gmail.com', '1234567890', 0, NULL, 1),
('nvy', 'Nguyễn Trần Hạnh Vy', NULL, NULL, 'maithy09000@gmail.com', '123456789', 0, NULL, 1),
('hhhh123', 'Nguyễn Trần Mai Thy', NULL, NULL, 'maithy09082000@gmail.com', '01052005', 0, NULL, 1),
('maithy090820056789', 'Nguyễn Trần Mai Thy', NULL, '123456789', 'maithy09082001@gmail.com', '1234567890', 0, NULL, 1),
('vy2005', '', 'user.png', '25f9e794323b453885f5181f1b624d0b', 'maithy09082005@gmail.com', '0765687090', 0, NULL, 1),
('vyne152505', '', '', '1f872071431b4c790aa266c4dc65f83a', 'maithy09082006@gmail.com', '01052005', 0, NULL, 1),
('nguyenvy888', 'Nguyễn Trần Mai Thy', NULL, '123456789', 'maithy123@gmail.com', '1234567890', 0, NULL, 1),
('nguyenvy', 'Nguyễn Trần Mai Thy', NULL, '123456789', 'maithy123456789@gmail.com', '1234567890', 0, NULL, 1),
('moi123', 'Nguyễn Trần Mai Thy', NULL, '123456789', 'maithy2006@gmail.com', '01052005', 0, NULL, 1),
('nguyenvy01052005@gmail.com', 'Nguyễn Trần Mai Thy', '', '123456789', 'maithybbb666@gmail.com', '1234567890', 0, NULL, 1),
('michael_lee', '', 'user.png', '7d347cf0ee68174a3588f6cba31b8a67', 'michael.lee@example.com', '1122334455', 1, NULL, 1),
('T', '', 'user.png', 'e10adc3949ba59abbe56e057f20f883e', 'ndt01@gmail.com', NULL, 0, NULL, 1),
('DT', '', '', 'e10adc3949ba59abbe56e057f20f883e', 'ndt2201@gmail.com', '1234567899', 0, NULL, 1),
('Nguyễn Đức Thành', '', 'user.png', 'e10adc3949ba59abbe56e057f20f883e', 'nguyennguyenthanh2201@gmail.com', NULL, 1, NULL, 1),
('vy152505', '', 'user.png', '25f9e794323b453885f5181f1b624d0b', 'nguyenvy01052005@gmail.com', NULL, 1, NULL, 1),
('NDT', '', 'user.png', 'e10adc3949ba59abbe56e057f20f883e', 'thanhndpd11083@gmail.com', NULL, 1, NULL, 0),
('tuancuong', 'pass=username', 'user.png', '6ffbe72a9382364c3cdb0005fb870b13', 'tuancuong@gmail.com', '1321321', 4, NULL, 0),
('Long', 'le duy Long', 'user.png', '', 'untiminhoo86@gmail.com', NULL, 1, '114374951914294437080', 1),
('vypro152505', 'Nguyễn Trần Mai Thy', '', '1f872071431b4c790aa266c4dc65f83a', 'vy123@gmail.com', '1234567890', 0, NULL, 1),
('vypro152505', 'Nguyễn Trần Mai Thy', '', '1f872071431b4c790aa266c4dc65f83a', 'william.brown@example.com', '01052005', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE `user_privilege` (
  `id` int(11) NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_privilege`
--

INSERT INTO `user_privilege` (`id`, `user_email`, `privilege_id`, `created_time`, `last_updated`) VALUES
(336, 'thanhndpd11083@gmail.com', 1, 1732610795, 1732610795),
(337, 'thanhndpd11083@gmail.com', 4, 1732610795, 1732610795),
(338, 'thanhndpd11083@gmail.com', 2, 1732610795, 1732610795),
(339, 'thanhndpd11083@gmail.com', 5, 1732610795, 1732610795),
(340, 'thanhndpd11083@gmail.com', 8, 1732610795, 1732610795),
(341, 'thanhndpd11083@gmail.com', 6, 1732610795, 1732610795),
(342, 'thanhndpd11083@gmail.com', 3, 1732610795, 1732610795),
(343, 'thanhndpd11083@gmail.com', 7, 1732610795, 1732610795),
(344, 'thanhndpd11083@gmail.com', 23, 1732610795, 1732610795),
(345, 'thanhndpd11083@gmail.com', 24, 1732610795, 1732610795),
(2060, 'khduy584@gmail.com', 1, 1732610795, 1732610795),
(2061, 'khduy584@gmail.com', 4, 1732610795, 1732610795),
(2062, 'khduy584@gmail.com', 2, 1732610795, 1732610795),
(2063, 'khduy584@gmail.com', 5, 1732610795, 1732610795),
(2064, 'khduy584@gmail.com', 8, 1732610795, 1732610795),
(2065, 'khduy584@gmail.com', 6, 1732610795, 1732610795),
(2066, 'khduy584@gmail.com', 3, 1732610795, 1732610795),
(2067, 'khduy584@gmail.com', 7, 1732610795, 1732610795),
(2071, 'khduy584@gmail.com', 9, 1732610795, 1732610795),
(2073, 'khduy584@gmail.com', 15, 1732610795, 1732610795),
(2074, 'khduy584@gmail.com', 16, 1732610795, 1732610795),
(2075, 'khduy584@gmail.com', 10, 1732610795, 1732610795),
(2076, 'khduy584@gmail.com', 11, 1732610795, 1732610795),
(2077, 'khduy584@gmail.com', 12, 1732610795, 1732610795),
(2078, 'khduy584@gmail.com', 13, 1732610795, 1732610795),
(2081, 'khduy584@gmail.com', 28, 1732610795, 1732610795),
(2083, 'khduy584@gmail.com', 30, 1732610795, 1732610795),
(2085, 'khduy584@gmail.com', 45, 1732610795, 1732610795),
(2086, 'khduy584@gmail.com', 17, 1732610795, 1732610795),
(2087, 'khduy584@gmail.com', 33, 1732610795, 1732610795),
(2088, 'khduy584@gmail.com', 35, 1732610795, 1732610795),
(2090, 'khduy584@gmail.com', 37, 1732610795, 1732610795),
(2092, 'khduy584@gmail.com', 23, 1732610795, 1732610795),
(2093, 'khduy584@gmail.com', 24, 1732610795, 1732610795),
(2094, 'khduy584@gmail.com', 46, 1732610795, 1732610795),
(2095, 'khduy584@gmail.com', 39, 1732610795, 1732610795),
(2096, 'khduy584@gmail.com', 40, 1732610795, 1732610795),
(2097, 'khduy584@gmail.com', 41, 1732610795, 1732610795),
(2098, 'khduy584@gmail.com', 43, 1732610795, 1732610795),
(2099, 'khduy584@gmail.com', 18, 1732610795, 1732610795),
(2100, 'khduy584@gmail.com', 22, 1732610795, 1732610795),
(2421, 'nguyennguyenthanh2201@gmail.com', 1, 1732610795, 1732610795),
(2422, 'nguyennguyenthanh2201@gmail.com', 4, 1732610795, 1732610795),
(2423, 'nguyennguyenthanh2201@gmail.com', 2, 1732610795, 1732610795),
(2424, 'nguyennguyenthanh2201@gmail.com', 5, 1732610795, 1732610795),
(2425, 'nguyennguyenthanh2201@gmail.com', 8, 1732610795, 1732610795),
(2426, 'nguyennguyenthanh2201@gmail.com', 6, 1732610795, 1732610795),
(2427, 'nguyennguyenthanh2201@gmail.com', 3, 1732610795, 1732610795),
(2428, 'nguyennguyenthanh2201@gmail.com', 7, 1732610795, 1732610795),
(2430, 'nguyennguyenthanh2201@gmail.com', 9, 1732610795, 1732610795),
(2432, 'nguyennguyenthanh2201@gmail.com', 15, 1732610795, 1732610795),
(2433, 'nguyennguyenthanh2201@gmail.com', 16, 1732610795, 1732610795),
(2434, 'nguyennguyenthanh2201@gmail.com', 10, 1732610795, 1732610795),
(2435, 'nguyennguyenthanh2201@gmail.com', 11, 1732610795, 1732610795),
(2436, 'nguyennguyenthanh2201@gmail.com', 12, 1732610795, 1732610795),
(2437, 'nguyennguyenthanh2201@gmail.com', 13, 1732610795, 1732610795),
(2438, 'nguyennguyenthanh2201@gmail.com', 28, 1732610795, 1732610795),
(2439, 'nguyennguyenthanh2201@gmail.com', 30, 1732610795, 1732610795),
(2440, 'nguyennguyenthanh2201@gmail.com', 45, 1732610795, 1732610795),
(2441, 'nguyennguyenthanh2201@gmail.com', 17, 1732610795, 1732610795),
(2442, 'nguyennguyenthanh2201@gmail.com', 33, 1732610795, 1732610795),
(2443, 'nguyennguyenthanh2201@gmail.com', 35, 1732610795, 1732610795),
(2444, 'nguyennguyenthanh2201@gmail.com', 37, 1732610795, 1732610795),
(2445, 'nguyennguyenthanh2201@gmail.com', 23, 1732610795, 1732610795),
(2446, 'nguyennguyenthanh2201@gmail.com', 24, 1732610795, 1732610795),
(2447, 'nguyennguyenthanh2201@gmail.com', 46, 1732610795, 1732610795),
(2448, 'nguyennguyenthanh2201@gmail.com', 39, 1732610795, 1732610795),
(2449, 'nguyennguyenthanh2201@gmail.com', 40, 1732610795, 1732610795),
(2450, 'nguyennguyenthanh2201@gmail.com', 41, 1732610795, 1732610795),
(2451, 'nguyennguyenthanh2201@gmail.com', 43, 1732610795, 1732610795),
(2452, 'nguyennguyenthanh2201@gmail.com', 18, 1732610795, 1732610795),
(2453, 'nguyennguyenthanh2201@gmail.com', 22, 1732610795, 1732610795),
(2552, 'nguyenvy01052005@gmail.com', 1, 1732610795, 1732610795),
(2553, 'nguyenvy01052005@gmail.com', 8, 1732610795, 1732610795),
(2554, 'nguyenvy01052005@gmail.com', 6, 1732610795, 1732610795),
(2555, 'nguyenvy01052005@gmail.com', 3, 1732610795, 1732610795),
(2556, 'nguyenvy01052005@gmail.com', 7, 1732610795, 1732610795),
(2557, 'nguyenvy01052005@gmail.com', 9, 1732610795, 1732610795),
(2558, 'nguyenvy01052005@gmail.com', 15, 1732610795, 1732610795),
(2559, 'nguyenvy01052005@gmail.com', 16, 1732610795, 1732610795),
(2560, 'nguyenvy01052005@gmail.com', 10, 1732610795, 1732610795),
(2561, 'nguyenvy01052005@gmail.com', 11, 1732610795, 1732610795),
(2562, 'nguyenvy01052005@gmail.com', 12, 1732610795, 1732610795),
(2563, 'nguyenvy01052005@gmail.com', 13, 1732610795, 1732610795),
(2564, 'nguyenvy01052005@gmail.com', 17, 1732610795, 1732610795),
(2565, 'nguyenvy01052005@gmail.com', 33, 1732610795, 1732610795),
(2566, 'nguyenvy01052005@gmail.com', 35, 1732610795, 1732610795),
(2567, 'nguyenvy01052005@gmail.com', 37, 1732610795, 1732610795),
(2568, 'nguyenvy01052005@gmail.com', 23, 1732610795, 1732610795),
(2569, 'nguyenvy01052005@gmail.com', 24, 1732610795, 1732610795),
(2570, 'nguyenvy01052005@gmail.com', 46, 1732610795, 1732610795),
(2571, 'nguyenvy01052005@gmail.com', 39, 1732610795, 1732610795),
(2572, 'nguyenvy01052005@gmail.com', 40, 1732610795, 1732610795),
(2573, 'nguyenvy01052005@gmail.com', 41, 1732610795, 1732610795),
(2574, 'nguyenvy01052005@gmail.com', 43, 1732610795, 1732610795),
(2575, 'nguyenvy01052005@gmail.com', 18, 1732610795, 1732610795),
(2576, 'nguyenvy01052005@gmail.com', 22, 1732610795, 1732610795),
(2577, 'nguyenvy01052005@gmail.com', 28, 1732610795, 1732610795),
(2578, 'nguyenvy01052005@gmail.com', 30, 1732610795, 1732610795),
(2579, 'nguyenvy01052005@gmail.com', 45, 1732610795, 1732610795),
(2580, 'nguyenvy01052005@gmail.com', 48, 1732610795, 1732610795),
(2581, 'nguyenvy01052005@gmail.com', 49, 1732610795, 1732610795),
(2582, 'nguyenvy01052005@gmail.com', 50, 1732610795, 1732610795),
(2583, 'nguyenvy01052005@gmail.com', 51, 1732610795, 1732610795),
(2645, 'Admin@gmail.com', 1, 1732610795, 1732610795),
(2646, 'Admin@gmail.com', 4, 1732610795, 1732610795),
(2647, 'Admin@gmail.com', 2, 1732610795, 1732610795),
(2648, 'Admin@gmail.com', 5, 1732610795, 1732610795),
(2649, 'Admin@gmail.com', 8, 1732610795, 1732610795),
(2650, 'Admin@gmail.com', 6, 1732610795, 1732610795),
(2651, 'Admin@gmail.com', 3, 1732610795, 1732610795),
(2652, 'Admin@gmail.com', 7, 1732610795, 1732610795),
(2653, 'Admin@gmail.com', 9, 1732610795, 1732610795),
(2654, 'Admin@gmail.com', 15, 1732610795, 1732610795),
(2655, 'Admin@gmail.com', 10, 1732610795, 1732610795),
(2656, 'Admin@gmail.com', 11, 1732610795, 1732610795),
(2657, 'Admin@gmail.com', 12, 1732610795, 1732610795),
(2658, 'Admin@gmail.com', 13, 1732610795, 1732610795),
(2659, 'Admin@gmail.com', 17, 1732610795, 1732610795),
(2660, 'Admin@gmail.com', 33, 1732610795, 1732610795),
(2661, 'Admin@gmail.com', 35, 1732610795, 1732610795),
(2662, 'Admin@gmail.com', 37, 1732610795, 1732610795),
(2663, 'Admin@gmail.com', 23, 1732610795, 1732610795),
(2664, 'Admin@gmail.com', 24, 1732610795, 1732610795),
(2665, 'Admin@gmail.com', 39, 1732610795, 1732610795),
(2666, 'Admin@gmail.com', 40, 1732610795, 1732610795),
(2667, 'Admin@gmail.com', 41, 1732610795, 1732610795),
(2668, 'Admin@gmail.com', 43, 1732610795, 1732610795),
(2669, 'Admin@gmail.com', 18, 1732610795, 1732610795),
(2670, 'Admin@gmail.com', 22, 1732610795, 1732610795),
(2671, 'Admin@gmail.com', 28, 1732610795, 1732610795),
(2672, 'Admin@gmail.com', 45, 1732610795, 1732610795),
(2673, 'Admin@gmail.com', 48, 1732610795, 1732610795),
(2674, 'Admin@gmail.com', 49, 1732610795, 1732610795),
(2675, 'Admin@gmail.com', 51, 1732610795, 1732610795),
(2676, 'tuancuong@gmail.com', 1, 1732610795, 1732610795),
(2677, 'tuancuong@gmail.com', 4, 1732610795, 1732610795),
(2678, 'tuancuong@gmail.com', 2, 1732610795, 1732610795),
(2679, 'tuancuong@gmail.com', 5, 1732610795, 1732610795),
(2680, 'tuancuong@gmail.com', 8, 1732610795, 1732610795),
(2681, 'tuancuong@gmail.com', 6, 1732610795, 1732610795),
(2682, 'tuancuong@gmail.com', 3, 1732610795, 1732610795),
(2683, 'tuancuong@gmail.com', 7, 1732610795, 1732610795),
(2684, 'tuancuong@gmail.com', 9, 1732610795, 1732610795),
(2685, 'tuancuong@gmail.com', 15, 1732610795, 1732610795),
(2686, 'tuancuong@gmail.com', 10, 1732610795, 1732610795),
(2687, 'tuancuong@gmail.com', 11, 1732610795, 1732610795),
(2688, 'tuancuong@gmail.com', 12, 1732610795, 1732610795),
(2689, 'tuancuong@gmail.com', 13, 1732610795, 1732610795),
(2690, 'tuancuong@gmail.com', 17, 1732610795, 1732610795),
(2691, 'tuancuong@gmail.com', 33, 1732610795, 1732610795),
(2692, 'tuancuong@gmail.com', 35, 1732610795, 1732610795),
(2693, 'tuancuong@gmail.com', 37, 1732610795, 1732610795),
(2694, 'tuancuong@gmail.com', 23, 1732610795, 1732610795),
(2695, 'tuancuong@gmail.com', 24, 1732610795, 1732610795),
(2696, 'tuancuong@gmail.com', 39, 1732610795, 1732610795),
(2697, 'tuancuong@gmail.com', 40, 1732610795, 1732610795),
(2698, 'tuancuong@gmail.com', 41, 1732610795, 1732610795),
(2699, 'tuancuong@gmail.com', 43, 1732610795, 1732610795),
(2700, 'tuancuong@gmail.com', 18, 1732610795, 1732610795),
(2701, 'tuancuong@gmail.com', 22, 1732610795, 1732610795),
(2702, 'tuancuong@gmail.com', 28, 1732610795, 1732610795),
(2703, 'tuancuong@gmail.com', 45, 1732610795, 1732610795),
(2704, 'tuancuong@gmail.com', 48, 1732610795, 1732610795),
(2705, 'tuancuong@gmail.com', 49, 1732610795, 1732610795),
(2706, 'tuancuong@gmail.com', 51, 1732610795, 1732610795);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_userid` (`address_userEmail`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bills_ibfk_1` (`bill_userEmail`),
  ADD KEY `bill_coupon` (`bill_coupon`),
  ADD KEY `bill_address` (`bill_address`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD KEY `fk_bill_details_products` (`pro_id`),
  ADD KEY `bill_details_ibfk_3` (`id_bill`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `author_id` (`author_email`),
  ADD KEY `blog_pro_id` (`blog_pro_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_userEmail` (`cart_userEmail`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `FK_danhmuc_cha` (`parent_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_userid` (`comment_userEmail`),
  ADD KEY `comment_blog_id` (`comment_blog_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `coupon_name` (`coupon_name`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `favorite_proid` (`favorite_proid`),
  ADD KEY `favorite_userEmail` (`favorite_userEmail`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `privilege_group`
--
ALTER TABLE `privilege_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_categories` (`product_cat`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `review_userid` (`review_userEmail`),
  ADD KEY `review_category` (`review_category`);

--
-- Indexes for table `review_categories`
--
ALTER TABLE `review_categories`
  ADD PRIMARY KEY (`review_categoryId`);

--
-- Indexes for table `review_votes`
--
ALTER TABLE `review_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_vote` (`review_id`,`user_email`),
  ADD KEY `fk_review_votes_user` (`user_email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_email`);

--
-- Indexes for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_email`),
  ADD KEY `privilege_id` (`privilege_id`),
  ADD KEY `user_id_2` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `privilege_group`
--
ALTER TABLE `privilege_group`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `review_categories`
--
ALTER TABLE `review_categories`
  MODIFY `review_categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `review_votes`
--
ALTER TABLE `review_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2707;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`address_userEmail`) REFERENCES `user` (`user_email`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`bill_coupon`) REFERENCES `coupons` (`coupon_id`),
  ADD CONSTRAINT `bills_ibfk_3` FOREIGN KEY (`bill_userEmail`) REFERENCES `user` (`user_email`),
  ADD CONSTRAINT `bills_ibfk_4` FOREIGN KEY (`bill_address`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_ibfk_3` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`bill_id`),
  ADD CONSTRAINT `fk_bill_details_products` FOREIGN KEY (`pro_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_email`) REFERENCES `user` (`user_email`),
  ADD CONSTRAINT `fk_blogs_products` FOREIGN KEY (`blog_pro_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_userEmail`) REFERENCES `user` (`user_email`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `fk_cart_item_products` FOREIGN KEY (`pro_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_danhmuc_cha` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_userEmail`) REFERENCES `user` (`user_email`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_blog_id`) REFERENCES `blogs` (`blog_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`favorite_userEmail`) REFERENCES `user` (`user_email`),
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`favorite_proid`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `privilege_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_products` FOREIGN KEY (`pro_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`review_userEmail`) REFERENCES `user` (`user_email`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`review_category`) REFERENCES `review_categories` (`review_categoryId`);

--
-- Constraints for table `review_votes`
--
ALTER TABLE `review_votes`
  ADD CONSTRAINT `fk_review_votes_review` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_review_votes_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`user_email`) ON DELETE CASCADE;

--
-- Constraints for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD CONSTRAINT `user_privilege_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privilege_ibfk_2` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
