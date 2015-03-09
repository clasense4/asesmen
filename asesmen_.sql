-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2015 at 01:56 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asesmen_`
--

-- --------------------------------------------------------

--
-- Table structure for table `asesi`
--

CREATE TABLE IF NOT EXISTS `asesi` (
  `id_asesi` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `nip` int(30) NOT NULL,
  `pendidikan` varchar(5) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `foto` longblob NOT NULL,
  PRIMARY KEY (`id_asesi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `asesi`
--

INSERT INTO `asesi` (`id_asesi`, `nama`, `nip`, `pendidikan`, `jabatan`, `unit`, `foto`) VALUES
(1, 'Fajri', 0, 'S1', 'Programmer', 'Produksi', 0x32),
(2, 'Firman', 0, 'S1', 'HRDs', 'Management', 0x31),
(4, 'x222', 0, '1', '2', 'x2', 0x7832),
(6, '3', 0, '3', '3', '3', 0x33),
(7, 'Fizah Muharrani', 0, 'S2', 'staf', 'satkerr', 0x41646161),
(8, 'tesfoto', 123, 's2', 'staf', 'satker', 0x747464206d77206361702e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `asesor`
--

CREATE TABLE IF NOT EXISTS `asesor` (
  `id_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `noreg` varchar(30) NOT NULL,
  `pendidikan` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `surat_pernyataan` longblob NOT NULL,
  PRIMARY KEY (`id_asesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `asesor`
--

INSERT INTO `asesor` (`id_asesor`, `nama`, `noreg`, `pendidikan`, `email`, `no_telp`, `alamat`, `surat_pernyataan`) VALUES
(1, 'Rani', '', 'S2', 'rani@mail.com', '12345', 'Jakarta', ''),
(2, 'Roni', '', 'S2', 'roni@mail.com', '12345', 'Jakarta', ''),
(4, 'ryu', '', 'S1', 'clasense4@gmail.com', '12345', 'Jakarta', ''),
(5, 'ryos', '', 'S1', 'fajri8@nufaza.co.id', '12345', 'Jakarta', ''),
(6, 'testfizah', 'fizah123', 's1', 's@', '09', 'cileungsiiii', 0x616461),
(7, '2', '2', '2', '2', '22', '2', 0x4b6174616c6f67204a696c6261622053656769656d706174204d6f7469662e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `assign_hasil`
--

CREATE TABLE IF NOT EXISTS `assign_hasil` (
  `id_assign_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_asesi` int(11) NOT NULL,
  `id_kegiatan` int(10) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  PRIMARY KEY (`id_assign_hasil`),
  UNIQUE KEY `assign_hasil_id_asesi_id_kegiatan` (`id_asesi`,`id_kegiatan`),
  KEY `id_kegiatan` (`id_kegiatan`),
  KEY `id_asesor` (`id_asesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `assign_hasil`
--

INSERT INTO `assign_hasil` (`id_assign_hasil`, `id_asesi`, `id_kegiatan`, `id_asesor`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assign_kegiatan`
--

CREATE TABLE IF NOT EXISTS `assign_kegiatan` (
  `id_assign_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(10) NOT NULL,
  `id_asesi` int(11) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  PRIMARY KEY (`id_assign_kegiatan`),
  UNIQUE KEY `assign_kegiatan_id_kegiatan_id_asesi` (`id_kegiatan`,`id_asesi`),
  KEY `id_asesor` (`id_asesor`),
  KEY `id_asesi` (`id_asesi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `assign_kegiatan`
--

INSERT INTO `assign_kegiatan` (`id_assign_kegiatan`, `id_kegiatan`, `id_asesi`, `id_asesor`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assign_kegiatan_skor`
--

CREATE TABLE IF NOT EXISTS `assign_kegiatan_skor` (
  `id_assign_kegiatan_skor` int(11) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(10) NOT NULL,
  `id_skor` int(11) NOT NULL,
  PRIMARY KEY (`id_assign_kegiatan_skor`),
  KEY `id_kegiatan` (`id_kegiatan`),
  KEY `id_skor` (`id_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Dumping data for table `assign_kegiatan_skor`
--

INSERT INTO `assign_kegiatan_skor` (`id_assign_kegiatan_skor`, `id_kegiatan`, `id_skor`) VALUES
(1, 1, 9),
(2, 1, 10),
(3, 1, 18),
(4, 1, 19),
(5, 1, 1),
(6, 1, 2),
(7, 1, 5),
(8, 1, 6),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 18),
(13, 2, 19),
(14, 2, 20),
(15, 2, 1),
(16, 2, 2),
(17, 2, 3),
(18, 2, 5),
(19, 2, 6),
(20, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `assign_peran`
--

CREATE TABLE IF NOT EXISTS `assign_peran` (
  `id_user` int(11) NOT NULL,
  `id_peran` int(11) NOT NULL,
  UNIQUE KEY `unique_id_user` (`id_user`),
  KEY `id_peran` (`id_peran`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_peran`
--

INSERT INTO `assign_peran` (`id_user`, `id_peran`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `assign_skor`
--

CREATE TABLE IF NOT EXISTS `assign_skor` (
  `id_assign_skor` int(11) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(10) NOT NULL,
  `id_asesi` int(11) NOT NULL,
  `id_skor` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_assign_skor`),
  UNIQUE KEY `assign_skor_id_kegiatan_id_asesi_id_skor` (`id_kegiatan`,`id_asesi`,`id_skor`),
  KEY `id_asesi` (`id_asesi`),
  KEY `id_skor` (`id_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `assign_skor`
--

INSERT INTO `assign_skor` (`id_assign_skor`, `id_kegiatan`, `id_asesi`, `id_skor`, `nilai`) VALUES
(1, 1, 1, 9, 90),
(2, 1, 1, 10, 90),
(3, 1, 1, 18, 90),
(4, 1, 1, 19, 90),
(5, 1, 1, 1, 90),
(6, 1, 1, 2, 90),
(7, 1, 1, 5, 90),
(8, 1, 1, 6, 90);

-- --------------------------------------------------------

--
-- Table structure for table `group_skor`
--

CREATE TABLE IF NOT EXISTS `group_skor` (
  `id_group_skor` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_group_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `group_skor`
--

INSERT INTO `group_skor` (`id_group_skor`, `nama`) VALUES
(1, 'Potensi'),
(2, 'Kompetensi Inti'),
(3, 'Kompetensi Kepemimpinan'),
(4, 'Kompetensi Jabatan');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` int(11) NOT NULL,
  `id_kegiatan` int(10) NOT NULL,
  `id_lead_asesor` int(11) NOT NULL,
  PRIMARY KEY (`id_hasil`),
  UNIQUE KEY `hasil_id_hasil_id_kegiatan` (`id_hasil`,`id_kegiatan`),
  KEY `id_kegiatan` (`id_kegiatan`),
  KEY `id_lead_asesor` (`id_lead_asesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `nomor`, `id_kegiatan`, `id_lead_asesor`) VALUES
(1, 123, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `proyek_mulai` date NOT NULL,
  `proyek_selesai` date NOT NULL,
  `note` varchar(300) NOT NULL,
  `bobot_p` int(10) NOT NULL,
  `bobot_i` int(10) NOT NULL,
  `bobot_j` int(11) NOT NULL,
  `bobot_k` int(10) NOT NULL,
  `bobot_t` int(11) NOT NULL,
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama`, `instansi`, `tanggal`, `proyek_mulai`, `proyek_selesai`, `note`, `bobot_p`, `bobot_i`, `bobot_j`, `bobot_k`, `bobot_t`) VALUES
(1, 'Data Pokok Pendidikan Usia Dini', 'Kemdikbud', '2015-01-01', '2015-01-01', '2015-01-01', '', 0, 0, 0, 0, 0),
(2, 'Assessment Eselon II', 'Kejaksaan Agung RI', '0000-00-00', '0000-00-00', '0000-00-00', 'apa ya', 20, 20, 20, 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_potensi`
--

CREATE TABLE IF NOT EXISTS `nilai_potensi` (
  `id_nilai_potensi` int(11) NOT NULL,
  `id_kegiatan` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_potensi` int(11) NOT NULL,
  KEY `id_kegiatan` (`id_kegiatan`),
  KEY `id_potensi` (`id_potensi`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peran`
--

CREATE TABLE IF NOT EXISTS `peran` (
  `id_peran` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_peran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `peran`
--

INSERT INTO `peran` (`id_peran`, `nama`) VALUES
(1, 'Admin'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `skor`
--

CREATE TABLE IF NOT EXISTS `skor` (
  `id_skor` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `prosentasi_skor` int(11) NOT NULL,
  `id_group_skor` int(11) NOT NULL,
  PRIMARY KEY (`id_skor`),
  KEY `id_group_skor` (`id_group_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `skor`
--

INSERT INTO `skor` (`id_skor`, `nama`, `prosentasi_skor`, `id_group_skor`) VALUES
(1, 'Kepemimpinan', 20, 3),
(2, 'Pengembangan Kelompok', 20, 3),
(3, 'Pemimpin Perubahan', 20, 3),
(4, 'Pemahaman strategis', 20, 3),
(5, 'Peduli thp keteraturan & kualitas', 20, 4),
(6, 'Pemikiran Analitis', 20, 4),
(7, 'Pemikiran Konseptual', 20, 4),
(8, 'Inisiatif', 20, 4),
(9, 'Kecerdasan Umum', 20, 1),
(10, 'Daya Abstraksi', 20, 1),
(11, 'Daya Analisis - Sintensis', 20, 1),
(12, 'Kerja sama', 20, 1),
(13, 'Kendali Emosi', 20, 1),
(14, 'Daya Tahan thp Stress', 20, 1),
(15, 'Kepercayaan Diri', 20, 1),
(16, 'Motivasi Kerja', 20, 1),
(17, 'Sistematika Kerja', 20, 1),
(18, 'Integritas', 20, 2),
(19, 'Dorongan Berprestasi', 20, 2),
(20, 'Pelayanan kpd Pemangku Kepentingan', 20, 2),
(21, 'Kerja sama', 20, 2),
(26, 'tes', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'staff', 'staff'),
(3, '3', '3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_hasil`
--
ALTER TABLE `assign_hasil`
  ADD CONSTRAINT `assign_hasil_ibfk_1` FOREIGN KEY (`id_asesi`) REFERENCES `asesi` (`id_asesi`),
  ADD CONSTRAINT `assign_hasil_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `assign_hasil_ibfk_3` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`);

--
-- Constraints for table `assign_kegiatan`
--
ALTER TABLE `assign_kegiatan`
  ADD CONSTRAINT `assign_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `assign_kegiatan_ibfk_2` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`),
  ADD CONSTRAINT `assign_kegiatan_ibfk_3` FOREIGN KEY (`id_asesi`) REFERENCES `asesi` (`id_asesi`);

--
-- Constraints for table `assign_kegiatan_skor`
--
ALTER TABLE `assign_kegiatan_skor`
  ADD CONSTRAINT `assign_kegiatan_skor_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `assign_kegiatan_skor_ibfk_2` FOREIGN KEY (`id_skor`) REFERENCES `skor` (`id_skor`);

--
-- Constraints for table `assign_peran`
--
ALTER TABLE `assign_peran`
  ADD CONSTRAINT `assign_peran_ibfk_1` FOREIGN KEY (`id_peran`) REFERENCES `peran` (`id_peran`),
  ADD CONSTRAINT `assign_peran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `assign_skor`
--
ALTER TABLE `assign_skor`
  ADD CONSTRAINT `assign_skor_ibfk_1` FOREIGN KEY (`id_asesi`) REFERENCES `asesi` (`id_asesi`),
  ADD CONSTRAINT `assign_skor_ibfk_2` FOREIGN KEY (`id_skor`) REFERENCES `skor` (`id_skor`),
  ADD CONSTRAINT `assign_skor_ibfk_3` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`);

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `hasil_ibfk_3` FOREIGN KEY (`id_lead_asesor`) REFERENCES `asesor` (`id_asesor`);

--
-- Constraints for table `nilai_potensi`
--
ALTER TABLE `nilai_potensi`
  ADD CONSTRAINT `nilai_potensi_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `nilai_potensi_ibfk_2` FOREIGN KEY (`id_potensi`) REFERENCES `skor` (`id_skor`),
  ADD CONSTRAINT `nilai_potensi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `skor`
--
ALTER TABLE `skor`
  ADD CONSTRAINT `skor_ibfk_1` FOREIGN KEY (`id_group_skor`) REFERENCES `group_skor` (`id_group_skor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
