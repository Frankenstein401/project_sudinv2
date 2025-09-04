<?php
session_start();
require_once __DIR__ . '/config/functions.php';

// cek login
if (!isset($_SESSION['user'])) {
    header("Location: validasi.php");
    exit();
}

$user = $_SESSION['user'];
if ($user["status"] !== "PMA") {
    header("Location: pilih_jenis.php");
    exit();
}

// Proses submit form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button_kirim'])) {
    $result = insertPMA();

    if ($result !== false) {
        $_SESSION['notif'] = ['type' => 'success', 'message' => 'Data Berhasil Ditambahkan!'];
        header("Location: form_pma.php"); // redirect supaya page reload
        exit();
    } else {
        $_SESSION['notif'] = ['type' => 'error', 'message' => 'Data Gagal Ditambahkan!'];
        header("Location: form_pma.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Notyf CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            "50": "#eff6ff",
                            "100": "#dbeafe",
                            "200": "#bfdbfe",
                            "300": "#93c5fd",
                            "400": "#60a5fa",
                            "500": "#3b82f6",
                            "600": "#2563eb",
                            "700": "#1d4ed8",
                            "800": "#1e40af",
                            "900": "#1e3a8a"
                        },
                        dark: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155'
                        },
                        'secondary': '#3572EF',
                        'accent': '#3ABEF9',
                        'light': '#A7E6FF',
                        'white': '#FFFFFF'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1)',
                        'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1)',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(40px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        },
                    },
                },
            },
        };
    </script>
    <title>Tabel Evaluasi RIPS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* background-color: #ffffff; */
        }

        .gradient-bg {
            background: linear-gradient(135deg, #050C9C 0%, #3572EF 50%, #3ABEF9 100%);
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        } */

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        /* th {
            background-color: #e8e8e8;
            font-weight: bold;
            text-align: center;
        } */

        .header-row {
            background-color: #d0d0d0ff;
        }

        .no-column {
            width: 40px;
            text-align: center;
        }

        .description-column {
            width: 50%;
        }

        .score-columns {
            width: 30px;
            text-align: center;
        }

        .notes-column {
            width: 80px;
            text-align: center;
        }

        .sub-item {
            padding-left: 20px;
        }

        .main-item {
            font-weight: bold;
        }

        .total-row {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .no-hover:hover {
            background-color: inherit !important;
        }

        .cssbuttons-io-button {
            background: #4ade80;
            /* green-400 */
            color: white;
            font-family: inherit;
            padding: 0.35em;
            padding-left: 1.2em;
            font-size: 17px;
            font-weight: 500;
            border-radius: 0.9em;
            border: none;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            box-shadow: inset 0 0 1.6em -0.6em #22c55e;
            /* green-500 */
            overflow: hidden;
            position: relative;
            height: 2.8em;
            padding-right: 3.3em;
            cursor: pointer;
        }

        .cssbuttons-io-button .icon {
            background: white;
            margin-left: 1em;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 2.2em;
            width: 2.2em;
            border-radius: 0.7em;
            box-shadow: 0.1em 0.1em 0.6em 0.2em #22c55e;
            /* green-500 */
            right: 0.3em;
            transition: all 0.3s;
        }

        .cssbuttons-io-button:hover .icon {
            width: calc(100% - 0.6em);
        }

        .cssbuttons-io-button .icon svg {
            width: 1.1em;
            transition: transform 0.3s;
            color: #22c55e;
            /* green-500 */
        }

        .cssbuttons-io-button:hover .icon svg {
            transform: translateX(0.1em);
        }

        .cssbuttons-io-button:active .icon {
            transform: scale(0.95);
        }


        /* input {
            border: none;
            outline: none;
        } */
    </style>
    <!-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#050C9C',
                        'secondary': '#3572EF',
                        'accent': '#3ABEF9',
                        'light': '#A7E6FF',
                        'white': '#FFFFFF'
                    }
                }
            }
        }
    </script> -->
</head>

<body class="gradient-bg">

    <!-- Judul -->
    <div class="mb-2 mt-10 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white bg-clip-text text-transparent drop-shadow-md tracking-tight">
            Formulir Evaluasi Rencana Induk Pengembangan Satuan Pendidikan (RIPS) – Lembaga Kursus PMA
        </h2>
        <div class="mt-4 mx-auto max-w-4xl">
            <p class="text-light text-xl sm:text-2xl font-light">
                Silakan lengkapi seluruh data dengan benar sesuai dokumen resmi lembaga Anda.
                Informasi yang diberikan akan menjadi dasar evaluasi pengembangan satuan pendidikan.
            </p>
        </div>
    </div>


    <form action="" method="post" class="w-full max-w-7xl mx-auto p-4">
        <input type="hidden" name="id_table_lembaga" value="<?= htmlspecialchars($user['id']); ?>">
        <div class="bg-white rounded-2xl shadow-xl p-6 overflow-x-auto border border-primary-100">
            <table class="min-w-full text-sm border border-primary-200 rounded-lg">
                <thead class="bg-primary-700 text-white">
                    <tr class="no-hover">
                        <th rowspan="2" class="no-column py-3 px-2">NO</th>
                        <th rowspan="2" class="description-column py-3 px-2">DESKRIPSI</th>
                        <th colspan="2" class="py-3 px-2">KELENGKAPAN</th>
                        <th colspan="2" class="py-3 px-2">SKOR</th>
                        <th rowspan="2" class="notes-column py-3 px-2">KET</th>
                    </tr>

                    <tr class="bg-primary-800 text-primary-50 divide-x divide-white/30 no-hover">
                        <th class="score-columns py-2 px-2">Ada</th>
                        <th class="score-columns py-2 px-2">Tidak</th>
                        <th class="score-columns py-2 px-2">Rentang</th>
                        <th class="score-columns py-2 px-2">Perolehan</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- data tabel nomor 1 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="8" class="no-column">1</td>
                        <td class="main-item">Surat Permohonan ijin Penyelenggaraan LKP dengan PMA;</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-15</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. Fomulir Pendaftaran</td>
                        <td class="score-columns"><input type="radio" name="form_pendaftaran_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="form_pendaftaran_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="form_pendaftaran_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="form_pendaftaran_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">c. Surat Kuasa/ Surat Tugas Pemohon dari Lembaga</td>
                        <td class="score-columns"><input type="radio" name="surat_tugas_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="surat_tugas_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="surat_tugas_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="surat_tugas_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">d. KTP Pemohon</td>
                        <td class="score-columns"><input type="radio" name="ktp_pemohon_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="ktp_pemohon_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="ktp_pemohon_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="ktp_pemohon_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">e. Surat Rekomendasi dari Dinas Pendidikan</td>
                        <td class="score-columns"><input type="radio" name="surat_rekomendasi_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="surat_rekomendasi_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="surat_rekomendasi_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="surat_rekomendasi_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">f. Salinan SK Kemenhukam</td>
                        <td class="score-columns"><input type="radio" name="sk_kemenhumkam_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="sk_kemenhumkam_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="sk_kemenhumkam_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="sk_kemenhumkam_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">g. Salinan Nomor Induk Berusaha (NIB)</td>
                        <td class="score-columns"><input type="radio" name="nomor_induk_berusaha_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="nomor_induk_berusaha_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="nomor_induk_berusaha_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="nomor_induk_berusaha_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">h. Salinan Bukti Kepemilikan atas Tanah dan Bangunan</td>
                        <td class="score-columns"><input type="radio" name="kepemilikan_tanah_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="kepemilikan_tanah_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="kepemilikan_tanah_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="kepemilikan_tanah_keterangan"></td>
                    </tr>

                    <!-- data tabel nomor 2 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="5" class="no-column">2</td>
                        <td class="main-item">Rencana Induk Pengembangan Satuan pendidikan (RIPS) 3 Tahun Kedepan untuk isi pendidikan;</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-15</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. Acuan Pengembangan Kurikulum (Asing/Dalam Negeri)</td>
                        <td class="score-columns"><input type="radio" name="acuan_kurikulum_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="acuan_kurikulum_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="acuan_kurikulum_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="acuan_kurikulum_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">b. Kurikulum yang Ketersempurnaan, Capaian Pembelajaran, Materi dan Jumlah Jam Mapel</td>
                        <td class="score-columns"><input type="radio" name="kurikulum_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="kurikulum_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="kurikulum_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="kurikulum_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">c. RPP, meliputi jumlah sesi per paket atau jenjang kopetensi, durasi per sesi, jadwal/kalender pendidikan</td>
                        <td class="score-columns"><input type="radio" name="rpp_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="rpp_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="rpp_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="rpp_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">d. Pendekatan Pembelajaran (daring/luring)</td>
                        <td class="score-columns"><input type="radio" name="pendekatan_pembelajaran_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="pendekatan_pembelajaran_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="pendekatan_pembelajaran_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="pendekatan_pembelajaran_keterangan"></td>
                    </tr>

                    <!-- data nomor 3 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="6" class="no-column">3</td>
                        <td class="main-item">Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan untuk jumlah kualifikasi pendidik dan tenaga kependidikan;</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-14</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. Nama (KTP/Paspor/KITAS/Foto)</td>
                        <td class="score-columns"><input type="radio" name="nama_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="nama_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="nama_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="nama_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">b. Jabatan di Lembaga Kursus</td>
                        <td class="score-columns"><input type="radio" name="jabatan_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="jabatan_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="jabatan_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="jabatan_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">c. Kualifikasi Akademik (Pendidikan Terakhir)</td>
                        <td class="score-columns"><input type="radio" name="kualifikasi_akademik_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="kualifikasi_akademik_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="kualifikasi_akademik_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="kualifikasi_akademik_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">d. Sertifikat Kompetensi</td>
                        <td class="score-columns"><input type="radio" name="sertifikat_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="sertifikat_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="sertifikat_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="sertifikat_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">e. Pengalaman Bekerja/Mengajar</td>
                        <td class="score-columns"><input type="radio" name="pengalaman_kerja_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="pengalaman_kerja_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="pengalaman_kerja_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="pengalaman_kerja_keterangan"></td>
                    </tr>

                    <!-- data nomor 4 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="6" class="no-column">4</td>
                        <td class="main-item">Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan untuk sarana dan prasarana pendidikan;</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-14</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. Bangunan (jumlah, ukuran, kondisi dan foto)</td>
                        <td class="score-columns"><input type="radio" name="bangunan_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="bangunan_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="bangunan_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="bangunan_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">b. Ruangan (jumlah, ukuran, kondisi dan foto)</td>
                        <td class="score-columns"><input type="radio" name="ruangan_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="ruangan_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="ruangan_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="ruangan_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">c. Alat (jumlah, ukuran, kondisi dan foto)</td>
                        <td class="score-columns"><input type="radio" name="alat_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="alat_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="alat_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="alat_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">d. Bahan Ajar (jumlah, ukuran, kondisi dan foto)</td>
                        <td class="score-columns"><input type="radio" name="bahan_ajar_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="bahan_ajar_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="bahan_ajar_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="bahan_ajar_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">e. Status Kepemilikan gedung/lahan kewirausahaan</td>
                        <td class="score-columns"><input type="radio" name="kepemilikan_gedung_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="kepemilikan_gedung_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="kepemilikan_gedung_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="kepemilikan_gedung_keterangan"></td>
                    </tr>

                    <!-- data nomor 5 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="3" class="no-column">5</td>
                        <td class="main-item">Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan untuk pembiayaan pendidikan;</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-14</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. rancangan pembiayaan (seperti pembiayaan untuk proses pembelajaran, peningkatan kompetensi/kualifikasi PTK, pengembangan kurikulum, peningkatan sarana dan prasarana)</td>
                        <td class="score-columns"><input type="radio" name="rancangan_pembiayaan_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="rancangan_pembiayaan_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="rancangan_pembiayaan_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="rancangan_pembiayaan_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">b. sumber pembiayaan (modal asing/sumbdk dari pemasukan lain)</td>
                        <td class="score-columns"><input type="radio" name="sumber_pembiayaan_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="sumber_pembiayaan_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="sumber_pembiayaan_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="sumber_pembiayaan_keterangan"></td>
                    </tr>

                    <!-- data nomor 6 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="4" class="no-column">6</td>
                        <td class="main-item">Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan untuk sistem evaluasi dan sertifikasi;</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-14</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. sistem sertifikasi kompetensi (lembaga sertifikasi/mandiri)</td>
                        <td class="score-columns"><input type="radio" name="sistem_sertifikasi_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="sistem_sertifikasi_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="sistem_sertifikasi_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="sistem_sertifikasi_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">b. orientasi pengakuan sertifikat kompetensi (nasional/internasional)</td>
                        <td class="score-columns"><input type="radio" name="orientasi_sertifikasi_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="orientasi_sertifikasi_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="orientasi_sertifikasi_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="orientasi_sertifikasi_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">c. pengembangan sistem evaluasi (mandiri/bersama mitra/mengadopsi sistem evaluasi asing)</td>
                        <td class="score-columns"><input type="radio" name="pengembangan_evaluasi_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="pengembangan_evaluasi_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="pengembangan_evaluasi_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="pengembangan_evaluasi_keterangan"></td>
                    </tr>

                    <!-- data nomor 7 -->
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td rowspan="6" class="no-column">7</td>
                        <td class="main-item">Rencana Induk Pengembangan Satuan Pendidikan (RIPS) 3 Tahun Kedepan untuk manajemen dan proses pendidikan</td>
                        <td class="score-columns"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns">1-14</td>
                        <td class="score-columns"></td>
                        <td class="notes-column"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">a. Struktur Organisasi</td>
                        <td class="score-columns"><input type="radio" name="struktur_organisasi_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="struktur_organisasi_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="struktur_organisasi_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="struktur_organisasi_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">b. SOP</td>
                        <td class="score-columns"><input type="radio" name="sop_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="sop_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="sop_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="sop_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">c. Rekrutmen peserta didik, tenaga pendidik, dan tenaga kependidikan</td>
                        <td class="score-columns"><input type="radio" name="peserta_didik_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="peserta_didik_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="peserta_didik_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="peserta_didik_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">d. Kalender pembelajaran tiap program</td>
                        <td class="score-columns"><input type="radio" name="kalender_pembelajaran_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="kalender_pembelajaran_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="kalender_pembelajaran_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="kalender_pembelajaran_keterangan"></td>
                    </tr>
                    <tr class="transition-colors duration-200 hover:bg-primary-50">
                        <td class="sub-item">e. Jadwal penggunaan ruangan</td>
                        <td class="score-columns"><input type="radio" name="jadwal_ruangan_kelengkapan" value="ada"></td>
                        <td class="score-columns"><input type="radio" name="jadwal_ruangan_kelengkapan" value="tidak"></td>
                        <td class="score-columns"></td>
                        <td class="score-columns"><input type="number" min="1" max="15" style="width: 50px;" name="jadwal_ruangan_score"></td>
                        <td class="notes-column"><input type="text" style="width: 70px;" name="jadwal_ruangan_keterangan"></td>
                    </tr>

                    <tr class="total-row bg-primary-100 text-primary-900">
                        <td></td>
                        <td style="text-align: center;" class="font-bold">JUMLAH ANGKA PEROLEHAN</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="submit" name="button_kirim"
            class="cssbuttons-io-button w-[300px] font-semibold my-5 ml-auto">
            Kirim data
            <div class="icon">
                <svg
                    height="24"
                    width="24"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                        fill="currentColor"></path>
                </svg>
            </div>
        </button>
    </form>

    <!-- Footer -->
    <footer class="mt-12 py-6 bg-white border-t border-secondary-100">
        <div class="container mx-auto px-4 text-center">
            <p class="text-secondary-600 text-sm">&copy; <?= date('Y'); ?> <span>2025 Sistem Pendataan & Visitasi LKP</span> –
                <strong>Suku Dinas Pendidikan Kota Administrasi Jakarta Utara</strong>.
                Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <script>
        const notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'right',
                y: 'top'
            }
        });
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            // Cek semua input radio dan number
            const requiredRadios = document.querySelectorAll('input[type="radio"]');
            const requiredNumbers = document.querySelectorAll('input[type="number"]');

            let allRadiosChecked = true;
            const radioGroups = {};

            // Group radio buttons by name
            requiredRadios.forEach(radio => {
                if (!radioGroups[radio.name]) {
                    radioGroups[radio.name] = [];
                }
                radioGroups[radio.name].push(radio);
            });

            // Check if each radio group has at least one checked
            for (const groupName in radioGroups) {
                const isChecked = radioGroups[groupName].some(radio => radio.checked);
                if (!isChecked) {
                    allRadiosChecked = false;
                    break;
                }
            }

            // Check if all number inputs are filled
            let allNumbersFilled = true;
            requiredNumbers.forEach(input => {
                if (!input.value) {
                    allNumbersFilled = false;
                }
            });

            if (!allRadiosChecked || !allNumbersFilled) {
                e.preventDefault();
                notyf.error('Harap lengkapi semua field yang wajib diisi!');
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_SESSION['notif'])): ?>
                const notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });
                <?php if ($_SESSION['notif']['type'] === 'success'): ?>
                    notyf.success("<?= $_SESSION['notif']['message']; ?>");
                <?php else: ?>
                    notyf.error("<?= $_SESSION['notif']['message']; ?>");
                <?php endif; ?>
            <?php unset($_SESSION['notif']);
            endif; ?>
        });
    </script>

    <style>
        input[type="radio"]:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        input[type="number"]:focus,
        input[type="text"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px #bfdbfe;
        }

        tr:hover {
            background-color: #dbeafe;
        }
    </style>

</body>

</html>