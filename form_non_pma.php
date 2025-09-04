<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: validasi.php");
    exit();
}

$user = $_SESSION['user'];

if ($user["status"] === "Non PMA") {
    // tetap di halaman
} else {
    header("Location: pilih_jenis.php");
    exit();
}

require_once __DIR__ . '/config/functions.php';

// handle submit
$notif = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button_kirim'])) {
    $result = insertNonPMA();
    if ($result !== false) {
        $notif = ['type' => 'success', 'message' => 'Data Berhasil Ditambahkan!'];
    } else {
        $notif = ['type' => 'error', 'message' => 'Data Gagal Ditambahkan!'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Non PMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js'></script>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#050C9C',
                        'secondary': '#3572EF',
                        'white': '#FFFFFF'
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #050C9C 0%, #3572EF 50%, #3ABEF9 100%);
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(5, 12, 156, 0.15);
        }

        .input-focus:focus {
            border-color: #3ABEF9;
            box-shadow: 0 0 0 3px rgba(58, 190, 249, 0.1);
        }

        .btn-hover:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 15px 35px rgba(5, 12, 156, 0.3);
        }

        .glass {
            background: rgba(0, 0, 0, 0.07);
            /* putih transparan */
            backdrop-filter: blur(10px);
            /* efek blur di belakang */
            -webkit-backdrop-filter: blur(10px);
            /* untuk Safari */
            border-radius: 16px;
            /* sudut membulat */
            border: 1px solid rgba(255, 255, 255, 0.77);
            /* border tipis transparan */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            /* shadow lembut */
        }


        .section-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(5, 12, 156, 0.08);
        }

        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <div class="max-w-6xl mx-auto mt-10 mb-10 p-8 rounded-2xl glass relative overflow-hidden card-shadow fade-in">
        <!-- Decorative blur circles -->
        <div class="absolute top-0 left-0 w-32 h-32 bg-white/20 rounded-full blur-2xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 bg-white/10 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

        <h1 class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-indigo-400 to-cyan-300 text-center mb-6 tracking-wide drop-shadow-lg animate-fadeIn">
            Form Pendaftaran Lembaga Non PMA
        </h1>

        <p class="text-white/80 text-center text-lg mb-8">
            Silakan isi data diri Anda dengan lengkap dan benar
        </p>

        <?php if ($notif): ?>
            <script>
                (function() {
                    const notyf = new Notyf({
                        duration: 3500,
                        position: {
                            x: 'right',
                            y: 'top'
                        }
                    });

                    <?php if ($notif['type'] === 'success'): ?>
                        notyf.success("<?= $notif['message'] ?>");
                    <?php else: ?>
                        notyf.error("<?= $notif['message'] ?>");
                    <?php endif; ?>

                    // redirect ke index.php setelah 3.5 detik
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 3500);
                })();
            </script>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-8">
            <input type="hidden" name="id_table_lembaga" value="<?= htmlspecialchars($user['id']); ?>">
            <!-- Data Lembaga -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Lembaga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">No Akte:</label>
                        <input type="text" name="no_akte" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jenis Kegiatan:</label>
                        <input type="text" name="jenis_kegiatan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Kota Administrasi:</label>
                        <input type="text" name="kota_administrasi" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Data Pimpinan Lembaga -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Pimpinan Lembaga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Nama Pimpinan:</label>
                        <input type="text" name="nama_pimpinan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Ijazah:</label>
                        <input type="text" name="ijazah" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Asal PT:</label>
                        <input type="text" name="asal_pt" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jurusan:</label>
                        <input type="text" name="pimpinan_jurusan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">SK Lembaga:</label>
                        <input type="text" name="pimpinan_sk_lembaga" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Nomor SK:</label>
                        <input type="text" name="pimpinan_sk_nomor" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Tanggal SK:</label>
                        <input type="date" name="pimpinan_sk_tanggal" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pengalaman:</label>
                        <input type="text" name="pimpinan_pengalaman" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Data Pendidik WNI -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Pendidik WNI</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidik WNI Laki-laki:</label>
                        <input type="number" name="pendidik_wni_laki" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidik WNI Perempuan:</label>
                        <input type="number" name="pendidik_wni_perempuan" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidikan Terakhir WNI:</label>
                        <input type="text" name="pendidik_wni_pendidikan_terakhir" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Sertifikat WNI:</label>
                        <input type="text" name="pendidik_wni_sertifikat" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Data Pendidik WNA -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Pendidik WNA</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Ijin Kerja WNA:</label>
                        <select name="pendidik_wna_ijin_kerja" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="ada">ada</option>
                            <option value="tidak ada">tidak Ada</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidik WNA Laki-laki:</label>
                        <input type="number" name="pendidik_wna_laki" min="0" value="0" class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidik WNA Perempuan:</label>
                        <input type="number" name="pendidik_wna_perempuan" min="0" value="0" class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidikan Terakhir WNA:</label>
                        <input type="text" name="pendidik_wna_pendidikan_terakhir" class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Sertifikat WNA:</label>
                        <input type="text" name="pendidik_wna_sertifikat" class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Data Tenaga Kependidikan -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Tenaga Kependidikan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Jumlah Tenaga Pendidik:</label>
                        <input type="number" name="jumlah_tendik" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Pendidikan Terakhir Pendidik:</label>
                        <input type="text" name="pendidikan_tendik" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Penghasilan Pendidik -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Penghasilan Pendidik</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Gaji Pendidik WNI Min (Rp):</label>
                        <input type="number" name="gaji_pendidik_wni_min" min="0" step="1000" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Gaji Pendidik WNI Max (Rp):</label>
                        <input type="number" name="gaji_pendidik_wni_max" min="0" step="1000" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Gaji Pendidik WNA Min (Rp):</label>
                        <input type="number" name="gaji_pendidik_wna_min" min="0" step="1000" value="0" class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Gaji Pendidik WNA Max (Rp):</label>
                        <input type="number" name="gaji_pendidik_wna_max" min="0" step="1000" value="0" class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Data Administrasi -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Administrasi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">SOP:</label>
                        <select name="ada_sop" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Buku Hadir Pendidik:</label>
                        <select name="ada_buku_hadir_pendidik" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Buku Hadir Siswa:</label>
                        <select name="ada_buku_hadir_siswa" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Buku Inventaris:</label>
                        <select name="ada_buku_inventaris" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Program Kerja Yayasan:</label>
                        <select name="ada_program_kerja_yayasan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Program Kerja Pimpinan:</label>
                        <select name="ada_program_kerja_pimpinan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Kalender Pendidikan:</label>
                        <select name="ada_kalender_pendidikan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Buku Tamu:</label>
                        <select name="ada_buku_tamu" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Buku Induk:</label>
                        <select name="ada_buku_induk" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Buku Hasil Belajar:</label>
                        <select name="ada_buku_hasil_belajar" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jadwal:</label>
                        <select name="ada_jadwal" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Tata Tertib:</label>
                        <select name="ada_tata_tertib" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Sertifikat Pendidikan:</label>
                        <select name="ada_sertifikat_pendidikan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Struktur Organisasi:</label>
                        <select name="ada_struktur_organisasi" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Data Dokumen -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Dokumen</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Dokumen Kurikulum:</label>
                        <select name="dokumen_kurikulum" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada lengkap">Ada lengkap</option>
                            <option value="Ada tidak lengkap">Ada tidak lengkap</option>
                            <option value="Tidak ada">Tidak ada</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Dokumen Rencana Pengembangan:</label>
                        <select name="dokumen_rencana_pengembangan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada lengkap">Ada lengkap</option>
                            <option value="Ada tidak lengkap">Ada tidak lengkap</option>
                            <option value="Tidak ada">Tidak ada</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Dokumen Rencana Tahunan:</label>
                        <select name="dokumen_rencana_tahunan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada lengkap">Ada lengkap</option>
                            <option value="Ada tidak lengkap">Ada tidak lengkap</option>
                            <option value="Tidak ada">Tidak ada</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Sarana Prasarana -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Sarana Prasarana</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Luas Tanah:</label>
                        <input type="number" name="luas_tanah" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Status Tanah:</label>
                        <input type="text" name="status_tanah" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Peruntukan Tanah:</label>
                        <input type="text" name="peruntukan_tanah" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jumlah Ruang Belajar:</label>
                        <input type="number" name="jumlah_ruang_belajar" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Ukuran Ruang Belajar:</label>
                        <input type="text" name="ukuran_ruang_belajar" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Kondisi Gedung:</label>
                        <select name="kondisi_gedung" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Status Gedung:</label>
                        <input type="text" name="status_gedung" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Peruntukan Gedung:</label>
                        <input type="text" name="peruntukan_gedung" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jumlah Kamar Mandi:</label>
                        <input type="number" name="jumlah_kamar_mandi" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Perawatan Kamar Kecil:</label>
                        <select name="perawatan_kamar_kecil" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Persediaan Air Bersih:</label>
                        <select name="persediaan_air_bersih" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Ruang Pimpinan:</label>
                        <select name="ruang_pimpinan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Ruang TU:</label>
                        <select name="ruang_tu" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Ruang Perpustakaan:</label>
                        <select name="ruang_perpustakaan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Ruang Lab:</label>
                        <select name="ruang_lab" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Peralatan Laboratorium:</label>
                        <select name="peralatan_laboratorium" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Kondisi Ruang Kelas:</label>
                        <select name="kondisi_ruang_kelas" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Meja Kursi:</label>
                        <select name="meja_kursi" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Papan Tulis:</label>
                        <select name="papan_tulis" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Gudang:</label>
                        <select name="gudang" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Alat Kebersihan:</label>
                        <select name="alat_kebersihan" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Peserta Didik -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Peserta Didik</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Nama Program:</label>
                        <input type="text" name="nama_program" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Kelas dan Level:</label>
                        <input type="text" name="kelas_dan_level" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jumlah Siswa Laki-laki:</label>
                        <input type="number" name="jumlah_siswa_laki" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                    <div>
                        <label class="block text-white font-medium mb-1">Jumlah Siswa Perempuan:</label>
                        <input type="number" name="jumlah_siswa_perempuan" min="0" value="0" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary">
                    </div>
                </div>
            </div>

            <!-- Data Visitasi -->
            <div class="section-hover border-b-4 pulse-border pb-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Data Visitasi</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-white font-medium mb-1">Hasil Visitasi:</label>
                        <textarea name="hasil_visitasi" rows="4" required class="w-full px-4 py-2 rounded-lg border border-secondary input-focus bg-white/80 text-primary"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" name="button_kirim" class="w-full py-3 mt-8 gradient-bg btn-hover text-white font-bold rounded-lg shadow-lg transition-all duration-200 text-lg">Submit Form</button>
        </form>
    </div>
</body>

</html>