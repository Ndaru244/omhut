-- phpMyAdmin SQL Dump
-- version 5.2.1-1.fc38
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Mar 2024 pada 10.28
-- Versi server: 10.5.23-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omhut_parkopi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `detail_id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumbel` int(11) NOT NULL,
  `status_detail` varchar(50) NOT NULL,
  `head_chef` varchar(100) NOT NULL,
  `delivery_person` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`detail_id`, `id_order`, `id_menu`, `jumbel`, `status_detail`, `head_chef`, `delivery_person`) VALUES
(1, 246719, 5, 1, 'selesai', 'siti-astuti', 'udin-16'),
(2, 246719, 9, 1, 'selesai', 'siti-astuti', 'faye-18'),
(3, 246719, 7, 2, 'selesai', 'victor-10', 'faye-18'),
(4, 247420, 3, 2, 'selesai', 'victor-10', 'udin-16'),
(5, 247420, 11, 1, 'selesai', 'siti-astuti', 'udin-16'),
(6, 245171, 3, 1, 'selesai', 'victor-10', 'faye-18'),
(7, 245171, 4, 1, 'selesai', 'victor-10', 'faye-18'),
(8, 245171, 7, 1, 'selesai', 'victor-10', 'udin-16'),
(9, 245171, 5, 1, 'selesai', 'siti-astuti', 'udin-16'),
(10, 243156, 3, 1, 'selesai', 'victor-10', 'udin-16'),
(11, 249019, 11, 1, 'selesai', 'siti-astuti', 'faye-18'),
(12, 241729, 12, 1, 'selesai', 'siti-astuti', 'udin-16'),
(13, 245173, 12, 1, 'dibatalkan', '', ''),
(14, 245173, 6, 1, 'dibatalkan', '', ''),
(15, 247956, 6, 1, 'selesai', 'victor-10', 'faye-18'),
(16, 247956, 12, 1, 'selesai', 'siti-astuti', 'udin-16'),
(17, 247243, 7, 1, 'selesai', 'victor-10', 'faye-18'),
(18, 247243, 9, 1, 'selesai', 'siti-astuti', 'faye-18'),
(19, 249315, 5, 1, 'selesai', 'siti-astuti', 'faye-18'),
(20, 249315, 7, 1, 'selesai', 'victor-10', 'faye-18'),
(21, 244526, 13, 2, 'selesai', 'siti-astuti', 'udin-16'),
(22, 244526, 7, 1, 'selesai', 'victor-10', 'udin-16'),
(23, 246407, 5, 2, 'menunggu dibuat', '', ''),
(24, 246407, 3, 1, 'menunggu dibuat', '', ''),
(25, 248295, 5, 1, 'menunggu pembayaran', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja`
--

CREATE TABLE `meja` (
  `kd_meja` varchar(11) NOT NULL,
  `qr_meja` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `meja`
--

INSERT INTO `meja` (`kd_meja`, `qr_meja`) VALUES
('F0M1', 'QR_F0M1.png'),
('F0M2', 'QR_F0M2.png'),
('F0M3', 'QR_F0M3.png'),
('F0M4', 'QR_F0M4.png'),
('F0M5', 'QR_F0M5.png'),
('F0M6', 'QR_F0M6.png'),
('F0M7', 'QR_F0M7.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `jenis_menu` varchar(25) NOT NULL,
  `gambar_menu` text NOT NULL,
  `status_menu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga_menu`, `jenis_menu`, `gambar_menu`, `status_menu`) VALUES
(3, 'Beef Yakiniku', 45000, 'makanan', 'Beef_Yakiniku.png', 'tersedia'),
(4, 'Ayam Geprek', 35000, 'makanan', 'Ayam_Geprek.png', 'tersedia'),
(5, 'Caramel Macchiato Coffee (Cold)', 31000, 'minuman', 'Caramel_Macchiato_Coffee(Cold).png', 'tersedia'),
(6, 'Chicken Bolognese', 35000, 'makanan', 'Chicken_Bolognese.png', 'tersedia'),
(7, 'Chicken Sambal Matah', 35000, 'makanan', 'Chicken_Sambal_Matah.png', 'tersedia'),
(8, 'Chicken Siomay', 35000, 'makanan', 'Chicken_Siomay.png', 'kosong'),
(9, 'Cold Brew 250ml', 22000, 'minuman', 'Cold_Brew_250ml.png', 'tersedia'),
(10, 'Es Kopi Om Hut', 26000, 'minuman', 'Es_Kopi_Om_Hut.png', 'kosong'),
(11, 'V60 Arabica Gayo Wine', 36000, 'minuman', 'V60_Arabica_Gayo_Wine.png', 'tersedia'),
(12, 'Affogato', 28000, 'minuman', 'Affogato.png', 'tersedia'),
(13, 'Vietnam Coffee', 19996, 'minuman', 'Vietnam_Coffee.png', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `pemesan` text NOT NULL,
  `kd_meja` varchar(11) NOT NULL,
  `responsible_person` varchar(100) NOT NULL,
  `status_order` varchar(50) NOT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `pemesan`, `kd_meja`, `responsible_person`, `status_order`, `tanggal_pesan`) VALUES
(241729, 'Ndaru', 'F0M1', 'udin-16', 'selesai', '2024-01-24 16:46:17'),
(243156, 'Crazyrich', 'F0M4', 'udin-16', 'selesai', '2024-01-24 16:32:18'),
(244526, 'Ndaru', 'F0M3', 'faye-18', 'selesai', '2024-01-29 18:33:16'),
(245171, 'Dimas', 'F0M2', 'udin-16', 'selesai', '2024-01-24 16:31:41'),
(245173, 'Ndaru', 'F0M3', 'faye-18', 'dibatalkan', '2024-01-25 17:06:18'),
(246407, 'Ndaru', 'F0M5', 'udin-16', 'sudah bayar', '2024-02-13 10:01:11'),
(246719, 'Yanva', 'F0M6', 'faye-18', 'selesai', '2024-01-28 03:10:45'),
(247243, 'Danu', 'F0M4', 'udin-16', 'selesai', '2024-01-28 09:36:05'),
(247420, 'Mastin', 'F0M6', 'faye-18', 'selesai', '2024-01-28 03:10:41'),
(247956, 'Alan', 'F0M4', 'udin-16', 'selesai', '2024-01-25 19:07:48'),
(248295, 'Ndaru', 'F0M5', '', 'belum bayar', '2024-02-13 10:00:34'),
(249019, 'Khairul Hippo', 'F0M6', 'udin-16', 'selesai', '2024-01-28 03:10:38'),
(249315, 'Santoso', 'F0M3', 'faye-18', 'selesai', '2024-01-28 09:38:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `username_pegawai` varchar(100) NOT NULL,
  `password_pegawai` varchar(100) NOT NULL,
  `role_pegawai` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username_pegawai`, `password_pegawai`, `role_pegawai`) VALUES
(1, 'admin-omhut', '$2y$10$Bxq/BV.himI8U24YCtPEC.fNefiIkR14bdcPo4RrhDRQhC2C2jr0O', 'admin'),
(2, 'udin-16', '$2y$10$k1TAo04k3a2o0xIXEKwY/O5OHenVh3IYKaQFUA187TuOqxAWe0VCu', 'kasir'),
(4, 'siti-astuti', '$2y$10$dQgfYiO6LQ40IY0l9ORbZOaTjqM3jyntHGm.TKQOvAAPOsC1oO6Ou', 'barista'),
(5, 'victor-10', '$2y$10$9GsoBT0MxlyTvRSQxsWTouVJ0WPWNukJWKkM9y3Bfau6.4b59lu0a', 'kitchen'),
(6, 'faye-18', '$2y$10$F/g5iJhf9u2SHpF/TbkWUOMwBtbnQ0FyCv31P7eydxToliDmrqgdu', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `status_item` varchar(25) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `warehouse`
--

INSERT INTO `warehouse` (`id`, `nama_item`, `jumlah_item`, `status_item`, `tanggal`) VALUES
(1, 'Arabika Gayo 1KG', 10, 'masuk', '2024-01-25 18:15:46'),
(2, 'Arabika Java 1KG', 20, 'masuk', '2024-01-25 18:16:50'),
(3, 'Arabika Gayo 1KG	', 5, 'keluar', '2024-01-25 18:21:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indeks untuk tabel `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`kd_meja`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
