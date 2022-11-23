-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2022 at 11:17 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chandani`
--

-- --------------------------------------------------------

--
-- Table structure for table `eir_complain`
--

CREATE TABLE `eir_complain` (
  `cid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `c_uid` int(5) NOT NULL,
  `sp_uid` int(5) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('New','Pending','Completed') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eir_complain`
--

INSERT INTO `eir_complain` (`cid`, `pid`, `c_uid`, `sp_uid`, `description`, `status`) VALUES
(4, 4, 6, 5, 'thrtujrtjr6tj', 'Completed'),
(5, 2, 7, 5, 'dfhfjhf', 'Pending'),
(9, 2, 7, 4, 'gkyukoyu', 'Completed'),
(10, 4, 7, 4, 'srgerhetrhrt', 'Completed'),
(12, 4, 7, 4, 'rtetwet', 'Completed'),
(13, 2, 11, 12, 'TV Complain', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `eir_product`
--

CREATE TABLE `eir_product` (
  `pid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eir_product`
--

INSERT INTO `eir_product` (`pid`, `name`, `description`, `photo`) VALUES
(2, 'TV', 'TV', 'c9a1fdac6e082dd89e7173244f34d7b3168.jpg'),
(4, 'Laptop', 'Laptop', 'c7349814912077983efde425081db058269.jpg'),
(9, 'Speaker', 'Speaker 1', 'f0dc81a8a980333e911f475b62f6f238227.jpg'),
(10, 'Mic', 'Mic', 'b006a34268254ff1011bf0058a01e18e121.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `eir_user`
--

CREATE TABLE `eir_user` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `typeofuser` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eir_user`
--

INSERT INTO `eir_user` (`uid`, `name`, `password`, `age`, `phone`, `photo`, `typeofuser`) VALUES
(1, 'admin', '123', 21, '1234567890', '', 'Admin'),
(4, 'SP1', '123', 21, '1234567890', '1dc8ce0f91a88a7ec22dbb2ee48eb2ef463.jpg', 'Service Provider'),
(5, 'SP2', '123', 18, '1234567890', '59e7feaf4d864b4b187481aaf34b5f66413.jpg', 'Service Provider'),
(6, 'Khushi', '123', 21, '1234567890', 'f3fe70a563ff280e6f587f0b345a64e3268.png', 'Customer'),
(7, 'Chandani', '123', 21, '1234567890', '917381c4c61c9230932e7dd30edad64e157.png', 'Customer'),
(8, 'Sumit', '123', 24, '1234567890', 'f3fe70a563ff280e6f587f0b345a64e3114.png', 'Customer'),
(9, 'Priya', '123', 21, '1234567890', 'b7622b34ac854cf258ea578af51b3d1a155.png', 'Customer'),
(10, 'Mini', '123', 21, '8451203697', '1dc8ce0f91a88a7ec22dbb2ee48eb2ef255.jpg', 'Customer'),
(11, 'Aman', '123', 23, '4512369870', '2e051ebf0979e6abad1adff14b6c6bc5306.jpg', 'Customer'),
(13, 'Seema', '123', 40, '8569741230', 'b2f18a0dd6e086181e7870d229e75ea0497.jpg', 'Customer'),
(14, 'SP3', '123', 21, '1234567890', '2e051ebf0979e6abad1adff14b6c6bc5159.jpg', 'Service Provider');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(5) NOT NULL,
  `category` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  `avail_qty` int(5) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `category`, `name`, `price`, `avail_qty`, `description`, `image`) VALUES
(1, 'Fashion', 'T-Shirt', 2000, 5, 'Men T-Shirt', 'b7622b34ac854cf258ea578af51b3d1a391.png'),
(4, 'Fashion', 'Saree', 1500, 150, 'Light Printed Saree\r\nParty Dress', 'b7622b34ac854cf258ea578af51b3d1a300.png'),
(8, 'Cosmetic', 'Hair Serum', 30, 30, 'Make Heair smooth and silky...', 'b7622b34ac854cf258ea578af51b3d1a406.png'),
(9, 'Food', 'Burger', 150, 20, 'Burger with lots of veggies', 'f3fe70a563ff280e6f587f0b345a64e3310.png'),
(11, 'Fashion', 'Shirt', 500, 50, 'Shirt for men', '917381c4c61c9230932e7dd30edad64e167.png');

-- --------------------------------------------------------

--
-- Table structure for table `sc_cart`
--

CREATE TABLE `sc_cart` (
  `cart_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `date_time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_cart`
--

INSERT INTO `sc_cart` (`cart_id`, `uid`, `pid`, `qty`, `date_time`) VALUES
(11, 3, 3, 2, '0000-00-00 00:00:00.000000'),
(41, 5, 44, 2, '2022-09-15 13:29:17.000000'),
(42, 5, 45, 3, '2022-09-15 13:32:26.000000'),
(47, 2, 49, 1, '2022-09-15 14:17:31.000000'),
(48, 2, 42, 3, '2022-09-15 14:17:41.000000'),
(49, 2, 48, 1, '2022-09-23 13:29:40.000000');

-- --------------------------------------------------------

--
-- Table structure for table `sc_category`
--

CREATE TABLE `sc_category` (
  `cid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_category`
--

INSERT INTO `sc_category` (`cid`, `name`, `description`, `photo`) VALUES
(1, 'Clothes', 'Clothes for men women children \r\nVery best quality of products', ''),
(3, 'Cosmatic', 'Cosmatic Products', ''),
(5, 'Health', 'Healthy life style related products', ''),
(6, 'Kitchen Tools', 'Kitchen Tools ', ''),
(7, 'Electronic Gadgets', 'Electronics Gadgets', ''),
(8, 'Jwellery', 'Jwellery Products', '');

-- --------------------------------------------------------

--
-- Table structure for table `sc_product`
--

CREATE TABLE `sc_product` (
  `pid` int(5) NOT NULL,
  `cid` int(5) NOT NULL,
  `scid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `avail_qty` int(5) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_product`
--

INSERT INTO `sc_product` (`pid`, `cid`, `scid`, `name`, `description`, `photo`, `avail_qty`, `price`) VALUES
(1, 1, 1, 'Blue Shirt', 'Blue Shirt', 'ccf0f1389ac860012178b7be34bab84d306.jpg', 13, 500),
(3, 3, 4, 'Light Face powder', 'Face Powder best Quality', '0714c6e618153e92e03432938217d8eb371.jpg', 33, 499),
(4, 1, 5, ' Yellow Cotton Saree', 'Yellow Green Cotton Saree', 'f8dae7c7f6cf6999136c5125fb48f502378.jpg', 4, 1400),
(5, 3, 6, 'light color Nail Polish', 'Light Color nail Polish', '153c888347b80f1d5ef7f806a2227ac2340.jpg', 0, 120),
(6, 1, 1, 'White Shirt', 'White Professional Shirt', 'ceb09af676708d7d7335bf5ab1f22ec8275.jpg', 18, 200),
(7, 3, 4, 'blush pallete', 'fefgergetrh', '8e06d4440bc76c3592478e4bfb378855432.jpg', 20, 1290),
(8, 8, 19, 'Diamond ring', 'Diamond ring', '974d788900e307e267031e022049771c375.jpg', 20, 150000),
(9, 8, 19, 'Pink Color Diamond Ring', 'Pink Color Diamond Ring', 'c93ac760bb4011169a318b2b2e37cfed75.jpg', 5, 250000),
(10, 8, 19, 'Silver Ring', 'Silver RIng', '7e7c94baf1c83b629ef62ae04b9cf2cb218.jpg', 20, 20000),
(11, 8, 18, 'Gold heavy Earring', 'Gold Heavy Earring', 'ae721f2fb8581ef0c0a942f776cfa2cb195.jpg', 10, 120000),
(12, 8, 18, 'Star Earring', 'Glod Star Earring', '8b5f6bdd9b74aed57caf1a54816ca51d104.jpg', 50, 8000),
(13, 8, 18, 'gold light weight Earring', 'gold Earring', 'f97eaae016901405ea0ff5e8ba6b98b4402.jpg', 500, 150),
(14, 8, 18, 'Gold Earring', 'Gold Earring with diamond', 'd10b20c2ff09cd0ddf2039f248131926163.jpg', 20, 150000),
(16, 8, 17, 'Gold Chain for women', 'Gold Chain for women', 'f9bd07e59e085ca676c5bab3051fa9c0269.jpg', 20, 120000),
(17, 8, 17, 'Gold thin Chain', 'Gold thin Chain for women', '11f3635a8c6ae5e85a1e2e577177694b125.jpg', 20, 100000),
(18, 8, 17, 'Heavy Neckless', 'Heavy Chain for women', 'dc98e3436719b264123410f7e8402d3d56.jpg', 5, 250000),
(19, 7, 14, 'HP Laptop', 'HP Laptop', '7b0f82735ce21cbf641f6c293c5dcc46430.jpg', 40, 80000),
(20, 7, 14, 'mac-laptop', 'Mac laptop', 'c7349814912077983efde425081db058369.jpg', 30, 120000),
(21, 1, 5, 'Lahenga', 'blue white Lahenga', 'bernie-almanzar-goMFAkWUAEY-unsplash.jpg', 200, 4000),
(22, 1, 5, 'Lahenga', 'green Lahenga', '787713a6f6c9284b84e9372ae2c9720a470.jpg', 200, 4000),
(23, 1, 5, 'Black Pink Saree', 'Black Pink Saree', 'bulbul-ahmed-1n74YwCkcKU-unsplash.jpg', 200, 1400),
(24, 1, 5, 'Blue Saree', 'Blue Saree', 'bcb26a927508db408ad71caf40ffeffa72.jpg', 40, 2500),
(25, 1, 5, 'Orange Saree', 'Orange Saree', '01d267c5618a5ddc30e5f4e774b0931995.jpg', 198, 1500),
(26, 1, 5, 'black Saree', 'Black Saree', '2f14acce63511578ca9afa52f584b87278.jpg', 100, 1500),
(27, 7, 12, 'Mic Set', 'Mic for Singer', '89f7575a964d167d61d116aa5a6ee6f1112.jpg', 20, 5000),
(28, 7, 12, 'Mic', 'Mic', 'b006a34268254ff1011bf0058a01e18e273.jpg', 50, 1200),
(29, 7, 13, 'Mini Speaker', 'Mini Speaker', 'f0dc81a8a980333e911f475b62f6f238406.jpg', 20, 2000),
(30, 7, 13, 'Home theater', 'Home theater', 'fdcd89f808853156537198cafa141b36247.jpg', 50, 25000),
(31, 7, 20, 'Small Size Refridgerator', 'Small Size Refridgerator', '48cd486e948cc862ec79850e2685553b340.jpg', 20, 15000),
(32, 7, 20, '2- door-fridge', '2- door-fridge', '48cd486e948cc862ec79850e2685553b345.jpg', 5, 35000),
(33, 7, 11, 'TV', 'TV', 'c9a1fdac6e082dd89e7173244f34d7b3209.jpg', 5, 150000),
(34, 7, 21, 'Camera', 'Camera', '293e3bd2ddbd50dfec13c5e04dcf2b6a294.jpg', 50, 15000),
(35, 5, 22, 'Whey Protein Powder', 'Whey Protein Powder', '9016e81951ab5b3006374488a72ef69b479.jpg', 50, 1500),
(36, 5, 22, 'Soyabean protein Powder', 'Soyabean protein Powder', 'e281a3a1e4b2e72974e21430845754a9202.jpg', 20, 2000),
(37, 5, 9, 'White Cotton Face Mask', 'White Cotton Face Mask', 'b615f16ce1ffc0cd81d9354716d66c72232.jpg', 50, 50),
(39, 1, 7, 'Girl dress', 'Girldress', '7867268795266c0199896fe44b63d9d4129.jpg', 50, 2500),
(40, 1, 7, 'White Gown', 'White Gown', '2007d6a1a55d37c7104309fb4cc1594466.jpg', 50, 1500),
(41, 1, 7, 'Boy Dress', 'Boy Dress', 'ce755417fc3872a155434f259b3e125f157.jpg', 50, 2500),
(42, 6, 15, 'Wooden-set', 'Wooden-set', 'chopping-tray.jpg', 20, 3500),
(43, 6, 16, 'Bowls', 'Bowls Colored', 'bowl.jpg', 50, 1200),
(44, 1, 1, 'White T-Shirt', 'White T-Shirt', '8292e501a1e769e166fa59ad68e4a8e0186.jpg', 50, 500),
(45, 3, 4, 'Multi-color Nail Polish', 'Multi-color Nail Polish', '9955f68e8a1ecc326b7a9adeb3bab093103.jpg', 50, 1500),
(46, 3, 8, 'Brushes', 'Brushes', 'f372cb827f7589975773137f89f5a8f4133.jpg', 40, 2500),
(47, 3, 4, 'Cosmatic Products', 'Cosmatic Products', 'f372cb827f7589975773137f89f5a8f4175.jpg', 20, 5000),
(48, 3, 23, 'Lotion', 'Body Lotion', 'bd835786d3076bbf4ca40eb27d40d398387.jpg', 49, 4500),
(49, 3, 23, 'Face Cream', 'Face Cream', '708d7e421ab75dba15e7758de8b23016244.jpg', 16, 2500),
(50, 1, 5, 'White Top', 'White Top', '25567d832750d3ec9c9c9af561771d01412.jpg', 41, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `sc_sales`
--

CREATE TABLE `sc_sales` (
  `sid` int(5) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `uid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `qty` int(10) NOT NULL,
  `amt` int(10) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_sales`
--

INSERT INTO `sc_sales` (`sid`, `invoice_id`, `uid`, `pid`, `qty`, `amt`, `date_time`) VALUES
(1, '', 2, 1, 1, 500, '2022-09-02 00:00:00'),
(2, '', 2, 4, 2, 2800, '0000-00-00 00:00:00'),
(3, '', 2, 4, 2, 2800, '2022-09-08 14:33:27'),
(4, '', 2, 4, 2, 2800, '2022-09-08 14:35:13'),
(5, '', 2, 4, 2, 2800, '2022-09-08 14:41:31'),
(6, '', 2, 5, 3, 360, '2022-09-08 14:43:47'),
(7, '', 2, 3, 3, 1497, '2022-09-08 14:43:47'),
(8, '', 2, 5, 3, 360, '2022-09-08 14:44:04'),
(9, '', 2, 3, 3, 1497, '2022-09-08 14:44:04'),
(10, '', 2, 5, 3, 360, '2022-09-08 14:56:31'),
(11, '', 2, 3, 3, 1497, '2022-09-08 14:56:31'),
(12, '', 2, 4, 3, 4200, '2022-09-10 10:01:06'),
(13, '2022/09/10 06:58:33am21398', 2, 3, 2, 998, '2022-09-10 10:28:33'),
(14, '2022/09/10 06:58:33am21398', 2, 6, 2, 400, '2022-09-10 10:28:33'),
(15, '2022/09/10 07:00:33am2500', 2, 1, 1, 500, '2022-09-10 10:30:33'),
(16, '2022/09/10-07:01:24am2120', 2, 5, 1, 120, '2022-09-10 10:31:24'),
(17, '2022/09/10-07:05:25am3500', 3, 1, 1, 500, '2022-09-10 10:35:25'),
(18, '2022/09/14-06:36:19am21200', 2, 50, 1, 1200, '2022-09-14 10:06:19'),
(20, '2022/09/14-06:55:33am23700', 2, 50, 1, 1200, '2022-09-14 10:25:33'),
(21, '2022/09/14-06:55:33am23700', 2, 49, 1, 2500, '2022-09-14 10:25:33'),
(22, '2022/09/14-07:02:16am21200', 2, 50, 1, 1200, '2022-09-14 10:32:16'),
(23, '2022/09/14-07:04:27am21200', 2, 50, 1, 1200, '2022-09-14 10:34:27'),
(24, '2022/09/14-11:06:20am23500', 2, 25, 2, 3000, '2022-09-14 14:36:20'),
(25, '2022/09/14-11:06:21am23500', 2, 1, 1, 500, '2022-09-14 14:36:21'),
(26, '2022/09/14-11:06:47am27000', 2, 49, 1, 2500, '2022-09-14 14:36:47'),
(27, '2022/09/14-11:06:47am27000', 2, 48, 1, 4500, '2022-09-14 14:36:47'),
(28, '2022/09/14-11:37:31am23700', 2, 50, 1, 1200, '2022-09-14 15:07:31'),
(29, '2022/09/14-11:37:31am23700', 2, 49, 1, 2500, '2022-09-14 15:07:31'),
(30, '2022/09/15-10:46:33am25200', 2, 51, 2, 400, '2022-09-15 14:16:33'),
(31, '2022/09/15-10:46:33am25200', 2, 50, 4, 4800, '2022-09-15 14:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `sc_sub_category`
--

CREATE TABLE `sc_sub_category` (
  `scid` int(5) NOT NULL,
  `cid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_sub_category`
--

INSERT INTO `sc_sub_category` (`scid`, `cid`, `name`, `description`, `photo`) VALUES
(1, 1, 'Men Wear', 'Men Wear', ''),
(4, 3, 'Face Powder', 'Face Powder', ''),
(5, 1, 'Women Wear', 'Women wear', ''),
(6, 3, 'Nail Polish', 'Nail Polish Best Quality', ''),
(7, 1, 'Kids Wear', 'Kids Wear', ''),
(8, 3, 'Brushes', 'Brushes', ''),
(9, 5, 'Face Mask', 'Face Mask', ''),
(10, 6, 'Container', 'Container', ''),
(11, 7, 'TV', 'TV Products', ''),
(12, 7, 'Mic', 'Mic', ''),
(13, 7, 'Speaker', 'Speaker', ''),
(14, 7, 'Laptop', 'Laptop', ''),
(15, 6, 'wooden', 'Wooden kitchen tools', ''),
(16, 6, 'Dinner set', 'Dinner set', ''),
(17, 8, 'Chain', 'Chain', ''),
(18, 8, 'Earring', 'Earrings', ''),
(19, 8, 'Ring', 'Ring', ''),
(20, 7, 'Refridgerator', 'Refridgeratoe', ''),
(21, 7, 'Camera', 'Camera', ''),
(22, 5, 'Protein Powder', 'Protein Powder', ''),
(23, 3, 'Body Lotion', 'Body Lotion', ''),
(24, 7, 'Mobile', 'Mobile Products', '');

-- --------------------------------------------------------

--
-- Table structure for table `sc_user`
--

CREATE TABLE `sc_user` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `typeofuser` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_user`
--

INSERT INTO `sc_user` (`uid`, `name`, `email`, `password`, `age`, `phone`, `photo`, `typeofuser`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 21, '1234567890', 'julian-wan-WNoLnJo7tS8-unsplash.png', 'Admin'),
(2, 'Chandani', 'chandani@gmail.com', '123', 21, '1234567890', 'christopher-campbell-rDEOVtE7vOs-unsplash.png', 'Customer'),
(3, 'Khushi', '', '123', 18, '1234567890', '917381c4c61c9230932e7dd30edad64e150.png', 'Customer'),
(4, 'Mini', '', '123', 21, '1234567890', '32203d44568d32b486b1d4fef9e0df4a306.png', 'Customer'),
(5, 'Sumit', 'sumit@gmail.com', '123', 23, '8523697412', '612a3ca2bed8e919f43e424258742f89339.jpg', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `email`) VALUES
(1, 'Chandani', '123', 'chandani@gmail.com'),
(2, 'Sumit SIngh', '123', 'sumit@gmail.com'),
(3, 'Khushi', '123', 'khushi@gmail.com'),
(4, 'Aman', '123', 'aman@gmail.com'),
(5, 'Khushbu', '123', 'khushbu@gmail.com'),
(6, 'Jyoti', '123', 'jyoti@gmail.com'),
(8, 'aaa', '123', 'aaa@gmail.com'),
(10, 'User10', '123', 'user10@gmail.com'),
(14, 'User11', '123', 'user10@gmail.com'),
(15, 'User11', '123', 'user10@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eir_complain`
--
ALTER TABLE `eir_complain`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `eir_product`
--
ALTER TABLE `eir_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `eir_user`
--
ALTER TABLE `eir_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sc_cart`
--
ALTER TABLE `sc_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `sc_category`
--
ALTER TABLE `sc_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `sc_product`
--
ALTER TABLE `sc_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sc_sales`
--
ALTER TABLE `sc_sales`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sc_sub_category`
--
ALTER TABLE `sc_sub_category`
  ADD PRIMARY KEY (`scid`);

--
-- Indexes for table `sc_user`
--
ALTER TABLE `sc_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eir_complain`
--
ALTER TABLE `eir_complain`
  MODIFY `cid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `eir_product`
--
ALTER TABLE `eir_product`
  MODIFY `pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `eir_user`
--
ALTER TABLE `eir_user`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sc_cart`
--
ALTER TABLE `sc_cart`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `sc_category`
--
ALTER TABLE `sc_category`
  MODIFY `cid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sc_product`
--
ALTER TABLE `sc_product`
  MODIFY `pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sc_sales`
--
ALTER TABLE `sc_sales`
  MODIFY `sid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sc_sub_category`
--
ALTER TABLE `sc_sub_category`
  MODIFY `scid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sc_user`
--
ALTER TABLE `sc_user`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
