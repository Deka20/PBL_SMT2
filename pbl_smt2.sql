-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2025 at 02:45 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbl_smt2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_24_170051_add_role_to_users_table', 1),
(5, '2025_04_24_170411_add_nama_pengguna_to_users_table', 1),
(6, '2025_04_28_073626_add_tgl_lahir_to_users_table', 1),
(7, '2025_06_14_093826_create_portfolios_table', 2),
(8, '2025_06_14_140852_add_status_to_pembayaran_table', 3),
(9, '2025_06_14_143640_add_harga_to_pemesanan_table', 4),
(10, '2025_06_14_143740_add_timestamps_to_pemesanan_table', 5),
(11, '2025_06_19_090848_add_jam_akhir_to_pemesanan_table', 6),
(12, '2025_06_22_061114_remove_status_from_pemesanan_and_pembayaran', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets_otp`
--

CREATE TABLE `password_resets_otp` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets_otp`
--

INSERT INTO `password_resets_otp` (`id`, `email`, `otp`, `expires_at`, `created_at`) VALUES
(2, 'masadita2987@gmail.com', '617649', '2025-07-04 09:20:52', '2025-07-04 01:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `id_nota` varchar(20) DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `id_pemesanan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `user_id`, `bukti_pembayaran`, `id_nota`, `tgl_pembayaran`, `id_pemesanan`) VALUES
(1, 2, NULL, NULL, NULL, 165),
(2, 2, NULL, NULL, NULL, 166),
(3, 2, NULL, NULL, NULL, 167),
(4, 3, 'bukti_pembayaran/payment_168_1750679005.jpg', NULL, NULL, 168),
(5, 2, NULL, NULL, NULL, 169),
(6, 2, NULL, NULL, NULL, 170),
(7, 2, NULL, NULL, NULL, 171),
(8, 2, 'bukti_pembayaran/payment_172_1751112281.png', NULL, NULL, 172),
(9, 2, NULL, NULL, NULL, 173),
(10, 2, NULL, NULL, NULL, 174),
(11, 2, 'bukti_pembayaran/payment_175_1751443936.png', NULL, NULL, 175),
(12, 2, 'bukti_pembayaran/payment_176_1751447825.jpg', NULL, NULL, 176),
(13, 1, 'bukti_pembayaran/payment_177_1751448272.jpg', NULL, NULL, 177),
(14, 2, 'bukti_pembayaran/payment_178_1751512761.jpg', NULL, NULL, 178),
(15, 2, 'bukti_pembayaran/payment_179_1751513705.jpg', NULL, NULL, 179),
(16, 2, 'bukti_pembayaran/payment_180_1751517800.jpg', NULL, NULL, 180),
(17, 2, 'bukti_pembayaran/payment_181_1751696505.png', NULL, NULL, 181),
(18, 2, 'bukti_pembayaran/payment_182_1751862541.jpg', NULL, NULL, 182),
(19, 2, 'bukti_pembayaran/payment_183_1752119847.png', NULL, NULL, 183),
(20, 2, 'bukti_pembayaran/payment_184_1752122043.png', NULL, NULL, 184),
(21, 2, 'bukti_pembayaran/payment_185_1752813628.png', NULL, NULL, 185),
(22, 2, 'bukti_pembayaran/payment_186_1752813936.png', NULL, NULL, 186),
(23, 2, 'bukti_pembayaran/payment_187_1752818838.png', NULL, NULL, 187),
(24, 2, 'bukti_pembayaran/payment_188_1752828555.png', NULL, NULL, 188),
(25, 2, 'bukti_pembayaran/payment_189_1752828668.png', NULL, NULL, 189),
(26, 2, 'bukti_pembayaran/payment_190_1752829286.jpg', NULL, NULL, 190),
(27, 2, 'bukti_pembayaran/payment_191_1752829557.png', NULL, NULL, 191),
(28, 2, 'bukti_pembayaran/payment_192_1752829736.png', NULL, NULL, 192),
(29, 2, 'bukti_pembayaran/payment_193_1752829958.png', NULL, NULL, 193),
(30, 2, 'bukti_pembayaran/payment_194_1752830242.png', NULL, NULL, 194),
(31, 2, 'bukti_pembayaran/payment_195_1752830317.png', NULL, NULL, 195),
(32, 2, 'bukti_pembayaran/payment_196_1752831089.png', NULL, NULL, 196),
(33, 2, 'bukti_pembayaran/payment_197_1752831284.png', NULL, NULL, 197),
(34, 2, 'bukti_pembayaran/payment_198_1752831489.png', NULL, NULL, 198),
(35, 2, 'bukti_pembayaran/payment_199_1752848787.jpg', NULL, NULL, 199),
(36, 1, 'bukti_pembayaran/payment_200_1752912337.png', NULL, NULL, 200),
(37, 1, 'bukti_pembayaran/payment_201_1752913574.png', NULL, NULL, 201);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_studio` int DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `durasi` int DEFAULT NULL,
  `session_count` int NOT NULL DEFAULT '1',
  `sesi_durasi` int NOT NULL DEFAULT '15',
  `tanggal` date DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `jumlah_orang` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slots_detail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `user_id`, `nama`, `id_studio`, `total_harga`, `jam`, `jam_akhir`, `durasi`, `session_count`, `sesi_durasi`, `tanggal`, `no_hp`, `jumlah_orang`, `created_at`, `updated_at`, `slots_detail`) VALUES
(165, 2, 'Zidan Masadita P', 3, '200000.00', '11:30:00', '11:45:00', 15, 1, 15, '2025-06-26', '081241431441', 1, '2025-06-22 04:51:03', '2025-06-22 04:51:03', '11:30'),
(166, 2, 'Zidan Masadita P', 3, '200000.00', '11:45:00', '12:00:00', 15, 1, 15, '2025-06-26', '081241431441', 1, '2025-06-22 04:51:19', '2025-06-22 04:51:19', '11:45'),
(167, 2, 'Zidan Masadita P', 4, '1000000.00', '10:00:00', '11:00:00', 60, 1, 15, '2025-06-26', '081241431441', 1, '2025-06-22 04:51:36', '2025-06-22 04:51:36', '10:00,10:15,10:30,10:45'),
(168, 3, 'Administrator', 2, '120000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-06-30', '081234567890', 1, '2025-06-23 04:43:20', '2025-06-23 04:43:20', '11:15'),
(169, 2, 'Zidan Masadita P', 3, '200000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-01', '081241431441', 1, '2025-06-28 04:40:47', '2025-06-28 04:40:47', '10:45'),
(170, 2, 'Zidan Masadita P', 5, '250000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-06-30', '081241431441', 1, '2025-06-28 04:41:48', '2025-06-28 04:41:48', '10:45'),
(171, 2, 'Zidan Masadita P', 3, '200000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-06-30', '081241431441', 1, '2025-06-28 05:01:08', '2025-06-28 05:01:08', '11:15'),
(172, 2, 'Zidan Masadita P', 3, '200000.00', '11:00:00', '11:15:00', 15, 1, 15, '2025-06-29', '081241431441', 1, '2025-06-28 05:04:36', '2025-06-28 05:04:36', '11:00'),
(173, 2, 'Zidan Masadita P', 4, '250000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-06-30', '081241431441', 1, '2025-06-28 05:06:27', '2025-06-28 05:06:27', '11:15'),
(174, 2, 'Zidan Masadita P', 5, '250000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-06-30', '081241431441', 1, '2025-06-28 05:08:30', '2025-06-28 05:08:30', '11:15'),
(175, 2, 'Zidan Masadita P', 2, '120000.00', '14:15:00', '14:30:00', 15, 1, 15, '2025-07-23', '081241431441', 1, '2025-07-02 01:12:07', '2025-07-02 01:12:07', '14:15'),
(176, 2, 'Zidan Masadita P', 2, '240000.00', '10:30:00', '11:00:00', 30, 1, 15, '2025-07-07', '081241431441', 1, '2025-07-02 02:16:48', '2025-07-02 02:16:48', '10:30,10:45'),
(177, 1, 'Administrator', 2, '120000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-15', '081234567890', 1, '2025-07-02 02:24:26', '2025-07-02 02:24:26', '10:45'),
(178, 2, 'Zidan Masadita P', 2, '270000.00', '12:30:00', '13:00:00', 30, 1, 15, '2025-07-15', '081241431441', 4, '2025-07-02 20:18:41', '2025-07-02 20:18:41', '12:30,12:45'),
(179, 2, 'Zidan Masadita P', 1, '220000.00', '10:45:00', '11:15:00', 30, 1, 15, '2025-07-04', '081241431441', 3, '2025-07-02 20:34:30', '2025-07-02 20:34:30', '10:45,11:00'),
(180, 2, 'Zidan Masadita P', 1, '200000.00', '12:00:00', '12:30:00', 30, 1, 15, '2025-07-04', '081241431441', 1, '2025-07-02 21:43:04', '2025-07-02 21:43:04', '12:00,12:15'),
(181, 2, 'Zidan Masadita P', 4, '250000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-16', '081241431441', 1, '2025-07-04 23:21:41', '2025-07-04 23:21:41', '10:45'),
(182, 2, 'Zidan Masadita P', 3, '400000.00', '10:30:00', '11:00:00', 30, 1, 15, '2025-07-24', '081241431441', 1, '2025-07-06 21:28:56', '2025-07-06 21:28:56', '10:30,10:45'),
(183, 2, 'Zidan Masadita P', 5, '250000.00', '10:30:00', '10:45:00', 15, 1, 15, '2025-07-17', '081241431441', 1, '2025-07-09 20:57:19', '2025-07-09 20:57:19', '10:30'),
(184, 2, 'Zidan Masadita P', 1, '105000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-07-12', '081241431441', 2, '2025-07-09 21:33:40', '2025-07-09 21:33:40', '11:15'),
(185, 2, 'Zidan Masadita P', 2, '120000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-22', '081241431441', 1, '2025-07-17 21:40:20', '2025-07-17 21:40:20', '10:45'),
(186, 2, 'Zidan Masadita P', 2, '130000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-07-21', '081241431441', 3, '2025-07-17 21:45:32', '2025-07-17 21:45:32', '11:15'),
(187, 2, 'Zidan Masadita P', 3, '210000.00', '10:30:00', '10:45:00', 15, 1, 15, '2025-07-24', '081241431441', 3, '2025-07-17 23:07:09', '2025-07-17 23:07:09', '10:30'),
(188, 2, 'Zidan Masadita P', 2, '125000.00', '11:00:00', '11:15:00', 15, 1, 15, '2025-07-23', '081241431441', 2, '2025-07-18 01:49:05', '2025-07-18 01:49:05', '11:00'),
(189, 2, 'Zidan Masadita P', 1, '105000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-22', '081241431441', 2, '2025-07-18 01:51:00', '2025-07-18 01:51:00', '10:45'),
(190, 2, 'Zidan Masadita P', 2, '125000.00', '11:00:00', '11:15:00', 15, 1, 15, '2025-07-19', '081241431441', 2, '2025-07-18 02:01:18', '2025-07-18 02:01:18', '11:00'),
(191, 2, 'Zidan Masadita P', 2, '130000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-07-24', '081241431441', 3, '2025-07-18 02:05:51', '2025-07-18 02:05:51', '11:15'),
(192, 2, 'Zidan Masadita P', 2, '130000.00', '11:00:00', '11:15:00', 15, 1, 15, '2025-07-30', '081241431441', 3, '2025-07-18 02:08:49', '2025-07-18 02:08:49', '11:00'),
(193, 2, 'Zidan Masadita P', 2, '130000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-07-22', '081241431441', 3, '2025-07-18 02:12:32', '2025-07-18 02:12:32', '11:15'),
(194, 2, 'Zidan Masadita P', 2, '130000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-25', '081241431441', 3, '2025-07-18 02:17:15', '2025-07-18 02:17:15', '10:45'),
(195, 2, 'Zidan Masadita P', 3, '210000.00', '11:00:00', '11:15:00', 15, 1, 15, '2025-07-22', '081241431441', 3, '2025-07-18 02:18:32', '2025-07-18 02:18:32', '11:00'),
(196, 2, 'Zidan Masadita P', 2, '130000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-22', '081241431441', 3, '2025-07-18 02:31:25', '2025-07-18 02:31:25', '10:45'),
(197, 2, 'Zidan Masadita P', 3, '210000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-07-23', '081241431441', 3, '2025-07-18 02:34:37', '2025-07-18 02:34:37', '11:15'),
(198, 2, 'Zidan Masadita P', 3, '210000.00', '10:45:00', '11:00:00', 15, 1, 15, '2025-07-23', '081241431441', 3, '2025-07-18 02:38:03', '2025-07-18 02:38:03', '10:45'),
(199, 2, 'Zidan Masadita P', 2, '130000.00', '11:15:00', '11:30:00', 15, 1, 15, '2025-07-21', '081241431441', 3, '2025-07-18 07:26:17', '2025-07-18 07:26:17', '11:15'),
(200, 1, 'Administrator', 3, '205000.00', '11:30:00', '11:45:00', 15, 1, 15, '2025-07-22', '081234567890', 2, '2025-07-19 01:04:17', '2025-07-19 01:04:17', '11:30'),
(201, 1, 'Administrator', 4, '255000.00', '11:45:00', '12:00:00', 15, 1, 15, '2025-07-29', '081234567890', 2, '2025-07-19 01:26:10', '2025-07-19 01:26:10', '11:45');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio`
--

CREATE TABLE `portofolio` (
  `id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portofolio`
--

INSERT INTO `portofolio` (`id`, `image_path`, `created_at`, `updated_at`) VALUES
(6, 'portfolios/gametOmULM2sH2Gg7uejJkSST2yEXRFf8RfjGbqI.png', '2025-06-14 04:30:13', '2025-06-14 04:30:13'),
(7, 'portfolios/jIbhtt9Oeya8743pQYp5l35ADsSMd2pSwk3xh25n.jpg', '2025-06-14 04:30:45', '2025-06-14 04:30:45'),
(8, 'portfolios/q2SWf5HpU4z7SvPxlIDM5YIwAOuZkGM9w3UtqaEk.jpg', '2025-06-14 04:38:25', '2025-06-14 04:38:25'),
(9, 'portfolios/9jxODFdiJ0o9DkqrkKKtKNDkd31XK8nLz7BmUgO8.png', '2025-06-14 04:38:31', '2025-06-14 04:38:31'),
(10, 'portfolios/ykOSsBv1dz4mhKUpoRoMlMHvpws47yx6vhbkd8X6.jpg', '2025-06-14 04:38:39', '2025-06-14 04:38:39'),
(11, 'portfolios/xDCam89LPJNB635vbqp6690AhUB44lcxhEDd4plE.png', '2025-06-14 04:38:44', '2025-06-14 04:38:44'),
(12, 'portfolios/R1YDg4aQ7jCSKHTb3BxAcgzw7KhFDUSqADeQvatB.jpg', '2025-06-21 22:42:48', '2025-06-21 22:42:48'),
(13, 'portfolios/4GgSWMbn7iVHci1xNOu7LeFR7PNFVt1pAGiTxyPm.jpg', '2025-07-02 20:42:52', '2025-07-02 20:42:52'),
(15, 'portfolios/DqgCk9kWEnDMSs4yWaVf2I3dmoSgsYlSo5nXou5E.jpg', '2025-07-02 21:47:33', '2025-07-02 21:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `resi`
--

CREATE TABLE `resi` (
  `id_resi` int NOT NULL,
  `detail_sewa` text,
  `nama_studio` varchar(100) DEFAULT NULL,
  `jenis_studio` varchar(100) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `id_pemesanan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resi`
--

INSERT INTO `resi` (`id_resi`, `detail_sewa`, `nama_studio`, `jenis_studio`, `total_harga`, `id_pemesanan`, `created_at`, `updated_at`, `status`) VALUES
(119, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Thursday, 26 June 2025\nJam: 11:30 - 11:45\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:30 - 11:45 (Rp 200.000 + Rp 0)\nTotal Harga: Rp 200.000', 'Deluxe Family Studio', 'Deluxe', '200000.00', 165, '2025-06-22 04:51:03', '2025-06-22 04:51:03', 'pending'),
(120, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Thursday, 26 June 2025\nJam: 11:45 - 12:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:45 - 12:00 (Rp 200.000 + Rp 0)\nTotal Harga: Rp 200.000', 'Deluxe Family Studio', 'Deluxe', '200000.00', 166, '2025-06-22 04:51:19', '2025-06-22 04:51:19', 'pending'),
(121, 'Pemesanan Platinum Family Studio - Platinum\nTanggal: Thursday, 26 June 2025\nJam: 10:00 - 11:00\nDurasi: 60 menit (4 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:00 - 10:15 (Rp 250.000 + Rp 0)\nSlot 2: 10:15 - 10:30 (Rp 250.000 + Rp 0)\nSlot 3: 10:30 - 10:45 (Rp 250.000 + Rp 0)\nSlot 4: 10:45 - 11:00 (Rp 250.000 + Rp 0)\nTotal Harga: Rp 1.000.000', 'Platinum Family Studio', 'Platinum', '1000000.00', 167, '2025-06-22 04:51:36', '2025-06-22 04:51:36', 'pending'),
(122, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Monday, 30 June 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:15 - 11:30 (Rp 120.000 + Rp 0)\nTotal Harga: Rp 120.000', 'Platinum Selfphoto', 'Platinum', '120000.00', 168, '2025-06-23 04:43:20', '2025-06-23 04:43:20', 'pending'),
(123, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Tuesday, 01 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:45 - 11:00 (Rp 200.000 + Rp 0)\nTotal Harga: Rp 200.000', 'Deluxe Family Studio', 'Deluxe', '200000.00', 169, '2025-06-28 04:40:47', '2025-06-28 04:40:47', 'pending'),
(124, 'Pemesanan Deluxe Gradution Studio - Deluxe\nTanggal: Monday, 30 June 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:45 - 11:00 (Rp 250.000 + Rp 0)\nTotal Harga: Rp 250.000', 'Deluxe Gradution Studio', 'Deluxe', '250000.00', 170, '2025-06-28 04:41:48', '2025-06-28 04:41:48', 'pending'),
(125, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Monday, 30 June 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:15 - 11:30 (Rp 200.000 + Rp 0)\nTotal Harga: Rp 200.000', 'Deluxe Family Studio', 'Deluxe', '200000.00', 171, '2025-06-28 05:01:08', '2025-06-28 05:01:08', 'pending'),
(126, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Sunday, 29 June 2025\nJam: 11:00 - 11:15\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:00 - 11:15 (Rp 200.000 + Rp 0)\nTotal Harga: Rp 200.000', 'Deluxe Family Studio', 'Deluxe', '200000.00', 172, '2025-06-28 05:04:36', '2025-06-28 05:04:36', 'pending'),
(127, 'Pemesanan Platinum Family Studio - Platinum\nTanggal: Monday, 30 June 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:15 - 11:30 (Rp 250.000 + Rp 0)\nTotal Harga: Rp 250.000', 'Platinum Family Studio', 'Platinum', '250000.00', 173, '2025-06-28 05:06:27', '2025-06-28 05:06:27', 'pending'),
(128, 'Pemesanan Deluxe Gradution Studio - Deluxe\nTanggal: Monday, 30 June 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 11:15 - 11:30 (Rp 250.000 + Rp 0)\nTotal Harga: Rp 250.000', 'Deluxe Gradution Studio', 'Deluxe', '250000.00', 174, '2025-06-28 05:08:30', '2025-06-28 05:08:30', 'pending'),
(129, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Wednesday, 23 July 2025\nJam: 14:15 - 14:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 14:15 - 14:30 (Rp 120.000 + Rp 0)\nTotal Harga: Rp 120.000', 'Platinum Selfphoto', 'Platinum', '120000.00', 175, '2025-07-02 01:12:07', '2025-07-02 01:12:07', 'pending'),
(130, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Monday, 07 July 2025\nJam: 10:30 - 11:00\nDurasi: 30 menit (2 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:30 - 10:45 (Rp 120.000 + Rp 0)\nSlot 2: 10:45 - 11:00 (Rp 120.000 + Rp 0)\nTotal Harga: Rp 240.000', 'Platinum Selfphoto', 'Platinum', '240000.00', 176, '2025-07-02 02:16:48', '2025-07-02 02:16:48', 'pending'),
(131, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Tuesday, 15 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:45 - 11:00 (Rp 120.000 + Rp 0)\nTotal Harga: Rp 120.000', 'Platinum Selfphoto', 'Platinum', '120000.00', 177, '2025-07-02 02:24:26', '2025-07-02 02:24:26', 'pending'),
(132, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Tuesday, 15 July 2025\nJam: 12:30 - 13:00\nDurasi: 30 menit (2 slot)\nJumlah Orang: 4 orang\nSlot 1: 12:30 - 12:45 (Rp 120.000 + Rp 15.000)\nSlot 2: 12:45 - 13:00 (Rp 120.000 + Rp 15.000)\nTotal Harga: Rp 270.000', 'Platinum Selfphoto', 'Platinum', '270000.00', 178, '2025-07-02 20:18:41', '2025-07-02 20:18:41', 'pending'),
(133, 'Pemesanan Deluxe Selfphoto - Deluxe\nTanggal: Friday, 04 July 2025\nJam: 10:45 - 11:15\nDurasi: 30 menit (2 slot)\nJumlah Orang: 3 orang\nSlot 1: 10:45 - 11:00 (Rp 100.000 + Rp 10.000)\nSlot 2: 11:00 - 11:15 (Rp 100.000 + Rp 10.000)\nTotal Harga: Rp 220.000', 'Deluxe Selfphoto', 'Deluxe', '220000.00', 179, '2025-07-02 20:34:30', '2025-07-02 20:34:30', 'pending'),
(134, 'Pemesanan Deluxe Selfphoto - Deluxe\nTanggal: Friday, 04 July 2025\nJam: 12:00 - 12:30\nDurasi: 30 menit (2 slot)\nJumlah Orang: 1 orang\nSlot 1: 12:00 - 12:15 (Rp 100.000 + Rp 0)\nSlot 2: 12:15 - 12:30 (Rp 100.000 + Rp 0)\nTotal Harga: Rp 200.000', 'Deluxe Selfphoto', 'Deluxe', '200000.00', 180, '2025-07-02 21:43:04', '2025-07-02 21:43:04', 'pending'),
(135, 'Pemesanan Platinum Family Studio - Platinum\nTanggal: Wednesday, 16 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:45 - 11:00 (Rp 250.000 + Rp 0)\nTotal Harga: Rp 250.000', 'Platinum Family Studio', 'Platinum', '250000.00', 181, '2025-07-04 23:21:41', '2025-07-04 23:21:41', 'pending'),
(136, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Thursday, 24 July 2025\nJam: 10:30 - 11:00\nDurasi: 30 menit (2 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:30 - 10:45 (Rp 200.000 + Rp 0)\nSlot 2: 10:45 - 11:00 (Rp 200.000 + Rp 0)\nTotal Harga: Rp 400.000', 'Deluxe Family Studio', 'Deluxe', '400000.00', 182, '2025-07-06 21:28:56', '2025-07-06 21:28:56', 'pending'),
(137, 'Pemesanan Deluxe Gradution Studio - Deluxe\nTanggal: Thursday, 17 July 2025\nJam: 10:30 - 10:45\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:30 - 10:45 (Rp 250.000 + Rp 0)\nTotal Harga: Rp 250.000', 'Deluxe Gradution Studio', 'Deluxe', '250000.00', 183, '2025-07-09 20:57:19', '2025-07-09 20:57:19', 'pending'),
(138, 'Pemesanan Deluxe Selfphoto - Deluxe\nTanggal: Saturday, 12 July 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 2 orang\nSlot 1: 11:15 - 11:30 (Rp 100.000 + Rp 5.000)\nTotal Harga: Rp 105.000', 'Deluxe Selfphoto', 'Deluxe', '105000.00', 184, '2025-07-09 21:33:40', '2025-07-09 21:33:40', 'pending'),
(139, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Tuesday, 22 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 1 orang\nSlot 1: 10:45 - 11:00 (Rp 120.000 + Rp 0)\nTotal Harga: Rp 120.000', 'Platinum Selfphoto', 'Platinum', '120000.00', 185, '2025-07-17 21:40:20', '2025-07-17 21:40:20', 'pending'),
(140, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Monday, 21 July 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:15 - 11:30 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 186, '2025-07-17 21:45:32', '2025-07-17 21:45:32', 'pending'),
(141, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Thursday, 24 July 2025\nJam: 10:30 - 10:45\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 10:30 - 10:45 (Rp 200.000 + Rp 10.000)\nTotal Harga: Rp 210.000', 'Deluxe Family Studio', 'Deluxe', '210000.00', 187, '2025-07-17 23:07:09', '2025-07-17 23:07:09', 'pending'),
(142, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Wednesday, 23 July 2025\nJam: 11:00 - 11:15\nDurasi: 15 menit (1 slot)\nJumlah Orang: 2 orang\nSlot 1: 11:00 - 11:15 (Rp 120.000 + Rp 5.000)\nTotal Harga: Rp 125.000', 'Platinum Selfphoto', 'Platinum', '125000.00', 188, '2025-07-18 01:49:05', '2025-07-18 01:49:05', 'pending'),
(143, 'Pemesanan Deluxe Selfphoto - Deluxe\nTanggal: Tuesday, 22 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 2 orang\nSlot 1: 10:45 - 11:00 (Rp 100.000 + Rp 5.000)\nTotal Harga: Rp 105.000', 'Deluxe Selfphoto', 'Deluxe', '105000.00', 189, '2025-07-18 01:51:00', '2025-07-18 01:51:00', 'pending'),
(144, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Saturday, 19 July 2025\nJam: 11:00 - 11:15\nDurasi: 15 menit (1 slot)\nJumlah Orang: 2 orang\nSlot 1: 11:00 - 11:15 (Rp 120.000 + Rp 5.000)\nTotal Harga: Rp 125.000', 'Platinum Selfphoto', 'Platinum', '125000.00', 190, '2025-07-18 02:01:18', '2025-07-18 02:01:18', 'pending'),
(145, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Thursday, 24 July 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:15 - 11:30 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 191, '2025-07-18 02:05:51', '2025-07-18 02:05:51', 'pending'),
(146, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Wednesday, 30 July 2025\nJam: 11:00 - 11:15\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:00 - 11:15 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 192, '2025-07-18 02:08:49', '2025-07-18 02:08:49', 'pending'),
(147, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Tuesday, 22 July 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:15 - 11:30 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 193, '2025-07-18 02:12:32', '2025-07-18 02:12:32', 'pending'),
(148, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Friday, 25 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 10:45 - 11:00 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 194, '2025-07-18 02:17:15', '2025-07-18 02:17:15', 'pending'),
(149, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Tuesday, 22 July 2025\nJam: 11:00 - 11:15\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:00 - 11:15 (Rp 200.000 + Rp 10.000)\nTotal Harga: Rp 210.000', 'Deluxe Family Studio', 'Deluxe', '210000.00', 195, '2025-07-18 02:18:32', '2025-07-18 02:18:32', 'pending'),
(150, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Tuesday, 22 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 10:45 - 11:00 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 196, '2025-07-18 02:31:25', '2025-07-18 02:31:25', 'pending'),
(151, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Wednesday, 23 July 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:15 - 11:30 (Rp 200.000 + Rp 10.000)\nTotal Harga: Rp 210.000', 'Deluxe Family Studio', 'Deluxe', '210000.00', 197, '2025-07-18 02:34:37', '2025-07-18 02:34:37', 'pending'),
(152, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Wednesday, 23 July 2025\nJam: 10:45 - 11:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 10:45 - 11:00 (Rp 200.000 + Rp 10.000)\nTotal Harga: Rp 210.000', 'Deluxe Family Studio', 'Deluxe', '210000.00', 198, '2025-07-18 02:38:03', '2025-07-18 02:38:03', 'pending'),
(153, 'Pemesanan Platinum Selfphoto - Platinum\nTanggal: Monday, 21 July 2025\nJam: 11:15 - 11:30\nDurasi: 15 menit (1 slot)\nJumlah Orang: 3 orang\nSlot 1: 11:15 - 11:30 (Rp 120.000 + Rp 10.000)\nTotal Harga: Rp 130.000', 'Platinum Selfphoto', 'Platinum', '130000.00', 199, '2025-07-18 07:26:17', '2025-07-18 07:26:17', 'pending'),
(154, 'Pemesanan Deluxe Family Studio - Deluxe\nTanggal: Tuesday, 22 July 2025\nJam: 11:30 - 11:45\nDurasi: 15 menit (1 slot)\nJumlah Orang: 2 orang\nSlot 1: 11:30 - 11:45 (Rp 200.000 + Rp 5.000)\nTotal Harga: Rp 205.000', 'Deluxe Family Studio', 'Deluxe', '205000.00', 200, '2025-07-19 01:04:17', '2025-07-19 01:04:17', 'pending'),
(155, 'Pemesanan Platinum Family Studio - Platinum\nTanggal: Tuesday, 29 July 2025\nJam: 11:45 - 12:00\nDurasi: 15 menit (1 slot)\nJumlah Orang: 2 orang\nSlot 1: 11:45 - 12:00 (Rp 250.000 + Rp 5.000)\nTotal Harga: Rp 255.000', 'Platinum Family Studio', 'Platinum', '255000.00', 201, '2025-07-19 01:26:10', '2025-07-19 01:26:10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1R0jAY2dJZWmGGzSbpL5mOGWBMcbeJNqtL0rHdNr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNlY4bWJWYUgyMHB3WGVzMGVHUnZLOTM3TGsxc3BLS05KNFZvdjh6RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752828592),
('AdgZAksOrMyEuqNZMUOi0YUSnF8HQAmSdKNuy0r0', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmRIWEFyOUtWaDNCQ2lUYzBlZ2dBMW5oc1hvaktPaTVNRk0xT2ZVUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1752852165),
('hmpyMl5XQM31lB0zsh1esUI30mA81eQuC5lGujN3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEN5MXJrZ1ZjSVljaFFYYTI0TkNoVlJ3N1RocEVoQVgxdEp1Rlh4ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO319', 1752915407),
('MGTUFHgCqWOn1ugiVuD19Fo6zP5xjymUWwQHnMMI', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkZ1N2I1RFJvenVFMEM0MmRTc0ZCQVVxQUpSRFJaSG9HRG1hQXFIOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZWFtYW5hbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1752831520),
('yO8anztEmqLfES3IMsPaSU9p3fRClDTnekdTAA2I', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTXhiN2E2eGIxaEd4OEpaT3AyWUlreGsxTnBncG1CZnQ3dFRjTVltaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752848969);

-- --------------------------------------------------------

--
-- Table structure for table `studio_foto`
--

CREATE TABLE `studio_foto` (
  `id_studio` int NOT NULL,
  `jenis_studio` varchar(100) DEFAULT NULL,
  `nama_studio` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kapasitas` int NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diubah_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `studio_foto`
--

INSERT INTO `studio_foto` (`id_studio`, `jenis_studio`, `nama_studio`, `harga`, `gambar`, `kapasitas`, `dibuat_pada`, `diubah_pada`) VALUES
(1, 'Deluxe', 'Deluxe Selfphoto', '100000.00', 'studio_images/deluxe-selfphoto-1750563544.jpg', 3, '0000-00-00 00:00:00', '2025-06-22 03:39:04'),
(2, 'Platinum', 'Platinum Selfphoto', '120000.00', 'studio_images/platinum-selfphoto-1749900537.jpg', 5, '0000-00-00 00:00:00', '2025-06-14 11:28:57'),
(3, 'Deluxe', 'Deluxe Family Studio', '200000.00', 'studio_images/deluxe-family-studio-1750563326.jpg', 10, '0000-00-00 00:00:00', '2025-06-22 03:35:26'),
(4, 'Platinum', 'Platinum Family Studio', '250000.00', 'studio_images/platinum-family-studio-1750563406.jpg', 12, '0000-00-00 00:00:00', '2025-06-22 03:36:46'),
(5, 'Deluxe', 'Deluxe Gradution Studio', '250000.00', 'studio_images/deluxe-gradution-studio-1750563672.jpg', 15, '0000-00-00 00:00:00', '2025-06-22 03:41:12'),
(47, 'Diamond', 'Diamond Self Photo', '150000.00', 'studio_images/diamond-self-photo-1750145104.jpg', 6, '2025-06-17 07:25:04', '2025-06-23 02:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `total_penghasilan`
--

CREATE TABLE `total_penghasilan` (
  `id` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `id_studio` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_studio` varchar(100) DEFAULT NULL,
  `jenis_studio` varchar(100) DEFAULT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `jam_pemesanan` time NOT NULL,
  `jumlah_orang` int NOT NULL DEFAULT '1',
  `harga_dasar` decimal(15,2) NOT NULL,
  `biaya_tambahan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_harga` decimal(15,2) NOT NULL,
  `status_pemesanan` varchar(20) NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `periode` varchar(7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `total_penghasilan`
--

INSERT INTO `total_penghasilan` (`id`, `id_pemesanan`, `id_studio`, `user_id`, `nama_studio`, `jenis_studio`, `tanggal_pemesanan`, `jam_pemesanan`, `jumlah_orang`, `harga_dasar`, `biaya_tambahan`, `total_harga`, `status_pemesanan`, `bulan`, `tahun`, `periode`, `created_at`, `updated_at`) VALUES
(1, 165, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-06-26', '11:30:00', 1, '200000.00', '0.00', '200000.00', 'pending', 6, 2025, '2025-06', '2025-06-22 04:51:03', '2025-06-22 04:51:03'),
(2, 166, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-06-26', '11:45:00', 1, '200000.00', '0.00', '200000.00', 'pending', 6, 2025, '2025-06', '2025-06-22 04:51:19', '2025-06-22 04:51:19'),
(3, 167, 4, 2, 'Platinum Family Studio', 'Platinum', '2025-06-26', '10:00:00', 1, '1000000.00', '0.00', '1000000.00', 'pending', 6, 2025, '2025-06', '2025-06-22 04:51:36', '2025-06-22 04:51:36'),
(4, 168, 2, 3, 'Platinum Selfphoto', 'Platinum', '2025-06-30', '11:15:00', 1, '120000.00', '0.00', '120000.00', 'pending', 6, 2025, '2025-06', '2025-06-23 04:43:20', '2025-06-23 04:43:20'),
(5, 169, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-07-01', '10:45:00', 1, '200000.00', '0.00', '200000.00', 'pending', 7, 2025, '2025-07', '2025-06-28 04:40:47', '2025-06-28 04:40:47'),
(6, 170, 5, 2, 'Deluxe Gradution Studio', 'Deluxe', '2025-06-30', '10:45:00', 1, '250000.00', '0.00', '250000.00', 'pending', 6, 2025, '2025-06', '2025-06-28 04:41:48', '2025-06-28 04:41:48'),
(7, 171, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-06-30', '11:15:00', 1, '200000.00', '0.00', '200000.00', 'pending', 6, 2025, '2025-06', '2025-06-28 05:01:08', '2025-06-28 05:01:08'),
(8, 172, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-06-29', '11:00:00', 1, '200000.00', '0.00', '200000.00', 'pending', 6, 2025, '2025-06', '2025-06-28 05:04:36', '2025-06-28 05:04:36'),
(9, 173, 4, 2, 'Platinum Family Studio', 'Platinum', '2025-06-30', '11:15:00', 1, '250000.00', '0.00', '250000.00', 'pending', 6, 2025, '2025-06', '2025-06-28 05:06:27', '2025-06-28 05:06:27'),
(10, 174, 5, 2, 'Deluxe Gradution Studio', 'Deluxe', '2025-06-30', '11:15:00', 1, '250000.00', '0.00', '250000.00', 'pending', 6, 2025, '2025-06', '2025-06-28 05:08:30', '2025-06-28 05:08:30'),
(11, 175, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-23', '14:15:00', 1, '120000.00', '0.00', '120000.00', 'pending', 7, 2025, '2025-07', '2025-07-02 01:12:07', '2025-07-02 01:12:07'),
(12, 176, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-07', '10:30:00', 1, '240000.00', '0.00', '240000.00', 'pending', 7, 2025, '2025-07', '2025-07-02 02:16:48', '2025-07-02 02:16:48'),
(13, 177, 2, 1, 'Platinum Selfphoto', 'Platinum', '2025-07-15', '10:45:00', 1, '120000.00', '0.00', '120000.00', 'pending', 7, 2025, '2025-07', '2025-07-02 02:24:26', '2025-07-02 02:24:26'),
(14, 178, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-15', '12:30:00', 4, '240000.00', '30000.00', '270000.00', 'pending', 7, 2025, '2025-07', '2025-07-02 20:18:41', '2025-07-02 20:18:41'),
(15, 179, 1, 2, 'Deluxe Selfphoto', 'Deluxe', '2025-07-04', '10:45:00', 3, '200000.00', '20000.00', '220000.00', 'pending', 7, 2025, '2025-07', '2025-07-02 20:34:30', '2025-07-02 20:34:30'),
(16, 180, 1, 2, 'Deluxe Selfphoto', 'Deluxe', '2025-07-04', '12:00:00', 1, '200000.00', '0.00', '200000.00', 'pending', 7, 2025, '2025-07', '2025-07-02 21:43:04', '2025-07-02 21:43:04'),
(17, 181, 4, 2, 'Platinum Family Studio', 'Platinum', '2025-07-16', '10:45:00', 1, '250000.00', '0.00', '250000.00', 'pending', 7, 2025, '2025-07', '2025-07-04 23:21:41', '2025-07-04 23:21:41'),
(18, 182, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-07-24', '10:30:00', 1, '400000.00', '0.00', '400000.00', 'pending', 7, 2025, '2025-07', '2025-07-06 21:28:56', '2025-07-06 21:28:56'),
(19, 183, 5, 2, 'Deluxe Gradution Studio', 'Deluxe', '2025-07-17', '10:30:00', 1, '250000.00', '0.00', '250000.00', 'pending', 7, 2025, '2025-07', '2025-07-09 20:57:19', '2025-07-09 20:57:19'),
(20, 184, 1, 2, 'Deluxe Selfphoto', 'Deluxe', '2025-07-12', '11:15:00', 2, '100000.00', '5000.00', '105000.00', 'pending', 7, 2025, '2025-07', '2025-07-09 21:33:40', '2025-07-09 21:33:40'),
(21, 185, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-22', '10:45:00', 1, '120000.00', '0.00', '120000.00', 'pending', 7, 2025, '2025-07', '2025-07-17 21:40:20', '2025-07-17 21:40:20'),
(22, 186, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-21', '11:15:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-17 21:45:32', '2025-07-17 21:45:32'),
(23, 187, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-07-24', '10:30:00', 3, '200000.00', '10000.00', '210000.00', 'pending', 7, 2025, '2025-07', '2025-07-17 23:07:09', '2025-07-17 23:07:09'),
(24, 188, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-23', '11:00:00', 2, '120000.00', '5000.00', '125000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 01:49:05', '2025-07-18 01:49:05'),
(25, 189, 1, 2, 'Deluxe Selfphoto', 'Deluxe', '2025-07-22', '10:45:00', 2, '100000.00', '5000.00', '105000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 01:51:00', '2025-07-18 01:51:00'),
(26, 190, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-19', '11:00:00', 2, '120000.00', '5000.00', '125000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:01:18', '2025-07-18 02:01:18'),
(27, 191, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-24', '11:15:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:05:51', '2025-07-18 02:05:51'),
(28, 192, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-30', '11:00:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:08:49', '2025-07-18 02:08:49'),
(29, 193, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-22', '11:15:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:12:32', '2025-07-18 02:12:32'),
(30, 194, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-25', '10:45:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:17:15', '2025-07-18 02:17:15'),
(31, 195, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-07-22', '11:00:00', 3, '200000.00', '10000.00', '210000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:18:32', '2025-07-18 02:18:32'),
(32, 196, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-22', '10:45:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:31:25', '2025-07-18 02:31:25'),
(33, 197, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-07-23', '11:15:00', 3, '200000.00', '10000.00', '210000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:34:37', '2025-07-18 02:34:37'),
(34, 198, 3, 2, 'Deluxe Family Studio', 'Deluxe', '2025-07-23', '10:45:00', 3, '200000.00', '10000.00', '210000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 02:38:03', '2025-07-18 02:38:03'),
(35, 199, 2, 2, 'Platinum Selfphoto', 'Platinum', '2025-07-21', '11:15:00', 3, '120000.00', '10000.00', '130000.00', 'pending', 7, 2025, '2025-07', '2025-07-18 07:26:17', '2025-07-18 07:26:17'),
(36, 200, 3, 1, 'Deluxe Family Studio', 'Deluxe', '2025-07-22', '11:30:00', 2, '200000.00', '5000.00', '205000.00', 'pending', 7, 2025, '2025-07', '2025-07-19 01:04:17', '2025-07-19 01:04:17'),
(37, 201, 4, 1, 'Platinum Family Studio', 'Platinum', '2025-07-29', '11:45:00', 2, '250000.00', '5000.00', '255000.00', 'pending', 7, 2025, '2025-07', '2025-07-19 01:26:10', '2025-07-19 01:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `studio_id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `review_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `user_id`, `studio_id`, `booking_id`, `rating`, `review`, `review_date`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 179, 5, 'bgs', '2025-07-03 04:44:07', '2025-07-02 21:44:07', '2025-07-06 21:26:16'),
(5, 2, 1, 184, 5, 'bagus', '2025-07-18 04:40:58', '2025-07-17 21:40:58', '2025-07-17 21:40:58'),
(6, 2, 5, 183, 5, 'bagus', '2025-07-18 04:46:10', '2025-07-17 21:46:10', '2025-07-17 21:46:10'),
(7, 2, 2, 186, 5, 'Bagus', '2025-07-18 06:07:54', '2025-07-17 23:07:54', '2025-07-17 23:07:54'),
(15, 2, 2, 196, 5, 'gabus', '2025-07-18 09:38:32', '2025-07-18 02:38:32', '2025-07-18 02:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','pelanggan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelanggan',
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengguna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `nama_lengkap`, `telepon`, `nama_pengguna`, `tgl_lahir`, `foto`) VALUES
(1, 'admin@example.com', NULL, '$2y$12$.HEz261o7wnnO9eFPK.q9OxYUo6/b2.sEJge4h79Ouy5jUNVd1vUy', NULL, '2025-05-02 20:59:02', '2025-06-16 00:09:34', 'admin', 'Administrator', '081234567890', 'admin', '2004-05-12', 'profil_photos/dUw5DKSOico0o8jhUkGZMCqKQw2S43iCyDufR1lh.jpg'),
(2, 'masadita20@gmail.com', NULL, '$2y$12$S8yqVDd01mXMHwADPPoEvuZgAQzkSIyGujmE3epq.uYQ0w4X5S.t.', NULL, '2025-05-02 21:02:45', '2025-07-04 07:48:04', 'pelanggan', 'Zidan Masadita P', '081241431441', 'masadita', '2004-08-18', 'profil_photos/06acOXvNhTr7NFsb1Kz47OGvHllgNv9zFScH90EX.jpg'),
(3, 'admin1@example.com', NULL, '$2y$12$USAdk5zX32EgbbbnFJj5.uT0mi3B3CV.rCzmWpxdLpiR4up6hdwXe', NULL, '2025-05-06 03:59:47', '2025-05-06 03:59:47', 'admin', 'Administrator', '081234567890', 'admin1', '18/08/04', ''),
(5, 'rapiakbar@gmail.com', NULL, '$2y$12$VyYIqQ3LYxnJO7aFyEpPHOUaI4OI5Rswdkc6HYeTOODXUhRBAuo6q', NULL, '2025-05-06 21:23:08', '2025-05-06 21:23:08', 'pelanggan', 'rafi akhbar', '08124949494', 'rapiakbar', '2025-05-08', ''),
(6, 'masadita2987@gmail.com', NULL, '$2y$12$t2uc06l7f48PlMUyhNnAQ.c.zX.OqmDMEw.HugCKxMF8jUZ7uyFM6', NULL, '2025-05-14 18:55:41', '2025-06-13 21:21:09', 'pelanggan', 'Zidan Masadita Pramudia', '081241431441', 'zidan123', '2025-02-04', ''),
(9, 'emangkangts@gmail.com', NULL, '$2y$12$XbTqm/nYnH9qBbnF2nz3CuaQBHHmY773FIxtyJ8BRKj2qFKhN57my', NULL, '2025-07-06 19:56:56', '2025-07-06 19:56:56', 'pelanggan', 'gasfagaed', '081241431441', 'fafasfasf', '2025-07-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_pembayaran`
--

CREATE TABLE `verifikasi_pembayaran` (
  `id_verifikasi` bigint UNSIGNED NOT NULL,
  `id_pembayaran` bigint UNSIGNED NOT NULL,
  `id_pemesanan` bigint UNSIGNED NOT NULL,
  `status_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verifikasi_pembayaran`
--

INSERT INTO `verifikasi_pembayaran` (`id_verifikasi`, `id_pembayaran`, `id_pemesanan`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 165, 'pending', '2025-06-22 04:51:03', '2025-06-22 04:51:03'),
(2, 2, 166, 'pending', '2025-06-22 04:51:19', '2025-06-22 04:51:19'),
(3, 3, 167, 'pending', '2025-06-22 04:51:36', '2025-06-22 04:51:36'),
(4, 4, 168, 'selesai', '2025-06-23 04:43:20', '2025-06-23 04:45:36'),
(5, 5, 169, 'pending', '2025-06-28 04:40:47', '2025-06-28 04:40:47'),
(6, 6, 170, 'pending', '2025-06-28 04:41:48', '2025-06-28 04:41:48'),
(7, 7, 171, 'pending', '2025-06-28 05:01:08', '2025-06-28 05:01:08'),
(8, 8, 172, 'menunggu verifikasi', '2025-06-28 05:04:36', '2025-06-28 05:04:41'),
(9, 9, 173, 'pending', '2025-06-28 05:06:27', '2025-06-28 05:06:27'),
(10, 10, 174, 'pending', '2025-06-28 05:08:30', '2025-06-28 05:08:30'),
(11, 11, 175, 'selesai', '2025-07-02 01:12:07', '2025-07-02 01:13:01'),
(12, 12, 176, 'selesai', '2025-07-02 02:16:48', '2025-07-02 02:20:14'),
(13, 13, 177, 'selesai', '2025-07-02 02:24:26', '2025-07-19 01:26:56'),
(14, 14, 178, 'menunggu verifikasi', '2025-07-02 20:18:41', '2025-07-02 20:19:22'),
(15, 15, 179, 'selesai', '2025-07-02 20:34:30', '2025-07-02 20:40:01'),
(16, 16, 180, 'selesai', '2025-07-02 21:43:04', '2025-07-02 21:46:20'),
(17, 17, 181, 'menunggu verifikasi', '2025-07-04 23:21:41', '2025-07-04 23:21:46'),
(18, 18, 182, 'menunggu verifikasi', '2025-07-06 21:28:56', '2025-07-06 21:29:01'),
(19, 19, 183, 'selesai', '2025-07-09 20:57:19', '2025-07-09 20:57:49'),
(20, 20, 184, 'selesai', '2025-07-09 21:33:40', '2025-07-09 21:37:01'),
(21, 21, 185, 'menunggu verifikasi', '2025-07-17 21:40:20', '2025-07-17 21:40:28'),
(22, 22, 186, 'selesai', '2025-07-17 21:45:32', '2025-07-17 23:04:02'),
(23, 23, 187, 'ditolak', '2025-07-17 23:07:09', '2025-07-17 23:08:59'),
(24, 24, 188, 'selesai', '2025-07-18 01:49:05', '2025-07-18 01:49:52'),
(25, 25, 189, 'menunggu verifikasi', '2025-07-18 01:51:00', '2025-07-18 01:51:08'),
(26, 26, 190, 'menunggu verifikasi', '2025-07-18 02:01:18', '2025-07-18 02:01:26'),
(27, 27, 191, 'menunggu verifikasi', '2025-07-18 02:05:51', '2025-07-18 02:05:57'),
(28, 28, 192, 'menunggu verifikasi', '2025-07-18 02:08:49', '2025-07-18 02:08:56'),
(29, 29, 193, 'menunggu verifikasi', '2025-07-18 02:12:32', '2025-07-18 02:12:38'),
(30, 30, 194, 'menunggu verifikasi', '2025-07-18 02:17:15', '2025-07-18 02:17:22'),
(31, 31, 195, 'selesai', '2025-07-18 02:18:32', '2025-07-18 07:29:29'),
(32, 32, 196, 'selesai', '2025-07-18 02:31:25', '2025-07-18 02:33:40'),
(33, 33, 197, 'menunggu verifikasi', '2025-07-18 02:34:37', '2025-07-18 02:34:44'),
(34, 34, 198, 'ditolak', '2025-07-18 02:38:03', '2025-07-18 07:27:01'),
(35, 35, 199, 'diverifikasi', '2025-07-18 07:26:17', '2025-07-18 07:26:56'),
(36, 36, 200, 'menunggu verifikasi', '2025-07-19 01:04:17', '2025-07-19 01:05:37'),
(37, 37, 201, 'diverifikasi', '2025-07-19 01:26:10', '2025-07-19 01:26:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets_otp`
--
ALTER TABLE `password_resets_otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `fk_pembayaran_user` (`user_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_studio` (`id_studio`),
  ADD KEY `fk_pemesanan_user` (`user_id`);

--
-- Indexes for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id_resi`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `studio_foto`
--
ALTER TABLE `studio_foto`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indexes for table `total_penghasilan`
--
ALTER TABLE `total_penghasilan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pemesanan` (`id_pemesanan`),
  ADD KEY `idx_studio` (`id_studio`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_periode` (`periode`),
  ADD KEY `idx_tanggal` (`tanggal_pemesanan`),
  ADD KEY `idx_bulan_tahun` (`bulan`,`tahun`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_resets_otp`
--
ALTER TABLE `password_resets_otp`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id_resi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `studio_foto`
--
ALTER TABLE `studio_foto`
  MODIFY `id_studio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `total_penghasilan`
--
ALTER TABLE `total_penghasilan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  MODIFY `id_verifikasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pembayaran_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_studio`) REFERENCES `studio_foto` (`id_studio`);

--
-- Constraints for table `resi`
--
ALTER TABLE `resi`
  ADD CONSTRAINT `fk_resi_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resi_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `total_penghasilan`
--
ALTER TABLE `total_penghasilan`
  ADD CONSTRAINT `fk_total_penghasilan_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_total_penghasilan_studio` FOREIGN KEY (`id_studio`) REFERENCES `studio_foto` (`id_studio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_total_penghasilan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
