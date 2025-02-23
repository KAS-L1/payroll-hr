-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2025 at 02:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int NOT NULL,
  `payroll_id` char(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cutoff_start` date NOT NULL,
  `cutoff_end` date NOT NULL,
  `total_days` int NOT NULL,
  `total_holiday` int NOT NULL,
  `status` enum('Pending','Approved','Declined','Hold') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `payroll_id`, `employee_id`, `employee_name`, `cutoff_start`, `cutoff_end`, `total_days`, `total_holiday`, `status`, `created_at`) VALUES
(40, 'PR20250223', 'EMP1001', 'JHON DOE', '2025-02-01', '2025-02-15', 10, 0, 'Pending', '2025-02-23 09:00:17'),
(41, 'PR20250223', 'EMP1002', 'JON DOE', '2025-02-01', '2025-02-15', 8, 0, 'Pending', '2025-02-23 09:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `role` enum('Admin','Hr','Finance') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Hr',
  `status` enum('Active','Inactive','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `email_verified_at`, `address`, `contact`, `picture`, `role`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 116088, 'Web3', 'Master2', 'webmaster', '$2y$10$LfIHslrFgSK82w0YmnwvUujBvOTzUh5k0m4p0vJuC9aWMEBBzfzfW', 'kasl.5437@gmail.com', NULL, 'Et sunt sint dolorem', '09082546789', '67ba6dc9a7d61.png', 'Admin', 'Active', '2025-02-23 08:31:20', '2025-01-31 01:54:31', '2025-02-23 00:37:29'),
(17, 118341, 'Emerald', 'Workman', 'nydyxam', '$2y$10$wzCj83BFB8f8.AUI6YMVJOayV57BxqBCAvstYL0Sp7bQJfYr5gsay', 'jakyris@mailinator.com', NULL, 'Autem ipsam hic dolo', 'Sint recusandae Sa', 'default.png', 'Admin', 'Active', NULL, '2025-02-20 15:01:06', '2025-02-20 17:49:16'),
(18, 117478, 'Emerald', 'Workman', 'nydyxamssss', '$2y$10$ze62XdtfEjMH5JvV.72Mve/975ydpW/wBlbsNGYmnNnDY./4jwd6m', 'jakyris1@mailinator.com', NULL, 'Autem ipsam hic dolo', 'Sint recusandae Sa', 'default.png', 'Admin', 'Active', NULL, '2025-02-20 15:02:26', '2025-02-20 15:02:26'),
(19, 116552, 'Flavia', 'Kim', 'piwafilyve', '$2y$10$mc72rfKPPBKwgqOzVIVW3eRsa6ImahKnJ5APphDTNjAhKOQyjBqsi', 'qysazevo@mailinator.com', NULL, 'Recusandae Praesent', 'Dicta quasi cumque u', 'default.png', 'Hr', 'Active', NULL, '2025-02-20 15:03:50', '2025-02-20 15:03:50'),
(20, 115582, 'Darius', 'Gonzalez', 'kypozi', '$2y$10$bU0iFob1VUj7DUoOHQe5tO5ydLmgyA3.3ivfm/zp6PloZTmnB7TIS', 'kywevy@mailinator.com', NULL, 'Et sit aut commodo ', 'Consequuntur adipisi', 'default.png', 'Hr', 'Active', NULL, '2025-02-20 15:08:33', '2025-02-20 15:08:33'),
(21, 119657, 'Remedios', 'Stone', 'pibagarixe', '$2y$10$BD4cbD0sRXt2FcL5nSb4Ju149LRFS53FyZmbdgmtdDx50yyMSSvmO', 'winopymimu@mailinator.com', NULL, 'Itaque error rerum s', 'Nesciunt aliquip no', 'default.png', 'Hr', 'Active', NULL, '2025-02-20 15:11:17', '2025-02-20 15:11:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `payroll_id` (`payroll_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
