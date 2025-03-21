-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2025 at 10:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.14

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
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` int NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `type`, `created_at`) VALUES
(1, 'Basic Salary', '2025-03-21 21:07:25'),
(2, 'Daily Rate', '2025-03-21 21:07:25'),
(3, 'Transpo Allowance', '2025-03-22 06:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `benefits_compensation`
--

CREATE TABLE `benefits_compensation` (
  `id` int NOT NULL,
  `employee_id` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `remark` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` char(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefits_compensation`
--

INSERT INTO `benefits_compensation` (`id`, `employee_id`, `type`, `amount`, `remark`, `created_at`, `updated_at`, `updated_by`) VALUES
(14, 'EMP0001', 'Basic Salary', 40000.00, '', '2025-03-22 06:13:22', '2025-03-22 06:42:05', 'webmaster'),
(15, 'EMP0001', 'Daily Rate', 800.00, '', '2025-03-22 06:13:34', '2025-03-22 06:39:02', 'webmaster'),
(16, 'EMP0001', 'Transpo Allowance', 200.00, '', '2025-03-22 06:13:41', '2025-03-22 06:38:22', 'webmaster');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `employee_id` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sss` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `philhealth` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagibig` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `registered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `profile`, `email`, `contact`, `position`, `birthdate`, `gender`, `civil_status`, `address`, `sss`, `tin`, `philhealth`, `pagibig`, `status`, `approved`, `created_at`, `updated_at`, `registered_at`) VALUES
(71, 'EMP0001', 'Warren', 'Pena', 'https://mighty.tools/mockmind-api/content/human/80', 'warrenryo@gmail.com', '09229403679', 'Hotel Manager', '2025-03-16', 'Male', 'Single', 'Bagong Silang Caloocan City', '58440224242', '445343', '01-255933-2334', '6-77665-44533', 'DoneTraining', 0, '2025-03-22 04:49:28', '2025-03-01 07:30:23', '2025-03-01 07:27:55'),
(72, 'EMP0002', 'Charlie', 'Jokson', 'https://mighty.tools/mockmind-api/content/human/92', 'charliejokson@gmail.com', '09230445063', 'Front Office / Guest Services', '2025-03-16', 'Male', 'Single', 'Commonwealth Avenue 601 Street', '34-22-4512-5', '123-456-789-000', '201-234-567-890', '9876-5432-1098', 'DoneTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-06 06:34:16'),
(73, 'EMP0003', 'Carl', 'Sanchez', 'https://mighty.tools/mockmind-api/content/human/12', 'carlsanchez@gmail.com', '09248567391', 'Housekeeping', '2025-03-16', 'Male', 'Married', 'Makati New york street 215 ', '12-45-7834-1', '456-789-123-000', '150-789-012-345', '1234-5678-9012', 'OnTraning', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(74, 'EMP0004', 'Michael', 'Brown ', 'https://mighty.tools/mockmind-api/content/human/10', 'michael.brown@example.com', '09574835748', 'Food and Beverage (F&B)', '2025-03-16', 'Male', 'Married', '123 Maple Street, Springfield, IL 62701', '22-55-1234-7', '123-456-789-000', '9876-5432-1098', '1122-3344-5566', 'DoneTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(75, 'EMP0005', 'Jane ', 'Smith', 'https://mighty.tools/mockmind-api/content/human/11', 'janesmith@email.com', '092347586943', ' Sales and Marketing', '2025-03-16', 'Female', 'Married', 'Address: 456 Oak Avenue, Denver, CO 80203', '1234-5678-9012', '1122-3344-5566', '201-234-567-890', '204-567-890-123', 'DoneTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(76, 'EMP0006', 'Alex ', 'Johnson', 'https://mighty.tools/mockmind-api/content/human/57', 'alex.johnson@domain.org', '09348567891', 'Maintenance and Engineering', '2025-03-16', 'Male', 'Married', 'Address: 789 Pine Road, Los Angeles, CA 90001', '34-22-4512-5', '123-456-789-000', '9876-5432-1098', '201-234-567-890', 'ReadyForTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(77, 'EMP0007', 'Sophia ', 'Lee', 'https://mighty.tools/mockmind-api/content/human/11', 'sophia.lee@email.com', '09274567584', 'Human Resources', '2025-03-16', 'Female', 'Married', '135 Elm Street, Seattle, WA 98101', '201-234-567-890', '301-456-789-012', '567-890-123-002', '456-789-123-000', 'DoneTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(78, 'EMP0008', 'Olivia ', 'Clark', 'https://mighty.tools/mockmind-api/content/human/10', 'olivia.clark@website.net', '09283766775', 'Security', '2025-03-16', 'Male', 'Married', ' 876 Willow Way, Chicago, IL 60614', '201-234-567-890', '9988-7766-5544', '204-567-890-123', '456-789-123-000', 'ReadyForTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(79, 'EMP0009', 'Isabella ', 'Martinez', 'https://mighty.tools/mockmind-api/content/human/11', 'isabella.martinez@service.org', '09299849382', ' Sales and Marketing', '2025-03-16', 'Male', 'Single', ' 987 Maple Ridge, Portland, OR 97201', '201-234-567-890', '12-45-7834-1', '22-55-1234-7', '789-012-345-000', 'OnTraning', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-05 09:05:49'),
(80, 'EMP0010', 'John ', 'Doe', 'https://mighty.tools/mockmind-api/content/human/98', ' johndoe@gmail.com', '09483596879', ' Front Office / Guest Services', '2025-03-16', 'Male', 'Single', '123 Maple Street, Springfield, IL 62701', '2468-1357-9023', '99-11-2345-2', '12-45-7834-1', '34-22-4512-5', 'DoneTraining', 0, '2025-03-22 04:49:28', '2025-03-05 09:05:49', '2025-03-06 06:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int NOT NULL,
  `payroll_id` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cutoff_start` date NOT NULL,
  `cutoff_end` date NOT NULL,
  `total_days` double NOT NULL,
  `total_holidays` int NOT NULL,
  `status` enum('Pending','Approved','Declined','Hold') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `payroll_id`, `employee_id`, `employee_name`, `cutoff_start`, `cutoff_end`, `total_days`, `total_holidays`, `status`, `created_at`) VALUES
(38, 'PR20250221', 'EMP1001', 'JHON DOE', '2025-02-01', '2025-02-15', 10, 0, 'Pending', '2025-02-21 05:32:32'),
(39, 'PR20250221', 'EMP1002', 'JON DOE', '2025-02-01', '2025-02-15', 8, 0, 'Pending', '2025-02-21 05:32:32'),
(40, 'PR20250315', 'EMP1001', 'JHON DOE', '2025-02-01', '2025-02-15', 10, 1, 'Pending', '2025-03-15 21:35:19'),
(41, 'PR20250315', 'EMP1002', 'JON DOE', '2025-02-01', '2025-02-15', 8, 0, 'Pending', '2025-03-15 21:35:19');

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
  `status` enum('Active','Inactive','','') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `email_verified_at`, `address`, `contact`, `picture`, `role`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 116088, 'Web', 'Master', 'webmaster', '$2y$10$LfIHslrFgSK82w0YmnwvUujBvOTzUh5k0m4p0vJuC9aWMEBBzfzfW', 'kasl.5437@gmail.com', NULL, 'Et sunt sint dolorem', '09082546789', 'default.png', 'Admin', 'Active', '2025-03-22 04:42:13', '2025-01-31 01:54:31', '2025-03-21 20:42:14'),
(17, 118341, 'Emerald', 'Workman', 'nydyxam', '$2y$10$wzCj83BFB8f8.AUI6YMVJOayV57BxqBCAvstYL0Sp7bQJfYr5gsay', 'jakyris@mailinator.com', NULL, 'Autem ipsam hic dolo', 'Sint recusandae Sa', 'default.png', 'Admin', 'Active', NULL, '2025-02-20 15:01:06', '2025-02-20 17:49:16'),
(18, 117478, 'Emerald', 'Workman', 'nydyxamssss', '$2y$10$ze62XdtfEjMH5JvV.72Mve/975ydpW/wBlbsNGYmnNnDY./4jwd6m', 'jakyris1@mailinator.com', NULL, 'Autem ipsam hic dolo', 'Sint recusandae Sa', 'default.png', 'Admin', 'Active', NULL, '2025-02-20 15:02:26', '2025-02-20 15:02:26'),
(19, 116552, 'Flavia', 'Kim', 'piwafilyve', '$2y$10$mc72rfKPPBKwgqOzVIVW3eRsa6ImahKnJ5APphDTNjAhKOQyjBqsi', 'qysazevo@mailinator.com', NULL, 'Recusandae Praesent', 'Dicta quasi cumque u', 'default.png', 'Hr', 'Active', NULL, '2025-02-20 15:03:50', '2025-02-20 15:03:50'),
(20, 115582, 'Darius', 'Gonzalez', 'kypozi', '$2y$10$bU0iFob1VUj7DUoOHQe5tO5ydLmgyA3.3ivfm/zp6PloZTmnB7TIS', 'kywevy@mailinator.com', NULL, 'Et sit aut commodo ', 'Consequuntur adipisi', 'default.png', 'Hr', 'Active', NULL, '2025-02-20 15:08:33', '2025-02-20 15:08:33'),
(21, 119657, 'Remedios', 'Stone', 'pibagarixe', '$2y$10$BD4cbD0sRXt2FcL5nSb4Ju149LRFS53FyZmbdgmtdDx50yyMSSvmO', 'winopymimu@mailinator.com', NULL, 'Itaque error rerum s', 'Nesciunt aliquip no', 'default.png', 'Hr', 'Active', NULL, '2025-02-20 15:11:17', '2025-02-20 15:11:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits_compensation`
--
ALTER TABLE `benefits_compensation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

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
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `benefits_compensation`
--
ALTER TABLE `benefits_compensation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benefits_compensation`
--
ALTER TABLE `benefits_compensation`
  ADD CONSTRAINT `benefits_compensation_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
