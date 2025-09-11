<?php
require_once __DIR__ . '/../config/functionDetail.php';

$id = $_GET['id'] ?? null;

$data = detailsAdmin($id);
$fields = $data['fields'];
$rows   = $data['data'];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Data PMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .no-column {
            width: 50px;
            text-align: center;
            vertical-align: middle;
        }

        .description-column {
            min-width: 300px;
        }

        .score-columns {
            width: 80px;
            text-align: center;
        }

        .notes-column {
            min-width: 100px;
        }

        .main-item {
            font-weight: bold;
            background-color: #DBEAFE;
        }

        .sub-item {
            padding-left: 20px;
        }

        .no-hover:hover {
            background-color: inherit !important;
        }

        .total-row {
            font-weight: bold;
        }

        /* CSS untuk tombol */
        .cssbuttons-io-button {
            display: flex;
            align-items: center;
            font-family: inherit;
            font-weight: 500;
            font-size: 16px;
            padding: 0.7em 1.4em 0.7em 1.1em;
            color: white;
            background: linear-gradient(0deg, rgba(20, 167, 62, 1) 0%, rgba(102, 247, 113, 1) 100%);
            border: none;
            box-shadow: 0 0.7em 1.5em -0.5em #14a73e98;
            letter-spacing: 0.05em;
            border-radius: 20em;
            cursor: pointer;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .cssbuttons-io-button:hover {
            box-shadow: 0 0.5em 1.5em -0.5em #14a73e98;
        }

        .cssbuttons-io-button:active {
            box-shadow: 0 0.3em 1em -0.5em #14a73e98;
        }

        .cssbuttons-io-button .icon {
            margin-right: 0;
            margin-left: 8px;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Navigation -->
        <div class="flex justify-between items-center mb-6">
            </div>
            
            <?php foreach ($rows as $row): ?>
                <!-- Institution Info Card -->
                <a href="./laporan.php" class="back-button inline-flex items-center px-4 py-3 text-white rounded-lg shadow-md bg-red-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            <div class="institution-card rounded-xl p-6 mb-8 shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Lembaga</h2>
                        <p class="text-3xl font-bold text-blue-600">
                            <?php
                            if (isset($row['nama_satuan_pendidikan'])) {
                                echo htmlspecialchars($row['nama_satuan_pendidikan']);
                            } else {
                                echo "Nama tidak ditemukan (ID: " . htmlspecialchars($row['id_table_lembaga'] ?? 'N/A') . ")";
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 overflow-x-auto border border-blue-100 mb-8">
                <table class="min-w-full text-sm border border-blue-200 rounded-lg">
                    <thead class="bg-blue-700 text-white">
                        <tr class="no-hover">
                            <th rowspan="2" class="no-column py-3 px-2">NO</th>
                            <th rowspan="2" class="description-column py-3 px-1">DESKRIPSI</th>
                            <th colspan="2" class="py-3 px-2">KELENGKAPAN</th>
                            <th colspan="2" class="py-3 px-2">SKOR</th>
                            <th rowspan="2" class="notes-column py-3 px-2">KETERANGAN</th>
                        </tr>

                        <tr class="bg-blue-800 text-blue-50 divide-x divide-white/30 no-hover">
                            <th class="score-columns py-2 px-2">Ada</th>
                            <th class="score-columns py-2 px-2">Tidak</th>
                            <th class="score-columns py-2 px-2">Rentang</th>
                            <th class="score-columns py-2 px-2">Perolehan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Definisikan kelompok field dengan nama yang sesuai
                        $fieldGroups = [
                            'Surat Permohonan ijin Penyelenggaraan LKP dengan PMA;' => [
                                'form_pendaftaran' => 'Formulir Pendaftaran',
                                'surat_tugas' => 'Surat Kuasa/ Surat Tugas Pemohon dari Lembaga',
                                'ktp_pemohon' => 'KTP Pemohon',
                                'surat_rekomendasi' => 'Surat Rekomendasi dari Dinas Pendidikan',
                                'sk_kemenhumkam' => 'Salinan SK Kemenhukam',
                                'nomor_induk_berusaha' => 'Salinan Nomor Induk Berusaha (NIB)',
                                'kepemilikan_tanah' => 'Salinan Bukti Kepemilikan atas Tanah dan Bangunan',
                            ],
                            'Rencana Induk Pengembangan Satuan pendidikan (RIPS) 3 Tahun Kedepan <br> untuk isi pendidikan;' => [
                                'acuan_kurikulum' => 'Acuan Pengembangan Kurikulum (Asing/Dalam Negeri)',
                                'kurikulum' => 'Kurikulum yang Ketersempurnaan, Capaian Pembelajaran, Materi dan Jumlah Jam Mapel',
                                'rpp' => 'RPP, meliputi jumlah sesi per paket atau jenjang kopetensi, durasi per sesi, jadwal/kalender pendidikan',
                                'pendekatan_pembelajaran' => 'Pendekatan Pembelajaran (daring/luring)'
                            ],
                            'Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan <br> untuk jumlah kualifikasi pendidik dan tenaga kependidikan;' => [
                                'nama' => 'Nama (KTP/Paspor/KITAS/Foto)',
                                'jabatan' => 'Jabatan di Lembaga Kursus',
                                'kualifikasi_akademik' => 'Kualifikasi Akademik (Pendidikan Terakhir)',
                                'sertifikat' => 'Sertifikat Kompetensi',
                                'pengalaman_kerja' => 'Pengalaman Bekerja/Mengajar'
                            ],
                            'Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan <br> untuk sarana dan prasarana pendidikan;' => [
                                'bangunan' => 'Bangunan (jumlah, ukuran, kondisi dan foto)',
                                'ruangan' => 'Ruangan (jumlah, ukuran, kondisi dan foto)',
                                'alat' => 'Alat (jumlah, ukuran, kondisi dan foto)',
                                'bahan_ajar' => 'Bahan Ajar (jumlah, ukuran, kondisi dan foto)',
                                'kepemilikan_gedung' => 'Status Kepemilikan gedung/lahan kewirausahaan'
                            ],
                            'Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan <br> untuk pembiayaan pendidikan;' => [
                                'rancangan_pembiayaan' => 'Rancangan pembiayaan (seperti pembiayaan untuk proses pembelajaran, peningkatan kompetensi/kualifikasi PTK, pengembangan kurikulum, peningkatan sarana dan prasarana)',
                                'sumber_pembiayaan' => 'Sumber pembiayaan (modal asing/sumbdk dari pemasukan lain)'
                            ],
                            'Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan <br> untuk sistem evaluasi dan sertifikasi;' => [
                                'sistem_sertifikasi' => 'Sistem sertifikasi kompetensi (lembaga sertifikasi/mandiri)',
                                'orientasi_sertifikasi' => 'Orientasi pengakuan sertifikat kompetensi (nasional/internasional)',
                                'pengembangan_evaluasi' => 'Pengembangan sistem evaluasi (mandiri/bersama mitra/mengadopsi sistem evaluasi asing)'
                            ],
                            '	Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan <br> untuk manajemen dan proses pendidikan' => [
                                'struktur_organisasi' => 'Struktur Organisasi',
                                'sop' => 'SOP',
                                'peserta_didik' => 'Rekrutmen peserta didik, tenaga pendidik, dan tenaga kependidikan',
                                'kalender_pembelajaran' => 'Kalender pembelajaran tiap program',
                                'jadwal_ruangan' => 'Jadwal penggunaan ruangan'
                            ]
                        ];

                        $fieldCounter = 1;
                        $totalScore = 0;
                        ?>

                        <?php foreach ($fieldGroups as $groupName => $groupFields): ?>
                            <?php
                            $hasDataInGroup = false;
                            $groupRowCount = 0;

                            // Hitung berapa banyak field dalam grup ini yang memiliki data
                            foreach ($groupFields as $fieldKey => $fieldLabel) {
                                if (!empty($row[$fieldKey])) {
                                    $hasDataInGroup = true;
                                    $groupRowCount++;
                                }
                            }

                            if (!$hasDataInGroup) continue;
                            ?>

                            <tr class="bg-blue-100">
                                <td rowspan="<?= $groupRowCount + 1 ?>" class="no-column text-center font-bold"><?= $fieldCounter++ ?></td>
                                <td class="main-item font-bold px-3" colspan="6"><?= $groupName ?></td>
                            </tr>

                            <?php foreach ($groupFields as $fieldKey => $fieldLabel): ?>
                                <?php if (!empty($row[$fieldKey])): ?>
                                    <?php
                                    $parts = explode(",", $row[$fieldKey]);
                                    $status = $parts[0] ?? '-';
                                    $score = $parts[1] ?? '0';
                                    $description = $parts[2] ?? '-';

                                    $totalScore += (int)$score;
                                    ?>

                                    <tr class="transition-colors duration-200 hover:bg-blue-50">
                                        <td class="sub-item"><?= htmlspecialchars($fieldLabel) ?></td>
                                        <td class="score-columns text-center">
                                            <?php if (strtolower($status) === 'ada'): ?>
                                                <i class="fas fa-check text-green-500"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="score-columns text-center">
                                            <?php if (strtolower($status) === 'tidak'): ?>
                                                <i class="fas fa-times text-red-500"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="score-columns text-center">1-15</td>
                                        <td class="score-columns text-center font-bold"><?= htmlspecialchars($score) ?></td>
                                        <td class="notes-column"><?= htmlspecialchars($description) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php endforeach; ?>

                        <tr class="total-row bg-blue-200 text-blue-900 font-bold">
                            <td></td>
                            <td class="text-center py-3" colspan="4">JUMLAH ANGKA PEROLEHAN</td>
                            <td class="score-columns text-center py-3"><?= $totalScore ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>