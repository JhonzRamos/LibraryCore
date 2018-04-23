-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 02:46 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admincms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `sTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `sTitle`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Book 1', '2018-04-22 03:44:29', '2018-04-22 03:44:29', NULL),
(2, 'Book 2', '2018-04-22 03:44:40', '2018-04-22 03:44:40', NULL),
(3, 'Book 3', '2018-04-22 03:44:46', '2018-04-22 03:44:46', NULL),
(4, 'Book 4', '2018-04-22 03:44:49', '2018-04-22 03:44:49', NULL),
(5, 'Book 5', '2018-04-22 06:33:57', '2018-04-22 06:33:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `menu_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`, `type`, `created_at`, `updated_at`, `menu_id`) VALUES
(9, 'C:\\xampp\\htdocs\\adminCMS3\\database\\migrations\\2018_04_22_114419_create_books_table.php', 'Migration', '2018-04-22 03:44:19', '2018-04-22 03:44:19', 125),
(10, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Books.php', 'Model', '2018-04-22 03:44:19', '2018-04-22 03:44:19', 125),
(11, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\CreateBooksRequest.php', 'Request', '2018-04-22 03:44:20', '2018-04-22 03:44:20', 125),
(12, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\UpdateBooksRequest.php', 'Request', '2018-04-22 03:44:20', '2018-04-22 03:44:20', 125),
(13, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Controllers\\Admin\\BooksController.php', 'Controller', '2018-04-22 03:44:20', '2018-04-22 03:44:20', 125),
(14, 'C:\\xampp\\htdocs\\adminCMS3\\resources\\views\\admin\\books\\index.blade.php', 'View', '2018-04-22 03:44:20', '2018-04-22 03:44:20', 125),
(15, 'C:\\xampp\\htdocs\\adminCMS3\\resources\\views\\admin\\books\\edit.blade.php', 'View', '2018-04-22 03:44:20', '2018-04-22 03:44:20', 125),
(16, 'C:\\xampp\\htdocs\\adminCMS3\\resources\\views\\admin\\books\\create.blade.php', 'View', '2018-04-22 03:44:20', '2018-04-22 03:44:20', 125),
(17, 'C:\\xampp\\htdocs\\adminCMS3\\database\\migrations\\2018_04_22_114537_create_todelete2_table.php', 'Migration', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(18, 'C:\\xampp\\htdocs\\adminCMS3\\database\\migrations\\2018_04_22_114537_update_todelete2_table.php', 'Migration', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(19, 'C:\\xampp\\htdocs\\adminCMS3\\app\\ToDelete2Books.php', 'Model', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(20, 'C:\\xampp\\htdocs\\adminCMS3\\app\\ToDelete2.php', 'Model', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(21, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\CreateToDelete2Request.php', 'Request', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(22, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\UpdateToDelete2Request.php', 'Request', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(23, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Controllers\\Admin\\ToDelete2Controller.php', 'Controller', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(24, 'C:\\xampp\\htdocs\\adminCMS3\\resources\\views\\admin\\todelete2\\index.blade.php', 'View', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(25, 'C:\\xampp\\htdocs\\adminCMS3\\resources\\views\\admin\\todelete2\\edit.blade.php', 'View', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126),
(26, 'C:\\xampp\\htdocs\\adminCMS3\\resources\\views\\admin\\todelete2\\create.blade.php', 'View', '2018-04-22 03:45:37', '2018-04-22 03:45:37', 126);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL,
  `menu_type` int(11) NOT NULL DEFAULT '1',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `position`, `menu_type`, `icon`, `name`, `title`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, 'User', 'User', NULL, NULL, NULL),
(2, NULL, 0, NULL, 'Role', 'Role', NULL, NULL, NULL),
(3, NULL, 0, NULL, 'Files', 'Files', NULL, NULL, NULL),
(6, NULL, 0, 'fa-archive', 'Forms', 'Forms', NULL, '2017-10-29 17:18:33', '2018-04-15 22:55:23'),
(125, 0, 1, 'fa-archive', 'Books', 'Books', 127, '2018-04-22 03:44:19', '2018-04-22 04:12:48'),
(127, 0, 2, 'fa-archive', 'Tests', 'Delete test', NULL, '2018-04-22 04:12:39', '2018-04-22 04:39:30'),
(130, 0, 2, 'fa-archive', 'Permissions', 'Permissions', NULL, '2018-04-22 04:33:47', '2018-04-22 04:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`menu_id`, `role_id`) VALUES
(6, 1),
(6, 2),
(125, 1),
(125, 2),
(125, 3),
(127, 1),
(130, 1),
(130, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_10_10_000000_create_menus_table', 1),
(4, '2015_10_10_000000_create_roles_table', 1),
(5, '2015_10_10_000000_update_users_table', 1),
(6, '2015_12_11_000000_create_users_logs_table', 1),
(7, '2016_03_14_000000_update_menus_table', 1),
(8, '2017_10_25_100527_create_files_table', 1),
(9, '2017_10_30_054451_create_category_table', 2),
(10, '2018_02_20_145427_create_products_table', 2),
(11, '2018_04_08_041643_create_examples_table', 3),
(12, '2018_04_08_041857_create_philsat_table', 4),
(13, '2018_04_08_233405_create_test_table', 5),
(14, '2018_04_08_234008_create_uploads_table', 6),
(15, '2018_04_09_042726_create_textarea_table', 7),
(16, '2018_04_09_063213_create_editors_table', 8),
(17, '2018_04_09_073049_create_uploading_table', 9),
(18, '2018_04_09_073513_create_fileupload_table', 10),
(19, '2018_04_09_073916_create_fileuploading_table', 11),
(20, '2018_04_09_075248_create_numbers_table', 12),
(21, '2018_04_10_054131_create_table_sorting_table', 13),
(22, '2018_04_10_162328_create_location_test1_table', 14),
(23, '2018_04_10_163802_create_encrypted_routes_table', 15),
(24, '2018_04_11_012535_create_newenrypted_table', 16),
(25, '2018_04_11_013306_create_enumeration_table', 17),
(26, '2018_04_11_092023_create_sample_table', 18),
(27, '2018_04_11_161412_create_photos_table', 19),
(28, '2018_04_11_163222_create_datepickers_table', 20),
(29, '2018_04_12_063839_create_date_picker_editted_table', 21),
(30, '2018_04_12_164223_create_color_table', 22),
(31, '2018_04_12_164611_create_pallete_table', 23),
(32, '2018_04_12_165551_create_timepicker_table', 24),
(33, '2018_04_12_165802_create_timepicker1_table', 25),
(34, '2018_04_12_170301_create_pickers_table', 26),
(35, '2018_04_12_171253_create_toggle_table', 27),
(36, '2018_04_12_172837_create_relationship_table', 28),
(37, '2018_04_13_154312_create_books_table', 29),
(38, '2018_04_13_160450_create_favorites_table', 30),
(39, '2015_10_10_000000_update_favorites_table', 31),
(40, '2018_04_14_073844_create_chapter_table', 32),
(41, '2018_04_14_085120_create_many_1_table', 33),
(42, '2018_04_14_085250_create_many_2_table', 34),
(43, '2018_04_15_094814_create_favorites1_table', 35),
(44, '2018_04_15_094814_update_favorites1_table', 36),
(45, '2018_04_15_095036_create_favorites2_table', 36),
(46, '2018_04_15_095036_update_favorites2_table', 36),
(47, '2018_04_15_100523_create_favorites3_table', 37),
(48, '2018_04_15_100523_update_favorites3_table', 37),
(49, '2018_04_15_101121_create_favorites4_table', 38),
(50, '2018_04_15_101121_update_favorites4_table', 38),
(51, '2018_04_15_101527_create_favorites5_table', 39),
(52, '2018_04_15_101527_update_favorites5_table', 39),
(53, '2018_04_15_105042_create_favorites12_table', 40),
(54, '2018_04_15_105042_update_favorites12_table', 40),
(55, '2018_04_15_105315_create_favorites13_table', 41),
(56, '2018_04_15_105315_update_favorites13_table', 41),
(57, '2018_04_15_105708_create_favorites14_table', 42),
(58, '2018_04_15_105708_update_favorites14_table', 42),
(59, '2018_04_15_110515_create_favorites15_table', 43),
(60, '2018_04_15_110515_update_favorites15_table', 43),
(61, '2018_04_15_111859_create_favorites16_table', 44),
(62, '2018_04_15_111859_update_favorites16_table', 44),
(63, '2018_04_15_113524_create_favorites17_table', 45),
(64, '2018_04_15_113524_update_favorites17_table', 45),
(65, '2018_04_15_113752_create_favorites18_table', 46),
(66, '2018_04_15_113752_update_favorites18_table', 46),
(73, '2018_04_15_115039_create_favorites19_table', 47),
(74, '2018_04_15_115039_update_favorites19_table', 47),
(75, '2018_04_15_135110_create_favorites20_table', 48),
(76, '2018_04_15_135110_update_favorites20_table', 48),
(77, '2018_04_15_140229_create_favorites21_table', 49),
(78, '2018_04_15_140229_update_favorites21_table', 49),
(79, '2018_04_15_141054_create_favorites22_table', 50),
(80, '2018_04_15_141054_update_favorites22_table', 50),
(81, '2018_04_15_141352_create_favorites23_table', 51),
(82, '2018_04_15_141352_update_favorites23_table', 51),
(83, '2018_04_15_142119_create_favorites24_table', 52),
(84, '2018_04_15_142119_update_favorites24_table', 52),
(85, '2018_04_15_143211_create_favorite24_table', 53),
(86, '2018_04_15_143211_update_favorite24_table', 53),
(87, '2018_04_15_143853_create_examplemenu_table', 54),
(88, '2018_04_16_121507_create_all_menus_table', 55),
(89, '2018_04_16_121508_update_all_menus_table', 55),
(90, '2018_04_16_132630_create_updated_menus_table', 56),
(91, '2018_04_16_132630_update_updated_menus_table', 56),
(92, '2018_04_16_150754_create_relationshipdebug_table', 57),
(93, '2018_04_17_091749_create_relationshipdebug2_table', 58),
(94, '2018_04_17_144237_create_relationshipdebug3_table', 59),
(95, '2018_04_18_073613_create_testrelationship_table', 60),
(96, '2018_04_18_073613_update_testrelationship_table', 60),
(97, '2018_04_18_083445_create_viewtest_table', 61),
(98, '2018_04_18_083802_create_viewtest1_table', 62),
(99, '2018_04_18_124548_create_tabletoggletest_table', 63),
(100, '2018_04_18_124931_create_tabletoggletest21_table', 63),
(101, '2018_04_18_130252_create_tabletoggletest212_table', 64),
(102, '2018_04_18_130427_create_tabletoggletest2121_table', 65),
(103, '2018_04_18_143419_create_tabletoggletest21212_table', 66),
(104, '2018_04_19_124137_create_testfield1_table', 67),
(105, '2018_04_19_133937_create_imagetest_table', 68),
(106, '2018_04_19_141054_create_relationshipdebug1_table', 69),
(107, '2018_04_19_143914_create_relationshipdebug21_table', 70),
(108, '2018_04_19_144013_create_relationshipdebug212_table', 71),
(109, '2018_04_19_144129_create_relationshipdebug213_table', 72),
(110, '2018_04_20_055225_create_keiz_table', 73),
(111, '2018_04_22_032953_create_testcolumn1_table', 74),
(112, '2018_04_22_033630_create_testcolumn2_table', 75),
(113, '2018_04_22_034634_create_testcolumn3_table', 76),
(114, '2018_04_22_034903_create_testcolumn4_table', 77),
(115, '2018_04_22_035454_create_testcolumn6_table', 78),
(116, '2018_04_22_044048_create_datepicker1_table', 79),
(117, '2018_04_22_045240_create_statustest1_table', 80),
(118, '2018_04_22_051738_create_viewtest22_table', 81),
(119, '2018_04_22_052036_create_viewtest222_table', 82),
(120, '2018_04_22_052633_create_materials1_table', 83),
(121, '2018_04_22_052811_create_relationshipdebug213a_table', 84),
(122, '2018_04_22_052946_create_rel_table', 85),
(123, '2018_04_22_052946_update_rel_table', 85),
(124, '2018_04_22_063825_create_textarea1_table', 86),
(125, '2018_04_22_064318_create_textarea2_table', 87),
(126, '2018_04_22_064837_create_textarea3_table', 88),
(127, '2018_04_22_092638_create_todelete_table', 89),
(128, '2018_04_22_094627_create_todelete1_table', 90),
(129, '2018_04_22_101421_create_todelete2_table', 91),
(130, '2018_04_22_102031_create_todelete3_table', 92),
(131, '2018_04_22_102410_create_todelete4_table', 93),
(132, '2018_04_22_102410_update_todelete4_table', 93),
(133, '2018_04_22_102742_create_todelete5_table', 94),
(134, '2018_04_22_102742_update_todelete5_table', 94),
(135, '2018_04_22_105341_create_todelete6_table', 95),
(136, '2018_04_22_111242_create_todelete7_table', 96),
(137, '2018_04_22_111242_update_todelete7_table', 96),
(138, '2018_04_22_113342_create_todelete_table', 97),
(139, '2018_04_22_114419_create_books_table', 98),
(140, '2018_04_22_114537_create_todelete2_table', 99),
(141, '2018_04_22_114537_update_todelete2_table', 99),
(142, '2018_04_22_121404_create_todelete_table', 100),
(143, '2018_04_22_121518_create_todelete1_table', 101),
(144, '2018_04_22_121518_update_todelete1_table', 101),
(145, '2018_04_22_123718_create_todelete_table', 102);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Access', '2018-04-22 13:06:41', '2018-04-22 13:06:41'),
(2, 'Create', '2018-04-22 13:07:09', '2018-04-22 13:07:11'),
(3, 'Edit', '2018-04-22 13:07:05', '2018-04-22 13:07:09'),
(4, 'View', '2018-04-22 13:07:12', '2018-04-22 13:07:14'),
(5, 'Delete', '2018-04-22 13:07:22', '2018-04-22 13:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2017-10-27 20:05:04', '2017-10-27 20:05:04'),
(2, 'User', '2017-10-27 20:05:04', '2017-10-27 20:05:04'),
(3, 'addsfd', '2018-04-16 00:05:53', '2018-04-16 00:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(10) DEFAULT NULL,
  `permission_id` int(10) DEFAULT NULL,
  `menu_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 1, 135, '2018-04-22 05:56:49', '2018-04-22 05:56:49'),
(1, 2, 135, '2018-04-22 05:56:49', '2018-04-22 05:56:49'),
(1, 3, 135, '2018-04-22 05:56:49', '2018-04-22 05:56:49'),
(1, 4, 135, '2018-04-22 05:56:49', '2018-04-22 05:56:49'),
(1, 5, 135, '2018-04-22 05:56:50', '2018-04-22 05:56:50'),
(2, 1, 135, '2018-04-22 05:56:50', '2018-04-22 05:56:50'),
(2, 4, 135, '2018-04-22 05:56:50', '2018-04-22 05:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@example.com', '$2y$10$75z0mTJbiCJy89GTe6csheSMxdSm6L9/u1CWngUgh8Ifkd0zKmINi', 'Zk0uFq5TmM1k5WKLF5ZdhscmYBytUNF7Z8mM1nR9kPCpAlkXmTL0W93X6YWA', '2017-10-27 20:05:21', '2017-10-27 20:05:21'),
(2, 1, 'Super Admin', 'elowie.cruz@gmail.com', '$2y$10$lMBwWMxp5.wN1lQ/659lfepBRTZuOQCIyFnwMXo9MmeHOFqkLPhIm', 'fPo3X51JJ45XI2wXSSqKHLHDGmBrswCwIvNoSaPVFAtQKIChMDLR6mTEFcDm', '2018-04-09 00:10:52', '2018-04-17 00:53:10'),
(3, 2, 'Client', 'client@example.com', '$2y$10$3aM3rBwZZB11D4rTZDQ60ulg7zXVD.jwyzoKaq9Lawsj5zYmHREkC', 'KihaR7PK67vORePxBbbyDnQgvkpX2lEEzg26mfoT7bzo8rLuf6QGu61fn0ms', '2018-04-09 00:55:35', '2018-04-22 04:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `user_id`, `action`, `action_model`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'updated', 'users', 1, '2017-10-27 20:05:44', '2017-10-27 20:05:44'),
(2, 1, 'updated', 'users', 1, '2017-10-27 20:47:52', '2017-10-27 20:47:52'),
(3, 1, 'updated', 'users', 1, '2017-11-24 21:57:55', '2017-11-24 21:57:55'),
(4, 1, 'updated', 'users', 1, '2018-01-11 22:33:52', '2018-01-11 22:33:52'),
(5, 1, 'updated', 'users', 1, '2018-01-14 04:09:31', '2018-01-14 04:09:31'),
(6, 1, 'created', 'products', 1, '2018-02-20 07:07:12', '2018-02-20 07:07:12'),
(7, 1, 'created', 'test', 1, '2018-04-08 15:34:50', '2018-04-08 15:34:50'),
(8, 1, 'created', 'uploads', 1, '2018-04-08 15:43:35', '2018-04-08 15:43:35'),
(9, 1, 'updated', 'uploads', 1, '2018-04-08 15:44:09', '2018-04-08 15:44:09'),
(10, 1, 'updated', 'uploads', 1, '2018-04-08 15:44:26', '2018-04-08 15:44:26'),
(11, 1, 'updated', 'uploads', 1, '2018-04-08 15:47:21', '2018-04-08 15:47:21'),
(12, 1, 'created', 'uploads', 2, '2018-04-08 15:57:39', '2018-04-08 15:57:39'),
(13, 1, 'deleted', 'uploads', 1, '2018-04-08 15:59:07', '2018-04-08 15:59:07'),
(14, 1, 'deleted', 'uploads', 2, '2018-04-08 15:59:16', '2018-04-08 15:59:16'),
(15, 1, 'created', 'textarea', 1, '2018-04-08 20:28:15', '2018-04-08 20:28:15'),
(16, 1, 'created', 'textarea', 2, '2018-04-08 20:28:40', '2018-04-08 20:28:40'),
(17, 1, 'deleted', 'textarea', 2, '2018-04-08 20:28:44', '2018-04-08 20:28:44'),
(18, 1, 'created', 'textarea', 3, '2018-04-08 22:17:20', '2018-04-08 22:17:20'),
(19, 1, 'updated', 'textarea', 1, '2018-04-08 22:25:36', '2018-04-08 22:25:36'),
(20, 1, 'created', 'editors', 1, '2018-04-08 22:35:29', '2018-04-08 22:35:29'),
(21, 1, 'created', 'uploads', 3, '2018-04-08 23:19:51', '2018-04-08 23:19:51'),
(22, 1, 'created', 'uploading', 1, '2018-04-08 23:30:58', '2018-04-08 23:30:58'),
(23, 1, 'created', 'fileupload', 1, '2018-04-08 23:35:22', '2018-04-08 23:35:22'),
(24, 1, 'created', 'fileupload', 2, '2018-04-08 23:37:11', '2018-04-08 23:37:11'),
(25, 1, 'created', 'fileuploading', 1, '2018-04-08 23:39:27', '2018-04-08 23:39:27'),
(26, 1, 'created', 'numbers', 1, '2018-04-08 23:52:57', '2018-04-08 23:52:57'),
(27, 1, 'created', 'users', 2, '2018-04-09 00:10:52', '2018-04-09 00:10:52'),
(28, 1, 'created', 'textarea', 4, '2018-04-09 00:11:29', '2018-04-09 00:11:29'),
(29, 1, 'created', 'fileupload', 3, '2018-04-09 00:28:26', '2018-04-09 00:28:26'),
(30, 1, 'updated', 'users', 1, '2018-04-09 00:53:24', '2018-04-09 00:53:24'),
(31, 2, 'created', 'users', 3, '2018-04-09 00:55:35', '2018-04-09 00:55:35'),
(32, 2, 'updated', 'users', 2, '2018-04-09 00:55:45', '2018-04-09 00:55:45'),
(33, 3, 'updated', 'users', 3, '2018-04-09 00:57:38', '2018-04-09 00:57:38'),
(34, 2, 'created', 'examples', 1, '2018-04-09 01:13:41', '2018-04-09 01:13:41'),
(35, 1, 'created', 'locationtest1', 1, '2018-04-10 08:25:53', '2018-04-10 08:25:53'),
(36, 1, 'updated', 'locationtest1', 1, '2018-04-10 08:27:07', '2018-04-10 08:27:07'),
(37, 1, 'created', 'encryptedroutes', 1, '2018-04-10 08:38:11', '2018-04-10 08:38:11'),
(38, 1, 'created', 'encryptedroutes', 2, '2018-04-10 08:38:38', '2018-04-10 08:38:38'),
(39, 1, 'created', 'encryptedroutes', 3, '2018-04-10 08:38:42', '2018-04-10 08:38:42'),
(40, 1, 'created', 'encryptedroutes', 4, '2018-04-10 08:38:48', '2018-04-10 08:38:48'),
(41, 1, 'deleted', 'encryptedroutes', 2, '2018-04-10 08:39:10', '2018-04-10 08:39:10'),
(42, 2, 'updated', 'encryptedroutes', 1, '2018-04-10 17:12:37', '2018-04-10 17:12:37'),
(43, 2, 'deleted', 'encryptedroutes', 3, '2018-04-10 17:23:24', '2018-04-10 17:23:24'),
(44, 2, 'deleted', 'encryptedroutes', 4, '2018-04-10 17:23:24', '2018-04-10 17:23:24'),
(45, 2, 'created', 'encryptedroutes', 5, '2018-04-10 17:23:36', '2018-04-10 17:23:36'),
(46, 2, 'created', 'encryptedroutes', 6, '2018-04-10 17:23:41', '2018-04-10 17:23:41'),
(47, 2, 'updated', 'encryptedroutes', 5, '2018-04-10 17:23:53', '2018-04-10 17:23:53'),
(48, 2, 'deleted', 'encryptedroutes', 1, '2018-04-10 17:23:59', '2018-04-10 17:23:59'),
(49, 2, 'deleted', 'encryptedroutes', 5, '2018-04-10 17:23:59', '2018-04-10 17:23:59'),
(50, 2, 'created', 'newenrypted', 1, '2018-04-10 17:25:46', '2018-04-10 17:25:46'),
(51, 2, 'created', 'newenrypted', 2, '2018-04-10 17:26:00', '2018-04-10 17:26:00'),
(52, 2, 'created', 'newenrypted', 3, '2018-04-10 17:26:04', '2018-04-10 17:26:04'),
(53, 2, 'created', 'newenrypted', 4, '2018-04-10 17:26:11', '2018-04-10 17:26:11'),
(54, 2, 'deleted', 'newenrypted', 1, '2018-04-10 17:26:30', '2018-04-10 17:26:30'),
(55, 2, 'created', 'newenrypted', 5, '2018-04-10 17:26:38', '2018-04-10 17:26:38'),
(56, 2, 'created', 'enumeration', 1, '2018-04-10 17:33:15', '2018-04-10 17:33:15'),
(57, 2, 'created', 'enumeration', 2, '2018-04-10 17:33:20', '2018-04-10 17:33:20'),
(58, 2, 'created', 'enumeration', 3, '2018-04-10 17:33:24', '2018-04-10 17:33:24'),
(59, 2, 'updated', 'enumeration', 3, '2018-04-10 17:33:30', '2018-04-10 17:33:30'),
(60, 2, 'created', 'sample', 1, '2018-04-11 01:21:05', '2018-04-11 01:21:05'),
(61, 2, 'created', 'fileupload', 4, '2018-04-11 08:03:48', '2018-04-11 08:03:48'),
(62, 2, 'created', 'sample', 2, '2018-04-11 08:05:58', '2018-04-11 08:05:58'),
(63, 2, 'created', 'sample', 3, '2018-04-11 08:06:27', '2018-04-11 08:06:27'),
(64, 2, 'deleted', 'sample', 1, '2018-04-11 08:06:34', '2018-04-11 08:06:34'),
(65, 2, 'created', 'photos', 1, '2018-04-11 08:14:44', '2018-04-11 08:14:44'),
(66, 2, 'created', 'photos', 2, '2018-04-11 08:14:57', '2018-04-11 08:14:57'),
(67, 2, 'created', 'photos', 3, '2018-04-11 08:15:01', '2018-04-11 08:15:01'),
(68, 2, 'created', 'photos', 4, '2018-04-11 08:15:17', '2018-04-11 08:15:17'),
(69, 2, 'updated', 'photos', 3, '2018-04-11 08:15:22', '2018-04-11 08:15:22'),
(70, 2, 'updated', 'photos', 3, '2018-04-11 08:15:33', '2018-04-11 08:15:33'),
(71, 2, 'created', 'color', 1, '2018-04-12 08:42:42', '2018-04-12 08:42:42'),
(72, 2, 'created', 'pallete', 1, '2018-04-12 08:46:55', '2018-04-12 08:46:55'),
(73, 2, 'updated', 'color', 1, '2018-04-12 08:48:02', '2018-04-12 08:48:02'),
(74, 2, 'created', 'toggle', 1, '2018-04-12 09:13:05', '2018-04-12 09:13:05'),
(75, 2, 'created', 'toggle', 2, '2018-04-12 09:26:40', '2018-04-12 09:26:40'),
(76, 2, 'updated', 'toggle', 2, '2018-04-12 09:26:47', '2018-04-12 09:26:47'),
(77, 2, 'updated', 'toggle', 2, '2018-04-12 09:26:55', '2018-04-12 09:26:55'),
(78, 2, 'created', 'relationship', 1, '2018-04-12 09:28:50', '2018-04-12 09:28:50'),
(79, 2, 'created', 'books', 1, '2018-04-13 07:43:23', '2018-04-13 07:43:23'),
(80, 2, 'created', 'books', 2, '2018-04-13 07:43:23', '2018-04-13 07:43:23'),
(81, 2, 'created', 'books', 3, '2018-04-13 07:43:33', '2018-04-13 07:43:33'),
(82, 2, 'deleted', 'books', 2, '2018-04-13 07:43:35', '2018-04-13 07:43:35'),
(83, 2, 'created', 'books', 4, '2018-04-13 07:43:41', '2018-04-13 07:43:41'),
(84, 2, 'created', 'books', 5, '2018-04-13 07:43:47', '2018-04-13 07:43:47'),
(85, 2, 'created', 'favorites', 1, '2018-04-13 08:19:21', '2018-04-13 08:19:21'),
(86, 2, 'created', 'favorites', 2, '2018-04-13 08:19:33', '2018-04-13 08:19:33'),
(87, 2, 'created', 'favorites', 3, '2018-04-13 08:20:55', '2018-04-13 08:20:55'),
(88, 2, 'created', 'favorites', 4, '2018-04-13 08:21:34', '2018-04-13 08:21:34'),
(89, 2, 'created', 'favorites', 5, '2018-04-13 08:22:40', '2018-04-13 08:22:40'),
(90, 2, 'created', 'favorites', 6, '2018-04-13 08:22:48', '2018-04-13 08:22:48'),
(91, 2, 'created', 'favorites', 7, '2018-04-13 08:33:14', '2018-04-13 08:33:14'),
(92, 2, 'created', 'chapter', 1, '2018-04-13 23:38:56', '2018-04-13 23:38:56'),
(93, 2, 'updated', 'chapter', 1, '2018-04-13 23:42:43', '2018-04-13 23:42:43'),
(94, 2, 'created', 'relationship', 2, '2018-04-14 00:02:57', '2018-04-14 00:02:57'),
(95, 2, 'updated', 'users', 2, '2018-04-14 20:07:24', '2018-04-14 20:07:24'),
(96, 2, 'created', 'favorites3', 1, '2018-04-15 02:07:18', '2018-04-15 02:07:18'),
(97, 2, 'created', 'favorites3', 2, '2018-04-15 02:08:30', '2018-04-15 02:08:30'),
(98, 2, 'created', 'relationship', 3, '2018-04-15 02:28:44', '2018-04-15 02:28:44'),
(99, 2, 'created', 'favorites14', 1, '2018-04-15 02:58:38', '2018-04-15 02:58:38'),
(100, 2, 'created', 'favorites15', 1, '2018-04-15 03:07:28', '2018-04-15 03:07:28'),
(101, 2, 'created', 'favorites15_books', 0, '2018-04-15 03:07:28', '2018-04-15 03:07:28'),
(102, 2, 'created', 'favorites15_books', 0, '2018-04-15 03:07:28', '2018-04-15 03:07:28'),
(103, 2, 'created', 'favorites16', 1, '2018-04-15 03:19:11', '2018-04-15 03:19:11'),
(104, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:11', '2018-04-15 03:19:11'),
(105, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:11', '2018-04-15 03:19:11'),
(106, 2, 'created', 'favorites16', 2, '2018-04-15 03:19:26', '2018-04-15 03:19:26'),
(107, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:26', '2018-04-15 03:19:26'),
(108, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:26', '2018-04-15 03:19:26'),
(109, 2, 'created', 'favorites16', 3, '2018-04-15 03:19:38', '2018-04-15 03:19:38'),
(110, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:38', '2018-04-15 03:19:38'),
(111, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:38', '2018-04-15 03:19:38'),
(112, 2, 'created', 'favorites16', 4, '2018-04-15 03:19:53', '2018-04-15 03:19:53'),
(113, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:53', '2018-04-15 03:19:53'),
(114, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:53', '2018-04-15 03:19:53'),
(115, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:53', '2018-04-15 03:19:53'),
(116, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:19:54', '2018-04-15 03:19:54'),
(117, 2, 'created', 'favorites16', 5, '2018-04-15 03:28:16', '2018-04-15 03:28:16'),
(118, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:16', '2018-04-15 03:28:16'),
(119, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:16', '2018-04-15 03:28:16'),
(120, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:16', '2018-04-15 03:28:16'),
(121, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:16', '2018-04-15 03:28:16'),
(122, 2, 'created', 'favorites16', 6, '2018-04-15 03:28:43', '2018-04-15 03:28:43'),
(123, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:43', '2018-04-15 03:28:43'),
(124, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:43', '2018-04-15 03:28:43'),
(125, 2, 'created', 'favorites16_books', 0, '2018-04-15 03:28:43', '2018-04-15 03:28:43'),
(126, 2, 'created', 'favorites', 8, '2018-04-15 03:29:12', '2018-04-15 03:29:12'),
(127, 2, 'created', 'favorites', 9, '2018-04-15 03:31:36', '2018-04-15 03:31:36'),
(128, 2, 'created', 'favorites', 10, '2018-04-15 03:31:46', '2018-04-15 03:31:46'),
(129, 2, 'created', 'favorites17', 1, '2018-04-15 03:35:40', '2018-04-15 03:35:40'),
(130, 2, 'created', 'favorites17_books', 0, '2018-04-15 03:35:40', '2018-04-15 03:35:40'),
(131, 2, 'created', 'favorites17_books', 0, '2018-04-15 03:35:40', '2018-04-15 03:35:40'),
(132, 2, 'created', 'favorites18', 1, '2018-04-15 03:38:03', '2018-04-15 03:38:03'),
(133, 2, 'created', 'favorites18_books', 0, '2018-04-15 03:38:03', '2018-04-15 03:38:03'),
(134, 2, 'created', 'favorites18_books', 0, '2018-04-15 03:38:03', '2018-04-15 03:38:03'),
(135, 2, 'created', 'favorites18', 2, '2018-04-15 03:38:09', '2018-04-15 03:38:09'),
(136, 2, 'created', 'favorites18_books', 0, '2018-04-15 03:38:09', '2018-04-15 03:38:09'),
(137, 2, 'created', 'favorites19', 1, '2018-04-15 03:51:24', '2018-04-15 03:51:24'),
(138, 2, 'created', 'favorites', 11, '2018-04-15 03:53:39', '2018-04-15 03:53:39'),
(139, 2, 'deleted', 'favorites', 11, '2018-04-15 03:54:03', '2018-04-15 03:54:03'),
(140, 2, 'created', 'favorites', 12, '2018-04-15 03:56:28', '2018-04-15 03:56:28'),
(141, 2, 'updated', 'favorites', 12, '2018-04-15 03:56:35', '2018-04-15 03:56:35'),
(142, 2, 'created', 'favorites', 13, '2018-04-15 03:56:43', '2018-04-15 03:56:43'),
(143, 2, 'deleted', 'favorites', 13, '2018-04-15 03:56:56', '2018-04-15 03:56:56'),
(144, 2, 'created', 'favorites19', 2, '2018-04-15 03:59:47', '2018-04-15 03:59:47'),
(145, 2, 'created', 'favorites19', 1, '2018-04-15 04:05:08', '2018-04-15 04:05:08'),
(146, 2, 'created', 'favorites19', 2, '2018-04-15 04:07:22', '2018-04-15 04:07:22'),
(147, 2, 'created', 'favorites19', 3, '2018-04-15 04:07:26', '2018-04-15 04:07:26'),
(148, 2, 'created', 'favorites19', 4, '2018-04-15 04:07:42', '2018-04-15 04:07:42'),
(149, 2, 'created', 'favorites19_books', 0, '2018-04-15 04:07:42', '2018-04-15 04:07:42'),
(150, 2, 'created', 'favorites19_books', 0, '2018-04-15 04:07:42', '2018-04-15 04:07:42'),
(151, 2, 'created', 'favorites19', 1, '2018-04-15 04:10:15', '2018-04-15 04:10:15'),
(152, 2, 'created', 'favorites19', 2, '2018-04-15 04:10:50', '2018-04-15 04:10:50'),
(153, 2, 'created', 'favorites19', 3, '2018-04-15 04:13:18', '2018-04-15 04:13:18'),
(154, 2, 'created', 'favorites19', 4, '2018-04-15 04:13:25', '2018-04-15 04:13:25'),
(155, 2, 'created', 'favorites19', 5, '2018-04-15 04:13:28', '2018-04-15 04:13:28'),
(156, 2, 'created', 'favorites19', 6, '2018-04-15 04:27:57', '2018-04-15 04:27:57'),
(157, 2, 'created', 'favorites19', 7, '2018-04-15 04:28:20', '2018-04-15 04:28:20'),
(158, 2, 'created', 'favorites19', 8, '2018-04-15 04:28:39', '2018-04-15 04:28:39'),
(159, 2, 'created', 'favorites19', 1, '2018-04-15 04:47:43', '2018-04-15 04:47:43'),
(160, 2, 'deleted', 'favorites19', 1, '2018-04-15 04:49:15', '2018-04-15 04:49:15'),
(161, 2, 'created', 'favorites19', 2, '2018-04-15 04:49:54', '2018-04-15 04:49:54'),
(162, 2, 'created', 'favorites19', 3, '2018-04-15 04:50:03', '2018-04-15 04:50:03'),
(163, 2, 'deleted', 'favorites19', 3, '2018-04-15 04:50:14', '2018-04-15 04:50:14'),
(164, 2, 'created', 'favorites19', 4, '2018-04-15 05:04:13', '2018-04-15 05:04:13'),
(165, 2, 'created', 'favorites19', 5, '2018-04-15 05:32:37', '2018-04-15 05:32:37'),
(166, 2, 'created', 'favorites20', 1, '2018-04-15 05:54:55', '2018-04-15 05:54:55'),
(167, 2, 'created', 'favorites20_books', 0, '2018-04-15 05:54:55', '2018-04-15 05:54:55'),
(168, 2, 'created', 'favorites20_books', 0, '2018-04-15 05:54:55', '2018-04-15 05:54:55'),
(169, 2, 'created', 'favorites21', 1, '2018-04-15 06:06:20', '2018-04-15 06:06:20'),
(170, 2, 'created', 'favorites21_books', 0, '2018-04-15 06:06:20', '2018-04-15 06:06:20'),
(171, 2, 'created', 'favorites21_books', 0, '2018-04-15 06:06:20', '2018-04-15 06:06:20'),
(172, 2, 'created', 'favorites22', 1, '2018-04-15 06:11:04', '2018-04-15 06:11:04'),
(173, 2, 'created', 'favorites22_books', 0, '2018-04-15 06:11:04', '2018-04-15 06:11:04'),
(174, 2, 'created', 'favorites22_books', 0, '2018-04-15 06:11:04', '2018-04-15 06:11:04'),
(175, 2, 'created', 'favorites23', 1, '2018-04-15 06:14:02', '2018-04-15 06:14:02'),
(176, 2, 'created', 'favorites23_books', 0, '2018-04-15 06:14:02', '2018-04-15 06:14:02'),
(177, 2, 'created', 'favorites23_books', 0, '2018-04-15 06:14:02', '2018-04-15 06:14:02'),
(178, 2, 'created', 'favorites24', 1, '2018-04-15 06:21:35', '2018-04-15 06:21:35'),
(179, 2, 'created', 'favorites24_books', 0, '2018-04-15 06:21:35', '2018-04-15 06:21:35'),
(180, 2, 'created', 'favorites24_books', 0, '2018-04-15 06:21:35', '2018-04-15 06:21:35'),
(181, 2, 'updated', 'favorites24', 1, '2018-04-15 06:24:09', '2018-04-15 06:24:09'),
(182, 2, 'created', 'favorites24', 2, '2018-04-15 06:24:26', '2018-04-15 06:24:26'),
(183, 2, 'created', 'favorites24_books', 0, '2018-04-15 06:24:26', '2018-04-15 06:24:26'),
(184, 2, 'created', 'favorites24_books', 0, '2018-04-15 06:24:26', '2018-04-15 06:24:26'),
(185, 2, 'updated', 'favorites24', 2, '2018-04-15 06:24:32', '2018-04-15 06:24:32'),
(186, 2, 'updated', 'favorites24', 2, '2018-04-15 06:27:01', '2018-04-15 06:27:01'),
(187, 2, 'updated', 'favorites24', 2, '2018-04-15 06:27:06', '2018-04-15 06:27:06'),
(188, 2, 'updated', 'favorites24', 2, '2018-04-15 06:27:48', '2018-04-15 06:27:48'),
(189, 2, 'updated', 'favorites24', 2, '2018-04-15 06:28:56', '2018-04-15 06:28:56'),
(190, 2, 'updated', 'favorites24', 2, '2018-04-15 06:29:12', '2018-04-15 06:29:12'),
(191, 2, 'updated', 'favorites24', 2, '2018-04-15 06:29:36', '2018-04-15 06:29:36'),
(192, 2, 'updated', 'favorites24', 2, '2018-04-15 06:29:47', '2018-04-15 06:29:47'),
(193, 2, 'updated', 'favorites24', 2, '2018-04-15 06:29:55', '2018-04-15 06:29:55'),
(194, 2, 'updated', 'favorites24', 2, '2018-04-15 06:30:03', '2018-04-15 06:30:03'),
(195, 2, 'created', 'favorite24', 1, '2018-04-15 06:32:34', '2018-04-15 06:32:34'),
(196, 2, 'created', 'favorite24_books', 0, '2018-04-15 06:32:34', '2018-04-15 06:32:34'),
(197, 2, 'created', 'favorite24_books', 0, '2018-04-15 06:32:34', '2018-04-15 06:32:34'),
(198, 2, 'created', 'favorite24_books', 0, '2018-04-15 06:32:34', '2018-04-15 06:32:34'),
(199, 2, 'updated', 'favorite24', 1, '2018-04-15 06:32:41', '2018-04-15 06:32:41'),
(200, 2, 'created', 'favorite24', 2, '2018-04-15 06:33:08', '2018-04-15 06:33:08'),
(201, 2, 'created', 'favorite24_books', 0, '2018-04-15 06:33:08', '2018-04-15 06:33:08'),
(202, 2, 'created', 'favorite24_books', 0, '2018-04-15 06:33:08', '2018-04-15 06:33:08'),
(203, 2, 'created', 'favorite24_books', 0, '2018-04-15 06:33:08', '2018-04-15 06:33:08'),
(204, 2, 'created', 'examplemenu', 1, '2018-04-15 06:39:42', '2018-04-15 06:39:42'),
(205, 2, 'updated', 'examplemenu', 1, '2018-04-15 06:40:58', '2018-04-15 06:40:58'),
(206, 2, 'updated', 'examplemenu', 1, '2018-04-15 06:43:08', '2018-04-15 06:43:08'),
(207, 2, 'updated', 'examplemenu', 1, '2018-04-15 06:44:03', '2018-04-15 06:44:03'),
(208, 2, 'updated', 'users', 2, '2018-04-16 06:17:05', '2018-04-16 06:17:05'),
(209, 1, 'updated', 'updatedmenus', 1, '2018-04-16 06:51:54', '2018-04-16 06:51:54'),
(210, 2, 'updated', 'users', 2, '2018-04-17 00:53:10', '2018-04-17 00:53:10'),
(211, 2, 'updated', 'users', 3, '2018-04-17 00:53:16', '2018-04-17 00:53:16'),
(212, 2, 'updated', 'users', 2, '2018-04-17 00:53:20', '2018-04-17 00:53:20'),
(213, 3, 'created', 'relationshipdebug', 1, '2018-04-17 01:03:30', '2018-04-17 01:03:30'),
(214, 3, 'updated', 'relationshipdebug', 1, '2018-04-17 01:03:50', '2018-04-17 01:03:50'),
(215, 3, 'updated', 'users', 3, '2018-04-17 01:16:53', '2018-04-17 01:16:53'),
(216, 3, 'updated', 'users', 3, '2018-04-17 01:17:01', '2018-04-17 01:17:01'),
(217, 2, 'created', 'relationshipdebug2', 1, '2018-04-17 02:34:53', '2018-04-17 02:34:53'),
(218, 2, 'created', 'relationshipdebug2', 2, '2018-04-17 02:35:30', '2018-04-17 02:35:30'),
(219, 2, 'created', 'testrelationship', 1, '2018-04-17 23:36:31', '2018-04-17 23:36:31'),
(220, 2, 'created', 'testrelationship_books', 0, '2018-04-17 23:36:31', '2018-04-17 23:36:31'),
(221, 2, 'created', 'testrelationship_books', 0, '2018-04-17 23:36:31', '2018-04-17 23:36:31'),
(222, 2, 'updated', 'testrelationship', 1, '2018-04-17 23:36:38', '2018-04-17 23:36:38'),
(223, 2, 'created', 'viewtest', 1, '2018-04-18 00:37:08', '2018-04-18 00:37:08'),
(224, 2, 'created', 'viewtest1', 1, '2018-04-18 00:38:09', '2018-04-18 00:38:09'),
(225, 2, 'deleted', 'viewtest1', 1, '2018-04-18 00:38:30', '2018-04-18 00:38:30'),
(226, 2, 'created', 'viewtest1', 2, '2018-04-18 00:38:34', '2018-04-18 00:38:34'),
(227, 2, 'created', 'viewtest1', 3, '2018-04-18 00:39:37', '2018-04-18 00:39:37'),
(228, 2, 'created', 'tabletoggletest21', 1, '2018-04-18 04:49:57', '2018-04-18 04:49:57'),
(229, 2, 'created', 'tabletoggletest21', 2, '2018-04-18 04:50:01', '2018-04-18 04:50:01'),
(230, 2, 'created', 'tabletoggletest21', 3, '2018-04-18 04:50:05', '2018-04-18 04:50:05'),
(231, 2, 'created', 'tabletoggletest2121', 1, '2018-04-18 05:05:46', '2018-04-18 05:05:46'),
(232, 2, 'created', 'tabletoggletest21212', 1, '2018-04-18 06:35:09', '2018-04-18 06:35:09'),
(233, 2, 'updated', 'tabletoggletest21212', 1, '2018-04-18 06:35:29', '2018-04-18 06:35:29'),
(234, 2, 'created', 'testfield1', 1, '2018-04-19 04:44:54', '2018-04-19 04:44:54'),
(235, 2, 'created', 'testfield1', 2, '2018-04-19 04:45:36', '2018-04-19 04:45:36'),
(236, 2, 'created', 'testfield1', 3, '2018-04-19 04:46:48', '2018-04-19 04:46:48'),
(237, 2, 'created', 'imagetest', 1, '2018-04-19 05:39:56', '2018-04-19 05:39:56'),
(238, 2, 'created', 'relationshipdebug213', 1, '2018-04-19 06:41:37', '2018-04-19 06:41:37'),
(239, 2, 'updated', 'relationshipdebug213', 1, '2018-04-19 06:41:44', '2018-04-19 06:41:44'),
(240, 2, 'created', 'relationshipdebug213', 2, '2018-04-19 06:41:53', '2018-04-19 06:41:53'),
(241, 2, 'created', 'relationshipdebug213', 3, '2018-04-19 06:41:57', '2018-04-19 06:41:57'),
(242, 2, 'deleted', 'relationshipdebug213', 1, '2018-04-19 06:42:49', '2018-04-19 06:42:49'),
(243, 2, 'deleted', 'viewtest1', 2, '2018-04-19 06:44:23', '2018-04-19 06:44:23'),
(244, 2, 'deleted', 'viewtest1', 3, '2018-04-19 06:44:27', '2018-04-19 06:44:27'),
(245, 2, 'created', 'relationshipdebug213', 4, '2018-04-19 06:46:38', '2018-04-19 06:46:38'),
(246, 2, 'created', 'relationshipdebug213', 5, '2018-04-19 06:46:43', '2018-04-19 06:46:43'),
(247, 2, 'updated', 'relationshipdebug213', 5, '2018-04-19 06:46:50', '2018-04-19 06:46:50'),
(248, 2, 'deleted', 'relationshipdebug213', 4, '2018-04-19 06:50:11', '2018-04-19 06:50:11'),
(249, 2, 'created', 'relationshipdebug213', 6, '2018-04-19 06:50:17', '2018-04-19 06:50:17'),
(250, 2, 'created', 'relationshipdebug213', 7, '2018-04-19 06:50:21', '2018-04-19 06:50:21'),
(251, 2, 'created', 'relationshipdebug213', 8, '2018-04-19 06:50:26', '2018-04-19 06:50:26'),
(252, 2, 'deleted', 'relationshipdebug213', 6, '2018-04-19 06:50:30', '2018-04-19 06:50:30'),
(253, 2, 'deleted', 'relationshipdebug213', 8, '2018-04-19 06:50:30', '2018-04-19 06:50:30'),
(254, 2, 'created', 'keiz', 1, '2018-04-19 21:52:42', '2018-04-19 21:52:42'),
(255, 2, 'created', 'testcolumn1', 1, '2018-04-21 19:30:18', '2018-04-21 19:30:18'),
(256, 2, 'created', 'testcolumn1', 2, '2018-04-21 19:33:46', '2018-04-21 19:33:46'),
(257, 2, 'created', 'testcolumn1', 3, '2018-04-21 19:33:57', '2018-04-21 19:33:57'),
(258, 2, 'created', 'testcolumn1', 4, '2018-04-21 19:34:14', '2018-04-21 19:34:14'),
(259, 2, 'created', 'testcolumn1', 5, '2018-04-21 19:34:26', '2018-04-21 19:34:26'),
(260, 2, 'created', 'datepicker1', 1, '2018-04-21 20:40:58', '2018-04-21 20:40:58'),
(261, 2, 'created', 'statustest1', 1, '2018-04-21 20:52:53', '2018-04-21 20:52:53'),
(262, 2, 'updated', 'statustest1', 1, '2018-04-21 20:55:49', '2018-04-21 20:55:49'),
(263, 2, 'updated', 'statustest1', 1, '2018-04-21 20:56:04', '2018-04-21 20:56:04'),
(264, 2, 'created', 'statustest1', 2, '2018-04-21 20:56:19', '2018-04-21 20:56:19'),
(265, 2, 'created', 'statustest1', 3, '2018-04-21 20:56:24', '2018-04-21 20:56:24'),
(266, 2, 'updated', 'statustest1', 2, '2018-04-21 20:58:49', '2018-04-21 20:58:49'),
(267, 2, 'updated', 'statustest1', 3, '2018-04-21 20:59:51', '2018-04-21 20:59:51'),
(268, 2, 'updated', 'statustest1', 3, '2018-04-21 20:59:56', '2018-04-21 20:59:56'),
(269, 2, 'created', 'statustest1', 4, '2018-04-21 21:00:03', '2018-04-21 21:00:03'),
(270, 2, 'updated', 'statustest1', 3, '2018-04-21 21:00:08', '2018-04-21 21:00:08'),
(271, 2, 'updated', 'statustest1', 3, '2018-04-21 21:00:15', '2018-04-21 21:00:15'),
(272, 2, 'updated', 'statustest1', 3, '2018-04-21 21:00:23', '2018-04-21 21:00:23'),
(273, 2, 'updated', 'statustest1', 1, '2018-04-21 21:00:33', '2018-04-21 21:00:33'),
(274, 2, 'deleted', 'statustest1', 2, '2018-04-21 21:01:43', '2018-04-21 21:01:43'),
(275, 2, 'deleted', 'statustest1', 3, '2018-04-21 21:01:43', '2018-04-21 21:01:43'),
(276, 2, 'created', 'materials1', 1, '2018-04-21 21:26:50', '2018-04-21 21:26:50'),
(277, 2, 'created', 'materials1', 2, '2018-04-21 21:26:54', '2018-04-21 21:26:54'),
(278, 2, 'created', 'materials1', 3, '2018-04-21 21:27:01', '2018-04-21 21:27:01'),
(279, 2, 'created', 'materials1', 4, '2018-04-21 21:27:09', '2018-04-21 21:27:09'),
(280, 2, 'created', 'rel', 1, '2018-04-21 21:30:06', '2018-04-21 21:30:06'),
(281, 2, 'created', 'rel_materials1', 0, '2018-04-21 21:30:06', '2018-04-21 21:30:06'),
(282, 2, 'created', 'rel_materials1', 0, '2018-04-21 21:30:06', '2018-04-21 21:30:06'),
(283, 2, 'updated', 'rel', 1, '2018-04-21 21:32:56', '2018-04-21 21:32:56'),
(284, 2, 'created', 'rel', 2, '2018-04-21 22:24:56', '2018-04-21 22:24:56'),
(285, 2, 'created', 'rel_materials1', 0, '2018-04-21 22:24:56', '2018-04-21 22:24:56'),
(286, 2, 'created', 'rel_materials1', 0, '2018-04-21 22:24:56', '2018-04-21 22:24:56'),
(287, 2, 'created', 'rel_materials1', 0, '2018-04-21 22:24:56', '2018-04-21 22:24:56'),
(288, 2, 'updated', 'rel', 1, '2018-04-21 22:30:58', '2018-04-21 22:30:58'),
(289, 2, 'created', 'textarea1', 1, '2018-04-21 22:39:43', '2018-04-21 22:39:43'),
(290, 2, 'updated', 'textarea1', 1, '2018-04-21 22:40:49', '2018-04-21 22:40:49'),
(291, 2, 'updated', 'textarea1', 1, '2018-04-21 22:40:56', '2018-04-21 22:40:56'),
(292, 2, 'created', 'textarea2', 1, '2018-04-21 22:43:28', '2018-04-21 22:43:28'),
(293, 2, 'updated', 'textarea2', 1, '2018-04-21 22:43:45', '2018-04-21 22:43:45'),
(294, 2, 'updated', 'textarea2', 1, '2018-04-21 22:43:58', '2018-04-21 22:43:58'),
(295, 2, 'updated', 'textarea2', 1, '2018-04-21 22:44:10', '2018-04-21 22:44:10'),
(296, 2, 'updated', 'textarea2', 1, '2018-04-21 22:47:10', '2018-04-21 22:47:10'),
(297, 2, 'updated', 'textarea2', 1, '2018-04-21 22:47:22', '2018-04-21 22:47:22'),
(298, 2, 'created', 'textarea3', 1, '2018-04-21 22:48:51', '2018-04-21 22:48:51'),
(299, 2, 'updated', 'textarea3', 1, '2018-04-21 22:48:56', '2018-04-21 22:48:56'),
(300, 2, 'updated', 'textarea3', 1, '2018-04-21 22:49:05', '2018-04-21 22:49:05'),
(301, 2, 'created', 'todelete2', 1, '2018-04-22 02:17:07', '2018-04-22 02:17:07'),
(302, 2, 'created', 'todelete5', 1, '2018-04-22 02:28:04', '2018-04-22 02:28:04'),
(303, 2, 'created', 'todelete5_materials1', 0, '2018-04-22 02:28:04', '2018-04-22 02:28:04'),
(304, 2, 'created', 'todelete5_materials1', 0, '2018-04-22 02:28:04', '2018-04-22 02:28:04'),
(305, 2, 'created', 'todelete6', 1, '2018-04-22 02:54:05', '2018-04-22 02:54:05'),
(306, 2, 'created', 'todelete', 1, '2018-04-22 03:33:49', '2018-04-22 03:33:49'),
(307, 2, 'created', 'todelete', 2, '2018-04-22 03:33:54', '2018-04-22 03:33:54'),
(308, 2, 'created', 'books', 1, '2018-04-22 03:44:29', '2018-04-22 03:44:29'),
(309, 2, 'created', 'books', 2, '2018-04-22 03:44:40', '2018-04-22 03:44:40'),
(310, 2, 'created', 'books', 3, '2018-04-22 03:44:46', '2018-04-22 03:44:46'),
(311, 2, 'created', 'books', 4, '2018-04-22 03:44:49', '2018-04-22 03:44:49'),
(312, 2, 'created', 'todelete2', 1, '2018-04-22 03:45:46', '2018-04-22 03:45:46'),
(313, 2, 'created', 'todelete2_books', 0, '2018-04-22 03:45:46', '2018-04-22 03:45:46'),
(314, 2, 'created', 'todelete2_books', 0, '2018-04-22 03:45:46', '2018-04-22 03:45:46'),
(315, 2, 'created', 'todelete', 1, '2018-04-22 04:14:43', '2018-04-22 04:14:43'),
(316, 2, 'created', 'todelete1', 1, '2018-04-22 04:16:10', '2018-04-22 04:16:10'),
(317, 2, 'created', 'todelete1_books', 0, '2018-04-22 04:16:10', '2018-04-22 04:16:10'),
(318, 2, 'created', 'todelete1_books', 0, '2018-04-22 04:16:10', '2018-04-22 04:16:10'),
(319, 2, 'created', 'todelete1', 2, '2018-04-22 04:17:24', '2018-04-22 04:17:24'),
(320, 2, 'created', 'todelete1_books', 0, '2018-04-22 04:17:24', '2018-04-22 04:17:24'),
(321, 2, 'updated', 'users', 3, '2018-04-22 04:34:07', '2018-04-22 04:34:07'),
(322, 2, 'created', 'books', 5, '2018-04-22 06:33:57', '2018-04-22 06:33:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD UNIQUE KEY `menu_role_menu_id_role_id_unique` (`menu_id`,`role_id`),
  ADD KEY `menu_role_menu_id_index` (`menu_id`),
  ADD KEY `menu_role_role_id_index` (`role_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
