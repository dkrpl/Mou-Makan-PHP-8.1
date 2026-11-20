-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2026 at 06:07 AM
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
-- Database: `insta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(10) NOT NULL,
  `id_karyawan` char(5) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `status` enum('in','out') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `id_karyawan`, `tgl`, `jam`, `status`) VALUES
(1, '00005', '2017-07-03', '19:01:35', 'in'),
(2, '00005', '2017-07-03', '19:02:36', 'out'),
(3, '00019', '2017-07-03', '19:04:28', 'in'),
(4, '00019', '2017-07-03', '19:05:00', 'out'),
(5, '00005', '2017-07-03', '19:06:58', 'in'),
(6, '00001', '2017-07-03', '19:07:20', 'in'),
(7, '00005', '2017-07-03', '19:07:26', 'out'),
(8, '00007', '2017-07-03', '19:07:31', 'out'),
(9, '00019', '2017-07-03', '19:08:58', 'in'),
(10, '00005', '2017-07-03', '19:14:14', 'in'),
(11, '00005', '2017-07-03', '19:14:19', 'in'),
(12, '00005', '2017-07-03', '19:14:25', 'in'),
(13, '00005', '2017-07-03', '19:15:29', 'in'),
(14, '00019', '2017-07-03', '19:15:47', 'in'),
(15, '00007', '2017-07-03', '19:18:46', 'in'),
(16, '00007', '2017-07-03', '19:18:52', 'in'),
(17, '00005', '2017-07-03', '19:39:51', 'in'),
(18, '00003', '2017-07-03', '19:44:53', 'in'),
(19, '00019', '2017-07-03', '19:56:28', 'out'),
(20, '00009', '2017-07-03', '19:56:32', 'in'),
(21, '00009', '2017-07-03', '19:57:12', 'out'),
(22, '00005', '2017-07-03', '20:02:39', 'out'),
(23, '00019', '2017-07-03', '20:07:16', 'out'),
(24, '00008', '2017-07-03', '20:07:27', 'in'),
(25, '00019', '2017-07-03', '20:07:36', 'out'),
(26, '00009', '2017-07-03', '20:08:19', 'out'),
(27, '00001', '2017-07-03', '20:08:58', 'out'),
(28, '00019', '2017-07-03', '20:10:40', 'out'),
(29, '00001', '2017-07-03', '20:14:26', 'in'),
(30, '00019', '2017-07-03', '20:14:53', 'out'),
(31, '00001', '2017-07-03', '20:15:03', 'out'),
(32, '00019', '2017-07-03', '20:27:07', 'out'),
(33, '00007', '2019-03-19', '18:36:33', 'in'),
(34, '00024', '2019-04-08', '20:34:05', 'in'),
(35, '00024', '2019-04-08', '20:34:17', 'out'),
(36, '00024', '2019-04-08', '20:34:29', 'in'),
(37, '00024', '2019-04-14', '11:38:08', 'in'),
(38, '00024', '2019-04-23', '15:00:44', 'in'),
(39, '00008', '2019-04-23', '15:15:43', 'in');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_booking`
--

CREATE TABLE `tb_booking` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `kode_meja` int(12) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_booking`
--

INSERT INTO `tb_booking` (`id`, `nama`, `tanggal`, `jam`, `kode_meja`, `alamat`, `no_hp`) VALUES
(5, 'deny', '0000-00-00', '00:00:00', 2, 'yghjg', 900),
(6, 'DESINTA PRAMITA', '0000-00-00', '00:00:00', 3, 'jokjlk', 909);

-- --------------------------------------------------------

--
-- Table structure for table `tb_det_transaksi`
--

CREATE TABLE `tb_det_transaksi` (
  `id_transaksi` varchar(30) NOT NULL,
  `id_pesanan` varchar(15) DEFAULT NULL,
  `nama_menu` varchar(60) DEFAULT NULL,
  `qty` int(3) DEFAULT NULL,
  `diskon` varchar(40) DEFAULT NULL,
  `total` varchar(40) DEFAULT NULL,
  `status` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_det_transaksi`
--

INSERT INTO `tb_det_transaksi` (`id_transaksi`, `id_pesanan`, `nama_menu`, `qty`, `diskon`, `total`, `status`) VALUES
('INSTA-2019042500001', '2019042500003', 'Cap Jay', 2, '0', '24000', 'yes'),
('INSTA-2019042500001', '2019042500004', 'Nasi Goreng Jepang', 2, '0', '30000', 'yes'),
('INSTA-2019042500002', '2019042500001', 'Cap Jay', 1, '0', '12000', 'yes'),
('INSTA-2019042500002', '2019042500002', 'Nasi Goreng Jepang', 2, '0', '30000', 'yes'),
('INSTA-2019042500003', '2019042500005', 'Nasi Goreng Jepang', 2, '0', '30000', 'yes'),
('INSTA-2019042500003', '2019042500006', 'Cap Jay', 1, '0', '12000', 'yes'),
('INSTA-2019042500004', '2019042500007', 'Cap Jay', 2, '0', '24000', 'yes'),
('INSTA-2019042500004', '2019042500008', 'Nasi Goreng Jepang', 1, '0', '15000', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` char(5) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(15) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `no_identitas` varchar(80) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `akses` enum('1','2','3') NOT NULL COMMENT '1=kasir,2=pramusaji,3=dapur',
  `aktif` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama`, `gender`, `alamat`, `hp`, `password`, `no_identitas`, `tgl_lahir`, `akses`, `aktif`) VALUES
('00008', 'DENOK PRAM', 'P', 'BADAS', '', 'e10adc3949ba59abbe56e057f20f883e', '', '0000-00-00', '2', 'yes'),
('00024', 'coba kasir', 'L', 'kediri', '0987664', 'e10adc3949ba59abbe56e057f20f883e', '0987654', '2017-07-06', '1', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kat` char(5) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `aktif` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kat`, `kategori`, `aktif`) VALUES
('00001', 'Dapur Masak', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_modal_awal`
--

CREATE TABLE `tb_log_modal_awal` (
  `id_karyawan` char(5) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `modal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_log_modal_awal`
--

INSERT INTO `tb_log_modal_awal` (`id_karyawan`, `tgl`, `jam`, `modal`) VALUES
('00024', '2019-04-14', '11:31:15', '200.000'),
('00024', '2019-04-18', '19:56:02', '300000'),
('00024', '2019-04-23', '14:49:34', '300.000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_pajak`
--

CREATE TABLE `tb_log_pajak` (
  `user` varchar(10) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `pajak` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_log_pajak`
--

INSERT INTO `tb_log_pajak` (`user`, `tgl`, `jam`, `pajak`) VALUES
('1', '2019-04-25', '09:46:19', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_sift`
--

CREATE TABLE `tb_log_sift` (
  `id_karyawan` char(5) NOT NULL,
  `tgl` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_log_sift`
--

INSERT INTO `tb_log_sift` (`id_karyawan`, `tgl`, `time`) VALUES
('00024', '2019-03-18', '10:41:47'),
('00024', '2019-03-24', '09:54:36'),
('00024', '2019-03-31', '00:27:33'),
('00024', '2019-04-05', '14:02:02'),
('00024', '2019-04-08', '09:41:26'),
('00024', '2019-04-13', '08:54:56'),
('00024', '2019-04-13', '08:58:04'),
('00024', '2019-04-13', '08:59:13'),
('00024', '2019-04-13', '12:28:08'),
('00024', '2019-04-14', '11:38:14'),
('00024', '2019-04-18', '19:49:16'),
('00024', '2019-04-18', '19:56:20'),
('00024', '2019-04-18', '21:37:47'),
('00024', '2019-04-23', '15:02:03'),
('00024', '2019-04-25', '14:38:11'),
('00024', '2019-04-25', '15:48:10'),
('00024', '2026-11-20', '11:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_meja`
--

CREATE TABLE `tb_meja` (
  `no_meja` char(5) NOT NULL,
  `meja` varchar(40) DEFAULT NULL,
  `dipesan` enum('yes','no') DEFAULT NULL,
  `digabung` char(5) DEFAULT NULL,
  `aktif` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_meja`
--

INSERT INTO `tb_meja` (`no_meja`, `meja`, `dipesan`, `digabung`, `aktif`) VALUES
('00001', 'MEJA 1/Resto', 'yes', 'no', 'yes'),
('00002', 'MEJA 2/Resto', 'no', 'no', 'yes'),
('00003', 'MEJA 3/Resto', 'no', 'no', 'yes'),
('00004', 'MEJA 4/Resto', 'no', 'no', 'yes'),
('00005', 'MEJA 5/Resto', 'no', 'no', 'yes'),
('00006', 'MEJA 6/Resto', 'no', 'no', 'yes'),
('00007', 'MEJA 7/Resto', 'no', 'no', 'no'),
('00008', 'MEJA 8/Resto', 'no', 'no', 'no'),
('00009', 'MEJA 9/Resto', 'no', 'no', 'no'),
('00010', 'MEJA 10/Resto', 'no', 'no', 'no'),
('00011', 'MEJA 11/Hall', 'no', 'no', 'yes'),
('00012', 'MEJA 12/Hall', 'no', 'no', 'yes'),
('00013', 'MEJA 13/Hall', 'no', 'no', 'yes'),
('00014', 'MEJA 14/Hall', 'no', 'no', 'yes'),
('00015', 'MEJA 15/Hall', 'no', 'no', 'no'),
('00016', 'MEJA 16/Catur', 'no', 'no', 'yes'),
('00017', 'MEJA 17/Catur', 'no', 'no', 'yes'),
('00018', 'MEJA 18/Catur', 'no', 'no', 'yes'),
('00019', 'MEJA 19/Catur', 'no', 'no', 'yes'),
('00020', 'MEJA 20/Catur', 'no', 'no', 'no'),
('00021', 'MEJA 21/Catur', 'no', 'no', 'no'),
('00022', 'MEJA 22/Catur', 'no', 'no', 'no'),
('00023', 'MEJA 23/Catur', 'no', 'no', 'no'),
('00024', 'MEJA 24/Catur', 'no', 'no', 'no'),
('00025', 'MEJA 25/Catur', 'no', 'no', 'no'),
('none', 'Tanpa Meja', 'no', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` char(5) NOT NULL,
  `kategori` char(5) NOT NULL,
  `nama_menu` varchar(60) NOT NULL,
  `gambar` tinytext DEFAULT NULL,
  `harga` int(10) NOT NULL,
  `aktif` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `kategori`, `nama_menu`, `gambar`, `harga`, `aktif`) VALUES
('00004', '00001', 'Nasi Goreng Jepang', '00004.jpg', 15000, 'yes'),
('00038', '00001', 'Cap Jay', '00038.jpg', 12000, 'yes'),
('00040', '00001', 'Cumi Tepung Goreng', '00040.jpg', 14000, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_modal_awal`
--

CREATE TABLE `tb_modal_awal` (
  `id_modal` char(1) NOT NULL,
  `modal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_modal_awal`
--

INSERT INTO `tb_modal_awal` (`id_modal`, `modal`) VALUES
('1', '300000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pajak`
--

CREATE TABLE `tb_pajak` (
  `id_pajak` tinyint(3) NOT NULL,
  `pajak` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pajak`
--

INSERT INTO `tb_pajak` (`id_pajak`, `pajak`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `kode_pesanan` varchar(25) DEFAULT NULL,
  `no_meja` char(5) DEFAULT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `menu` varchar(60) DEFAULT NULL,
  `qty` int(3) DEFAULT NULL,
  `harga` int(10) NOT NULL,
  `dibayar` enum('yes','no') DEFAULT NULL,
  `dimasak` enum('yes','no') DEFAULT NULL,
  `selesai` enum('yes','no') DEFAULT NULL,
  `pelayan` char(5) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `di_pesan_pukul` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`kode_pesanan`, `no_meja`, `nama_pelanggan`, `menu`, `qty`, `harga`, `dibayar`, `dimasak`, `selesai`, `pelayan`, `tanggal`, `di_pesan_pukul`) VALUES
('2019042500001', '00001', 'rudyekoprasetya', 'Cap Jay', 1, 12000, 'yes', 'no', 'no', '00008', '2019-04-25', '00:00:00'),
('2019042500002', '00001', 'rudyekoprasetya', 'Nasi Goreng Jepang', 2, 15000, 'yes', 'no', 'no', '00008', '2019-04-25', '00:00:00'),
('2019042500003', 'none', '-', 'Cap Jay', 2, 12000, 'yes', 'no', 'no', '00024', '2019-04-25', '00:00:00'),
('2019042500004', 'none', '-', 'Nasi Goreng Jepang', 2, 15000, 'yes', 'no', 'no', '00024', '2019-04-25', '00:00:00'),
('2019042500005', '00001', 'rudyekoprasetya', 'Nasi Goreng Jepang', 2, 15000, 'yes', 'no', 'no', '00008', '2019-04-25', '00:00:00'),
('2019042500006', '00001', 'rudyekoprasetya', 'Cap Jay', 1, 12000, 'yes', 'no', 'no', '00008', '2019-04-25', '00:00:00'),
('2019042500007', 'none', '-', 'Cap Jay', 2, 12000, 'yes', 'no', 'no', '00024', '2019-04-25', '00:00:00'),
('2019042500008', 'none', '-', 'Nasi Goreng Jepang', 1, 15000, 'yes', 'no', 'no', '00024', '2019-04-25', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sessions`
--

CREATE TABLE `tb_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_sessions`
--

INSERT INTO `tb_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5b0e56be02af3d06e2841b5008a968c4011d8fe3', '::1', 1556007421, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030373132303b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('37569a6c66490a01144a62d5a7c4aa91e13161bc', '::1', 1556007704, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030373439323b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('762664dddb19dfdbbd85e9c739f76a369c89584e', '::1', 1556008543, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030383435393b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('0d1184236737ac205c673b4ac7de5294779e1956', '::1', 1556005790, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030353634353b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('8ef074c7f36c1f19ff7942f0a9e3fb21c0a7243c', '::1', 1556006405, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030363037323b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('c5b0de0d89ca3e97c0702cbc8ed49c32ed3f67ce', '::1', 1556006699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030363431303b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('4a72f597b93212f518536a54f13f8c9186a1d080', '::1', 1556009007, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030383831323b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('2305c043df2704c00e364a0c76a2edda58b69227', '::1', 1556009177, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363030393132343b),
('549bd66649b6b445e63ec1a8b572b5db11dccba8', '::1', 1556153709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363135333432373b757365726e616d657c733a353a223030303038223b616b7365737c733a313a2232223b6c6f676765645f696e7c623a313b),
('cf1439b94710fd6b81426dcf55e14281f9017f59', '::1', 1556153998, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363135333736363b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('0dac342016c705861477c1ddff1f65b0b325a8eb', '::1', 1556158877, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363135383631333b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('a5f29ee91fedb00257428a8c673bb8d5ece929e2', '::1', 1556159093, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363135383939353b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('414c63d5d8d0474b852397d1c971c47a40356db1', '::1', 1556160113, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363135393831353b),
('fe923385017a48c91781a2ceab56aecd64dafae1', '::1', 1556160470, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136303137323b),
('d33c4925f05319c5b1db816e1d5af84d77993ef6', '::1', 1556160595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136303437363b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('aa9298fdf8325d578d5d048da7ceb98d175ccd87', '::1', 1556161218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136303936303b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('d380db26f3001eedd136e5ac59b5775ea12ce01d', '::1', 1556161402, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136313334313b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('f61ee476b3be756e29997e4ec45f6c4a65620974', '::1', 1556161946, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136313730373b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b693a34383030303b733a31313a22746f74616c5f6974656d73223b693a343b733a33323a226239353861326234366131343263316262303465393064366437356338326561223b613a373a7b733a353a22726f776964223b733a33323a226239353861326234366131343263316262303465393064366437356338326561223b733a323a226964223b733a353a223030303338223b733a343a226e616d65223b733a373a22436170204a6179223b733a333a22717479223b733a313a2234223b733a353a227072696365223b733a353a223132303030223b733a363a226f7074696f6e223b613a313a7b733a343a2264697363223b733a393a22756e646566696e6564223b7d733a383a22737562746f74616c223b693a34383030303b7d7d),
('66fc6b8db1c62bd87c1db7faa49ccce552bacc12', '::1', 1556162370, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136323133303b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('863e65922741b644367aea6e1a070743888c0c92', '::1', 1556162722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136323436323b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('2da882fba2ccf86b9b0f09978b2ad8d752d40acf', '::1', 1556163538, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136333233333b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('7ee6cdfb12cd52737af69b41913d9dc2061f6c14', '::1', 1556163658, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136333534393b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('d82d382948fff9fbe51890fab4ccc0e86d233d02', '::1', 1556163941, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136333839313b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('d827f2b6a6aa5cc0dbfec5abcdd63b00b75d41c5', '::1', 1556162997, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136323830343b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('94dda6833254d7ce07c5fb737ee83d845d332c5e', '::1', 1556165672, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363136353339383b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('4ef8a86727f37877a4bf7591b048d9acc67e16a3', '::1', 1556170843, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137303538323b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('6d9768e1dd04b50c3fb63f3ba2ce6bef08e87cb4', '::1', 1556171262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137303939383b757365726e616d657c733a353a223030303038223b616b7365737c733a313a2232223b6c6f676765645f696e7c623a313b),
('03f1370222fb4902412249cf5d1606fb959838fc', '::1', 1556171309, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137313036313b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('da6cf9a4c614de614a6982b1e4a1a66c7cd901e9', '::1', 1556171922, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137313638393b757365726e616d657c733a353a223030303038223b616b7365737c733a313a2232223b6c6f676765645f696e7c623a313b),
('c4fcf9e3ffb2af256f731a6b2a2ce091f91e5eb7', '::1', 1556177887, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137373537343b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('936e3cffa1765bd33124498114051001c2a933a9', '::1', 1556177912, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137373839313b),
('bba79c65514d00d26a677d9fa309ad31f9226ee6', '::1', 1556180004, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137393935363b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('b084f05985fc3dba836883b0dd0362ffd2c0ed2d', '::1', 1556172223, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137313933313b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('856a692be603c1bfbdfb9f7adb5fd0822ad0b6ae', '::1', 1556172141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137323037343b757365726e616d657c733a353a223030303038223b616b7365737c733a313a2232223b6c6f676765645f696e7c623a313b),
('81c7fdde06d5c52e424e3473be7c69f90fd31c17', '::1', 1556172932, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137323839323b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('e7b0ded045ad5afef083139ac3b9acf43622afab', '::1', 1556177044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137363634363b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('7854347dd567bdb9b8434fd867a638c6f81530af', '::1', 1556180747, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137373035373b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('0046c77c328ce64e00045e105e8877f482d1aa37', '::1', 1556177568, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363137373039373b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('26cc1480fde3dee7c10e44011a23399413e423c7', '::1', 1556182000, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138313733373b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('b8127a4f6261956eb00f2d3240d9ee74328a67e5', '::1', 1556182163, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138323032323b),
('c760a551747e48c8748d8545034628f8a6a8d28b', '::1', 1556182293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138323232343b),
('52593c3e34e9a502acfc2084f3e838b251163c63', '::1', 1556187343, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138373032383b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('4a36e7dba4ce30189801e0627b5718237d5bb2a3', '::1', 1556187379, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138373039363b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('57e83aef314b6e8c1ba43c7742a2b40662478f32', '::1', 1556187593, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138373339373b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('4e8dec3a3734034c3426d0af83a8fdf6c9970721', '::1', 1556189027, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138393032373b),
('ca8e4a1e02c340a358da01acdad5189a713e1119', '::1', 1556189044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138393034343b),
('0b7fc4343af243e1245295bf4d3dc2b3da0d6d0e', '::1', 1556243667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363234333636373b),
('20ff774163b33329e51c6edf3aabd4df26910ba7', '::1', 1556187361, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363138373336313b757365726e616d657c733a353a223030303234223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('fd2tbhaend3b6807b947d6p7u1phfv3u', '127.0.0.1', 1795150239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313739353135303233383b757365726e616d657c733a313a2231223b616b7365737c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('0vik9i9ctgck5rfs3nt7bb8to3hn0560', '127.0.0.1', 1795150239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313739353135303233393b757365726e616d657c733a353a223030303234223b6e616d617c733a31303a22636f6261206b61736972223b616b7365737c733a313a2231223b6c6f676765645f696e7c623a313b),
('e56e64983e3d5128de1669d4d748c325fbf469af', '::1', 1795151242, 0x5f5f63695f6c6173745f726567656e65726174657c693a313739353135313232323b);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` varchar(30) NOT NULL,
  `id_pesanan` varchar(25) NOT NULL,
  `id_karyawan` char(5) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `diskon` varchar(40) NOT NULL,
  `pajak` varchar(40) NOT NULL DEFAULT '0',
  `total` varchar(40) NOT NULL,
  `total_kena_pajak` varchar(40) DEFAULT NULL,
  `status` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pesanan`, `id_karyawan`, `tgl`, `jam`, `diskon`, `pajak`, `total`, `total_kena_pajak`, `status`) VALUES
('INSTA-2019042500001', '2019042500003', '00024', '2019-04-25', '13:03:26', '0', '2700', '54000', '56700', 'yes'),
('INSTA-2019042500001', '2019042500004', '00024', '2019-04-25', '13:03:26', '0', '2700', '54000', '56700', 'yes'),
('INSTA-2019042500002', '2019042500001', '00024', '2019-04-25', '14:33:07', '0', '2100', '12000', '44100', 'yes'),
('INSTA-2019042500002', '2019042500002', '00024', '2019-04-25', '14:33:07', '0', '2100', '42000', '44100', 'yes'),
('INSTA-2019042500003', '2019042500005', '00024', '2019-04-25', '17:13:51', '0', '2100', '30000', '44100', 'yes'),
('INSTA-2019042500003', '2019042500006', '00024', '2019-04-25', '17:13:51', '0', '2100', '42000', '44100', 'yes'),
('INSTA-2019042500004', '2019042500007', '00024', '2019-04-25', '17:15:43', '0', '1950', '39000', '40950', 'yes'),
('INSTA-2019042500004', '2019042500008', '00024', '2019-04-25', '17:15:43', '0', '1950', '39000', '40950', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meja` (`kode_meja`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`no_meja`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `nama_menu` (`nama_menu`);

--
-- Indexes for table `tb_modal_awal`
--
ALTER TABLE `tb_modal_awal`
  ADD PRIMARY KEY (`id_modal`);

--
-- Indexes for table `tb_pajak`
--
ALTER TABLE `tb_pajak`
  ADD PRIMARY KEY (`id_pajak`);

--
-- Indexes for table `tb_sessions`
--
ALTER TABLE `tb_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_booking`
--
ALTER TABLE `tb_booking`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pajak`
--
ALTER TABLE `tb_pajak`
  MODIFY `id_pajak` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
