<?php
// Konfigurasi database
$host = '172.17.1.93';
$username = 'root';
$password = 'Smkn12jkt';
$database = 'database_sudin_dev_test';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>