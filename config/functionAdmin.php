<?php 
require_once __DIR__ . '/conn.php';

function readAdmin($searchTerm = '', $statusFilter = '') {
    global $conn;

    try {
        $sql = "SELECT * FROM table_lembaga WHERE 1=1";
        $params = array();
        $types = "";

        // Tambahkan kondisi pencarian jika ada
        if (!empty($searchTerm)) {
            $sql .= " AND (nama_satuan_pendidikan LIKE ? OR npsn LIKE ? OR alamat LIKE ? OR kecamatan LIKE ? OR kelurahan LIKE ?)";
            $searchPattern = "%$searchTerm%";
            $params = array_merge($params, [$searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern]);
            $types .= str_repeat('s', 5); // 5 parameter string
        }

        // Tambahkan filter status jika ada
        if (!empty($statusFilter)) {
            $sql .= " AND status = ?";
            $params[] = $statusFilter;
            $types .= 's';
        }

        $sql .= " ORDER BY nama_satuan_pendidikan ASC";
        
        $stmt = $conn->prepare($sql);
        
        // Bind parameter jika ada
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result === false) {
            error_log("Query failed: " . $conn->error);
            return [];
        }

        $data = [];

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
    catch (Exception $e) {
        error_log("Error in readAdmin(): " . $e->getMessage());
        return [];
    }
}

function updateAdmin($id, $npsn, $nama_satuan_pendidikan, $foto_lembaga, $alamat, $kecamatan, $kelurahan, $status) {
    global $conn;

    if (!is_numeric($id)) {
        return false;
    }

    // Escape data form
    $npsn = htmlspecialchars($_POST['npsn']);
    $nama_satuan_pendidikan = htmlspecialchars($_POST['nama_satuan_pendidikan']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $kecamatan = htmlspecialchars($_POST['kecamatan']);
    $kelurahan = htmlspecialchars($_POST['kelurahan']);
    $status = htmlspecialchars($_POST['status']);

    $fotoName = $foto_lembaga; // default pakai foto lama

    // cek apakah ada file baru diupload
    if (isset($_FILES['foto_lembaga']) && $_FILES['foto_lembaga']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['foto_lembaga']['type'], $allowedTypes)) {
            return "Format foto tidak diizinkan. Hanya JPG/PNG.";
        }

        $targetDir  = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // ambil ekstensi file
        $ext = pathinfo($_FILES['foto_lembaga']['name'], PATHINFO_EXTENSION);

        // buat nama file baru dengan hash
        $fotoName = md5(uniqid(rand(), true)) . "." . strtolower($ext);
        $targetFile = $targetDir . $fotoName;

        if (!move_uploaded_file($_FILES['foto_lembaga']['tmp_name'], $targetFile)) {
            return "Gagal upload foto.";
        }
    }

    // Update ke DB
    $sql = "UPDATE table_lembaga 
            SET npsn = ?, nama_satuan_pendidikan = ?, foto_lembaga = ?, alamat = ?, kecamatan = ?, kelurahan = ?, status = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $npsn, $nama_satuan_pendidikan, $fotoName, $alamat, $kecamatan, $kelurahan, $status, $id);
    $result = $stmt->execute();

    $stmt->close();
    return $result;
}


function getId($id) {
    
    global $conn;

    $sql = "SELECT * FROM table_lembaga WHERE id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_assoc();
    $stmt->close();
    return $data;
}
?>