-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 09:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `package_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 1, 'Jalan-jalan', '2023-07-31 13:08:32', '2023-07-31 13:08:32'),
(3, 1, 'Relasi ', '2023-07-31 13:08:32', '2023-07-31 13:08:32'),
(4, 1, 'Murah', '2023-07-31 13:08:32', '2023-07-31 13:08:32'),
(11, 2, 'Bali', '2023-08-31 09:15:32', '2023-08-31 09:15:32'),
(12, 2, 'Pantai', '2023-08-31 09:15:32', '2023-08-31 09:15:32'),
(13, 2, 'Indah', '2023-08-31 09:15:32', '2023-08-31 09:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `package_id`, `user_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
('BK0001', 1, 2, '2023-07-31', '2023-08-02', '2023-07-31 13:31:17', '2023-07-31 13:31:17'),
('BK0002', 1, 3, '2023-07-31', '2023-08-02', '2023-07-31 14:09:11', '2023-07-31 14:09:11'),
('BK0003', 1, 3, '2023-07-18', '2023-07-20', '2023-07-31 14:19:46', '2023-07-31 14:19:46'),
('BK0004', 1, 2, '2023-08-30', '2023-08-01', '2023-08-30 13:53:04', '2023-08-30 13:53:04'),
('BK0005', 1, 3, '2023-08-30', '2023-09-01', '2023-08-30 13:56:41', '2023-08-30 13:56:41'),
('BK0006', 2, 5, '2023-08-31', '2023-09-03', '2023-08-31 09:19:03', '2023-08-31 09:19:03'),
('BK0007', 1, 5, '2023-08-31', '2023-09-02', '2023-08-31 09:23:45', '2023-08-31 09:23:45'),
('BK0008', 1, 6, '2023-08-31', '2023-09-02', '2023-08-31 09:28:14', '2023-08-31 09:28:14'),
('BK0009', 2, 6, '2023-09-04', '2023-09-07', '2023-09-03 21:07:55', '2023-09-03 21:07:55'),
('BK0010', 1, 7, '2023-09-04', '2023-09-06', '2023-09-03 21:14:16', '2023-09-03 21:14:16'),
('BK0011', 1, 7, '2023-09-04', '2023-09-06', '2023-09-03 21:26:10', '2023-09-03 21:26:10'),
('BK0012', 2, 7, '2023-09-04', '2023-09-07', '2023-09-03 21:31:14', '2023-09-03 21:31:14'),
('BK0013', 2, 3, '2023-09-05', '2023-09-08', '2023-09-04 08:43:45', '2023-09-04 08:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `booking_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'BK0004', 2, '2023-08-30 13:53:11', '2023-08-30 13:53:11'),
(2, 'BK0005', 3, '2023-08-30 13:56:45', '2023-08-30 13:56:45'),
(3, 'BK0006', 5, '2023-08-31 09:19:08', '2023-08-31 09:19:08'),
(4, 'BK0007', 5, '2023-08-31 09:23:49', '2023-08-31 09:23:49'),
(5, 'BK0008', 6, '2023-08-31 09:28:19', '2023-08-31 09:28:19'),
(6, 'BK0009', 6, '2023-09-03 21:08:00', '2023-09-03 21:08:00'),
(7, 'BK0010', 7, '2023-09-03 21:14:27', '2023-09-03 21:14:27'),
(8, 'BK0011', 7, '2023-09-03 21:26:14', '2023-09-03 21:26:14'),
(9, 'BK0012', 7, '2023-09-03 21:31:19', '2023-09-03 21:31:19'),
(10, 'BK0013', 3, '2023-09-04 08:43:49', '2023-09-04 08:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path`, `package_id`, `created_at`, `updated_at`) VALUES
(1, 'C42mpFfK050ARoRALKqysHzbjeHDtMdzFyXgN7qv.jpg', 1, '2023-07-31 13:06:04', '2023-07-31 13:06:04'),
(2, 'XQZpN8tYyngEoX0rVrRfRpdPqmengdHX659qE8jZ.jpg', 1, '2023-07-31 13:06:04', '2023-07-31 13:06:04'),
(5, 'dAwrD65jLC1PVGQyYWtDM8IXjvzNJwYIJsw0081Q.jpg', 2, '2023-08-31 09:15:32', '2023-08-31 09:15:32'),
(6, 'q7z7TCaUOcr2cMOEYTZnAsjOJRvov2ZyXv2RRZNy.jpg', 2, '2023-08-31 09:15:32', '2023-08-31 09:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `indikators`
--

CREATE TABLE `indikators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_indikator` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `indikators`
--

INSERT INTO `indikators` (`id`, `kode_indikator`, `name`, `created_at`, `updated_at`) VALUES
(1, '001', 'Tangibles', NULL, NULL),
(2, '002', 'Reliability', NULL, NULL),
(3, '003', 'Responsive', NULL, NULL),
(4, '004', 'Assurance', NULL, NULL),
(5, '005', 'Emphaty', NULL, NULL),
(6, '006', 'Hasil', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(26, '2014_10_12_000000_create_users_table', 1),
(27, '2014_10_12_100000_create_password_resets_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2023_05_18_012528_create_permission_tables', 1),
(31, '2023_05_20_042907_create_packages_table', 1),
(32, '2023_05_20_042928_create_bookings_table', 1),
(33, '2023_05_20_042947_create_transactions_table', 1),
(34, '2023_05_20_054203_create_payments_table', 1),
(35, '2023_06_20_030848_create_benefits_table', 1),
(36, '2023_07_23_060718_create_images_table', 1),
(62, '2023_07_07_110949_create_contact_details_table', 2),
(63, '2023_08_08_144022_create_indikators_table', 2),
(64, '2023_08_08_144635_create_subindikators_table', 2),
(67, '2023_08_08_150019_create_ratings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 12,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `slug`, `location`, `price`, `duration`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Bandung Lautan Api', 'bandung-lautan-api', 'Bandung', '1500000.00', 2, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio dolorum tenetur fugiat eligendi. Fugit cum fugiat at ab error eveniet nulla laboriosam facilis commodi? Iusto consectetur ipsum consequuntur mollitia eaque veritatis aspernatur eum ipsa a placeat sequi ratione quam sint eligendi nulla nemo iste repellendus quidem nesciunt, totam officiis aliquam veniam necessitatibus quae. Commodi itaque impedit dolore quisquam maxime iusto. Vel, quos? Expedita voluptatum natus, aliquam dolores quisquam perspiciatis repellat culpa, eveniet laudantium animi debitis nulla ad praesentium porro rerum. A aliquid, veniam deserunt magni iure adipisci voluptates repudiandae maxime quae distinctio debitis ad dolorem earum et voluptas dolores optio.</p>', '2023-07-31 13:06:04', '2023-07-31 13:08:32'),
(2, 'Sweet Bali', 'sweet-bali', 'Bali', '3000000.00', 3, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro facilis illum itaque sequi, dolor iste maiores alias suscipit sunt fugit unde exercitationem, ex consectetur! Velit dolorum at, incidunt voluptas consectetur hic quibusdam neque perspiciatis illo omnis possimus iure officia debitis sapiente, magnam rem soluta eum? Perferendis quo voluptatum commodi? Culpa debitis exercitationem tempore expedita molestias in vero consequuntur sunt et alias obcaecati, aliquam voluptatibus unde inventore magnam quas fugiat perferendis aperiam accusantium commodi<br></p>', '2023-08-31 09:13:33', '2023-08-31 09:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name_bank`, `account_number`, `name_owner`, `created_at`, `updated_at`) VALUES
(1, 'BRI', '389272323211', 'CV Langkuy', NULL, NULL),
(2, 'BCA', '238239823', 'CV Langkuy', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `indikator_id` bigint(20) UNSIGNED NOT NULL,
  `subindikator_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `booking_id`, `package_id`, `user_id`, `indikator_id`, `subindikator_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'BK0004', 1, 2, 1, 1, 3, '2023-08-30 16:23:10', '2023-08-30 16:23:10'),
(2, 'BK0004', 1, 2, 1, 2, 4, '2023-08-30 16:23:12', '2023-08-30 16:23:12'),
(3, 'BK0004', 1, 2, 1, 3, 4, '2023-08-30 16:23:14', '2023-08-30 16:23:14'),
(4, 'BK0004', 1, 2, 2, 4, 4, '2023-08-30 16:23:15', '2023-08-30 16:23:15'),
(5, 'BK0004', 1, 2, 2, 5, 4, '2023-08-30 16:23:17', '2023-08-30 16:23:17'),
(6, 'BK0004', 1, 2, 2, 6, 4, '2023-08-30 16:23:19', '2023-08-30 16:23:19'),
(7, 'BK0004', 1, 2, 3, 7, 4, '2023-08-30 16:23:21', '2023-08-30 16:23:21'),
(8, 'BK0004', 1, 2, 3, 8, 4, '2023-08-30 16:23:27', '2023-08-30 16:23:27'),
(9, 'BK0004', 1, 2, 3, 9, 4, '2023-08-30 16:23:29', '2023-08-30 16:23:29'),
(10, 'BK0004', 1, 2, 4, 10, 4, '2023-08-30 16:23:31', '2023-08-30 16:23:31'),
(11, 'BK0004', 1, 2, 4, 11, 4, '2023-08-30 16:23:33', '2023-08-30 16:23:33'),
(12, 'BK0004', 1, 2, 4, 12, 4, '2023-08-30 16:23:35', '2023-08-30 16:23:35'),
(13, 'BK0004', 1, 2, 5, 13, 4, '2023-08-30 16:23:37', '2023-08-30 16:23:37'),
(14, 'BK0004', 1, 2, 5, 14, 4, '2023-08-30 16:23:39', '2023-08-30 16:23:39'),
(15, 'BK0004', 1, 2, 5, 15, 4, '2023-08-30 16:23:41', '2023-08-30 16:23:41'),
(16, 'BK0004', 1, 2, 6, 16, 2, '2023-08-30 16:23:44', '2023-08-30 16:23:44'),
(17, 'BK0001', 1, 2, 1, 1, 3, '2023-08-30 16:23:54', '2023-08-30 16:23:54'),
(18, 'BK0001', 1, 2, 1, 2, 3, '2023-08-30 16:23:56', '2023-08-30 16:23:56'),
(19, 'BK0001', 1, 2, 1, 3, 3, '2023-08-30 16:23:58', '2023-08-30 16:23:58'),
(20, 'BK0001', 1, 2, 2, 4, 4, '2023-08-30 16:24:02', '2023-08-30 16:24:02'),
(21, 'BK0001', 1, 2, 2, 5, 3, '2023-08-30 16:24:04', '2023-08-30 16:24:04'),
(22, 'BK0001', 1, 2, 2, 6, 4, '2023-08-30 16:24:06', '2023-08-30 16:24:06'),
(23, 'BK0001', 1, 2, 3, 7, 3, '2023-08-30 16:24:17', '2023-08-30 16:24:17'),
(24, 'BK0001', 1, 2, 3, 8, 4, '2023-08-30 16:24:19', '2023-08-30 16:24:19'),
(25, 'BK0001', 1, 2, 3, 9, 3, '2023-08-30 16:24:28', '2023-08-30 16:24:28'),
(26, 'BK0001', 1, 2, 4, 10, 3, '2023-08-30 16:24:35', '2023-08-30 16:24:35'),
(27, 'BK0001', 1, 2, 4, 11, 3, '2023-08-30 16:24:37', '2023-08-30 16:24:37'),
(28, 'BK0001', 1, 2, 4, 12, 3, '2023-08-30 16:24:39', '2023-08-30 16:24:39'),
(29, 'BK0001', 1, 2, 5, 13, 4, '2023-08-30 16:24:44', '2023-08-30 16:24:44'),
(30, 'BK0001', 1, 2, 5, 14, 4, '2023-08-30 16:24:46', '2023-08-30 16:24:46'),
(31, 'BK0001', 1, 2, 5, 15, 4, '2023-08-30 16:24:47', '2023-08-30 16:24:47'),
(32, 'BK0001', 1, 2, 6, 16, 1, '2023-08-30 16:24:50', '2023-08-30 16:24:50'),
(33, 'BK0003', 1, 3, 1, 1, 4, '2023-08-30 16:40:55', '2023-08-30 16:40:55'),
(34, 'BK0003', 1, 3, 1, 2, 4, '2023-08-30 16:40:57', '2023-08-30 16:40:57'),
(35, 'BK0003', 1, 3, 1, 3, 4, '2023-08-30 16:40:59', '2023-08-30 16:40:59'),
(36, 'BK0003', 1, 3, 2, 4, 4, '2023-08-30 16:41:01', '2023-08-30 16:41:01'),
(37, 'BK0003', 1, 3, 2, 5, 4, '2023-08-30 16:41:02', '2023-08-30 16:41:02'),
(38, 'BK0003', 1, 3, 2, 6, 4, '2023-08-30 16:41:04', '2023-08-30 16:41:04'),
(39, 'BK0003', 1, 3, 3, 7, 4, '2023-08-30 16:41:06', '2023-08-30 16:41:06'),
(40, 'BK0003', 1, 3, 3, 8, 4, '2023-08-30 16:41:08', '2023-08-30 16:41:08'),
(41, 'BK0003', 1, 3, 3, 9, 4, '2023-08-30 16:41:10', '2023-08-30 16:41:10'),
(42, 'BK0003', 1, 3, 4, 10, 4, '2023-08-30 16:41:12', '2023-08-30 16:41:12'),
(43, 'BK0003', 1, 3, 4, 11, 4, '2023-08-30 16:41:13', '2023-08-30 16:41:13'),
(44, 'BK0003', 1, 3, 4, 12, 4, '2023-08-30 16:41:15', '2023-08-30 16:41:15'),
(45, 'BK0003', 1, 3, 5, 13, 4, '2023-08-30 16:41:17', '2023-08-30 16:41:17'),
(46, 'BK0003', 1, 3, 5, 14, 4, '2023-08-30 16:41:19', '2023-08-30 16:41:19'),
(47, 'BK0003', 1, 3, 5, 15, 4, '2023-08-30 16:41:21', '2023-08-30 16:41:21'),
(48, 'BK0003', 1, 3, 6, 16, 2, '2023-08-30 16:41:24', '2023-08-30 16:41:24'),
(49, 'BK0006', 2, 5, 1, 1, 4, '2023-08-31 09:21:26', '2023-08-31 09:21:26'),
(50, 'BK0006', 2, 5, 1, 2, 4, '2023-08-31 09:21:28', '2023-08-31 09:21:28'),
(51, 'BK0006', 2, 5, 1, 3, 4, '2023-08-31 09:21:30', '2023-08-31 09:21:30'),
(52, 'BK0006', 2, 5, 2, 4, 4, '2023-08-31 09:21:32', '2023-08-31 09:21:32'),
(53, 'BK0006', 2, 5, 2, 5, 4, '2023-08-31 09:21:34', '2023-08-31 09:21:34'),
(54, 'BK0006', 2, 5, 2, 6, 4, '2023-08-31 09:21:36', '2023-08-31 09:21:36'),
(55, 'BK0006', 2, 5, 3, 7, 4, '2023-08-31 09:21:38', '2023-08-31 09:21:38'),
(56, 'BK0006', 2, 5, 3, 8, 4, '2023-08-31 09:21:41', '2023-08-31 09:21:41'),
(57, 'BK0006', 2, 5, 3, 9, 3, '2023-08-31 09:21:43', '2023-08-31 09:21:43'),
(58, 'BK0006', 2, 5, 4, 10, 4, '2023-08-31 09:21:45', '2023-08-31 09:21:45'),
(59, 'BK0006', 2, 5, 4, 11, 4, '2023-08-31 09:21:47', '2023-08-31 09:21:47'),
(60, 'BK0006', 2, 5, 4, 12, 4, '2023-08-31 09:21:48', '2023-08-31 09:21:48'),
(61, 'BK0006', 2, 5, 5, 13, 4, '2023-08-31 09:21:50', '2023-08-31 09:21:50'),
(62, 'BK0006', 2, 5, 5, 14, 4, '2023-08-31 09:21:52', '2023-08-31 09:21:52'),
(63, 'BK0006', 2, 5, 5, 15, 4, '2023-08-31 09:21:54', '2023-08-31 09:21:54'),
(64, 'BK0006', 2, 5, 6, 16, 2, '2023-08-31 09:21:56', '2023-08-31 09:21:56'),
(65, 'BK0007', 2, 5, 1, 1, 4, '2023-08-31 09:25:03', '2023-08-31 09:25:03'),
(66, 'BK0007', 2, 5, 1, 2, 4, '2023-08-31 09:25:05', '2023-08-31 09:25:05'),
(67, 'BK0007', 2, 5, 1, 3, 4, '2023-08-31 09:25:08', '2023-08-31 09:25:08'),
(68, 'BK0007', 2, 5, 2, 4, 4, '2023-08-31 09:25:09', '2023-08-31 09:25:09'),
(69, 'BK0007', 2, 5, 2, 5, 4, '2023-08-31 09:25:12', '2023-08-31 09:25:12'),
(70, 'BK0007', 2, 5, 2, 6, 4, '2023-08-31 09:25:15', '2023-08-31 09:25:15'),
(71, 'BK0007', 2, 5, 3, 7, 4, '2023-08-31 09:25:18', '2023-08-31 09:25:18'),
(72, 'BK0007', 2, 5, 3, 8, 4, '2023-08-31 09:25:20', '2023-08-31 09:25:20'),
(73, 'BK0007', 2, 5, 3, 9, 4, '2023-08-31 09:25:22', '2023-08-31 09:25:22'),
(74, 'BK0007', 2, 5, 4, 10, 4, '2023-08-31 09:25:24', '2023-08-31 09:25:24'),
(75, 'BK0007', 2, 5, 4, 11, 4, '2023-08-31 09:25:26', '2023-08-31 09:25:26'),
(76, 'BK0007', 2, 5, 4, 12, 4, '2023-08-31 09:25:28', '2023-08-31 09:25:28'),
(77, 'BK0007', 2, 5, 5, 13, 4, '2023-08-31 09:25:30', '2023-08-31 09:25:30'),
(78, 'BK0007', 2, 5, 5, 14, 4, '2023-08-31 09:25:32', '2023-08-31 09:25:32'),
(79, 'BK0007', 2, 5, 5, 15, 4, '2023-08-31 09:25:34', '2023-08-31 09:25:34'),
(80, 'BK0007', 2, 5, 6, 16, 2, '2023-08-31 09:25:36', '2023-08-31 09:25:36'),
(81, 'BK0008', 1, 6, 1, 1, 4, '2023-08-31 09:29:20', '2023-08-31 09:29:20'),
(82, 'BK0008', 1, 6, 1, 2, 4, '2023-08-31 09:29:22', '2023-08-31 09:29:22'),
(83, 'BK0008', 1, 6, 1, 3, 4, '2023-08-31 09:29:36', '2023-08-31 09:29:36'),
(84, 'BK0008', 1, 6, 2, 4, 4, '2023-08-31 09:29:38', '2023-08-31 09:29:38'),
(85, 'BK0008', 1, 6, 2, 5, 4, '2023-08-31 09:29:40', '2023-08-31 09:29:40'),
(86, 'BK0008', 1, 6, 2, 6, 4, '2023-08-31 09:29:43', '2023-08-31 09:29:43'),
(87, 'BK0008', 1, 6, 3, 7, 4, '2023-08-31 09:29:45', '2023-08-31 09:29:45'),
(88, 'BK0008', 1, 6, 3, 8, 4, '2023-08-31 09:29:46', '2023-08-31 09:29:46'),
(89, 'BK0008', 1, 6, 3, 9, 4, '2023-08-31 09:29:48', '2023-08-31 09:29:48'),
(90, 'BK0008', 1, 6, 4, 10, 4, '2023-08-31 09:29:50', '2023-08-31 09:29:50'),
(91, 'BK0008', 1, 6, 4, 11, 4, '2023-08-31 09:29:52', '2023-08-31 09:29:52'),
(92, 'BK0008', 1, 6, 4, 12, 4, '2023-08-31 09:29:54', '2023-08-31 09:29:54'),
(93, 'BK0008', 1, 6, 5, 13, 4, '2023-08-31 09:29:56', '2023-08-31 09:29:56'),
(94, 'BK0008', 1, 6, 5, 14, 4, '2023-08-31 09:29:58', '2023-08-31 09:29:58'),
(95, 'BK0008', 1, 6, 5, 15, 4, '2023-08-31 09:30:00', '2023-08-31 09:30:00'),
(96, 'BK0008', 1, 6, 6, 16, 2, '2023-08-31 09:30:02', '2023-08-31 09:30:02'),
(97, 'BK0009', 1, 6, 1, 1, 3, '2023-09-03 21:10:39', '2023-09-03 21:10:39'),
(98, 'BK0009', 1, 6, 1, 2, 4, '2023-09-03 21:10:42', '2023-09-03 21:10:42'),
(99, 'BK0009', 1, 6, 1, 3, 4, '2023-09-03 21:10:44', '2023-09-03 21:10:44'),
(100, 'BK0009', 1, 6, 2, 4, 3, '2023-09-03 21:10:50', '2023-09-03 21:10:50'),
(101, 'BK0009', 1, 6, 2, 5, 3, '2023-09-03 21:10:52', '2023-09-03 21:10:52'),
(102, 'BK0009', 1, 6, 2, 6, 4, '2023-09-03 21:10:55', '2023-09-03 21:10:55'),
(103, 'BK0009', 1, 6, 3, 7, 4, '2023-09-03 21:11:00', '2023-09-03 21:11:00'),
(104, 'BK0009', 1, 6, 3, 8, 3, '2023-09-03 21:11:02', '2023-09-03 21:11:02'),
(105, 'BK0009', 1, 6, 3, 9, 3, '2023-09-03 21:11:04', '2023-09-03 21:11:04'),
(106, 'BK0009', 1, 6, 4, 10, 3, '2023-09-03 21:11:09', '2023-09-03 21:11:09'),
(107, 'BK0009', 1, 6, 4, 11, 3, '2023-09-03 21:11:12', '2023-09-03 21:11:12'),
(108, 'BK0009', 1, 6, 4, 12, 4, '2023-09-03 21:11:14', '2023-09-03 21:11:14'),
(109, 'BK0009', 1, 6, 5, 13, 4, '2023-09-03 21:11:20', '2023-09-03 21:11:20'),
(110, 'BK0009', 1, 6, 5, 14, 3, '2023-09-03 21:11:22', '2023-09-03 21:11:22'),
(111, 'BK0009', 1, 6, 5, 15, 3, '2023-09-03 21:11:24', '2023-09-03 21:11:24'),
(112, 'BK0009', 1, 6, 6, 16, 1, '2023-09-03 21:11:40', '2023-09-03 21:11:40'),
(113, 'BK0010', 1, 7, 1, 1, 4, '2023-09-03 21:15:32', '2023-09-03 21:15:32'),
(114, 'BK0010', 1, 7, 1, 2, 4, '2023-09-03 21:15:34', '2023-09-03 21:15:34'),
(115, 'BK0010', 1, 7, 1, 3, 4, '2023-09-03 21:15:37', '2023-09-03 21:15:37'),
(116, 'BK0010', 1, 7, 2, 4, 3, '2023-09-03 21:15:42', '2023-09-03 21:15:42'),
(117, 'BK0010', 1, 7, 2, 5, 3, '2023-09-03 21:15:48', '2023-09-03 21:15:48'),
(118, 'BK0010', 1, 7, 2, 6, 3, '2023-09-03 21:15:53', '2023-09-03 21:15:53'),
(119, 'BK0010', 1, 7, 3, 7, 3, '2023-09-03 21:15:59', '2023-09-03 21:15:59'),
(120, 'BK0010', 1, 7, 3, 8, 3, '2023-09-03 21:16:01', '2023-09-03 21:16:01'),
(121, 'BK0010', 1, 7, 3, 9, 4, '2023-09-03 21:16:03', '2023-09-03 21:16:03'),
(122, 'BK0010', 1, 7, 4, 10, 4, '2023-09-03 21:16:07', '2023-09-03 21:16:07'),
(123, 'BK0010', 1, 7, 4, 11, 4, '2023-09-03 21:16:09', '2023-09-03 21:16:09'),
(124, 'BK0010', 1, 7, 4, 12, 4, '2023-09-03 21:16:11', '2023-09-03 21:16:11'),
(125, 'BK0010', 1, 7, 5, 13, 4, '2023-09-03 21:16:17', '2023-09-03 21:16:17'),
(126, 'BK0010', 1, 7, 5, 14, 4, '2023-09-03 21:16:19', '2023-09-03 21:16:19'),
(127, 'BK0010', 1, 7, 5, 15, 4, '2023-09-03 21:16:21', '2023-09-03 21:16:21'),
(128, 'BK0010', 1, 7, 6, 16, 2, '2023-09-03 21:16:27', '2023-09-03 21:16:27'),
(129, 'BK0011', 1, 7, 1, 1, 3, '2023-09-03 21:27:31', '2023-09-03 21:27:31'),
(130, 'BK0011', 1, 7, 1, 2, 5, '2023-09-03 21:27:34', '2023-09-03 21:27:34'),
(131, 'BK0011', 1, 7, 1, 3, 4, '2023-09-03 21:27:51', '2023-09-03 21:27:51'),
(132, 'BK0011', 1, 7, 2, 4, 4, '2023-09-03 21:27:57', '2023-09-03 21:27:57'),
(133, 'BK0011', 1, 7, 2, 5, 4, '2023-09-03 21:27:58', '2023-09-03 21:27:58'),
(134, 'BK0011', 1, 7, 2, 6, 4, '2023-09-03 21:28:01', '2023-09-03 21:28:01'),
(135, 'BK0011', 1, 7, 3, 7, 4, '2023-09-03 21:28:05', '2023-09-03 21:28:05'),
(136, 'BK0011', 1, 7, 3, 8, 4, '2023-09-03 21:28:08', '2023-09-03 21:28:08'),
(137, 'BK0011', 1, 7, 3, 9, 4, '2023-09-03 21:28:10', '2023-09-03 21:28:10'),
(138, 'BK0011', 1, 7, 4, 10, 4, '2023-09-03 21:28:15', '2023-09-03 21:28:15'),
(139, 'BK0011', 1, 7, 4, 11, 3, '2023-09-03 21:28:18', '2023-09-03 21:28:18'),
(140, 'BK0011', 1, 7, 4, 12, 4, '2023-09-03 21:28:20', '2023-09-03 21:28:20'),
(141, 'BK0011', 1, 7, 5, 13, 4, '2023-09-03 21:28:25', '2023-09-03 21:28:25'),
(142, 'BK0011', 1, 7, 5, 14, 4, '2023-09-03 21:28:27', '2023-09-03 21:28:27'),
(143, 'BK0011', 1, 7, 5, 15, 4, '2023-09-03 21:28:31', '2023-09-03 21:28:31'),
(144, 'BK0011', 1, 7, 6, 16, 2, '2023-09-03 21:28:36', '2023-09-03 21:28:36'),
(145, 'BK0012', 1, 7, 1, 1, 4, '2023-09-03 21:32:09', '2023-09-03 21:32:09'),
(146, 'BK0012', 1, 7, 1, 2, 4, '2023-09-03 21:32:11', '2023-09-03 21:32:11'),
(147, 'BK0012', 1, 7, 1, 3, 5, '2023-09-03 21:32:14', '2023-09-03 21:32:14'),
(148, 'BK0012', 1, 7, 2, 4, 5, '2023-09-03 21:32:20', '2023-09-03 21:32:20'),
(149, 'BK0012', 1, 7, 2, 5, 3, '2023-09-03 21:32:22', '2023-09-03 21:32:22'),
(150, 'BK0012', 1, 7, 2, 6, 3, '2023-09-03 21:32:24', '2023-09-03 21:32:24'),
(151, 'BK0012', 1, 7, 3, 7, 3, '2023-09-03 21:32:30', '2023-09-03 21:32:30'),
(152, 'BK0012', 1, 7, 3, 8, 4, '2023-09-03 21:32:32', '2023-09-03 21:32:32'),
(153, 'BK0012', 1, 7, 3, 9, 4, '2023-09-03 21:32:33', '2023-09-03 21:32:33'),
(154, 'BK0012', 1, 7, 4, 10, 3, '2023-09-03 21:32:40', '2023-09-03 21:32:40'),
(155, 'BK0012', 1, 7, 4, 11, 4, '2023-09-03 21:32:42', '2023-09-03 21:32:42'),
(156, 'BK0012', 1, 7, 4, 12, 4, '2023-09-03 21:32:44', '2023-09-03 21:32:44'),
(157, 'BK0012', 1, 7, 5, 13, 3, '2023-09-03 21:33:00', '2023-09-03 21:33:00'),
(158, 'BK0012', 1, 7, 5, 14, 4, '2023-09-03 21:33:02', '2023-09-03 21:33:02'),
(159, 'BK0012', 1, 7, 5, 15, 4, '2023-09-03 21:33:05', '2023-09-03 21:33:05'),
(160, 'BK0012', 1, 7, 6, 16, 2, '2023-09-03 21:33:10', '2023-09-03 21:33:10'),
(161, 'BK0005', 1, 3, 1, 1, 4, '2023-09-04 08:44:49', '2023-09-04 08:44:49'),
(162, 'BK0005', 1, 3, 1, 2, 4, '2023-09-04 08:44:51', '2023-09-04 08:44:51'),
(163, 'BK0005', 1, 3, 1, 3, 5, '2023-09-04 08:44:53', '2023-09-04 08:44:53'),
(164, 'BK0005', 1, 3, 2, 4, 5, '2023-09-04 08:44:58', '2023-09-04 08:44:58'),
(165, 'BK0005', 1, 3, 2, 5, 3, '2023-09-04 08:45:00', '2023-09-04 08:45:00'),
(166, 'BK0005', 1, 3, 2, 6, 3, '2023-09-04 08:45:02', '2023-09-04 08:45:02'),
(167, 'BK0005', 1, 3, 3, 7, 3, '2023-09-04 08:45:07', '2023-09-04 08:45:07'),
(168, 'BK0005', 1, 3, 3, 8, 4, '2023-09-04 08:45:09', '2023-09-04 08:45:09'),
(169, 'BK0005', 1, 3, 3, 9, 4, '2023-09-04 08:45:12', '2023-09-04 08:45:12'),
(170, 'BK0005', 1, 3, 4, 10, 3, '2023-09-04 08:45:22', '2023-09-04 08:45:22'),
(171, 'BK0005', 1, 3, 4, 11, 4, '2023-09-04 08:45:24', '2023-09-04 08:45:24'),
(172, 'BK0005', 1, 3, 4, 12, 4, '2023-09-04 08:45:26', '2023-09-04 08:45:26'),
(173, 'BK0005', 1, 3, 5, 13, 3, '2023-09-04 08:45:28', '2023-09-04 08:45:28'),
(174, 'BK0005', 1, 3, 5, 14, 4, '2023-09-04 08:45:30', '2023-09-04 08:45:30'),
(175, 'BK0005', 1, 3, 5, 15, 4, '2023-09-04 08:45:32', '2023-09-04 08:45:32'),
(176, 'BK0005', 1, 3, 6, 16, 2, '2023-09-04 08:45:38', '2023-09-04 08:45:38'),
(177, 'BK0013', 1, 3, 1, 1, 3, '2023-09-04 08:45:50', '2023-09-04 08:45:50'),
(178, 'BK0013', 1, 3, 1, 2, 4, '2023-09-04 08:45:52', '2023-09-04 08:45:52'),
(179, 'BK0013', 1, 3, 1, 3, 3, '2023-09-04 08:45:54', '2023-09-04 08:45:54'),
(180, 'BK0013', 1, 3, 2, 4, 3, '2023-09-04 08:46:00', '2023-09-04 08:46:00'),
(181, 'BK0013', 1, 3, 2, 5, 4, '2023-09-04 08:46:03', '2023-09-04 08:46:03'),
(182, 'BK0013', 1, 3, 2, 6, 4, '2023-09-04 08:46:05', '2023-09-04 08:46:05'),
(183, 'BK0013', 1, 3, 3, 7, 4, '2023-09-04 08:46:11', '2023-09-04 08:46:11'),
(184, 'BK0013', 1, 3, 3, 8, 3, '2023-09-04 08:46:13', '2023-09-04 08:46:13'),
(185, 'BK0013', 1, 3, 3, 9, 4, '2023-09-04 08:46:15', '2023-09-04 08:46:15'),
(186, 'BK0013', 1, 3, 4, 10, 4, '2023-09-04 08:46:22', '2023-09-04 08:46:22'),
(187, 'BK0013', 1, 3, 4, 11, 4, '2023-09-04 08:46:24', '2023-09-04 08:46:24'),
(188, 'BK0013', 1, 3, 4, 12, 4, '2023-09-04 08:46:26', '2023-09-04 08:46:26'),
(189, 'BK0013', 1, 3, 5, 13, 3, '2023-09-04 08:46:31', '2023-09-04 08:46:31'),
(190, 'BK0013', 1, 3, 5, 14, 4, '2023-09-04 08:46:33', '2023-09-04 08:46:33'),
(191, 'BK0013', 1, 3, 5, 15, 4, '2023-09-04 08:46:35', '2023-09-04 08:46:35'),
(192, 'BK0013', 1, 3, 6, 16, 2, '2023-09-04 08:46:40', '2023-09-04 08:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2023-07-31 13:05:27', '2023-07-31 13:05:27'),
(2, 'admin', 'web', '2023-07-31 13:05:27', '2023-07-31 13:05:27'),
(3, 'user', 'web', '2023-07-31 13:05:27', '2023-07-31 13:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subindikators`
--

CREATE TABLE `subindikators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_subindikator` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indikator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subindikators`
--

INSERT INTO `subindikators` (`id`, `kode_subindikator`, `name`, `indikator_id`, `created_at`, `updated_at`) VALUES
(1, '001', 'Ketersediaan fasilitas dan informasi yang diberikan', 1, NULL, NULL),
(2, '002', 'Penampilan Crew Langkuy yang bersih dan rapih', 1, NULL, NULL),
(3, '003', 'Perlengkapan dalam memudahkan pelayanan', 1, NULL, NULL),
(4, '004', 'Kemudahan prosedur dalam memberikan pelayanan', 2, NULL, NULL),
(5, '005', 'Kemudahan memberikan informasi kepada pelanggan', 2, NULL, NULL),
(6, '006', 'Crew Langkuy bekerja dengan baik dan memenuhi kebutuhan pelanggan', 2, NULL, NULL),
(7, '007', 'Ketepatan waktu dan kedisiplinan Crew Langkuy', 3, NULL, NULL),
(8, '008', 'Rasa tanggungjawas atas pekerjaan Crew Langkuy', 3, NULL, NULL),
(9, '009', 'Kesediaan Crew Langkuy untuk membantu pelanggan', 3, NULL, NULL),
(10, '0010', 'Kesopanan, Keramahan serta Komunikasi yang baik dalam memberikan pelayanan', 4, NULL, NULL),
(11, '0011', 'Kejaminan fasilitas yang diberikan', 4, NULL, NULL),
(12, '0012', 'Crew Langkuy memiliki pengetahuan luas tentang destinasi wisata', 4, NULL, NULL),
(13, '0013', 'Keramahan Crew Langkuy terhadap pelanggan', 5, NULL, NULL),
(14, '0014', 'Ketersediaan waktu Crew Langkuy dalam mendengar keluhan pelanggan', 5, NULL, NULL),
(15, '0015', 'Crew Langkuy dapat berkomunikasi dengan baik', 5, NULL, NULL),
(16, '0016', 'Apakah anda puas dengan pelayanan kami', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_evidence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(11,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `booking_id`, `name_bank`, `photo_evidence`, `total`, `status`, `expired_at`, `created_at`, `updated_at`) VALUES
('INV0001', 'BK0001', 'BCA', 'gR9tng3sG6Ou7EAiAQptN9lTaiKasXekj1a65DZ7.jpg', '1500000.00', 'success', '2023-07-31 13:51:35', '2023-07-31 13:35:21', '2023-07-31 13:51:35'),
('INV0002', 'BK0002', 'BRI', '3VjObhR4aX6n75goNIw25vWXAKgYoM6uGj46W3cF.jpg', '1500000.00', 'failed', '2023-07-31 14:13:19', '2023-07-31 14:09:28', '2023-07-31 14:13:19'),
('INV0003', 'BK0003', 'BCA', 'iKzKjAtl4U4gLgx8IEedUMBamw2WZe5K5uI73O1W.jpg', '1500000.00', 'success', '2023-08-29 06:20:40', '2023-07-31 14:22:10', '2023-08-29 06:20:40'),
('INV0004', 'BK0004', 'BCA', 'rUQgc1wwNacSl6hZPsqdeRkcQHM0NCqaCUJDUN4Z.jpg', '1500000.00', 'success', '2023-08-30 13:54:13', '2023-08-30 13:53:18', '2023-08-30 13:54:13'),
('INV0005', 'BK0005', 'BCA', 'mGTSm08MrQaBxrCrNLl8JPkXDsHgfvrZ8s2kRnSI.jpg', '1500000.00', 'success', '2023-08-30 13:57:16', '2023-08-30 13:56:49', '2023-08-30 13:57:16'),
('INV0006', 'BK0006', 'BCA', 'b6LA6FQq72on13AF2EHXnQ7mamMUq4RPnLTv7HNY.png', '3000000.00', 'success', '2023-08-31 09:19:50', '2023-08-31 09:19:13', '2023-08-31 09:19:50'),
('INV0007', 'BK0007', 'BCA', 'araQXqRpDDFj5g1YyZFInEdD6q0Q0QQhgmGYKUYZ.png', '1500000.00', 'success', '2023-08-31 09:24:25', '2023-08-31 09:23:53', '2023-08-31 09:24:25'),
('INV0008', 'BK0008', 'BCA', 'YcM7c9nQn9nUsFzDip4yqTQRrxeU1jEffrGvTfAO.png', '1500000.00', 'success', '2023-08-31 09:28:53', '2023-08-31 09:28:23', '2023-08-31 09:28:53'),
('INV0009', 'BK0009', 'BCA', 'Lf7l6TXEXgd0foE2DVmhfRrJ7yHZBPzvE6nlMkoS.jpg', '3000000.00', 'success', '2023-09-03 21:08:56', '2023-09-03 21:08:14', '2023-09-03 21:08:56'),
('INV0010', 'BK0010', 'BCA', 'AsGryc4FYNj4zj6JaeECLNa6GeN6KnADg5tGNGa4.png', '1500000.00', 'success', '2023-09-03 21:15:00', '2023-09-03 21:14:32', '2023-09-03 21:15:00'),
('INV0011', 'BK0011', 'BCA', 'SAkpPiUExnlSxpvdjhPwlQyHAUtkT1Jgu3MGWBFl.jpg', '1500000.00', 'success', '2023-09-03 21:26:57', '2023-09-03 21:26:20', '2023-09-03 21:26:57'),
('INV0012', 'BK0012', 'BCA', 'TfIY3YsJU2u9ByN9HlHptpbkByXAxxfBTnBpmm0t.jpg', '3000000.00', 'success', '2023-09-03 21:31:46', '2023-09-03 21:31:23', '2023-09-03 21:31:46'),
('INV0013', 'BK0013', 'BCA', 'DWbK4KYwGXISS6X891RfL4PS6yJDtbBBvTmnLIqb.png', '3000000.00', 'success', '2023-09-04 08:44:18', '2023-09-04 08:43:52', '2023-09-04 08:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default/user.png',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `username`, `no_hp`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'default/user.png', 'Admin', 'admin', '083123456789', 'admin@gmail.com', '2023-07-31 13:05:27', '$2y$10$FqSZsRR92Jr9xKwBt/kUAOigx4SYfvG21NPCaR8poIAHjW/b9twnm', NULL, '2023-07-31 13:05:28', '2023-07-31 13:05:28'),
(2, 'default/user.png', 'User 1', 'user', '083123456789', 'user@gmail.com', '2023-07-31 13:05:28', '$2y$10$87rP7bBX0nFdVMdhVFUE2OoxzT6W5UKcX0bnZCuoZBFTdzJZMjWBq', NULL, '2023-07-31 13:05:28', '2023-07-31 14:45:59'),
(3, 'default/user.png', 'Pelanggan 1', 'pelanggan1', '08522588524', 'pelanggan1@gmail.com', NULL, '$2y$10$87rP7bBX0nFdVMdhVFUE2OoxzT6W5UKcX0bnZCuoZBFTdzJZMjWBq', NULL, '2023-07-31 14:07:49', '2023-08-08 20:50:17'),
(5, 'default/user.png', 'Pelanggan 2', 'pelanggan2', '08523698741', 'pelanggan2@gmail.com', NULL, '$2y$10$87rP7bBX0nFdVMdhVFUE2OoxzT6W5UKcX0bnZCuoZBFTdzJZMjWBq', NULL, '2023-08-08 20:50:58', '2023-08-08 20:50:58'),
(6, 'default/user.png', 'Pelanggan 3', 'pelanggan3', '085258214785', 'pelanggan3@gmail.com', NULL, '$2y$10$87rP7bBX0nFdVMdhVFUE2OoxzT6W5UKcX0bnZCuoZBFTdzJZMjWBq', NULL, '2023-08-08 20:51:37', '2023-08-08 20:51:37'),
(7, 'default/user.png', 'Pelanggan 4', 'pelanggan4', '085214789632', 'pelanggan4@gmail.com', NULL, '$2y$10$87rP7bBX0nFdVMdhVFUE2OoxzT6W5UKcX0bnZCuoZBFTdzJZMjWBq', NULL, '2023-08-08 20:52:30', '2023-08-08 20:52:30'),
(8, 'default/user.png', 'Pelanggan 5', 'pelanggan5', '08963214789', 'pelanggan5@gmail.com', NULL, '$2y$10$qT5eAxwItBCwP5/Mc7/Q5.3yNXi1PPK/Hli5zwOcEdQ0bcftJHMWm$2y$10$87rP7bBX0nFdVMdhVFUE2OoxzT6W5UKcX0bnZCuoZBFTdzJZMjWBq', NULL, '2023-08-08 20:53:13', '2023-08-08 20:53:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benefits_package_id_foreign` (`package_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_package_id_foreign` (`package_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_details_booking_id_foreign` (`booking_id`),
  ADD KEY `contact_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_package_id_foreign` (`package_id`);

--
-- Indexes for table `indikators`
--
ALTER TABLE `indikators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indikators_kode_indikator_unique` (`kode_indikator`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_booking_id_foreign` (`booking_id`),
  ADD KEY `ratings_package_id_foreign` (`package_id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_indikator_id_foreign` (`indikator_id`),
  ADD KEY `ratings_subindikator_id_foreign` (`subindikator_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `subindikators`
--
ALTER TABLE `subindikators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subindikators_kode_subindikator_unique` (`kode_subindikator`),
  ADD KEY `subindikators_indikator_id_foreign` (`indikator_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indikators`
--
ALTER TABLE `indikators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subindikators`
--
ALTER TABLE `subindikators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benefits`
--
ALTER TABLE `benefits`
  ADD CONSTRAINT `benefits_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_indikator_id_foreign` FOREIGN KEY (`indikator_id`) REFERENCES `indikators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_subindikator_id_foreign` FOREIGN KEY (`subindikator_id`) REFERENCES `subindikators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subindikators`
--
ALTER TABLE `subindikators`
  ADD CONSTRAINT `subindikators_indikator_id_foreign` FOREIGN KEY (`indikator_id`) REFERENCES `indikators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
