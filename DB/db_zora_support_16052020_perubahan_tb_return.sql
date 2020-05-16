-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2020 pada 05.24
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_zora_support`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `return`
--

CREATE TABLE `return` (
  `ID` int(11) NOT NULL,
  `INVOICE` longtext NOT NULL,
  `TGL_RETUR` date NOT NULL,
  `QTY` int(11) NOT NULL,
  `KETERANGAN` text NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `TGL_GANTI` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return`
--

INSERT INTO `return` (`ID`, `INVOICE`, `TGL_RETUR`, `QTY`, `KETERANGAN`, `STATUS`, `TGL_GANTI`) VALUES
(1, '052020001 ', '2020-05-16', 2, 'Retur alboost pro imun, kemasan rusak segel rusak', 'sudah', '2020-05-16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `return`
--
ALTER TABLE `return`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
