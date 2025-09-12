<?php
session_start();
require_once __DIR__ . '/../config/functionAdmin.php';

// Jika tidak ada, artinya belum login, maka redirect ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: ../validasi.php");
    // exit();
}

if($_SESSION['user']['user'] != 'admin' && $_SESSION['user']['key'] != 'admin'){
    header("Location: ../validasi.php");
} else {
    header("Location: readAdmin.php");
}
