-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: May 03, 2020 at 03:28 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zora_support`
--

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `ID` int NOT NULL,
  `NOFAKTUR` varchar(13) NOT NULL,
  `JATUH_TEMPO` date NOT NULL,
  `TAGIHAN` int NOT NULL,
  `TGL_BAYAR` date NOT NULL,
  `NOMINAL` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kas_harian`
--

CREATE TABLE `kas_harian` (
  `ID` bigint NOT NULL,
  `TGL` date NOT NULL,
  `ID_TRANS` int NOT NULL,
  `TRANS_TYPE` enum('operational','selling','purcashing') NOT NULL,
  `KREDIT` int NOT NULL,
  `DEBET` int NOT NULL,
  `SALDO` int NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketing`
--

CREATE TABLE `marketing` (
  `ID` int NOT NULL,
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
-- Table structure for table `marketing_agen`
--

CREATE TABLE `marketing_agen` (
  `ID` int NOT NULL,
  `ID_CARD` varchar(100) NOT NULL,
  `AGEN_NAME` varchar(150) NOT NULL,
  `AGEN_ADDRESS` text NOT NULL,
  `AGEN_PHONE` varchar(25) NOT NULL,
  `JOIN_DATE` date NOT NULL,
  `AREA` text NOT NULL,
  `MARKETING_ID` int NOT NULL,
  `PHOTO` text NOT NULL,
  `SCAN_ID_CARD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_subagen`
--

CREATE TABLE `marketing_subagen` (
  `ID` int NOT NULL,
  `AGEN_ID` int NOT NULL,
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
-- Table structure for table `op_payment`
--

CREATE TABLE `op_payment` (
  `ID` int NOT NULL,
  `POS_ID` int NOT NULL,
  `NOMINAL` int NOT NULL,
  `TGL_TRANSAKSI` date NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `op_pos`
--

CREATE TABLE `op_pos` (
  `ID` int NOT NULL,
  `POS_NAME` varchar(100) NOT NULL,
  `POSITION` text NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `ID` int NOT NULL,
  `CATEGORY_NAME` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `ID` int NOT NULL,
  `CAT_ID` int NOT NULL,
  `PRODUCT_NAME` varchar(150) NOT NULL,
  `SELL_PRICE` int NOT NULL,
  `STOCK` int NOT NULL,
  `STOCK_LIMIT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `NOFAKTUR` varchar(13) NOT NULL,
  `SUPLIER_ID` int NOT NULL,
  `PRODUCT_ID` int NOT NULL,
  `QTY` int NOT NULL,
  `PURCHASE_PRICE` int NOT NULL,
  `PURCHASE_DATE` date NOT NULL,
  `DELIVERY_DATE` date NOT NULL,
  `ARRIVAL_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `ID` int NOT NULL,
  `NOFAKTUR` varchar(13) NOT NULL,
  `TGL_RETUR` date NOT NULL,
  `QTY` int NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `selling`
--

CREATE TABLE `selling` (
  `NOFAKTUR` varchar(13) NOT NULL,
  `SELLER_ID` int NOT NULL,
  `SELLER_TYPE` enum('agen','sub agen') NOT NULL,
  `PRODUCT_ID` int NOT NULL,
  `QTY` int NOT NULL,
  `HARGA` int NOT NULL,
  `DISKON` float NOT NULL,
  `METODE_BAYAR` enum('tunai','kredit') NOT NULL,
  `JML_CICILAN` int NOT NULL,
  `STATUS` enum('lunas','belum') NOT NULL,
  `TGL_BELI` date NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `ID` int NOT NULL,
  `SUPLIER_NAME` varchar(150) NOT NULL,
  `SUPLIER_ADDRESS` text NOT NULL,
  `SUPLIER_PHONE` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`ID`, `SUPLIER_NAME`, `SUPLIER_ADDRESS`, `SUPLIER_PHONE`) VALUES
(6, 'Ashokani', 'kono kae', '090998998'),
(9, 'paimin', 'wonosari', '0888887'),
(10, 'tukiman', 'kalirejo', '8887'),
(11, 'samijan', 'ngadirgo', '66667'),
(12, 'pt hahah', 'ngani ', '988787');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ID` int NOT NULL,
  `USER_ID` int NOT NULL,
  `TICKET_DATE` date NOT NULL,
  `IMAGE` text NOT NULL,
  `KETERANGAN` text NOT NULL,
  `STATUS` enum('open','close') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kas_harian`
--
ALTER TABLE `kas_harian`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `marketing_agen`
--
ALTER TABLE `marketing_agen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `marketing_subagen`
--
ALTER TABLE `marketing_subagen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `op_payment`
--
ALTER TABLE `op_payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `op_pos`
--
ALTER TABLE `op_pos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`NOFAKTUR`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`NOFAKTUR`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas_harian`
--
ALTER TABLE `kas_harian`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing`
--
ALTER TABLE `marketing`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_agen`
--
ALTER TABLE `marketing_agen`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_subagen`
--
ALTER TABLE `marketing_subagen`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `op_payment`
--
ALTER TABLE `op_payment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `op_pos`
--
ALTER TABLE `op_pos`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
