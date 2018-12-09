-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2018 at 08:57 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bc_cstmdisc`
--

CREATE TABLE `bc_cstmdisc` (
  `whp_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `whp` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_cstmdisc`
--

INSERT INTO `bc_cstmdisc` (`whp_id`, `customer_id`, `whp`) VALUES
(1, 21, 25),
(2, 22, 15),
(3, 23, 20),
(4, 24, 15),
(5, 25, 30),
(6, 26, 10),
(7, 27, 12),
(8, 28, 8);

-- --------------------------------------------------------

--
-- Table structure for table `bc_customers`
--

CREATE TABLE `bc_customers` (
  `customer_id` int(11) NOT NULL,
  `cstm_name` varchar(100) NOT NULL,
  `cstm_addr` varchar(250) NOT NULL,
  `cstm_city` varchar(100) NOT NULL,
  `cstm_phone` bigint(20) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_customers`
--

INSERT INTO `bc_customers` (`customer_id`, `cstm_name`, `cstm_addr`, `cstm_city`, `cstm_phone`, `stmp`) VALUES
(24, 'DR FAIZAN ANSARI', '112, NOORANI MANZIL, KHADAK ROAD, MASJID BUNDER', 'MUMBAI', 9876543210, '2018-11-13 14:05:38'),
(25, 'SAIMA BANO', 'DHOBITALAO, TAWRE STADIUM', 'BHIWANDI', 9876543210, '2018-11-13 14:07:02'),
(26, 'MISBAH MEDICAL', 'NEAR DIWAN SHAH DARGAH, DIWAN SHAH', 'BHIWANDI', 9876543210, '2018-11-15 05:19:21'),
(27, 'ANSARI MEDICAL', '218, BAG E FIRDAUS, VANJARPATTI NAKA', 'BHIWANDI', 9876543210, '2018-11-15 05:20:37'),
(28, 'BHARAT MEDICAL', 'OLD AGRA ROAD, MANDAI', 'BHIWANDI', 9876543210, '2018-11-15 05:21:22'),
(22, 'HAKEEM SHAHID AZMI', 'BANDIGHAT', 'MOHAMADABAD', 9876543210, '2018-11-09 12:23:48'),
(23, 'AJMERI DAWAKHANA', 'NEAR DHOBI TALAO STADIUM, GAURIPADA', 'BHIWANDI', 9876543210, '2018-11-09 12:24:35'),
(21, 'SHADAB SHAIKH', 'CRESCENT MODEL SCHOOL, GANDHI NAGAR, KUNDA', 'KUNDA', 9876543210, '2018-11-04 03:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `bc_orders`
--

CREATE TABLE `bc_orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ordr_date` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `distotal` decimal(10,2) NOT NULL,
  `tot_tax` decimal(10,2) NOT NULL,
  `totalamt` decimal(10,2) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_orders`
--

INSERT INTO `bc_orders` (`order_id`, `customer_id`, `ordr_date`, `subtotal`, `distotal`, `tot_tax`, `totalamt`, `stmp`) VALUES
(2, 21, '2018-11-08', '1350.00', '202.50', '57.38', '1204.88', '2018-11-11 13:54:24'),
(3, 23, '2018-11-09', '9960.00', '786.00', '458.70', '9632.70', '2018-11-11 13:54:24'),
(4, 22, '2018-11-09', '59015.50', '6764.73', '3822.36', '56073.13', '2018-11-11 13:54:24'),
(5, 24, '2018-11-13', '1887.00', '142.80', '209.30', '1953.50', '2018-11-13 14:08:23'),
(6, 25, '2018-11-13', '630.00', '31.50', '29.93', '628.43', '2018-11-13 14:09:02'),
(7, 25, '2018-11-13', '266.00', '26.60', '28.73', '268.13', '2018-11-13 14:09:44'),
(8, 27, '2018-11-14', '2024.00', '140.80', '144.06', '2027.26', '2018-11-15 05:44:53'),
(9, 28, '2018-11-14', '3965.20', '193.66', '308.18', '4079.72', '2018-11-15 05:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `bc_orditems`
--

CREATE TABLE `bc_orditems` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `expiry` varchar(250) NOT NULL,
  `qty_billed` int(11) NOT NULL,
  `qty_free` int(11) NOT NULL,
  `whole_price` decimal(10,2) NOT NULL,
  `disc_one` decimal(10,2) NOT NULL,
  `disc_two` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_orditems`
--

INSERT INTO `bc_orditems` (`item_id`, `order_id`, `product_id`, `expiry`, `qty_billed`, `qty_free`, `whole_price`, `disc_one`, `disc_two`, `amount`, `stmp`) VALUES
(19, 5, 38, '10/2020', 2, 0, '306.00', '2.50', '0.00', '668.30', '2018-11-13 14:08:23'),
(18, 5, 35, '03/2025', 25, 2, '51.00', '5.00', '5.00', '1285.20', '2018-11-13 14:08:23'),
(3, 2, 27, '02/2021', 10, 0, '135.00', '15.00', '0.00', '1204.88', '2018-11-08 10:30:01'),
(4, 3, 32, '02/2021', 10, 1, '576.00', '10.00', '0.00', '5443.20', '2018-11-09 12:33:41'),
(5, 3, 28, '05/2019', 15, 3, '280.00', '2.50', '2.50', '4189.50', '2018-11-09 12:33:41'),
(6, 4, 34, '02/2022', 28, 0, '280.50', '10.00', '0.00', '7422.03', '2018-11-09 13:29:08'),
(7, 4, 33, '08/2021', 24, 0, '144.50', '5.00', '5.00', '3277.26', '2018-11-09 13:29:08'),
(8, 4, 36, '10/2025', 8, 0, '892.50', '2.50', '2.50', '7596.96', '2018-11-09 13:29:08'),
(9, 4, 38, '12/2025', 30, 0, '306.00', '10.00', '5.00', '8739.36', '2018-11-09 13:29:08'),
(10, 4, 37, '12/2025', 16, 0, '161.50', '5.00', '0.00', '2749.38', '2018-11-09 13:29:08'),
(11, 4, 35, '01/2024', 5, 0, '51.00', '5.00', '0.00', '271.32', '2018-11-09 13:29:08'),
(12, 4, 27, '06/2020', 15, 0, '153.00', '5.00', '0.00', '2289.26', '2018-11-09 13:29:08'),
(13, 4, 28, '06/2020', 29, 0, '297.50', '10.00', '5.00', '7700.04', '2018-11-09 13:29:08'),
(14, 4, 32, '09/2021', 6, 0, '612.00', '5.00', '0.00', '3662.82', '2018-11-09 13:29:08'),
(15, 4, 31, '03/2020', 32, 0, '323.00', '10.00', '5.00', '9224.88', '2018-11-09 13:29:08'),
(16, 4, 30, '04/2023', 17, 0, '170.00', '12.50', '7.50', '2427.60', '2018-11-09 13:29:08'),
(17, 4, 29, '05/2020', 8, 0, '89.25', '5.00', '0.00', '712.22', '2018-11-09 13:29:08'),
(20, 6, 27, '02/2021', 5, 0, '126.00', '2.50', '2.50', '628.43', '2018-11-13 14:09:02'),
(21, 7, 37, '02/2021', 2, 0, '133.00', '10.00', '0.00', '268.13', '2018-11-13 14:09:44'),
(22, 8, 43, '02/2023', 10, 2, '123.20', '2.50', '2.50', '1228.92', '2018-11-15 05:44:53'),
(23, 8, 35, '02/2021', 15, 3, '52.80', '10.00', '0.00', '798.34', '2018-11-15 05:44:53'),
(24, 9, 39, '02/2022', 5, 0, '66.24', '5.00', '0.00', '352.40', '2018-11-15 05:55:40'),
(25, 9, 40, '03/2021', 15, 2, '55.20', '2.50', '0.00', '847.67', '2018-11-15 05:55:40'),
(26, 9, 43, '12/2019', 10, 0, '128.80', '2.50', '0.00', '1318.59', '2018-11-15 05:55:40'),
(27, 9, 35, '11/2020', 10, 2, '55.20', '5.00', '0.00', '587.33', '2018-11-15 05:55:40'),
(28, 9, 36, '01/2023', 1, 0, '966.00', '7.50', '2.50', '973.73', '2018-11-15 05:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `bc_ordtaxes`
--

CREATE TABLE `bc_ordtaxes` (
  `tax_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tax_name` varchar(100) NOT NULL,
  `tax_prcnt` float NOT NULL,
  `tax_amt` float NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_ordtaxes`
--

INSERT INTO `bc_ordtaxes` (`tax_id`, `order_id`, `product_id`, `tax_name`, `tax_prcnt`, `tax_amt`, `stmp`) VALUES
(38, 5, 38, 'CGST', 6, 35.8, '2018-11-13 14:08:23'),
(37, 5, 38, 'SGST', 6, 35.8, '2018-11-13 14:08:23'),
(36, 5, 35, 'CGST', 6, 68.85, '2018-11-13 14:08:23'),
(35, 5, 35, 'SGST', 6, 68.85, '2018-11-13 14:08:23'),
(5, 2, 27, 'SGST', 2.5, 28.69, '2018-11-08 10:30:01'),
(6, 2, 27, 'CGST', 2.5, 28.69, '2018-11-08 10:30:01'),
(7, 3, 32, 'SGST', 2.5, 129.6, '2018-11-09 12:33:41'),
(8, 3, 32, 'CGST', 2.5, 129.6, '2018-11-09 12:33:41'),
(9, 3, 28, 'SGST', 2.5, 99.75, '2018-11-09 12:33:41'),
(10, 3, 28, 'CGST', 2.5, 99.75, '2018-11-09 12:33:41'),
(11, 4, 34, 'SGST', 2.5, 176.72, '2018-11-09 13:29:08'),
(12, 4, 34, 'CGST', 2.5, 176.72, '2018-11-09 13:29:08'),
(13, 4, 33, 'SGST', 2.5, 78.03, '2018-11-09 13:29:08'),
(14, 4, 33, 'CGST', 2.5, 78.03, '2018-11-09 13:29:08'),
(15, 4, 36, 'SGST', 6, 406.98, '2018-11-09 13:29:08'),
(16, 4, 36, 'CGST', 6, 406.98, '2018-11-09 13:29:08'),
(17, 4, 38, 'SGST', 6, 468.18, '2018-11-09 13:29:08'),
(18, 4, 38, 'CGST', 6, 468.18, '2018-11-09 13:29:08'),
(19, 4, 37, 'SGST', 6, 147.29, '2018-11-09 13:29:08'),
(20, 4, 37, 'CGST', 6, 147.29, '2018-11-09 13:29:08'),
(21, 4, 35, 'SGST', 6, 14.54, '2018-11-09 13:29:08'),
(22, 4, 35, 'CGST', 6, 14.54, '2018-11-09 13:29:08'),
(23, 4, 27, 'SGST', 2.5, 54.51, '2018-11-09 13:29:08'),
(24, 4, 27, 'CGST', 2.5, 54.51, '2018-11-09 13:29:08'),
(25, 4, 28, 'SGST', 2.5, 183.33, '2018-11-09 13:29:08'),
(26, 4, 28, 'CGST', 2.5, 183.33, '2018-11-09 13:29:08'),
(27, 4, 32, 'SGST', 2.5, 87.21, '2018-11-09 13:29:08'),
(28, 4, 32, 'CGST', 2.5, 87.21, '2018-11-09 13:29:08'),
(29, 4, 31, 'SGST', 2.5, 219.64, '2018-11-09 13:29:08'),
(30, 4, 31, 'CGST', 2.5, 219.64, '2018-11-09 13:29:08'),
(31, 4, 30, 'SGST', 2.5, 57.8, '2018-11-09 13:29:08'),
(32, 4, 30, 'CGST', 2.5, 57.8, '2018-11-09 13:29:08'),
(33, 4, 29, 'SGST', 2.5, 16.96, '2018-11-09 13:29:08'),
(34, 4, 29, 'CGST', 2.5, 16.96, '2018-11-09 13:29:08'),
(39, 6, 27, 'SGST', 2.5, 14.96, '2018-11-13 14:09:02'),
(40, 6, 27, 'CGST', 2.5, 14.96, '2018-11-13 14:09:02'),
(41, 7, 37, 'SGST', 6, 14.36, '2018-11-13 14:09:44'),
(42, 7, 37, 'CGST', 6, 14.36, '2018-11-13 14:09:44'),
(43, 8, 43, 'SGST', 2.5, 29.26, '2018-11-15 05:44:53'),
(44, 8, 43, 'CGST', 2.5, 29.26, '2018-11-15 05:44:53'),
(45, 8, 35, 'SGST', 6, 42.77, '2018-11-15 05:44:53'),
(46, 8, 35, 'CGST', 6, 42.77, '2018-11-15 05:44:53'),
(47, 9, 39, 'SGST', 6, 18.88, '2018-11-15 05:55:40'),
(48, 9, 39, 'CGST', 6, 18.88, '2018-11-15 05:55:40'),
(49, 9, 40, 'SGST', 2.5, 20.18, '2018-11-15 05:55:40'),
(50, 9, 40, 'CGST', 2.5, 20.18, '2018-11-15 05:55:40'),
(51, 9, 43, 'SGST', 2.5, 31.4, '2018-11-15 05:55:40'),
(52, 9, 43, 'CGST', 2.5, 31.4, '2018-11-15 05:55:40'),
(53, 9, 35, 'SGST', 6, 31.46, '2018-11-15 05:55:40'),
(54, 9, 35, 'CGST', 6, 31.46, '2018-11-15 05:55:40'),
(55, 9, 36, 'SGST', 6, 52.16, '2018-11-15 05:55:40'),
(56, 9, 36, 'CGST', 6, 52.16, '2018-11-15 05:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `bc_prodtax`
--

CREATE TABLE `bc_prodtax` (
  `tax_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tax_name` varchar(250) NOT NULL,
  `tax_percent` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_prodtax`
--

INSERT INTO `bc_prodtax` (`tax_id`, `product_id`, `tax_name`, `tax_percent`) VALUES
(1, 28, 'SGST', 2.5),
(2, 28, 'CGST', 2.5),
(3, 27, 'SGST', 2.5),
(4, 27, 'CGST', 2.5),
(5, 29, 'SGST', 2.5),
(6, 29, 'CGST', 2.5),
(7, 30, 'SGST', 2.5),
(8, 30, 'CGST', 2.5),
(9, 31, 'SGST', 2.5),
(10, 31, 'CGST', 2.5),
(11, 32, 'SGST', 2.5),
(12, 32, 'CGST', 2.5),
(13, 33, 'SGST', 2.5),
(14, 33, 'CGST', 2.5),
(15, 34, 'SGST', 2.5),
(16, 34, 'CGST', 2.5),
(17, 35, 'SGST', 6),
(18, 35, 'CGST', 6),
(19, 36, 'SGST', 6),
(20, 36, 'CGST', 6),
(21, 37, 'SGST', 6),
(22, 37, 'CGST', 6),
(23, 38, 'SGST', 6),
(24, 38, 'CGST', 6),
(25, 39, 'SGST', 6),
(26, 39, 'CGST', 6),
(27, 40, 'SGST', 2.5),
(28, 40, 'CGST', 2.5),
(29, 41, 'SGST', 2.5),
(30, 41, 'CGST', 2.5),
(31, 42, 'SGST', 2.5),
(32, 42, 'CGST', 2.5),
(33, 43, 'SGST', 2.5),
(34, 43, 'CGST', 2.5),
(35, 44, 'SGST', 2.5),
(36, 44, 'CGST', 2.5),
(37, 45, 'SGST', 2.5),
(38, 45, 'CGST', 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `bc_products`
--

CREATE TABLE `bc_products` (
  `product_id` int(11) NOT NULL,
  `prd_name` varchar(1000) NOT NULL,
  `prd_mfctr` varchar(1000) NOT NULL,
  `prd_pkg` varchar(250) NOT NULL,
  `prd_mrp` float NOT NULL,
  `prd_qty` int(11) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_products`
--

INSERT INTO `bc_products` (`product_id`, `prd_name`, `prd_mfctr`, `prd_pkg`, `prd_mrp`, `prd_qty`, `stmp`) VALUES
(45, 'HAKIMI KALONJI OIL', 'HAKIMI HERBALS', '200 ML', 530, 150, '2018-11-15 05:29:17'),
(44, 'HAKIMI KALONJI OIL', 'HAKIMI HERBALS', '100', 270, 150, '2018-11-15 05:28:07'),
(43, 'HAKIMI KALONJI OIL', 'HAKIMI HERBALS', '50 ML', 140, 128, '2018-11-15 05:55:40'),
(42, 'HAKIMI ROSE WATER', 'HAKIMI HERBALS', '500 ML', 280, 200, '2018-11-15 05:26:35'),
(41, 'HAKIMI ROSE WATER', 'HAKIMI HERBALS', '200 ML', 115, 200, '2018-11-15 05:26:07'),
(40, 'HAKIMI ROSE WATER', 'HAKIMI HERBALS', '100 ML', 60, 183, '2018-11-15 05:55:40'),
(39, 'HAKIMI HERBAL OINTMENT', 'HAKIMI HERBALS', '25 GMS', 72, 245, '2018-11-15 05:55:40'),
(38, 'HAKIMI ZAFRAN', 'HAKIMI HERBALS', '1 GM', 360, 218, '2018-11-13 14:08:23'),
(37, 'HAKIMI ZAFRAN', 'HAKIMI HERBALS', '500 MG', 190, 182, '2018-11-13 14:09:44'),
(36, 'HAKIMI SHAHI HONEY', 'HAKIMI HERBALS', '250 GMS', 1050, 91, '2018-11-15 05:55:40'),
(35, 'HAYAT OIL', 'HAKIMI HERBALS', '10 ML', 60, 38, '2018-11-15 05:55:40'),
(34, 'DAWAUL MISK MOTADIL JAWAHAR', 'HAKIMI HERBALS', '125 GMS', 330, 222, '2018-11-09 13:29:08'),
(33, 'DAWAUL MISK MOTADIL JAWAHAR', 'HAKIMI HERBALS', '60 GMS', 170, 226, '2018-11-09 13:29:08'),
(32, 'MAJUN FALASAFA', 'HAKIMI HERBALS', '1 KG', 720, 83, '2018-11-09 13:29:08'),
(31, 'MAJUN FALASAFA', 'HAKIMI HERBALS', '500 GMS', 380, 168, '2018-11-09 13:29:08'),
(30, 'MAJUN FALASAFA', 'HAKIMI HERBALS', '250 GMS', 200, 183, '2018-11-09 13:29:08'),
(29, 'MAJUN FALASAFA', 'HAKIMI HERBALS', '125 GMS', 105, 192, '2018-11-09 13:29:08'),
(27, 'KHAMIRA GAWZABAN AMBARI JADWAR UD SALEEBWALA', 'HAKIMI HERBALS', '60 GMS', 180, 220, '2018-11-13 14:09:02'),
(28, 'KHAMIRA GAWZABAN AMBARI JADWAR UD SALEEBWALA', 'HAKIMI HERBALS', '125', 350, 117, '2018-11-09 13:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `bc_settings`
--

CREATE TABLE `bc_settings` (
  `setting_id` int(11) NOT NULL,
  `keyname` varchar(100) NOT NULL,
  `keyvalue` varchar(5000) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_settings`
--

INSERT INTO `bc_settings` (`setting_id`, `keyname`, `keyvalue`, `stmp`) VALUES
(1, 'password', '452b2037cad07f0d938625d4e41d4197', '2018-10-22 04:39:03'),
(2, 'taxes', 'a:3:{i:0;a:1:{s:4:\"name\";s:4:\"SGST\";}i:1;a:1:{s:4:\"name\";s:4:\"CGST\";}i:2;a:1:{s:4:\"name\";s:4:\"IGST\";}}', '2018-11-02 03:50:23'),
(3, 'address', 'SHOP NO 2, ABBA APTS, JOGESHWARI (W)', '2018-10-29 07:47:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bc_cstmdisc`
--
ALTER TABLE `bc_cstmdisc`
  ADD PRIMARY KEY (`whp_id`);

--
-- Indexes for table `bc_customers`
--
ALTER TABLE `bc_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `bc_orders`
--
ALTER TABLE `bc_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `bc_orditems`
--
ALTER TABLE `bc_orditems`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `bc_ordtaxes`
--
ALTER TABLE `bc_ordtaxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `bc_prodtax`
--
ALTER TABLE `bc_prodtax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `bc_products`
--
ALTER TABLE `bc_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `bc_settings`
--
ALTER TABLE `bc_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bc_cstmdisc`
--
ALTER TABLE `bc_cstmdisc`
  MODIFY `whp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bc_customers`
--
ALTER TABLE `bc_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bc_orders`
--
ALTER TABLE `bc_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bc_orditems`
--
ALTER TABLE `bc_orditems`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bc_ordtaxes`
--
ALTER TABLE `bc_ordtaxes`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `bc_prodtax`
--
ALTER TABLE `bc_prodtax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `bc_products`
--
ALTER TABLE `bc_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `bc_settings`
--
ALTER TABLE `bc_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
