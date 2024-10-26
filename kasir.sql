-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Mar 2023 pada 00.22
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `user_id`, `nama`, `stok`, `harga`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'BR0001', 2, 'Spicy Chicken', '25', '18000', '17000', 'pcs', '2022-06-06 03:01:55', '2022-06-06 07:33:11'),
(2, 'BR0002', 2, 'Chicken Katsu Isi 5', '29', '30000', '29000', 'pcs', '2022-06-06 03:01:55', '2022-06-21 02:40:57'),
(3, 'BR0003', 2, 'Sosis Alana (Original)', '30', '15000', '14000', 'pcs', '2022-06-06 03:01:55', '2022-06-06 07:29:50'),
(4, 'BR0004', NULL, 'Chicken Wings Pizza Hut', '9', '25000', '24000', 'pcs', '2022-06-06 07:30:10', '2022-06-25 10:15:18'),
(5, 'BR0005', NULL, 'Shrimp Roll', '47', '18000', '17000', 'pcs', '2022-06-06 07:30:30', '2022-06-25 10:15:18'),
(7, 'BR0006', NULL, 'Kentang Soestring', '20', '25000', '24000', 'kg', '2022-06-25 10:12:27', '2022-06-25 10:12:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `kode_barang_keluar`, `barang_id`, `user_id`, `jumlah_keluar`, `stok_akhir`, `created_at`, `updated_at`) VALUES
(1, 'BRK202206060001', 5, 3, 1, 49, '2022-06-06 07:36:47', '2022-06-06 07:36:47'),
(2, 'BRK202206060002', 2, 3, 1, 29, '2022-06-21 02:40:57', '2022-06-21 02:40:57'),
(3, 'BRK202206060003', 5, 3, 1, 48, '2022-06-25 09:55:44', '2022-06-25 09:55:44'),
(5, 'BRK202206060004', 4, 3, 1, 9, '2022-06-25 10:15:18', '2022-06-25 10:15:18'),
(6, 'BRK202206060005', 5, 3, 1, 47, '2022-06-25 10:15:18', '2022-06-25 10:15:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `kode_barang_masuk`, `barang_id`, `user_id`, `jumlah_masuk`, `stok_akhir`, `created_at`, `updated_at`) VALUES
(1, 'BRM202206060001', 1, 2, 25, 25, '2022-06-06 07:34:18', '2022-06-06 07:34:18'),
(2, 'BRM202206060002', 2, 2, 30, 30, '2022-06-06 07:34:28', '2022-06-06 07:34:28'),
(3, 'BRM202206060003', 3, 2, 30, 30, '2022-06-06 07:34:37', '2022-06-06 07:34:37'),
(4, 'BRM202206060004', 4, 2, 10, 10, '2022-06-06 07:34:50', '2022-06-06 07:34:50'),
(5, 'BRM202206060005', 5, 2, 50, 50, '2022-06-06 07:35:01', '2022-06-06 07:35:01'),
(7, 'BRM202206060006', 7, 2, 20, 20, '2022-06-25 10:13:11', '2022-06-25 10:13:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_metode_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `metode_bayar`
--

INSERT INTO `metode_bayar` (`id`, `kode_metode_bayar`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'MB001', 'Tunai', '2022-06-06 03:01:55', '2022-06-06 03:01:55'),
(2, 'MB002', 'Dana', '2022-06-06 03:01:55', '2022-06-06 03:01:55'),
(3, 'MB003', 'BCA Transfer', '2022-06-06 03:01:55', '2022-06-06 03:01:55'),
(5, 'MB004', 'OVO', '2022-06-25 10:10:15', '2022-06-25 10:10:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_04_14_065311_create_barangs_table', 1),
(4, '2022_04_14_075512_create_barang_masuks_table', 1),
(5, '2022_04_14_075630_create_barang_keluars_table', 1),
(6, '2022_04_14_163642_create_pesanans_table', 1),
(7, '2022_04_14_164028_create_pesanan_details_table', 1),
(8, '2022_04_28_131114_add_user_id_to_barangs_table', 1),
(9, '2022_06_02_135953_add_kode_pengguna_to_pengguna_table', 1),
(10, '2022_06_02_140232_add_kode_barang_to_barang_table', 1),
(11, '2022_06_02_140310_add_kode_barang_masuk_to_barang_table', 1),
(12, '2022_06_02_140327_add_kode_barang_keluar_to_barang_table', 1),
(13, '2022_06_02_140402_add_kode_pesanan_to_pesanan_table', 1),
(14, '2022_06_03_132120_create_metode_bayars_table', 1),
(15, '2022_06_03_132309_add_metode_bayar_id_to_pesanan_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '1: Admin, 2: Produksi, 3: Kasir',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `kode_pengguna`, `nama`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'USR0001', 'Admin', 'admin@site.com', '$2y$10$9UPN.jKUWja0OWCCRve5/.YYBoheUyXELPKi.l28vJgmZsEc0EaUO', 1, NULL, '2022-06-06 03:01:54', '2022-06-06 03:01:54'),
(2, 'USR0002', 'Produksi', 'produksi@site.com', '$2y$10$wQEmgiXyOTsetsASTJymge6/hWSMSK8wS4gUuPhR7MPr531JNjieC', 2, NULL, '2022-06-06 03:01:55', '2022-06-06 03:01:55'),
(3, 'USR0003', 'Kasir', 'kasir@site.com', '$2y$10$bweu8hz6ER2vCPOGzdPwC.JYLeF27UmU5xsUBd.p0zBAsLGipLTaa', 3, 'eUf705vz7o13WB73piaYNm49nmvlKglkxD1PC3fg1EMZ9TgIprsPBuYlW37I', '2022-06-06 03:01:55', '2022-06-06 03:01:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir_id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `metode_bayar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_pesanan`, `nama_pemesan`, `kasir_id`, `total_harga`, `total_bayar`, `kembalian`, `metode_bayar_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ORD060620220001', 'Numa', 3, 18000, 18000, 0, 1, 'Lunas', '2022-06-06 07:36:47', '2022-06-06 07:37:27'),
(2, 'ORD060620220002', 'Contoh', 3, 30000, 30000, 0, 1, 'Lunas', '2022-06-21 02:40:57', '2022-06-21 02:41:09'),
(3, 'ORD060620220003', 'Lutfi', 3, 43000, 50000, 7000, 1, 'Lunas', '2022-06-25 09:55:44', '2022-06-25 09:56:09'),
(4, 'ORD060620220004', 'Bagus', 3, 43000, 50000, 7000, 1, 'Lunas', '2022-06-25 10:15:18', '2022-06-25 10:15:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `pesanan_id`, `barang_id`, `qty`, `subtotal`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 18000, NULL, '2022-06-06 07:36:47', '2022-06-06 07:36:47'),
(2, 2, 2, 1, 30000, NULL, '2022-06-21 02:40:57', '2022-06-21 02:40:57'),
(3, 3, 5, 1, 18000, NULL, '2022-06-25 09:55:44', '2022-06-25 09:55:44'),
(5, 4, 4, 1, 25000, NULL, '2022-06-25 10:15:18', '2022-06-25 10:15:18'),
(6, 4, 5, 1, 18000, NULL, '2022-06-25 10:15:18', '2022-06-25 10:15:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_keluar_barang_id_foreign` (`barang_id`),
  ADD KEY `barang_keluar_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_masuk_barang_id_foreign` (`barang_id`),
  ADD KEY `barang_masuk_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_kasir_id_foreign` (`kasir_id`),
  ADD KEY `pesanan_metode_bayar_id_foreign` (`metode_bayar_id`);

--
-- Indeks untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_detail_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `pesanan_detail_barang_id_foreign` (`barang_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`);

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_kasir_id_foreign` FOREIGN KEY (`kasir_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_metode_bayar_id_foreign` FOREIGN KEY (`metode_bayar_id`) REFERENCES `metode_bayar` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_detail_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
