-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 05 Apr 2020 pada 10.03
-- Versi Server: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid19`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nmgejala` text NOT NULL,
  `keterangan` text NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kode`, `nmgejala`, `keterangan`, `jenis`) VALUES
(1, '343', 'dasdas', 'dasdasdasd', 'dasdasdasd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ip_location`
--

CREATE TABLE `ip_location` (
  `id_location` int(11) NOT NULL,
  `statusCode` varchar(200) NOT NULL,
  `ipAddress` varchar(200) NOT NULL,
  `countryCode` varchar(200) NOT NULL,
  `countryName` varchar(200) NOT NULL,
  `regionName` varchar(200) NOT NULL,
  `cityName` varchar(200) NOT NULL,
  `zipCode` varchar(200) NOT NULL,
  `latitude` float NOT NULL,
  `longtitude` float NOT NULL,
  `timeZone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `markers`
--

CREATE TABLE `markers` (
  `id_markers` int(11) NOT NULL,
  `statusCode` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ngetest`
--

CREATE TABLE `ngetest` (
  `id_test` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `waktu` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `jawab` varchar(50) NOT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_markers` int(11) NOT NULL,
  `nmpasien` varchar(100) NOT NULL,
  `usia` int(11) NOT NULL,
  `jk` char(5) NOT NULL,
  `tgllahir` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `ip_location`
--
ALTER TABLE `ip_location`
  ADD PRIMARY KEY (`id_location`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id_markers`);

--
-- Indexes for table `ngetest`
--
ALTER TABLE `ngetest`
  ADD PRIMARY KEY (`id_test`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ip_location`
--
ALTER TABLE `ip_location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id_markers` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ngetest`
--
ALTER TABLE `ngetest`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
