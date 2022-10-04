-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 04, 2022 at 05:52 AM
-- Server version: 5.7.37
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spc_kualitastelur`
--

-- --------------------------------------------------------

--
-- Table structure for table `basis`
--

CREATE TABLE `basis` (
  `id_basis` int(11) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL,
  `image` text,
  `r` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_users`, `nama`, `email`, `foto`, `username`, `password`, `roles`, `ins`, `upd`) VALUES
(1, 1, 'Alan Saputra Lengkoan', 'alanlengkoan@gmail.com', '39d154bb5e21a4c7ec7c8b7f8c7cc38d.jpg', 'admin', '$2y$10$UrvEbnhpVkCREvEz1WjUAu5EUEdbeTjFtQE0faPjufKxl68AtJmsi', 'admin', '2021-07-22 01:56:34', '2022-10-04 05:51:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basis`
--
ALTER TABLE `basis`
  ADD PRIMARY KEY (`id_basis`),
  ADD KEY `id_klasifikasi` (`id_klasifikasi`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649FA06E4D9` (`id_users`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basis`
--
ALTER TABLE `basis`
  MODIFY `id_basis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basis`
--
ALTER TABLE `basis`
  ADD CONSTRAINT `k_to_b` FOREIGN KEY (`id_klasifikasi`) REFERENCES `klasifikasi` (`id_klasifikasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
