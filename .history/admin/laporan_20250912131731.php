<?php
require_once __DIR__ . '/../config/functionDetail.php';

// Get query parameters
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10; // Rows per page

// Initialize arrays
$pmacols = [];
$nonpmacols = [];

// Fetch data based on status filter
if ($status == 'all' || $status == 'PMA') {
    $pmacols = readAdminPma($search, $page, $limit);
}
if ($status == 'all' || $status == 'Non PMA') {
    $nonpmacols = readAdminNonPma($search, $page, $limit);
}

// Calculate total rows for pagination
$totalPma = ($status == 'all' || $status == 'PMA') ? (readAdminPma($search, 1, 0)['total'] ?? 0) : 0;
$totalNonPma = ($status == 'all' || $status == 'Non PMA') ? (readAdminNonPma($search, 1, 0)['total'] ?? 0) : 0;
$totalRows = $totalPma + $totalNonPma;
$totalPages = ceil($totalRows / $limit);

$no = ($page - 1) * $limit + 1; // Starting number for current page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lembaga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        },
                        pulseSoft: {
                            '0%, 100%': {
                                opacity: '1'
                            },
                            '50%': {
                                opacity: '0.75'
                            },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-secondary-50 min-h-screen flex items-start justify-center p-4">
    <div class="w-full max-w-7xl mx-auto px-4">
        <a href="./readAdmin.php"
            class="bg-transparent text-red-400 border-2 border-red-600 px-6 py-3 rounded-xl font-semibold shadow-lg 
          hover:shadow-xl hover:bg-red-400 hover:text-white transform hover:scale-105 transition-all duration-200 
          flex items-center justify-center space-x-2 w-[150px]">
            <span>Kembali</span>
        </a>

        <h1 class="text-2xl font-bold text-info-800 mb-6 text-center animate-fade-in">Laporan Pendataan LKP</h1>

        <!-- Search and Filter Form -->
        <form method="GET" class="mb-6 flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari Nama Lembaga..."
                    class="w-full px-4 py-2 border border-secondary-300 rounded-lg text-secondary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div>
                <select name="status"
                    class="w-full sm:w-48 px-4 py-2 border border-secondary-300 rounded-lg text-secondary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="all" <?= $status == 'all' ? 'selected' : '' ?>>Semua</option>
                    <option value="PMA" <?= $status == 'PMA' ? 'selected' : '' ?>>PMA</option>
                    <option value="Non PMA" <?= $status == 'Non PMA' ? 'selected' : '' ?>>Non PMA</option>
                </select>
            </div>
            <div>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2 bg-info-500 text-white rounded-lg hover:bg-primary-600 shadow-md flex items-center justify-center space-x-2">
                    <i class="fas fa-search"></i>
                    <span>Cari</span>
                </button>
            </div>
        </form>

        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="w-full bg-white border border-secondary-200 rounded-lg">
                <thead>
                    <tr class="bg-info-600 text-white">
                        <th class="py-3 px-4 text-left text-sm font-semibold">ID</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Nama Lembaga</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Status Lembaga</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Status Pengisian LKP</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Dibuat Pada</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pmacols['data'] ?? $pmacols) && empty($nonpmacols['data'] ?? $nonpmacols)): ?>
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-secondary-500">
                                <?php
                                $message = 'Tidak ada data ditemukan';
                                if ($search) {
                                    $message .= ' untuk pencarian "' . htmlspecialchars($search) . '"';
                                }
                                if ($status != 'all') {
                                    $message .= ' dengan status "' . htmlspecialchars($status) . '"';
                                }
                                echo $message;
                                ?>
                                <br>
                                <i class="fa-solid fa-magnifying-glass text-[3em]"></i>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php
                        // Handle both old and new format (with or without 'data' key)
                        $pmaData = isset($pmacols['data']) ? $pmacols['data'] : $pmacols;
                        $nonPmaData = isset($nonpmacols['data']) ? $nonpmacols['data'] : $nonpmacols;

                        foreach ($pmaData as $pmacol): ?>
                            <tr class="border-b border-secondary-200 hover:bg-primary-50 transition-colors animate-slide-up">
                                <td class="py-3 px-4 text-secondary-700"><?= $no++; ?></td>
                                <td class="py-3 px-4 text-secondary-700"><?= htmlspecialchars($pmacol['nama_satuan_pendidikan'] ?? 'Tidak ada') ?></td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-1 text-sm rounded-full <?= ($pmacol['status'] ?? '') == 'PMA' ? 'bg-success-100 text-success-800' : 'bg-warning-100 text-warning-800' ?>">
                                        <?= htmlspecialchars($pmacol['status'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-1 text-sm rounded-full <?= ($pmacol['status_pengisian_lkp'] ?? '') == 'Selesai' ? 'bg-success-100 text-success-800' : 'bg-info-100 text-info-800' ?>">
                                        <?= htmlspecialchars($pmacol['status_pengisian_lkp'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-secondary-700"><?= htmlspecialchars($pmacol['created_at'] ?? '-') ?></td>
                                <td class="py-3 px-4">
                                    <?php if (($pmacol['status'] ?? '') == 'PMA'): ?>
                                        <div class="relative group">
                                            <a href="detailpma.php?id=<?= $pmacol['id'] ?>"
                                                class="bg-gradient-to-r from-success-500 to-success-600 hover:from-success-600 hover:to-success-700 text-white px-2 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center space-x-1">
                                                <i class="fas fa-edit"></i>
                                                <span>Detail</span>
                                            </a>
                                            <span class="absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-1 text-xs font-medium text-success-800 bg-success-200 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Lihat Detail
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-secondary-400">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php foreach ($nonPmaData as $nonpmacol): ?>
                            <tr class="border-b border-secondary-200 hover:bg-primary-50 transition-colors animate-slide-up">
                                <td class="py-3 px-4 text-secondary-700"><?= $no++; ?></td>
                                <td class="py-3 px-4 text-secondary-700"><?= htmlspecialchars($nonpmacol['nama_satuan_pendidikan'] ?? 'Tidak ada') ?></td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-1 text-sm rounded-full <?= ($nonpmacol['status'] ?? '') == 'Non PMA' ? 'bg-warning-100 text-warning-800' : 'bg-warning-100 text-warning-800' ?>">
                                        <?= htmlspecialchars($nonpmacol['status'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-1 text-sm rounded-full <?= ($nonpmacol['status_pengisian_lkp'] ?? '') == 'sudah mengisi' ? 'bg-info-100 text-info-800' : 'bg-success-100 text-success-800' ?>">
                                        <?= htmlspecialchars($nonpmacol['status_pengisian_lkp'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-secondary-700"><?= htmlspecialchars($nonpmacol['created_at'] ?? '-') ?></td>
                                <td class="py-3 px-4">
                                    <?php if (($nonpmacol['status'] ?? '') == 'Non PMA'): ?>
                                        <div class="relative group">
                                            <a href="detailnonpma.php?id=<?= $nonpmacol['id'] ?>"
                                                class="bg-gradient-to-r from-success-500 to-success-600 hover:from-success-600 hover:to-success-700 text-white px-2 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center space-x-1">
                                                <i class="fas fa-edit"></i>
                                                <span>Detail</span>
                                            </a>
                                            <span class="absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-1 text-xs font-medium text-success-800 bg-success-200 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Lihat Detail
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-secondary-400">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <?php if ($totalPages > 1): ?>
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-secondary-700">
                    Menampilkan <?= ($page - 1) * $limit + 1 ?> - <?= min($page * $limit, $totalRows) ?> dari <?= $totalRows ?> data
                </div>
                <div class="flex space-x-2">
                    <a href="?q=<?= urlencode($search) ?>&status=<?= $status ?>&page=<?= max(1, $page - 1) ?>"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 disabled:bg-secondary-300 disabled:cursor-not-allowed"
                        <?= $page == 1 ? 'disabled' : '' ?>>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                        <a href="?q=<?= urlencode($search) ?>&status=<?= $status ?>&page=<?= $i ?>"
                            class="px-4 py-2 rounded-lg <?= $i == $page ? 'bg-primary-600 text-white' : 'bg-secondary-100 text-secondary-700 hover:bg-primary-100' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    <a href="?q=<?= urlencode($search) ?>&status=<?= $status ?>&page=<?= min($totalPages, $page + 1) ?>"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 disabled:bg-secondary-300 disabled:cursor-not-allowed"
                        <?= $page == $totalPages ? 'disabled' : '' ?>>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>