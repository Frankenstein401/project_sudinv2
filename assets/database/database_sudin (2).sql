-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2025 at 08:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_sudin`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_non_pma`
--

CREATE TABLE `form_non_pma` (
  `id` int(11) NOT NULL,
  `id_table_lembaga` int(11) NOT NULL,
  `no_akte` varchar(100) DEFAULT NULL,
  `jenis_kegiatan` varchar(255) DEFAULT NULL,
  `kota_administrasi` varchar(100) DEFAULT NULL,
  `pimpinan_nama` varchar(150) DEFAULT NULL,
  `pimpinan_ijazah` varchar(100) DEFAULT NULL,
  `pimpinan_asal_pt` varchar(150) DEFAULT NULL,
  `pimpinan_jurusan` varchar(100) DEFAULT NULL,
  `pimpinan_sk_lembaga` varchar(100) DEFAULT NULL,
  `pimpinan_sk_nomor` varchar(100) DEFAULT NULL,
  `pimpinan_sk_tanggal` date DEFAULT NULL,
  `pimpinan_pengalaman` text DEFAULT NULL,
  `pendidik_wni_laki` int(11) DEFAULT NULL,
  `pendidik_wni_perempuan` int(11) DEFAULT NULL,
  `pendidik_wni_pendidikan_terakhir` varchar(50) DEFAULT NULL,
  `pendidik_wni_sertifikat` text DEFAULT NULL,
  `pendidik_wna_ijin_kerja` enum('ada','tidak ada') DEFAULT NULL,
  `pendidik_wna_laki` int(11) DEFAULT NULL,
  `pendidik_wna_perempuan` int(11) DEFAULT NULL,
  `pendidik_wna_pendidikan_terakhir` varchar(50) DEFAULT NULL,
  `pendidik_wna_sertifikat` text DEFAULT NULL,
  `jumlah_tendik` int(11) DEFAULT NULL,
  `pendidikan_tendik` varchar(50) DEFAULT NULL,
  `gaji_pendidik_wni_min` decimal(12,2) DEFAULT NULL,
  `gaji_pendidik_wni_max` decimal(12,2) DEFAULT NULL,
  `gaji_pendidik_wna_min` decimal(12,2) DEFAULT NULL,
  `gaji_pendidik_wna_max` decimal(12,2) DEFAULT NULL,
  `ada_sop` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_buku_hadir_pendidik` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_buku_hadir_siswa` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_buku_inventaris` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_program_kerja_yayasan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_program_kerja_pimpinan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_kalender_pendidikan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_buku_tamu` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_buku_induk` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_buku_hasil_belajar` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_jadwal` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_tata_tertib` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_sertifikat_pendidikan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ada_struktur_organisasi` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `dokumen_kurikulum` enum('Ada lengkap','Ada tidak lengkap','Tidak ada') DEFAULT NULL,
  `dokumen_rencana_pengembangan` enum('Ada lengkap','Ada tidak lengkap','Tidak ada') DEFAULT NULL,
  `dokumen_rencana_tahunan` enum('Ada lengkap','Ada tidak lengkap','Tidak ada') DEFAULT NULL,
  `luas_tanah` varchar(50) DEFAULT NULL,
  `status_tanah` varchar(50) DEFAULT NULL,
  `peruntukan_tanah` varchar(100) DEFAULT NULL,
  `jumlah_ruang_belajar` int(11) DEFAULT NULL,
  `ukuran_ruang_belajar` varchar(100) DEFAULT NULL,
  `kondisi_gedung` enum('Baik','Cukup','Kurang') DEFAULT NULL,
  `status_gedung` varchar(100) DEFAULT NULL,
  `peruntukan_gedung` varchar(100) DEFAULT NULL,
  `jumlah_kamar_mandi` int(11) DEFAULT NULL,
  `perawatan_kamar_kecil` enum('Baik','Cukup','Kurang') DEFAULT NULL,
  `persediaan_air_bersih` enum('Baik','Cukup','Kurang') DEFAULT NULL,
  `ruang_pimpinan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ruang_tu` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ruang_perpustakaan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `ruang_lab` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `peralatan_laboratorium` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `kondisi_ruang_kelas` enum('Baik','Cukup','Kurang') DEFAULT NULL,
  `meja_kursi` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `papan_tulis` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `gudang` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `alat_kebersihan` enum('Ada','Tidak Ada','Baik','Cukup','Kurang') DEFAULT NULL,
  `nama_program` varchar(255) NOT NULL,
  `kelas_dan_level` varchar(255) NOT NULL,
  `jumlah_siswa_laki` int(11) DEFAULT NULL,
  `jumlah_siswa_perempuan` int(11) DEFAULT NULL,
  `hasil_visitasi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_non_pma`
--

INSERT INTO `form_non_pma` (`id`, `id_table_lembaga`, `no_akte`, `jenis_kegiatan`, `kota_administrasi`, `pimpinan_nama`, `pimpinan_ijazah`, `pimpinan_asal_pt`, `pimpinan_jurusan`, `pimpinan_sk_lembaga`, `pimpinan_sk_nomor`, `pimpinan_sk_tanggal`, `pimpinan_pengalaman`, `pendidik_wni_laki`, `pendidik_wni_perempuan`, `pendidik_wni_pendidikan_terakhir`, `pendidik_wni_sertifikat`, `pendidik_wna_ijin_kerja`, `pendidik_wna_laki`, `pendidik_wna_perempuan`, `pendidik_wna_pendidikan_terakhir`, `pendidik_wna_sertifikat`, `jumlah_tendik`, `pendidikan_tendik`, `gaji_pendidik_wni_min`, `gaji_pendidik_wni_max`, `gaji_pendidik_wna_min`, `gaji_pendidik_wna_max`, `ada_sop`, `ada_buku_hadir_pendidik`, `ada_buku_hadir_siswa`, `ada_buku_inventaris`, `ada_program_kerja_yayasan`, `ada_program_kerja_pimpinan`, `ada_kalender_pendidikan`, `ada_buku_tamu`, `ada_buku_induk`, `ada_buku_hasil_belajar`, `ada_jadwal`, `ada_tata_tertib`, `ada_sertifikat_pendidikan`, `ada_struktur_organisasi`, `dokumen_kurikulum`, `dokumen_rencana_pengembangan`, `dokumen_rencana_tahunan`, `luas_tanah`, `status_tanah`, `peruntukan_tanah`, `jumlah_ruang_belajar`, `ukuran_ruang_belajar`, `kondisi_gedung`, `status_gedung`, `peruntukan_gedung`, `jumlah_kamar_mandi`, `perawatan_kamar_kecil`, `persediaan_air_bersih`, `ruang_pimpinan`, `ruang_tu`, `ruang_perpustakaan`, `ruang_lab`, `peralatan_laboratorium`, `kondisi_ruang_kelas`, `meja_kursi`, `papan_tulis`, `gudang`, `alat_kebersihan`, `nama_program`, `kelas_dan_level`, `jumlah_siswa_laki`, `jumlah_siswa_perempuan`, `hasil_visitasi`, `created_at`) VALUES
(8, 2, 'Anim odit ut ut sint', 'Et nulla aut ut ipsu', 'Modi animi inventor', 'Cupidatat id irure ', 'In aut esse ea commo', 'Sapiente culpa ratio', 'In est magni dolores', 'Exercitationem labor', 'Esse dolor ullam cor', '2000-02-03', 'Delectus officia co', 100, 53, 'Rerum lorem itaque o', 'Nihil eos dolor adip', '', 92, 16, 'Proident quos sed s', '0', 11, 'Exercitationem quis ', 1000.00, 1000.00, 1000.00, 1000.00, '', '', '', 'Tidak Ada', 'Ada', 'Tidak Ada', 'Ada', 'Tidak Ada', 'Ada', 'Tidak Ada', 'Ada', 'Ada', 'Tidak Ada', 'Tidak Ada', 'Ada tidak lengkap', 'Tidak ada', 'Ada lengkap', '34', 'Sewa', 'Fugiat qui non reru', 99, '0', 'Baik', 'Milik Sendiri', '0', 79, 'Baik', '', 'Tidak Ada', '', 'Tidak Ada', 'Tidak Ada', '', 'Kurang', '', 'Tidak Ada', 'Ada', 'Tidak Ada', 'Lorem deserunt repud', 'Error totam aliqua ', 63, 37, 'Non ab nostrud aliqu', '2025-08-28 15:54:56'),
(9, 7, 'Dolor molestiae offi', 'Enim dolorem laborum', 'Elit id vero totam ', 'Voluptas aliquip vel', 'Et illo velit aut am', 'Nobis est cupidatat ', 'In ut illo labore re', 'Numquam occaecat con', 'Velit nisi quis tota', '2001-10-16', 'Mollitia id fugiat ', 18, 80, 'Eius voluptas et eum', 'Quasi sunt laborum e', '', 89, 69, 'Porro voluptatum fug', '0', 29, 'Irure consequat Et ', 2000.00, 2000.00, 3000.00, 1000.00, '', '', '', 'Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak ada', 'Ada lengkap', 'Ada lengkap', '56', 'Milik Sendiri', 'A ut nulla cumque si', 36, '0', '', 'Pinjam', '0', 9, 'Baik', 'Kurang', 'Ada', '', 'Tidak Ada', 'Ada', '', '', 'Kurang', 'Ada', 'Ada', 'Cukup', 'Laborum Voluptas ut', 'Illum tempore sit', 26, 27, 'Non sunt labore do a', '2025-08-28 16:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `form_pma`
--

CREATE TABLE `form_pma` (
  `id` int(11) NOT NULL,
  `id_table_lembaga` int(11) NOT NULL,
  `form_pendaftaran` varchar(100) DEFAULT NULL,
  `surat_tugas` varchar(100) DEFAULT NULL,
  `ktp_pemohon` varchar(100) DEFAULT NULL,
  `surat_rekomendasi` varchar(100) DEFAULT NULL,
  `sk_kemenhumkam` varchar(100) NOT NULL,
  `nomor_induk_berusaha` varchar(100) NOT NULL,
  `kepemilikan_tanah` varchar(100) NOT NULL,
  `acuan_kurikulum` varchar(100) NOT NULL,
  `kurikulum` varchar(100) NOT NULL,
  `rpp` varchar(100) NOT NULL,
  `pendekatan_pembelajaran` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `kualifikasi_akademik` varchar(100) NOT NULL,
  `sertifikat` varchar(100) NOT NULL,
  `pengalaman_kerja` varchar(100) NOT NULL,
  `bangunan` varchar(100) NOT NULL,
  `ruangan` varchar(100) NOT NULL,
  `alat` varchar(100) NOT NULL,
  `bahan_ajar` varchar(100) NOT NULL,
  `kepemilikan_gedung` varchar(100) NOT NULL,
  `rancangan_pembiayaan` varchar(100) NOT NULL,
  `sumber_pembiayaan` varchar(100) NOT NULL,
  `sistem_sertifikasi` varchar(100) NOT NULL,
  `orientasi_sertifikasi` varchar(100) NOT NULL,
  `pengembangan_evaluasi` varchar(100) NOT NULL,
  `struktur_organisasi` varchar(100) NOT NULL,
  `sop` varchar(100) NOT NULL,
  `peserta_didik` varchar(100) NOT NULL,
  `kalender_pembelajaran` varchar(100) NOT NULL,
  `jadwal_ruangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_lembaga`
--

CREATE TABLE `table_lembaga` (
  `id` int(11) NOT NULL,
  `npsn` varchar(20) NOT NULL,
  `nama_satuan_pendidikan` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `status` enum('PMA','Non PMA') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_lembaga`
--

INSERT INTO `table_lembaga` (`id`, `npsn`, `nama_satuan_pendidikan`, `alamat`, `kecamatan`, `kelurahan`, `status`, `created_at`) VALUES
(2, '1212', 'SMKN 12', 'jl menteng', 'koja', 'lagoa', 'PMA', '2025-08-28 03:38:09'),
(7, '121212', 'SMKN 12', 'jl menteng', 'koja', 'lagoa', 'Non PMA', '2025-08-28 03:39:47'),
(8, 'K900303', 'SDN KEBON BAWANG', 'KEBON BAWANG', 'PRIOK', 'KEBON BAWANG', 'PMA', '2025-08-31 01:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `table_riwayat`
--

CREATE TABLE `table_riwayat` (
  `id` int(11) NOT NULL,
  `id_PMA` int(11) NOT NULL,
  `id_NON_PMA` int(11) NOT NULL,
  `id_table_lembaga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_non_pma`
--
ALTER TABLE `form_non_pma`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_table_lembaga` (`id_table_lembaga`);

--
-- Indexes for table `form_pma`
--
ALTER TABLE `form_pma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_table_lembaga` (`id_table_lembaga`);

--
-- Indexes for table `table_lembaga`
--
ALTER TABLE `table_lembaga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npsn` (`npsn`);

--
-- Indexes for table `table_riwayat`
--
ALTER TABLE `table_riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_PMA` (`id_PMA`,`id_NON_PMA`,`id_table_lembaga`),
  ADD KEY `id_table_lembaga` (`id_table_lembaga`),
  ADD KEY `id_NON_PMA` (`id_NON_PMA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_non_pma`
--
ALTER TABLE `form_non_pma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `form_pma`
--
ALTER TABLE `form_pma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_lembaga`
--
ALTER TABLE `table_lembaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_riwayat`
--
ALTER TABLE `table_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_non_pma`
--
ALTER TABLE `form_non_pma`
  ADD CONSTRAINT `form_non_pma_ibfk_1` FOREIGN KEY (`id_table_lembaga`) REFERENCES `table_lembaga` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `form_pma`
--
ALTER TABLE `form_pma`
  ADD CONSTRAINT `form_pma_ibfk_1` FOREIGN KEY (`id_table_lembaga`) REFERENCES `table_lembaga` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `table_riwayat`
--
ALTER TABLE `table_riwayat`
  ADD CONSTRAINT `table_riwayat_ibfk_1` FOREIGN KEY (`id_table_lembaga`) REFERENCES `table_lembaga` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `table_riwayat_ibfk_2` FOREIGN KEY (`id_PMA`) REFERENCES `form_pma` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `table_riwayat_ibfk_3` FOREIGN KEY (`id_NON_PMA`) REFERENCES `form_non_pma` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
