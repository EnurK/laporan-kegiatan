-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2021 pada 12.45
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kegiatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `nama`, 'kecamatan', `email`, `password`) VALUES
(1, '32106071219990006', 'Ari Sumardi', 'Sariwangi','ari.sumardi@gmail.com', 'd9a8c6c010a37fdc9850fe6d8c064880'),
(2, '32208292202101997', 'Deni Mary', 'Leuwisari','deni.mary@gmail.com', 'e518fe30d1041b71415a3a943e970cc7'),
(4, '32201292309101998', 'Abdul Rizwan', 'Singaparna', 'abdul.rizwan@gmail.com', '30abec4656e3c3a99100e255cac389c6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kegiatan`
--

CREATE TABLE `tbl_kegiatan` (
  `id_kegiatan` int(10) NOT NULL,
  `subjek_kegiatan` varchar(150) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `tempat_kegiatan` text NOT NULL,
  `bukti_kegiatan` varchar(100) DEFAULT NULL,
  `balasan_kegiatan` enum('Belum','Proses','Selesai') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kegiatan`
--

INSERT INTO `tbl_kegiatan` (`id_kegiatan`, `subjek_kegiatan`, `tgl_kegiatan`, `tempat_kegiatan`, `bukti_kegiatan`, `balasan_kegiatan`, `id_user`) VALUES
(46, 'Raker PKD', '2021-04-03', 'Hotel Alhambra', 'contoh perataan histogram.png', 'Selesai', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(16) NOT NULL,
  `password` varchar(150) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `email`, `telepon`, `password`) VALUES
(1, 'Ari Admin', 'admin@gmail.com', '089651900165', '21232f297a57a5a743894a0e4a801fc3',);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tanggapan`
--

CREATE TABLE `tbl_tanggapan` (
  `id_tanggapan` int(10) NOT NULL,
  `tgl_balas_tanggapan` date NOT NULL,
  `status_tanggapan` enum('Proses','Selesai') NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `id_admin` int(10) NOT NULL,
  `id_kegiatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tanggapan`
--

INSERT INTO `tbl_tanggapan` (`id_tanggapan`, `tgl_balas_tanggapan`, `status_tanggapan`, `isi_tanggapan`, `id_petugas`, `id_kegiatan`) VALUES
(6, '2021-04-03', 'Selesai', 'Terimakasih', 2, 46);

--
-- Trigger `tbl_tanggapan`
--
DELIMITER $$
CREATE TRIGGER `update_balasan` AFTER INSERT ON `tbl_tanggapan` FOR EACH ROW UPDATE tbl_pengaduan SET
balasan_pengaduan = NEW.status_tanggapan
WHERE id_pengaduan = NEW.id_pengaduan
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_tanggapan`
--
ALTER TABLE `tbl_tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  MODIFY `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_tanggapan`
--
ALTER TABLE `tbl_tanggapan`
  MODIFY `id_tanggapan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
