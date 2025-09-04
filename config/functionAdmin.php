<?php 
require_once __DIR__ . '/conn.php';

function readAdmin() {
    global $conn;

    try {
        $sql = "SELECT * FROM table_lembaga";
        $result = $conn->query($sql);
        if ($result === false) {
            error_log("Query failed: " . $conn->error);
            return [];
        }

        $data = [];

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data [] = $row;
            }
        }
        return $data;
    }
    catch (Exception $e) {
        error_log("Error in readLaporanPMA(): " . $e->getMessage());
        return [];
    }
}

function updateAdmin($id, $npsn, $nama_satuan_pendidikan, $foto_lembaga, $alamat, $kecamatan, $kelurahan, $status) {
    global $conn;

    if (!is_numeric($id)) {
        return false;
    }

    $npsn = htmlspecialchars($_POST['npsn']);
    $nama_satuan_pendidikan = htmlspecialchars($_POST['nama_satuan_pendidikan']);
    $foto_lembaga = htmlspecialchars($_POST['foto_lembaga']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $kecamatan = htmlspecialchars($_POST['kecamatan']);
    $kelurahan = htmlspecialchars($_POST['kelurahan']);
    $status = htmlspecialchars($_POST['status']);


    $sql = "UPDATE table_lembaga SET npsn = ?, nama_satuan_pendidikan = ?, foto_lembaga = ?, alamat = ?, kecamatan = ?, kelurahan = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $npsn, $nama_satuan_pendidikan, $foto_lembaga, $alamat, $kecamatan, $kelurahan, $status, $id);
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