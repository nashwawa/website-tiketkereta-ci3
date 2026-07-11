-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2026 at 09:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_kereta`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `detail_pemesanan_id` int(11) NOT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `penumpang_id` int(11) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `status` enum('aktif','batal') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`detail_pemesanan_id`, `pemesanan_id`, `penumpang_id`, `kode`, `status`) VALUES
(1, 9, 26, 'KODE68d0eca584c8d', 'aktif'),
(2, 10, 27, 'KODE68d1e02d5c716', 'aktif'),
(3, 11, 28, 'KODE68d1e2b46e585', 'aktif'),
(4, 12, 29, 'KODE68d224149328f', 'aktif'),
(5, 13, 30, 'KODE68d255547efe8', 'aktif'),
(6, 14, 31, 'KODE68e31b6342c2b', 'aktif'),
(7, 15, 32, 'KODE68f083fc77bd1', 'aktif'),
(8, 16, 33, 'KODE69150efd0fb23', 'aktif'),
(9, 17, 34, 'KODE6915122c8a8f4', 'aktif'),
(10, 18, 35, 'KODE69198e0d4806f', 'aktif'),
(11, 19, 36, 'KODE6919d8ee2bebd', 'aktif'),
(12, 20, 37, 'KODE691a974365ae4', 'aktif'),
(13, 21, 38, 'KODE6a4a3cd6379c1', 'aktif'),
(14, 22, 39, 'KODE6a51ee2b7ac08', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `gerbong`
--

CREATE TABLE `gerbong` (
  `gerbong_id` int(11) NOT NULL,
  `kereta_id` int(11) DEFAULT NULL,
  `jumlah_kursi` int(11) DEFAULT NULL,
  `nama_kode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gerbong`
--

INSERT INTO `gerbong` (`gerbong_id`, `kereta_id`, `jumlah_kursi`, `nama_kode`) VALUES
(1, 1, 14, 'r1'),
(2, 2, 50, 'r1');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `kereta_id` int(11) DEFAULT NULL,
  `jam_berangkat` datetime DEFAULT NULL,
  `jam_sampai` datetime DEFAULT NULL,
  `stasiun_awal` varchar(100) DEFAULT NULL,
  `stasiun_akhir` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`jadwal_id`, `kereta_id`, `jam_berangkat`, `jam_sampai`, `stasiun_awal`, `stasiun_akhir`, `harga`) VALUES
(1, 1, '2025-09-15 12:24:00', '2025-09-17 12:25:00', 'solo', 'jogja', '45000.00'),
(2, 1, '2025-09-21 14:25:00', '2025-09-21 15:26:00', 'solo', 'jogja', '40000.00'),
(3, 2, '2025-10-06 07:25:00', '2025-10-06 08:25:00', 'solo', 'klaten ', '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `kereta_id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jumlah_gerbong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kereta`
--

INSERT INTO `kereta` (`kereta_id`, `nama`, `jumlah_gerbong`) VALUES
(1, 'riyadi', 13),
(2, 'kusumo', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jumlah_penumpang` int(11) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `status_pembayaran` enum('belum_bayar','menunggu_konfirmasi','lunas') DEFAULT 'belum_bayar',
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_id`, `jadwal_id`, `user_id`, `jumlah_penumpang`, `total_harga`, `status_pembayaran`, `metode_pembayaran`, `bukti_pembayaran`) VALUES
(1, 2, NULL, 2, '80000.00', 'belum_bayar', NULL, NULL),
(2, 2, NULL, 2, '80000.00', 'belum_bayar', NULL, NULL),
(3, 2, NULL, 2, '80000.00', 'belum_bayar', NULL, NULL),
(4, 2, NULL, 2, '80000.00', 'belum_bayar', NULL, NULL),
(9, 2, 1, 1, '40000.00', 'lunas', 'Transfer Bank', 'b999f0d74a26e1906ffcfa43ada5eb7f-removebg-preview.png'),
(10, 2, 1, 1, '40000.00', 'belum_bayar', NULL, NULL),
(11, 2, 1, 1, '40000.00', 'belum_bayar', NULL, NULL),
(12, 2, 7, 1, '40000.00', 'lunas', 'QRIS', 'download_(31).jpg'),
(13, 2, 1, 1, '40000.00', 'lunas', 'Transfer Bank', 'b999f0d74a26e1906ffcfa43ada5eb7f-removebg-preview1.png'),
(14, 3, 1, 1, '20000.00', 'lunas', 'E-Wallet', 'pamflet_kesaktian_pancasila.jpg'),
(15, 2, 1, 1, '40000.00', 'lunas', 'QRIS', 'Screenshot_2025-10-16_043326.png'),
(16, 2, 10, 1, '40000.00', 'lunas', 'Transfer Bank', 'WhatsApp_Image_2025-11-11_at_19_44_21.jpeg'),
(17, 2, 10, 1, '40000.00', 'menunggu_konfirmasi', 'Transfer Bank', 'WhatsApp_Image_2025-11-03_at_04_47_06.jpeg'),
(18, 2, 1, 1, '40000.00', 'belum_bayar', NULL, NULL),
(19, 2, NULL, 1, '40000.00', 'belum_bayar', NULL, NULL),
(20, 2, 1, 1, '40000.00', 'belum_bayar', NULL, NULL),
(21, 1, NULL, 1, '45000.00', 'menunggu_konfirmasi', 'Transfer Bank', 'Screenshot_2026-05-06_084457.png'),
(22, 1, NULL, 1, '45000.00', 'menunggu_konfirmasi', 'QRIS', 'Safari_Bags,_Safari_Animal_Bags,_Jungle_Goody_Bags,_Safari_Birthday,_S.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `penumpang_id` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `no_tlp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`penumpang_id`, `nik`, `nama`, `email`, `no_tlp`) VALUES
(1, '0025', 'nashwa', '', 0),
(2, '00987654321', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(3, '00987654321', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(4, '00976675339009', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(5, '00987654321', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(6, '00987654321', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(7, '00976675339009', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(8, '00987654321', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(9, '00976675339009', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(10, '00987654321', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(11, '00976675339009', 'nashwa', 'nashwasarita@gmail.com', 2147483647),
(12, '00987654321', 'nashwa', 'chiquita123@gmail.com', 2147483647),
(13, '00976675339009', 'nashwa', 'chiquita123@gmail.com', 2147483647),
(14, '00987654321', 'nashwa', 'chiquita123@gmail.com', 2147483647),
(15, '00976675339009', 'nashwa', 'chiquita123@gmail.com', 2147483647),
(16, '1234567', 'wawa', 'Nfwyeb6363@esann.tech', 2147483647),
(17, '00976675339009', 'nashwa', 'Nfwyeb6363@esann.tech', 2147483647),
(18, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(19, '00976675339009', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(20, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(21, '00976675339009', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(22, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(23, '00976675339009', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(24, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(25, '00976675339009', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(26, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(27, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(28, '00987654321', 'nashwa', 'kwlee0128@gmail.com', 2147483647),
(29, '00987654321', 'novi', 'nashwasaritaputri@gmail.com', 2147483647),
(30, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(31, '3313106503080003', 'wawa', 'nashwasarita@gmial.com', 2147483647),
(32, '00987654321', 'nashwa', 'nashwasaritaputri@gmail.com', 2147483647),
(33, '00987654321', 'wawa', 'kwlee0128@gmail.com', 2147483647),
(34, '00987654321', 'wowoo', 'kwlee0128@gmail.com', 2147483647),
(35, '00987654321', 'wawa', 'nashwasarita@gmail.com', 2147483647),
(36, '3678', 'wowo', 'nashwasarita@gmail.com', 2147483647),
(37, '234', 'dfver', 'chiquita123@gmail.com', 12345),
(38, '1234', 'rww', 'wygfw@hmail.com', 2147483647),
(39, '08233714134', 'ninsi', 'ninsi@gmial.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `nik`, `no_telp`, `password`, `role`) VALUES
(1, 'nashwa', '0025', '081233758482', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(3, 'wawa', '0023', '08238532341', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(4, 'juna', NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(7, 'novi', NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(10, 'wowoo', NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`detail_pemesanan_id`),
  ADD KEY `pemesanan_id` (`pemesanan_id`),
  ADD KEY `penumpang_id` (`penumpang_id`);

--
-- Indexes for table `gerbong`
--
ALTER TABLE `gerbong`
  ADD PRIMARY KEY (`gerbong_id`),
  ADD KEY `kereta_id` (`kereta_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `kereta_id` (`kereta_id`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`kereta_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `jadwal_id` (`jadwal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`penumpang_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `detail_pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gerbong`
--
ALTER TABLE `gerbong`
  MODIFY `gerbong_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kereta`
--
ALTER TABLE `kereta`
  MODIFY `kereta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `penumpang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`pemesanan_id`),
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`penumpang_id`) REFERENCES `penumpang` (`penumpang_id`);

--
-- Constraints for table `gerbong`
--
ALTER TABLE `gerbong`
  ADD CONSTRAINT `gerbong_ibfk_1` FOREIGN KEY (`kereta_id`) REFERENCES `kereta` (`kereta_id`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`kereta_id`) REFERENCES `kereta` (`kereta_id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`jadwal_id`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
