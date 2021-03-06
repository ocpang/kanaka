-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2019 at 03:26 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kanaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_code` int(11) NOT NULL,
  `menu_name` char(50) NOT NULL,
  `menu_link` char(50) NOT NULL,
  `menu_icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `parent_menu_id` int(11) NOT NULL,
  `lang` char(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_code`, `menu_name`, `menu_link`, `menu_icon`, `parent_menu_id`, `lang`, `status`, `date_created`, `date_modified`) VALUES
(1, 2, 'Master', 'master', 'icon-grid', 0, 'master', '1', '2019-04-25 01:16:17', '2019-04-27 23:54:40'),
(2, 16, 'Category', 'category', 'icon-briefcase', 1, 'category', '1', NULL, '2019-05-12 21:50:22'),
(3, 1, 'Reports', 'reports', 'icon-notebook', 0, 'reports', '1', NULL, '2017-10-11 15:45:49'),
(4, 14, 'Menus', 'menu', NULL, 1, 'menus', '1', NULL, NULL),
(5, 13, 'Users', 'users/account', NULL, 1, 'users', '1', NULL, NULL),
(6, 15, 'Zona', 'zona', 'icon-clock', 1, 'zona', '1', '2017-10-11 17:02:05', '2019-05-15 22:06:39'),
(7, 7, 'Invoice', 'invoice', NULL, 3, 'invoice', '1', '2018-12-13 10:27:48', '2019-05-27 15:04:46'),
(8, 9, 'Product', 'product', NULL, 1, 'product', '1', '2019-04-28 20:19:00', '2019-04-28 20:19:00'),
(9, 10, 'DIPO', 'dipo', NULL, 1, 'dipo', '1', '2019-04-28 20:19:30', '2019-04-28 20:19:30'),
(10, 11, 'Partner', 'partner', NULL, 1, 'partner', '1', '2019-04-28 20:19:55', '2019-04-28 20:19:55'),
(11, 12, 'Vendor', 'vendor', NULL, 1, 'vendor', '1', '2019-04-28 20:20:13', '2019-05-18 14:09:02'),
(12, 11, 'Customer', 'customerreport', NULL, 3, 'customer', '0', '2019-04-28 20:21:08', '2019-05-27 16:25:25'),
(13, 8, 'Company', 'companyreport', NULL, 3, 'company', '1', '2019-04-28 20:21:29', '2019-04-28 20:21:29'),
(14, 9, 'DIPO Report', 'diporeport', NULL, 3, 'dipo_report', '0', '2019-04-28 20:22:00', '2019-05-27 16:24:56'),
(15, 10, 'Partner Report', 'partnerreport', NULL, 3, 'partner_report', '0', '2019-04-28 20:22:20', '2019-05-27 16:25:12'),
(16, 4, 'Admin', 'admin', 'icon-users', 0, 'admin', '1', '2019-04-28 20:22:36', '2019-04-28 20:22:36'),
(17, 3, 'Blog', 'blog', 'icon-feed', 0, 'blog', '1', '2019-04-28 20:22:47', '2019-04-28 20:22:47'),
(18, 4, 'Pricelist', 'pricelist', NULL, 3, 'pricelist', '1', '2019-05-19 09:36:15', '2019-05-19 09:42:18'),
(19, 5, 'Surat Pesanan', 'suratpesanan', NULL, 3, 'surat_pesanan', '1', '2019-05-25 12:31:22', '2019-05-25 12:33:28'),
(20, 6, 'Surat Jalan', 'suratjalan', NULL, 3, 'surat_jalan', '1', '2019-05-27 14:42:46', '2019-05-27 14:43:03'),
(21, 21, 'Chart Of Accounts', 'chartofaccount', NULL, 1, 'chartofaccount', '1', '2019-06-12 10:25:16', '2019-06-12 10:31:38'),
(22, 22, 'Jurnal', 'jurnal', NULL, 3, 'jurnal', '1', '2019-06-12 11:26:32', '2019-06-12 11:26:32'),
(23, 23, 'Stock', 'stock', NULL, 3, 'stock', '1', '2019-06-24 10:25:53', '2019-06-24 10:25:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
