-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Apr 2020 pada 19.27
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
-- Struktur dari tabel `installment`
--

CREATE TABLE `installment` (
  `ID` int(11) NOT NULL,
  `NOFAKTUR` varchar(13) NOT NULL,
  `JATUH_TEMPO` date NOT NULL,
  `TAGIHAN` int(10) NOT NULL,
  `TGL_BAYAR` date NOT NULL,
  `NOMINAL` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_harian`
--

CREATE TABLE `kas_harian` (
  `ID` bigint(20) NOT NULL,
  `TGL` date NOT NULL,
  `ID_TRANS` int(10) NOT NULL,
  `TRANS_TYPE` enum('operational','selling','purcashing') NOT NULL,
  `KREDIT` int(11) NOT NULL,
  `DEBET` int(11) NOT NULL,
  `SALDO` int(11) NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketing`
--

CREATE TABLE `marketing` (
  `ID` int(10) NOT NULL,
  `ID_CARD` varchar(100) NOT NULL,
  `MARKETING_NAME` varchar(150) NOT NULL,
  `MARKETING_ADDRESS` text NOT NULL,
  `MARKETING_PHONE` varchar(25) NOT NULL,
  `PHOTO` text NOT NULL,
  `SCAN_ID` text NOT NULL,
  `JOIN_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketing_agen`
--

CREATE TABLE `marketing_agen` (
  `ID` int(10) NOT NULL,
  `ID_CARD` varchar(100) NOT NULL,
  `AGEN_NAME` varchar(150) NOT NULL,
  `AGEN_ADDRESS` text NOT NULL,
  `AGEN_PHONE` varchar(25) NOT NULL,
  `JOIN_DATE` date NOT NULL,
  `AREA` text NOT NULL,
  `MARKETING_ID` int(10) NOT NULL,
  `PHOTO` text NOT NULL,
  `SCAN_ID_CARD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketing_subagen`
--

CREATE TABLE `marketing_subagen` (
  `ID` int(10) NOT NULL,
  `AGEN_ID` int(10) NOT NULL,
  `ID_CARD` varchar(100) NOT NULL,
  `SUBAGEN_NAME` varchar(250) NOT NULL,
  `SUBAGEN_ADDRESS` text NOT NULL,
  `SUBAGEN_PHONE` varchar(25) NOT NULL,
  `AREA` text NOT NULL,
  `JOIN_DATE` date NOT NULL,
  `PHOTO` text NOT NULL,
  `SCAN_ID_CARD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `op_payment`
--

CREATE TABLE `op_payment` (
  `ID` int(11) NOT NULL,
  `POS_ID` int(10) NOT NULL,
  `NOMINAL` int(10) NOT NULL,
  `TGL_TRANSAKSI` date NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `op_pos`
--

CREATE TABLE `op_pos` (
  `ID` int(11) NOT NULL,
  `POS_NAME` varchar(100) NOT NULL,
  `POSITION` text NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `ID` int(10) NOT NULL,
  `CATEGORY_NAME` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_item`
--

CREATE TABLE `product_item` (
  `ID` int(10) NOT NULL,
  `CAT_ID` int(10) NOT NULL,
  `PRODUCT_NAME` varchar(150) NOT NULL,
  `SELL_PRICE` int(10) NOT NULL,
  `STOCK` int(10) NOT NULL,
  `STOCK_LIMIT` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase`
--

CREATE TABLE `purchase` (
  `NOFAKTUR` varchar(13) NOT NULL,
  `SUPLIER_ID` int(10) NOT NULL,
  `PRODUCT_ID` int(10) NOT NULL,
  `QTY` int(10) NOT NULL,
  `PURCHASE_PRICE` int(10) NOT NULL,
  `PURCHASE_DATE` date NOT NULL,
  `DELIVERY_DATE` date NOT NULL,
  `ARRIVAL_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return`
--

CREATE TABLE `return` (
  `ID` int(11) NOT NULL,
  `NOFAKTUR` varchar(13) NOT NULL,
  `TGL_RETUR` date NOT NULL,
  `QTY` int(11) NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `selling`
--

CREATE TABLE `selling` (
  `NOFAKTUR` varchar(13) NOT NULL,
  `SELLER_ID` int(10) NOT NULL,
  `SELLER_TYPE` enum('agen','sub agen') NOT NULL,
  `PRODUCT_ID` int(10) NOT NULL,
  `QTY` int(11) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `DISKON` float NOT NULL,
  `METODE_BAYAR` enum('tunai','kredit') NOT NULL,
  `JML_CICILAN` int(2) NOT NULL,
  `STATUS` enum('lunas','belum') NOT NULL,
  `TGL_BELI` date NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `ID` int(10) NOT NULL,
  `SUPLIER_NAME` varchar(150) NOT NULL,
  `SUPLIER_ADDRESS` text NOT NULL,
  `SUPLIER_PHONE` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket`
--

CREATE TABLE `ticket` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(10) NOT NULL,
  `TICKET_DATE` date NOT NULL,
  `IMAGE` text NOT NULL,
  `KETERANGAN` text NOT NULL,
  `STATUS` enum('open','close') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `kas_harian`
--
ALTER TABLE `kas_harian`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `marketing_agen`
--
ALTER TABLE `marketing_agen`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `marketing_subagen`
--
ALTER TABLE `marketing_subagen`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `op_payment`
--
ALTER TABLE `op_payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `op_pos`
--
ALTER TABLE `op_pos`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`NOFAKTUR`);

--
-- Indeks untuk tabel `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`NOFAKTUR`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `installment`
--
ALTER TABLE `installment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kas_harian`
--
ALTER TABLE `kas_harian`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `marketing`
--
ALTER TABLE `marketing`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `marketing_agen`
--
ALTER TABLE `marketing_agen`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `marketing_subagen`
--
ALTER TABLE `marketing_subagen`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `op_payment`
--
ALTER TABLE `op_payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `op_pos`
--
ALTER TABLE `op_pos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_item`
--
ALTER TABLE `product_item`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `return`
--
ALTER TABLE `return`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suplier`
--
ALTER TABLE `suplier`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
