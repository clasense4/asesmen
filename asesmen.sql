-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2015 at 04:44 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asesmen`
--

-- --------------------------------------------------------

--
-- Table structure for table `asesi`
--

CREATE TABLE IF NOT EXISTS `asesi` (
  `nomor` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `id_kegiatan` int(10) NOT NULL,
  KEY `id_klien` (`id_kegiatan`),
  KEY `id_kegiatan` (`id_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asesi`
--

INSERT INTO `asesi` (`nomor`, `nama`, `jabatan`, `unit`, `id_kegiatan`) VALUES
('1222', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asesor`
--

CREATE TABLE IF NOT EXISTS `asesor` (
  `id_asesor` int(11) NOT NULL,
  `namaasesor` int(11) NOT NULL,
  `pendidikan` int(11) NOT NULL,
  `emailasesor` int(11) NOT NULL,
  `telpasesor` int(11) NOT NULL,
  `alamatasesor` int(11) NOT NULL,
  PRIMARY KEY (`id_asesor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asesor`
--

INSERT INTO `asesor` (`id_asesor`, `namaasesor`, `pendidikan`, `emailasesor`, `telpasesor`, `alamatasesor`) VALUES
(1, 0, 0, 0, 90, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
  `id_hasil` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `p3` int(11) NOT NULL,
  `p4` int(11) NOT NULL,
  `p5` int(11) NOT NULL,
  `p6` int(11) NOT NULL,
  `p7` int(11) NOT NULL,
  `p8` int(11) NOT NULL,
  `potensi` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `inti` int(11) NOT NULL,
  `t` int(11) NOT NULL,
  `teknis` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `rekomendasi` varchar(50) NOT NULL,
  `id_asesor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `nomor`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `potensi`, `i1`, `i2`, `i3`, `i4`, `i5`, `inti`, `t`, `teknis`, `total`, `rekomendasi`, `id_asesor`) VALUES
(1, 1222, 9, 9, 9, 9, 9, 9, 9, 9, 14, 9, 9, 9, 9, 9, 18, 9, 0, 32, 'Telah Memenuhi Persayaratan', '1'),
(2, 1222, 2, 3, 3, 3, 3, 3, 2, 2, 4, 2, 2, 2, 2, 2, 4, 2, 1, 9, 'Telah Memenuhi Persayaratan', '1'),
(3, 1222, 5, 5, 5, 5, 5, 5, 5, 5, 8, 5, 5, 5, 5, 5, 10, 5, 2, 20, 'Telah Memenuhi Persayaratan', '1'),
(4, 1222, 4, 4, 4, 4, 4, 4, 4, 4, 6, 4, 4, 4, 4, 4, 8, 4, 2, 16, 'Belum Memenuhi Persayaratan', '1'),
(1111, 1222, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '2', '1'),
(1112, 1222, 1, 1, 1, 1, 1, 1, 1, 1, 8, 1, 1, 1, 1, 1, 1, 11, 1, 1, '1', '1'),
(2121, 1222, 2, 2, 2, 2, 2, 2, 2, 2, 3, 1, 1, 1, 1, 1, 5, 0, 0, 8, 'Telah Memenuhi Persayaratan', '1'),
(2323, 1222, 8, 8, 8, 8, 8, 8, 8, 8, 13, 2, 2, 2, 2, 2, 4, 0, 0, 17, '1', '1'),
(3333, 1222, 3, 3, 3, 87, 87, 99, 9, 98, 78, 56, 65, 76, 89, 90, 150, 0, 0, 228, 'Belum Memenuhi Persayaratan', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `instansi` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `note` varchar(300) NOT NULL,
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama`, `instansi`, `tanggal`, `note`) VALUES
(1, '1', 1, '0000-00-00', ''),
(12, '1', 1, '2014-01-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'tes', 'tes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
