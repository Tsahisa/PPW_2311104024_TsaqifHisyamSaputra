<?php
// Fungsi: Membuat koneksi ke database MySQL
$host = "localhost";
$username = "root"; // Username MySQL (default XAMPP)
$password = ""; // Password MySQL (default XAMPP kosong)
$database = "akademik"; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset UTF-8 untuk mendukung karakter Indonesia
mysqli_set_charset($conn, "utf8");
?>