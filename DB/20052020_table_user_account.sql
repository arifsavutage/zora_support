-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2020 pada 13.39
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
-- Struktur dari tabel `user_account`
--

CREATE TABLE `user_account` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `USER_TYPE` longtext,
  `USERNAME` varchar(200) NOT NULL,
  `EMAIL` longtext NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `LEVEL` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_account`
--

INSERT INTO `user_account` (`ID`, `ID_USER`, `USER_TYPE`, `USERNAME`, `EMAIL`, `PASSWORD`, `LEVEL`) VALUES
(1, NULL, NULL, 'Zora Superadmin', 'admin@zlasupport.com', '$2y$10$ca0pp55yIoQa7ktPaU20nOlApQit2dmHalQkGlaL1bX/ZYB6k/bZO', 'superadmin'),
(2, NULL, NULL, 'Desti Kumala Sari', 'desti.kumala@zlasupport.com', '$2y$10$SO1dLWFtOCAdkbnBkDguk.UDQBMmBpLcrFLvxY5MT3lsi8.Rveudu', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user_account`
--
ALTER TABLE `user_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
