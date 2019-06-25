-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 25, 2019 at 02:40 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminmar_martha_dbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bank_owner_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bank_id`),
  KEY `banks_bank_owner_id_foreign` (`bank_owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1034 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_owner_id`, `bank_name`, `bank_account_name`, `bank_account_number`, `created_at`, `updated_at`) VALUES
(1001, 1002, 'BPI', 'Jessie Amangyen', NULL, '2019-06-17 19:02:57', '2019-06-17 19:02:57'),
(1002, 1003, NULL, NULL, NULL, '2019-06-18 06:44:07', '2019-06-18 06:44:07'),
(1003, 1004, 'Norma A. Lu', 'MetroBank', '366-3-366-31346-0', '2019-06-19 00:18:07', '2019-06-19 00:18:07'),
(1004, 1005, 'Metrobank', 'Carina Castillo', '003-3-73315899-0', '2019-06-19 01:06:07', '2019-06-19 01:06:07'),
(1005, 1006, NULL, NULL, NULL, '2019-06-21 00:00:54', '2019-06-21 00:00:54'),
(1006, 1007, NULL, NULL, '34805233018', '2019-06-21 00:20:20', '2019-06-21 00:20:20'),
(1007, 1008, NULL, NULL, '8520116650', '2019-06-21 00:22:45', '2019-06-21 00:22:45'),
(1008, 1009, NULL, NULL, NULL, '2019-06-21 00:24:21', '2019-06-21 00:24:21'),
(1009, 1010, NULL, NULL, NULL, '2019-06-21 00:26:56', '2019-06-21 00:26:56'),
(1011, 1012, NULL, NULL, '10400045117', '2019-06-21 00:31:38', '2019-06-21 00:31:38'),
(1012, 1013, NULL, NULL, NULL, '2019-06-21 00:37:48', '2019-06-21 00:37:48'),
(1013, 1014, NULL, NULL, NULL, '2019-06-21 00:38:56', '2019-06-21 00:38:56'),
(1014, 1015, NULL, NULL, NULL, '2019-06-21 00:39:43', '2019-06-21 00:39:43'),
(1015, 1016, NULL, NULL, NULL, '2019-06-21 00:40:38', '2019-06-21 00:40:38'),
(1016, 1017, NULL, NULL, '1830999026', '2019-06-21 00:41:41', '2019-06-21 00:41:41'),
(1017, 1018, NULL, NULL, '1760327229', '2019-06-21 00:43:05', '2019-06-21 00:43:05'),
(1018, 1019, NULL, NULL, '1219116167', '2019-06-21 00:44:27', '2019-06-21 00:44:27'),
(1019, 1020, NULL, NULL, '33733160773', '2019-06-21 00:47:30', '2019-06-21 00:47:30'),
(1020, 1021, NULL, NULL, '5180207399', '2019-06-21 00:54:35', '2019-06-21 00:54:35'),
(1021, 1022, NULL, NULL, '1838010148', '2019-06-21 00:56:08', '2019-06-21 00:56:08'),
(1022, 1023, NULL, NULL, '5520030066', '2019-06-21 00:58:35', '2019-06-21 00:58:35'),
(1023, 1024, 'METROBANK,SUSANO BRANCH', 'Jennifer B. Salansang', '3113311239881', '2019-06-24 21:35:15', '2019-06-24 21:35:15'),
(1024, 1025, 'BDO SM City Novaliches', 'Ma. Emma Aguimbag', '7350089829', '2019-06-24 21:43:16', '2019-06-24 21:43:16'),
(1025, 1026, 'BDO-SM', 'Mariel C. Chock', '001830551513', '2019-06-24 21:45:42', '2019-06-24 21:45:42'),
(1026, 1027, 'Metrobank-Magsaysay', 'Jennifer Chua', '3003-12475-76-4', '2019-06-24 21:47:48', '2019-06-24 21:47:48'),
(1027, 1028, NULL, 'BDO Account', '0051-8009-2486', '2019-06-24 21:52:28', '2019-06-24 21:52:28'),
(1031, 1032, 'BDO-SM Baguio', 'Manolito C. Chavez', '1830291686', '2019-06-24 22:16:33', '2019-06-24 22:16:33'),
(1030, 1031, 'SECURITY BANK', 'Nancy Ong Co', '00000-1151-6919', '2019-06-24 22:12:32', '2019-06-24 22:12:32'),
(1032, 1033, 'BDO', 'Arlene F. Pacio', '000790491427', '2019-06-24 22:20:18', '2019-06-24 22:20:18'),
(1033, 1034, 'BDO-SM Baguio', 'Leizelle Jade P. Oasay/Marlene Pagatpatan', '007460108224', '2019-06-24 22:22:54', '2019-06-24 22:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `enrollment_date` date NOT NULL,
  `contract_owner_id` int(10) UNSIGNED NOT NULL,
  `contract_room_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`contract_id`),
  KEY `contracts_contract_owner_id_foreign` (`contract_owner_id`),
  KEY `contracts_contract_room_id_foreign` (`contract_room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `enrollment_date`, `contract_owner_id`, `contract_room_id`, `created_at`, `updated_at`) VALUES
(3, '2016-06-22', 1002, 1001, '2019-06-17 19:02:57', '2019-06-17 19:02:57'),
(4, '2016-11-07', 1003, 1002, '2019-06-18 06:44:07', '2019-06-18 06:44:07'),
(5, '2018-06-27', 1004, 1003, '2019-06-19 00:18:07', '2019-06-19 00:18:07'),
(6, '2016-04-05', 1005, 1004, '2019-06-19 01:06:07', '2019-06-19 01:06:07'),
(8, '2018-02-13', 1006, 1005, '2019-06-21 00:00:54', '2019-06-21 00:00:54'),
(9, '2018-07-25', 1007, 1006, '2019-06-21 00:20:20', '2019-06-21 00:20:20'),
(10, '2018-02-19', 1008, 1007, '2019-06-21 00:22:45', '2019-06-21 00:22:45'),
(11, '2018-02-19', 1009, 1007, '2019-06-21 00:24:21', '2019-06-21 00:24:21'),
(12, '2019-12-31', 1010, 1008, '2019-06-21 00:26:56', '2019-06-21 00:26:56'),
(14, '2017-10-05', 1012, 1009, '2019-06-21 00:31:38', '2019-06-21 00:31:38'),
(15, '2017-10-05', 1013, 1009, '2019-06-21 00:37:48', '2019-06-21 00:37:48'),
(16, '2017-04-05', 1014, 1010, '2019-06-21 00:38:56', '2019-06-21 00:38:56'),
(17, '2017-04-05', 1015, 1010, '2019-06-21 00:39:43', '2019-06-21 00:39:43'),
(18, '2019-01-01', 1016, 1011, '2019-06-21 00:40:38', '2019-06-21 00:40:38'),
(19, '2019-02-26', 1017, 1012, '2019-06-21 00:41:41', '2019-06-21 00:41:41'),
(20, '2018-09-19', 1018, 1013, '2019-06-21 00:43:05', '2019-06-21 00:43:05'),
(21, '2018-08-07', 1019, 1014, '2019-06-21 00:44:27', '2019-06-21 00:44:27'),
(22, '2018-01-15', 1020, 1015, '2019-06-21 00:47:30', '2019-06-21 00:47:30'),
(23, '2018-09-08', 1021, 1016, '2019-06-21 00:54:35', '2019-06-21 00:54:35'),
(24, '2018-12-21', 1022, 1017, '2019-06-21 00:56:08', '2019-06-21 00:56:08'),
(25, '2018-10-22', 1023, 1018, '2019-06-21 00:58:35', '2019-06-21 00:58:35'),
(26, '2012-11-22', 1024, 1090, '2019-06-24 21:35:15', '2019-06-24 21:35:15'),
(27, '2012-11-12', 1025, 1091, '2019-06-24 21:43:16', '2019-06-24 21:43:16'),
(28, '2013-06-04', 1026, 1092, '2019-06-24 21:45:42', '2019-06-24 21:45:42'),
(29, '2013-05-06', 1027, 1060, '2019-06-24 21:47:48', '2019-06-24 21:47:48'),
(30, '2017-12-21', 1028, 1094, '2019-06-24 21:52:28', '2019-06-24 21:52:28'),
(34, '2013-06-01', 1032, 1095, '2019-06-24 22:16:33', '2019-06-24 22:16:33'),
(33, '2017-11-03', 1031, 1093, '2019-06-24 22:12:32', '2019-06-24 22:12:32'),
(35, '2019-10-13', 1033, 1063, '2019-06-24 22:20:18', '2019-06-24 22:20:18'),
(36, '2019-06-25', 1034, 1096, '2019-06-24 22:22:54', '2019-06-24 22:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

DROP TABLE IF EXISTS `guardians`;
CREATE TABLE IF NOT EXISTS `guardians` (
  `guardian_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `guardian_resident_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`guardian_id`),
  KEY `guardians_guardian_resident_id_foreign` (`guardian_resident_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1024 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(73, '2014_10_12_000000_create_users_table', 1),
(74, '2014_10_12_100000_create_password_resets_table', 1),
(75, '2019_06_16_122901_create_rooms_table', 1),
(76, '2019_06_16_130854_create_residents_table', 1),
(77, '2019_06_16_131232_create_owners_table', 1),
(78, '2019_06_17_024144_create_guardians_table', 1),
(79, '2019_06_17_031856_create_transactions_table', 1),
(80, '2019_06_17_054434_create_payments_table', 1),
(81, '2019_06_17_075135_create_representatives_table', 1),
(82, '2019_06_17_081816_create_banks_table', 1),
(83, '2019_06_17_134739_create_contracts_table', 1),
(84, '2019_06_19_032019_add_primary_resident_id_to_residents', 2),
(85, '2019_06_19_081438_add_floor_number_to_rooms', 3),
(86, '2019_06_21_012527_add_authenticated_to_users', 4);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `owner_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_birthdate` date DEFAULT NULL,
  `owner_gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_civil_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_ethnicity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id_info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_telephone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_house_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_barangay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_municipality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`owner_id`),
  UNIQUE KEY `owners_owner_email_address_unique` (`owner_email_address`),
  UNIQUE KEY `owners_owner_mobile_number_unique` (`owner_mobile_number`)
) ENGINE=MyISAM AUTO_INCREMENT=1035 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `owner_first_name`, `owner_middle_name`, `owner_last_name`, `owner_birthdate`, `owner_gender`, `owner_nationality`, `owner_civil_status`, `owner_ethnicity`, `owner_id_info`, `owner_email_address`, `owner_mobile_number`, `owner_telephone_number`, `owner_house_number`, `owner_barangay`, `owner_municipality`, `owner_province`, `owner_zip`, `owner_img`, `created_at`, `updated_at`) VALUES
(1002, 'Jessie', NULL, 'Amangyen', NULL, NULL, NULL, NULL, NULL, 'IBP Roll # 51280', 'verone_1817@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-17 19:02:57', '2019-06-17 19:02:57'),
(1003, 'Violeta', NULL, 'King', NULL, NULL, NULL, NULL, NULL, NULL, 'evrolpindo@yahoo.com.ph', NULL, NULL, '28 Hillside, Block 2,', NULL, 'Baguio City', NULL, NULL, NULL, '2019-06-18 06:44:06', '2019-06-18 06:44:06'),
(1004, 'Kenneth', NULL, 'Lu', NULL, 'M', NULL, NULL, NULL, NULL, 'ngal101958@gmail.com', '09176261636', NULL, 'Blk.18,lot 11', 'Joselito St.Greenfields 3', 'Novaliches', 'Quezon City', NULL, NULL, '2019-06-19 00:18:06', '2019-06-19 00:18:06'),
(1005, 'Carina', NULL, 'Castillo', NULL, 'M', NULL, NULL, NULL, NULL, 'katzcaslle71@gmail.com', '09954511925', NULL, '#36 Evangelista', 'St , Leonilla Hill', NULL, NULL, NULL, NULL, '2019-06-19 01:06:06', '2019-06-19 01:06:06'),
(1006, 'Perlita', NULL, 'Martinez', NULL, NULL, NULL, NULL, NULL, NULL, 'DIANA717@YAHOO.COM', NULL, '16474489720', NULL, 'VILA', 'ROSARIO', 'LA UNION', NULL, NULL, '2019-06-21 00:00:53', '2019-06-21 00:00:53'),
(1007, 'MARY GRACE', NULL, 'AQUINO', NULL, 'F', NULL, NULL, NULL, NULL, 'MARYGRACEAQUNIO@ICLOUD.COM', '09393910617', NULL, NULL, 'NILOMBOT', 'MAPANDAN', 'PANGASINAN', NULL, NULL, '2019-06-21 00:20:19', '2019-06-21 00:20:19'),
(1008, 'MILAGROS', NULL, 'ANCHETA', NULL, 'F', NULL, NULL, NULL, NULL, NULL, 'MCANCHETA@SBCGLOBAL.NET', '(408) 933-9374', 'SUMMER BLOSSOM AVE, SAN JOSE CA', NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:22:44', '2019-06-21 00:22:44'),
(1009, 'MANUEL', NULL, 'ANCHETA', NULL, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:24:18', '2019-06-21 00:24:18'),
(1010, 'GRACE', NULL, 'ARCHOG', NULL, 'F', NULL, NULL, NULL, NULL, 'ARNELGRACE24@GMAIL.COM', '09088953924', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:26:55', '2019-06-21 00:26:55'),
(1012, 'ISAEL', NULL, 'BASILIO', NULL, NULL, NULL, NULL, NULL, NULL, 'ISAEL.BASILIO20@GMAIL.COM', '09491538910', NULL, 'B-8 L-1 C. ARELLANO', 'ST., KATARUNGAN VILL.', NULL, 'MUNTINLUPA CITY', NULL, NULL, '2019-06-21 00:31:38', '2019-06-21 00:31:38'),
(1013, 'JANE', NULL, 'BASILIO', NULL, 'F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:37:45', '2019-06-21 00:37:45'),
(1014, 'JAMES', NULL, 'DYSON', NULL, NULL, NULL, NULL, NULL, NULL, 'dellydizon@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:38:56', '2019-06-21 00:38:56'),
(1015, 'FLORDELIZA', NULL, 'DYSON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:39:39', '2019-06-21 00:39:39'),
(1016, 'NENITA', NULL, 'PATTAO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:40:34', '2019-06-21 00:40:34'),
(1017, 'DORIS', NULL, 'AARAS', NULL, NULL, NULL, NULL, NULL, NULL, 'daaras@ous-hf.no', NULL, '4790604904', 'Fjordsvingen 11 3427 Gullaug, Norway', NULL, NULL, NULL, NULL, NULL, '2019-06-21 00:41:40', '2019-06-21 00:41:40'),
(1018, 'EDNA', NULL, 'LIBAGO', NULL, NULL, NULL, NULL, NULL, NULL, 'grace.ed2238@yahoo.com', '09457947450/09657209112', NULL, 'B-15 L28 Villamar Subd.', NULL, 'Iponan', 'CDO', NULL, NULL, '2019-06-21 00:43:05', '2019-06-21 00:43:05'),
(1019, 'JOHN', NULL, 'MACLI-ING', NULL, NULL, NULL, NULL, NULL, NULL, 'joverlyn.espejo@gmail.com', '9105170845', NULL, '0429 Adiwang Road', 'Green Valley', 'Baguio City', NULL, NULL, NULL, '2019-06-21 00:44:27', '2019-06-21 00:44:27'),
(1020, 'JOSEFINA', 'M.', 'KIMURA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '09261295197/09464295459', NULL, '220 Amsing, Siapno Rd', 'Pacdal', 'Baguio City', NULL, NULL, NULL, '2019-06-21 00:47:30', '2019-06-21 00:47:30'),
(1021, 'ROSEL', NULL, 'SARMIENTO', NULL, NULL, NULL, NULL, NULL, NULL, 'rosel.g.sarmiento@gmail.com', '9174272592', NULL, 'PA 004C', 'Wangal', 'La Trinidad', 'Benguet', NULL, NULL, '2019-06-21 00:54:35', '2019-06-21 00:54:35'),
(1022, 'KAREEN MELENDRE', 'E.', 'TILA', NULL, NULL, NULL, NULL, NULL, NULL, 'ayessa_2@yahoo.com', NULL, '(074) 422 3348', '26 Lower West Amistad Rd., ,', 'Camp 7', 'Baguio City', NULL, NULL, NULL, '2019-06-21 00:56:07', '2019-06-21 00:56:07'),
(1023, 'MARIA FLORENCIA', 'S.', 'CAPULONG', NULL, NULL, NULL, NULL, NULL, NULL, 'capulongflor@yahoo.com', '0459820152/09275782937', NULL, '04 Edna Street', NULL, 'San Sebastian Village', 'Tarlac City', NULL, NULL, '2019-06-21 00:58:35', '2019-06-21 00:58:35'),
(1024, 'Jennifer', NULL, 'Salangsang', NULL, NULL, NULL, NULL, NULL, NULL, 'jenbsalangsang@yahoo.com', '09053018368/09328885368', NULL, '72', 'Kalayaan B. St', 'Quezon City', NULL, NULL, NULL, '2019-06-24 21:35:15', '2019-06-24 21:35:15'),
(1025, 'Ma Emma', NULL, 'Aguimbag', NULL, NULL, NULL, NULL, NULL, NULL, 'emma.aguimbag@metrobank.com.ph', '09984753888', NULL, 'Blk 7 Lot 46 Simon', 'St.San Pedro 7 Subd., San Bartolome, Nova.,', 'Quezon City', NULL, NULL, NULL, '2019-06-24 21:43:15', '2019-06-24 21:43:15'),
(1026, 'Mariel', NULL, 'Chavez', NULL, NULL, NULL, NULL, NULL, NULL, 'marielchavez777@yahoo.com', '09985102173', '424-4785', '77', 'Ma.Puguis', 'La Trinidad', 'Benguet', NULL, NULL, '2019-06-24 21:45:42', '2019-06-24 21:45:42'),
(1027, 'Jennifer', NULL, 'Chua', NULL, NULL, NULL, NULL, NULL, NULL, 'jennchua.jc@gmail.com/cream_bulak@yahoo.com', '09178315518', NULL, '35', 'Zandueta St.', 'Baguio City', 'Benguet', NULL, NULL, '2019-06-24 21:47:47', '2019-06-24 21:47:47'),
(1028, 'Honoratoe', NULL, 'Adag', NULL, NULL, NULL, NULL, NULL, NULL, 'adagsky_honorato@yahoo.com/annabeladag@yahoo.com', '0907-450-5416', NULL, NULL, 'lanas loo, buguias', 'Bernguet', NULL, NULL, NULL, '2019-06-24 21:52:28', '2019-06-24 21:52:28'),
(1031, 'Nancy', 'Co', 'Ong', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '09209258279', NULL, NULL, 'Rizal St.', 'Pozorubbio', 'Pangasinan', NULL, NULL, '2019-06-24 22:12:32', '2019-06-24 22:12:32'),
(1032, 'Manolito', NULL, 'Chavez', NULL, NULL, NULL, NULL, NULL, NULL, 'manolito_chavez@yahoo.com', '0998-5102-173', '424-4785', '1', 'Modesta Street Mines View Park', 'Baguio City', 'Benguet', NULL, NULL, '2019-06-24 22:16:32', '2019-06-24 22:16:32'),
(1033, 'Allan', NULL, 'Inde', NULL, NULL, NULL, NULL, NULL, NULL, 'allan.indie@yahoo.com.sg', '09053505930', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-24 22:20:17', '2019-06-24 22:20:17'),
(1034, 'Leo', NULL, 'Oasay', NULL, NULL, NULL, NULL, NULL, NULL, 'leooasay@guam.net;leooasay@gmail.com', NULL, NULL, NULL, 'P.O BOX 315814', 'Tanuning Guam 936931', NULL, NULL, NULL, '2019-06-24 22:22:54', '2019-06-24 22:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_transaction_id` int(10) UNSIGNED NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amt` int(11) DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `or_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ar_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_of_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_deposited` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amt_paid` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `payments_payment_transaction_id_foreign` (`payment_transaction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1065 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representatives`
--

DROP TABLE IF EXISTS `representatives`;
CREATE TABLE IF NOT EXISTS `representatives` (
  `rep_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rep_owner_id` int(10) UNSIGNED DEFAULT NULL,
  `rep_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rep_relationship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rep_mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rep_id`),
  KEY `representatives_rep_owner_id_foreign` (`rep_owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1035 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `representatives`
--

INSERT INTO `representatives` (`rep_id`, `rep_owner_id`, `rep_name`, `rep_relationship`, `rep_mobile_number`, `created_at`, `updated_at`) VALUES
(1002, 1002, NULL, NULL, NULL, '2019-06-17 19:02:57', '2019-06-17 19:02:57'),
(1003, 1003, NULL, NULL, NULL, '2019-06-18 06:44:07', '2019-06-18 06:44:07'),
(1004, 1004, NULL, NULL, NULL, '2019-06-19 00:18:07', '2019-06-19 00:18:07'),
(1005, 1005, NULL, NULL, NULL, '2019-06-19 01:06:06', '2019-06-19 01:06:06'),
(1006, 1006, NULL, NULL, NULL, '2019-06-21 00:00:54', '2019-06-21 00:00:54'),
(1007, 1007, NULL, NULL, NULL, '2019-06-21 00:20:20', '2019-06-21 00:20:20'),
(1008, 1008, NULL, NULL, NULL, '2019-06-21 00:22:44', '2019-06-21 00:22:44'),
(1009, 1009, NULL, NULL, NULL, '2019-06-21 00:24:21', '2019-06-21 00:24:21'),
(1010, 1010, NULL, NULL, NULL, '2019-06-21 00:26:56', '2019-06-21 00:26:56'),
(1012, 1012, NULL, NULL, NULL, '2019-06-21 00:31:38', '2019-06-21 00:31:38'),
(1013, 1013, NULL, NULL, NULL, '2019-06-21 00:37:48', '2019-06-21 00:37:48'),
(1014, 1014, NULL, NULL, NULL, '2019-06-21 00:38:56', '2019-06-21 00:38:56'),
(1015, 1015, NULL, NULL, NULL, '2019-06-21 00:39:43', '2019-06-21 00:39:43'),
(1016, 1016, NULL, NULL, NULL, '2019-06-21 00:40:38', '2019-06-21 00:40:38'),
(1017, 1017, NULL, NULL, NULL, '2019-06-21 00:41:41', '2019-06-21 00:41:41'),
(1018, 1018, NULL, NULL, NULL, '2019-06-21 00:43:05', '2019-06-21 00:43:05'),
(1019, 1019, NULL, NULL, NULL, '2019-06-21 00:44:27', '2019-06-21 00:44:27'),
(1020, 1020, 'MARITES M. BULOSAN', NULL, NULL, '2019-06-21 00:47:30', '2019-06-21 00:47:30'),
(1021, 1021, NULL, NULL, NULL, '2019-06-21 00:54:35', '2019-06-21 00:54:35'),
(1022, 1022, NULL, NULL, NULL, '2019-06-21 00:56:08', '2019-06-21 00:56:08'),
(1023, 1023, NULL, NULL, NULL, '2019-06-21 00:58:35', '2019-06-21 00:58:35'),
(1024, 1024, NULL, NULL, NULL, '2019-06-24 21:35:15', '2019-06-24 21:35:15'),
(1025, 1025, NULL, NULL, NULL, '2019-06-24 21:43:16', '2019-06-24 21:43:16'),
(1026, 1026, NULL, NULL, NULL, '2019-06-24 21:45:42', '2019-06-24 21:45:42'),
(1027, 1027, NULL, NULL, NULL, '2019-06-24 21:47:48', '2019-06-24 21:47:48'),
(1028, 1028, 'Annabel Adag', NULL, NULL, '2019-06-24 21:52:28', '2019-06-24 21:52:28'),
(1032, 1032, 'Mariel Chock', NULL, NULL, '2019-06-24 22:16:33', '2019-06-24 22:16:33'),
(1031, 1031, NULL, NULL, NULL, '2019-06-24 22:12:32', '2019-06-24 22:12:32'),
(1033, 1033, NULL, NULL, NULL, '2019-06-24 22:20:18', '2019-06-24 22:20:18'),
(1034, 1034, 'Leizelle Jade Oasay', NULL, NULL, '2019-06-24 22:22:54', '2019-06-24 22:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

DROP TABLE IF EXISTS `residents`;
CREATE TABLE IF NOT EXISTS `residents` (
  `resident_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_resident` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ethnicity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `municipality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `primary_resident_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`resident_id`),
  UNIQUE KEY `residents_email_address_unique` (`email_address`),
  UNIQUE KEY `residents_mobile_number_unique` (`mobile_number`)
) ENGINE=MyISAM AUTO_INCREMENT=1034 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_term_rent` double(15,8) NOT NULL,
  `long_term_rent` double(15,8) NOT NULL,
  `size` double(15,8) NOT NULL,
  `no_of_beds` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `floor_number` int(11) NOT NULL,
  PRIMARY KEY (`room_id`),
  UNIQUE KEY `rooms_room_no_unique` (`room_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1259 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_no`, `project`, `building`, `room_status`, `short_term_rent`, `long_term_rent`, `size`, `no_of_beds`, `remarks`, `created_at`, `updated_at`, `floor_number`) VALUES
(1000, '6LA West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2DD', NULL, '2019-06-17 17:50:18', '2019-06-17 17:50:18', 8),
(1001, '614', 'the_courtyards', 'manors', 'vacant', 16000.00000000, 15000.00000000, 42.00000000, '2BR', NULL, '2019-06-17 18:19:31', '2019-06-17 18:19:31', 1),
(1062, 'LG 06 West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 16:55:00', '2019-06-24 16:55:00', 1),
(1002, 'GF 01', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-18 06:28:42', '2019-06-18 06:28:42', 1),
(1003, 'GF 10', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-19 00:13:03', '2019-06-19 00:13:03', 1),
(1061, 'LGK West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 16:51:33', '2019-06-24 16:51:33', 1),
(1004, 'GF 11', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-19 00:58:50', '2019-06-19 00:58:50', 1),
(1060, 'LGF East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 16:49:47', '2019-06-24 16:49:47', 1),
(1005, '214', 'the_courtyards', 'loft', 'vacant', 16000.00000000, 15000.00000000, 28.00000000, '1SB', NULL, '2019-06-20 23:22:19', '2019-06-20 23:22:19', 4),
(1006, '209', 'the_courtyards', 'loft', 'vacant', 14000.00000000, 13000.00000000, 28.00000000, '1SB', NULL, '2019-06-20 23:25:10', '2019-06-20 23:25:10', 2),
(1007, '2B 06', 'the_courtyards', 'manors', 'vacant', 16000.00000000, 15000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:31:27', '2019-06-20 23:31:27', 2),
(1008, '117', 'the_courtyards', 'manors', 'vacant', 16000.00000000, 15000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:32:22', '2019-06-20 23:32:22', 1),
(1009, '518', 'the_courtyards', 'manors', 'vacant', 16000.00000000, 15000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:37:42', '2019-06-20 23:37:42', 1),
(1010, 'CC 3D', 'the_courtyards', 'colorado', 'vacant', 16000.00000000, 15000.00000000, 25.00000000, '2BR', NULL, '2019-06-20 23:39:49', '2019-06-20 23:39:49', 1),
(1011, 'CA 3B', 'the_courtyards', 'colorado', 'vacant', 9000.00000000, 8000.00000000, 25.00000000, '2BR', NULL, '2019-06-20 23:46:15', '2019-06-20 23:46:15', 3),
(1012, '505', 'the_courtyards', 'manors', 'vacant', 17000.00000000, 16000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:47:24', '2019-06-20 23:47:24', 3),
(1013, '202', 'the_courtyards', 'loft', 'vacant', 14000.00000000, 13000.00000000, 25.00000000, '1SB', NULL, '2019-06-20 23:48:13', '2019-06-20 23:48:13', 2),
(1014, '616', 'the_courtyards', 'manors', 'vacant', 17000.00000000, 16000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:49:15', '2019-06-20 23:49:15', 1),
(1015, '512', 'the_courtyards', 'manors', 'vacant', 16000.00000000, 15000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:50:18', '2019-06-20 23:50:18', 2),
(1016, 'CB 4B', 'the_courtyards', 'arkansas', 'vacant', 17000.00000000, 16000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:51:19', '2019-06-20 23:51:19', 1),
(1017, '312', 'the_courtyards', 'manors', 'vacant', 17000.00000000, 16000.00000000, 42.00000000, '2BR', NULL, '2019-06-20 23:52:12', '2019-06-20 23:52:12', 2),
(1018, '313', 'the_courtyards', 'loft', 'vacant', 14000.00000000, 13000.00000000, 25.00000000, '1SB', NULL, '2019-06-20 23:57:49', '2019-06-20 23:57:49', 4),
(1019, 'GF 18', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-23 23:57:47', '2019-06-23 23:57:47', 1),
(1020, '2F 9', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-23 23:58:23', '2019-06-23 23:58:23', 2),
(1021, '2F 12', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-23 23:59:44', '2019-06-23 23:59:44', 2),
(1022, '3F 9', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:00:39', '2019-06-24 00:00:39', 3),
(1023, '3F 10', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:01:01', '2019-06-24 00:01:01', 3),
(1024, '3F 21', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:01:16', '2019-06-24 00:01:16', 3),
(1025, '4F 8', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:02:02', '2019-06-24 00:02:02', 4),
(1026, '4F 20', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:02:23', '2019-06-24 00:02:23', 4),
(1027, '5F 08', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:02:38', '2019-06-24 00:02:38', 5),
(1028, '5F 29', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:03:02', '2019-06-24 00:03:02', 5),
(1029, '6F 04', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:03:28', '2019-06-24 00:03:28', 6),
(1030, '6F 05', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:03:45', '2019-06-24 00:03:45', 6),
(1031, '4F 01', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:04:14', '2019-06-24 00:04:14', 4),
(1032, '6F 11', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:04:29', '2019-06-24 00:04:29', 6),
(1033, '6F 14', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:04:52', '2019-06-24 00:04:52', 6),
(1034, 'GF 22', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:05:08', '2019-06-24 00:05:08', 1),
(1035, 'GF 23', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:05:23', '2019-06-24 00:05:23', 1),
(1036, 'GF 1', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:05:46', '2019-06-24 00:05:46', 1),
(1037, 'GF 17', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:06:56', '2019-06-24 00:06:56', 1),
(1038, 'GF 19', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:07:15', '2019-06-24 00:07:15', 1),
(1039, 'GF 29', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:07:33', '2019-06-24 00:07:33', 1),
(1040, '2F 2', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:07:48', '2019-06-24 00:07:48', 2),
(1041, '2F 3', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:08:04', '2019-06-24 00:08:04', 2),
(1042, '2F 10', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:08:29', '2019-06-24 00:08:29', 2),
(1043, '2F 13', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:09:02', '2019-06-24 00:09:02', 2),
(1044, '2F 18', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:09:34', '2019-06-24 00:09:34', 2),
(1045, '2F 27', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:10:05', '2019-06-24 00:10:05', 2),
(1046, '3F 12', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:10:32', '2019-06-24 00:10:32', 3),
(1047, '3F 14', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:10:46', '2019-06-24 00:10:46', 3),
(1048, '3F 28', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:11:33', '2019-06-24 00:11:33', 3),
(1049, '4F 7', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:11:53', '2019-06-24 00:11:53', 4),
(1050, '4F 24', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:12:08', '2019-06-24 00:12:08', 4),
(1051, '4F 25', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:12:30', '2019-06-24 00:12:30', 4),
(1052, '5F 01', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:12:44', '2019-06-24 00:12:44', 5),
(1053, '5F 06', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:13:00', '2019-06-24 00:13:00', 5),
(1054, '5F 30', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:13:22', '2019-06-24 00:13:22', 5),
(1055, '5F 18', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:14:16', '2019-06-24 00:14:16', 5),
(1056, '6F 13', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:14:34', '2019-06-24 00:14:34', 6),
(1057, '6F 15', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:14:59', '2019-06-24 00:14:59', 6),
(1058, '6F 17', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:16:48', '2019-06-24 00:16:48', 6),
(1059, '6F 26', 'north_cambridge', 'wharton', 'vacant', 12000.00000000, 11000.00000000, 20.00000000, '1SB', NULL, '2019-06-24 00:17:23', '2019-06-24 00:17:23', 6),
(1063, 'LGP East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 16:55:57', '2019-06-24 16:55:57', 1),
(1064, 'LGG West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 16:58:13', '2019-06-24 16:58:13', 2),
(1065, 'UGE East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 16:58:53', '2019-06-24 16:58:53', 2),
(1066, 'UGG West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 16:59:51', '2019-06-24 16:59:51', 2),
(1067, 'UGN East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1DD', NULL, '2019-06-24 17:00:25', '2019-06-24 17:00:25', 2),
(1068, 'UGQ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:00:58', '2019-06-24 17:00:58', 2),
(1069, 'GLA East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:02:40', '2019-06-24 17:02:40', 3),
(1070, 'GLB East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB&1DD', NULL, '2019-06-24 17:03:20', '2019-06-24 17:03:20', 3),
(1071, 'GLD West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:03:41', '2019-06-24 17:03:41', 3),
(1072, 'GLI West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:04:02', '2019-06-24 17:04:02', 3),
(1073, 'GLP West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:04:22', '2019-06-24 17:04:22', 3),
(1074, '2LR East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:04:50', '2019-06-24 17:04:50', 4),
(1075, '2LD East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:05:15', '2019-06-24 17:05:15', 4),
(1076, '2LI East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2DD', NULL, '2019-06-24 17:50:31', '2019-06-24 17:50:31', 4),
(1077, '2LM East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:51:16', '2019-06-24 17:51:16', 4),
(1078, '3LK East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:52:21', '2019-06-24 17:52:21', 5),
(1079, '4LC West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:53:16', '2019-06-24 17:53:16', 6),
(1080, '4LD West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:53:46', '2019-06-24 17:53:46', 6),
(1081, '4LP East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:54:14', '2019-06-24 17:54:14', 6),
(1082, '5LA West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:54:34', '2019-06-24 17:54:34', 7),
(1083, '5LD West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:55:01', '2019-06-24 17:55:01', 7),
(1084, '5LI West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:55:27', '2019-06-24 17:55:27', 7),
(1085, '3LH West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:56:10', '2019-06-24 17:56:10', 5),
(1086, '4LF West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:57:33', '2019-06-24 17:57:33', 6),
(1087, '4LF East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 17:58:31', '2019-06-24 17:58:31', 6),
(1088, 'LGA East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 17:59:02', '2019-06-24 17:59:02', 1),
(1089, 'LGB East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 17:59:32', '2019-06-24 17:59:32', 1),
(1090, 'LGC East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:08:08', '2019-06-24 18:08:08', 1),
(1091, 'LGD East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:08:34', '2019-06-24 18:08:34', 1),
(1092, 'LGE East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB&1DD', NULL, '2019-06-24 18:09:05', '2019-06-24 18:09:05', 1),
(1093, 'LGG East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:09:26', '2019-06-24 18:09:26', 1),
(1094, 'LGK East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:09:55', '2019-06-24 18:09:55', 1),
(1095, 'LGO East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:10:15', '2019-06-24 18:10:15', 1),
(1096, 'LGQ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:10:39', '2019-06-24 18:10:39', 1),
(1097, 'LGR East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 18:10:54', '2019-06-24 18:10:54', 1),
(1098, 'LGB West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:11:25', '2019-06-24 18:11:25', 1),
(1099, 'LGC West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:11:49', '2019-06-24 18:11:49', 1),
(1100, 'LGH West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:12:08', '2019-06-24 18:12:08', 1),
(1101, 'UGA East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:12:41', '2019-06-24 18:12:41', 2),
(1102, 'UGF East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:13:32', '2019-06-24 18:13:32', 2),
(1103, 'UGG East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:13:58', '2019-06-24 18:13:58', 2),
(1104, 'UGH East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:14:32', '2019-06-24 18:14:32', 2),
(1105, 'UGK East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:15:07', '2019-06-24 18:15:07', 2),
(1106, 'UGL West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:15:28', '2019-06-24 18:15:28', 2),
(1107, 'GLC East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:15:53', '2019-06-24 18:15:53', 3),
(1108, 'GLE East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:16:15', '2019-06-24 18:16:15', 3),
(1109, 'GLG East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:17:08', '2019-06-24 18:17:08', 3),
(1110, 'GLI East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:17:24', '2019-06-24 18:17:24', 3),
(1111, 'GLJ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:17:41', '2019-06-24 18:17:41', 3),
(1112, 'GLK East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:18:04', '2019-06-24 18:18:04', 3),
(1113, 'GLL East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:18:40', '2019-06-24 18:18:40', 3),
(1114, 'GLO East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:19:09', '2019-06-24 18:19:09', 3),
(1115, 'GLP East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:19:35', '2019-06-24 18:19:35', 3),
(1116, 'GLR East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:20:08', '2019-06-24 18:20:08', 3),
(1117, 'GLH West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:20:29', '2019-06-24 18:20:29', 3),
(1118, 'GLM West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:20:47', '2019-06-24 18:20:47', 3),
(1119, 'GLO West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:21:08', '2019-06-24 18:21:08', 3),
(1120, 'GLR West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:21:29', '2019-06-24 18:21:29', 3),
(1121, '2LB East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:22:08', '2019-06-24 18:22:08', 4),
(1122, '2LE East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:22:34', '2019-06-24 18:22:34', 4),
(1123, '2LH East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2DD', NULL, '2019-06-24 18:24:17', '2019-06-24 18:24:17', 4),
(1124, '2LP East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:24:42', '2019-06-24 18:24:42', 4),
(1125, '2LA West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:26:22', '2019-06-24 18:26:22', 4),
(1126, '2LE West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:26:37', '2019-06-24 18:26:37', 4),
(1127, '2LL West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:30:46', '2019-06-24 18:30:46', 4),
(1128, '2LN West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:31:49', '2019-06-24 18:31:49', 4),
(1129, '2LI West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:32:04', '2019-06-24 18:32:04', 4),
(1130, '2LO West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:32:51', '2019-06-24 18:32:51', 4),
(1131, '3LA East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:33:25', '2019-06-24 18:33:25', 5),
(1138, '3LC West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:44:50', '2019-06-24 18:44:50', 5),
(1140, '3LE West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 18:50:10', '2019-06-24 18:50:10', 5),
(1134, '3LJ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:36:07', '2019-06-24 18:36:07', 5),
(1135, '3LN East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:36:29', '2019-06-24 18:36:29', 5),
(1136, '3LP East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:37:03', '2019-06-24 18:37:03', 5),
(1137, '3LQ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:40:02', '2019-06-24 18:40:02', 5),
(1139, '3LD West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2DD', NULL, '2019-06-24 18:48:40', '2019-06-24 18:48:40', 5),
(1141, '3LI West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:55:13', '2019-06-24 18:55:13', 5),
(1142, '3LO West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2DD', NULL, '2019-06-24 18:55:54', '2019-06-24 18:55:54', 5),
(1143, '3LP West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:57:18', '2019-06-24 18:57:18', 5),
(1144, '4LG East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 18:59:45', '2019-06-24 18:59:45', 6),
(1146, '4LJ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 19:02:29', '2019-06-24 19:02:29', 6),
(1147, '4Lk East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:04:06', '2019-06-24 19:04:06', 6),
(1148, '4LL East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:04:34', '2019-06-24 19:04:34', 6),
(1149, '4LM East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:06:07', '2019-06-24 19:06:07', 6),
(1150, '4LO East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:06:51', '2019-06-24 19:06:51', 6),
(1151, '4LR East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:07:22', '2019-06-24 19:07:22', 6),
(1152, '4LE West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:07:41', '2019-06-24 19:07:41', 6),
(1153, '4LO West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:07:58', '2019-06-24 19:07:58', 6),
(1154, '4LR West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:13:34', '2019-06-24 19:13:34', 6),
(1155, '5LB East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:14:25', '2019-06-24 19:14:25', 7),
(1156, '5LC East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:14:47', '2019-06-24 19:14:47', 7),
(1157, '5LD East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:21:38', '2019-06-24 19:21:38', 7),
(1158, '5LF East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:21:59', '2019-06-24 19:21:59', 7),
(1159, '5LJ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:22:39', '2019-06-24 19:22:39', 7),
(1160, '5LK East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:26:58', '2019-06-24 19:26:58', 7),
(1161, '5LM East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:29:39', '2019-06-24 19:29:39', 7),
(1162, '5LN East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:30:00', '2019-06-24 19:30:00', 7),
(1163, '5LO East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:30:26', '2019-06-24 19:30:26', 7),
(1164, '5LP East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:30:44', '2019-06-24 19:30:44', 7),
(1165, '5LQ East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:31:13', '2019-06-24 19:31:13', 7),
(1166, '5LC West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:31:34', '2019-06-24 19:31:34', 7),
(1167, '5LF West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:32:07', '2019-06-24 19:32:07', 7),
(1168, '5LH West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:32:35', '2019-06-24 19:32:35', 7),
(1169, '5LJ West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:33:17', '2019-06-24 19:33:17', 7),
(1170, '5LK West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:33:37', '2019-06-24 19:33:37', 7),
(1171, '5LL West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:33:53', '2019-06-24 19:33:53', 7),
(1172, '5LM West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:34:30', '2019-06-24 19:34:30', 7),
(1173, '5LN West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 19:34:50', '2019-06-24 19:34:50', 7),
(1174, '5LP West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:38:34', '2019-06-24 19:38:34', 7),
(1175, '5LQ West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:39:23', '2019-06-24 19:39:23', 7),
(1176, '5LR West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:40:43', '2019-06-24 19:40:43', 7),
(1177, '6LH East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 19:41:08', '2019-06-24 19:41:08', 8),
(1178, '6LN East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:42:03', '2019-06-24 19:42:03', 8),
(1179, '6LK East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:42:17', '2019-06-24 19:42:17', 8),
(1180, '6LR East', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:42:31', '2019-06-24 19:42:31', 8),
(1181, '6LL West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:42:49', '2019-06-24 19:42:49', 8),
(1182, '6LM West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB&1DD', NULL, '2019-06-24 19:43:15', '2019-06-24 19:43:15', 8),
(1183, '6LO West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '2SB', NULL, '2019-06-24 19:44:47', '2019-06-24 19:44:47', 8),
(1184, '6LP West', 'north_cambridge', 'harvard', 'vacant', 7800.00000000, 6800.00000000, 15.00000000, '1SB', NULL, '2019-06-24 19:45:08', '2019-06-24 19:45:08', 8),
(1186, '2LGF B', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 12:31:45', '2019-06-25 12:31:45', 2),
(1187, 'LGF 1', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 12:33:12', '2019-06-25 12:33:12', 3),
(1188, 'GF C', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 12:33:48', '2019-06-25 12:33:48', 5),
(1189, 'UGF 02', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB', NULL, '2019-06-25 12:34:31', '2019-06-25 12:34:31', 4),
(1190, 'UGF 12', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2DD', NULL, '2019-06-25 12:35:27', '2019-06-25 12:35:27', 4),
(1191, '6F K', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-24 23:56:08', '2019-06-24 23:56:08', 10),
(1192, 'GF E', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-24 23:56:52', '2019-06-24 23:56:52', 4),
(1193, '6F 03', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-24 23:57:29', '2019-06-24 23:57:29', 10),
(1194, 'GF 09', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:08:23', '2019-06-25 00:08:23', 5),
(1195, '3LGFB', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:09:14', '2019-06-25 00:09:14', 1),
(1196, '2LGF C', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB&1DD', NULL, '2019-06-25 00:09:48', '2019-06-25 00:09:48', 2),
(1197, '2LGF D', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:10:15', '2019-06-25 00:10:15', 2),
(1198, 'LGF A', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:10:58', '2019-06-25 00:10:58', 3),
(1199, 'LGF D', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:11:25', '2019-06-25 00:11:25', 3),
(1200, 'LGF K', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:11:51', '2019-06-25 00:11:51', 3),
(1201, 'UGF I', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:12:29', '2019-06-25 00:12:29', 4),
(1202, 'UGF J', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB', NULL, '2019-06-25 00:13:04', '2019-06-25 00:13:04', 4),
(1203, 'UGF M', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB', NULL, '2019-06-25 00:13:45', '2019-06-25 00:13:45', 4),
(1204, 'UGF 04', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:14:15', '2019-06-25 00:14:15', 4),
(1205, 'GF A', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB', NULL, '2019-06-25 00:14:46', '2019-06-25 00:14:46', 5),
(1206, 'GF I', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:15:12', '2019-06-25 00:15:12', 5),
(1207, 'GF J', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:15:38', '2019-06-25 00:15:38', 5),
(1208, 'GF K', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:16:00', '2019-06-25 00:16:00', 5),
(1209, 'GF 02', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2DD', NULL, '2019-06-25 00:16:33', '2019-06-25 00:16:33', 5),
(1210, 'GF 03', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB', NULL, '2019-06-25 00:16:54', '2019-06-25 00:16:54', 5),
(1211, 'GF 07', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB', NULL, '2019-06-25 00:31:51', '2019-06-25 00:31:51', 5),
(1212, '2F 02', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:32:12', '2019-06-25 00:32:12', 6),
(1213, '2F 06', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:32:40', '2019-06-25 00:32:40', 6),
(1214, '2F 11', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2DD', NULL, '2019-06-25 00:33:05', '2019-06-25 00:33:05', 6),
(1215, '2F B', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:33:26', '2019-06-25 00:33:26', 6),
(1216, '2F E', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:33:45', '2019-06-25 00:33:45', 6),
(1217, '2F F', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:34:09', '2019-06-25 00:34:09', 6),
(1218, '2F G', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:34:32', '2019-06-25 00:34:32', 6),
(1219, '2F H', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:34:50', '2019-06-25 00:34:50', 6),
(1220, '2F I', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:35:08', '2019-06-25 00:35:08', 6),
(1221, '2F J', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:35:27', '2019-06-25 00:35:27', 6),
(1222, '2F L', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:35:46', '2019-06-25 00:35:46', 6),
(1223, '3F C', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2DD', NULL, '2019-06-25 00:36:16', '2019-06-25 00:36:16', 7),
(1224, '3F E', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:36:40', '2019-06-25 00:36:40', 7),
(1225, '3F H', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:37:00', '2019-06-25 00:37:00', 7),
(1226, '3F M', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:37:24', '2019-06-25 00:37:24', 7),
(1227, '3F 04', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:38:03', '2019-06-25 00:38:03', 7),
(1228, '3F 05', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:39:44', '2019-06-25 00:39:44', 7),
(1229, '3F 06', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:40:14', '2019-06-25 00:40:14', 7),
(1230, '3F 07', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:40:46', '2019-06-25 00:40:46', 7),
(1231, '3F 08', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:41:03', '2019-06-25 00:41:03', 7),
(1232, 'P 3F 12', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:43:02', '2019-06-25 00:43:02', 7),
(1233, '4F E', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:43:22', '2019-06-25 00:43:22', 8),
(1234, '4F K', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:43:47', '2019-06-25 00:43:47', 8),
(1235, 'P 4F 01', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:45:03', '2019-06-25 00:45:03', 8),
(1236, '4F 02', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:45:35', '2019-06-25 00:45:35', 8),
(1237, '4F 03', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:54:54', '2019-06-25 00:54:54', 8),
(1238, '4F 05', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:55:12', '2019-06-25 00:55:12', 8),
(1239, '4F 06', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:55:32', '2019-06-25 00:55:32', 8),
(1240, '4F 10', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:55:48', '2019-06-25 00:55:48', 8),
(1241, '4F 11', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:56:07', '2019-06-25 00:56:07', 8),
(1242, '4F 12', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:56:28', '2019-06-25 00:56:28', 8),
(1243, '5F 02', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:56:51', '2019-06-25 00:56:51', 9),
(1244, '5F 07', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:57:16', '2019-06-25 00:57:16', 9),
(1245, '5F 09', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:57:35', '2019-06-25 00:57:35', 9),
(1246, '5F 13', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:57:55', '2019-06-25 00:57:55', 9),
(1247, '5F A', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:58:24', '2019-06-25 00:58:24', 9),
(1248, '5F J', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:58:44', '2019-06-25 00:58:44', 9),
(1249, '5F K', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 00:59:03', '2019-06-25 00:59:03', 9),
(1250, '5FL-5FM', 'north_cambridge', 'princeton', 'vacant', 1700.00000000, 1500.00000000, 30.00000000, '2SB', NULL, '2019-06-25 01:00:05', '2019-06-25 01:00:05', 9),
(1251, '6F 02', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:00:27', '2019-06-25 01:00:27', 10),
(1252, '6F 09', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:00:45', '2019-06-25 01:00:45', 10),
(1253, '6F 12', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '1SB&1DD', NULL, '2019-06-25 01:01:06', '2019-06-25 01:01:06', 10),
(1254, '6F D', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:01:22', '2019-06-25 01:01:22', 10),
(1255, '6F E', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:01:53', '2019-06-25 01:01:53', 10),
(1256, '6F F', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:02:17', '2019-06-25 01:02:17', 10),
(1257, '6F I', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:02:41', '2019-06-25 01:02:41', 10),
(1258, '6F J', 'north_cambridge', 'princeton', 'vacant', 8500.00000000, 7500.00000000, 15.00000000, '2SB', NULL, '2019-06-25 01:02:59', '2019-06-25 01:02:59', 10);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_date` date NOT NULL,
  `trans_room_id` int(10) UNSIGNED NOT NULL,
  `trans_resident_id` int(10) UNSIGNED NOT NULL,
  `trans_owner_id` int(10) UNSIGNED NOT NULL,
  `trans_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_move_out_date` date DEFAULT NULL,
  `move_out_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `move_in_date` date NOT NULL,
  `move_out_date` date NOT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_water_reading` int(11) DEFAULT NULL,
  `initial_electric_reading` int(11) DEFAULT NULL,
  `final_water_reading` int(11) DEFAULT NULL,
  `final_electric_reading` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `transactions_trans_room_id_foreign` (`trans_room_id`),
  KEY `transactions_trans_resident_id_foreign` (`trans_resident_id`),
  KEY `transactions_trans_owner_id_foreign` (`trans_owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1028 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privilege` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_resident_id` int(10) UNSIGNED DEFAULT NULL,
  `user_owner_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_resident_id_foreign` (`user_resident_id`),
  KEY `users_user_owner_id_foreign` (`user_owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1058 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `privilege`, `user_resident_id`, `user_owner_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1005, 'Landley Bernardo', 'lmbernardo@slu.edu.ph', '$2y$10$ezsepllYr9aVYhaK.OcLUeekJqrNnMzY02oM38ATheWBnqZEhf6vC', 'leasingOfficer', NULL, NULL, NULL, '2019-06-17 22:30:33', '2019-06-17 22:30:33'),
(1006, 'Violeta King', 'evrolpindo@yahoo.com.ph', '$2y$10$oNRrFhPKsGbrtX.NGoSM8e3KqFrR7ZuV4espjWhPtOAH9DYPGF.Hi', 'owner', NULL, 1003, NULL, '2019-06-18 06:44:06', '2019-06-18 06:44:06'),
(1003, 'Jessie Amangyen', 'verone_1817@yahoo.com', '$2y$10$h/QNaJmHuz1eM.NsT1lRCuM17zw6Z7SOprcwRXCi.rpcRh.8RU7C.', 'owner', NULL, 1002, NULL, '2019-06-17 19:02:57', '2019-06-17 19:02:57'),
(1045, 'Jennifer Salangsang', 'jenbsalangsang@yahoo.com', '$2y$10$VS6pTs7km2EwVgToQcHe5OkBxPJPL0SumK8t1YrxNICR4CYeqnqK.', 'owner', NULL, 1024, NULL, '2019-06-24 21:35:15', '2019-06-24 21:35:15'),
(1046, 'Ma Emma Aguimbag', 'emma.aguimbag@metrobank.com.ph', '$2y$10$UnrLB5kCyaSUiU74LfEWveubHbUStwv0px0lY.nwNzOwe40ZPUDuy', 'owner', NULL, 1025, NULL, '2019-06-24 21:43:16', '2019-06-24 21:43:16'),
(1020, 'Carina Castillo', 'katzcaslle71@gmail.com', '$2y$10$nB7Lyq96WXv1u45QxPS63uRdduYGZ.Y2rEnajTUUQ.yPx7yo7FZhi', 'owner', NULL, 1005, NULL, '2019-06-19 01:06:06', '2019-06-19 01:06:06'),
(1047, 'Mariel Chavez', 'marielchavez777@yahoo.com', '$2y$10$VU7RL9HUsCbUfk.I1tGsiuMSoasvrCwcwsmOt9Y9JUsvjjmf3I3Oy', 'owner', NULL, 1026, NULL, '2019-06-24 21:45:42', '2019-06-24 21:45:42'),
(1018, 'Kenneth Lu', 'ngal101958@gmail.com', '$2y$10$ZbxhuI24H63Fih4PhYimi.Pkq67j0RJfVkqt/.A86UtlvJitEDL6y', 'owner', NULL, 1004, NULL, '2019-06-19 00:18:07', '2019-06-19 00:18:07'),
(1022, 'Perlita Martinez', 'DIANA717@YAHOO.COM', '$2y$10$JS7aIVpt4cV0Bh4.w4r.oezfOmK3N.X5OAXN.83iQl1EsdLvhrb82', 'owner', NULL, 1006, NULL, '2019-06-21 00:00:54', '2019-06-21 00:00:54'),
(1023, 'MARY GRACE AQUINO', 'MARYGRACEAQUNIO@ICLOUD.COM', '$2y$10$eGzl3cxST1lJisEYW.j3tOnf/N.9zdIXwcazNxea6.yQMFqXKm0z2', 'owner', NULL, 1007, NULL, '2019-06-21 00:20:20', '2019-06-21 00:20:20'),
(1024, 'MILAGROS ANCHETA', 'noemailadress1008@marthaservices.com', '$2y$10$UyApUDK5pgi9owQKST5zL.tvg3G7N.tTGuNvuByyrrzEBYL.44MzG', 'owner', NULL, 1008, NULL, '2019-06-21 00:22:44', '2019-06-21 00:22:44'),
(1025, 'MANUEL ANCHETA', 'noemailadress1009@marthaservices.com', '$2y$10$dB/vStxmBNx/1eEJN5Cm5O7a5HEAMvaOOU9yu6RALEeg6/rWt//c2', 'owner', NULL, 1009, NULL, '2019-06-21 00:24:21', '2019-06-21 00:24:21'),
(1026, 'GRACE ARCHOG', 'ARNELGRACE24@GMAIL.COM', '$2y$10$c9sgJOmxbfO0Np.Ny1EKhOB35wfpiUp2k1pU31mtrH3DB0a92ragi', 'owner', NULL, 1010, NULL, '2019-06-21 00:26:56', '2019-06-21 00:26:56'),
(1028, 'ISAEL BASILIO', 'ISAEL.BASILIO20@GMAIL.COM', '$2y$10$VybvhDviU7c9rtZTxwI4.eyizrAo88FujNoXD/INuO8hQYLLA7Aqe', 'owner', NULL, 1012, NULL, '2019-06-21 00:31:38', '2019-06-21 00:31:38'),
(1029, 'JANE BASILIO', 'noemailadress1013@marthaservices.com', '$2y$10$SY9FqLoMoCYLK4anMa6Uq.EDGaH.tsEVdOn3VvNLoQKw8pGbYy7bS', 'owner', NULL, 1013, NULL, '2019-06-21 00:37:48', '2019-06-21 00:37:48'),
(1030, 'JAMES DYSON', 'dellydizon@yahoo.com', '$2y$10$yYiwRCuaBYtfHX9ZDB6FT.OQJWbhWsBzN27TYfXvenhkH4P9EEP4a', 'owner', NULL, 1014, NULL, '2019-06-21 00:38:56', '2019-06-21 00:38:56'),
(1031, 'FLORDELIZA DYSON', 'noemailadress1015@marthaservices.com', '$2y$10$tPxBzW7nqlgZJ4Wuk1t1YeoE2CbIBDpw7iDloPcPonKacdm/D79E.', 'owner', NULL, 1015, NULL, '2019-06-21 00:39:42', '2019-06-21 00:39:42'),
(1032, 'NENITA PATTAO', 'noemailadress1016@marthaservices.com', '$2y$10$JlElCGN3S6jYA3x8H15utO8uEf7OWBiitDU6060BYAou3Jr1rVt6K', 'owner', NULL, 1016, NULL, '2019-06-21 00:40:38', '2019-06-21 00:40:38'),
(1033, 'DORIS AARAS', 'daaras@ous-hf.no', '$2y$10$DsSaVmHA1Fi2QGiLFPNcLuaw.By0PYuIKQKh7HzcogEdcnx7TnvWu', 'owner', NULL, 1017, NULL, '2019-06-21 00:41:41', '2019-06-21 00:41:41'),
(1034, 'EDNA LIBAGO', 'grace.ed2238@yahoo.com', '$2y$10$V7mwRdTtJOVBg.EOZBnzueLfOspCXESPL.rdFJ6XUiADq3BNNlBEG', 'owner', NULL, 1018, NULL, '2019-06-21 00:43:05', '2019-06-21 00:43:05'),
(1035, 'JOHN MACLI-ING', 'joverlyn.espejo@gmail.com', '$2y$10$3zL.SpZDzF0sYkZNMjBVmO5LXOdQ6hyz1dTSdpcAsm0AmGm1F.HS.', 'owner', NULL, 1019, NULL, '2019-06-21 00:44:27', '2019-06-21 00:44:27'),
(1036, 'JOSEFINA KIMURA', 'noemailadress1020@marthaservices.com', '$2y$10$VVGnixwn6CSYEM45CgIetOQPn/jiuhU7FMIScmZugtqr79E0SPLfG', 'owner', NULL, 1020, NULL, '2019-06-21 00:47:30', '2019-06-21 00:47:30'),
(1037, 'ROSEL SARMIENTO', 'rosel.g.sarmiento@gmail.com', '$2y$10$tuHghbJ177d93ME4hhhV/ek.eBiUzqzJSadWgB3IngiVnNZ/hTmcq', 'owner', NULL, 1021, NULL, '2019-06-21 00:54:35', '2019-06-21 00:54:35'),
(1038, 'KAREEN MELENDRE TILA', 'ayessa_2@yahoo.com', '$2y$10$a5Y63ZtoYVMfWvqF5hIgdO4gMkaR64aEOvv3qW4U9YqBRt1bjsxDW', 'owner', NULL, 1022, NULL, '2019-06-21 00:56:08', '2019-06-21 00:56:08'),
(1039, 'MARIA FLORENCIA CAPULONG', 'capulongflor@yahoo.com', '$2y$10$MAUIbkkXzHfKbEBhMsasAu0vAlJCixkw0q.4JAn/VoqSjgU4Cvea6', 'owner', NULL, 1023, NULL, '2019-06-21 00:58:35', '2019-06-21 00:58:35'),
(1048, 'Jennifer Chua', 'jennchua.jc@gmail.com/cream_bulak@yahoo.com', '$2y$10$luBTyW31mnAg4LEYlETZ5ewSjIvvi91/4l.TMskvCWQr4jHjUUN4C', 'owner', NULL, 1027, NULL, '2019-06-24 21:47:48', '2019-06-24 21:47:48'),
(1049, 'Honoratoe Adag', 'adagsky_honorato@yahoo.com/annabeladag@yahoo.com', '$2y$10$9TAtwC8THhKyPWQaUMIW/eNAHRopGj.zKGyfdELqZdBBr0Sd00BWe', 'owner', NULL, 1028, NULL, '2019-06-24 21:52:28', '2019-06-24 21:52:28'),
(1053, 'Manolito Chavez', 'manolito_chavez@yahoo.com', '$2y$10$mQxgabE/xBfLrPTEb4dqLOUl/d2vxDqUHDJ6/T43FAa7zmlqYTiRy', 'owner', NULL, 1032, NULL, '2019-06-24 22:16:33', '2019-06-24 22:16:33'),
(1052, 'Nancy Ong', 'noemailadress1031@marthaservices.com', '$2y$10$OhBRO/d0pfk.mV2.g//QfeWNAZ8CKvJvdyrj5CY9alNH7AXrFIXJK', 'owner', NULL, 1031, NULL, '2019-06-24 22:12:32', '2019-06-24 22:12:32'),
(1054, 'Allan Inde', 'allan.indie@yahoo.com.sg', '$2y$10$aW2T0VwRUhITbD8SACn8M.CezW4TzA6Hq6aUmuEWaKlITWKn4d1Kq', 'owner', NULL, 1033, NULL, '2019-06-24 22:20:18', '2019-06-24 22:20:18'),
(1055, 'Leo Oasay', 'leooasay@guam.net;leooasay@gmail.com', '$2y$10$IsnS8tUC3soVMIot35BtguOznRB3fHOIRPMtPUGHG3N/SSwT7K6bq', 'owner', NULL, 1034, NULL, '2019-06-24 22:22:54', '2019-06-24 22:22:54'),
(1056, 'Joemel Kylle M. Pascua', 'pascuajoemel22@gmail.com', '$2y$10$mkrdB9edF.duBdEn7z9MOexU5zPCJ1TXAUCeCPbNzuBgJSbeiZKYO', 'leasingOfficer', NULL, NULL, NULL, '2019-06-25 12:04:05', '2019-06-25 12:04:05'),
(1057, 'Gomi', 'Gomidashmoba@marthaservices.com', '$2y$10$wUizTZufKQ08EAD8fm.fbuG82m3eRx.ZgnxBReLjhgpy6YuWNhM3y', 'leasingOfficer', NULL, NULL, NULL, '2019-06-25 12:20:24', '2019-06-25 12:20:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
