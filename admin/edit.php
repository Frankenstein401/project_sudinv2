<?php
require_once __DIR__ . '/../config/functionAdmin.php';

$id = $_GET['id'];
$data = getId($id);

if (!$data) {
    echo "<script>
        alert('Data not found');
        window.location.href = 'readAdmin.php';
    </script>";
    exit;
}

if (isset($_POST['update'])) {
    $npsn = $_POST['npsn'];
    $nama_satuan_pendidikan = $_POST['nama_satuan_pendidikan'];
    $alamat = $_POST['alamat'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $status = $_POST['status'];

    // cek upload foto
    if (!empty($_FILES['foto_lembaga']['name'])) {
        $foto_name = $_FILES['foto_lembaga']['name'];
        $foto_tmp = $_FILES['foto_lembaga']['tmp_name'];

        // simpan ke folder
        $target = "../uploads/" . $foto_name;
        move_uploaded_file($foto_tmp, $target);

        $foto_lembaga = $foto_name;
    } else {
        // jika tidak upload, tetap pakai yang lama dari database
        $foto_lembaga = $data['foto_lembaga'];
    }

    if (updateAdmin($id, $npsn, $nama_satuan_pendidikan, $foto_lembaga, $alamat, $kecamatan, $kelurahan, $status)) {
        echo "<script>
            alert('Data updated successfully');
            window.location.href = 'readAdmin.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update data');
            window.location.href = 'edit.php?id=$id';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Satuan Pendidikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
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
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'pulse-soft': 'pulseSoft 2s infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulseSoft {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-info-200 via-white to-info-50 min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto animate-fade-in">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-info-500 to-info-600 hover:from-info-600 hover:to-info-700 rounded-full mb-4 shadow-lg animate-pulse-soft">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-secondary-800 mb-2">Update Data Lembaga <span class="text-info-500"><?= $data['nama_satuan_pendidikan']; ?></span></h1>
            <p class="text-secondary-600">Kelola informasi lembaga pendidikan dengan mudah</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-secondary-200 overflow-hidden animate-slide-up">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-info-500 to-info-600 hover:from-info-600 hover:to-info-700 px-8 py-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Form Data Lembaga
                </h2>
                <p class="text-info-100 text-sm mt-1">Pastikan semua data terisi dengan benar</p>
            </div>

            <!-- Form Content -->
            <form action="" method="post" enctype="multipart/form-data" class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- NPSN -->
                    <div class="lg:col-span-2">
                        <label for="npsn" class="block text-sm font-semibold text-secondary-700 mb-2">
                            NPSN (Nomor Pokok Sekolah Nasional)
                            <span class="text-danger-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="npsn"
                                name="npsn"
                                value="<?= $data['npsn']; ?>"
                                class="input-focus w-full px-4 py-3 border border-secondary-300 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-200 bg-secondary-50 focus:bg-white text-secondary-900"
                                placeholder="Masukkan NPSN"
                                required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Nama Satuan Pendidikan -->
                    <div class="lg:col-span-2">
                        <label for="nama_satuan_pendidikan" class="block text-sm font-semibold text-secondary-700 mb-2">
                            Nama Satuan Pendidikan
                            <span class="text-danger-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="text" name="nama_satuan_pendidikan" value="<?= $data['nama_satuan_pendidikan']; ?>"
                                class="input-focus w-full px-4 py-3 border border-secondary-300 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-200 bg-secondary-50 focus:bg-white text-secondary-900"
                                placeholder="Masukkan nama lembaga"
                                required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Lembaga -->
                    <div>
                        <label for="foto_lembaga" class="block text-sm font-semibold text-secondary-700 mb-2">
                            Foto Lembaga
                            <span class="text-info-500 text-xs">(URL/Path)</span>
                        </label>
                        <div class="relative">
                            <input
                                type="file"
                                id="foto_lembaga"
                                name="foto_lembaga"
                                value="<?= $data['foto_lembaga']; ?>"
                                class="block w-full text-sm text-gray-700 
         border border-gray-300 rounded-lg cursor-pointer 
         bg-gray-50 focus:outline-none focus:ring-2 focus:ring-info-500 
         file:mr-4 file:py-2 file:px-4 
         file:rounded-lg file:border-0 
         file:text-sm file:font-semibold 
         file:bg-info-600 file:text-white 
         hover:file:bg-info-700"
                                placeholder="URL atau path foto" />

                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-secondary-700 mb-2">
                            Status
                            <span class="text-danger-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="text" name="status" value="<?= $data['status']; ?>"
                                class="input-focus w-full px-4 py-3 border border-secondary-300 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-200 bg-secondary-50 focus:bg-white text-secondary-900">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="lg:col-span-2">
                        <label for="alamat" class="block text-sm font-semibold text-secondary-700 mb-2">
                            Alamat Lengkap
                            <span class="text-danger-500">*</span>
                        </label>
                        <div class="relative">
                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                class="input-focus w-full px-4 py-3 border border-secondary-300 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-200 bg-secondary-50 focus:bg-white text-secondary-900 resize-none"
                                placeholder="Masukkan alamat lengkap"
                                required><?= $data['alamat']; ?></textarea>
                            <div class="absolute top-3 right-3 pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label for="kecamatan" class="block text-sm font-semibold text-secondary-700 mb-2">
                            Kecamatan
                            <span class="text-danger-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="kecamatan"
                                name="kecamatan"
                                value="<?= $data['kecamatan']; ?>"
                                class="input-focus w-full px-4 py-3 border border-secondary-300 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-200 bg-secondary-50 focus:bg-white text-secondary-900"
                                placeholder="Nama kecamatan"
                                required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kelurahan -->
                    <div>
                        <label for="kelurahan" class="block text-sm font-semibold text-secondary-700 mb-2">
                            Kelurahan/Desa
                            <span class="text-danger-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="kelurahan"
                                name="kelurahan"
                                value="<?= $data['kelurahan']; ?>"
                                class="input-focus w-full px-4 py-3 border border-secondary-300 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-200 bg-secondary-50 focus:bg-white text-secondary-900"
                                placeholder="Nama kelurahan/desa"
                                required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8 pt-6 border-t border-secondary-200">
                    <button
                        type="button"
                        class="px-6 py-3 text-secondary-700 bg-secondary-100 hover:bg-secondary-200 rounded-xl font-medium transition-all duration-200 hover:shadow-md focus:ring-2 focus:ring-secondary-300 focus:outline-none"
                        onclick="window.history.back()">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </button>
                    <button
                        type="submit"
                        name="update"
                        class="px-8 py-3 bg-gradient-to-r from-info-600 to-info-700 hover:from-info-700 hover:to-info-800 text-white rounded-xl font-semibold transition-all duration-200 hover:shadow-lg hover:scale-105 focus:ring-2 focus:ring-info-300 focus:outline-none flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Update Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-info-50 border border-info-200 rounded-xl p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-info-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-info-800">Informasi Penting</h3>
                    <div class="mt-1 text-sm text-info-700">
                        <p>• Field yang bertanda (<span class="text-danger-500">*</span>) wajib diisi</p>
                        <p>• Pastikan NPSN sesuai dengan data resmi Kemendikbud</p>
                        <p>• Data akan tersimpan setelah menekan tombol "Update Data"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay (Optional) -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-sm mx-4 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-info-600 mx-auto mb-4"></div>
            <h3 class="text-lg font-semibold text-secondary-800 mb-2">Memproses Data</h3>
            <p class="text-secondary-600">Mohon tunggu sebentar...</p>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            document.getElementById('loadingOverlay').classList.remove('hidden');
            document.getElementById('loadingOverlay').classList.add('flex');
        });

        // Input animations and validations
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('focus', function() {
                this.classList.add('ring-2', 'ring-info-500');
            });

            element.addEventListener('blur', function() {
                this.classList.remove('ring-2', 'ring-info-500');
            });
        });
    </script>

</body>

</html>







<!-- <form action="" method="post">
    <input type="text" name="npsn" value="<?= $data['npsn']; ?>">
    <input type="text" name="nama_satuan_pendidikan" value="<?= $data['nama_satuan_pendidikan']; ?>">
        <input type="text" name="foto_lembaga" value="<?= $data['foto_lembaga']; ?>">
        <input type="text" name="alamat" value="<?= $data['alamat']; ?>">
        <input type="text" name="kecamatan" value="<?= $data['kecamatan']; ?>">
        <input type="text" name="kelurahan" value="<?= $data['kelurahan']; ?>">
        <input type="text" name="status" value="<?= $data['status']; ?>">
        <button type="submit" name="update">Update</button>
    </form> -->