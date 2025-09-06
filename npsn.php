<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lembaga Pendidikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
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
</head>

<body class="bg-gradient-to-br from-primary-50 via-white to-primary-100 min-h-screen">
    <?php
    require_once __DIR__ . '/config/functions.php';

    // Ambil data
    $datas = readNPSN();

    // Jika pencarian
    if (isset($_POST['searchbtn'])) {
        $keyword = $_POST['search'];
        $datas = searchNPSN($keyword);
    }

    // --- Pagination ---
    $limit = 20;
    $total_data = count($datas);
    $total_pages = ceil($total_data / $limit);

    // Halaman aktif (default = 1)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    if ($page > $total_pages) $page = $total_pages;

    // Hitung offset
    $offset = ($page - 1) * $limit;

    // Potong array
    $datas_page = array_slice($datas, $offset, $limit);

    ?>


    <!-- Header Navigasi -->
    <header id="header" class="bg-transparent border-b border-transparent fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">

            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-2">
                <h1 class="text-2xl font-bold text-primary-600">LKP<span class="text-dark-900">Portal</span></h1>
            </a>

            <!-- Navigation (Desktop) -->
            <nav id="navmenu" class="hidden md:flex space-x-6 text-dark-700 font-medium">
                <a href="index.php" class="hover:text-primary-600 transition">Beranda</a>
                <a href="https://disdik.jakarta.go.id/tentangkami/profil" class="hover:text-primary-600 transition">Tentang</a>
                <div class="relative group">
                    <button class="flex items-center space-x-1 hover:text-primary-600 transition">
                        <span>Layanan</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <!-- Dropdown -->
                    <ul class="absolute left-0 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden group-hover:block">
                        <li><a href="../project_sudin/validasi.php" class="block px-4 py-2 hover:bg-primary-50">Validasi NPSN</a></li>
                        <li><a href="https://disdik.jakarta.go.id/tentangkami/laporan?size=12&page=0" class="block px-4 py-2 hover:bg-primary-50">Laporan</a></li>
                    </ul>
                </div>
                <a href="404.html" class="hover:text-primary-600 transition">Kontak</a>
            </nav>

            <!-- Mobile nav toggle -->
            <button class="mobile-nav-toggle md:hidden text-dark-700">
                <i class="bi bi-list text-2xl"></i>
            </button>

        </div>

        <!-- Navigation (Mobile) -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 shadow-lg">
            <nav class="flex flex-col space-y-2 p-4 text-dark-700 font-medium">
                <a href="index.php" class="hover:text-primary-600 transition">Beranda</a>
                <a href="https://disdik.jakarta.go.id/tentangkami/profil" class="hover:text-primary-600 transition">Tentang</a>
                <details class="group">
                    <summary class="cursor-pointer flex items-center justify-between hover:text-primary-600">
                        <span>Layanan</span>
                        <i class="bi bi-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <div class="ml-4 mt-2 flex flex-col space-y-2">
                        <a href="../project_sudin/validasi.php" class="hover:text-primary-600">Validasi NPSN</a>
                        <a href="https://disdik.jakarta.go.id/tentangkami/laporan?size=12&page=0" class="hover:text-primary-600">Laporan</a>
                    </div>
                </details>
                <a href="404.html" class="hover:text-primary-600 transition">Kontak</a>
            </nav>
        </div>
    </header>


    <!-- Header Informasi Halaman -->
    <header class="bg-white border-b border-primary-100 mt-20">
        <div class="container mx-auto px-1 py-6">
            <div class="flex items-center justify-between">

                <!-- Judul -->
                <div class="flex items-center space-x-4">
                    <div>
                        <h1 class="text-2xl font-bold text-dark-900">Data Lembaga Pendidikan</h1>
                        <p class="text-dark-700 text-sm">Sistem Informasi Satuan Pendidikan</p>
                    </div>
                </div>

                <!-- Info jumlah lembaga -->
                <div class="hidden md:flex items-center space-x-2 bg-primary-50 px-4 py-2 rounded-full">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-primary-700 font-semibold"><?= count($datas); ?> Lembaga</span>
                    <div class="bg-trasparent p-2">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0v-4a2 2 0 012-2h4a2 2 0 012 2v4">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Search Bar -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl border border-primary-100 p-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-dark-900">Pencarian Lembaga</h2>
                </div>

                <form action="" method="post" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input type="search"
                            name="search"
                            placeholder="Cari berdasarkan NPSN atau Nama Lembaga..."
                            value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>"
                            class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all duration-300 bg-gray-50 focus:bg-white text-dark-900 text-lg">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <div class="flex gap-2">
                        <button name="searchbtn"
                            type="submit"
                            class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Cari</span>
                        </button>
                        <?php if (isset($_POST['searchbtn'])): ?>
                            <a href="<?= $_SERVER['PHP_SELF']; ?>"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span>Reset</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Info -->
        <?php if (isset($_POST['searchbtn']) && !empty($_POST['search'])): ?>
            <div class="mb-6 p-4 bg-primary-50 border-l-4 border-primary-500 rounded-r-lg">
                <p class="text-primary-700">
                    <span class="font-semibold"><?= count($datas); ?> hasil</span> ditemukan untuk pencarian
                    "<span class="font-semibold"><?= htmlspecialchars($_POST['search']); ?></span>"
                </p>
            </div>
        <?php endif; ?>

        <!-- Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-4 xl:grid-cols-3 gap-6">
            <?php if (empty($datas_page)): ?>
                <div class="col-span-full">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-12 text-center">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.137 0-4.146.832-5.636 2.188M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-500 mb-2">Tidak ada data ditemukan</h3>
                        <p class="text-gray-400">Coba ubah kata kunci pencarian Anda</p>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($datas_page as $data) : ?>
                     <?php
                        // =============================================================
                        // LOGIKA PENGECEKAN STATUS DIPINDAH KE DALAM LOOP INI
                        // Variabel $data di sini adalah satu map/baris data (sudah benar)
                        // =============================================================
                        $bgColor = ($data['status_pengisian_lkp'] == 'sudah mengisi') ? 'bg-green-500' : 'bg-red-500';
                        ?>
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-primary-100 overflow-hidden group">
                        <!-- Image Section -->
                        <div class="relative overflow-hidden h-48 bg-primary-100 border-b-4 border-primary-500 flex items-center justify-center">
                            <img src="<?= empty($data['foto_lembaga']) ? 'assets\img\image.png' : 'admin/uploads/' . $data['foto_lembaga'] ?>"
                                alt="Foto Lembaga"
                                class="w-[180px] h-[180px] object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-4 right-4">
                                <span class="<?= $data['status'] === 'PMA' ? 'bg-green-500' : 'bg-orange-500'; ?> text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                    <?= $data['status']; ?>
                                </span>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-4">
                            <!-- NPSN Badge -->
                            <div class="mb-3">
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-lg text-sm font-semibold">
                                    NPSN: <?= $data['npsn']; ?>
                                </span>
                                <!-- <span class="<?= $data['status'] === 'PMA' ? 'bg-green-400' : 'bg-red-500'; ?> text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg mx-4">
                                    <?= $data['status']; ?>
                                </span> -->
                                <span class="<?= $bgColor; ?> text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg mx-4">
                                    <?= $data['status_pengisian_lkp']; ?>
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-dark-900 mb-3 line-clamp-2">
                                <?= $data['nama_satuan_pendidikan']; ?>
                            </h3>

                            <!-- Details -->
                            <div class="space-y-3">
                                <!-- Address -->
                                <div class="flex items-start space-x-2">
                                    <svg class="w-5 h-5 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-dark-700 text-sm line-clamp-2"><?= $data['alamat']; ?></p>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0v-4a2 2 0 012-2h4a2 2 0 012 2v4"></path>
                                    </svg>
                                    <div class="text-dark-600 text-sm">
                                        <span class="font-medium"><?= $data['kecamatan']; ?></span>,
                                        <span><?= $data['kelurahan']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-6 pb-6">
                            <!-- <button class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                <span>Lihat Detail</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (count($datas_page) > 0 && !isset($_POST['searchbtn'])): ?>
            <div class="text-center mt-12">
                <p class="inline-block bg-primary-50 text-primary-700 px-6 py-1 rounded-full shadow-sm border border-primary-200 font-medium">
                    Menampilkan
                    <span class="font-semibold text-primary-800">
                        <?= $offset + 1; ?> - <?= min($offset + $limit, $total_data); ?>
                    </span>
                    dari
                    <span class="font-semibold text-primary-800">
                        <?= $total_data; ?>
                    </span>
                    lembaga pendidikan
                </p>
            </div>
        <?php endif; ?>


    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="flex justify-center mt-4 space-x-2">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i; ?>"
                    class="px-4 py-2 rounded-lg border 
                  <?= ($i == $page)
                        ? 'bg-primary-600 text-white border-primary-600'
                        : 'bg-white text-primary-600 border-gray-300 hover:bg-primary-50'; ?>">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>


    <!-- Footer -->
    <footer class="bg-dark-900 text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-300">© 2025 Sistem Informasi Lembaga Pendidikan. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const toggleBtn = document.querySelector('.mobile-nav-toggle');
        const mobileMenu = document.getElementById('mobileMenu');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>


    <script>
        // Smooth scroll animation for cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Apply animation to cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.grid > div');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
                observer.observe(card);
            });
        });

        // Auto-focus search input
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput && !searchInput.value) {
                setTimeout(() => searchInput.focus(), 500);
            }
        });
    </script>

    <script>
        const header = document.getElementById("header");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                header.classList.add("bg-white", "shadow", "border-primary-100");
                header.classList.remove("bg-transparent", "border-transparent");
            } else {
                header.classList.add("bg-transparent", "border-transparent");
                header.classList.remove("bg-white", "shadow", "border-primary-100");
            }
        });
    </script>
</body>

</html>