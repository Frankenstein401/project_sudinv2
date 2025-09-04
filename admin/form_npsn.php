<?php

require_once __DIR__ . '/../config/functions.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = insertLembaga($_POST, $_FILES);

    if ($result === true) {
        $message = "<p style='color:green;'>Data berhasil disimpan!</p>";
    } else {
        $message = "<p style='color:red;'>$result</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Input Lembaga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h2>Form Input Data Lembaga</h2>
    <?= $message; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>NPSN:</label><br>
        <input type="text" name="npsn" required><br><br>

        <label>Nama Satuan Pendidikan:</label><br>
        <input type="text" name="nama_satuan_pendidikan" required><br><br>

        <label>Foto Lembaga:</label><br>
        <input type="file" name="foto_lembaga" accept="image/*" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <label>Kecamatan:</label><br>
        <input type="text" name="kecamatan" required><br><br>

        <label>Kelurahan:</label><br>
        <input type="text" name="kelurahan" required><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="PMA">PMA</option>
            <option value="Non PMA">Non PMA</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>