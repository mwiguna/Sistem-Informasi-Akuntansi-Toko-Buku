-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2016 at 03:29 PM
-- Server version: 5.7.16-0ubuntu0.16.10.1
-- PHP Version: 7.0.8-3ubuntu3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sia`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `judul`, `penerbit`, `kategori`, `stok`, `harga`, `remember_token`, `created_at`, `updated_at`) VALUES
(1001, 'Sistem Informasi Akuntansi', 'Salemba', 'Akuntansi', 10, 170000, NULL, NULL, '2016-11-22 08:24:32'),
(1002, 'Operating Sistem', 'Informatika', 'Komputer', 17, 50000, NULL, NULL, '2016-11-22 14:19:43'),
(1003, 'Pemrograman PHP', 'Informatika', 'Komputer', 19, 170000, NULL, '2016-11-22 04:26:14', '2016-11-22 15:45:11'),
(1004, 'Teknik Otomotif', 'Yudistira', 'Teknik', 15, 80000, NULL, '2016-11-22 04:36:04', '2016-11-22 04:36:04'),
(1005, 'Manfaat Kedelai', 'Kusangko', 'Kesehatan', 25, 55000, NULL, '2016-11-22 11:37:41', '2016-11-22 11:37:41'),
(1006, 'Otomotif Expert', 'Salemba', 'Teknik', 17, 250000, NULL, '2016-11-22 14:23:09', '2016-11-22 14:24:53'),
(1007, 'Sistem Informasi Manajemen', 'Salemba', 'Akuntansi', 35, 125000, NULL, '2016-11-23 04:25:50', '2016-11-23 04:29:57');

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
(9, '2016_11_21_030316_create_table_book', 2),
(10, '2016_11_21_061240_create_table_penjualan', 2),
(11, '2016_11_21_150028_create_table_pembelian', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `pembelian_id` int(10) UNSIGNED NOT NULL,
  `faktur_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pembelians`
--

INSERT INTO `pembelians` (`pembelian_id`, `faktur_id`, `nama`, `jumlah`, `harga`, `supplier`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'Buku Informatika Dasar', 20, 50000, 'Informatika', NULL, '2016-11-22 04:06:34', '2016-11-22 04:06:34'),
(2, '2', 'Rak Buku', 1, 1500000, 'Toko Kayu ', NULL, '2016-10-22 08:40:21', '2016-11-22 08:40:21'),
(3, '3', 'Buku Genetika', 35, 140000, 'Gramedia', NULL, '2016-11-23 01:26:37', '2016-11-23 01:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `penjualans`
--

CREATE TABLE `penjualans` (
  `penjualan_id` int(10) UNSIGNED NOT NULL,
  `faktur_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buku_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penjualans`
--

INSERT INTO `penjualans` (`penjualan_id`, `faktur_id`, `buku_id`, `jumlah`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', '1001', 2, NULL, '2016-10-22 00:10:58', '2016-11-22 00:10:58'),
(2, '1', '1002', 1, NULL, '2016-10-22 00:10:58', '2016-11-22 00:10:58'),
(3, '2', '1003', 2, NULL, '2016-11-22 08:24:32', '2016-11-22 08:24:32'),
(4, '2', '1001', 3, NULL, '2016-11-22 08:24:32', '2016-11-22 08:24:32'),
(5, '3', '1003', 5, NULL, '2016-11-22 14:19:43', '2016-11-22 14:19:43'),
(6, '3', '1002', 2, NULL, '2016-11-22 14:19:43', '2016-11-22 14:19:43'),
(7, '4', '1006', 4, NULL, '2016-11-22 14:24:53', '2016-11-22 14:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'admin@mail.com', '$2y$10$jF/w0U1Kek2HytEL76lztukOzHhWH/zXsoWi1Y1/j5pgWQi.SzGYi', 'PfsZFlpVKfMsoymzKH1giG8FAsC11cxCrCDZWewKs62MlnqsZJqxnjeClQqd', '2016-11-20 03:11:30', '2016-11-22 21:49:35'),
(5, 'gudang', 'gudang@mail.com', '$2y$10$NM9Q2UQTLfUCJlWbpQbGBeT5sOXl84pPloxN4gq5wRLvGUNIdxltq', 'fv4Zqxc1mQUDjXeigoClHUP9BKlXoQtrZSzL8rK3O7p1QeXndw6kefRo8IRe', '2016-11-20 07:38:21', '2016-11-22 21:49:25'),
(6, 'pemilik', 'pemilik@mail.com', '$2y$10$c1nSsQJHCQoK76v7h68QHOFDmEdZZel9bJrfLCA5SPTS8VDDUQmxu', '189a78zVHQ8hqrJzITBS19145EX1JxQOxpoO0RY0nKeKpC0CzyH8tWAAxuLC', '2016-11-20 07:39:38', '2016-11-22 22:08:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD PRIMARY KEY (`penjualan_id`);

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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `pembelian_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penjualans`
--
ALTER TABLE `penjualans`
  MODIFY `penjualan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
