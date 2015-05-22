-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2015 at 09:23 AM
-- Server version: 5.6.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asesmen_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `asesi`
--

CREATE TABLE IF NOT EXISTS `asesi` (
  `id_asesi` int(11) NOT NULL AUTO_INCREMENT,
  `no_asesi` varchar(50) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `nip` int(30) NOT NULL,
  `pendidikan` varchar(5) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `foto` longblob NOT NULL,
  `id_kegiatan` int(10) NOT NULL,
  PRIMARY KEY (`id_asesi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `asesi`
--

INSERT INTO `asesi` (`id_asesi`, `no_asesi`, `nama`, `nip`, `pendidikan`, `jabatan`, `unit`, `foto`, `id_kegiatan`) VALUES
(1, '', 'Fajri', 0, 'S1', 'Programmer', 'Produksi', 0x32, 1),
(2, '', 'Firman', 0, 'S1', 'HRDs', 'Management', 0x31, 2),
(4, '', 'x222', 0, '1', '2', 'x2', 0x7832, 2),
(6, '', '3', 0, '3', '3', '3', 0x33, 2),
(7, '', 'Fizah Muharrani', 0, 'S2', 'staf', 'satkerr', 0x41646161, 1),
(8, '', 'tesfoto', 123, 's2', 'staf', 'satker', 0x747464206d77206361702e706e67, 1),
(13, '1231122', 'Dono', 1234565, 'S1 Te', 'Direktur', 'Keuangan', 0x556e7469746c65642e6a7067, 12),
(14, '4321', 'Asesi nama', 987654, 'S1 Te', 'Java programmer', 'Keuangan', 0x556e7469746c65642e6a7067, 13),
(15, '1231122', 'Dono', 1234565, 'S1 Te', 'Direktur', 'Keuangan', 0x494d475f333137382e4a5047, 14),
(16, '1231122', 'Fizah muharrani', 1234565, 'S1 Te', 'Direktur', 'Keuangan', 0x494d475f333138322e4a5047, 15),
(17, '4321', 'Dono', 1234565, 'S1 Te', 'Web Programmer', 'Keuangan', 0x77616c6c70617065722d313131333936312e6a7067, 15);

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
  `id_kegiatan` int(10) NOT NULL,
  PRIMARY KEY (`id_asesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `asesor`
--

INSERT INTO `asesor` (`id_asesor`, `nama`, `noreg`, `pendidikan`, `email`, `no_telp`, `alamat`, `surat_pernyataan`, `id_kegiatan`) VALUES
(1, 'Rani', '', 'S2', 'rani@mail.com', '12345', 'Jakarta', '', 1),
(2, 'Roni', '', 'S2', 'roni@mail.com', '12345', 'Jakarta', '', 1),
(4, 'ryu', '', 'S1', 'clasense4@gmail.com', '12345', 'Jakarta', '', 1),
(5, 'ryos', '', 'S1', 'fajri8@nufaza.co.id', '12345', 'Jakarta', '', 2),
(6, 'testfizah', 'fizah123', 's1', 's@', '09', 'cileungsiiii', 0x616461, 2),
(7, '2', '2', '2', '2', '22', '2', 0x4b6174616c6f67204a696c6261622053656769656d706174204d6f7469662e706e67, 2),
(11, 'KPR Deployment', '12', 'S1 Te', 'akunsaha@gmail.com', '089787', 'KP.Tanjunglaya RT 02/05', 0x556e7469746c65642e6a7067, 12),
(12, 'asesor broo', '12', 'S1 Te', 'fbtest302@gmail.com', '089787', 'KP.Tanjunglaya RT 02/05', 0x556e7469746c65642e6a7067, 13),
(13, 'Fizah muharrani', '123456', 'S1 Te', 'akunsaha@gmail.com', '089787', 'KP.Tanjunglaya RT 02/05', 0x494d475f333138302e4a5047, 14),
(14, 'Fakhrul Aziz Ikhsanudin', '12', 'S1 Te', 'akunsaha@gmail.com', '089787', 'aa', 0x494d475f333031362e4a5047, 15);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=69 ;

--
-- Dumping data for table `assign_kegiatan_skor`
--

INSERT INTO `assign_kegiatan_skor` (`id_assign_kegiatan_skor`, `id_kegiatan`, `id_skor`) VALUES
(47, 15, 9),
(48, 15, 10),
(49, 15, 11),
(50, 15, 12),
(51, 15, 13),
(52, 15, 14),
(53, 15, 15),
(54, 15, 16),
(55, 15, 17),
(56, 15, 18),
(57, 15, 19),
(58, 15, 20),
(59, 15, 21),
(60, 15, 1),
(61, 15, 2),
(62, 15, 3),
(63, 15, 4),
(64, 15, 5),
(65, 15, 6),
(66, 15, 7),
(67, 15, 8),
(68, 15, 27);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_skor`
--

CREATE TABLE IF NOT EXISTS `group_skor` (
  `id_group_skor` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_group_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `group_skor`
--

INSERT INTO `group_skor` (`id_group_skor`, `nama`) VALUES
(1, 'Potensi'),
(2, 'Kompetensi Inti'),
(3, 'Kompetensi Kepemimpinan'),
(4, 'Kompetensi Jabatan'),
(5, 'Kompetensi Teknis');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penilaian`
--

CREATE TABLE IF NOT EXISTS `hasil_penilaian` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(11) NOT NULL,
  `no_asesi` varchar(100) NOT NULL,
  `nama_asesi` varchar(100) NOT NULL,
  `potensi` int(50) NOT NULL,
  `uraian_potensi` varchar(100) NOT NULL,
  `inti` int(50) NOT NULL,
  `uraian_inti` varchar(100) NOT NULL,
  `kepemimpinan` int(50) NOT NULL,
  `uraian_kepemimpinan` varchar(100) NOT NULL,
  `jabatan` int(50) NOT NULL,
  `uraian_jabatan` varchar(100) NOT NULL,
  `teknis` int(50) NOT NULL,
  `uraian_teknis` varchar(100) NOT NULL,
  `total` int(50) NOT NULL,
  `rekomendasi` varchar(50) NOT NULL,
  `simpulan` varchar(100) NOT NULL,
  `saran` varchar(100) NOT NULL,
  `nama_asesor` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penilaian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hasil_penilaian`
--

INSERT INTO `hasil_penilaian` (`id_penilaian`, `id_kegiatan`, `no_asesi`, `nama_asesi`, `potensi`, `uraian_potensi`, `inti`, `uraian_inti`, `kepemimpinan`, `uraian_kepemimpinan`, `jabatan`, `uraian_jabatan`, `teknis`, `uraian_teknis`, `total`, `rekomendasi`, `simpulan`, `saran`, `nama_asesor`) VALUES
(6, 0, '1231122', 'Fizah muharrani', 35, 'Test potensi', 9, 'Test inti', 9, 'Test ', 9, 'Test Jabatan', 1, 'Test teknis', 62, 'Belum Memenuhi Persayaratan', 'bagus', 'coba lebih bagus', 'Fakhrul Aziz Ikhsanudin'),
(7, 15, '1231122', 'Fizah muharrani', 35, 'Uraian Potensi\r\n', 9, 'Uraian Kompetensi Inti\r\n\r\n', 9, 'Uraian Kompetensi Kepemimpinan\r\n', 9, 'Uraian Kompetensi Jabatan\r\n', 1, 'Uraian Kompetensi Jabatan\r\n', 62, 'Belum Memenuhi Persayaratan', 'bagus', 'coba lebih bagus', 'Fakhrul Aziz Ikhsanudin');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `proyek_mulai` varchar(50) NOT NULL,
  `proyek_selesai` varchar(50) NOT NULL,
  `note` varchar(300) NOT NULL,
  `id_asesor` varchar(30) NOT NULL,
  `bobot_p` int(10) NOT NULL,
  `bobot_i` int(10) NOT NULL,
  `bobot_j` int(11) NOT NULL,
  `bobot_k` int(10) NOT NULL,
  `bobot_t` int(11) NOT NULL,
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama`, `instansi`, `tanggal`, `proyek_mulai`, `proyek_selesai`, `note`, `id_asesor`, `bobot_p`, `bobot_i`, `bobot_j`, `bobot_k`, `bobot_t`) VALUES
(15, 'KPR Deployment', 'Danamon', '02/05/2015', '03/05/2015', '10/05/2015', 'test', '2', 21, 21, 21, 21, 21);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_inti`
--

CREATE TABLE IF NOT EXISTS `nilai_inti` (
  `id_nilai_inti` int(50) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(50) DEFAULT NULL,
  `integritas` int(50) DEFAULT NULL,
  `dorongan_berprestasi` int(50) DEFAULT NULL,
  `kepentingan` int(50) DEFAULT NULL,
  `kerja_sama` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_nilai_inti`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai_inti`
--

INSERT INTO `nilai_inti` (`id_nilai_inti`, `id_kegiatan`, `integritas`, `dorongan_berprestasi`, `kepentingan`, `kerja_sama`) VALUES
(6, 15, 55, 55, 55, 55);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_jabatan`
--

CREATE TABLE IF NOT EXISTS `nilai_jabatan` (
  `id_jabatan` int(50) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(50) NOT NULL,
  `kualitas` int(50) DEFAULT NULL,
  `pemikiran_analitis` int(50) DEFAULT NULL,
  `pemikiran_konseptual` int(50) DEFAULT NULL,
  `inisiatif` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai_jabatan`
--

INSERT INTO `nilai_jabatan` (`id_jabatan`, `id_kegiatan`, `kualitas`, `pemikiran_analitis`, `pemikiran_konseptual`, `inisiatif`) VALUES
(6, 15, 55, 55, 55, 55);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kepemimpinan`
--

CREATE TABLE IF NOT EXISTS `nilai_kepemimpinan` (
  `id_kepemimpinan` int(50) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(50) NOT NULL,
  `kepemimpinan` int(50) DEFAULT NULL,
  `pengembangan_kelompok` int(50) DEFAULT NULL,
  `pemimpin_perubahan` int(50) DEFAULT NULL,
  `pemahaman_strategis` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_kepemimpinan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai_kepemimpinan`
--

INSERT INTO `nilai_kepemimpinan` (`id_kepemimpinan`, `id_kegiatan`, `kepemimpinan`, `pengembangan_kelompok`, `pemimpin_perubahan`, `pemahaman_strategis`) VALUES
(6, 15, 55, 55, 55, 55);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_potensi`
--

CREATE TABLE IF NOT EXISTS `nilai_potensi` (
  `id_nilai_potensi` int(50) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(50) NOT NULL,
  `kecerdasan_umum` int(50) DEFAULT NULL,
  `daya_abstraksi` int(50) DEFAULT NULL,
  `daya_analisis` int(50) DEFAULT NULL,
  `kerja_sama` int(50) DEFAULT NULL,
  `kendali_emosi` int(50) DEFAULT NULL,
  `daya_tahan` int(50) DEFAULT NULL,
  `kepercayaan_diri` int(50) DEFAULT NULL,
  `motivasi_kerja` int(50) DEFAULT NULL,
  `sistematika_kerja` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_nilai_potensi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai_potensi`
--

INSERT INTO `nilai_potensi` (`id_nilai_potensi`, `id_kegiatan`, `kecerdasan_umum`, `daya_abstraksi`, `daya_analisis`, `kerja_sama`, `kendali_emosi`, `daya_tahan`, `kepercayaan_diri`, `motivasi_kerja`, `sistematika_kerja`) VALUES
(6, 15, 55, 55, 55, 55, 55, 55, 55, 55, 55);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_teknis`
--

CREATE TABLE IF NOT EXISTS `nilai_teknis` (
  `id_teknis` int(50) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(50) NOT NULL,
  `Teknis` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_teknis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `nilai_teknis`
--

INSERT INTO `nilai_teknis` (`id_teknis`, `id_kegiatan`, `Teknis`) VALUES
(5, 15, 55);

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
  `id_group_skor` int(11) NOT NULL,
  PRIMARY KEY (`id_skor`),
  KEY `id_group_skor` (`id_group_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `skor`
--

INSERT INTO `skor` (`id_skor`, `nama`, `id_group_skor`) VALUES
(1, 'Kepemimpinan', 3),
(2, 'Pengembangan Kelompok', 3),
(3, 'Pemimpin Perubahan', 3),
(4, 'Pemahaman strategis', 3),
(5, 'Peduli thp keteraturan & kualitas', 4),
(6, 'Pemikiran Analitis', 4),
(7, 'Pemikiran Konseptual', 4),
(8, 'Inisiatif', 4),
(9, 'Kecerdasan Umum', 1),
(10, 'Daya Abstraksi', 1),
(11, 'Daya Analisis - Sintensis', 1),
(12, 'Kerja sama', 1),
(13, 'Kendali Emosi', 1),
(14, 'Daya Tahan thp Stress', 1),
(15, 'Kepercayaan Diri', 1),
(16, 'Motivasi Kerja', 1),
(17, 'Sistematika Kerja', 1),
(18, 'Integritas', 2),
(19, 'Dorongan Berprestasi', 2),
(20, 'Pelayanan kpd Pemangku Kepentingan', 2),
(21, 'Kerja sama', 2),
(27, 'Teknis', 5);

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
-- Constraints for table `skor`
--
ALTER TABLE `skor`
  ADD CONSTRAINT `skor_ibfk_1` FOREIGN KEY (`id_group_skor`) REFERENCES `group_skor` (`id_group_skor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
