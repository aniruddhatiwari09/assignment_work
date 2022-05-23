-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 04:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment_work`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `user_id`, `title`, `file`, `created_at`) VALUES
(1, '2', 'Testing', 'document_495986.pdf', NULL),
(13, '2', 'new one', '1653270568_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 03:49:28'),
(14, '2', 'hgghhggh', '1653272735_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 04:25:35'),
(15, '2', 'hgghhggh', '1653272741_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 04:25:41'),
(16, '2', 'hgghhggh', '1653272788_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 04:26:28'),
(17, '2', 'ghhghg', '1653272878_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 04:27:58'),
(18, '2', 'ghhghg', '1653273006_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 04:30:06'),
(19, '2', 'fvfgfg', '1653273206_Assignment FullStack Developer - QubeHealth 31st Mar 2022.pdf', '2022-05-23 04:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `status` varchar(1) DEFAULT '1',
  `role` varchar(2) DEFAULT '2',
  `otp` varchar(10) DEFAULT NULL,
  `otp_verify` int(1) DEFAULT 0,
  `token` varchar(100) NOT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `name`, `mobile_no`, `status`, `role`, `otp`, `otp_verify`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '8272869894', '1', '1', '', 1, 'f651cc6fc86f20f80d422f1311cf97d38', '2022-05-22 17:49:05', '2022-05-22 17:49:05'),
(2, 'User', '9975286690', '1', '2', '', 1, '803bf0b3aea306e0f6a6affbfc5a7c8b', '2022-05-22 17:49:05', '2022-05-22 17:49:05'),
(8, 'first', '9988774455', '1', '2', NULL, 0, '', '2022-05-23 03:52:30', NULL),
(9, 'second', '9999999999', '1', '2', NULL, 0, '', '2022-05-23 04:38:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pradeep Vishwakarma', 'pradeepavish22@gmail.com', NULL, '$2y$10$7tO/9jvFOZk1.VsHXqxPCuK5qeaRnYU6nB1eMIh1r0m7ESQ8DR1jK', NULL, '2022-05-03 13:31:17', '2022-05-03 15:07:36'),
(2, 'ani', 'admin@gmail.com', NULL, '$2y$10$7KzNB1XZ2KvIhmlCwnHpOO7MAeYU5sSCGF7zpg2RFSUww//l3cBTi', NULL, '2022-05-03 13:57:59', '2022-05-03 13:57:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
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
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
