<?php
require_once __DIR__ . '/config/auth.php';
// session_start();

if (isset($_POST['btn'])) {
    validateNPSN();
}
?>

<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Suku Dinas | Portal Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <script src="https://cdn.tailwindcss.com?plugins=forms,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        }
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }

        .dark body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .dark .glass-card {
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .floating-circle {
            filter: blur(60px);
            opacity: 0.6;
        }
    </style>
</head>

<body class="light transition-colors duration-300">

    <!-- Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full bg-blue-300 floating-circle animate-float"></div>
        <div class="absolute top-1/3 right-1/4 w-80 h-80 rounded-full bg-purple-300 floating-circle animate-float"></div>
        <div class="absolute bottom-1/4 right-1/3 w-72 h-72 rounded-full bg-cyan-300 floating-circle animate-float"></div>
    </div>

    <!-- Container -->
    <div class="relative min-h-screen flex items-center justify-center px-4 py-12 z-10">
        <div class="w-full max-w-md glass-card rounded-2xl overflow-hidden shadow-xl animate-fade-in">

            <!-- Header -->
            <div class="relative bg-gradient-to-r from-primary-800 to-primary-600 py-10 px-6 text-center">
                <!-- Logo -->
                <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 bg-white dark:bg-dark-900 p-3 z-20 rounded-full shadow-lg border border-gray-200 dark:border-dark-700">
                    <img src="assets/images/favicon.png" alt="Logo" class="w-12 h-12 object-contain">
                </div>

                <!-- Title -->
                <h1 class="mt-8 text-2xl md:text-3xl font-bold text-white tracking-wide">
                    PORTAL SUKU DINAS
                </h1>

                <!-- Subtitle -->
                <p class="mt-2 text-sm md:text-base text-primary-100">
                    Sistem Informasi Terpadu
                </p>
            </div>


            <!-- Form -->
            <div class="px-8 py-8">

                <!-- Error message -->


                <form id="loginForm" class="space-y-5" action="" method="post">
                    <!-- Nama Lembaga -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lembaga</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-user"></i>
                            </div>
                            <input id="username" type="text" placeholder="Nama lembaga..."
                                name="nama_lembaga"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border bg-white dark:bg-dark-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-500"
                                required>
                        </div>
                    </div>

                    <!-- NPSN -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">NPSN</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input id="password" type="password" placeholder="••••••••"
                                name="npsn"
                                class="w-full pl-10 pr-10 py-3 rounded-lg border bg-white dark:bg-dark-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-500"
                                required minlength="8">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="togglePassword">
                                <i class="fas fa-eye text-gray-400 hover:text-primary-500" id="eyeIcon"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" id="loginButton" name="btn"
                        class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 rounded-lg text-white font-semibold shadow-md flex items-center justify-center">
                        <span id="buttonText">Masuk dengan NPSN</span>
                        <i class="fas fa-spinner fa-spin ml-2 hidden" id="loadingIcon"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-12 py-6 bg-white border-t border-secondary-100">
        <div class="container mx-auto px-4 text-center">
            <p class="text-secondary-600 text-sm">&copy; <?= date('Y'); ?> <span>2025 Sistem Pendataan & Visitasi LKP</span> – 
            <strong>Suku Dinas Pendidikan Kota Administrasi Jakarta Utara</strong>. 
            Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        const loginForm = document.getElementById('loginForm');
        const buttonText = document.getElementById('buttonText');
        const loadingIcon = document.getElementById('loadingIcon');

        // Toggle password
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });

        // Show loading saat submit
        loginForm.addEventListener('submit', () => {
            buttonText.textContent = 'Memverifikasi...';
            loadingIcon.classList.remove('hidden');
        });
    </script>

    <script>
        const notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'right',
                y: 'top'
            }
        });
    </script>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            notyf.success("<?= $_SESSION['success']; ?>");
            setTimeout(() => {
                window.location.href = "pilih_jenis.php";
            }, 1800);
        </script>
    <?php unset($_SESSION['success']);
    endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <script>
            notyf.error("<?= $_SESSION['error']; ?>");
        </script>
    <?php unset($_SESSION['error']);
    endif; ?>


</body>

</html>