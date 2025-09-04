<?php 
require_once __DIR__ . '/../config/functionAdmin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>NPSN</th>
                <th>Nama Satuan Pendidikan</th>
                <th>Foto Lembaga</th>
                <th>Alamat</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $datas = readAdmin();
            ?>
            <?php foreach ($datas as $data): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['npsn'] ?></td>
                    <td><?= $data['nama_satuan_pendidikan'] ?></td>
                    <td><?= $data['foto_lembaga'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['kecamatan'] ?></td>
                    <td><?= $data['kelurahan'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $data['id'] ?>"><button class="btn btn-info">Edit</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>