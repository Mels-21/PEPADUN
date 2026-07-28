-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Jul 2026 pada 01.39
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pepadun`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Profil PPID', '', '2026-06-30 01:43:04', '2026-07-13 02:43:25'),
(3, 'Regulasi', '', '2026-06-30 01:43:04', '2026-07-13 02:43:41'),
(5, 'Laporan', '', '2026-06-30 01:43:04', '2026-07-13 02:25:37'),
(13, 'Insight', NULL, '2026-07-07 14:26:35', '2026-07-07 14:26:35'),
(17, 'Standar Layanan', NULL, '2026-07-07 14:26:35', '2026-07-07 14:26:35'),
(19, 'Informasi Publik Berkala', NULL, '2026-07-07 14:26:35', '2026-07-07 14:26:35'),
(21, 'Informasi Publik Serta Merta', NULL, '2026-07-07 14:26:35', '2026-07-07 14:26:35'),
(23, 'Informasi Publik Setiap Saat', NULL, '2026-07-07 14:26:35', '2026-07-07 14:26:35'),
(25, 'Galeri', NULL, '2026-07-07 14:26:35', '2026-07-07 14:26:35'),
(33, 'Lainnya', NULL, '2026-07-08 08:39:44', '2026-07-08 14:07:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_informasi`
--

CREATE TABLE `master_informasi` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int DEFAULT NULL,
  `timeline` varchar(50) DEFAULT NULL,
  `tautan` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_informasi`
--

INSERT INTO `master_informasi` (`id`, `name`, `category_id`, `timeline`, `tautan`, `created_at`, `updated_at`) VALUES
(11, 'Kalender Kegiatan', 33, 'Harian', 'https://bpomlampung.net/aplikasi-ku/calendar_public', '2026-07-08 09:07:46', '2026-07-28 08:08:46'),
(13, 'Data Tamu Harian', 13, 'Realtime', 'https://bpomlampung.net/sipeta/ppid', '2026-07-08 09:07:46', '2026-07-21 11:43:21'),
(15, 'Daftar Antrian Konsultasi', 13, 'Realtime', 'https://bpomlampung.net/sipeta/anjungan', '2026-07-08 09:07:46', '2026-07-21 11:43:29'),
(23, 'Insight of The Day', 13, 'Harian', 'https://datastudio.google.com/u/0/reporting/a3863940-bcc3-4c73-8a9e-487ba8da8459/page/imhoF', '2026-07-08 09:20:02', '2026-07-21 08:03:39'),
(25, 'Insight BBPOM Lampung', 13, 'Bulanan', 'https://datastudio.google.com/reporting/d8b3e2d7-4269-4c11-8655-a82fb7e41b79', '2026-07-08 09:20:02', '2026-07-21 08:04:01'),
(27, 'Berita Internal', 33, 'Mingguan', 'https://lampung.pom.go.id/berita', '2026-07-08 09:20:02', '2026-07-21 08:04:22'),
(29, 'Infografis Sejarah PPID', 1, 'Tahunan', 'https://lampung.pom.go.id/ppid/profil-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:04:47'),
(31, 'Infografis Visi dan Misi PPID', 1, 'Tahunan', 'https://lampung.pom.go.id/ppid/profil-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:05:02'),
(33, 'Infografis Tugas dan Fungsi PPID', 1, 'Tahunan', 'https://lampung.pom.go.id/ppid/profil-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:05:30'),
(35, 'Infografis Struktur Organisasi PPID 2025', 1, 'Tahunan', 'https://lampung.pom.go.id/ppid/profil-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:05:49'),
(37, 'Profil Pimpinan PPID Pelaksana', 1, 'Tahunan', 'https://lampung.pom.go.id/ppid/profil-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:06:36'),
(39, 'Regulasi PPID BPOM', 3, 'Tahunan', 'https://lampung.pom.go.id/ppid/regulasi', '2026-07-08 09:20:02', '2026-07-21 08:07:08'),
(41, 'Regulasi PPID Pelaksana', 3, 'Tahunan', 'https://lampung.pom.go.id/ppid/regulasi', '2026-07-08 09:20:02', '2026-07-21 08:07:43'),
(43, 'Ringkasan Laporan Layanan Informasi Publik', 5, 'Triwulan', 'https://lampung.pom.go.id/ppid/laporan-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:08:29'),
(45, 'Register Permintaan Informasi', 5, 'Triwulan', 'https://lampung.pom.go.id/ppid/laporan-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:08:46'),
(47, 'Register Keberatan', 5, 'Triwulan', 'https://lampung.pom.go.id/ppid/laporan-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:08:59'),
(49, 'Laporan Tahunan', 5, 'Tahunan', 'https://lampung.pom.go.id/ppid/laporan-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:09:37'),
(51, 'Laporan Survei Kepuasan Masyarakat', 5, 'Tahunan', 'https://lampung.pom.go.id/ppid/laporan-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:09:56'),
(53, 'Infografis Laporan Layanan', 5, 'Triwulan', 'https://lampung.pom.go.id/ppid/laporan-ppid-pelaksana', '2026-07-08 09:20:02', '2026-07-21 08:10:18'),
(55, 'Infografis Media Layanan', 17, 'Tahunan', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:10:40'),
(57, 'Maklumat Layanan PPID 4 Poin', 17, 'Tahunan', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:11:05'),
(59, 'Infografis Biaya Layanan', 17, 'Tahunan', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:11:32'),
(61, 'Update Infografis Jadwal Layanan', 17, 'Tahunan', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:13:01'),
(63, 'Permintaan Informasi', 17, 'Realtime', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:14:00'),
(65, 'Pengajuan Keberatan', 17, 'Realtime', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:13:46'),
(67, 'Permohonan Penyelesaian Sengketa Informasi', 17, 'Realtime', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:14:37'),
(69, 'InfografisSOP', 17, 'Tahunan', 'https://lampung.pom.go.id/ppid/standar-layanan-ppid', '2026-07-08 09:20:02', '2026-07-21 08:14:57'),
(71, 'Profil Unit Kerja - BBPOM Lampung', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:15:28'),
(73, 'Program dan Kegiatan', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:15:45'),
(75, 'Laporan Evaluasi Internal', 19, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:42:35'),
(77, 'Laporan Kinerja', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:43:22'),
(79, 'Laporan Kinerja Interim', 19, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:43:57'),
(81, 'Laporan Keuangan', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:44:43'),
(83, 'Ringkasan Laporan Akses Informasi Publik', 19, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:45:18'),
(85, 'Regulasi Obat dan Makanan', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:46:20'),
(87, 'Prosedur Memperoleh Informasi Publik', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:47:00'),
(89, 'Daftar Kontrak Pengadaan', 19, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:49:22'),
(91, 'Pengadaan Barang dan Jasa', 19, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:49:47'),
(93, 'Informasi Ketenagakerjaan', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:55:07'),
(95, 'Prosedur Peringatan Dini dan Evakuasi Keadaan Darurat', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:51:17'),
(97, 'LHKPN Kepala Balai Periodik 2022-2024', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:51:43'),
(99, 'DIPA', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:52:26'),
(101, 'Rencana Kerja Anggaran', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:52:51'),
(103, 'Laporan Tahunan (Informasi Publik Berkala)', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:53:14'),
(105, 'POK Awal Tahun 2023-2025', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:53:51'),
(107, 'Penerimaan PNBP Tahun 2021-2024', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-20 15:26:30'),
(109, 'Usulan Daftar Informasi Publik dan Klasifikasi Informasi yang Dikecualikan Tahun 2023-2024', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:54:19'),
(111, 'Sarana Prasarana Layanan Publik', 19, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:56:03'),
(113, 'Laporan Evaluasi Layanan Informasi dan Pengaduan Masyarakat', 19, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:56:39'),
(115, 'Prosedur Peringatan Dini dan Evakuasi Keadaan Darurat (Informasi Publik Serta Merta)', 21, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:57:31'),
(117, 'Penjelasan Publik', 21, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:57:48'),
(119, 'Siaran Pers', 21, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:58:02'),
(121, 'Informasi Sirup Obat', 21, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:58:13'),
(123, 'Daftar Produk Obat Recall atau Ditarik', 21, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:58:29'),
(125, 'Hot Issue Obat dan Makanan', 21, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 08:58:45'),
(127, 'Daftar Informasi Publik', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:05:58'),
(129, 'Peraturan Keputusan dan Kebijakan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:06:10'),
(131, 'Informasi Organisasi, Administrasi, Kepegawaian, dan Keuangan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:06:47'),
(133, 'Surat Perjanjian Pihak Ketiga', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:07:18'),
(135, 'Persyratan Perizinan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:07:54'),
(137, 'Izin yang Diterbitkan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:08:10'),
(139, 'Laporan BMN, Data Perbendaharaan, atau Inventaris', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:08:41'),
(141, 'Rencana Strategis', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:08:53'),
(143, 'Rencana Kinerja', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:09:11'),
(145, 'Agenda Kerja Pimpinan', 23, 'Harian', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:09:27'),
(147, 'Kegiatan Pelayanan Informasi Publik', 23, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:09:49'),
(149, 'Dokumen Tahap Pelaksanaan Pengadaan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:10:34'),
(151, 'Dokumen Tahap Pemilihan Pengadaan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:10:50'),
(153, 'Informasi Daftar Kontrak Pengadaan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:11:13'),
(155, 'Jumlah Jenis Gambaran Umum Pelanggaran dan Laporan Penindakannya', 23, 'Triwulan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:11:44'),
(157, 'Rencana Umum Pengadaan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:12:04'),
(159, 'Hasil Penelitian', 23, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:12:33'),
(161, 'Peraturan Perundang-Undangan yang Telah Disahkan dan Kajian Analisis Hukum', 23, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:12:52'),
(163, 'Informasi dan Kebijakan yang Disampaikan Terbuka untuk Umum', 23, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:13:15'),
(165, 'Informasi yang Wajib Disediakan dan Diumumkan Secara Berkala', 23, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:13:43'),
(167, 'Informasi Terbuka Melalui Mekanisme Keberatan atau Penyelesaian Sengketa', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:14:18'),
(169, 'Standar Pengumuman Informasi Publik', 23, 'Realtime', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:14:47'),
(171, 'Daftar Informasi Arsip', 23, 'Semester', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:39:05'),
(173, 'Perjanjian Kinerja Tahunan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:16:23'),
(175, 'Inovasi', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:16:36'),
(177, 'Siaran Pers BBPOM di Bandar Lampung', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:16:53'),
(179, 'Kehumasan', 23, 'Tahunan', 'https://lampung.pom.go.id/informasi-publik', '2026-07-08 09:20:02', '2026-07-21 09:17:08'),
(181, 'Infografis Terkait Update PPID, Pelayanan Publik dan Informasi Penting Lainnya', 25, 'Bulanan', 'https://lampung.pom.go.id/infografis', '2026-07-08 09:20:02', '2026-07-21 09:17:57'),
(183, 'Video Terkait Update PPID, Pelayanan Publik dan Informasi Penting Lainnya', 25, 'Bulanan', 'https://lampung.pom.go.id/video', '2026-07-08 09:20:02', '2026-07-21 09:18:10'),
(185, 'Publikasi Petugas Layanan TerSBM dari Tahun 2023 Sampai Dengan Juni 2025', 33, 'Triwulan', 'https://lampung.pom.go.id/profil/eotm', '2026-07-08 09:20:02', '2026-07-21 09:18:26'),
(187, 'Majalah Tapis POM', 33, 'Triwulan', 'https://lampung.pom.go.id/storage/informasipublik/Balai-Besar-POM-di-Lampung-Majalah%20Subsite%20(2).pdf', '2026-07-08 09:20:02', '2026-07-21 09:18:39'),
(189, 'Publikasi Konten Mingguan Di Media Sosial Utama (Instagram)', 33, 'Mingguan', 'https://www.instagram.com/bpom.bandarlampung/', '2026-07-08 09:20:02', '2026-07-21 09:18:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '003', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1782737987, 1),
(3, '003', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1782738000, 2),
(5, '003', 'App\\Database\\Migrations\\CreateMonitoringTable', 'default', 'App', 1782738000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int UNSIGNED NOT NULL,
  `master_id` int NOT NULL,
  `custom_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `triwulan` tinyint NOT NULL,
  `year` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('pending','progress','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `pj` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monitoring`
--

INSERT INTO `monitoring` (`id`, `master_id`, `custom_name`, `triwulan`, `year`, `is_deleted`, `description`, `status`, `pj`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 9, NULL, 4, 2026, 0, '', 'progress', 'riko', 2, '2026-07-07 06:28:24', '2026-07-07 06:28:43'),
(3, 9, NULL, 1, 2026, 0, '', 'completed', '', 2, '2026-07-08 00:57:46', '2026-07-08 00:57:46'),
(5, 191, NULL, 3, 2026, 1, 'oke sip makan makan kapan lagi', 'progress', '', 2, '2026-07-13 01:29:14', '2026-07-13 01:47:08'),
(7, 11, NULL, 3, 2026, 0, '', 'pending', '', 2, '2026-07-14 01:02:22', '2026-07-28 08:08:46'),
(9, 193, NULL, 3, 2026, 1, '', 'pending', '', 2, '2026-07-14 09:39:25', '2026-07-14 09:41:27'),
(15, 13, NULL, 3, 2026, 0, '', 'pending', '', 2, '2026-07-16 14:36:43', '2026-07-21 11:43:21'),
(17, 15, NULL, 3, 2026, 0, '', 'pending', '', 2, '2026-07-16 14:39:12', '2026-07-21 11:43:29'),
(19, 13, NULL, 1, 2026, 0, 'Update', 'completed', '', 1, NULL, '2026-07-16 15:03:25'),
(23, 23, NULL, 1, 2026, 0, 'Update', 'completed', '', 1, NULL, '2026-07-16 15:03:56'),
(25, 11, NULL, 1, 2026, 0, 'Agenda perhari belum di isi dari Januari - Desember 2026', 'pending', '', 2, '2026-07-16 15:01:52', '2026-07-21 09:41:04'),
(27, 15, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-16 15:03:09', '2026-07-16 15:03:09'),
(29, 25, NULL, 1, 2026, 0, 'Insight keuangan, kinerja, cyber trace lampung belum update', 'pending', '', 2, '2026-07-16 15:04:32', '2026-07-16 15:04:32'),
(31, 27, NULL, 1, 2026, 0, 'belum secara konsisten update berita internal minimal 1 minggu 1 berita\r\n', 'pending', '', 2, '2026-07-16 15:05:27', '2026-07-16 15:05:27'),
(33, 29, NULL, 1, 2026, 0, 'isi belum update per 2025', 'completed', NULL, 1, NULL, NULL),
(35, 31, NULL, 1, 2026, 0, 'Update', 'completed', '', 1, NULL, '2026-07-21 07:37:59'),
(37, 33, NULL, 1, 2026, 0, 'Update', 'completed', '', 1, NULL, '2026-07-21 07:38:07'),
(39, 35, NULL, 1, 2026, 0, 'belum sesuai dengan SK PPID 2026', 'completed', NULL, 1, NULL, NULL),
(41, 37, NULL, 1, 2026, 0, 'belum update riwayat pelatihan dan penghargaan', 'completed', NULL, 1, NULL, NULL),
(43, 39, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 14:56:44', '2026-07-20 14:56:44'),
(45, 41, NULL, 1, 2026, 0, 'belum ada dan belum diganti dengan SK PPID 2026', 'pending', '', 2, '2026-07-20 14:57:34', '2026-07-20 14:57:34'),
(47, 43, NULL, 1, 2026, 0, 'TW 1 2026 belum ada', 'pending', '', 2, '2026-07-20 14:58:36', '2026-07-20 14:58:36'),
(49, 45, NULL, 1, 2026, 0, 'TW 1 2026 belum ada', 'pending', '', 2, '2026-07-20 15:06:50', '2026-07-20 15:06:50'),
(51, 47, NULL, 1, 2026, 0, 'TW 1 2026 belum ada', 'pending', '', 2, '2026-07-20 15:07:21', '2026-07-20 15:07:21'),
(53, 49, NULL, 1, 2026, 0, 'Tahun 2025 belum ada', 'pending', '', 2, '2026-07-20 15:07:41', '2026-07-20 15:09:56'),
(55, 51, NULL, 1, 2026, 0, 'Januari, Februari, Maret belum ada', 'pending', '', 2, '2026-07-20 15:08:44', '2026-07-20 15:08:44'),
(57, 53, NULL, 1, 2026, 0, 'perDesember 2025, perTW1 2026 belum ada', 'pending', '', 2, '2026-07-20 15:09:31', '2026-07-20 15:09:31'),
(59, 55, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:11:08', '2026-07-20 15:11:08'),
(61, 57, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:11:26', '2026-07-20 15:11:26'),
(63, 59, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:11:45', '2026-07-20 15:11:45'),
(65, 63, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:11:59', '2026-07-20 15:11:59'),
(67, 65, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:12:24', '2026-07-20 15:12:24'),
(69, 67, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:12:43', '2026-07-20 15:12:43'),
(71, 69, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:12:55', '2026-07-20 15:12:55'),
(73, 61, NULL, 1, 2026, 0, 'belum dirubah Jumat pelayanan online', 'pending', '', 2, '2026-07-20 15:13:18', '2026-07-20 15:13:18'),
(75, 71, NULL, 1, 2026, 0, 'Update', 'completed', '', 2, '2026-07-20 15:14:18', '2026-07-20 15:14:18'),
(77, 73, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-20 15:14:41', '2026-07-20 15:14:41'),
(79, 75, NULL, 1, 2026, 0, 'belum ada dari TW 3 2025 - TW 1 2026', 'pending', '', 2, '2026-07-20 15:16:00', '2026-07-20 15:16:00'),
(81, 77, NULL, 1, 2026, 0, 'belum ada 2025\r\n', 'pending', '', 2, '2026-07-20 15:17:37', '2026-07-20 15:17:37'),
(83, 79, NULL, 1, 2026, 0, 'belum ada dari TW 4 2025 0 TW 1 2026', 'pending', '', 2, '2026-07-20 15:19:09', '2026-07-20 15:19:09'),
(85, 81, NULL, 1, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-20 15:19:25', '2026-07-20 15:19:25'),
(87, 83, NULL, 1, 2026, 0, 'belum ada TW 1 2026', 'pending', '', 2, '2026-07-20 15:19:48', '2026-07-20 15:19:48'),
(89, 85, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:20:23', '2026-07-20 15:20:23'),
(91, 87, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:20:39', '2026-07-20 15:20:39'),
(93, 89, NULL, 1, 2026, 0, 'belum update 2025-2026', 'pending', '', 2, '2026-07-20 15:21:00', '2026-07-20 15:21:00'),
(95, 91, NULL, 1, 2026, 0, 'SURAT-SURAT PERJANJIAN DENGAN PIHAK KETIGA MENGENAI PENGADAAN BARANG DAN JASA belum ada dari TW 3 2025 sampai TW 1 2026; INFORMASI PENGADAAN BARANG DAN JASA belum ada 2026; belum ada update 2026', 'pending', '', 2, '2026-07-20 15:21:22', '2026-07-20 15:21:22'),
(97, 93, NULL, 1, 2026, 0, 'belum ada 2024-2026', 'pending', '', 2, '2026-07-20 15:21:47', '2026-07-20 15:21:47'),
(99, 95, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:22:09', '2026-07-20 15:22:09'),
(101, 97, NULL, 1, 2026, 0, 'belum ada 2025\r\n', 'pending', '', 2, '2026-07-20 15:23:21', '2026-07-20 15:23:21'),
(103, 99, NULL, 1, 2026, 0, 'Ubag nama folder menjadi M. DIPA (Daftar Isian Pelaksanaan Anggaran); dan belum ada 2026', 'pending', '', 2, '2026-07-20 15:24:53', '2026-07-20 15:24:53'),
(105, 101, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-20 15:25:21', '2026-07-20 15:25:21'),
(107, 103, NULL, 1, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-20 15:25:40', '2026-07-20 15:25:40'),
(109, 105, NULL, 1, 2026, 0, 'ubah nama folder menjadi P.  Petunjuk Operasional Kegiatan (POK); dan belum ada 2026', 'pending', '', 2, '2026-07-20 15:26:07', '2026-07-20 15:26:07'),
(111, 107, NULL, 1, 2026, 0, 'ubah nama folder menjadi Q. Penerimaan PNBP saja; belum ada 2025', 'pending', '', 2, '2026-07-20 15:26:30', '2026-07-20 15:26:30'),
(113, 109, NULL, 1, 2026, 0, 'ubah nama menjadi R. Usulan Daftar Informasi Publik dan Klasifikasi Informasi yang Dikecualikan; belum ada yang 2025', 'pending', '', 2, '2026-07-20 15:26:52', '2026-07-20 15:26:52'),
(115, 111, NULL, 1, 2026, 0, 'update apabila ada yang tebaru', 'pending', '', 2, '2026-07-20 15:30:46', '2026-07-20 15:30:46'),
(117, 113, NULL, 1, 2026, 0, 'belum ada TW 1 2026', 'pending', '', 2, '2026-07-20 15:31:09', '2026-07-20 15:31:09'),
(119, 115, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:31:51', '2026-07-20 15:31:51'),
(121, 117, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:32:10', '2026-07-20 15:32:10'),
(123, 119, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:32:26', '2026-07-20 15:32:26'),
(125, 121, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:32:49', '2026-07-20 15:32:49'),
(127, 123, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:34:58', '2026-07-20 15:34:58'),
(129, 125, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-20 15:35:11', '2026-07-20 15:35:11'),
(131, 179, NULL, 1, 2026, 0, 'buatkan folder dan lampirkan Laporan Inovasi-Inovasi Kehumasan 2025', 'pending', '', 2, '2026-07-21 07:43:09', '2026-07-21 07:43:09'),
(133, 127, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:43:40', '2026-07-21 07:43:40'),
(135, 129, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:43:56', '2026-07-21 07:43:56'),
(137, 131, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 07:44:17', '2026-07-21 07:44:17'),
(139, 133, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 07:44:28', '2026-07-21 07:44:28'),
(141, 135, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:44:48', '2026-07-21 07:44:48'),
(143, 137, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:45:03', '2026-07-21 07:45:03'),
(145, 139, NULL, 1, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-21 07:45:25', '2026-07-21 07:45:25'),
(147, 141, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:45:42', '2026-07-21 07:45:42'),
(149, 143, NULL, 1, 2026, 0, 'RKT 2026 ; RAPK 2026; POA 2026 belum ada', 'pending', '', 2, '2026-07-21 07:47:00', '2026-07-21 07:47:00'),
(151, 145, NULL, 1, 2026, 0, 'belum update, terakhir 19 Oktober 2025', 'pending', '', 2, '2026-07-21 07:47:16', '2026-07-21 07:47:16'),
(153, 147, NULL, 1, 2026, 0, 'Laporan Pelayanan Informasi Publik blm ada TW I 2026; Laporan Layanan Pengujian Sampel Pihak Ketiga belum ada dari TW 3 2025 sampai TW I 2026; Laporan Layanan Pengujian Sampel Pihak Ketiga belum ada dari TW 3 2025 sampai TW I 2026; Laporan Evaluasi Layanan Informasi dan pengaduan belum ada dari TW 4 2025sampai TW 1 2026', 'pending', '', 2, '2026-07-21 07:47:43', '2026-07-21 07:47:43'),
(155, 149, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 07:48:41', '2026-07-21 07:48:41'),
(157, 151, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 07:49:02', '2026-07-21 07:49:02'),
(159, 153, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 07:49:15', '2026-07-21 07:49:15'),
(161, 155, NULL, 1, 2026, 0, 'belum ada dari TW 3 2025 sampai TW 1 2026', 'pending', '', 2, '2026-07-21 07:49:36', '2026-07-21 07:49:36'),
(163, 157, NULL, 1, 2026, 0, 'belum update 2025 dan 2026', 'pending', '', 2, '2026-07-21 07:50:03', '2026-07-21 07:50:03'),
(165, 159, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:50:32', '2026-07-21 07:50:32'),
(167, 161, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:51:00', '2026-07-21 07:51:00'),
(169, 163, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:51:17', '2026-07-21 07:51:17'),
(171, 165, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:51:43', '2026-07-21 07:51:43'),
(173, 167, NULL, 1, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 07:52:17', '2026-07-21 07:52:17'),
(175, 169, NULL, 1, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 07:52:37', '2026-07-21 07:52:37'),
(179, 173, NULL, 1, 2026, 0, 'belum ada 2025 dan 2026', 'pending', '', 2, '2026-07-21 07:57:50', '2026-07-21 07:57:50'),
(181, 175, NULL, 1, 2026, 0, 'buatkan folder dan lampirkan Laporan Inovasi-Inovasi 2025', 'pending', '', 2, '2026-07-21 07:58:14', '2026-07-21 07:58:14'),
(183, 177, NULL, 1, 2026, 0, 'buatkan foldernya dan lampirkan Siaran Pers yanng dikeluarkan Balai dari 2024', 'pending', '', 2, '2026-07-21 07:58:33', '2026-07-21 07:58:33'),
(185, 181, NULL, 1, 2026, 0, 'belum ada infografis terbaru', 'pending', '', 2, '2026-07-21 07:59:12', '2026-07-21 07:59:12'),
(187, 183, NULL, 1, 2026, 0, 'belum ada video terbaru', 'pending', '', 2, '2026-07-21 07:59:32', '2026-07-21 07:59:32'),
(189, 185, NULL, 1, 2026, 0, 'belum ada Januari - Maret 2026', 'pending', '', 2, '2026-07-21 08:00:04', '2026-07-21 08:00:04'),
(191, 187, NULL, 1, 2026, 0, 'Belum ada edisi majalah terbaru', 'pending', '', 2, '2026-07-21 08:00:28', '2026-07-21 08:00:28'),
(193, 189, NULL, 1, 2026, 0, 'belum ada data/bukti update konten mingguan', 'pending', '', 2, '2026-07-21 08:00:50', '2026-07-21 08:00:50'),
(195, 11, NULL, 2, 2026, 0, 'Agenda perhari belum di isi dari Januari - Desember 2026', 'pending', '', 2, '2026-07-21 08:02:41', '2026-07-21 09:41:15'),
(197, 13, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:03:03', '2026-07-21 08:03:03'),
(199, 15, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:03:21', '2026-07-21 08:03:21'),
(201, 23, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:03:39', '2026-07-21 08:03:39'),
(203, 25, NULL, 2, 2026, 0, 'Insight keuangan, kinerja, cyber trace lampung belum update', 'pending', '', 2, '2026-07-21 08:04:01', '2026-07-21 08:04:01'),
(205, 27, NULL, 2, 2026, 0, 'belum secara konsisten update berita internal minimal 1 minggu 1 berita', 'pending', '', 2, '2026-07-21 08:04:22', '2026-07-21 08:04:22'),
(207, 29, NULL, 2, 2026, 0, 'isi belum update per 2025', 'pending', '', 2, '2026-07-21 08:04:47', '2026-07-21 08:04:47'),
(209, 31, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:05:02', '2026-07-21 08:05:02'),
(211, 33, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:05:30', '2026-07-21 08:05:30'),
(213, 35, NULL, 2, 2026, 0, 'belum sesuai dengan SK PPID 2026\r\n', 'pending', '', 2, '2026-07-21 08:05:49', '2026-07-21 08:05:49'),
(215, 37, NULL, 2, 2026, 0, 'belum update riwayat pelatihan dan penghargaan', 'pending', '', 2, '2026-07-21 08:06:36', '2026-07-21 08:06:36'),
(217, 39, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:07:08', '2026-07-21 08:07:08'),
(219, 41, NULL, 2, 2026, 0, 'belum diganti dengan sk PPID 2026, belum ada', 'pending', '', 2, '2026-07-21 08:07:43', '2026-07-21 08:07:43'),
(221, 43, NULL, 2, 2026, 0, 'TW 1 2026 belum ada', 'pending', '', 2, '2026-07-21 08:08:29', '2026-07-21 08:08:29'),
(223, 45, NULL, 2, 2026, 0, 'TW 1 2026 belum ada', 'pending', '', 2, '2026-07-21 08:08:46', '2026-07-21 08:08:46'),
(225, 47, NULL, 2, 2026, 0, 'TW 1 2026 belum ada', 'pending', '', 2, '2026-07-21 08:08:59', '2026-07-21 08:08:59'),
(227, 49, NULL, 2, 2026, 0, 'Tahun 2025 belum ada', 'pending', '', 2, '2026-07-21 08:09:37', '2026-07-21 08:09:37'),
(229, 51, NULL, 2, 2026, 0, 'Januari, Februari, Maret belum ada', 'pending', '', 2, '2026-07-21 08:09:56', '2026-07-21 08:09:56'),
(231, 53, NULL, 2, 2026, 0, 'perDesember 2025, perTW1 2026 belum ada', 'pending', '', 2, '2026-07-21 08:10:18', '2026-07-21 08:10:18'),
(233, 55, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:10:40', '2026-07-21 08:10:40'),
(235, 57, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:11:05', '2026-07-21 08:11:05'),
(237, 59, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:11:32', '2026-07-21 08:11:32'),
(239, 61, NULL, 2, 2026, 0, 'belum dirubah jumat pelayanan online', 'pending', '', 2, '2026-07-21 08:13:01', '2026-07-21 08:13:01'),
(241, 63, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:13:25', '2026-07-21 08:14:00'),
(243, 65, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:13:46', '2026-07-21 08:13:46'),
(245, 67, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:14:37', '2026-07-21 08:14:37'),
(247, 69, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:14:57', '2026-07-21 08:14:57'),
(249, 71, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:15:28', '2026-07-21 08:15:28'),
(251, 73, NULL, 2, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-21 08:15:45', '2026-07-21 08:15:45'),
(253, 75, NULL, 2, 2026, 0, 'belum ada dari TW 3 2025 - TW 1 2026', 'pending', '', 2, '2026-07-21 08:42:35', '2026-07-21 08:42:35'),
(255, 77, NULL, 2, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-21 08:43:22', '2026-07-21 08:43:22'),
(257, 79, NULL, 2, 2026, 0, 'belum ada dari TW 4 2025 - TW 1 2026', 'pending', '', 2, '2026-07-21 08:43:57', '2026-07-21 08:43:57'),
(259, 81, NULL, 2, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-21 08:44:43', '2026-07-21 08:44:43'),
(261, 83, NULL, 2, 2026, 0, 'belum ada TW 1 2026', 'pending', '', 2, '2026-07-21 08:45:18', '2026-07-21 08:45:18'),
(263, 85, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:46:20', '2026-07-21 08:46:20'),
(265, 87, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:47:00', '2026-07-21 08:47:00'),
(267, 89, NULL, 2, 2026, 0, 'belum update 2025 - 2026', 'pending', '', 2, '2026-07-21 08:49:22', '2026-07-21 08:49:22'),
(269, 91, NULL, 2, 2026, 0, 'SURAT-SURAT PERJANJIAN DENGAN PIHAK KETIGA MENGENAI PENGADAAN BARANG DAN JASA belum ada dari TW 3 2025 sampai TW 1 2026; INFORMASI PENGADAAN BARANG DAN JASA belum ada 2026; belum ada update 2026', 'pending', '', 2, '2026-07-21 08:49:47', '2026-07-21 08:49:47'),
(271, 93, NULL, 2, 2026, 0, 'belum ada tahun 2024 - 2026', 'pending', '', 2, '2026-07-21 08:50:24', '2026-07-21 08:55:07'),
(273, 95, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:51:17', '2026-07-21 08:51:17'),
(275, 97, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 08:51:43', '2026-07-21 08:51:43'),
(277, 99, NULL, 2, 2026, 0, 'Ubah nama folder menjadi M. DIPA (Daftar Isian Pelaksanaan Anggaran); dan belum ada 2026', 'pending', '', 2, '2026-07-21 08:52:26', '2026-07-21 08:52:26'),
(279, 101, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 08:52:51', '2026-07-21 08:52:51'),
(281, 103, NULL, 2, 2026, 0, 'belum ada 2025', 'pending', '', 2, '2026-07-21 08:53:14', '2026-07-21 08:53:14'),
(283, 105, NULL, 2, 2026, 0, 'ubah nama folder menjadi P.  Petunjuk Operasional Kegiatan (POK); dan belum ada 2026', 'pending', '', 2, '2026-07-21 08:53:51', '2026-07-21 08:53:51'),
(285, 109, NULL, 2, 2026, 0, 'ubah nama menjadi R. Usulan Daftar Informasi Publik dan Klasifikasi Informasi yang Dikecualikan; belum ada yang 2025', 'pending', '', 2, '2026-07-21 08:54:19', '2026-07-21 08:54:19'),
(287, 111, NULL, 2, 2026, 0, 'Update apabila ada yang terbaru', 'pending', '', 2, '2026-07-21 08:56:03', '2026-07-21 08:56:03'),
(289, 113, NULL, 2, 2026, 0, 'belum ada TW I 2026', 'pending', '', 2, '2026-07-21 08:56:39', '2026-07-21 08:56:39'),
(291, 115, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:57:31', '2026-07-21 08:57:31'),
(293, 117, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:57:48', '2026-07-21 08:57:48'),
(295, 119, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:58:02', '2026-07-21 08:58:02'),
(297, 121, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:58:13', '2026-07-21 08:58:13'),
(299, 123, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:58:29', '2026-07-21 08:58:29'),
(301, 125, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 08:58:45', '2026-07-21 08:58:45'),
(303, 127, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:05:58', '2026-07-21 09:05:58'),
(305, 129, NULL, 2, 2026, 0, 'update', 'pending', '', 2, '2026-07-21 09:06:10', '2026-07-21 09:06:10'),
(307, 131, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 09:06:47', '2026-07-21 09:06:47'),
(309, 133, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 09:07:18', '2026-07-21 09:07:18'),
(311, 135, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:07:54', '2026-07-21 09:07:54'),
(313, 137, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:08:10', '2026-07-21 09:08:10'),
(315, 139, NULL, 2, 2026, 0, 'belum ada tahun 2025', 'pending', '', 2, '2026-07-21 09:08:41', '2026-07-21 09:08:41'),
(317, 141, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:08:53', '2026-07-21 09:08:53'),
(319, 143, NULL, 2, 2026, 0, 'RKT 2026 ; RAPK 2026; POA 2026 belum ada', 'pending', '', 2, '2026-07-21 09:09:11', '2026-07-21 09:09:11'),
(321, 145, NULL, 2, 2026, 0, 'belum update, terakhir 19 Oktober 2025', 'pending', '', 2, '2026-07-21 09:09:27', '2026-07-21 09:09:27'),
(323, 147, NULL, 2, 2026, 0, 'Laporan Pelayanan Informasi Publik blm ada TW I 2026; Laporan Layanan Pengujian Sampel Pihak Ketiga belum ada dari TW 3 2025 sampai TW I 2026; Laporan Layanan Pengujian Sampel Pihak Ketiga belum ada dari TW 3 2025 sampai TW I 2026; Laporan Evaluasi Layanan Informasi dan pengaduan belum ada dari TW 4 2025sampai TW 1 2026', 'pending', '', 2, '2026-07-21 09:09:49', '2026-07-21 09:09:49'),
(325, 149, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 09:10:34', '2026-07-21 09:10:34'),
(327, 151, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 09:10:50', '2026-07-21 09:10:50'),
(329, 153, NULL, 2, 2026, 0, 'belum ada tahun 2026\r\n', 'pending', '', 2, '2026-07-21 09:11:13', '2026-07-21 09:11:13'),
(331, 155, NULL, 2, 2026, 0, 'belum ada dari TW 3 2025 sampai TW 1 2026', 'pending', '', 2, '2026-07-21 09:11:44', '2026-07-21 09:11:44'),
(333, 157, NULL, 2, 2026, 0, 'belum update 2025 dan 2026', 'pending', '', 2, '2026-07-21 09:12:04', '2026-07-21 09:12:04'),
(335, 159, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:12:33', '2026-07-21 09:12:33'),
(337, 161, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:12:52', '2026-07-21 09:12:52'),
(339, 163, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:13:15', '2026-07-21 09:13:15'),
(341, 165, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:13:43', '2026-07-21 09:13:43'),
(343, 167, NULL, 2, 2026, 0, 'belum ada 2026', 'pending', '', 2, '2026-07-21 09:14:18', '2026-07-21 09:14:18'),
(345, 169, NULL, 2, 2026, 0, 'update', 'completed', '', 2, '2026-07-21 09:14:47', '2026-07-21 09:14:47'),
(349, 173, NULL, 2, 2026, 0, 'belum ada 2025 dan 2026', 'pending', '', 2, '2026-07-21 09:16:23', '2026-07-21 09:16:23'),
(351, 175, NULL, 2, 2026, 0, 'buatkan folder dan lampirkan Laporan Inovasi-Inovasi 2025', 'pending', '', 2, '2026-07-21 09:16:36', '2026-07-21 09:16:36'),
(353, 177, NULL, 2, 2026, 0, 'buatkan foldernya dan lampirkan Siaran Pers yanng dikeluarkan Balai dari 2024', 'pending', '', 2, '2026-07-21 09:16:53', '2026-07-21 09:16:53'),
(355, 179, NULL, 2, 2026, 0, 'buatkan folder dan lampirkan Laporan Inovasi-Inovasi Kehumasan 2025', 'pending', '', 2, '2026-07-21 09:17:08', '2026-07-21 09:17:08'),
(357, 181, NULL, 2, 2026, 0, 'belum ada infografis terbaru', 'pending', '', 2, '2026-07-21 09:17:57', '2026-07-21 09:17:57'),
(359, 183, NULL, 2, 2026, 0, 'belum ada video terbari', 'pending', '', 2, '2026-07-21 09:18:10', '2026-07-21 09:18:10'),
(361, 185, NULL, 2, 2026, 0, 'belum ada Januari - Maret 2026', 'pending', '', 2, '2026-07-21 09:18:26', '2026-07-21 09:18:26'),
(363, 187, NULL, 2, 2026, 0, 'Belum ada edisi Majalah terbaru', 'pending', '', 2, '2026-07-21 09:18:39', '2026-07-21 09:18:39'),
(365, 189, NULL, 2, 2026, 0, 'belum ada data/bukti update konten mingguan', 'pending', '', 2, '2026-07-21 09:18:53', '2026-07-21 09:18:53'),
(367, 171, NULL, 1, 2026, 0, 'belum ada dari TW 3 2025 sampai TW 1 2026', 'pending', '', 2, '2026-07-21 09:38:05', '2026-07-21 09:39:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int UNSIGNED NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'karyawan',
  `created` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `substansi_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_dosir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pangkat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tmt_pangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eselon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelas_jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fungsi_jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_lulus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tmt_jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kedudukan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_pensiun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `masa_kerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_nikah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lama_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `belum_naikpangkat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rumpun_pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontrak_awal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontrak_akhir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `role`, `created`, `modified`, `email`, `nip`, `jabatan_id`, `substansi_id`, `image_user`, `level_user`, `status_user`, `telp`, `no_dosir`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `pangkat`, `tipe_pegawai`, `tmt_pangkat`, `eselon`, `kode_jabatan`, `kelas_jabatan`, `fungsi_jabatan`, `pendidikan`, `jurusan`, `tahun_lulus`, `nama_sekolah`, `agama`, `tmt_jabatan`, `status_pegawai`, `kedudukan`, `tgl_pensiun`, `masa_kerja`, `status_nikah`, `lama_jabatan`, `belum_naikpangkat`, `rumpun_pendidikan`, `kontrak_awal`, `kontrak_akhir`) VALUES
(1, 'Alvin Agustiawan, A.Md', '$2y$10$uYhjB5PZbvVQwAr62A8Xs.ECRJ10NcGwEn2.jJc9tLq88yiHEGUzO', 'Alvin Agustiawan, A.Md', 'karyawan\r', '2026-07-13 00:00:00', '13/07/2026 00:00', 'alvin@pom.go.id', '1,99108E+17', '13', '2', 'alvin.jpg', '1', '1', '8135000', '4406', 'PALEMBANG', '09/08/1991', 'Laki-Laki', 'II/d', 'Fungsional', '01/04/2023', '-', 'J02313', '7', '', 'D3', 'Manajemen Informatika', '2012', 'Politehnik Negeri Sriwijaya', 'Islam', '01/04/2021', 'PNS', 'Aktif', '01/09/2049', '10 Tahun 11 Bulan', 'Kawin', '4 Tahun 9 Bulan 5 Hari ', '2 Tahun 9 Bulan 5 Hari ', 'Informatika/ Komputer', '0000-00-00', '0000-00-00'),
(2, 'admin', '$2y$10$N5C.Ny8EET1Qk9t8N9ADtOJpk29JII7GOtYyIAreWpXecCYYx/fqG', 'Admin Super', 'admin', '2026-06-30 01:43:03', '2026-06-30 01:43:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'sabrina', '$2y$10$JqCM5p0P/0W08k1SFE5tAeS7jEHBwh0h9gbeywMu5phHF6FLrCpdq', 'sabrina nurhasanah', 'admin', '2026-07-08 03:59:59', '2026-07-14 14:27:19', 'sabrinanurhasanah09@gmail.com', '', '', '', 'sabrinacantik.jpg', '', NULL, '089632301174', '', '', '', NULL, '', '', '', '', '', '', '', NULL, '', NULL, '', NULL, '', '', '', '', '', NULL, '', '', '', '', ''),
(21, 'mel', '$2y$10$fdJCp.Bq3CPk/5tQzVZFeOES0T2r3HiHEOWb3.LX/JeWOxKVmpRPi', 'melisa', 'karyawan', '2026-07-13 07:25:37', '2026-07-16 14:36:19', 'mel1234@gmail.com', '', '', '', '', '', '', '085645084480', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_informasi`
--
ALTER TABLE `master_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitoring_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `master_informasi`
--
ALTER TABLE `master_informasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `monitoring_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
