<?php
// Selalu mulai session di awal
session_start();
$notif = null;

if (isset($_SESSION['notyf'])) {
    $notif = $_SESSION['notyf'];
    unset($_SESSION['notyf']); // supaya cuma sekali tampil
}

// Cek apakah session 'user' ada atau tidak
// Jika tidak ada, artinya belum login, maka redirect ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: validasi.php");
    // exit();
}

// Jika session ada, kita bisa gunakan datanya
// Untuk gampangnya, kita simpan data user ke dalam variabel
$user = $_SESSION['user'];

$user   = $_SESSION['user'];
$status = trim($user['status']); // status asli dari user (misalnya "PMA" atau "Non PMA")

if (isset($_POST['pilih'])) {
    $pilihan = trim($_POST['pilih_cabang_lkp'] ?? '');

    if (strcasecmp($pilihan, $status) === 0) {
        if ($status === "PMA") {
            $_SESSION['notyf'] = [
                'type' => 'success',
                'message' => 'Berhasil memilih PMA',
                'redirect' => 'form_pma.php'
            ];
        } elseif ($status === "Non PMA") {
            $_SESSION['notyf'] = [
                'type' => 'success',
                'message' => 'Berhasil memilih Non PMA',
                'redirect' => 'form_non_pma.php'
            ];
        }
        header("Location: pilih_jenis.php"); // kembali ke halaman ini dulu
        exit;
    } else {
        $_SESSION['notyf'] = [
            'type' => 'error',
            'message' => 'Pilihan tidak valid! Status Anda adalah ' . $status
        ];
        header("Location: pilih_jenis.php");
        exit;
    }
}



$styles = [
    'Aktif'   => ['bg-blue-100 text-blue-800', '<i class="fas fa-check-circle mr-1"></i>'],
    'Nonaktif' => ['bg-red-100 text-red-800', '<i class="fas fa-times-circle mr-1"></i>'],
    'PMA'     => ['bg-green-100 text-green-800', '<i class="fas fa-building mr-1"></i>'],
    'Non PMA' => ['bg-yellow-100 text-yellow-800', '<i class="fas fa-university mr-1"></i>']
];

// fallback default kalau status nggak ada di mapping
$style = $styles[$status] ?? ['bg-gray-100 text-gray-800', '<i class="fas fa-question-circle mr-1"></i>'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Cabang Lembaga Kursus dan Pelatihan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: "#f0f9ff",
                            100: "#dbeafe",
                            200: "#bfdbfe",
                            300: "#93c5fd",
                            400: "#60a5fa",
                            500: "#3b82f6",
                            600: "#2563eb",
                            700: "#1d4ed8",
                            800: "#1e40af",
                            900: "#1e3a8a"
                        },
                        secondary: {
                            50: "#f8fafc",
                            100: "#f1f5f9",
                            200: "#e2e8f0",
                            300: "#cbd5e1",
                            400: "#94a3b8",
                            500: "#64748b",
                            600: "#475569",
                            700: "#334155",
                            800: "#1e293b",
                            900: "#0f172a"
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
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
                                transform: 'translateY(10px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .select-option {
            transition: all 0.2s ease;
        }

        .select-option:hover {
            background-color: #f0f9ff;
            border-color: #0ea5e9;
        }

        .glow {
            box-shadow: 0 0 15px rgba(14, 165, 233, 0.3);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-primary-50 to-primary-100">
    <!-- Header dengan navigasi -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-primary-600 text-white p-3 rounded-lg mr-3">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
                <h1 class="text-xl font-bold text-secondary-800">Sistem Informasi LKP</h1>
            </div>

            <div class="flex items-center space-x-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-medium text-secondary-700"><?= htmlspecialchars($user['nama_satuan_pendidikan']); ?></p>
                    <p class="text-xs text-secondary-500">NPSN: <?= htmlspecialchars($user['npsn']); ?></p>
                </div>
                <div x-data="{ open: false }" class="relative inline-block">
                    <!-- Avatar -->
                    <div
                        id="logOut"
                        @click="open = !open"
                        class="bg-primary-100 text-primary-800 h-10 w-10 rounded-full flex items-center justify-center font-semibold cursor-pointer">
                        <?= strtoupper(substr(htmlspecialchars($user['nama_satuan_pendidikan']), 0, 1)); ?>
                    </div>

                    <!-- Tooltip -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute left-1/2 -translate-x-1/2 mt-2 whitespace-nowrap bg-red-200 border border-red-800 shadow-lg rounded-md px-5 py-1 text-sm text-red-700 cursor-pointer"
                        @click="window.location.href='index.php'">
                        Log Out
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6 flex items-center space-x-2 text-sm text-secondary-500">
            <a href="./index.php" class="hover:text-primary-600"><i class="fas fa-home"></i></a>
            <span><i class="fas fa-chevron-right text-xs"></i></span>
            <span class="text-primary-600 font-medium">Pilih Cabang LKP</span>
        </div>

        <!-- Header Section -->
        <div class="text-center mb-10 animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-secondary-800 mb-4">Pilih Jenis Cabang Lembaga</h1>
            <p class="text-secondary-600 max-w-2xl mx-auto">Silakan pilih jenis cabang lembaga kursus dan pelatihan yang sesuai dengan karakteristik kepemilikan lembaga Anda.</p>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto">
            <!-- Institution Information Card -->
            <div class="bg-white rounded-xl shadow-lg border border-primary-100 mb-8 overflow-hidden card-hover animate-slide-up">
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-4">
                    <h2 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-university mr-3"></i>
                        Informasi Lembaga Pendidikan
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <span class="inline-block w-32 text-sm font-medium text-secondary-600 mr-4">NPSN:</span>
                                <span class="text-secondary-800 font-semibold"><?= htmlspecialchars($user['npsn']); ?></span>
                            </div>
                            <div class="flex items-start">
                                <span class="inline-block w-32 text-sm font-medium text-secondary-600 mr-4">Nama Lembaga:</span>
                                <span class="text-secondary-800 font-semibold"><?= htmlspecialchars($user['nama_satuan_pendidikan']); ?></span>
                            </div>
                            <div class="flex items-start">
                                <span class="inline-block w-32 text-sm font-medium text-secondary-600 mr-4">Alamat:</span>
                                <span class="text-secondary-700"><?= htmlspecialchars($user['alamat']); ?></span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <span class="inline-block w-24 text-sm font-medium text-secondary-600 mr-4">Kecamatan:</span>
                                <span class="text-secondary-700"><?= htmlspecialchars($user['kecamatan']); ?></span>
                            </div>
                            <div class="flex items-start">
                                <span class="inline-block w-24 text-sm font-medium text-secondary-600 mr-4">Kelurahan:</span>
                                <span class="text-secondary-700"><?= htmlspecialchars($user['kelurahan']); ?></span>
                            </div>
                            <div class="flex items-start">
                                <span class="inline-block w-24 text-sm font-medium text-secondary-600 mr-4">Status:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?= $style[0] ?>">
                                    <?= $style[1] ?>
                                    <?= htmlspecialchars($status); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selection Form Card -->
            <div class="bg-white rounded-xl shadow-lg border border-primary-100 card-hover animate-slide-up">
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-4">
                    <h3 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-code-branch mr-3"></i>
                        Pilih Jenis Cabang LKP
                    </h3>
                </div>
                <div class="p-6">
                    <form action="" method="post" class="space-y-6" id="selectionForm">
                        <div>
                            <label for="pilih_cabang_lkp" class="block text-sm font-medium text-secondary-700 mb-3">
                                Jenis Cabang Lembaga Kursus dan Pelatihan
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="select-option border-2 border-secondary-200 rounded-xl p-5 cursor-pointer transition-all duration-200" data-value="Non Pma">
                                    <div class="flex items-start">
                                        <div class="bg-yellow-100 text-yellow-800 p-3 rounded-lg mr-4">
                                            <i class="fas fa-university mr-1"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-secondary-800">Non PMA</h4>
                                            <p class="text-sm text-secondary-600 mt-1">Lembaga dengan kepemilikan dalam negeri</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="select-option border-2 border-secondary-200 rounded-xl p-5 cursor-pointer transition-all duration-200" data-value="PMA">
                                    <div class="flex items-start">
                                        <div class="bg-green-100 text-green-800 p-3 rounded-lg mr-4">
                                            <i class="fas fa-globe-asia text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-secondary-800">PMA</h4>
                                            <p class="text-sm text-secondary-600 mt-1">Lembaga dengan investasi asing atau joint venture</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="relative hidden">
                                <select name="pilih_cabang_lkp" id="pilih_cabang_lkp"
                                    class="w-full px-4 py-3 border-2 border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white text-gray-900 appearance-none transition duration-200 ease-in-out">
                                    <option value="">-- Pilih Jenis Cabang --</option>
                                    <option value="Non Pma">Non PMA (Penanaman Modal Asing)</option>
                                    <option value="PMA">PMA (Penanaman Modal Asing)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-primary-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center pt-4">
                            <button type="submit" name="pilih" id="submitButton"
                                class="px-8 py-3.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform transition duration-200 ease-in-out focus:outline-none focus:ring-4 focus:ring-primary-300 flex items-center disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                <i class="fas fa-arrow-right mr-2"></i>
                                Lanjutkan
                            </button>
                        </div>
                    </form>

                    <!-- Information Box -->
                    <div class="mt-8 p-5 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-blue-700 p-2 rounded-lg mr-4">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-2">Informasi Pemilihan Jenis Cabang</h4>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li><strong>Non PMA</strong>: Lembaga dengan kepemilikan penuh dalam negeri tanpa investasi asing</li>
                                    <li><strong>PMA</strong>: Lembaga dengan investasi asing atau joint venture sesuai regulasi Penanaman Modal Asing</li>
                                </ul>
                                <p class="text-sm text-blue-700 mt-3">Pastikan Anda memilih jenis yang sesuai dengan struktur kepemilikan lembaga Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-12 py-6 bg-white border-t border-secondary-100">
        <div class="container mx-auto px-4 text-center">
            <p class="text-secondary-600 text-sm">&copy; <?= date('Y'); ?> <span>2025 Sistem Pendataan & Visitasi LKP</span> –
                <strong>Suku Dinas Pendidikan Kota Administrasi Jakarta Utara</strong>.
                Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        <?php if ($notif): ?>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });

            <?php if ($notif['type'] === 'success'): ?>
                notyf.success("<?= $notif['message'] ?>");
                <?php if (isset($notif['redirect'])): ?>
                    setTimeout(() => {
                        window.location.href = "<?= $notif['redirect'] ?>";
                    }, 2500);
                <?php endif; ?>
            <?php else: ?>
                notyf.error("<?= $notif['message'] ?>");
            <?php endif; ?>
        <?php endif; ?>

        // Enhanced form selection with visual feedback
        const options = document.querySelectorAll('.select-option');
        const select = document.getElementById('pilih_cabang_lkp');
        const submitButton = document.getElementById('submitButton');

        options.forEach(option => {
            option.addEventListener('click', function() {
                // Remove all active classes
                options.forEach(opt => {
                    opt.classList.remove('border-primary-500', 'glow', 'bg-primary-50');
                    opt.classList.add('border-secondary-200');
                });

                // Add active class to clicked option
                this.classList.remove('border-secondary-200');
                this.classList.add('border-primary-500', 'glow', 'bg-primary-50');

                // Set the select value
                const value = this.getAttribute('data-value');
                select.value = value;

                // Enable submit button
                submitButton.disabled = false;

                // Add checkmark to selected option
                this.querySelector('i:first-child').classList.remove('fa-flag', 'fa-globe-asia');
                this.querySelector('i:first-child').classList.add('fa-check-circle');
            });
        });

        // Form validation
        document.getElementById('selectionForm').addEventListener('submit', function(e) {
            if (!select.value) {
                e.preventDefault();
                // Visual feedback for error
                options.forEach(opt => {
                    opt.classList.add('border-red-300', 'bg-red-50');

                    // Remove error class after animation
                    setTimeout(() => {
                        opt.classList.remove('border-red-300', 'bg-red-50');
                    }, 1000);
                });

                // Show error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'mt-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Silakan pilih jenis cabang LKP terlebih dahulu.';

                // Remove previous error if exists
                const existingError = document.querySelector('.bg-red-100');
                if (existingError) {
                    existingError.remove();
                }

                this.insertBefore(errorDiv, this.querySelector('.flex.justify-center'));
            }
        });
    </script>
</body>

</html>