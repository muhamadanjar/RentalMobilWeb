-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 04:35 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `post_id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `posted_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sex` enum('Laki-laki','Perempuan') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Laki-laki',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `sex`, `name`, `email`, `telp`, `religion`, `tgl_lahir`, `address`, `city_id`, `job`, `nationality`, `education`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Laki-laki', 'Customer 5', 'customer5@gmail.com', '000', 'Islam', '2018-04-05', '-', NULL, '-', 'Indonesia', 'SMP', 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fbstatus`
--

CREATE TABLE `fbstatus` (
  `status_id` int(11) NOT NULL,
  `s_text` text,
  `t_status` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fbstatus`
--

INSERT INTO `fbstatus` (`status_id`, `s_text`, `t_status`) VALUES
(1, 'dfdfdf', '2018-04-08 05:28:10'),
(2, 'apa adanya', '2018-04-08 06:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE `hubungi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pesan` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dibaca` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `predicate` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_id` bigint(20) UNSIGNED DEFAULT NULL,
  `object_type` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_revisions`
--

CREATE TABLE `log_revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `revisionable_type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_revisions`
--

INSERT INTO `log_revisions` (`id`, `revisionable_type`, `revisionable_id`, `user_id`, `activity_id`, `key`, `old_value`, `new_value`, `created_at`, `updated_at`) VALUES
(1, 'App\\Officer\\Officer', 1, 1, NULL, 'name', NULL, 'Muhamad Anjar P', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(2, 'App\\Officer\\Officer', 1, 1, NULL, 'nip', NULL, ' ', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(3, 'App\\Officer\\Officer', 1, 1, NULL, 'alamat', NULL, 'Caringin', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(4, 'App\\Officer\\Officer', 1, 1, NULL, 'no_telp', NULL, '0000', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(5, 'App\\Officer\\Officer', 1, 1, NULL, 'role', NULL, 'staff/karyawan', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(6, 'App\\Officer\\Officer', 1, 1, NULL, 'name', NULL, 'Muhamad Anjar P', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(7, 'App\\Officer\\Officer', 1, 1, NULL, 'nip', NULL, ' ', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(8, 'App\\Officer\\Officer', 1, 1, NULL, 'alamat', NULL, 'Caringin', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(9, 'App\\Officer\\Officer', 1, 1, NULL, 'no_telp', NULL, '0000', '2018-03-29 16:50:45', '2018-03-29 16:50:45'),
(10, 'App\\Officer\\Officer', 1, 1, NULL, 'role', NULL, 'staff/karyawan', '2018-03-29 16:50:45', '2018-03-29 16:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `log_sewa_status`
--

CREATE TABLE `log_sewa_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sewa_id` bigint(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_sewa_status`
--

INSERT INTO `log_sewa_status` (`id`, `sewa_id`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, '2018-04-05 15:36:56', '0', NULL, NULL),
(2, 11, '2018-04-05 15:37:04', '9', NULL, NULL),
(3, 11, '2018-04-05 15:44:48', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE `lookups` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lookups`
--

INSERT INTO `lookups` (`id`, `type`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'jabatan', 'Operator', NULL, NULL, NULL),
(2, 'jabatan', 'Pengemudi / Driver', NULL, NULL, NULL),
(11, 'type_sewa', 'Rental', NULL, NULL, NULL),
(12, 'type_sewa', 'Taxi', NULL, NULL, NULL),
(21, 'status_sewa', 'pending', NULL, NULL, NULL),
(22, 'status_sewa', 'cancelled', NULL, NULL, NULL),
(23, 'status_sewa', 'confirmed', NULL, NULL, NULL),
(24, 'status_sewa', 'collected', NULL, NULL, NULL),
(25, 'status_sewa', 'complete', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id`, `merk`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mitsubishi', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48'),
(2, 'Toyota', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48'),
(3, 'Daihatsu', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48'),
(4, 'Suzuki', NULL, 0, '2018-03-29 05:25:48', '2018-03-29 05:25:48');

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
(3, '2017_10_20_040704_wilayah_provinsi', 1),
(4, '2017_10_20_040723_wilayah_kabupaten', 1),
(5, '2017_10_20_040735_wilayah_kecamatan', 1),
(6, '2017_10_20_040752_wilayah_desa', 1),
(7, '2017_10_20_075351_roles', 1),
(8, '2017_10_20_075403_permission', 1),
(9, '2017_10_20_075423_permission_role', 1),
(10, '2017_10_20_075443_role_user', 1),
(11, '2017_10_20_075752_post', 1),
(12, '2017_10_20_075753_comments', 1),
(13, '2017_10_20_075753_newsletter_subcriptions', 1),
(14, '2017_10_20_081140_settings', 1),
(15, '2017_10_20_082352_create_sessions_table', 1),
(16, '2017_10_20_082434_create_jobs_table', 1),
(17, '2017_10_20_082514_create_failed_jobs_table', 1),
(18, '2017_10_20_082607_create_cache_table', 1),
(19, '2017_10_20_082620_create_notifications_table', 1),
(20, '2017_10_22_125029_officers', 1),
(21, '2017_10_22_125048_lookups', 1),
(22, '2017_10_22_125252_log_activity', 1),
(23, '2017_10_22_125302_log_revisions', 1),
(24, '2017_11_02_162438_category', 1),
(25, '2017_11_02_162454_tags', 1),
(26, '2017_11_04_224448_post_tag', 1),
(27, '2017_11_21_142217_stasistik', 1),
(28, '2017_11_21_143101_hubungi', 1),
(29, '2017_11_24_221009_sekilasinfo', 1),
(30, '2018_01_19_103759_userverifications', 1),
(31, '2018_01_25_090027_mobil', 1),
(32, '2018_01_25_090038_mobil_fasilitas', 1),
(33, '2018_01_30_025244_sewa', 1),
(34, '2018_03_19_151137_sewa_detail', 1),
(35, '2018_03_19_164404_log_sewa_status', 1),
(36, '2018_03_22_113150_type', 1),
(37, '2018_03_22_114335_merk', 1),
(38, '2018_03_22_130610_customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_plat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `warna` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_perjam` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('tersedia','dipinjam') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id`, `no_plat`, `name`, `merk`, `type`, `warna`, `harga`, `harga_perjam`, `tahun`, `foto`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'F 9080 GH', 'Alphard', 'Toyota', 'Cumperback', 'Hitam', 500000, 5000, 2016, 'http:/10.10.2.2:8000/images/car/alphard.jpg', 3, 'tersedia', NULL, NULL),
(52, 'F 3774 HJ', 'Fortuner', 'Toyota', 'Luxury', 'Putih', 400000, 3400, 2015, 'http:/10.10.2.2:8000/images/car/fortuner.jpg', 3, 'tersedia', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mobil_fasilitas`
--

CREATE TABLE `mobil_fasilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobil_id` int(10) UNSIGNED NOT NULL,
  `fasilitas_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscriptions`
--

CREATE TABLE `newsletter_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` bigint(20) UNSIGNED NOT NULL,
  `pangkat_id` int(10) UNSIGNED DEFAULT NULL,
  `jabatan_id` int(10) UNSIGNED DEFAULT NULL,
  `role` enum('staff/karyawan','customer') COLLATE utf8_unicode_ci NOT NULL,
  `deposit` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `name`, `nip`, `alamat`, `no_telp`, `pangkat_id`, `jabatan_id`, `role`, `deposit`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Muhamad Anjar P', ' ', 'Caringin', 87870427227, 0, 2, 'staff/karyawan', 0, 3, '2018-03-29 16:50:45', '2018-03-29 16:50:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumumam`
--

CREATE TABLE `pengumumam` (
  `id` int(10) UNSIGNED NOT NULL,
  `info` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `author_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'access.backend', NULL, NULL),
(2, 'create.user', NULL, NULL),
(3, 'edit.user', NULL, NULL),
(4, 'delete.user', NULL, NULL),
(5, 'create.article', NULL, NULL),
(6, 'edit.article', NULL, NULL),
(7, 'delete.article', NULL, NULL),
(8, 'create.dokumen', NULL, NULL),
(9, 'edit.dokumen', NULL, NULL),
(10, 'delete.dokumen', NULL, NULL),
(11, 'create.informasi', NULL, NULL),
(12, 'edit.informasi', NULL, NULL),
(13, 'delete.informasi', NULL, NULL),
(14, 'create.mobil', NULL, NULL),
(15, 'edit.mobil', NULL, NULL),
(16, 'delete.mobil', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(14, 1),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `type_post` enum('post','page','kegiatan','lowongan') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('published','draft') COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('main','manual') COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `dibaca` int(11) NOT NULL,
  `sticky` int(11) DEFAULT '0',
  `posted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, NULL),
(2, 'admin', NULL, NULL),
(3, 'driver', NULL, NULL),
(4, 'customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bf2d91S4vUAbuC3FOqHYxVts47XfoWH8RWuj7wdc', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiYzNLMm8xb01aQmhaNXRGb2xvMk0zbDVGTHVINTZNcWlUNnppbGFHSiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9iYWNrZW5kL3RyYW5zYWtzaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo4OiJsaW5rX3dlYiI7czo5OiJkYXNoYm9hcmQiO3M6NDoiYWtzaSI7czo0OiJlZGl0IjtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTUyMzE2MTUzMTtzOjE6ImMiO2k6MTUyMzE1NDQzNztzOjE6ImwiO3M6MToiMCI7fX0=', 1523161531),
('f4b3frjNS5MTAvqiur0v8qvpab8j1iiat1wts2Bq', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiUWhHMmJ6YXhlSDVrOEc2alJTdVVRQVdpb0NqUEt1SjE4NnE0ZndWOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9iYWNrZW5kL2Rhc2hib2FyZC9pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo4OiJsaW5rX3dlYiI7czo5OiJkYXNoYm9hcmQiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTIzMTk3MjEwO3M6MToiYyI7aToxNTIzMTkxMjQ2O3M6MToibCI7czoxOiIwIjt9fQ==', 1523197210),
('YmfkScjuULBpVpy7FoWyOIxN0ZlbjwEy1NMDzhCY', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiRGl1aXJhajZYSjl2MTM3akdRVDIwZWF2QkZLTEFzN2VQQnRWc1NWWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9iYWNrZW5kL3RyYW5zYWtzaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo4OiJsaW5rX3dlYiI7czo5OiJkYXNoYm9hcmQiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTIzMTk3OTc4O3M6MToiYyI7aToxNTIzMTk3OTQ2O3M6MToibCI7czoxOiIwIjt9fQ==', 1523197979);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_akhir` datetime DEFAULT NULL,
  `origin` varchar(255) NOT NULL,
  `origin_latitude` decimal(8,5) NOT NULL,
  `origin_longitude` decimal(8,5) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `destination_latitude` decimal(8,5) NOT NULL,
  `destination_longitude` decimal(8,5) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `customer_id`, `mobil_id`, `tgl_mulai`, `tgl_akhir`, `origin`, `origin_latitude`, `origin_longitude`, `destination`, `destination_latitude`, `destination_longitude`, `total_bayar`, `denda`, `status`, `created_at`, `updated_at`, `delete_at`) VALUES
(34, 10, 1, NULL, NULL, 'Bogor', '-6.55178', '106.62913', 'Pakuan', '-6.63130', '106.82226', 15547500, 0, 'complete', '2018-04-07 17:30:34', '2018-04-08 02:44:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sewa_detail`
--

CREATE TABLE `sewa_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sewa_id` bigint(20) NOT NULL,
  `sewa_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Coupe', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21'),
(2, 'Hatcback', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21'),
(3, 'Minivan', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21'),
(4, 'Sedan', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21'),
(5, 'Sports Car', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21'),
(6, 'Sport Vehicle', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21'),
(7, 'Station Wagon', NULL, 0, '2018-03-29 05:26:21', '2018-03-29 05:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactived` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latestlogin` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isverified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `isactived`, `latestlogin`, `foto`, `uuid`, `remember_token`, `created_at`, `updated_at`, `isverified`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@example.com', '$2y$10$/lqrqey2J2HGk8Kl88CR7.XN44QeZ0/uogxznENvow5DS5JL.L7vG', '1', NULL, NULL, NULL, 'rfqsZub1rOf2FuYkGJQw4HdW4qSL2bvrYEuuBsg3fB9R4wy1Bnd4k648btvE', '2018-03-29 05:21:42', '2018-04-05 04:47:30', 1),
(2, 'Administrator', 'admin', 'admin@example.com', '$2y$10$aHmu28SCD7XM5T7CJ.WFlupteumZTgVnan8ajTjj.L.bZ.CiUXTUC', '1', NULL, NULL, NULL, 'wCARsiqDOKvm6m7DBFkgNLDY7woDqHFuBvXb5lCPqSGX9SX7Anit8jLswkPg', '2018-03-29 05:21:42', '2018-04-05 04:46:24', 1),
(3, 'Muhamad Anjar P', 'muhamadanjar', 'muhamadanjar37@gmail.com', '$2y$10$387EOdztbyj13gMitZWIjeF9KqY/zX8UKzhk7XmSWvsDmp2dLPAmS', '1', NULL, NULL, NULL, 'ySoIoesfeJOHNg44hAzznfvoZoWloR0uyAwnrIYJuEAReNczNHMaEqrK0Yrl', '2018-03-29 16:50:45', '2018-04-05 04:49:08', 1),
(10, 'Customer 5', 'customer5', 'customer5@gmail.com', '$2y$10$xso6Bbng34i2w1xzdDtjSO17vy7Fz0ERKHXTOOuw6kaji1nuwJPh2', '1', NULL, NULL, NULL, 'TyUBmdMkx7mht4hWda6eXWYhYdqMw8jD1tQK9atvhykuKqqtALKwjA4Qifcj', '2018-04-01 17:09:25', '2018-04-05 06:28:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` decimal(8,5) NOT NULL,
  `longitude` decimal(8,5) NOT NULL,
  `latest_update` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_desa`
--

CREATE TABLE `wilayah_desa` (
  `kode_desa` bigint(20) NOT NULL,
  `nama_desa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_kec` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_kabupaten`
--

CREATE TABLE `wilayah_kabupaten` (
  `kode_kab` bigint(20) NOT NULL,
  `nama_kabupaten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_prov` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_kecamatan`
--

CREATE TABLE `wilayah_kecamatan` (
  `kode_kec` bigint(20) NOT NULL,
  `nama_kecamatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_kab` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_provinsi`
--

CREATE TABLE `wilayah_provinsi` (
  `kode_prov` bigint(20) NOT NULL,
  `nama_provinsi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_author_id_foreign` (`author_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbstatus`
--
ALTER TABLE `fbstatus`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `hubungi`
--
ALTER TABLE `hubungi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_activities_subject_id_subject_type_index` (`subject_id`,`subject_type`),
  ADD KEY `log_activities_predicate_index` (`predicate`),
  ADD KEY `log_activities_object_id_object_type_index` (`object_id`,`object_type`);

--
-- Indexes for table `log_revisions`
--
ALTER TABLE `log_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`);

--
-- Indexes for table `log_sewa_status`
--
ALTER TABLE `log_sewa_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookups`
--
ALTER TABLE `lookups`
  ADD KEY `lookups_id_index` (`id`),
  ADD KEY `lookups_type_index` (`type`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_user_id_foreign` (`user_id`);

--
-- Indexes for table `mobil_fasilitas`
--
ALTER TABLE `mobil_fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_fasilitas_mobil_id_foreign` (`mobil_id`),
  ADD KEY `mobil_fasilitas_fasilitas_id_foreign` (`fasilitas_id`);

--
-- Indexes for table `newsletter_subscriptions`
--
ALTER TABLE `newsletter_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_subscriptions_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengumumam`
--
ALTER TABLE `pengumumam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_author_id_foreign` (`author_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewa_detail`
--
ALTER TABLE `sewa_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`hits`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_location`
--
ALTER TABLE `user_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `wilayah_desa`
--
ALTER TABLE `wilayah_desa`
  ADD PRIMARY KEY (`kode_desa`),
  ADD UNIQUE KEY `wilayah_desa_kode_desa_unique` (`kode_desa`);

--
-- Indexes for table `wilayah_kabupaten`
--
ALTER TABLE `wilayah_kabupaten`
  ADD PRIMARY KEY (`kode_kab`),
  ADD UNIQUE KEY `wilayah_kabupaten_kode_kab_unique` (`kode_kab`);

--
-- Indexes for table `wilayah_kecamatan`
--
ALTER TABLE `wilayah_kecamatan`
  ADD PRIMARY KEY (`kode_kec`),
  ADD UNIQUE KEY `wilayah_kecamatan_kode_kec_unique` (`kode_kec`);

--
-- Indexes for table `wilayah_provinsi`
--
ALTER TABLE `wilayah_provinsi`
  ADD PRIMARY KEY (`kode_prov`),
  ADD UNIQUE KEY `wilayah_provinsi_kode_prov_unique` (`kode_prov`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbstatus`
--
ALTER TABLE `fbstatus`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hubungi`
--
ALTER TABLE `hubungi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_revisions`
--
ALTER TABLE `log_revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log_sewa_status`
--
ALTER TABLE `log_sewa_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `mobil_fasilitas`
--
ALTER TABLE `mobil_fasilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter_subscriptions`
--
ALTER TABLE `newsletter_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengumumam`
--
ALTER TABLE `pengumumam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sewa_detail`
--
ALTER TABLE `sewa_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statistik`
--
ALTER TABLE `statistik`
  MODIFY `hits` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_location`
--
ALTER TABLE `user_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mobil_fasilitas`
--
ALTER TABLE `mobil_fasilitas`
  ADD CONSTRAINT `mobil_fasilitas_fasilitas_id_foreign` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`),
  ADD CONSTRAINT `mobil_fasilitas_mobil_id_foreign` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD CONSTRAINT `user_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
