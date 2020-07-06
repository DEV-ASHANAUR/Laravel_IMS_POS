-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 09:58 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Electronics', 1, 1, NULL, '2020-06-05 11:05:33', '2020-06-05 11:05:33'),
(6, 'Cement', 1, 1, NULL, '2020-06-07 03:50:27', '2020-06-07 03:50:27'),
(7, 'T-shirt', 1, 1, NULL, '2020-06-08 11:51:25', '2020-06-08 11:51:25'),
(8, 'Carry', 1, 1, NULL, '2020-06-14 11:06:53', '2020-06-14 11:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile_no`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Md.Ashanur Rahman', '01800000000', 'ashanur@gmail.com', 'Vhavanipur Rajbari Bangladesh', 1, 1, 1, '2020-06-11 12:20:12', '2020-07-06 13:52:09'),
(2, 'Shojib', '01800000000', 'shojib@gmail.com', 'Magurail,Manikgonj', 1, 1, 1, '2020-06-12 05:34:31', '2020-07-06 13:52:28'),
(3, 'mizan', '01800000000', 'mizan@gmail.com', 'nurul islam housing', 1, 1, 1, '2020-06-14 11:11:56', '2020-07-06 13:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Pending,1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '1', '2020-06-18', NULL, 1, 1, 1, '2020-06-18 12:32:38', '2020-06-18 12:32:47'),
(2, '2', '2020-07-02', NULL, 1, 1, 1, '2020-07-02 12:15:03', '2020-07-02 12:15:13'),
(3, '3', '2020-07-02', NULL, 1, 1, 1, '2020-07-02 12:16:07', '2020-07-02 12:16:13'),
(4, '4', '2020-07-04', NULL, 1, 1, 1, '2020-07-04 14:01:59', '2020-07-04 14:03:59'),
(5, '5', '2020-07-05', NULL, 1, 1, 1, '2020-07-05 02:21:08', '2020-07-05 02:21:28'),
(6, '6', '2020-07-05', NULL, 1, 1, 1, '2020-07-05 02:22:50', '2020-07-05 02:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoice_id`, `category_id`, `product_id`, `selling_qty`, `unit_price`, `selling_price`, `status`, `created_at`, `updated_at`) VALUES
(1, '2020-06-18', 1, 2, 1, 10, 1000, 10000, 1, '2020-06-18 12:32:38', '2020-06-18 12:32:46'),
(2, '2020-06-18', 1, 8, 4, 100, 55, 5500, 1, '2020-06-18 12:32:38', '2020-06-18 12:32:47'),
(3, '2020-07-02', 2, 2, 1, 4, 500, 2000, 1, '2020-07-02 12:15:03', '2020-07-02 12:15:13'),
(4, '2020-07-02', 2, 6, 3, 3, 500, 1500, 1, '2020-07-02 12:15:03', '2020-07-02 12:15:13'),
(5, '2020-07-02', 3, 8, 4, 20, 50, 1000, 1, '2020-07-02 12:16:07', '2020-07-02 12:16:13'),
(6, '2020-07-04', 4, 2, 2, 4, 6000, 24000, 1, '2020-07-04 14:01:59', '2020-07-04 14:03:59'),
(7, '2020-07-05', 5, 6, 3, 30, 500, 15000, 1, '2020-07-05 02:21:08', '2020-07-05 02:21:28'),
(8, '2020-07-05', 6, 2, 1, 3, 5000, 15000, 1, '2020-07-05 02:22:50', '2020-07-05 02:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2020_06_04_180318_create_suppliers_table', 3),
(9, '2020_06_05_123943_create_units_table', 4),
(10, '2020_06_05_164243_create_categories_table', 5),
(11, '2020_06_06_114536_create_products_table', 6),
(12, '2020_06_06_185002_create_purchases_table', 7),
(13, '2020_06_10_170126_create_invoices_table', 8),
(14, '2020_06_10_170347_create_invoice_details_table', 8),
(15, '2020_06_10_170527_create_payments_table', 8),
(16, '2020_06_10_170644_create_payment_details_table', 8),
(17, '2020_06_11_180313_create_customers_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'full_paid', 15500, 0, 15500, NULL, '2020-06-18 12:32:38', '2020-06-18 12:32:38'),
(2, 2, 2, 'full_paid', 3000, 0, 3000, 500, '2020-07-02 12:15:03', '2020-07-04 13:58:59'),
(3, 3, 3, 'full_paid', 1000, 0, 1000, NULL, '2020-07-02 12:16:07', '2020-07-04 13:59:46'),
(4, 4, 1, 'full_paid', 24000, 0, 24000, NULL, '2020-07-04 14:01:59', '2020-07-05 11:52:43'),
(5, 5, 1, 'partial_paid', 600, 14400, 15000, NULL, '2020-07-05 02:21:08', '2020-07-05 02:21:08'),
(6, 6, 2, 'partial_paid', 5000, 10000, 15000, NULL, '2020-07-05 02:22:50', '2020-07-05 02:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `invoice_id`, `current_paid_amount`, `date`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 15500, '2020-06-18', NULL, '2020-06-18 12:32:38', '2020-06-18 12:32:38'),
(2, 2, NULL, '2020-07-02', NULL, '2020-07-02 12:15:03', '2020-07-02 12:15:03'),
(3, 3, 0, '2020-07-02', NULL, '2020-07-02 12:16:07', '2020-07-02 12:16:07'),
(4, 2, 3000, '2020-07-05', NULL, '2020-07-04 13:59:00', '2020-07-04 13:59:00'),
(5, 3, 1000, '2020-07-05', NULL, '2020-07-04 13:59:46', '2020-07-04 13:59:46'),
(6, 4, 0, '2020-07-04', NULL, '2020-07-04 14:01:59', '2020-07-04 14:01:59'),
(7, 4, 4000, '2020-07-05', NULL, '2020-07-04 14:04:42', '2020-07-04 14:04:42'),
(8, 5, 600, '2020-07-05', NULL, '2020-07-05 02:21:08', '2020-07-05 02:21:08'),
(9, 6, NULL, '2020-07-05', NULL, '2020-07-05 02:22:50', '2020-07-05 02:22:50'),
(10, 6, 5000, '2020-07-05', NULL, '2020-07-05 02:23:47', '2020-07-05 02:23:47'),
(11, 4, 20000, '2020-07-05', NULL, '2020-07-05 11:52:43', '2020-07-05 11:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `unit_id`, `category_id`, `name`, `quantity`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 'walton 1042', 533, 1, 1, NULL, '2020-06-18 12:27:10', '2020-07-06 12:37:48'),
(2, 2, 1, 2, 'walton mobile 120', 96, 1, 1, NULL, '2020-06-18 12:27:31', '2020-07-04 14:03:59'),
(3, 3, 1, 6, 'holcim cement', 497, 1, 1, NULL, '2020-06-18 12:27:48', '2020-07-06 12:09:22'),
(4, 5, 2, 8, 'Potatu', 880, 1, 1, NULL, '2020-06-18 12:28:10', '2020-07-02 12:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Pending,1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `product_id`, `purchase_no`, `date`, `description`, `buying_qty`, `unit_price`, `buying_price`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 4, 'pp-01', '2020-06-18', 'Dami Text', 1000, 50, 50000, 1, 1, NULL, '2020-06-18 12:29:50', '2020-06-18 12:29:50'),
(2, 2, 2, 1, 'pp-01', '2020-06-18', 'Dami Text', 500, 10000, 5000000, 1, 1, NULL, '2020-06-18 12:29:51', '2020-06-18 12:29:51'),
(3, 3, 6, 3, 'pp-01', '2020-06-18', 'Dami Text', 500, 500, 250000, 1, 1, NULL, '2020-06-18 12:29:51', '2020-06-18 12:29:51'),
(4, 2, 2, 2, 'pp-02', '2020-06-18', 'Dami Text', 100, 8000, 800000, 1, 1, NULL, '2020-06-18 12:31:09', '2020-06-18 12:31:09'),
(5, 3, 6, 3, 'r-3', '2020-07-06', NULL, 30, 600, 18000, 1, 1, NULL, '2020-07-06 12:09:18', '2020-07-06 12:09:18'),
(6, 2, 2, 1, 'M-1042', '2020-07-06', 'Dami Text', 50, 12000, 600000, 1, 1, NULL, '2020-07-06 12:37:43', '2020-07-06 12:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile_no`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Walton Comany in Bangladesh', '01866936562', 'walton@gmail.com', 'Vhavanipur Rajbari Bangladesh', 1, 1, 1, '2020-06-04 13:14:40', '2020-06-07 03:52:07'),
(3, 'KSRM road', '01866936562', 'ksrm@gmail.com', 'dhaka', 1, 1, 1, '2020-06-06 06:16:37', '2020-06-07 03:54:48'),
(4, 'Nur\'s Brothers', '01866936562', 'nur@gmail.com', 'Vhavanipur Rajbari Bangladesh', 1, 1, NULL, '2020-06-08 11:46:04', '2020-06-08 11:46:04'),
(5, 'All Carry LTD', '01928935607', 'carry@gmail.com', 'Magurail,Manikgonj', 1, 1, 1, '2020-06-14 11:08:03', '2020-06-14 11:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'pcs', 1, 1, 1, '2020-06-05 06:43:05', '2020-06-05 06:50:48'),
(2, 'kg', 1, 1, NULL, '2020-06-06 06:25:13', '2020-06-06 06:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usertype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `name`, `email`, `dob`, `about`, `email_verified_at`, `password`, `mobile`, `address`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Md.Ashanur Rahman', 'ashanour009@gmail.com', '1997-03-05', 'I\'m A Muslim', NULL, '$2y$10$peWrWLWF9GF4XdOg.HIJKOabugRqWNcrGNYUgdXerSQrz98XjSgkq', '01800000000', 'Vhovanipur ,Rajbari', '2020060318411588367106.png', 1, NULL, NULL, '2020-07-06 13:54:39'),
(6, 'Admin', 'Tester', 'test@gmail.com', NULL, NULL, NULL, '$2y$10$pb0893PoDHVk5B.HghXfQOqdCMaPkdWP130n4vB3s.oWegnjFCoji', NULL, NULL, NULL, 1, NULL, '2020-07-06 13:54:05', '2020-07-06 13:54:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
