-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 11:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fisataci_ieee`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowed_users`
--

CREATE TABLE `allowed_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Admin_Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowed_users`
--

INSERT INTO `allowed_users` (`id`, `Email`, `Admin_Email`, `created_at`, `updated_at`) VALUES
(2, 'nihalofficial9008@gmail.com', 'nihalansar9008@gmail.com', '2020-12-13 06:39:45', '2020-12-13 06:39:45'),
(4, 'nih@gh.com', 'nihalansar9008@gmail.com', '2020-12-15 16:55:27', '2020-12-15 16:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `appliedjobs`
--

CREATE TABLE `appliedjobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `U_Id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Job_Id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Job_Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Company_Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Student_Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asap_courses`
--

CREATE TABLE `asap_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asap_courses`
--

INSERT INTO `asap_courses` (`id`, `course_name`, `created_at`, `updated_at`) VALUES
(1, 'ASAP AIML Batch One', NULL, NULL),
(2, 'ASAP CSP IBM Courses', NULL, NULL),
(3, 'Google ACE', NULL, NULL),
(4, 'UiPath RPA', NULL, NULL),
(5, 'Reboot Kerala Hackathon Finalist', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companydetails`
--

CREATE TABLE `companydetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phoneno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Job_Id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Job_Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salary` double NOT NULL,
  `Min_Qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Project_Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Skills_Required` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Min_Age` int(11) NOT NULL,
  `Max_Age` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_24_140147_create_jobs_table', 1),
(5, '2020_10_25_063840_add_job_title_to_jobs_table', 1),
(6, '2020_10_26_065945_create_studentdetails_table', 1),
(7, '2020_10_28_110016_add_phoneno_to_studentdetails_table', 1),
(8, '2020_10_28_131949_create_companydetails_table', 1),
(9, '2020_10_28_160556_create_appliedjobs_table', 1),
(10, '2020_12_11_134354_create_allowed_users_table', 1),
(11, '2020_12_12_101911_add_new_fields_to_studentdetails_table', 1),
(12, '2020_12_13_052932_change_qualifications_field_to_bio', 1),
(13, '2020_12_13_054253_create_student_qualifications_table', 2),
(14, '2020_12_15_123819_add_approve_to_users_table', 3),
(17, '2020_12_15_163607_create_asap_courses_table', 4),
(18, '2020_12_15_163710_create_volunteership_table', 4),
(20, '2020_12_15_165318_create_qualification_table', 5),
(21, '2020_12_15_165623_create_students_qualifications', 6),
(23, '2020_12_15_172813_add_new_2_fields_to_studentdetails_table', 7),
(24, '2020_12_15_204155_add_aahdhaar_to_studentdetails_table', 8);

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
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qualification` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `qualification`, `created_at`, `updated_at`) VALUES
(1, '10th', NULL, NULL),
(2, '12th', NULL, NULL),
(3, 'Graduation', NULL, NULL),
(4, 'Post Graduation', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Age` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `Phoneno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Skills` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CV` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Certificates` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Volunteership` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Linkedin` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Github` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bio` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Asap_Skills` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Aadhaar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`id`, `Email`, `Age`, `DOB`, `Phoneno`, `Address`, `Skills`, `CV`, `Photo`, `created_at`, `updated_at`, `Certificates`, `Volunteership`, `Linkedin`, `Github`, `Bio`, `Gender`, `Asap_Skills`, `Aadhaar`) VALUES
(2, 'nihalofficial9008@gmail.com', 20, '2000-05-12', '9947451753', 'testing nihal 4567', 'testing', 'nihalcv1607862464.pdf', 'nihalphoto1607862464.png', '2020-12-13 06:57:44', '2020-12-15 15:20:36', 'nihalcertificates1607862464.pdf', 'IEEE,HACKATHON', 'https://linkedin.com', 'https://github.com', 'testing', 'male', 'ASAP AIML Batch One,ASAP CSP IBM Courses', 15004);

-- --------------------------------------------------------

--
-- Table structure for table `students_qualifications`
--

CREATE TABLE `students_qualifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cgpa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `board` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join` date NOT NULL,
  `pass` date NOT NULL,
  `cbacklogs` int(11) NOT NULL,
  `hbacklogs` int(11) NOT NULL,
  `qualification` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_qualifications`
--

INSERT INTO `students_qualifications` (`id`, `email`, `course`, `cgpa`, `board`, `institution`, `join`, `pass`, `cbacklogs`, `hbacklogs`, `qualification`, `created_at`, `updated_at`) VALUES
(9, 'nihalofficial9008@gmail.com', 'unknown', '100', 'CBSE', 'IISD', '2020-12-22', '2020-12-31', 0, 0, 1, '2020-12-15 15:18:51', '2020-12-15 15:18:51'),
(10, 'nihalofficial9008@gmail.com', 'unknown', '100', 'CBSE', 'IISD', '2020-12-17', '2020-12-31', 0, 0, 1, '2020-12-15 15:20:36', '2020-12-15 15:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `user_type`, `password`, `remember_token`, `created_at`, `updated_at`, `approved`) VALUES
(1, 'Mohammed Nihal', 'nihalansar9008@gmail.com', '2020-12-13 00:09:43', 1, '$2y$10$UG1mlmlWA.2WRZ4YnxdiQOZLcu5gmsbz1baYNv2sDDRx1h6Mv3gTS', NULL, '2020-12-13 00:08:40', '2020-12-15 10:30:18', 1),
(6, 'Nihal', 'nihalofficial9008@gmail.com', NULL, 0, '$2y$10$GRKE1Y2la5DrnWVk8x.vuumfUqxEuDl.DtWzrZXjqS3WIHjekTLkS', NULL, '2020-12-13 06:40:19', '2020-12-13 06:40:19', 1),
(10, 'Admin', 'admin@asap', NULL, 2, '$2y$10$QZGIZY61paGaPV6GSbXmxe/zL0hz/izg2/S0bFxeXloheHAmjz6QC', NULL, '2020-12-15 03:06:41', '2020-12-15 03:06:41', 1),
(12, 'nih', 'nih@gh.com', NULL, 0, '$2y$10$MBoFtouh3S6Ms0onnnWTceQpawtaD3Po7ef6gydvpmP.2AeBBTqI6', NULL, '2020-12-15 16:55:57', '2020-12-15 16:55:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteerships`
--

CREATE TABLE `volunteerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `volunteerships` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteerships`
--

INSERT INTO `volunteerships` (`id`, `volunteerships`, `created_at`, `updated_at`) VALUES
(1, 'IEEE', NULL, NULL),
(2, 'NSS', NULL, NULL),
(3, 'HACKATHON', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowed_users`
--
ALTER TABLE `allowed_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appliedjobs`
--
ALTER TABLE `appliedjobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asap_courses`
--
ALTER TABLE `asap_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companydetails`
--
ALTER TABLE `companydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companydetails_email_unique` (`Email`),
  ADD UNIQUE KEY `companydetails_phoneno_unique` (`Phoneno`);

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
  ADD UNIQUE KEY `jobs_job_id_unique` (`Job_Id`);

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
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentdetails_email_unique` (`Email`),
  ADD UNIQUE KEY `studentdetails_phoneno_unique` (`Phoneno`);

--
-- Indexes for table `students_qualifications`
--
ALTER TABLE `students_qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_qualifications_qualification_foreign` (`qualification`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `volunteerships`
--
ALTER TABLE `volunteerships`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowed_users`
--
ALTER TABLE `allowed_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appliedjobs`
--
ALTER TABLE `appliedjobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asap_courses`
--
ALTER TABLE `asap_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companydetails`
--
ALTER TABLE `companydetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_qualifications`
--
ALTER TABLE `students_qualifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `volunteerships`
--
ALTER TABLE `volunteerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students_qualifications`
--
ALTER TABLE `students_qualifications`
  ADD CONSTRAINT `students_qualifications_qualification_foreign` FOREIGN KEY (`qualification`) REFERENCES `qualifications` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
