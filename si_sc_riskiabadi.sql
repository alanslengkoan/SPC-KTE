-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 08, 2022 at 03:52 AM
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
-- Database: `si_sc_riskiabadi`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_in`
-- (See below for the actual view)
--
CREATE TABLE `stok_in` (
`kd_barang_or_bahan_baku` varchar(10)
,`stok_in` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_in_distribusi`
-- (See below for the actual view)
--
CREATE TABLE `stok_in_distribusi` (
`id_distribusi` int(11)
,`kd_barang` varchar(10)
,`stok_in` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_in_supplier`
-- (See below for the actual view)
--
CREATE TABLE `stok_in_supplier` (
`id_supplier` int(11)
,`kd_bahan_baku` varchar(10)
,`stok_in` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_out`
-- (See below for the actual view)
--
CREATE TABLE `stok_out` (
`kd_barang_or_bahan_baku` varchar(10)
,`stok_out` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_out_distribusi`
-- (See below for the actual view)
--
CREATE TABLE `stok_out_distribusi` (
`id_distribusi` int(11)
,`kd_barang` varchar(10)
,`stok_out` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok_out_supplier`
-- (See below for the actual view)
--
CREATE TABLE `stok_out_supplier` (
`id_supplier` int(11)
,`kd_bahan_baku` varchar(10)
,`stok_out` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan_baku`
--

CREATE TABLE `tb_bahan_baku` (
  `id_bahan_baku` int(11) NOT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `kd_bahan_baku` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bahan_baku`
--

INSERT INTO `tb_bahan_baku` (`id_bahan_baku`, `id_satuan`, `id_jenis`, `kd_bahan_baku`, `nama`, `harga`, `ins`, `upd`) VALUES
(1, 1, 2, 'KDE-BB-001', 'Limbah Biogas Cair', 2000, '2022-06-06 07:05:02', '2022-06-06 07:05:02'),
(2, 2, 3, 'KDE-BB-002', 'Limbah Biogas Padat', 1000, '2022-06-06 07:05:29', '2022-06-06 07:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan_baku_supplier`
--

CREATE TABLE `tb_bahan_baku_supplier` (
  `id_bahan_baku_supplier` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `kd_bahan_baku` varchar(10) DEFAULT NULL,
  `jenis` enum('masuk','keluar') DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `kd_barang` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `id_satuan`, `id_jenis`, `kd_barang`, `nama`, `harga`, `ins`, `upd`) VALUES
(1, 1, 6, 'KDE-B-001', 'Pupuk Organik Cair', 30000, '2022-06-06 06:43:47', '2022-06-06 06:43:47'),
(3, 2, 5, 'KDE-B-002', 'Pupuk Organik Padat', 20000, '2022-06-06 07:04:23', '2022-06-06 07:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_distribusi`
--

CREATE TABLE `tb_barang_distribusi` (
  `id_barang_distribusi` int(11) NOT NULL,
  `id_distribusi` int(11) DEFAULT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `jenis` enum('masuk','keluar') DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_masuk_keluar`
--

CREATE TABLE `tb_barang_masuk_keluar` (
  `id_barang_masuk_keluar` int(11) NOT NULL,
  `no_transaksi` varchar(25) DEFAULT NULL,
  `jenis_transaksi` enum('pembelian','penjualan','masuk','keluar') DEFAULT NULL,
  `kd_barang_or_bahan_baku` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_distribusi`
--

CREATE TABLE `tb_distribusi` (
  `id_distribusi` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `kd_distribusi` varchar(15) DEFAULT NULL,
  `kd_pos` varchar(10) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` text,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_distribusi`
--

INSERT INTO `tb_distribusi` (`id_distribusi`, `id_users`, `kd_distribusi`, `kd_pos`, `npwp`, `fax`, `telepon`, `alamat`, `ins`, `upd`) VALUES
(1, 70137852, 'KDE-DIS-001', '92256', '-', '-', '085289492783', 'Barombong', '2022-06-06 07:09:07', '2022-06-06 07:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `nama`, `ins`, `upd`) VALUES
(2, 'Limbah Biogas Cair', '2022-06-06 06:39:46', '2022-06-06 06:40:26'),
(3, 'Limbah Biogas Padat', '2022-06-06 06:39:53', '2022-06-06 06:39:53'),
(5, 'Pupuk Organik Padat', '2022-06-06 06:40:48', '2022-06-06 06:40:48'),
(6, 'Pupuk Organik Cair', '2022-06-06 06:40:59', '2022-06-06 06:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komposisi`
--

CREATE TABLE `tb_komposisi` (
  `id_komposisi` int(11) NOT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `stok_barang` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komposisi`
--

INSERT INTO `tb_komposisi` (`id_komposisi`, `kd_barang`, `stok_barang`, `ins`, `upd`) VALUES
(1, 'KDE-B-001', 200, '2022-06-23 03:34:11', '2022-06-23 04:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komposisi_detail`
--

CREATE TABLE `tb_komposisi_detail` (
  `id_komposisi_detail` int(11) NOT NULL,
  `id_komposisi` int(11) DEFAULT NULL,
  `kd_bahan_baku` varchar(10) DEFAULT NULL,
  `stok_bahan_baku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komposisi_detail`
--

INSERT INTO `tb_komposisi_detail` (`id_komposisi_detail`, `id_komposisi`, `kd_bahan_baku`, `stok_bahan_baku`) VALUES
(1, 1, 'KDE-BB-001', 30),
(2, 1, 'KDE-BB-002', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `no_transaksi` varchar(25) DEFAULT NULL,
  `jenis_transaksi` enum('pembelian','penjualan') DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `bukti_bayar` blob,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `no_transaksi` varchar(25) DEFAULT NULL,
  `status_approve` enum('0','1') DEFAULT NULL,
  `status_pembayaran` enum('0','1') DEFAULT NULL,
  `status_invoice` enum('0','1') DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian_detail`
--

CREATE TABLE `tb_pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `kd_bahan_baku` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(15) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `youtube` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengiriman`
--

CREATE TABLE `tb_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `no_resi` varchar(25) DEFAULT NULL,
  `no_transaksi` varchar(25) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengiriman_detail`
--

CREATE TABLE `tb_pengiriman_detail` (
  `id_pengiriman_detail` int(11) NOT NULL,
  `id_pengiriman` int(11) DEFAULT NULL,
  `status` enum('0','1','2','3') DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `no_transaksi` varchar(25) DEFAULT NULL,
  `status_approve` enum('0','1') DEFAULT NULL,
  `status_pembayaran` enum('0','1') DEFAULT NULL,
  `status_invoice` enum('0','1') DEFAULT NULL,
  `status_pengantaran` enum('0','1','2','3','4') DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `kd_satuan` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `kd_satuan`, `nama`, `ins`, `upd`) VALUES
(1, 'KDE-S-001', 'Liter', '2022-06-06 06:41:13', '2022-06-06 06:41:13'),
(2, 'KDE-S-002', 'KiloGram', '2022-06-06 06:41:21', '2022-06-06 06:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `kd_supplier` varchar(10) DEFAULT NULL,
  `kd_pos` varchar(10) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` text,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `id_users`, `kd_supplier`, `kd_pos`, `npwp`, `fax`, `telepon`, `alamat`, `ins`, `upd`) VALUES
(1, 36130489, 'KDE-SU-001', '92254', '-', '-', '085640278874', 'Desa Popo, Galesong Selatan', '2022-06-06 07:06:31', '2022-06-06 07:06:31'),
(2, 95491063, 'KDE-SU-002', '92256', '-', '-', '085657877651', 'Desa Tindang Kec. Bontonompo Selatan', '2022-06-06 07:08:02', '2022-06-06 07:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `no_invoice` varchar(25) DEFAULT NULL,
  `no_transaksi` varchar(25) DEFAULT NULL,
  `cetak` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_komposisi`
--

CREATE TABLE `tb_t_komposisi` (
  `id_t_komposisi` int(11) NOT NULL,
  `kd_bahan_baku` varchar(10) DEFAULT NULL,
  `stok_bahan_baku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_pembelian`
--

CREATE TABLE `tb_t_pembelian` (
  `id_t_pembelian` int(11) NOT NULL,
  `kd_bahan_baku` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_penjualan`
--

CREATE TABLE `tb_t_penjualan` (
  `id_t_penjualan` int(11) NOT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('admin','distribusi','supplier') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `id_users`, `nama`, `email`, `foto`, `username`, `password`, `roles`, `ins`, `upd`) VALUES
(1, 1, 'Akbar Aras Nur', 'akbararasnur@gmail.com', '39d154bb5e21a4c7ec7c8b7f8c7cc38d.jpg', 'admin', '$2y$10$UrvEbnhpVkCREvEz1WjUAu5EUEdbeTjFtQE0faPjufKxl68AtJmsi', 'admin', '2021-07-22 01:56:34', '2022-06-16 02:15:43'),
(12, 36130489, 'Supplier Galesong', 'suppgls@gmail.com', NULL, 'suppgls', '$2y$10$.5ifHHnJGwHfr46ETpN6P.cIR4/J1nohrk1vYHdzDV8lYu1gd1FKS', 'supplier', '2022-06-06 07:06:31', '2022-06-06 07:19:45'),
(13, 95491063, 'Supplier Gowa', 'suppgw@gmail.com', NULL, 'suppgw', '$2y$10$fa/ciwTg7J.40ZLkBsEnHuRcNpSROTPkIqkKUOexlGexPJyR0esb.', 'supplier', '2022-06-06 07:08:02', '2022-06-06 07:20:56'),
(14, 70137852, 'Distributor Makassar', 'distmks@gmail.com', NULL, 'distmks', '$2y$10$DQ9i9gVbA3xuceKLEChe6uODWhy9HGm4.Da7NUnS5J.PJgul2T20e', 'distribusi', '2022-06-06 07:09:07', '2022-06-16 10:52:03');

-- --------------------------------------------------------

--
-- Structure for view `stok_in`
--
DROP TABLE IF EXISTS `stok_in`;

CREATE ALGORITHM=UNDEFINED DEFINER=`my_root`@`localhost` SQL SECURITY DEFINER VIEW `stok_in`  AS SELECT `in_out`.`kd_barang_or_bahan_baku` AS `kd_barang_or_bahan_baku`, sum(`in_out`.`jumlah`) AS `stok_in` FROM `tb_barang_masuk_keluar` AS `in_out` WHERE (`in_out`.`jenis_transaksi` in ('pembelian','masuk')) GROUP BY `in_out`.`kd_barang_or_bahan_baku``kd_barang_or_bahan_baku`  ;

-- --------------------------------------------------------

--
-- Structure for view `stok_in_distribusi`
--
DROP TABLE IF EXISTS `stok_in_distribusi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`my_root`@`%` SQL SECURITY DEFINER VIEW `stok_in_distribusi`  AS SELECT `bd`.`id_distribusi` AS `id_distribusi`, `bd`.`kd_barang` AS `kd_barang`, sum(`bd`.`jumlah`) AS `stok_in` FROM `tb_barang_distribusi` AS `bd` WHERE (`bd`.`jenis` = 'masuk') GROUP BY `bd`.`id_distribusi`, `bd`.`kd_barang``kd_barang`  ;

-- --------------------------------------------------------

--
-- Structure for view `stok_in_supplier`
--
DROP TABLE IF EXISTS `stok_in_supplier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`my_root`@`%` SQL SECURITY DEFINER VIEW `stok_in_supplier`  AS SELECT `bbs`.`id_supplier` AS `id_supplier`, `bbs`.`kd_bahan_baku` AS `kd_bahan_baku`, sum(`bbs`.`jumlah`) AS `stok_in` FROM `tb_bahan_baku_supplier` AS `bbs` WHERE (`bbs`.`jenis` = 'masuk') GROUP BY `bbs`.`id_supplier`, `bbs`.`kd_bahan_baku``kd_bahan_baku`  ;

-- --------------------------------------------------------

--
-- Structure for view `stok_out`
--
DROP TABLE IF EXISTS `stok_out`;

CREATE ALGORITHM=UNDEFINED DEFINER=`my_root`@`localhost` SQL SECURITY DEFINER VIEW `stok_out`  AS SELECT `in_out`.`kd_barang_or_bahan_baku` AS `kd_barang_or_bahan_baku`, sum(`in_out`.`jumlah`) AS `stok_out` FROM `tb_barang_masuk_keluar` AS `in_out` WHERE (`in_out`.`jenis_transaksi` in ('penjualan','keluar')) GROUP BY `in_out`.`kd_barang_or_bahan_baku``kd_barang_or_bahan_baku`  ;

-- --------------------------------------------------------

--
-- Structure for view `stok_out_distribusi`
--
DROP TABLE IF EXISTS `stok_out_distribusi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`my_root`@`%` SQL SECURITY DEFINER VIEW `stok_out_distribusi`  AS SELECT `bd`.`id_distribusi` AS `id_distribusi`, `bd`.`kd_barang` AS `kd_barang`, sum(`bd`.`jumlah`) AS `stok_out` FROM `tb_barang_distribusi` AS `bd` WHERE (`bd`.`jenis` = 'keluar') GROUP BY `bd`.`id_distribusi`, `bd`.`kd_barang``kd_barang`  ;

-- --------------------------------------------------------

--
-- Structure for view `stok_out_supplier`
--
DROP TABLE IF EXISTS `stok_out_supplier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`my_root`@`%` SQL SECURITY DEFINER VIEW `stok_out_supplier`  AS SELECT `bbs`.`id_supplier` AS `id_supplier`, `bbs`.`kd_bahan_baku` AS `kd_bahan_baku`, sum(`bbs`.`jumlah`) AS `stok_out` FROM `tb_bahan_baku_supplier` AS `bbs` WHERE (`bbs`.`jenis` = 'keluar') GROUP BY `bbs`.`id_supplier`, `bbs`.`kd_bahan_baku``kd_bahan_baku`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bahan_baku`
--
ALTER TABLE `tb_bahan_baku`
  ADD PRIMARY KEY (`id_bahan_baku`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `tb_bahan_baku_supplier`
--
ALTER TABLE `tb_bahan_baku_supplier`
  ADD PRIMARY KEY (`id_bahan_baku_supplier`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `kd_bahan_baku` (`kd_bahan_baku`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kd_barang` (`kd_barang`),
  ADD KEY `barang_to_satuan` (`id_satuan`),
  ADD KEY `barang_to_jenis` (`id_jenis`);

--
-- Indexes for table `tb_barang_distribusi`
--
ALTER TABLE `tb_barang_distribusi`
  ADD PRIMARY KEY (`id_barang_distribusi`),
  ADD KEY `id_distribusi` (`id_distribusi`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `tb_barang_masuk_keluar`
--
ALTER TABLE `tb_barang_masuk_keluar`
  ADD PRIMARY KEY (`id_barang_masuk_keluar`);

--
-- Indexes for table `tb_distribusi`
--
ALTER TABLE `tb_distribusi`
  ADD PRIMARY KEY (`id_distribusi`);

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_komposisi`
--
ALTER TABLE `tb_komposisi`
  ADD PRIMARY KEY (`id_komposisi`),
  ADD UNIQUE KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `tb_komposisi_detail`
--
ALTER TABLE `tb_komposisi_detail`
  ADD PRIMARY KEY (`id_komposisi_detail`),
  ADD KEY `id_komposisi` (`id_komposisi`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `pembelian_to_supplier` (`id_supplier`);

--
-- Indexes for table `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian_detail`),
  ADD KEY `pembelian_detail_to_pembelian` (`id_pembelian`);

--
-- Indexes for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD UNIQUE KEY `no_resi` (`no_resi`);

--
-- Indexes for table `tb_pengiriman_detail`
--
ALTER TABLE `tb_pengiriman_detail`
  ADD PRIMARY KEY (`id_pengiriman_detail`),
  ADD KEY `pengiriman_to_pengiriman_detail` (`id_pengiriman`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_distribudi` (`id_distribusi`);

--
-- Indexes for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`),
  ADD KEY `penjualan_detail_to_penjualan` (`id_penjualan`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `suppier_to_users` (`id_users`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `no_invoice` (`no_invoice`),
  ADD KEY `pembayaran_to_transaksi` (`id_pembayaran`);

--
-- Indexes for table `tb_t_komposisi`
--
ALTER TABLE `tb_t_komposisi`
  ADD PRIMARY KEY (`id_t_komposisi`);

--
-- Indexes for table `tb_t_pembelian`
--
ALTER TABLE `tb_t_pembelian`
  ADD PRIMARY KEY (`id_t_pembelian`);

--
-- Indexes for table `tb_t_penjualan`
--
ALTER TABLE `tb_t_penjualan`
  ADD PRIMARY KEY (`id_t_penjualan`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649FA06E4D9` (`id_users`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bahan_baku`
--
ALTER TABLE `tb_bahan_baku`
  MODIFY `id_bahan_baku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_bahan_baku_supplier`
--
ALTER TABLE `tb_bahan_baku_supplier`
  MODIFY `id_bahan_baku_supplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_barang_distribusi`
--
ALTER TABLE `tb_barang_distribusi`
  MODIFY `id_barang_distribusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_barang_masuk_keluar`
--
ALTER TABLE `tb_barang_masuk_keluar`
  MODIFY `id_barang_masuk_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_distribusi`
--
ALTER TABLE `tb_distribusi`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_komposisi`
--
ALTER TABLE `tb_komposisi`
  MODIFY `id_komposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_komposisi_detail`
--
ALTER TABLE `tb_komposisi_detail`
  MODIFY `id_komposisi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `id_pembelian_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengiriman_detail`
--
ALTER TABLE `tb_pengiriman_detail`
  MODIFY `id_pengiriman_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_t_komposisi`
--
ALTER TABLE `tb_t_komposisi`
  MODIFY `id_t_komposisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_t_pembelian`
--
ALTER TABLE `tb_t_pembelian`
  MODIFY `id_t_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_t_penjualan`
--
ALTER TABLE `tb_t_penjualan`
  MODIFY `id_t_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bahan_baku`
--
ALTER TABLE `tb_bahan_baku`
  ADD CONSTRAINT `jenis_to_bahan_baku` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id_jenis`),
  ADD CONSTRAINT `satuan_to_bahan_baku` FOREIGN KEY (`id_satuan`) REFERENCES `tb_satuan` (`id_satuan`);

--
-- Constraints for table `tb_bahan_baku_supplier`
--
ALTER TABLE `tb_bahan_baku_supplier`
  ADD CONSTRAINT `s_to_bbs` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`);

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `barang_to_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_to_satuan` FOREIGN KEY (`id_satuan`) REFERENCES `tb_satuan` (`id_satuan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_barang_distribusi`
--
ALTER TABLE `tb_barang_distribusi`
  ADD CONSTRAINT `d_to_bd` FOREIGN KEY (`id_distribusi`) REFERENCES `tb_distribusi` (`id_distribusi`);

--
-- Constraints for table `tb_komposisi`
--
ALTER TABLE `tb_komposisi`
  ADD CONSTRAINT `barang_to_komposisi` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`);

--
-- Constraints for table `tb_komposisi_detail`
--
ALTER TABLE `tb_komposisi_detail`
  ADD CONSTRAINT `k_to_kd` FOREIGN KEY (`id_komposisi`) REFERENCES `tb_komposisi` (`id_komposisi`) ON DELETE CASCADE;

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `pembelian_to_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`) ON DELETE CASCADE;

--
-- Constraints for table `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_to_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `tb_pembelian` (`id_pembelian`) ON DELETE CASCADE;

--
-- Constraints for table `tb_pengiriman_detail`
--
ALTER TABLE `tb_pengiriman_detail`
  ADD CONSTRAINT `pengiriman_to_pengiriman_detail` FOREIGN KEY (`id_pengiriman`) REFERENCES `tb_pengiriman` (`id_pengiriman`) ON DELETE CASCADE;

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `distribusi_to_penjualan` FOREIGN KEY (`id_distribusi`) REFERENCES `tb_distribusi` (`id_distribusi`);

--
-- Constraints for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_to_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD CONSTRAINT `suppier_to_users` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `pembayaran_to_transaksi` FOREIGN KEY (`id_pembayaran`) REFERENCES `tb_pembayaran` (`id_pembayaran`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
