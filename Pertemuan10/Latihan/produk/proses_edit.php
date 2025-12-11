<?php
// Proses Edit Produk
// Handle POST request untuk update produk di database
// Requirement 4.2: UPDATE data produk di database
// Requirement 4.3: Redirect dengan pesan sukses

// Include koneksi database
require_once '../koneksi.php';

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Ambil data dari form
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nama_produk = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$kategori = isset($_POST['kategori']) ? trim($_POST['kategori']) : '';
$deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';

// Validasi ID
if ($id <= 0) {
    header('Location: index.php?pesan=error');
    exit;
}

// Validasi server-side untuk required fields
if (empty($nama_produk) || $harga === '' || $stok === '') {
    header("Location: edit.php?id=$id&error=required");
    exit;
}

// Validasi harga harus angka positif
if (!is_numeric($harga) || $harga <= 0) {
    header("Location: edit.php?id=$id&error=invalid_harga");
    exit;
}

// Validasi stok harus angka non-negatif
if (!is_numeric($stok) || $stok < 0) {
    header("Location: edit.php?id=$id&error=invalid_stok");
    exit;
}

// Sanitasi input untuk mencegah SQL injection
$nama_produk = mysqli_real_escape_string($conn, $nama_produk);
$harga = floatval($harga);
$stok = intval($stok);
$kategori = mysqli_real_escape_string($conn, $kategori);
$deskripsi = mysqli_real_escape_string($conn, $deskripsi);

// Query UPDATE ke database
// Property 4: Product Update Consistency - after update, querying product returns new values with same ID
$query = "UPDATE produk SET 
          nama_produk = '$nama_produk', 
          harga = $harga, 
          stok = $stok, 
          kategori = '$kategori', 
          deskripsi = '$deskripsi' 
          WHERE id = $id";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Tutup koneksi
    mysqli_close($conn);
    // Requirement 4.3: Redirect dengan pesan sukses "Data produk berhasil diupdate"
    header('Location: index.php?pesan=edit_sukses');
    exit;
} else {
    // Tutup koneksi
    mysqli_close($conn);
    // Redirect dengan pesan error jika query gagal
    header("Location: edit.php?id=$id&error=db_error");
    exit;
}
