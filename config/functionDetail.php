<?php

require_once __DIR__ . '/conn.php';

function detailsAdmin($id)
{
    global $conn;

    // Hapus baris ini karena parameter $id sudah diterima
    // $id = $_GET['id'] ?? null;
    
    if (!$id) {
        die("ID tidak ditemukan!");
    }

    // Lakukan JOIN dengan table_lembaga untuk mendapatkan nama_satuan_pendidikan
    $sql = 'SELECT form_pma.*, table_lembaga.nama_satuan_pendidikan 
            FROM form_pma 
            INNER JOIN table_lembaga ON form_pma.id_table_lembaga = table_lembaga.id 
            WHERE form_pma.id_table_lembaga = ?';
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // daftar field non-atomic
    $fields = [
        'form_pendaftaran',
        'surat_tugas',
        'ktp_pemohon',
        'surat_rekomendasi',
        'sk_kemenhumkam',
        'nomor_induk_berusaha',
        'kepemilikan_tanah',
        'acuan_kurikulum',
        'kurikulum',
        'rpp',
        'pendekatan_pembelajaran',
        'nama',
        'jabatan',
        'kualifikasi_akademik',
        'sertifikat',
        'pengalaman_kerja',
        'bangunan',
        'ruangan',
        'alat',
        'bahan_ajar',
        'kepemilikan_gedung',
        'rancangan_pembiayaan',
        'sumber_pembiayaan',
        'sistem_sertifikasi',
        'orientasi_sertifikasi',
        'pengembangan_evaluasi',
        'struktur_organisasi',
        'sop',
        'peserta_didik',
        'kalender_pembelajaran',
        'jadwal_ruangan'
    ];

    $rows = []; // tempat simpan hasil query

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // kembalikan data query + daftar field
    return [
        'fields' => $fields,
        'data'   => $rows
    ];
}

function readAdminPma($search = '', $page = 1, $limit = 10)
{
    global $conn;

    $offset = ($page - 1) * $limit;
    
    // Build the base query
    $sql = "SELECT form_pma.*, table_lembaga.* FROM form_pma 
            INNER JOIN table_lembaga ON form_pma.id_table_lembaga = table_lembaga.id
            WHERE table_lembaga.status = 'PMA'";
    
    $countSql = "SELECT COUNT(*) as total FROM form_pma 
                 INNER JOIN table_lembaga ON form_pma.id_table_lembaga = table_lembaga.id
                 WHERE table_lembaga.status = 'PMA'";
    
    // Add search condition if provided
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $sql .= " AND table_lembaga.nama_satuan_pendidikan LIKE ?";
        $countSql .= " AND table_lembaga.nama_satuan_pendidikan LIKE ?";
    }
    
    // Add pagination if limit is not 0
    if ($limit > 0) {
        $sql .= " LIMIT ? OFFSET ?";
    }
    
    // Prepare and execute the count query
    $countStmt = $conn->prepare($countSql);
    if (!empty($search)) {
        $countStmt->bind_param("s", $searchTerm);
    }
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $total = $countResult->fetch_assoc()['total'];
    
    // If limit is 0, we only want the count
    if ($limit === 0) {
        return ['total' => $total];
    }
    
    // Prepare and execute the data query
    $stmt = $conn->prepare($sql);
    
    if (!empty($search)) {
        if ($limit > 0) {
            $stmt->bind_param("sii", $searchTerm, $limit, $offset);
        } else {
            $stmt->bind_param("s", $searchTerm);
        }
    } else {
        if ($limit > 0) {
            $stmt->bind_param("ii", $limit, $offset);
        }
    }
    
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return [
        'data' => $data,
        'total' => $total
    ];
}

function readAdminNonPma($search = '', $page = 1, $limit = 10) {
    global $conn;

    $offset = ($page - 1) * $limit;
    
    // Build the base query
    $sql = "SELECT form_non_pma.*, table_lembaga.* FROM form_non_pma 
            INNER JOIN table_lembaga ON form_non_pma.id_table_lembaga = table_lembaga.id
            WHERE table_lembaga.status = 'Non PMA'";
    
    $countSql = "SELECT COUNT(*) as total FROM form_non_pma 
                 INNER JOIN table_lembaga ON form_non_pma.id_table_lembaga = table_lembaga.id
                 WHERE table_lembaga.status = 'Non PMA'";
    
    // Add search condition if provided
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $sql .= " AND table_lembaga.nama_satuan_pendidikan LIKE ?";
        $countSql .= " AND table_lembaga.nama_satuan_pendidikan LIKE ?";
    }
    
    // Add pagination if limit is not 0
    if ($limit > 0) {
        $sql .= " LIMIT ? OFFSET ?";
    }
    
    // Prepare and execute the count query
    $countStmt = $conn->prepare($countSql);
    if (!empty($search)) {
        $countStmt->bind_param("s", $searchTerm);
    }
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $total = $countResult->fetch_assoc()['total'];
    
    // If limit is 0, we only want the count
    if ($limit === 0) {
        return ['total' => $total];
    }
    
    // Prepare and execute the data query
    $stmt = $conn->prepare($sql);
    
    if (!empty($search)) {
        if ($limit > 0) {
            $stmt->bind_param("sii", $searchTerm, $limit, $offset);
        } else {
            $stmt->bind_param("s", $searchTerm);
        }
    } else {
        if ($limit > 0) {
            $stmt->bind_param("ii", $limit, $offset);
        }
    }
    
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return [
        'data' => $data,
        'total' => $total
    ];
}

function selectNonPMA()
{
    global $conn;

    if (!$conn || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        return null;
    }

    $id = $_GET['id'];
    $sql = "SELECT 
                form_non_pma.*, 
                table_lembaga.nama_satuan_pendidikan 
            FROM 
                form_non_pma 
            JOIN 
                table_lembaga ON form_non_pma.id_table_lembaga = table_lembaga.id
            WHERE 
                form_non_pma.id = ? OR form_non_pma.id_table_lembaga = ?
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
}