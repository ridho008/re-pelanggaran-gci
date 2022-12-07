-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2022 at 03:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `re-pelanggaran-gci`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2022_09_20_093400_create_types_violations_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2014_10_12_100000_create_password_resets_table', 2),
(8, '2019_08_19_000000_create_failed_jobs_table', 2),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reporting` bigint(20) UNSIGNED DEFAULT NULL,
  `types_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `proof_fhoto` varchar(255) DEFAULT NULL,
  `reply_comment` text DEFAULT NULL,
  `reporting_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `reporting`, `types_id`, `title`, `description`, `proof_fhoto`, `reply_comment`, `reporting_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 4, 1, 'Mr. Gerson Ritchie I', 'Anna Kunde', 'Tomas Miller', '<p>mencoba</p>', '2022-11-01', 0, '2022-12-06 02:26:18', '2022-12-06 02:33:31'),
(2, 6, 5, 4, 'Lily Shanahan II', 'Godfrey O\'Reilly', 'Doris McKenzie', 'Dr. Jayden Windler', '2022-11-02', 1, '2022-12-06 02:26:18', '2022-12-06 02:41:00'),
(3, 6, 3, 1, 'Jeromy Mills PhD', 'Lottie Fadel', 'Aniyah Feil', 'Dan Hoeger', '2022-11-03', 2, '2022-12-06 02:26:18', '2022-12-06 02:26:18'),
(4, 7, 4, 1, 'Edgardo Doyle', 'Ms. Earlene Weimann Jr.', 'Jayne Wunsch', 'Yesenia Ebert', '2022-11-04', 1, '2022-12-06 02:26:18', '2022-12-06 02:26:18'),
(5, 2, 6, 2, 'Abner Schultz', 'Cordia Franecki', 'Lilla Medhurst', 'Fredrick Armstrong', '2022-11-05', 1, '2022-12-06 02:26:18', '2022-12-06 02:26:18'),
(6, 7, 3, 2, 'Marion Conroy', 'Meredith Stracke', 'Javonte Rau Jr.', 'Lesley Sawayn', '2022-11-06', 0, '2022-12-06 02:26:18', '2022-12-06 02:26:18'),
(7, 6, 1, 3, 'Maudie Bednar', 'Anika Conn', 'Kelsi Paucek', 'Jarret Jakubowski', '2022-11-01', 0, '2022-12-06 02:26:18', '2022-12-06 02:26:18'),
(8, 7, 8, 1, 'Kenneth Muller', 'Madie Lowe PhD', 'Dr. Keshaun Collins Jr.', 'Melissa Schmeler', '2022-11-08', 2, '2022-12-06 02:26:18', '2022-12-06 02:26:18'),
(9, 6, 6, 4, 'Tressa Beer', 'Mr. Glen Stracke', 'Pinkie Hammes', 'Mr. Doyle Mann', '2022-11-09', 0, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(10, 7, 7, 3, 'Beryl Yost', 'Vernie Dach', 'Dr. Camilla Roberts', 'Prof. Noel Gleason', '2022-11-10', 2, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(11, 8, 8, 4, 'Mrs. Audra Monahan PhD', 'Norval Frami PhD', 'Mrs. Gretchen Towne V', 'Stewart Franecki DVM', '2022-11-12', 2, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(12, 3, 3, 2, 'Prof. Andy Orn', 'Prof. Karlie Anderson', 'Eliezer Bode', 'Prof. Raymond Bernier', '2022-11-23', 0, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(13, 6, 3, 2, 'Dr. Jaime Tremblay', 'Jeremie Christiansen', 'Caleb Gislason', 'Ms. Genesis Anderson', '2022-11-24', 1, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(14, 1, 2, 1, 'Jacklyn Tillman', 'Heaven Legros', 'Nils Lebsack', 'Clay Davis', '2022-11-03', 1, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(15, 10, 5, 2, 'Oswald Stoltenberg', 'Shana Herman', 'Kendrick Bartell', 'Freddie Christiansen', '2022-11-07', 1, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(16, 1, 2, 4, 'Sandra Pfannerstill', 'Prof. Trenton Yundt', 'Hildegard Pollich III', 'Jamil Volkman', '2022-11-06', 1, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(17, 7, 1, 3, 'Prof. Al Heller Jr.', 'Reina Pacocha', 'Erna Schamberger', 'Miller Kemmer DDS', '2022-11-05', 0, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(18, 9, 10, 1, 'Katherine Kling', 'Edmund Willms', 'Dale Waelchi', 'Dr. Ed Bashirian', '2022-11-04', 2, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(19, 4, 9, 1, 'Prof. Jedediah Schoen', 'Dr. Keshaun Wyman Jr.', 'Miss Laury Runte', 'Newell Daugherty', '2022-11-02', 2, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(20, 8, 1, 1, 'Anderson Wisoky', 'Imani Altenwerth', 'Rita Lindgren', 'Nathanael Kertzmann', '2022-11-01', 2, '2022-12-06 02:26:19', '2022-12-06 02:26:19'),
(21, 3, 11, 4, 'Parkir tak rapi', '<p>lagi</p>', '202212061220Screenshot_2022-12-06_14-50-19.png', NULL, '2022-12-06', 0, '2022-12-06 05:20:08', '2022-12-06 05:20:08'),
(22, 13, 12, 2, 'Berserakan Sampah', 'asd', '202212061223Screenshot_2022-12-05_19-53-37.png', '<p>jangan nakal</p>', '2022-12-06', 0, '2022-12-06 05:23:19', '2022-12-06 05:36:55'),
(23, 13, 12, 1, 'Barang hilang di meja karyawan lantai 1', 'asdasd', '202212061230Screenshot_2022-12-06_13-44-43.png', NULL, '2022-12-01', 0, '2022-12-06 05:30:38', '2022-12-06 05:43:31'),
(24, 12, 13, 3, 'Barang berserakan', 'nbnbnb', '202212061234Screenshot_2022-12-06_10-23-45.png', NULL, '2022-12-05', 0, '2022-12-06 05:34:01', '2022-12-06 05:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `types_violations`
--

CREATE TABLE `types_violations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_violation` varchar(255) DEFAULT NULL,
  `sum_points` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types_violations`
--

INSERT INTO `types_violations` (`id`, `name_violation`, `sum_points`, `created_at`, `updated_at`) VALUES
(1, 'Mencuri', 15, '2022-12-06 02:27:03', NULL),
(2, 'Membuang Sampah Sembarang', 15, '2022-12-06 02:27:03', NULL),
(3, 'Tidak Meletakan Barang Pada Tempatnya', 15, '2022-12-06 02:27:03', NULL),
(4, 'Parkir Sembarangan', 13, '2022-12-06 02:27:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Admin, 0 : User',
  `image` varchar(255) DEFAULT 'default.svg',
  `is_active` int(11) DEFAULT NULL COMMENT '0 = nonActive, 1 = Active',
  `menu_report_status` int(11) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `email_verified_at`, `password`, `role`, `image`, `is_active`, `menu_report_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Aubree Hudson PhD', 'joshuah29@example.com', '2022-12-06 02:25:56', '$2y$10$6NQo2B1d.km9nsj1NiQrWuXP0/i8lNbnnef0PVxWS0RJNnXozIsFe', 1, 'Po4KxYQmnr', 1, 0, 'Tjt6B6yrGV', '2022-12-06 02:25:57', '2022-12-06 05:18:48'),
(2, 'Dr. Katharina Harris PhD', 'hellen.mitchell@example.org', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, '0ME1yrtBYj', 1, 0, 'DF9DH3v7Xb', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(3, 'Camilla Wilkinson', 'eaufderhar@example.org', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'IKvFqmewHa', 1, 0, 'yc06H2I4XS', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(4, 'Prof. Bret Spinka III', 'bhauck@example.com', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'fENyTbP46i', 1, 0, '5tyLmqsRRV', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(5, 'Sarai Moen', 'ggutmann@example.net', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'wCCNfyVejq', 1, 0, 'oCfrEbS5c2', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(6, 'Alvera Stamm Jr.', 'rbosco@example.com', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'ioMQavxs5D', 1, 0, 'yu9tSlVsY1', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(7, 'Immanuel Brown', 'price.layne@example.com', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'xccKF78Y5X', 1, 0, 'b8YFIJfo72', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(8, 'Mr. Camron Glover', 'kautzer.everardo@example.org', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, '0B8TLrGx2Y', 1, 0, '0SBDkbMGB0', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(9, 'Miss Michaela Torphy DVM', 'ashley.yost@example.net', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'wXedkHm6ij', 1, 0, 'rXNGhj8Xxz', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(10, 'Mr. Deon Runte', 'afton.mcdermott@example.org', '2022-12-06 02:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'QdQVDvzPpe', 1, 0, 'zCUHHZJiL3', '2022-12-06 02:25:57', '2022-12-06 02:25:57'),
(11, 'Admin', 'admin@gmail.com', NULL, '$2y$10$v6dF9yh1rNVpFzznySz8NuVm9D13VgdJqxsZaccNCeGzyzd05XWmy', 1, 'default.svg', 1, 0, NULL, '2022-12-06 02:28:01', '2022-12-06 02:28:01'),
(12, 'Harun Saputra', 'harun@gmail.com', NULL, '$2y$10$Pw4C6kQVLfz7t3PJAA6TtupLmhsxQPbS0ABbcH3QvYEJ2y4Un0eGm', 0, 'default.svg', 1, 0, NULL, '2022-12-06 05:20:50', '2022-12-06 05:21:43'),
(13, 'Hasan Cohorup', 'hasan@gmail.com', NULL, '$2y$10$kqQWM9sGqfDNJ7PIIv/FSeyxXhrFUoIk9zuEGdaVwF/eO2Zqs0F2i', 0, 'default.svg', 1, 0, NULL, '2022-12-06 05:21:15', '2022-12-06 05:21:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types_violations`
--
ALTER TABLE `types_violations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `types_violations`
--
ALTER TABLE `types_violations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
