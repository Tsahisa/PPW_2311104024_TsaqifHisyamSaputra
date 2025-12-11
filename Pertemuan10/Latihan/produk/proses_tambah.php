<?php
// Proses Tambah Produk
// Handle POST request untuk insert produk ke database

// Include koneksi database
require_once '../koneksi.php';

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Ambil data dari form
$nama_produk = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : '';
$stok = isset($_POST['stok']) ? $_POST['stok'] : '';
$kategori = isset($_POST['kategori']) ? trim($_POST['kategori']) : '';
$deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';

// Validasi server-side untuk required fields
// Requirement 3.3: Validasi nama_produk, harga, stok tidak boleh kosong
if (empty($nama_produk) || $harga === '' || $stok === '') {
    header('Location: tambah.php?error=required');
    exit;
}

// Validasi harga harus angka positif
if (!is_numeric($harga) || $harga <= 0) {
    header('Location: tambah.php?error=invalid_harga');
    exit;
}

// Validasi stok harus angka non-negatif
if (!is_numeric($stok) || $stok < 0) {
    header('Location: tambah.php?error=invalid_stok');
    exit;
}

// Sanitasi input untuk mencegah SQL injection (Requirement 7.3)
$nama_produk = mysqli_real_escape_string($conn, $nama_produk);
$harga = floatval($harga);
$stok = intval($stok);
$kategori = mysqli_real_escape_string($conn, $kategori);
$deskripsi = mysqli_real_escape_string($conn, $deskripsi);

// Query INSERT ke database
$query = "INSERT INTO produk (nama_produk, harga, stok, kategori, deskripsi) 
          VALUES ('$nama_produk', $harga, $stok, '$kategori', '$deskripsi')";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Tutup koneksi
    mysqli_close($conn);
    // Requirement 3.4: Redirect dengan pesan sukses
    header('Location: index.php?pesan=tambah_sukses');
    exit;
} else {
    // Tutup koneksi
    mysqli_close($conn);
    // Redirect dengan pesan error jika query gagal
    header('Location: tambah.php?error=db_error');
    exit;
}
?>
