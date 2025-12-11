<?php
// Proses Hapus Produk
// Handle GET request untuk delete produk dari database
// Requirement 5.1: Konfirmasi JavaScript sebelum hapus (di index.php)
// Requirement 5.2: DELETE dari database berdasarkan ID
// Requirement 5.3: Redirect dengan pesan sukses "Data produk berhasil dihapus"

// Include koneksi database
require_once '../koneksi.php';

// Cek apakah parameter ID ada
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php?pesan=error');
    exit;
}

// Ambil dan validasi ID
$id = intval($_GET['id']);

// Validasi ID harus positif
if ($id <= 0) {
    header('Location: index.php?pesan=error');
    exit;
}

// Cek apakah produk dengan ID tersebut ada
$checkQuery = "SELECT id FROM produk WHERE id = $id";
$checkResult = mysqli_query($conn, $checkQuery);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    // Produk tidak ditemukan
    mysqli_close($conn);
    header('Location: index.php?pesan=error');
    exit;
}

// Query DELETE dari database
// Property 5: Product Delete Completeness - after delete, querying product ID returns empty result
$query = "DELETE FROM produk WHERE id = $id";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Tutup koneksi
    mysqli_close($conn);
    // Requirement 5.3: Redirect dengan pesan sukses "Data produk berhasil dihapus"
    header('Location: index.php?pesan=hapus_sukses');
    exit;
} else {
    // Tutup koneksi
    mysqli_close($conn);
    // Redirect dengan pesan error jika query gagal
    header('Location: index.php?pesan=error');
    exit;
}
