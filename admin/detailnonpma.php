<?php
require_once __DIR__ . '/../config/functionDetail.php';
$data = selectNonPMA();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Form Non PMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        success: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        warning: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        danger: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        },
                        info: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'pulse-soft': 'pulseSoft 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(15px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.8' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-b from-secondary-100 to-secondary-50 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-5xl mx-auto bg-white rounded-2xl shadow-xl p-8 md:p-10">
        <div class="flex justify-between items-center mb-8 border-b-2 border-secondary-200 pb-4 animate-fade-in">
            <h2 class="text-3xl md:text-4xl font-extrabold text-secondary-900 tracking-tight">Detail Form Non PMA</h2>
            <a href="./laporan.php" class="px-6 py-3 bg-gradient-to-r from-danger-500 to-danger-600 text-white rounded-lg hover:from-danger-600 hover:to-danger-700 shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2 text-lg" aria-label="Kembali ke Dashboard">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Informasi Dasar -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Informasi Dasar Lembaga</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">No. Akte</td>
                            <td class="py-3">: <?= htmlspecialchars($data['no_akte'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Jenis Kegiatan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['jenis_kegiatan'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Kota Administrasi</td>
                            <td class="py-3">: <?= htmlspecialchars($data['kota_administrasi'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Nama Lembaga</td>
                            <td class="font-semibold text-blue-600 py-3">
                                <?php
                                if (isset($data['nama_satuan_pendidikan'])) {
                                    echo htmlspecialchars($data['nama_satuan_pendidikan']);
                                } else {
                                    echo "Nama tidak ditemukan (ID: " . htmlspecialchars($row['id_table_lembaga'] ?? 'N/A') . ")";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Tanggal Input</td>
                            <td class="py-3">: <?= date('d F Y H:i', strtotime($data['created_at'])) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Informasi Pimpinan -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Informasi Pimpinan</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Nama Pimpinan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_nama'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Ijazah</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_ijazah'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Asal PT</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_asal_pt'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Jurusan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_jurusan'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">SK Lembaga</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_sk_lembaga'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">SK Nomor</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_sk_nomor'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">SK Tanggal</td>
                            <td class="py-3">: <?= $data['pimpinan_sk_tanggal'] ? date('d/m/Y', strtotime($data['pimpinan_sk_tanggal'])) : '-' ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Pengalaman</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pimpinan_pengalaman'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Pendidik -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Data Pendidik</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Pendidik WNI</h3>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Laki-laki</td>
                            <td class="py-3">: <?= $data['pendidik_wni_laki'] ?? 0 ?> orang</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Perempuan</td>
                            <td class="py-3">: <?= $data['pendidik_wni_perempuan'] ?? 0 ?> orang</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Pendidikan Terakhir</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pendidik_wni_pendidikan_terakhir'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Sertifikat</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pendidik_wni_sertifikat'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Gaji Min</td>
                            <td class="py-3">: Rp <?= number_format($data['gaji_pendidik_wni_min'] ?? 0, 0, ',', '.') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Gaji Max</td>
                            <td class="py-3">: Rp <?= number_format($data['gaji_pendidik_wni_max'] ?? 0, 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Pendidik WNA</h3>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Ijin Kerja</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pendidik_wna_ijin_kerja'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Laki-laki</td>
                            <td class="py-3">: <?= $data['pendidik_wna_laki'] ?? 0 ?> orang</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Perempuan</td>
                            <td class="py-3">: <?= $data['pendidik_wna_perempuan'] ?? 0 ?> orang</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Pendidikan Terakhir</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pendidik_wna_pendidikan_terakhir'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Gaji Min</td>
                            <td class="py-3">: Rp <?= number_format($data['gaji_pendidik_wna_min'] ?? 0, 0, ',', '.') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Gaji Max</td>
                            <td class="py-3">: Rp <?= number_format($data['gaji_pendidik_wna_max'] ?? 0, 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Tenaga Kependidikan</h3>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Jumlah Tendik</td>
                            <td class="py-3">: <?= $data['jumlah_tendik'] ?? 0 ?> orang</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Pendidikan Tendik</td>
                            <td class="py-3">: <?= htmlspecialchars($data['pendidikan_tendik'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Siswa -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Data Siswa</div>
            <div class="p-6">
                <table class="w-full text-secondary-700">
                    <tr class="border-b border-secondary-100">
                        <td class="py-3 font-semibold w-2/5">Nama Program</td>
                        <td class="py-3">: <?= htmlspecialchars($data['nama_program'] ?? '-') ?></td>
                    </tr>
                    <tr class="border-b border-secondary-100">
                        <td class="py-3 font-semibold">Kelas dan Level</td>
                        <td class="py-3">: <?= htmlspecialchars($data['kelas_dan_level'] ?? '-') ?></td>
                    </tr>
                    <tr class="border-b border-secondary-100">
                        <td class="py-3 font-semibold">Siswa Laki-laki</td>
                        <td class="py-3">: <?= $data['jumlah_siswa_laki'] ?? 0 ?> orang</td>
                    </tr>
                    <tr class="border-b border-secondary-100">
                        <td class="py-3 font-semibold">Siswa Perempuan</td>
                        <td class="py-3">: <?= $data['jumlah_siswa_perempuan'] ?? 0 ?> orang</td>
                    </tr>
                    <tr class="border-b border-secondary-100">
                        <td class="py-3 font-semibold">Total Siswa</td>
                        <td class="py-3">: <?= ($data['jumlah_siswa_laki'] ?? 0) + ($data['jumlah_siswa_perempuan'] ?? 0) ?> orang</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Fasilitas dan Sarana -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Fasilitas dan Sarana Prasarana</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Tanah dan Gedung</h3>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Luas Tanah</td>
                            <td class="py-3">: <?= htmlspecialchars($data['luas_tanah'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Status Tanah</td>
                            <td class="py-3">: <?= htmlspecialchars($data['status_tanah'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Peruntukan Tanah</td>
                            <td class="py-3">: <?= htmlspecialchars($data['peruntukan_tanah'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Kondisi Gedung</td>
                            <td class="py-3">: <?= htmlspecialchars($data['kondisi_gedung'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Status Gedung</td>
                            <td class="py-3">: <?= htmlspecialchars($data['status_gedung'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Peruntukan Gedung</td>
                            <td class="py-3">: <?= htmlspecialchars($data['peruntukan_gedung'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Ruangan</h3>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Jumlah Ruang Belajar</td>
                            <td class="py-3">: <?= $data['jumlah_ruang_belajar'] ?? 0 ?> ruang</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Ukuran Ruang Belajar</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ukuran_ruang_belajar'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Kondisi Ruang Kelas</td>
                            <td class="py-3">: <?= htmlspecialchars($data['kondisi_ruang_kelas'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Jumlah Kamar Mandi</td>
                            <td class="py-3">: <?= $data['jumlah_kamar_mandi'] ?? 0 ?> unit</td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Perawatan Kamar Kecil</td>
                            <td class="py-3">: <?= htmlspecialchars($data['perawatan_kamar_kecil'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Persediaan Air Bersih</td>
                            <td class="py-3">: <?= htmlspecialchars($data['persediaan_air_bersih'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kelengkapan Ruangan -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Kelengkapan Ruangan</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Ruang Pimpinan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ruang_pimpinan'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Ruang TU</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ruang_tu'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Ruang Perpustakaan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ruang_perpustakaan'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Ruang Lab</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ruang_lab'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Peralatan Laboratorium</td>
                            <td class="py-3">: <?= htmlspecialchars($data['peralatan_laboratorium'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Meja Kursi</td>
                            <td class="py-3">: <?= htmlspecialchars($data['meja_kursi'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Papan Tulis</td>
                            <td class="py-3">: <?= htmlspecialchars($data['papan_tulis'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Gudang</td>
                            <td class="py-3">: <?= htmlspecialchars($data['gudang'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Alat Kebersihan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['alat_kebersihan'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kelengkapan Administrasi -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Kelengkapan Administrasi</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">SOP</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_sop'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Buku Hadir Pendidik</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_buku_hadir_pendidik'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Buku Hadir Siswa</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_buku_hadir_siswa'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Buku Inventaris</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_buku_inventaris'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Program Kerja Yayasan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_program_kerja_yayasan'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Program Kerja Pimpinan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_program_kerja_pimpinan'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Kalender Pendidikan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_kalender_pendidikan'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Buku Tamu</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_buku_tamu'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Buku Induk</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_buku_induk'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Buku Hasil Belajar</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_buku_hasil_belajar'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Jadwal</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_jadwal'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Tata Tertib</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_tata_tertib'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kelengkapan Dokumen -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Kelengkapan Dokumen</div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Sertifikat Pendidikan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_sertifikat_pendidikan'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Struktur Organisasi</td>
                            <td class="py-3">: <?= htmlspecialchars($data['ada_struktur_organisasi'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Dokumen Kurikulum</td>
                            <td class="py-3">: <?= htmlspecialchars($data['dokumen_kurikulum'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="w-full text-secondary-700">
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold w-2/5">Rencana Pengembangan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['dokumen_rencana_pengembangan'] ?? '-') ?></td>
                        </tr>
                        <tr class="border-b border-secondary-100">
                            <td class="py-3 font-semibold">Rencana Tahunan</td>
                            <td class="py-3">: <?= htmlspecialchars($data['dokumen_rencana_tahunan'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Hasil Visitasi -->
        <div class="mb-8 bg-white rounded-xl shadow-lg animate-slide-up">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-t-xl px-6 py-4 font-semibold text-lg">Hasil Visitasi</div>
            <div class="p-6 text-secondary-700">
                <p class="text-lg"><?= htmlspecialchars($data['hasil_visitasi'] ?? 'Belum ada hasil visitasi') ?></p>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="index.php" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg hover:from-primary-600 hover:to-primary-700 shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center mx-auto space-x-2 text-lg" aria-label="Kembali ke Dashboard">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
</body>
</html>