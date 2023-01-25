-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 06:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2022_rnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `brand`) VALUES
(1, 'Wardah'),
(2, 'WNL'),
(3, 'Make Over'),
(4, 'Emina'),
(5, 'Putri'),
(6, 'WONDERLY'),
(7, 'KAHF');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_group`
--

CREATE TABLE `tbl_item_group` (
  `id` int(11) NOT NULL,
  `item_group` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_group`
--

INSERT INTO `tbl_item_group` (`id`, `item_group`) VALUES
(1, 'ACNEDERM'),
(2, 'C-DEFENSE'),
(3, 'CRYSTALLURE'),
(4, 'CRYSTAL SECRET'),
(5, 'EYEXPERT'),
(6, 'NATURE DAILY'),
(7, 'HYDRA ROSE'),
(8, 'INSTAPERFECT'),
(9, 'PAKET HAJI'),
(10, 'LIGHTENING');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_koordinat`
--

CREATE TABLE `tbl_koordinat` (
  `id` int(11) NOT NULL,
  `koordinat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_koordinat`
--

INSERT INTO `tbl_koordinat` (`id`, `koordinat`) VALUES
(1, '1A-01'),
(2, '1A-02'),
(3, '1A-03'),
(4, '1A-04'),
(5, '1A-05'),
(6, '1B-01'),
(7, '1B-02'),
(8, '1B-03'),
(9, '1B-04'),
(10, '1B-05'),
(12, '1C-01'),
(13, '1A-06'),
(14, '2A-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `item_group` varchar(40) NOT NULL,
  `kode_item` varchar(40) NOT NULL,
  `kode_standar` varchar(40) NOT NULL,
  `nama_item` varchar(60) NOT NULL,
  `brand` varchar(40) NOT NULL,
  `no_batch` varchar(20) NOT NULL,
  `formula` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `alokasi` varchar(20) NOT NULL,
  `koordinat` varchar(40) NOT NULL,
  `tgl_berlaku_mulai` date NOT NULL,
  `tgl_berlaku_sampai` date NOT NULL,
  `peminjam` varchar(40) DEFAULT NULL,
  `perpanjangan_ke` int(11) NOT NULL,
  `packaging` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `expired` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `item_group`, `kode_item`, `kode_standar`, `nama_item`, `brand`, `no_batch`, `formula`, `keterangan`, `alokasi`, `koordinat`, `tgl_berlaku_mulai`, `tgl_berlaku_sampai`, `peminjam`, `perpanjangan_ke`, `packaging`, `jumlah`, `expired`, `status`) VALUES
(1, 'ACNEDERM', 'A-PRT-W100ML', 'STU-WACDPRT-PO-01/RND', 'Acnederm Pore Refining Toner', 'Wardah', 'AH19', 'FT001-1.APRT.AFN', 'Standar bulk', 'RND', '1A-01', '2021-01-19', '2023-01-19', NULL, 0, 'Botol', 2, '2 Thn', 'Aktif'),
(2, 'ACNEDERM', 'FW-RAPFC-W', 'STU-WAPFOCL-PO-01/RND', 'Acnederm Pure Foaming Cleanser', 'Wardah', 'DI19', 'FT001.2.ACPFC.MFI', 'Standar bulk', 'RND', '1A-01', '2022-04-19', '2023-04-19', NULL, 0, 'Pot', 2, '1 Thn', 'Aktif'),
(3, 'C-DEFENSE', 'FW-CDEWN2-W', 'STU-WCDWHFW-O-01/RND', 'C-Defense Energizing Whip Foam', 'Wardah', 'AI14', 'FT001.MWDC.HZA', 'Standar bulk', 'RND', '1A-01', '2022-01-14', '2023-07-14', NULL, 0, 'Pot', 2, '1 Thn 6 Bln', 'Aktif'),
(4, 'C-DEFENSE', 'FMI-CDFM-W55ML', 'STU-WCDEFMI-PO-01/RND', 'C-Defense Face Mist', 'WNL', 'DI18', 'FT001-1.CDEFM.AFN', 'Standar bulk', 'RND', '1A-02', '2022-04-18', '2023-04-18', NULL, 0, 'Botol', 2, '1 Thn', 'Aktif'),
(5, 'CRYSTALLURE', 'REM-CDAMG-W', 'STU-WCRDAMG-PO-01/RND', 'Crystallure Double Action Micellar Gel', 'Wardah', 'DI05', 'FT001-1.CDAMG.MFI', 'Standar bulk', 'RND', '1A-02', '2022-04-05', '2023-04-05', NULL, 0, 'Pot', 2, '1 Thn', 'Aktif'),
(6, 'CRYSTAL SECRET', 'FW-RWSABHA-W', 'STU-WWSMAFG-PO-01/RND', 'Wardah Crystal Secret Foaming Cleanser With Natural AHA+PHA', 'Wardah', 'GI22A', 'BULK PRODUKSI', 'Standar bulk', 'RND', '1A-04', '2022-07-22', '2023-07-22', NULL, 0, 'Pot', 2, '1 Thn', 'Aktif'),
(7, 'CRYSTAL SECRET', 'CM-WSOG-W', 'STU-WCSMCGE-PO-01/RND', 'Wardah Crystal Secret Micellar Cleansing Gel', 'Wardah', 'AI27', 'FT001.WCSMCG.NHA', 'Standar bulk', 'RND', '1A-05', '2022-01-27', '2023-01-27', NULL, 0, 'Pot', 2, '1 Thn', 'Aktif'),
(8, 'EYEXPERT', 'FT-RIHT-W', 'STU-WRIHYTO-PO-01/RND', 'WARDAH Hydra Rose Petal Infused Toner', 'Wardah', 'HH24', 'FT001.HRIPT100.DUI', 'Standar bulk', 'RND', '1A-06', '2020-08-24', '2023-01-24', NULL, 0, 'Botol', 2, '2 Thn 5 Bln', 'Aktif'),
(9, 'EYEXPERT', 'FW-CFW-W', 'STU-WCMRCFO-PO-01/RND', 'Wardah Crystallure Moisture Rich Cleansing Foam', 'Make Over', 'IH29', 'FD008B.CFW.NHA', 'Standar bulk', 'RND', '1A-03', '2021-09-29', '2023-09-29', NULL, 0, 'Pot', 3, '2 Thn', 'Non Aktif'),
(10, 'EYEXPERT', 'SRM-ELB-W', 'STU-WEXLABS-PO-01/RND', 'Wardah Eyexpert Lash And Brow Serum', 'Wardah', 'FI16', 'FD007.WLBS.SFS', 'Standar bulk', 'RND', '1A-05', '2022-01-16', '2023-06-16', NULL, 0, 'Botol', 2, '1 Thn 5 Bln', 'Aktif'),
(11, 'PAKET HAJI', 'S-W0HTNP-W40ML', 'STU-WHTTOCL-PO-01/RND', 'Wardah Head To Toe Cleanser Non Parfum', 'Wardah', 'GI20A', 'BULK PRODUKSI', 'Standar bulk', 'RND', '1A-05', '2022-07-20', '2023-07-20', NULL, 0, 'Pot', 2, '1 Thn', 'Aktif'),
(12, 'HYDRA ROSE', 'SRM-RIH-W', 'STU-WROSESE-PO-01/RND', 'Wardah Hydra Rose Micro Gel Serum', 'Wardah', 'KH01', 'FT001.HRMGSE.DUI', 'Standar bulk', 'RND', '1A-06', '2021-11-01', '2022-12-31', NULL, 0, 'Pot', 2, '1 Thn 1 Bln 29 Hari', 'Aktif'),
(13, 'HYDRA ROSE', 'FW-RHMF-W', 'STU-EROSCLE-PO-01/RND', 'Hydra Rose Gel To Foam Cleanser', 'Wardah', 'FH23', 'FT001.WHRGC.MFI', 'Standar bulk', 'RND', '1A-06', '2021-06-23', '2022-06-23', NULL, 0, 'Pot', 2, '1 Thn', 'Aktif'),
(14, 'LIGHTENING', 'FW-PBCFLO-W60ML', 'STU-WPBCWOC-PO-01/RND', 'Perfect Bright Creamy Wash Brightening + Oil Control', 'Wardah', 'DH26', 'FT001.1.PBCWBOC.MFI', 'Standar bulk', 'RND', '2A-01', '2021-04-26', '2022-04-26', NULL, 0, 'Pot', 3, '1 Thn', 'Aktif'),
(15, 'LIGHTENING', 'MA-LESM-W', 'STU-WLESSHM-PO-01/RND', 'Lightening Essence Sheet Mask', 'Wardah', 'DI19', 'FT001-1.LESM.MFI', 'Standar bulk', 'RND', '1B-01', '2022-01-19', '2023-01-19', NULL, 0, 'Botol', 2, '1 Thn', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `nama_lengkap`, `level`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Admin', 'default.png'),
(2, 'leader', 'e10adc3949ba59abbe56e057f20f883e', 'Leader', 'Leader', 'avatar2.png'),
(3, 'operator', 'e10adc3949ba59abbe56e057f20f883e', 'Operator', 'Operator', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_group`
--
ALTER TABLE `tbl_item_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_koordinat`
--
ALTER TABLE `tbl_koordinat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_item_group`
--
ALTER TABLE `tbl_item_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_koordinat`
--
ALTER TABLE `tbl_koordinat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
