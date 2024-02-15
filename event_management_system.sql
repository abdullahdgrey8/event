-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 13, 2024 at 10:32 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_candidates`
--

DROP TABLE IF EXISTS `tbl_candidates`;
CREATE TABLE IF NOT EXISTS `tbl_candidates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_candidates`
--

INSERT INTO `tbl_candidates` (`id`, `event_id`, `first_name`, `last_name`, `email`, `category`, `city`, `state`, `zip`, `country`, `resume`, `created_at`, `updated_at`) VALUES
(1, 'qB20i5OTD3', 'John', 'Doe', 'john.doe@example.com', 'Engineering', 'New York', 'NY', '10001', 'USA', 'resume1.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(2, 't0nzTD6oTF', 'Alice', 'Smith', 'alice.smith@example.com', 'Marketing', 'Los Angeles', 'CA', '90001', 'USA', 'resume2.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(3, 'd155kz2tvi', 'Michael', 'Johnson', 'michael.johnson@example.com', 'Finance', 'Chicago', 'IL', '60601', 'USA', 'resume3.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(4, 'LIRKDSvrBY', 'Emily', 'Brown', 'emily.brown@example.com', 'Engineering', 'San Francisco', 'CA', '94101', 'USA', 'resume4.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(5, 't0nzTD6oTF', 'Daniel', 'Martinez', 'daniel.martinez@example.com', 'Marketing', 'Houston', 'TX', '77001', 'USA', 'resume5.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(6, 'd155kz2tvi', 'Sophia', 'Taylor', 'sophia.taylor@example.com', 'Finance', 'Miami', 'FL', '33101', 'USA', 'resume6.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(7, 'LIRKDSvrBY', 'James', 'Anderson', 'james.anderson@example.com', 'Engineering', 'Seattle', 'WA', '98101', 'USA', 'resume7.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(8, 't0nzTD6oTF', 'Olivia', 'Lee', 'olivia.lee@example.com', 'Marketing', 'Boston', 'MA', '02101', 'USA', 'resume8.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(9, 'd155kz2tvi', 'David', 'Garcia', 'david.garcia@example.com', 'Finance', 'Atlanta', 'GA', '30301', 'USA', 'resume9.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45'),
(10, 'LIRKDSvrBY', 'Emma', 'Clark', 'emma.clark@example.com', 'Engineering', 'Dallas', 'TX', '75201', 'USA', 'resume10.pdf', '2024-02-12 07:07:45', '2024-02-12 07:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

DROP TABLE IF EXISTS `tbl_events`;
CREATE TABLE IF NOT EXISTS `tbl_events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `event_name`, `start_date`, `end_date`, `user_id`, `description`, `event_code`, `status`, `url`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'gcu faisalabad 2', '2024-02-06', '2024-02-23', 1, 'asasa', 'sasa', 1, 'https://thetowertech.com/', 'gcu-faisalabad-2', '2024-02-06 12:13:13', '2024-02-09 05:36:52'),
(2, 'asaasa', '2024-02-06', '2024-02-23', 1, 'asasasas', 'sasa', 0, 'https://www.google.com/', 'google', '2024-02-06 12:13:13', '2024-02-06 12:13:13'),
(3, 'gcu job fair', '2024-02-17', '2024-02-28', 1, 'job fair', 'LIRKDSvrBY', 0, 'https://techvblogs.com/blog/generate-qr-code-laravel-8', 'towerch', '2024-02-08 23:54:35', '2024-02-09 05:29:09'),
(4, 'gcu job fair 1', '2024-02-15', '2024-02-29', 1, 'job fair', 't0nzTD6oTF', 0, NULL, 'gcu-job-fair-1', '2024-02-09 05:29:58', '2024-02-09 05:29:58'),
(5, 'gcu faisalabad 1', '2024-02-13', '2024-02-17', 1, 'job fair', 'd155kz2tvi', 1, NULL, 'gcu-faisalabad-1', '2024-02-09 05:36:17', '2024-02-09 05:36:17'),
(6, 'gcu faisalabad 3', '2024-02-13', '2024-02-29', 1, 'job fair', 'SCUa8r6pFN', 1, NULL, 'gcu-faisalabad-3', '2024-02-09 05:40:23', '2024-02-09 05:40:23'),
(7, 'gcu faisalabad 4', '2024-02-26', '2024-02-29', 1, 'job fair', 'qB20i5OTD3', 1, NULL, 'gcu-faisalabad-4', '2024-02-12 00:57:07', '2024-02-12 01:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_failed_jobs`
--

DROP TABLE IF EXISTS `tbl_failed_jobs`;
CREATE TABLE IF NOT EXISTS `tbl_failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migrations`
--

DROP TABLE IF EXISTS `tbl_migrations`;
CREATE TABLE IF NOT EXISTS `tbl_migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_migrations`
--

INSERT INTO `tbl_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_01_052206_create_events', 1),
(6, '2024_02_01_053016_create_candidates', 1),
(7, '2024_02_06_101130_event_fields', 2),
(8, '2024_02_06_112237_event_fields', 3),
(9, '2024_02_07_091550_admin_api_fields', 3),
(10, '2024_02_07_093242_categories', 3),
(11, '2024_02_12_052537_add_category_to_candidates_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset_tokens`
--

DROP TABLE IF EXISTS `tbl_password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `tbl_password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personal_access_tokens`
--

DROP TABLE IF EXISTS `tbl_personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `tbl_personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_personal_access_tokens_token_unique` (`token`),
  KEY `tbl_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `is_admin`, `api_key`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abdullah khalid', 0, NULL, 'zk2880669@gmail.com', NULL, '$2y$12$08DRxaoyJXDq.Kk3R4OND.mh4VIYrId7rcH5Q1jv/4kbapKZ.NlD6', 'ihVBoPipoLkjk96LX8VzNBJ1HBlvFIa8NKkH4XUXXS1VryNlQpr5Vwnh6baU', '2024-02-01 00:37:05', '2024-02-01 00:37:05'),
(2, 'admin', 1, 'csnuf3434gd3434fisduifgsuid', 'azeemaslamhh@gamil.com', '2024-02-12 00:26:46', '$2y$12$F8NXfxe1uPRkTjN34rbJ6uFHU.We/8Xn5hed7aYihJR0qdVxTkFtC', NULL, '2024-02-12 00:26:46', '2024-02-12 00:26:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
