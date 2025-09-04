<?php
require_once __DIR__ . '/../config/functionAdmin.php';

$id = $_GET['id'];
$data = getId($id);

if(!$data) {
    echo "<script>
        alert('Data not found');
        window.location.href = 'readAdmin.php';
    </script>";
    exit;
}

if(isset($_POST['update'])) {
    if(updateAdmin($id, $npsn, $nama_satuan_pendidikan, $foto_lembaga, $alamat, $kecamatan, $kelurahan, $status)) {
        echo "<script>
            alert('Data updated successfully');
            window.location.href = 'readAdmin.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update data');
            window.location.href = 'edit.php?id=$id';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="npsn" value="<?= $data['npsn']; ?>">
        <input type="text" name="nama_satuan_pendidikan" value="<?= $data['nama_satuan_pendidikan']; ?>">
        <input type="text" name="foto_lembaga" value="<?= $data['foto_lembaga']; ?>">
        <input type="text" name="alamat" value="<?= $data['alamat']; ?>">
        <input type="text" name="kecamatan" value="<?= $data['kecamatan']; ?>">
        <input type="text" name="kelurahan" value="<?= $data['kelurahan']; ?>">
        <input type="text" name="status" value="<?= $data['status']; ?>">
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>