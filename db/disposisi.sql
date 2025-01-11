-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2024 at 04:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disposisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bagian`
--

CREATE TABLE `tbl_bagian` (
  `id_bagian` int(10) NOT NULL,
  `bagian_nama` varchar(255) DEFAULT NULL,
  `lembaga_id` varchar(255) NOT NULL,
  `bagian_create` datetime DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bagian`
--

INSERT INTO `tbl_bagian` (`id_bagian`, `bagian_nama`, `lembaga_id`, `bagian_create`, `user_id`) VALUES
(1, 'Seksi Bimas Islam', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2023-01-23 00:01:24', 2023010100001),
(2, 'Seksi PAKIS', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2023-01-23 00:01:27', 2023010100001),
(3, 'Seksi Sekolah', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2024-08-10 21:06:21', 2023010100001),
(4, 'Seksi HAJI', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2023-01-23 00:01:31', 2023010100001),
(5, 'Seksi Syariah', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2023-01-23 00:01:33', 2023010100001),
(6, 'Sub Bang TU', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2023-01-23 00:01:34', 2023010100001),
(7, 'Staf', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2023-01-23 00:01:37', 2023010100001),
(8, 'Kepala Sekolah', 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', '2024-08-10 21:04:33', 2023010100001);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lampiran`
--

CREATE TABLE `tbl_lampiran` (
  `id_lampiran` int(10) NOT NULL,
  `token_lampiran` varchar(100) NOT NULL,
  `nama_berkas` text,
  `ukuran` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lampiran`
--

INSERT INTO `tbl_lampiran` (`id_lampiran`, `token_lampiran`, `nama_berkas`, `ukuran`) VALUES
(1, '3f2e8ff3d57701754adaeaa4470fd51f', '2024-08-10_SM_1723299789.pdf', '402.58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lembaga`
--

CREATE TABLE `tbl_lembaga` (
  `id` int(2) NOT NULL,
  `id_lembaga` varchar(255) NOT NULL,
  `nm_lembaga` varchar(255) DEFAULT NULL,
  `telp` text,
  `alamat` text,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `nm_kepala` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `lembaga_status` int(1) NOT NULL,
  `kop_1` text,
  `kop_2` text,
  `foto` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lembaga`
--

INSERT INTO `tbl_lembaga` (`id`, `id_lembaga`, `nm_lembaga`, `telp`, `alamat`, `website`, `email`, `tahun`, `kabupaten`, `provinsi`, `nm_kepala`, `nip`, `jabatan`, `lembaga_status`, `kop_1`, `kop_2`, `foto`, `id_user`) VALUES
(1, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'SMKN 1 AROSBAYA', '031 3052003', 'JL. RAYA AROSBAYA NO. 1', 'https://smkn1arosbaya.sch.id', 'smkn1arosbaya@gmail.com', 2024, 'Bangkalan', 'Jawa Timur', 'RITA OKTAVIANTY, S,Pd., M.Psi.', '197010101993021001', 'Kepala', 1, '', 'SMKN 1 AROSBAYA', 'profil_1719158776.png', 2023010100007);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ska`
--

CREATE TABLE `tbl_ska` (
  `id_ska` int(11) NOT NULL,
  `ska_no_awal` varchar(10255) DEFAULT NULL,
  `ska_no_urut` varchar(255) DEFAULT NULL,
  `ska_no_surat` varchar(255) DEFAULT NULL,
  `ska_lampiran` varchar(255) DEFAULT NULL,
  `ska_sifat` varchar(255) DEFAULT NULL,
  `ska_hal` varchar(255) DEFAULT NULL,
  `ska_tanggal` date DEFAULT NULL,
  `ska_kpd` text,
  `ska_text_pembuka` text,
  `ska_isi` text,
  `ska_text_penutup` text,
  `ska_tembusan` text,
  `ska_jenis` int(11) DEFAULT NULL,
  `ska_bagian` int(11) DEFAULT NULL,
  `ska_dibaca` int(1) DEFAULT NULL,
  `ska_tgl_kasi` date DEFAULT NULL,
  `ska_tgl_ktu` date DEFAULT NULL,
  `ska_tgl_kepala` date DEFAULT NULL,
  `ska_kasi_ctt` text,
  `ska_ktu_ctt` text,
  `ska_kepala_ctt` text,
  `ska_create` datetime DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ska`
--

INSERT INTO `tbl_ska` (`id_ska`, `ska_no_awal`, `ska_no_urut`, `ska_no_surat`, `ska_lampiran`, `ska_sifat`, `ska_hal`, `ska_tanggal`, `ska_kpd`, `ska_text_pembuka`, `ska_isi`, `ska_text_penutup`, `ska_tembusan`, `ska_jenis`, `ska_bagian`, `ska_dibaca`, `ska_tgl_kasi`, `ska_tgl_ktu`, `ska_tgl_kepala`, `ska_kasi_ctt`, `ska_ktu_ctt`, `ska_kepala_ctt`, `ska_create`, `user_id`) VALUES
(1, '10', NULL, '4', '2', 'Penting', 'Penting', '2024-08-10', '2', NULL, '<p>jkjsa</p>\r\n', NULL, '1', 1, 200, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-10 20:36:11', 2023010100007),
(2, '10', NULL, '200645668786724', '2', 'Penting', 'Penting', '2024-08-10', '1', NULL, '<p>Assalamualaikum</p>\r\n', NULL, '2', 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-10 20:42:45', 2023010100021);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sm`
--

CREATE TABLE `tbl_sm` (
  `id_sm` bigint(20) NOT NULL,
  `sm_no_urut` text,
  `sm_penerima` text,
  `sm_tgl_diterima` date DEFAULT NULL,
  `sm_sifat` varchar(255) DEFAULT NULL,
  `sm_no_surat_asal` text,
  `sm_tgl_surat` date DEFAULT NULL,
  `sm_pengirim` text,
  `sm_perihal` text,
  `sm_lampiran` varchar(255) DEFAULT NULL,
  `sm_status` varchar(255) DEFAULT NULL,
  `token_lampiran` varchar(255) DEFAULT NULL,
  `sm_tgl_ajuan` date DEFAULT NULL,
  `sm_ktu_ctt` text,
  `sm_segera` text,
  `sm_biasa` text,
  `sm_catatan` text,
  `sm_bagian` int(2) DEFAULT NULL,
  `sm_tgl_kepala` date DEFAULT NULL,
  `sm_tgl_disposisi` date DEFAULT NULL,
  `sm_disposisi` text,
  `sm_kasi_ctt` text,
  `sm_dibaca` int(1) DEFAULT NULL,
  `sm_create` datetime NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sm`
--

INSERT INTO `tbl_sm` (`id_sm`, `sm_no_urut`, `sm_penerima`, `sm_tgl_diterima`, `sm_sifat`, `sm_no_surat_asal`, `sm_tgl_surat`, `sm_pengirim`, `sm_perihal`, `sm_lampiran`, `sm_status`, `token_lampiran`, `sm_tgl_ajuan`, `sm_ktu_ctt`, `sm_segera`, `sm_biasa`, `sm_catatan`, `sm_bagian`, `sm_tgl_kepala`, `sm_tgl_disposisi`, `sm_disposisi`, `sm_kasi_ctt`, `sm_dibaca`, `sm_create`, `user_id`) VALUES
(1, '201', '201', '2024-08-10', 'Segera', '20987654321', '2024-08-10', 'Universitas Trunojoyo Madura', 'Surat Izin Penelitian', '-', 'Asli', '3f2e8ff3d57701754adaeaa4470fd51f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-10 21:08:09', 2023010100007);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` bigint(20) NOT NULL,
  `lembaga_id` varchar(255) NOT NULL,
  `pegawai_nama` varchar(255) DEFAULT NULL,
  `pegawai_tempat_lahir` varchar(255) DEFAULT NULL,
  `pegawai_tanggal_lahir` date DEFAULT NULL,
  `pegawai_jk` varchar(1) DEFAULT NULL,
  `pegawai_pdd` varchar(255) DEFAULT NULL,
  `pegawai_telp` varchar(13) DEFAULT NULL,
  `pegawai_email` varchar(255) DEFAULT NULL,
  `pegawai_foto` varchar(255) DEFAULT NULL,
  `pegawai_alamat` text,
  `pegawai_jenis` int(1) DEFAULT NULL,
  `pegawai_pangkat` varchar(255) DEFAULT NULL,
  `pegawai_nip` varchar(255) DEFAULT NULL,
  `pegawai_password` text NOT NULL,
  `pegawai_level` enum('admin','petugas','ktu','kepala','kasi','staf','jfu') DEFAULT NULL,
  `pegawai_status` int(1) DEFAULT NULL,
  `pegawai_create` datetime DEFAULT NULL,
  `pegawai_login` datetime DEFAULT NULL,
  `bagian_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `lembaga_id`, `pegawai_nama`, `pegawai_tempat_lahir`, `pegawai_tanggal_lahir`, `pegawai_jk`, `pegawai_pdd`, `pegawai_telp`, `pegawai_email`, `pegawai_foto`, `pegawai_alamat`, `pegawai_jenis`, `pegawai_pangkat`, `pegawai_nip`, `pegawai_password`, `pegawai_level`, `pegawai_status`, `pegawai_create`, `pegawai_login`, `bagian_id`) VALUES
(2023010100007, '', 'Arif Rahman Hakim', 'Bondowoso', '1995-01-10', 'L', '10', '081444451251', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 1, '17', '202301012024010101', '1020df169edc71f53e69c99881e88b0642e5aace', 'admin', 1, '2023-01-22 21:50:57', '2024-08-10 21:10:46', 200),
(2023010100013, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Heri Sulistiawan', 'Bondowoso', '2023-01-18', 'L', '5', '6282333286491', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 0, '5', '202301012024010102', 'ad39d2a88416f3c7856ee9a32dfc7f864a57dd3c', 'jfu', 1, '2023-01-29 14:05:17', '2023-01-29 13:26:31', 3),
(2023010100015, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Marwal Isakandar', 'Bondowoso', '2023-01-18', 'L', '10', '6282333286491', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 0, '17', '202301012024010103', 'b77f71ccd85b56e3e6b08686d10d5c65c1261ec9', 'kasi', 1, '2023-01-29 14:04:40', '2023-01-29 10:51:55', 3),
(2023010100017, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Sukarto', 'Bondowoso', '2023-01-18', 'L', '10', '081444451251', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 0, '17', '202301012024010104', 'f67b6c555e0341fdc5888795b4ab0ab1cfd10d5f', 'ktu', 1, '2023-01-18 15:49:18', '2023-01-29 11:05:18', 6),
(2023010100018, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Farihul Amris', 'Bondowoso', '2023-01-18', 'P', '8', '081444451251', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 0, '17', '202301012024010105', '870b97093c7152053cfaad4dd012dcb73c4dfbe2', 'kepala', 1, '2023-01-29 14:04:01', '2023-01-29 11:10:08', 8),
(2023010100019, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Wahyu Nurul', 'Bondowoso', '2023-01-19', 'L', '9', '6282333286491', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 1, '12', '202301012024010106', 'ca19ee494f52406ca93dc22056b8258ea23915d2', 'petugas', 1, '2023-01-29 14:04:51', '2023-01-29 10:49:19', 6),
(2023010100020, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Parman', 'Bondowoso', '2023-01-22', 'L', '8', '081444451251', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 0, '15', '202301012024010107', 'da288be775a54e20aaef80f80f79cb115c193e8a', 'jfu', 1, '2023-01-29 14:04:20', '2023-01-29 13:27:33', 3),
(2023010100021, 'XcArz9NxDaKYwZBkUiSkGNxopPrBPzTUXPRxF6h3e1l6oRmmOut9FZsCxmz68NDRbCnaYFQivSO2ZWdQTaDWHEFcBqXuIbeuK3lJfPINm3wneQ77O8Qgf2QRs0WTKpI28KX/7IHyFL8aihAQSnSnFWTlh2cufbiiNKvuT0', 'Oki Saputra', 'Bondowoso', '2023-01-22', 'L', '6', '081444451251', 'admin@admin.com', NULL, 'Jl. Diponegoro - Jembrana', 0, '7', '202301012024010108', 'dc382fc37664ed2fc2d0a3e1e4fe23a4c3316866', 'staf', 1, '2023-01-27 10:08:16', '2024-08-10 20:41:54', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `tbl_lampiran`
--
ALTER TABLE `tbl_lampiran`
  ADD PRIMARY KEY (`id_lampiran`);

--
-- Indexes for table `tbl_lembaga`
--
ALTER TABLE `tbl_lembaga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ska`
--
ALTER TABLE `tbl_ska`
  ADD PRIMARY KEY (`id_ska`);

--
-- Indexes for table `tbl_sm`
--
ALTER TABLE `tbl_sm`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  MODIFY `id_bagian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `tbl_lampiran`
--
ALTER TABLE `tbl_lampiran`
  MODIFY `id_lampiran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_lembaga`
--
ALTER TABLE `tbl_lembaga`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_ska`
--
ALTER TABLE `tbl_ska`
  MODIFY `id_ska` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sm`
--
ALTER TABLE `tbl_sm`
  MODIFY `id_sm` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
