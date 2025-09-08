<?php
session_start();
require_once __DIR__ . '/../config/functions.php';

$message = "";

// Jika tidak ada, artinya belum login, maka redirect ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: ../validasi.php");
    // exit();
}

if($_SESSION['user']['user'] != 'admin' && $_SESSION['user']['key'] != 'admin'){
    header("Location: ../validasi.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = insertLembaga($_POST, $_FILES);

    if ($result === true) {
        $_SESSION['notyf'] = ["type" => "success", "text" => "Data berhasil disimpan!"];
    } else {
        $_SESSION['notyf'] = ["type" => "error", "text" => $result];
    }

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Lembaga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script>
        tailwind.config = {
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
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
        }

        .file-input {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-primary-50 to-primary-100 min-h-screen">
    <?php
    require_once __DIR__ . '/../config/functions.php';

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $result = insertLembaga($_POST, $_FILES);

        if ($result === true) {
            $message = "<div class='mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm'>
                            <div class='flex items-center'>
                                <svg class='w-5 h-5 mr-2' fill='currentColor' viewBox='0 0 20 20'>
                                    <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' clip-rule='evenodd'></path>
                                </svg>
                                Data berhasil disimpan!
                            </div>
                        </div>";
        } else {
            $message = "<div class='mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm'>
                            <div class='flex items-center'>
                                <svg class='w-5 h-5 mr-2' fill='currentColor' viewBox='0 0 20 20'>
                                    <path fill-rule='evenodd' d='M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z' clip-rule='evenodd'></path>
                                </svg>
                                $result
                            </div>
                        </div>";
        }
    }
    ?>

    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-500 text-white rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0v-4a2 2 0 012-2h4a2 2 0 012 2v4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-dark-900 mb-2">Form Input Data Lembaga</h1>
            <p class="text-dark-700">Lengkapi informasi lembaga pendidikan dengan detail yang akurat</p>
        </div>

        <!-- Message Display -->
        <?= $message; ?>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-primary-100 overflow-hidden">
            <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-6">
                <h2 class="text-xl font-semibold text-white">Informasi Lembaga</h2>
                <p class="text-primary-100 text-sm mt-1">Semua field wajib diisi</p>
            </div>

            <form method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                <!-- NPSN -->
                <div class="group">
                    <label class="block text-sm font-semibold text-dark-800 mb-2">
                        NPSN <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="npsn"
                        required minlength="7"
                        require maxlength="8"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900"
                        placeholder="Masukkan NPSN">
                </div>

                <!-- Nama Satuan Pendidikan -->
                <div class="group">
                    <label class="block text-sm font-semibold text-dark-800 mb-2">
                        Nama Satuan Pendidikan <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="nama_satuan_pendidikan"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900"
                        placeholder="Masukkan nama satuan pendidikan">
                </div>

                <!-- Foto Lembaga -->
                <div class="group">
                    <label class="block text-sm font-semibold text-dark-800 mb-2">
                        Foto Lembaga <span class="text-red-500">*</span>
                    </label>
                    <div class="file-input-wrapper w-full">
                        <input type="file"
                            name="foto_lembaga"
                            accept="image/*"
                            required
                            class="file-input"
                            id="foto-upload">
                        <label for="foto-upload"
                            class="file-input-label w-full px-4 py-3 border-2 border-dashed border-primary-300 rounded-xl bg-primary-50 hover:bg-primary-100 transition-all duration-300 flex items-center justify-center text-primary-700 font-medium">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Pilih foto lembaga (JPG, PNG)
                        </label>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="group">
                    <label class="block text-sm font-semibold text-dark-800 mb-2">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat"
                        required
                        rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900 resize-none"
                        placeholder="Masukkan alamat lengkap lembaga"></textarea>
                </div>

                <!-- Kecamatan & Kelurahan in Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-sm font-semibold text-dark-800 mb-2">
                            Kecamatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="kecamatan"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900"
                            placeholder="Masukkan kecamatan">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-dark-800 mb-2">
                            Kelurahan <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="kelurahan"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900"
                            placeholder="Masukkan kelurahan">
                    </div>
                </div>

                <!-- Status -->
                <div class="group">
                    <label class="block text-sm font-semibold text-dark-800 mb-2">
                        Status Lembaga <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900 appearance-none bg-no-repeat bg-right pr-12"
                        style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%23374151%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M19 9l-7 7-7-7%22/></svg>'); background-size: 1.5rem; background-position: right 0.75rem center;">
                        <option value="" disabled selected>Pilih status lembaga</option>
                        <option value="PMA">PMA</option>
                        <option value="Non PMA">Non PMA</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data Lembaga
                    </button>

                    
                </div>
            </form>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-8 text-dark-700 text-sm">
            <p>Pastikan semua informasi yang dimasukkan sudah benar sebelum menyimpan</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        // File upload visual feedback
        document.getElementById('foto-upload').addEventListener('change', function(e) {
            const label = document.querySelector('label[for="foto-upload"]');
            const fileName = e.target.files[0]?.name;

            if (fileName) {
                label.innerHTML = `
                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                ${fileName}
            `;
                label.classList.add('text-green-700', 'bg-green-50', 'border-green-300');
                label.classList.remove('text-primary-700', 'bg-primary-50', 'border-primary-300');
            }
        });

        // Form animation on load
        window.addEventListener('load', function() {
            const formCard = document.querySelector('.bg-white');
            formCard.style.transform = 'translateY(20px)';
            formCard.style.opacity = '0';

            setTimeout(() => {
                formCard.style.transition = 'all 0.6s ease-out';
                formCard.style.transform = 'translateY(0)';
                formCard.style.opacity = '1';
            }, 100);
        });

        // Notyf notification
        <?php if (isset($_SESSION['notyf'])): ?>
            document.addEventListener("DOMContentLoaded", function() {
                const notyf = new Notyf({
                    duration: 3000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });

                <?php if ($_SESSION['notyf']['type'] === 'success'): ?>
                    notyf.success("<?= $_SESSION['notyf']['text'] ?>");
                <?php else: ?>
                    notyf.error("<?= $_SESSION['notyf']['text'] ?>");
                <?php endif; ?>
            });
        <?php unset($_SESSION['notyf']);
        endif; ?>
    </script>

</body>

</html>