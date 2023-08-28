-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 02:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi-absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_absensi`
--

CREATE TABLE `data_absensi` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `tgl_absen` datetime NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kegiatan` varchar(1200) NOT NULL,
  `attachment` varchar(250) NOT NULL,
  `alasan` varchar(1200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_absensi`
--

INSERT INTO `data_absensi` (`id`, `id_users`, `tgl_absen`, `keterangan`, `kegiatan`, `attachment`, `alasan`, `created_at`) VALUES
(1, 5, '2023-08-19 09:47:19', '1', 'asd', 'attachment.png', '', '2023-08-21 15:44:42'),
(12, 5, '2023-08-23 21:00:35', '1', '', '64e6110332347.png', '', '2023-08-23 14:00:35'),
(17, 5, '2023-08-26 14:14:36', '1', 'Test Absen From dashboard', '64e9a65c3cacd.png', '', '2023-08-26 07:14:36'),
(18, 6, '2023-08-26 14:15:27', '1', 'Test Absen From Public Edi', '64e9ab07376b5.png', '', '2023-08-28 07:47:54'),
(19, 6, '2023-08-28 08:01:40', '1', 'input data kecamatan batang hari leko', '64ebf1f47ce79.jpg', '', '2023-08-28 01:01:40'),
(20, 7, '2023-08-28 08:07:29', '1', 'maen hp', '64ebf351132f0.jpg', '', '2023-08-28 08:18:47'),
(21, 5, '2023-08-28 12:04:40', '1', 'input data', '64ec2ae8bde28.jpg', '', '2023-08-28 05:04:40'),
(22, 8, '2023-08-28 15:03:03', '1', 'maen ps lt 2', '64ec54b7de82a.jpg', '', '2023-08-28 08:04:10'),
(23, 10, '2023-08-28 15:38:15', '2', '', '64ec5cf71a08b.jpg', 'cuti', '2023-08-28 08:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `data_peserta`
--

CREATE TABLE `data_peserta` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `asal` varchar(120) NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '1:tidak aktif, 0:aktif',
  `id_lokasi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_peserta`
--

INSERT INTO `data_peserta` (`id`, `users_id`, `nama`, `tgl_masuk`, `tgl_keluar`, `asal`, `is_active`, `id_lokasi`, `created_at`, `deleted_at`) VALUES
(1, 5, 'User Biasa Edit', '2023-08-14', '2023-10-13', 'Politeknik Sekayu', 0, 1, '2023-08-19 02:18:28', '2023-08-18 14:13:04'),
(3, 5, 'User Biasa', '2023-08-07', '2023-09-08', 'Politeknik Sekayu', 0, 1, '2023-08-19 02:32:30', '2023-08-19 02:32:30'),
(4, 5, 'Aliya Novita Sari', '2023-07-04', '2023-08-31', 'Politeknik Sekayu', 0, 16, '2023-08-21 07:51:56', NULL),
(5, 6, 'Anggraini Agustin Saputri', '2023-07-04', '2023-08-31', 'Politeknik Sekayu', 0, 1, '2023-08-21 08:17:49', NULL),
(6, 7, 'M.Raka Saputra', '2023-07-04', '2023-08-31', 'Politeknik Sekayu', 0, 1, '2023-08-21 08:18:03', NULL),
(7, 8, 'M.Alfito Anugrah', '2023-07-04', '2023-08-31', 'Politeknik Sekayu', 0, 16, '2023-08-21 08:18:14', NULL),
(8, 10, 'Frengky', '2023-06-05', '2023-09-04', 'Universitas Bina Darma', 0, 4, '2023-08-27 14:43:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_lokasi`
--

CREATE TABLE `master_lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_lokasi`
--

INSERT INTO `master_lokasi` (`id`, `nama`, `created_at`, `deleted_at`) VALUES
(1, 'Aptika (Aplikasi dan teknologi Informatika)', '2023-08-18 06:13:42', NULL),
(2, 'Informasi Publik', '2023-08-18 14:47:06', NULL),
(3, 'Sekretariat', '2023-08-18 14:48:58', NULL),
(4, 'Persandian', '2023-08-18 14:58:37', NULL),
(5, 'nama edit', '2023-08-18 15:00:39', '2023-08-18 15:18:07'),
(6, 'Persandian 3', '2023-08-18 15:01:52', '2023-08-18 15:02:21'),
(7, 'Persaindian 3', '2023-08-18 15:02:34', '2023-08-18 15:18:30'),
(8, 'nama', '2023-08-18 15:06:04', '2023-08-18 15:18:25'),
(9, 'asd', '2023-08-18 15:06:29', '2023-08-18 15:18:20'),
(10, 'asd', '2023-08-18 15:08:47', '2023-08-18 15:18:16'),
(11, 'asd', '2023-08-18 15:09:01', '2023-08-18 15:18:12'),
(12, 'Informasi Publik 2', '2023-08-18 15:09:54', '2023-08-18 15:16:18'),
(13, 'Informasi Publik 2', '2023-08-18 15:10:11', '2023-08-18 15:16:14'),
(14, 'Informasi Publik 3', '2023-08-18 15:11:02', '2023-08-18 15:16:08'),
(15, 'Ruang Radio Gema Randik', '2023-08-19 14:47:04', NULL),
(16, 'Statistik Sektoral', '2023-08-21 14:49:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_status`
--

CREATE TABLE `master_status` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_status`
--

INSERT INTO `master_status` (`id`, `nama`, `created_at`, `deleted_at`) VALUES
(1, 'Hadir', '2023-08-19 02:50:16', NULL),
(2, 'Izin', '2023-08-19 02:50:16', NULL),
(3, 'Sakit', '2023-08-19 02:50:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `level` int(2) NOT NULL COMMENT '0:User Biasa, 1:Super User',
  `foto` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `foto`, `created_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', '12345', 1, 'example.png', '2023-08-27 14:28:39', NULL),
(3, 'Sifulan', 'sifulan', 'sifulan123', 0, '64df43574942d.png', '2023-08-18 10:13:31', '2023-08-18 10:13:31'),
(5, 'Aliya Novita Sari', 'Aliya ', '12345', 0, '64df475f3f78b.jpg', '2023-08-21 08:10:16', NULL),
(6, 'Anggraini Agustin Saputri', 'Anggraini ', '12345', 0, '64e31ad29d237.jpg', '2023-08-21 08:10:27', NULL),
(7, 'M.Raka Saputra', 'Raka ', '9304', 0, '64e31b2f28ad6.jpeg', '2023-08-28 08:34:37', NULL),
(8, 'M.Alfito Anugrah', 'Alfito ', '12345', 0, '64e31b7e2ac37.jpeg', '2023-08-28 08:34:48', NULL),
(10, 'Frengky', 'Frengky', '12345', 0, '64eb60409c85f.jpg', '2023-08-27 14:40:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_absensi`
--
ALTER TABLE `data_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_peserta`
--
ALTER TABLE `data_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_status`
--
ALTER TABLE `master_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_absensi`
--
ALTER TABLE `data_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `data_peserta`
--
ALTER TABLE `data_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_status`
--
ALTER TABLE `master_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
