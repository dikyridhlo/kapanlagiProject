-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jul 2018 pada 19.44
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teskapanlagi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_kapanlagi`
--

CREATE TABLE `foto_kapanlagi` (
  `ID_FOTO` int(11) NOT NULL,
  `ID_KAPANLAGI` int(11) NOT NULL,
  `FOTO` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `foto_kapanlagi`
--

INSERT INTO `foto_kapanlagi` (`ID_FOTO`, `ID_KAPANLAGI`, `FOTO`) VALUES
(31, 59, './image/Grass_Threads_Green_4K_Ultra_HD_Desktop_Wallpaper_600x600.jpg'),
(32, 59, './image/Grass_Threads_Green_4K_Ultra_HD_Desktop_Wallpaper_240x240.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kapanlagi`
--

CREATE TABLE `kapanlagi` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `ALAMAT` text NOT NULL,
  `EMAIL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kapanlagi`
--

INSERT INTO `kapanlagi` (`ID`, `NAMA`, `TGL_LAHIR`, `ALAMAT`, `EMAIL`) VALUES
(59, 'dawdaw', '2018-07-18', 'dwadwa', 'dwadaw@dawdaw.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto_kapanlagi`
--
ALTER TABLE `foto_kapanlagi`
  ADD PRIMARY KEY (`ID_FOTO`),
  ADD KEY `upload2x` (`ID_KAPANLAGI`);

--
-- Indexes for table `kapanlagi`
--
ALTER TABLE `kapanlagi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto_kapanlagi`
--
ALTER TABLE `foto_kapanlagi`
  MODIFY `ID_FOTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `kapanlagi`
--
ALTER TABLE `kapanlagi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto_kapanlagi`
--
ALTER TABLE `foto_kapanlagi`
  ADD CONSTRAINT `upload2x` FOREIGN KEY (`ID_KAPANLAGI`) REFERENCES `kapanlagi` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
