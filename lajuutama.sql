-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2018 at 08:44 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lajuutama`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `ID` int(11) NOT NULL,
  `Pegawai_ID` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`ID`, `Pegawai_ID`, `Tanggal`, `Status`, `Keterangan`) VALUES
(1, 1, '2017-12-26', 'masuk', ''),
(2, 1, '2017-12-27', 'tidak_masuk', 'Sakit demam'),
(3, 1, '2017-12-25', 'masuk', 'telat 10 menit potong gaji 10%'),
(4, 1, '2018-02-01', 'masuk', '');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Modal` decimal(10,0) NOT NULL,
  `Jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID`, `Nama`, `Modal`, `Jumlah`) VALUES
(1, 'Ban Motor CBR 250RR', '300000', 12),
(2, 'lampu depan', '5250', 13),
(3, 'lampu sein', '2750', 10),
(5, 'spakbor', '150000', 995),
(6, 'spion kiri', '75000', 100),
(7, 'spion kanan', '75000', 150),
(8, 'Stiker CBR 250RR', '50000', 8),
(9, 'oli rem tangan', '75000', 100),
(10, 'oli rem tangan', '75000', 102),
(11, 'asd', '0', 9),
(12, 'lampu depan', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `ID` int(11) NOT NULL,
  `Header_ID` int(11) NOT NULL,
  `Barang_ID` int(11) NOT NULL,
  `Modal_Barang` decimal(10,0) NOT NULL,
  `Nama_Barang` varchar(50) NOT NULL,
  `Jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `ID` int(11) NOT NULL,
  `Header_ID` int(11) NOT NULL,
  `Barang_ID` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Harga` decimal(10,0) NOT NULL,
  `Modal` decimal(10,0) NOT NULL,
  `Nama_Barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `header_pembelian`
--

CREATE TABLE `header_pembelian` (
  `ID` int(11) NOT NULL,
  `Nama_Supplier` varchar(50) NOT NULL,
  `Tanggal_Beli` date NOT NULL,
  `Jatuh_Tempo` int(11) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Tanggal_Lunas` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `header_penjualan`
--

CREATE TABLE `header_penjualan` (
  `ID` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `Modal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `ID` int(11) NOT NULL,
  `Pegawai_ID` int(11) NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `Jumlah` decimal(10,0) NOT NULL,
  `Sisa` decimal(10,0) NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`ID`, `Pegawai_ID`, `Keterangan`, `Jumlah`, `Tanggal`, `Status`) VALUES
(1, 1, '', '0', '2018-01-08', 'lunas'),
(2, 1, 'beli sabun', '50000', '2018-01-08', 'lunas'),
(3, 1, 'pulsa', '100000', '2018-01-07', 'lunas'),
(4, 1, 'Beli pulsa', '10000', '2018-02-02', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Telp` varchar(20) DEFAULT NULL,
  `Gaji` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID`, `Nama`, `Telp`, `Gaji`) VALUES
(1, 'Andi', '08123456789', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `ID` int(11) NOT NULL,
  `Tipe_ID` int(11) DEFAULT NULL,
  `Keterangan` varchar(50) DEFAULT NULL,
  `Tanggal` date NOT NULL,
  `Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`ID`, `Tipe_ID`, `Keterangan`, `Tanggal`, `Total`) VALUES
(1, NULL, 'laundry 5 kg', '2018-02-02', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pengeluaran`
--

CREATE TABLE `tipe_pengeluaran` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_pengeluaran`
--

INSERT INTO `tipe_pengeluaran` (`ID`, `Nama`, `Total`) VALUES
(1, 'Beli pulsa XL', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_non_tunai`
--

CREATE TABLE `transaksi_non_tunai` (
  `ID` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Jumlah` decimal(10,0) NOT NULL,
  `Saldo` decimal(10,0) NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_non_tunai`
--

INSERT INTO `transaksi_non_tunai` (`ID`, `Status`, `Jumlah`, `Saldo`, `Tanggal`) VALUES
(1, 'Setor/Debit', '5000000', '5000000', '2017-12-28'),
(2, 'Tarik/Transfer', '250000', '4750000', '2017-12-28'),
(3, 'Tarik/Transfer', '1000', '4749000', '2018-01-01'),
(5, 'Setor/Debit', '1000', '4751000', '2018-01-02'),
(6, 'Tarik/Transfer', '1000', '4750000', '2018-01-02'),
(7, 'Setor/Debit', '2000', '4752000', '2018-01-01'),
(8, 'Setor/Debit', '7000', '4759000', '2018-01-02'),
(9, 'Tarik/Transfer', '1000', '4758000', '2018-01-03'),
(10, 'Setor/Debit', '6000', '4764000', '2018-01-03'),
(11, 'Setor/Debit', '2000', '4766000', '2018-01-04'),
(12, 'Tarik/Transfer', '5000', '4761000', '2018-01-04'),
(13, 'Setor/Debit', '1000', '4762000', '2018-01-05'),
(14, 'Tarik/Transfer', '3000', '4759000', '2018-01-05'),
(15, 'Tarik/Transfer', '1000', '4758000', '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tunai`
--

CREATE TABLE `transaksi_tunai` (
  `ID` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Jumlah` decimal(10,0) NOT NULL,
  `Saldo` decimal(10,0) NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_tunai`
--

INSERT INTO `transaksi_tunai` (`ID`, `Status`, `Jumlah`, `Saldo`, `Tanggal`) VALUES
(1, 'Setor', '100000000', '100000000', '2018-02-01'),
(2, 'Ambil', '5000000', '95000000', '2018-02-02'),
(3, 'Setor', '7000000', '102000000', '2018-02-02'),
(5, 'Ambil', '4000000', '98000000', '2018-02-03'),
(6, 'Setor', '6000000', '104000000', '2018-02-03'),
(10, 'Ambil', '2000000', '102000000', '2018-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Table structure for table `transaksi_lunas_hutang`
--

CREATE TABLE `transaksi_lunas_hutang` (
  `ID` int(11) NOT NULL,
  `Hutang_ID` int(11) NOT NULL,
  `Jumlah` decimal(10,0) NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `transaksi_lunas_hutang`
--
ALTER TABLE `transaksi_lunas_hutang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `header_pembelian`
--
ALTER TABLE `header_pembelian`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `header_penjualan`
--
ALTER TABLE `header_penjualan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tipe_pengeluaran`
--
ALTER TABLE `tipe_pengeluaran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaksi_non_tunai`
--
ALTER TABLE `transaksi_non_tunai`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaksi_tunai`
--
ALTER TABLE `transaksi_tunai`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `header_pembelian`
--
ALTER TABLE `header_pembelian`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `header_penjualan`
--
ALTER TABLE `header_penjualan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipe_pengeluaran`
--
ALTER TABLE `tipe_pengeluaran`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_non_tunai`
--
ALTER TABLE `transaksi_non_tunai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksi_tunai`
--
ALTER TABLE `transaksi_tunai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `detail_pembelian` ADD `Diskon` DECIMAL NOT NULL AFTER `Modal_Barang`;
ALTER TABLE `detail_pembelian` ADD `PPN` DECIMAL NOT NULL AFTER `Modal_Barang`;