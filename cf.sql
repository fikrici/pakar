-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 02:36 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cf`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id` int(11) NOT NULL,
  `id_diagnosa` char(11) NOT NULL,
  `id_gejala` char(11) NOT NULL,
  `id_pasien` char(11) NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`id`, `id_diagnosa`, `id_gejala`, `id_pasien`, `nilai`) VALUES
(17, 'DNS001', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(18, 'DNS001', 'GJ003', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(19, 'DNS001', 'GJ004', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(20, 'DNS001', 'GJ006', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(21, 'DNS001', 'GJ008', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(22, 'DNS001', 'GJ010', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(23, 'DNS001', 'GJ011', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(24, 'DNS001', 'GJ018', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(25, 'DNS001', 'GJ024', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(26, 'DNS001', 'GJ025', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(27, 'DNS001', 'GJ026', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(28, 'DNS002', 'GJ001', 'PASIEN004', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(29, 'DNS002', 'GJ002', 'PASIEN004', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(30, 'DNS002', 'GJ003', 'PASIEN004', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(31, 'DNS002', 'GJ004', 'PASIEN004', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(32, 'DNS002', 'GJ005', 'PASIEN004', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(33, 'DNS002', 'GJ006', 'PASIEN004', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(36, 'DNS003', 'GJ003', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(37, 'DNS003', 'GJ004', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(38, 'DNS003', 'GJ005', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(39, 'DNS004', 'GJ026', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(40, 'DNS005', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Mungkin\",\"nilai\":\"0.5\"}'),
(41, 'DNS005', 'GJ002', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(42, 'DNS005', 'GJ005', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(43, 'DNS005', 'GJ006', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(44, 'DNS005', 'GJ008', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(45, 'DNS006', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(46, 'DNS006', 'GJ002', 'PASIEN001', '{\"kepastian\":\"Mungkin\",\"nilai\":\"0.5\"}'),
(47, 'DNS006', 'GJ003', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(48, 'DNS006', 'GJ004', 'PASIEN001', '{\"kepastian\":\"Mungkin\",\"nilai\":\"0.5\"}'),
(49, 'DNS006', 'GJ005', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(50, 'DNS007', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(51, 'DNS007', 'GJ002', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(52, 'DNS007', 'GJ003', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(53, 'DNS008', 'GJ001', 'PASIEN004', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(54, 'DNS009', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(55, 'DNS009', 'GJ002', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(56, 'DNS009', 'GJ003', 'PASIEN001', '{\"kepastian\":\"Mungkin Tidak\",\"nilai\":\"0.25\"}'),
(57, 'DNS010', 'GJ028', 'PASIEN001', '{\"kepastian\":\"Kemungkinan Besar\",\"nilai\":\"0.75\"}'),
(58, 'DNS011', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}'),
(59, 'DNS012', 'GJ001', 'PASIEN001', '{\"kepastian\":\"Pasti\",\"nilai\":\"1\"}');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` char(11) NOT NULL,
  `gejala` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `gejala`) VALUES
('GJ001', 'Sakit Perut'),
('GJ002', 'Badan Pegal'),
('GJ003', 'Badan Lemas'),
('GJ004', 'Nyeri Tubuh'),
('GJ005', 'Nyeri Dada'),
('GJ006', 'Batuk'),
('GJ007', 'Batuk terus-menerus'),
('GJ008', 'Kesulitan Bernafas'),
('GJ009', 'Pilek'),
('GJ010', 'Demam Ringan'),
('GJ011', 'Sakit Tenggrokan'),
('GJ012', 'Hidung Meler'),
('GJ013', 'Hilang Kesadaran'),
('GJ014', 'Sesak Nafas'),
('GJ015', 'Muntah'),
('GJ016', 'Mual-mual'),
('GJ017', 'Batuk Darah'),
('GJ018', 'Bersin-Bersin'),
('GJ019', 'Menggigil'),
('GJ020', 'Kepala Berdenyut'),
('GJ021', 'Anosmia'),
('GJ022', 'Batuk Berdahak'),
('GJ023', 'Demam'),
('GJ024', 'Sakit Kepala'),
('GJ025', 'Hilang Rasa'),
('GJ026', 'Hilang Penciuman'),
('GJ027', 'Anosmia'),
('GJ028', 'batuk batuk');

-- --------------------------------------------------------

--
-- Table structure for table `kepastian`
--

CREATE TABLE `kepastian` (
  `id` int(11) NOT NULL,
  `kepastian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepastian`
--

INSERT INTO `kepastian` (`id`, `kepastian`) VALUES
(9, 'Pasti'),
(10, 'Kemungkinan Besar'),
(11, 'Mungkin'),
(12, 'Mungkin Tidak'),
(13, 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` char(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` char(20) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`) VALUES
('PASIEN001', 'testing', '1111-11-11', 'Laki-laki', '75475675567', 'gfjghjghjghghj'),
('PASIEN002', 'panji', '2022-08-04', 'Laki-laki', '32355235', 'mhf'),
('PASIEN003', 'yuda', '2022-08-01', 'Laki-laki', '332', 'rsgsh'),
('PASIEN004', 'ihsan', '2022-08-01', 'Laki-laki', '79795', 'maja'),
('PASIEN005', 'ihh', '2022-10-01', 'Laki-laki', '089796', 'burujul');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` char(11) NOT NULL,
  `nama_penyakit` char(100) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `detail`) VALUES
('PK001', 'BA.1', ' '),
('PK002', 'BA.2', ' '),
('PK003', 'BA.3', ' '),
('PK004', 'BA.4', ' '),
('PK005', 'BA.5', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `penyakitgejala`
--

CREATE TABLE `penyakitgejala` (
  `id_relasipg` char(11) NOT NULL,
  `id_penyakit` char(11) NOT NULL,
  `id_gejala` char(11) NOT NULL,
  `cf` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakitgejala`
--

INSERT INTO `penyakitgejala` (`id_relasipg`, `id_penyakit`, `id_gejala`, `cf`) VALUES
('PG001', 'PK001', 'GJ024', 1),
('PG002', 'PK001', 'GJ018', 0.75),
('PG003', 'PK001', 'GJ012', 1),
('PG004', 'PK001', 'GJ011', 1),
('PG005', 'PK001', 'GJ010', 1),
('PG006', 'PK001', 'GJ004', 0.75),
('PG007', 'PK002', 'GJ011', 1),
('PG008', 'PK002', 'GJ009', 1),
('PG009', 'PK002', 'GJ008', 1),
('PG010', 'PK002', 'GJ007', 1),
('PG011', 'PK002', 'GJ003', 0.75),
('PG012', 'PK003', 'GJ024', 1),
('PG013', 'PK003', 'GJ023', 1),
('PG014', 'PK003', 'GJ011', 1),
('PG015', 'PK003', 'GJ009', 0.75),
('PG016', 'PK003', 'GJ004', 1),
('PG017', 'PK004', 'GJ024', 1),
('PG018', 'PK004', 'GJ023', 1),
('PG019', 'PK004', 'GJ014', 1),
('PG020', 'PK004', 'GJ011', 1),
('PG021', 'PK004', 'GJ006', 1),
('PG022', 'PK004', 'GJ003', 1),
('PG023', 'PK004', 'GJ002', 0.75),
('PG024', 'PK004', 'GJ001', 1),
('PG025', 'PK005', 'GJ026', 1),
('PG026', 'PK005', 'GJ025', 1),
('PG027', 'PK005', 'GJ024', 1),
('PG028', 'PK005', 'GJ023', 1),
('PG029', 'PK005', 'GJ014', 1),
('PG030', 'PK005', 'GJ011', 1),
('PG031', 'PK005', 'GJ006', 1),
('PG032', 'PK005', 'GJ003', 1),
('PG033', 'PK005', 'GJ002', 1),
('PG034', 'PK005', 'GJ001', 1),
('PG035', 'PK004', 'GJ026', 1),
('PG036', 'PK004', 'GJ025', 1),
('PG037', 'PK003', 'GJ026', 0.75),
('PG038', 'PK003', 'GJ025', 0.75),
('PG039', 'PK002', 'GJ026', 0.75),
('PG040', 'PK002', 'GJ025', 0.75),
('PG041', 'PK001', 'GJ026', 0.75),
('PG042', 'PK001', 'GJ025', 0.75);

-- --------------------------------------------------------

--
-- Table structure for table `penyakitsolusi`
--

CREATE TABLE `penyakitsolusi` (
  `id_relasips` char(11) NOT NULL,
  `id_penyakit` char(11) NOT NULL,
  `id_solusi` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakitsolusi`
--

INSERT INTO `penyakitsolusi` (`id_relasips`, `id_penyakit`, `id_solusi`) VALUES
('PS001', 'PK005', 'SL020'),
('PS002', 'PK005', 'SL015'),
('PS003', 'PK005', 'SL014'),
('PS004', 'PK005', 'SL013'),
('PS005', 'PK004', 'SL020'),
('PS006', 'PK004', 'SL015'),
('PS007', 'PK004', 'SL014'),
('PS008', 'PK004', 'SL013'),
('PS009', 'PK003', 'SL019'),
('PS010', 'PK003', 'SL018'),
('PS011', 'PK003', 'SL017'),
('PS012', 'PK003', 'SL015'),
('PS013', 'PK003', 'SL014'),
('PS014', 'PK003', 'SL013'),
('PS015', 'PK003', 'SL008'),
('PS016', 'PK003', 'SL005'),
('PS017', 'PK003', 'SL004'),
('PS018', 'PK003', 'SL002'),
('PS019', 'PK003', 'SL001'),
('PS020', 'PK002', 'SL019'),
('PS021', 'PK002', 'SL018'),
('PS022', 'PK002', 'SL017'),
('PS023', 'PK002', 'SL015'),
('PS024', 'PK002', 'SL014'),
('PS025', 'PK002', 'SL013'),
('PS026', 'PK002', 'SL012'),
('PS027', 'PK002', 'SL008'),
('PS028', 'PK002', 'SL005'),
('PS029', 'PK001', 'SL019'),
('PS030', 'PK001', 'SL018'),
('PS031', 'PK001', 'SL017'),
('PS032', 'PK001', 'SL016'),
('PS033', 'PK001', 'SL015'),
('PS034', 'PK001', 'SL014'),
('PS035', 'PK001', 'SL013'),
('PS036', 'PK001', 'SL008'),
('PS037', 'PK001', 'SL005'),
('PS038', 'PK001', 'SL002'),
('PS039', 'PK001', 'SL001');

-- --------------------------------------------------------

--
-- Table structure for table `solusi`
--

CREATE TABLE `solusi` (
  `id_solusi` char(11) NOT NULL,
  `solusi` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solusi`
--

INSERT INTO `solusi` (`id_solusi`, `solusi`) VALUES
('SL001', 'Hindari Stress'),
('SL002', 'Hindari Begadang'),
('SL003', 'Hindari Konsumsi Alkohol'),
('SL004', 'Hindari Rokok'),
('SL005', 'Istirahat Cukup'),
('SL006', 'Vit Zinc'),
('SL007', 'Vit D'),
('SL008', 'Vit C'),
('SL009', 'Remdesivir'),
('SL010', 'Paxloid'),
('SL011', 'Molnupiravir'),
('SL012', 'Favipiravir'),
('SL013', 'Jaga Jarak'),
('SL014', 'Sering Mencuci Tangan'),
('SL015', 'Memakai Masker'),
('SL016', 'Vaksin Dosis Lengkap'),
('SL017', 'Konsumsi Makanan Bergizi'),
('SL018', 'Berjemur 10-15 Menit'),
('SL019', 'Isolasi Mandiri'),
('SL020', 'Hubungi Pihak RS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` char(100) NOT NULL,
  `password` char(255) NOT NULL,
  `level` int(1) NOT NULL,
  `id_pasien` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `id_pasien`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, ''),
(5, 'ihsan', 'ihsan', 5, 'PASIEN05'),
(7, 'test', '098f6bcd4621d373cade4e832627b4f6', 2, 'PASIEN001'),
(8, 'panji', '04c60076bf6f205d7785edd65e17192b', 2, 'PASIEN002'),
(9, 'yuda', 'ac9053a8bd7632586c3eb663a6cf15e4', 2, 'PASIEN003'),
(10, 'san', '9f5a44a734ac9e43b5968d0f3b71d69b', 2, 'PASIEN004'),
(11, 'ihh', '202cb962ac59075b964b07152d234b70', 2, 'PASIEN005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `kepastian`
--
ALTER TABLE `kepastian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `penyakitgejala`
--
ALTER TABLE `penyakitgejala`
  ADD PRIMARY KEY (`id_relasipg`);

--
-- Indexes for table `penyakitsolusi`
--
ALTER TABLE `penyakitsolusi`
  ADD PRIMARY KEY (`id_relasips`);

--
-- Indexes for table `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`id_solusi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `kepastian`
--
ALTER TABLE `kepastian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
