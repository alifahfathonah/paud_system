-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2016 at 05:33 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabout`
--

CREATE TABLE `tabout` (
  `id` int(11) NOT NULL,
  `about` text NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabout`
--

INSERT INTO `tabout` (`id`, `about`, `create_at`, `update_at`) VALUES
(1, 'Visi :  Meningkatkan kualitas kesehatan masyarakat khususnya pada balita dalam rangka mewujudkan tunas bangsa yang berkualitas.\r\nMisi : Memberikan pendidikan kepada anak khususnya kepada balita dengan mengacu pada panduan yang telah diberikan oleh Dinas Pendidikan Daerah Istimewa Yogyakarta dan Direktorat PAUD.', '2015-11-19 00:00:00', '2015-11-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tagama`
--

CREATE TABLE `tagama` (
  `id` int(11) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagama`
--

INSERT INTO `tagama` (`id`, `agama`, `deskripsi`) VALUES
(1, 'Islam', 'Agama islam'),
(2, 'Kristen', 'Agama Kristen'),
(3, 'Katholik', 'Agama Katholik'),
(4, 'Hindu', 'Agama Hindu'),
(5, 'Buddha', 'Agama Buddha');

-- --------------------------------------------------------

--
-- Table structure for table `tjenis_kelamin`
--

CREATE TABLE `tjenis_kelamin` (
  `id` int(11) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tjenis_kelamin`
--

INSERT INTO `tjenis_kelamin` (`id`, `jenis_kelamin`, `deskripsi`) VALUES
(1, 'Laki-laki', 'Jenis Kelamin Laki-laki'),
(2, 'Perempuan', 'Jenis Kelamin Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `tkaryawan`
--

CREATE TABLE `tkaryawan` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `nuptk` int(20) NOT NULL,
  `status` int(11) NOT NULL,
  `agama` int(1) NOT NULL,
  `tempat_lahir` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `masakerja_seluruhnya` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(10) NOT NULL,
  `tahun_lulus` int(11) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `pelatihan_berjenjang` varchar(50) NOT NULL,
  `mengajar_kelompok` varchar(50) NOT NULL,
  `jumlah_jam` varchar(30) NOT NULL,
  `negara_id` int(11) NOT NULL,
  `propinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkaryawan`
--

INSERT INTO `tkaryawan` (`id`, `nama_lengkap`, `jenis_kelamin`, `nuptk`, `status`, `agama`, `tempat_lahir`, `tanggal_lahir`, `tanggal_masuk`, `masakerja_seluruhnya`, `pendidikan_terakhir`, `tahun_lulus`, `jurusan`, `pelatihan_berjenjang`, `mengajar_kelompok`, `jumlah_jam`, `negara_id`, `propinsi_id`, `kota_id`, `deskripsi`, `image`, `create_at`, `update_at`) VALUES
(8, 'Afani Saleh', 1, 2147483647, 2, 1, 7, '1991-11-17', '2012-08-18', '4 tahun 8 bulan', 'S1', 2012, 'Teknik Informatika', '-', '-', '2 jam', 2, 1, 1, 'j. cihampelas no 43', 'images/P1010025.JPG', '2015-11-19 00:00:00', '2015-11-19 00:00:00'),
(9, 'Waryuni Badriyah', 2, 2147483647, 1, 1, 12, '1983-11-11', '2011-11-17', '3 tahun 8 bulan', 'S1', 2011, 'Ilmu Sosial', '-', '-', '2 jam', 2, 3, 12, 'j. ringin raya no 89', 'images/dsc_1085.jpg', '2015-11-19 00:00:00', '2015-11-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tkegiatan`
--

CREATE TABLE `tkegiatan` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(30) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkegiatan`
--

INSERT INTO `tkegiatan` (`id`, `kegiatan`, `deskripsi`) VALUES
(6, 'Menggambar', 'Peserta didik akan melakukan kegiatan menggambar'),
(7, 'Bernyanyi', 'peserta didik akan bernyanyi bersama');

-- --------------------------------------------------------

--
-- Table structure for table `tkota`
--

CREATE TABLE `tkota` (
  `id` int(11) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `propinsi_id` int(11) NOT NULL,
  `negara_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkota`
--

INSERT INTO `tkota` (`id`, `kota`, `deskripsi`, `propinsi_id`, `negara_id`) VALUES
(1, 'bandung', 'bandung', 1, 2),
(6, 'Bandung', 'Kota Bandung', 1, 2),
(7, 'Indramayu', 'kota Indramayu', 1, 2),
(8, 'Bekasi', 'kota Bekasi', 1, 2),
(9, 'Semarang', 'kota Semarang', 2, 2),
(10, 'klaten', 'Kota Klaten', 2, 2),
(11, 'Magelang', 'kota Magelang', 2, 2),
(12, 'Sleman', 'kota Sleman', 3, 2),
(13, 'Bantul', 'Kota Bantul', 3, 2),
(14, 'Yogyakarta', 'Kota Yogyakarta', 3, 2),
(15, 'Kuala Lumpur', 'kota Kuala lumpur', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tnegara`
--

CREATE TABLE `tnegara` (
  `id` int(11) NOT NULL,
  `negara` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tnegara`
--

INSERT INTO `tnegara` (`id`, `negara`, `deskripsi`) VALUES
(2, 'Indonesia', 'Negara Indonesia'),
(3, 'Malaysia', 'Negara Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `tpekerjaan`
--

CREATE TABLE `tpekerjaan` (
  `id` int(11) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpekerjaan`
--

INSERT INTO `tpekerjaan` (`id`, `pekerjaan`, `deskripsi`) VALUES
(1, 'Ibu Rumah Tangga', 'ibu rumah tangga'),
(2, 'Pegawai Negeri Sipil', 'PNS'),
(3, 'pedagang', 'pedagang'),
(4, 'Petani', 'Petani'),
(5, 'Guru', 'Guru'),
(6, 'Wiraswasta', 'wiraswasta');

-- --------------------------------------------------------

--
-- Table structure for table `tpeserta_didik`
--

CREATE TABLE `tpeserta_didik` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `tempat_lahir` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` int(1) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `pekerjaan_orangtua` int(11) NOT NULL,
  `negara_id` int(11) NOT NULL,
  `propinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpeserta_didik`
--

INSERT INTO `tpeserta_didik` (`id`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `nama_ibu`, `pekerjaan_orangtua`, `negara_id`, `propinsi_id`, `kota_id`, `deskripsi`, `image`, `create_at`, `update_at`) VALUES
(1, 'Devi ardiana', 1, 1, '2008-11-09', 1, 'siti aminah', 1, 2, 2, 6, 'jl. prambanan no 76', 'images/Cara-Mendidik-Anak-Yang-Baik-Dan-Pintar.jpg', '2015-11-19 00:00:00', '2015-11-19 00:00:00'),
(2, 'Aar Armayadi', 1, 8, '2008-11-10', 1, 'indah', 2, 2, 2, 9, 'jl. bawen no 76', 'images/anak pintar mendidik cerdas.jpg', '2015-11-19 00:00:00', '2015-11-19 00:00:00'),
(3, 'Cahyanti Mandasari', 2, 1, '2008-11-17', 1, 'Susi', 3, 2, 3, 13, 'jl. banguntapan no 23', 'images/103.jpg', '2015-11-19 00:00:00', '2015-11-19 00:00:00'),
(4, 'Latri Wulan', 2, 11, '2007-11-10', 1, 'siska', 6, 2, 3, 14, 'jl. yogyakarta no 54', 'images/anak-dengan-kaya-kosakata-berpeluang-berprilaku-baik-dan-pintar-163898-1.jpg', '2015-11-19 00:00:00', '2015-11-19 00:00:00'),
(5, 'Afani Saleh', 1, 6, '2015-11-20', 1, 'indah', 1, 2, 3, 12, 'desa condong catur', 'images/103.jpg', '2015-11-20 00:00:00', '2015-11-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tpropinsi`
--

CREATE TABLE `tpropinsi` (
  `id` int(11) NOT NULL,
  `propinsi` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `negara_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpropinsi`
--

INSERT INTO `tpropinsi` (`id`, `propinsi`, `deskripsi`, `negara_id`) VALUES
(1, 'Jawa Barat', 'Propinsi Jawa Barat', 2),
(2, 'Jawa Tengah', 'Propinsi Jawa Tengah', 2),
(3, 'Yogyakarta', 'D.I Yogyakarta', 2),
(4, 'Kuala Lumpur', 'Propinsi Kuala Lumpur', 3),
(5, 'Johor', 'Propinsi Johor', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id` int(11) NOT NULL,
  `nama_pendek` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rpassword` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id`, `nama_pendek`, `username`, `password`, `rpassword`, `level`, `status`, `create_at`, `update_at`) VALUES
(2, 'afan', 'afan', '31d2ded22b8d2c27df1f45357f3a101b', '31d2ded22b8d2c27df1f45357f3a101b', 1, 1, '2015-11-16 22:31:42', '2015-11-16 00:00:00'),
(3, 'admin', 'admin', '200ceb26807d6bf99fd6f4f0d1ca54d4', '200ceb26807d6bf99fd6f4f0d1ca54d4', 1, 1, '2015-11-16 00:00:00', '2015-11-19 00:00:00'),
(4, 'operator', 'operator', '00a21fa40489210c5d82b75294bcb03a', '00a21fa40489210c5d82b75294bcb03a', 2, 1, '2015-11-19 00:00:00', '2015-11-19 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabout`
--
ALTER TABLE `tabout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagama`
--
ALTER TABLE `tagama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tjenis_kelamin`
--
ALTER TABLE `tjenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tkaryawan`
--
ALTER TABLE `tkaryawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tkota`
--
ALTER TABLE `tkota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tnegara`
--
ALTER TABLE `tnegara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpekerjaan`
--
ALTER TABLE `tpekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpeserta_didik`
--
ALTER TABLE `tpeserta_didik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpropinsi`
--
ALTER TABLE `tpropinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabout`
--
ALTER TABLE `tabout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tagama`
--
ALTER TABLE `tagama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tjenis_kelamin`
--
ALTER TABLE `tjenis_kelamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tkaryawan`
--
ALTER TABLE `tkaryawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tkota`
--
ALTER TABLE `tkota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tnegara`
--
ALTER TABLE `tnegara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tpekerjaan`
--
ALTER TABLE `tpekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tpeserta_didik`
--
ALTER TABLE `tpeserta_didik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tpropinsi`
--
ALTER TABLE `tpropinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
