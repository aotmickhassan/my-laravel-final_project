-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 04:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_sectors`
--

CREATE TABLE `billing_sectors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billing_sector_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_sectors`
--

INSERT INTO `billing_sectors` (`id`, `billing_sector_name`, `created_at`, `updated_at`) VALUES
(1, 'Paritoshik', NULL, NULL),
(2, 'Question Moderation', NULL, NULL),
(3, 'Question Composition', NULL, NULL),
(4, 'Question Preparation', NULL, NULL),
(5, 'Answer Sheet Examining', NULL, NULL),
(6, 'Third Examination', NULL, NULL),
(7, 'Class Test', NULL, NULL),
(8, 'Lab Work', NULL, NULL),
(9, 'Central Viva', NULL, NULL),
(10, 'Supervision Thesis Undergraduate', NULL, NULL),
(11, 'Supervision Thesis Post-graduate', NULL, NULL),
(12, 'Supervision Thesis PhD', NULL, NULL),
(13, 'Evaluation of Thesis', NULL, NULL),
(14, 'Presentation', NULL, NULL),
(15, 'Main Invisilation', NULL, NULL),
(16, 'Scrutiny', NULL, NULL),
(17, 'Presentation', NULL, NULL),
(18, 'Tabulation', NULL, NULL),
(19, 'Sommani', NULL, NULL),
(20, 'Dakmasul', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `routing_number` varchar(255) NOT NULL,
  `bill_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `exam_id`, `bank_account`, `branch_name`, `routing_number`, `bill_date`, `created_at`, `updated_at`) VALUES
(1, 1, '123456789', 'Main Branch', '001234567', '2024-03-01', '2025-04-24 12:45:25', '2025-04-24 12:45:25'),
(2, 2, '987654321', 'Secondary Branch', '007654321', '2024-06-01', '2025-04-24 12:45:25', '2025-04-24 12:45:25'),
(3, 3, '10000', 'master Branch', '00222267', '2024-08-01', NULL, NULL),
(4, 4, '200001', '2nd Branch', '005671', '2024-06-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billing_sector_id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `is_full_paper` tinyint(1) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`id`, `billing_sector_id`, `bill_id`, `course_code`, `count`, `is_full_paper`, `rate`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'cse2123', 100, 1, 10.00, 3, '2025-04-29 03:46:36', '2025-04-29 03:46:36'),
(4, 1, 1, 'CSE 2203', 1, 1, 10.00, 1, '2025-04-29 03:54:20', '2025-04-29 03:54:20'),
(5, 2, 1, 'CSE 2203', 1, 1, 10.00, 1, '2025-04-29 03:54:20', '2025-04-29 03:54:20'),
(6, 5, 1, 'UJI', 1, 1, 100.00, 1, '2025-04-29 04:07:41', '2025-04-29 04:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_title` text NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_credit` double(8,2) NOT NULL,
  `course_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `course_code`, `course_credit`, `course_type`, `created_at`, `updated_at`) VALUES
(1, 'Algorithm Analysis and Design', 'CSE 2203', 3.00, 'ACITVE', '2025-04-29 03:52:59', '2025-04-29 03:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Textile Engineering', NULL, NULL),
(2, 'Electrical Engineering', NULL, NULL),
(3, 'Computer Science and Engineering', NULL, NULL),
(4, 'Chemical Engineering', NULL, NULL),
(5, 'Biomedical Engineering', NULL, NULL),
(6, 'Industrial Engineering', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_designation` varchar(255) NOT NULL,
  `emp_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `exam_department` varchar(255) NOT NULL,
  `session_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `exam_start_date` date NOT NULL,
  `exam_end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `exam_department`, `session_year`, `semester`, `exam_start_date`, `exam_end_date`, `created_at`, `updated_at`) VALUES
(1, '  Examination', 'Computer ', '2023-2044', 'Winter ', '2025-06-05', '2025-08-18', '2025-04-24 12:37:23', '2025-04-24 12:37:23'),
(2, '  Examination', 'Computer ', '2023-2044', 'Winter ', '2025-06-05', '2025-08-18', '2025-04-24 12:41:51', '2025-04-24 12:41:51'),
(3, '  Examination', 'Computer ', '2023-2044', 'Winter ', '2025-06-05', '2025-08-18', '2025-04-24 12:42:46', '2025-04-24 12:42:46'),
(4, 'Semester Examination', 'Computer Engineering', '2025-2026', 'Fall', '2025-06-30', '2025-08-10', NULL, NULL),
(5, 'Final Examination', 'Electrical Engineering', '2023-2024', 'Fall', '2024-06-01', '2024-06-15', NULL, NULL),
(6, 'Practical Examination', 'Mechanical Engineering', '2022-2023', 'Autumn', '2023-11-01', '2023-11-10', NULL, NULL);

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
(80, '2024_09_22_125733_create_employee_table', 1),
(234, '2014_10_12_000000_create_users_table', 2),
(235, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(236, '2019_08_19_000000_create_failed_jobs_table', 2),
(237, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(238, '2024_09_19_180621_create_teachers_table', 2),
(239, '2024_09_20_164851_create_courses_table', 2),
(240, '2024_09_22_132320_create_employees_table', 2),
(241, '2024_09_22_135427_create_exams_table', 2),
(242, '2024_09_22_140024_create_billing_sectors_table', 2),
(243, '2024_09_22_154751_create_bills_table', 2),
(244, '2024_09_22_155739_create_bill_details_table', 2),
(245, '2024_11_11_082931_create_departments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ariful Haque', 'arif.hq@gmail.com', NULL, '$2y$12$mtuoQC03YCbxfk4tEwkLhew9bIjTDUCipDr0n/wHBdATb4m72C0rq', 'SNbnoHIGfHomizj7pQJ6IlHPm57XUbQ1iZjz3yVRwJwMrBQERCfGlqBKL0Ht', '2025-04-24 09:44:15', '2025-04-24 09:44:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_sectors`
--
ALTER TABLE `billing_sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_details_billing_sector_id_foreign` (`billing_sector_id`),
  ADD KEY `bill_details_bill_id_foreign` (`bill_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `billing_sectors`
--
ALTER TABLE `billing_sectors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bill_details`
--
ALTER TABLE `bill_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_details_billing_sector_id_foreign` FOREIGN KEY (`billing_sector_id`) REFERENCES `billing_sectors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
