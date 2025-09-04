<?php
// auth.php

// 1. Wajib memulai session di baris paling awal
session_start();

require_once __DIR__ . '/conn.php';

function validateNPSN() {
    global $conn;
    // 3. Pastikan request adalah POST dari form login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // 4. Ambil data dari form
        $npsn = $_POST['npsn'];
        $nama_lembaga = $_POST['nama_lembaga'];
        
        // 5. Query untuk mencari data lembaga berdasarkan NPSN dan Nama Lembaga
        // Menggunakan prepared statements untuk keamanan dari SQL Injection
        $sql = "SELECT * FROM table_lembaga WHERE npsn = ? AND nama_satuan_pendidikan = ?";
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Gagal mempersiapkan statement: " . $conn->error);
        }
        
        // "ss" berarti kedua parameter adalah string
        $stmt->bind_param("ss", $npsn, $nama_lembaga);
        
        // Eksekusi query
        $stmt->execute();
        
        // Ambil hasilnya
        $result = $stmt->get_result();
        
        // 6. Cek apakah data ditemukan (login berhasil)
        if ($result->num_rows === 1) {
            // Jika data ditemukan, ambil semua datanya sebagai array asosiatif
            $lembaga_data = $result->fetch_assoc();
            
            // 7. Simpan seluruh data ke dalam session
            // Kita simpan dalam satu key 'user' agar rapi
            $_SESSION['user'] = $lembaga_data;
            
            // 8. Redirect ke halaman dashboard atau halaman utama setelah login
            header("Location: pilih_jenis.php");
            exit(); // Pastikan script berhenti setelah redirect
            
        } else {
            // Jika data tidak ditemukan (login gagal)
            $_SESSION['error'] = "NPSN atau Nama Lembaga salah!";
            header("Location: validasi.php");
            exit();
        }
        
        // Tutup statement
        $stmt->close();
        
    } else {
        // Jika file diakses langsung tanpa melalui form POST, redirect ke halaman login
        header("Location: validasi.php");
        exit();
    }
}

?>