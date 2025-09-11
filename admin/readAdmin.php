<?php
session_start();
require_once __DIR__ . '/../config/functionAdmin.php';

// Jika tidak ada, artinya belum login, maka redirect ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: ../validasi.php");
    exit();
}

if ($_SESSION['user']['user'] != 'admin' && $_SESSION['user']['key'] != 'admin') {
    header("Location: ../validasi.php");
    exit();
}

// Parameter pencarian
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

// Ambil data dengan filter
$allData = readAdmin($searchTerm, $statusFilter);
$totalData = is_array($allData) ? count($allData) : 0;

// --- Pagination setup ---
$limit = 20; // data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$totalPages = max(1, (int)ceil($totalData / $limit));
if ($page > $totalPages) $page = $totalPages;

$offset = ($page - 1) * $limit;

// Potong data untuk halaman aktif
$datas = array_slice($allData, $offset, $limit);

// Penomoran baris
$no = $totalData ? $offset + 1 : 0;

// Nilai untuk info "Menampilkan X–Y dari Z"
$start = $totalData ? ($offset + 1) : 0;
$end = min($offset + $limit, $totalData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Satuan Pendidikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
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
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'bounce-subtle': 'bounceSubtle 0.6s ease-in-out'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(20px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        },
                        bounceSubtle: {
                            '0%, 20%, 50%, 80%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '40%': {
                                transform: 'translateY(-3px)'
                            },
                            '60%': {
                                transform: 'translateY(-1px)'
                            }
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    <!-- Header Section -->
    <div class="bg-white shadow-xl border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 p-3 rounded-xl shadow-lg">
                        <i class="fas fa-school text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Data Lembaga Pelatihan</h1>
                        <p class="text-gray-600 mt-1">Kelola informasi lembaga pelatihan dengan mudah</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="./form_npsn.php" class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Data</span>
                    </a>
                    <a href="../validasi.php" class="bg-transparent text-red-400 border-2 border-red-600 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                        <span>LogOut</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 animate-fade-in">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 p-3 rounded-xl">
                        <i class="fas fa-building text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Lembaga</p>
                        <p class="text-2xl font-bold text-gray-900"><?= count(readAdmin()) ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 animate-fade-in">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-3 rounded-xl">
                        <i class="fas fa-book text-white text-xl"></i>
                    </div>
                    <a href="./laporan.php">
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-gray-600 uppercase tracking-wide">Laporan Lembaga</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8 animate-slide-up">
            <form id="searchForm" method="GET" action="">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" id="searchInput" value="<?= htmlspecialchars($searchTerm) ?>" placeholder="Cari nama sekolah, NPSN, atau alamat..."
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <select name="status" id="statusFilter"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white">
                            <option value="">Semua Status</option>
                            <option value="PMA" <?= $statusFilter === 'PMA' ? 'selected' : '' ?>>PMA</option>
                            <option value="Non PMA" <?= $statusFilter === 'Non PMA' ? 'selected' : '' ?>>Non PMA</option>
                        </select>
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-3 rounded-xl font-semibold transition-colors duration-200 flex items-center">
                            <i class="fas fa-filter mr-2"></i> Terapkan
                        </button>
                        <?php if ($searchTerm || $statusFilter): ?>
                            <a href="?" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-3 rounded-xl font-semibold transition-colors duration-200 flex items-center">
                                <i class="fas fa-times mr-2"></i> Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-slide-up" style="animation-delay: 0.2s">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">NPSN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Lembaga Pelatihan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Foto Lembaga</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kecamatan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kelurahan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status Form</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        <?php if ($totalData > 0): ?>
                            <?php
                            $currentNo = $no; // Simpan nilai awal $no
                            foreach ($datas as $data): ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-200 searchable-row animate-fade-in" style="animation-delay: <?= $currentNo * 0.05 ?>s">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-primary-100 to-primary-200 rounded-full">
                                            <span class="text-sm font-semibold text-primary-700"><?= $currentNo ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="bg-gray-100 px-3 py-1 rounded-full">
                                                <span class="text-sm font-mono font-semibold text-gray-700"><?= htmlspecialchars($data['npsn']) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            <div class="text-sm font-semibold text-gray-900 mb-1"><?= htmlspecialchars($data['nama_satuan_pendidikan']) ?></div>
                                            <div class="text-xs text-gray-500">Lembaga Pelatihan</div>
                                        </div>
                                    </td>
                                    <!-- class="h-16 w-16 rounded-xl object-cover shadow-md border-2 border-gray-200 hover:shadow-lg transition-all duration-300 hover:scale-105" -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            <img src="<?= empty($data['foto_lembaga']) ? '../assets/img/image.png' : 'uploads/' . $data['foto_lembaga'] ?>"
                                                alt="Foto Lembaga"
                                                class="h-16 w-16 rounded-xl object-cover shadow-md border-2 border-gray-200 hover:shadow-lg transition-all duration-300 hover:scale-105">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            <div class="text-sm text-gray-900 leading-relaxed"><?= htmlspecialchars($data['alamat']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-900"><?= htmlspecialchars($data['kecamatan']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-building text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-900"><?= htmlspecialchars($data['kelurahan']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $statusClass = '';
                                        $statusIcon = '';
                                        $statusText = htmlspecialchars($data['status']);

                                        if (strtolower($data['status']) == 'pma') {
                                            // PMA → hijau
                                            $statusClass = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                            $statusIcon  = 'fas fa-check-circle text-emerald-500';
                                        } elseif (strtolower($data['status']) == 'non pma') {
                                            // Non PMA → oranye
                                            $statusClass = 'bg-orange-100 text-orange-800 border-orange-200';
                                            $statusIcon  = 'fas fa-exclamation-circle text-orange-500';
                                        } else {
                                            // fallback
                                            $statusClass = 'bg-gray-100 text-gray-800 border-gray-200';
                                            $statusIcon  = 'fas fa-question-circle text-gray-400';
                                        }
                                        ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border <?= $statusClass ?>">
                                            <i class="<?= $statusIcon ?> mr-1"></i>
                                            <?= $statusText ?>
                                        </span>

                                    </td>
                                    <?php
                                    $bgColor = ($data['status_pengisian_lkp'] == 'sudah mengisi') ? 'text-green-500' : 'text-red-500';
                                    ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="<?= $bgColor; ?>"><?= $data['status_pengisian_lkp']; ?></p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">

                                            <!-- Tombol Edit -->
                                            <div class="relative group">
                                                <a href="edit.php?id=<?= $data['id'] ?>"
                                                    class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center space-x-1">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <span class="absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-1 text-xs font-medium text-primary-800 bg-primary-200 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    Edit
                                                </span>
                                            </div>

                                            <!-- Tombol Delete -->
                                            <div class="relative group">
                                                <button onclick="openModal()"
                                                    class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <span class="absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-1 text-xs font-medium text-red-800 bg-red-200 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    Delete
                                                </span>
                                            </div>

                                            <!-- Modal -->
                                            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                                <div class="bg-white rounded-xl shadow-2xl w-full max-w-md relative overflow-hidden">

                                                    <!-- Header -->
                                                    <div class="flex justify-between items-center border-b px-6 py-4">
                                                        <h2 class="text-lg font-semibold text-red-600">Informasi Data Lembaga Pelatihan</h2>
                                                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
                                                    </div>

                                                    <!-- Body -->
                                                    <div class="px-6 py-5">
                                                        <p class="text-gray-700 text-sm md:text-base text-justify leading-relaxed">
                                                            Data <span class="font-semibold">Lembaga Pelatihan</span> ini berisi informasi resmi
                                                            <strong>NPSN</strong> <br> dan <strong>LKP</strong>.
                                                            Sesuai aturan dari <span class="font-medium">Sudin/Dinas Pendidikan</span>, <br>
                                                            <span class="text-red-500 font-semibold">data ini tidak dapat dihapus</span>
                                                        </p>

                                                    </div>

                                                </div>
                                            </div>

                                            <script>
                                                function openModal() {
                                                    document.getElementById("deleteModal").classList.remove("hidden");
                                                }

                                                function closeModal() {
                                                    document.getElementById("deleteModal").classList.add("hidden");
                                                }
                                            </script>


                                        </div>

                                    </td>
                                </tr>
                                <?php $currentNo++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fas fa-search fa-3x mb-4 opacity-50"></i>
                                        <p class="text-lg font-semibold">Tidak ada data yang ditemukan</p>
                                        <p class="mt-1">Coba ubah kata kunci pencarian atau filter status</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="mt-8 flex items-center justify-between animate-fade-in" style="animation-delay: 0.4s">
                <div class="flex items-center text-sm text-gray-700">
                    <span>
                        Menampilkan <span class="font-semibold"><?= $start ?></span>
                        hingga <span class="font-semibold"><?= $end ?></span>
                        dari <span class="font-semibold"><?= $totalData ?></span> hasil
                    </span>
                </div>

                <div class="flex items-center space-x-2">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($searchTerm) ?>&status=<?= urlencode($statusFilter) ?>"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-left mr-1"></i> Previous
                        </a>
                    <?php else: ?>
                        <span class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left mr-1"></i> Previous
                        </span>
                    <?php endif; ?>

                    <?php
                    // batasi jumlah link halaman yang ditampilkan
                    $maxLinks  = 5;
                    $startPage = max(1, $page - 2);
                    $endPage   = min($totalPages, $startPage + $maxLinks - 1);
                    if ($endPage - $startPage + 1 < $maxLinks) {
                        $startPage = max(1, $endPage - $maxLinks + 1);
                    }
                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?page=<?= $i ?>&search=<?= urlencode($searchTerm) ?>&status=<?= urlencode($statusFilter) ?>"
                            class="px-4 py-2 <?= $i == $page ? 'bg-primary-500 text-white shadow-md' : 'border border-gray-300 text-gray-700 hover:bg-gray-50' ?> rounded-lg text-sm font-semibold">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($searchTerm) ?>&status=<?= urlencode($statusFilter) ?>"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            Next <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    <?php else: ?>
                        <span class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-400 cursor-not-allowed">
                            Next <i class="fas fa-chevron-right ml-1"></i>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover animations to stats cards
            const statsCards = document.querySelectorAll('.grid > div');
            statsCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>