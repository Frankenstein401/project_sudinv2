<?php
// Mengambil data dari database
require_once 'config/conn.php';

// Query untuk menghitung jumlah LKP
$query = "SELECT COUNT(*) as total_lkp FROM table_lembaga";
$result = $conn->query($query);
$total_lkp = 0;

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_lkp = $row['total_lkp'];
}

// Tambahkan suffix otomatis
$suffix = "+";
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Pendataan & Visitasi LKP - Jakarta Utara</title>
    <meta name="description" content="Portal resmi Suku Dinas Pendidikan Kota Administrasi Jakarta Utara untuk validasi NPSN dan monitoring LKP">
    <meta name="keywords" content="LKP, NPSN, Jakarta Utara, Pendidikan, Validasi, PMA, Non PMA">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

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

<body class="index-page">

    <!-- <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">LKP<span>Portal</span></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.html" class="active">Beranda</a></li>
                    <li><a href="https://disdik.jakarta.go.id/tentangkami/profil">Tentang</a></li>
                    <li class="dropdown"><a href="#"><span>Layanan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="../project_sudin/validasi.php">Validasi NPSN</a></li>
                            <li><a href="https://disdik.jakarta.go.id/tentangkami/laporan?size=12&page=0">Laporan</a></li>
                        </ul>
                    </li>
                    <li><a href="404.html">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="../project_sudin/validasi.php">Mulai Pendataan</a>

        </div>
    </header> -->

    <!-- Header Navigasi -->
    <header id="header" class="bg-transparent border-b border-transparent fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">

            <!-- Logo -->
            <a href="index.html" class="flex items-center space-x-2">
                <h1 class="text-2xl font-bold text-primary-600">LKP<span class="text-dark-900">Portal</span></h1>
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-6 text-dark-700 font-medium">
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

            <!-- Button Get Started -->
            <a href="../project_sudin/validasi.php"
                class="ml-4 bg-primary-600 text-white px-3 py-1 rounded-lg shadow hover:bg-primary-700 transition">
                Mulai Pendataan
            </a>

            <!-- Mobile nav toggle -->
            <button class="mobile-nav-toggle md:hidden text-dark-700">
                <i class="bi bi-list text-2xl"></i>
            </button>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="hero-image" data-aos="fade-right" data-aos-delay="100">
                            <img src="assets/img/galery/image4.png" alt="Gedung Pemerintahan Jakarta Utara" class="img-fluid main-image" style="width: 700px; height: 400px;">
                            <div class="floating-card emergency-card" data-aos="fade-up" data-aos-delay="300">
                                <div class="card-content">
                                    <i class="bi bi-telephone-fill"></i>
                                    <div class="text">
                                        <span class="label">Hotline Bantuan</span>
                                        <span class="number">(021) 5255385</span>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-card stats-card" data-aos="fade-up" data-aos-delay="400">
                                <div class="stat-item">
                                    <span class="number">
                                        <span class="purecounter"
                                            data-purecounter-start="0"
                                            data-purecounter-end="<?php echo $total_lkp; ?>"
                                            data-purecounter-duration="2">0</span><?php echo $suffix; ?>
                                    </span>
                                    <span class="label">LKP Terdaftar</span>
                                </div>



                                <div class="stat-item">
                                    <span class="number">90%</span>
                                    <span class="label">Data Tervalidasi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="hero-content" data-aos="fade-left" data-aos-delay="200">
                            <div class="badge-container">
                                <span class="hero-badge">Portal Resmi Sudin Pendidikan</span>
                            </div>

                            <h1 class="hero-title">Sistem Pendataan & Visitasi LKP Jakarta Utara</h1>
                            <p class="hero-description">Portal resmi Suku Dinas Pendidikan Kota Administrasi Jakarta Utara untuk validasi NPSN, pengisian instrumen, dan monitoring Lembaga Kursus & Pelatihan (LKP) secara digital dan terintegrasi.</p>

                            <div class="hero-stats">
                                <div class="stat-group">
                                    <a href="npsn.php" class="stat">
                                        <i class="bi bi-building"></i>
                                        <div class="stat-text">
                                            <span class="number">
                                                <span class="purecounter"
                                                    data-purecounter-start="0"
                                                    data-purecounter-end="<?php echo $total_lkp; ?>"
                                                    data-purecounter-duration="2">0</span><?php echo $suffix; ?>
                                            </span>
                                            <span class="label">LKP Terdaftar</span>
                                        </div>
                                    </a>
                                    <div class="stat">
                                        <i class="bi bi-check-circle"></i>
                                        <div class="stat-text">
                                            <span class="number">90%</span>
                                            <span class="label">Tingkat Validasi</span>
                                        </div>
                                    </div>
                                    <div class="stat">
                                        <i class="bi bi-graph-up"></i>
                                        <div class="stat-text">
                                            <span class="number">24/7</span>
                                            <span class="label">Akses Online</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cta-section">
                                <div class="cta-buttons">
                                    <a href="./validasi.php" class="btn btn-primary">Mulai Pendataan</a>
                                    <a href="https://youtu.be/xvFZjo5PgG0?si=lPpflBPwE-8cf_fQ" class="btn btn-secondary glightbox">
                                        <i class="bi bi-play-circle"></i>
                                        Panduan Penggunaan
                                    </a>
                                </div>

                                <div class="quick-actions">
                                    <a href="./validasi.php" class="action-link">
                                        <i class="bi bi-shield-check"></i>
                                        <span>Validasi NPSN</span>
                                    </a>
                                    <a href="dashboard.html" class="action-link">
                                        <i class="bi bi-graph-up"></i>
                                        <span>Dashboard Monitoring</span>
                                    </a>
                                    <a href="contact.html" class="action-link">
                                        <i class="bi bi-telephone"></i>
                                        <span>Bantuan Teknis</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="background-elements">
                <div class="bg-shape shape-1"></div>
                <div class="bg-shape shape-2"></div>
                <div class="bg-pattern"></div>
            </div>
        </section><!-- /Hero Section -->

        <!-- About System Section -->
        <section id="home-about" class="home-about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="150">
                        <h2 class="section-heading">Tentang Sistem Pendataan & Visitasi LKP</h2>
                        <p class="lead-description">Platform digital terintegrasi untuk memfasilitasi validasi NPSN, pengisian instrumen visitasi, dan monitoring komprehensif Lembaga Kursus & Pelatihan di Jakarta Utara.</p>
                    </div>
                </div>

                <div class="row align-items-center gy-5">
                    <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
                        <div class="image-grid">
                            <div class="primary-image">
                                <img src="assets/img/galery/image1.png" alt="Gedung Suku Dinas Pendidikan" class="img-fluid">
                                <div class="certification-badge">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Portal Resmi</span>
                                </div>
                            </div>
                            <div class="secondary-images">
                                <div class="small-image">
                                    <img src="assets/img/galery/image2.png" alt="Proses Validasi" class="img-fluid">
                                </div>
                                <div class="small-image">
                                    <img src="assets/img/galery/image3.png" alt="Monitoring Dashboard" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="300">
                        <div class="content-wrapper">
                            <div class="highlight-box">
                                <div class="highlight-icon">
                                    <i class="bi bi-clipboard-check-fill"></i>
                                </div>
                                <div class="highlight-content">
                                    <h4>Validasi NPSN Terpusat</h4>
                                    <p>Setiap LKP wajib melakukan validasi NPSN melalui sistem ini sebelum mengakses form instrumen visitasi.</p>
                                </div>
                            </div>

                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Validasi NPSN otomatis dan real-time</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Form instrumen PMA & Non PMA terpisah</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Dashboard monitoring terintegrasi</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Laporan dan analisis data komprehensif</div>
                                </div>
                            </div>

                            <div class="metrics-row">
                                <div class="metric-box">
                                    <div class="metric-number">
                                        <span class="purecounter" data-purecounter-start="0"
                                            data-purecounter-end="<?php echo $total_lkp; ?>"
                                            data-purecounter-duration="2">0</span><?php echo $suffix; ?>
                                    </div>
                                    <div class="metric-label">LKP Terdaftar</div>
                                </div>
                                <div class="metric-box">
                                    <div class="metric-number">
                                        <span class="purecounter" data-purecounter-start="0" data-purecounter-end="90" data-purecounter-duration="0">90</span>%
                                    </div>
                                    <div class="metric-label">Tingkat Validasi</div>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="../project_sudin/validasi.php" class="btn-explore">Mulai Validasi NPSN</a>
                                <a href="contact.html" class="btn-contact">
                                    <i class="bi bi-telephone"></i>
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About System Section -->

        <!-- Process Flow Section -->
        <section id="featured-departments" class="featured-departments section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Alur Penggunaan Sistem</h2>
                <p>Ikuti 4 langkah mudah untuk melakukan pendataan dan visitasi LKP secara online</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="departments-showcase">

                    <div class="featured-department" data-aos="fade-up" data-aos-delay="200">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-1">
                                <div class="department-content">
                                    <div class="department-category">Langkah 1</div>
                                    <h2 class="department-title">Akses Portal LKP</h2>
                                    <p class="department-description">Buka halaman utama Sistem Pendataan & Visitasi LKP Jakarta Utara. Pastikan Anda memiliki koneksi internet yang stabil dan data NPSN lembaga yang valid untuk memulai proses pendataan.</p>
                                    <div class="department-features">
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Akses 24/7 Online</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Interface User-Friendly</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Panduan Penggunaan Lengkap</span>
                                        </div>
                                    </div>
                                    <a href="index.html" class="cta-link">Kembali ke Beranda <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-2">
                                <div class="department-visual">
                                    <div class="image-wrapper">
                                        <img src="assets/img/form.png" alt="Portal Landing Page" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="departments-grid">
                        <div class="row">
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Validasi NPSN</h3>
                                        <p class="card-description">Masukkan nomor NPSN lembaga Anda untuk verifikasi dan validasi data. Sistem akan mengecek keabsahan NPSN secara otomatis.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">2</span>
                                                <span class="stat-label">Langkah</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">Real-time</span>
                                                <span class="stat-label">Validasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-route"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Pilih Jenis Investasi</h3>
                                        <p class="card-description">Setelah NPSN tervalidasi, pilih kategori investasi lembaga: PMA (Penanaman Modal Asing) atau Non PMA sesuai status lembaga.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">3</span>
                                                <span class="stat-label">Langkah</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">2</span>
                                                <span class="stat-label">Pilihan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Isi Form & Submit</h3>
                                        <p class="card-description">Lengkapi form instrumen visitasi sesuai jenis investasi yang dipilih. Data akan masuk ke dashboard monitoring Sudin Pendidikan.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">4</span>
                                                <span class="stat-label">Langkah</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">Auto</span>
                                                <span class="stat-label">Dashboard</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="departments-cta" data-aos="fade-up" data-aos-delay="600">
                        <div class="cta-content">
                            <h3 class="cta-title">Siap Memulai Pendataan LKP?</h3>
                            <p class="cta-description">Pastikan data NPSN lembaga Anda sudah siap dan ikuti alur pendataan sesuai panduan yang tersedia.</p>
                            <a href="../project_sudin/validasi.php" class="btn btn-primary">Mulai Validasi NPSN</a>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Process Flow Section -->

        <!-- About Sudin Section -->
        <section id="find-a-doctor" class="find-a-doctor section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Suku Dinas Pendidikan</h2>
                <p>Suku Dinas Pendidikan Kota Administrasi Jakarta Utara sebagai penyelenggara sistem ini</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-10">
                        <div class="search-header">
                            <h2>Profil Suku Dinas Pendidikan Jakarta Utara</h2>
                            <p>Suku Dinas Pendidikan Kota Administrasi dipimpin oleh seorang Kepala Suku Dinas Pendidikan yang berkedudukan di bawah dan bertanggung jawab kepada Walikota Administrasi melalui Sekretaris Kota Administrasi.</p>
                        </div>

                        <div class="advanced-search-container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="content-wrapper">
                                        <h4>Tugas Pokok</h4>
                                        <p>Suku Dinas Pendidikan mempunyai tugas melaksanakan sebagian urusan pemerintahan daerah di bidang pendidikan, pembinaan, pengawasan, dan pengendalian kegiatan pendidikan di wilayah kota administrasi.</p>

                                        <h4>Fungsi</h4>
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-primary"></i> Pembinaan dan pengawasan penyelenggaraan pendidikan</li>
                                            <li><i class="bi bi-check-circle text-primary"></i> Pengendalian mutu dan evaluasi pendidikan</li>
                                            <li><i class="bi bi-check-circle text-primary"></i> Fasilitasi akreditasi lembaga pendidikan</li>
                                            <li><i class="bi bi-check-circle text-primary"></i> Monitoring dan evaluasi kinerja LKP</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="content-wrapper">
                                        <h4>Wilayah Kerja</h4>
                                        <p>Meliputi seluruh wilayah Kota Administrasi Jakarta Utara dengan fokus pembinaan dan pengawasan Lembaga Kursus & Pelatihan (LKP) yang tersebar di 6 kecamatan.</p>

                                        <h4>Komitmen Pelayanan</h4>
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-star-fill text-warning"></i> Transparansi dalam pengelolaan data</li>
                                            <li><i class="bi bi-star-fill text-warning"></i> Pelayanan prima berbasis teknologi</li>
                                            <li><i class="bi bi-star-fill text-warning"></i> Responsif terhadap kebutuhan LKP</li>
                                            <li><i class="bi bi-star-fill text-warning"></i> Peningkatan kualitas pendidikan berkelanjutan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
                    <a href="about.html" class="view-all-link">
                        Pelajari Lebih Lanjut Tentang Kami
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

            </div>

        </section><!-- /About Sudin Section -->

        <!-- Contact & Location Section -->
        <section id="call-to-action" class="call-to-action section light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="content-wrapper">
                                <h2>Hubungi Kami untuk Bantuan Lebih Lanjut</h2>
                                <p>Tim kami siap membantu Anda dalam proses pendataan LKP. Jangan ragu untuk menghubungi kami melalui berbagai channel komunikasi yang tersedia.</p>

                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <div>
                                            <strong>Alamat:</strong><br>
                                            Jln. Jendral Gatot Subroto, Kav. 40-41<br>
                                            Jakarta Selatan 12190
                                        </div>
                                    </div>

                                    <div class="contact-item">
                                        <i class="bi bi-envelope-fill"></i>
                                        <div>
                                            <strong>Email:</strong><br>
                                            disdik@jakarta.go.id
                                        </div>
                                    </div>

                                    <div class="contact-item">
                                        <i class="bi bi-telephone-fill"></i>
                                        <div>
                                            <strong>Hotline:</strong><br>
                                            (021) 5255385
                                        </div>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <a href="contact.html" class="primary-btn">Hubungi Kami</a>
                                    <a href="../project_sudin/validasi.php" class="secondary-link">
                                        <span>Mulai Pendataan</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-image" data-aos="zoom-in" data-aos-delay="300">
                                <!-- Google Maps Embed -->
                                <div class="map-container">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666!2d106.8317!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bce8!2sJl.%20Jend.%20Gatot%20Subroto%2C%20Jakarta%20Selatan!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
                                        width="100%"
                                        height="400"
                                        style="border:0; border-radius: 15px;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stats-section" data-aos="fade-up" data-aos-delay="400">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <span class="stat-number">
                                    <span class="purecounter"
                                        data-purecounter-start="0"
                                        data-purecounter-end="<?php echo $total_lkp; ?>"
                                        data-purecounter-duration="2">0</span><?php echo $suffix; ?><br>
                                </span>
                                <span class="stat-label">LKP Terdaftar</span>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">90%</div>
                                <div class="stat-label">Data Tervalidasi</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">6</div>
                                <div class="stat-label">Kecamatan</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Akses Online</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Contact & Location Section -->

    </main>

    <footer id="footer" class="footer position-relative text-lg md:text-xl leading-relaxed">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center text-2xl font-bold">
                        <span class="sitename">LKPPortal</span>
                    </a>
                    <div class="footer-contact pt-3 text-base md:text-lg">
                        <p>Jln. Jendral Gatot Subroto, Kav. 40-41</p>
                        <p>Jakarta Selatan 12190</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>(021) 5255385</span></p>
                        <p><strong>Email:</strong> <span>disdik@jakarta.go.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4 space-x-3 text-2xl">
                        <a href="https://x.com/disdik_dki?lang=en"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://www.facebook.com/disdikdkijakarta?mibextid=wwXIfr"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/disdikdki/?hl=en"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@dinaspendidikanprovinsidki6085"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="text-xl font-semibold mb-2">Menu Utama</h4>
                    <ul class="space-y-2 text-lg">
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="https://disdik.jakarta.go.id/tentangkami/profil">Tentang</a></li>
                        <li><a href="#footer">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="text-xl font-semibold mb-2">Layanan</h4>
                    <ul class="space-y-2 text-lg">
                        <li><a href="../project_sudin/validasi.php">Validasi NPSN</a></li>
                        <li><a href="../project_sudin/validasi.php">Form PMA</a></li>
                        <li><a href="../project_sudin/validasi.php">Form Non PMA</a></li>
                        <li><a href="https://disdik.jakarta.go.id/tentangkami/laporan?size=12&page=0">Laporan</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4 text-base md:text-lg">
            <p>© <span>2025 Sistem Pendataan & Visitasi LKP</span> –
                <strong>Suku Dinas Pendidikan Kota Administrasi Jakarta Utara</strong>.
                Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>



    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

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


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>