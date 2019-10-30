-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2019 pada 05.58
-- Versi server: 5.7.24
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` smallint(6) NOT NULL,
  `nama_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `nama_hotel`) VALUES
(1, 'the Rinra'),
(2, 'Myko Hotel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_evaluasi`
--

CREATE TABLE `tb_evaluasi` (
  `id_alternatif` smallint(11) NOT NULL,
  `id_kriteria` tinyint(4) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_evaluasi`
--

INSERT INTO `tb_evaluasi` (`id_alternatif`, `id_kriteria`, `value`) VALUES
(1, 1, 175),
(1, 2, 60),
(1, 3, 60),
(1, 4, 100),
(1, 5, 80),
(1, 6, 90),
(1, 7, 20),
(1, 8, 100),
(1, 9, 20),
(1, 10, 20),
(1, 11, 20),
(1, 12, 20),
(1, 13, 0),
(1, 14, 0),
(1, 15, 216),
(1, 16, 100),
(2, 1, 217),
(2, 2, 20),
(2, 3, 100),
(2, 4, 60),
(2, 5, 80),
(2, 6, 45),
(2, 7, 20),
(2, 8, 0),
(2, 9, 20),
(2, 10, 20),
(2, 11, 0),
(2, 12, 20),
(2, 13, 0),
(2, 14, 0),
(2, 15, 237),
(2, 16, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fasilitas`
--

CREATE TABLE `tb_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `jenis_fasilitas` varchar(50) NOT NULL,
  `jenis` enum('fasilitas') NOT NULL,
  `penilaian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_fasilitas`
--

INSERT INTO `tb_fasilitas` (`id_fasilitas`, `jenis_fasilitas`, `jenis`, `penilaian`) VALUES
(1, 'Kamar', 'fasilitas', '[{\"fasilitas\":\"10 - 49\",\"nilai\":\"1\"},{\"fasilitas\":\"50 - 99\",\"nilai\":\"1\"},{\"fasilitas\":\"> 100\",\"nilai\":\"1\"}]'),
(2, 'Kolam Renang', 'fasilitas', '[{\"fasilitas\":\"Ada\",\"nilai\":\"20\"},{\"fasilitas\":\"TIdak Ada\",\"nilai\":\"0\"}]'),
(3, 'Ruang Meeting', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(4, 'Ball Room', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(5, 'Restauran', 'fasilitas', '[{\"fasilitas\":\"Ada\",\"nilai\":\"20\"},{\"fasilitas\":\"Tidak Ada\",\"nilai\":\"0\"}]'),
(6, 'Area Parkir', 'fasilitas', '[{\"fasilitas\":\"Luas\",\"nilai\":\"90\"},{\"fasilitas\":\"Sempit\",\"nilai\":\"45\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(7, 'Fitness Room', 'fasilitas', '[{\"fasilitas\":\"Ada\",\"nilai\":\"20\"},{\"fasilitas\":\"Tidak Ada\",\"nilai\":\"0\"}]'),
(8, 'Mall', 'fasilitas', '[{\"fasilitas\":\"Ada\",\"nilai\":\"100\"},{\"fasilitas\":\"Tidak Ada\",\"nilai\":\"0\"}]'),
(9, 'Wifi', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(10, 'Roomserv', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(11, 'bus', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(12, 'Loudry', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"Tidak ada\",\"nilai\":\"0\"}]'),
(13, 'Drugst', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(14, 'Salon', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"20\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(15, 'Karyawan', 'fasilitas', '[{\"fasilitas\":\"ada\",\"nilai\":\"1\"},{\"fasilitas\":\"tidak ada\",\"nilai\":\"0\"}]'),
(16, 'Pelayanan', 'fasilitas', '[{\"fasilitas\":\"height\",\"nilai\":\"100\"},{\"fasilitas\":\"medium\",\"nilai\":\"50\"},{\"fasilitas\":\"low\",\"nilai\":\"25\"}]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hotel`
--

CREATE TABLE `tb_hotel` (
  `id_hotel` int(11) NOT NULL,
  `nama_hotel` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `status_baru` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `fasilitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_hotel`
--

INSERT INTO `tb_hotel` (`id_hotel`, `nama_hotel`, `status`, `status_baru`, `alamat`, `kontak`, `fasilitas`) VALUES
(1, 'the Rinra', 'Bintang 5', 'Belum Ada !', 'test', '924834', '[{\"fasilitas0\":\"Kamar\",\"nilai0\":\"1\",\"hasil0\":\"175\",\"jumlah0\":\"175\",\"gambar0\":\"20180701_104554.jpg\"},{\"fasilitas1\":\"Kolam Renang\",\"nilai1\":\"20\",\"hasil1\":\"60\",\"jumlah1\":\"3\",\"gambar1\":\"1464361061318.jpg\"},{\"fasilitas2\":\"Ruang Meeting\",\"nilai2\":\"20\",\"hasil2\":\"60\",\"jumlah2\":\"3\",\"gambar2\":\"1464361835772.jpg\"},{\"fasilitas3\":\"Ball Room\",\"nilai3\":\"20\",\"hasil3\":\"100\",\"jumlah3\":\"5\",\"gambar3\":\"1466942670912.jpg\"},{\"fasilitas4\":\"Restauran\",\"nilai4\":\"20\",\"hasil4\":\"80\",\"jumlah4\":\"4\",\"gambar4\":\"1465784644339.jpg\"},{\"fasilitas5\":\"Area Parkir\",\"nilai5\":\"90\",\"hasil5\":\"90\",\"jumlah5\":\"1\",\"gambar5\":\"1464607949306.jpg\"},{\"fasilitas6\":\"Fitness Room\",\"nilai6\":\"20\",\"hasil6\":\"20\",\"jumlah6\":\"1\",\"gambar6\":\"1464501785699.jpg\"},{\"fasilitas7\":\"Mall\",\"nilai7\":\"100\",\"hasil7\":\"100\",\"jumlah7\":\"1\",\"gambar7\":\"army__hendrygeorge-com25291.jpg\"},{\"fasilitas8\":\"Wifi\",\"nilai8\":\"20\",\"hasil8\":\"20\",\"jumlah8\":\"1\",\"gambar8\":\"1486908862402.jpg\"},{\"fasilitas9\":\"Roomserv\",\"nilai9\":\"20\",\"hasil9\":\"20\",\"jumlah9\":\"1\",\"gambar9\":\"1486908336184.jpg\"},{\"fasilitas10\":\"bus\",\"nilai10\":\"20\",\"hasil10\":\"20\",\"jumlah10\":\"1\",\"gambar10\":\"1483582127799.jpg\"},{\"fasilitas11\":\"Loudry\",\"nilai11\":\"20\",\"hasil11\":\"20\",\"jumlah11\":\"1\",\"gambar11\":\"FB_20150705_10_07_02_Saved_Picture.jpg\"},{\"fasilitas12\":\"Drugst\",\"nilai12\":\"0\",\"hasil12\":\"0\",\"jumlah12\":\"0\",\"gambar12\":\"EVE-icon.png\"},{\"fasilitas13\":\"Salon\",\"nilai13\":\"0\",\"hasil13\":\"0\",\"jumlah13\":\"0\",\"gambar13\":\"bb6199fc8f77e55c304d9fc462e717f83ac07962_hq.jpg\"},{\"fasilitas14\":\"Karyawan\",\"nilai14\":\"1\",\"hasil14\":\"216\",\"jumlah14\":\"216\",\"gambar14\":\"none_picture.png\"},{\"fasilitas15\":\"Pelayanan\",\"nilai15\":\"100\",\"hasil15\":\"100\",\"jumlah15\":0,\"gambar15\":\"none_picture.png\"}]'),
(2, 'Myko Hotel', 'Bintang 4', 'Belum Ada !', 'Jl. Boulevard', '235624', '[{\"fasilitas0\":\"Kamar\",\"nilai0\":\"1\",\"hasil0\":\"217\",\"jumlah0\":\"217\",\"gambar0\":\"v.jpg\"},{\"fasilitas1\":\"Kolam Renang\",\"nilai1\":\"20\",\"hasil1\":\"20\",\"jumlah1\":\"1\",\"gambar1\":\"kolam renang.jpg\"},{\"fasilitas2\":\"Ruang Meeting\",\"nilai2\":\"20\",\"hasil2\":\"100\",\"jumlah2\":\"5\",\"gambar2\":\"meting.jpg\"},{\"fasilitas3\":\"Ball Room\",\"nilai3\":\"20\",\"hasil3\":\"60\",\"jumlah3\":\"3\",\"gambar3\":\"ballroom.jpg\"},{\"fasilitas4\":\"Restauran\",\"nilai4\":\"20\",\"hasil4\":\"80\",\"jumlah4\":\"4\",\"gambar4\":\"restauran.jpg\"},{\"fasilitas5\":\"Area Parkir\",\"nilai5\":\"45\",\"hasil5\":\"45\",\"jumlah5\":\"1\",\"gambar5\":\"parkir.jpg\"},{\"fasilitas6\":\"Fitness Room\",\"nilai6\":\"20\",\"hasil6\":\"20\",\"jumlah6\":\"1\",\"gambar6\":\"fitness.jpg\"},{\"fasilitas7\":\"Mall\",\"nilai7\":\"0\",\"hasil7\":\"0\",\"jumlah7\":\"0\",\"gambar7\":\"Screenshot_20190120-071242.png\"},{\"fasilitas8\":\"Wifi\",\"nilai8\":\"20\",\"hasil8\":\"20\",\"jumlah8\":\"1\",\"gambar8\":\"Screenshot_20190121-081053.png\"},{\"fasilitas9\":\"Roomserv\",\"nilai9\":\"20\",\"hasil9\":\"20\",\"jumlah9\":\"1\",\"gambar9\":\"Screenshot_20190120-132342.png\"},{\"fasilitas10\":\"bus\",\"nilai10\":\"0\",\"hasil10\":\"0\",\"jumlah10\":\"0\",\"gambar10\":\"t.jpg\"},{\"fasilitas11\":\"Loudry\",\"nilai11\":\"20\",\"hasil11\":\"20\",\"jumlah11\":\"1\",\"gambar11\":\"Screenshot_20190117-102948.png\"},{\"fasilitas12\":\"Drugst\",\"nilai12\":\"0\",\"hasil12\":\"0\",\"jumlah12\":\"0\",\"gambar12\":\"Screenshot_20190116-164952.png\"},{\"fasilitas13\":\"Salon\",\"nilai13\":\"0\",\"hasil13\":\"0\",\"jumlah13\":\"0\",\"gambar13\":\"Screenshot_20190120-103534.png\"},{\"fasilitas14\":\"Karyawan\",\"nilai14\":\"1\",\"hasil14\":\"237\",\"jumlah14\":\"237\",\"gambar14\":\"none_picture.png\"},{\"fasilitas15\":\"Pelayanan\",\"nilai15\":\"100\",\"hasil15\":\"100\",\"jumlah15\":0,\"gambar15\":\"none_picture.png\"}]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpl_dinas`
--

CREATE TABLE `tb_kpl_dinas` (
  `id_kpl_dinas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `nrp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kpl_dinas`
--

INSERT INTO `tb_kpl_dinas` (`id_kpl_dinas`, `nama`, `jabatan`, `nrp`) VALUES
(1, 'Billy Eden William Asrul, S.Kom., MT.', 'Mahasiswa', '2015020014');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` tinyint(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `weight` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kriteria`, `weight`) VALUES
(1, 'Kamar', 15),
(2, 'Kolam Renang', 5),
(3, 'Ruang Meeting', 10),
(4, 'Ball Room', 10),
(5, 'Restauran', 10),
(6, 'Area Parkir', 5),
(7, 'Fitness Room', 5),
(8, 'Mall', 10),
(9, 'wifi', 5),
(10, 'roomserv', 5),
(11, 'bus', 5),
(12, 'Loudry', 5),
(13, 'Drugst', 5),
(14, 'Salon', 5),
(15, 'Karyawan', 5),
(16, 'Pelayanan', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passname` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` enum('admin','lsup','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `passname`, `password`, `level`) VALUES
(1, 'admin', 'admin', '$2y$10$woBQK/CsluBM6D7cVjWMCuAzTrM2hALarTHpQlP87KA8YD5kZO/0S', 'admin'),
(3, 'LSUP', 'lsup', '$2y$10$HiEeYHoiP./7aVttogSX2Os6D3HxkpwmU1Ajo6DUQh0n9ySpsKS1i', 'lsup'),
(4, 'petugas', 'petugas', '$2y$10$74RV6Cy/2F.Gup43ETZAeOad8G8odrqfN8DJJijOgcnSk88HOgs.G', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_owner`
--

CREATE TABLE `tb_user_owner` (
  `id_hotel` varchar(10) NOT NULL,
  `nama_hotel` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passname` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` enum('owner','konfirmasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indeks untuk tabel `tb_hotel`
--
ALTER TABLE `tb_hotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_owner`
--
ALTER TABLE `tb_user_owner`
  ADD PRIMARY KEY (`id_hotel`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
