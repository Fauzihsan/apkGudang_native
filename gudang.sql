-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2021 pada 15.30
-- Versi server: 10.1.19-MariaDB
-- Versi PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `namaDepan` varchar(30) NOT NULL,
  `namaBelakang` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `namaDepan`, `namaBelakang`, `email`, `username`, `password`, `code`, `status`) VALUES
(61, 'Muhammad', 'Ihsan', 'muhammadihsan10.mifr@gmail.com', 'ihsanfa', '$2y$10$mJzaKfh17CgdGud08uusF.ce4n16wAptJZkne0umYFDXwfmB8/4F.', 0, 'verified'),
(62, 'adit', 'adit', 'luckiers15@gmail.com', 'adit', '$2y$10$faarNCFQv2zinxJ/eR3fVuVKb9E8UHh9KuF/ggoqKx5EFj2/TThNS', 0, 'verified'),
(63, 'adit', 'adit', 'mawanboy08@gmail.com', 'aher', '$2y$10$/T4ankbvqu8KgrZibWVYMOmxVkuSx1IR1ClXG5m1kmJ1gPHEZOl1K', 0, 'verified'),
(64, 'zamzam', 'zamzam', 'zamzam2117@gmail.com', 'zamzam', '$2y$10$LlzbwQ5Bu13mMwb5KKfx..9myg36qc8eJuCwVfDHnAxIs.9zQRsKK', 0, 'verified');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `mBarang` varchar(30) NOT NULL,
  `jBarang` varchar(30) NOT NULL,
  `stock` int(255) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `qty` int(255) NOT NULL,
  `satuanQty` varchar(10) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `mBarang`, `jBarang`, `stock`, `satuan`, `qty`, `satuanQty`, `user`) VALUES
(9, 'Ultra Milk', 'Susu', 20, 'Dus', 10, 'Pcs', 'ihsanfa'),
(10, 'Susu Zee', 'Susu', 20, 'Dus', 10, 'Pcs', 'opet'),
(11, 'Gucci', 'Pakaian', 12, 'Pack', 4, 'Pcs', 'aher'),
(12, 'Ultra Milk', 'Minuman', 21, '', 12, '', 'ihsanfa'),
(13, 'haha', 'haha', 20, 'Pack', 21, 'Renceng', 'adit'),
(14, 'hah', 'hah', 20, 'Pack', 20, 'Renceng', 'adit'),
(15, 'laptop', 'barang elektronik', 5, 'Pack', 5, 'KG', 'zamzam'),
(16, 'hahahahIhsan', 'hahahaha', 20, 'Dus', 12, 'Pcs', 'ihsanfa'),
(17, 'Teh kotak', 'minuman', 12, 'Pack', 5, 'Pcs', 'aher');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarpegawai`
--

CREATE TABLE `daftarpegawai` (
  `id` int(11) NOT NULL,
  `namaDepan` varchar(30) NOT NULL,
  `namaBelakang` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftarpegawai`
--

INSERT INTO `daftarpegawai` (`id`, `namaDepan`, `namaBelakang`, `email`) VALUES
(1, 'Muhammad', 'Ihsan', 'muhammadihsan10.mifr@gmail.com'),
(2, 'adit', 'adit', 'luckiers15@gmail.com'),
(3, 'adit', 'adit', 'mawanboy08@gmail.com'),
(4, 'zamzam', 'zamzam', 'zamzam2117@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftarpegawai`
--
ALTER TABLE `daftarpegawai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `daftarpegawai`
--
ALTER TABLE `daftarpegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
