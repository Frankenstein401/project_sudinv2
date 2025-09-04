<?php

require_once __DIR__ . '/config/functions.php';
$datas = readNPSN();

if(isset($_POST['searchbtn'])) {
    $keyword = $_POST['search'];
    $datas = searchNPSN($keyword);
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
    <div class="search-bar">
        <form action="" method="post">
            <input type="search" name="search" placeholder="Search by NPSN or Name">
            <button name="searchbtn" type="submit">Search</button>
        </form>
    </div>
    <div class="container">
        <?php foreach ($datas as $data) : ?>
        <div class="card-content">
            <p>NPSN: <?= $data['npsn']; ?></p>
            <p>Nama Satuan Pendidikan: <?= $data['nama_satuan_pendidikan']; ?></p>
            <img src="uploads/<?=$data['foto_lembaga'];?>" alt="Foto Lembaga" width="200">
            <p>Alamat: <?= $data['alamat']; ?></p>
            <p>Kecamatan: <?= $data['kecamatan']; ?></p>
            <p>Kelurahan: <?= $data['kelurahan']; ?></p>
            <p>Status: <?= $data['status']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>