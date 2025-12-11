<?php
// Halaman Form Tambah Produk
$pageTitle = 'Tambah Produk';
$basePath = '../';

// Include koneksi database
require_once '../koneksi.php';
?>
<?php include '../layout/header.php'; ?>
<?php include '../layout/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="bi bi-plus-circle"></i> Tambah Produk</h1>
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Alert Error jika ada -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php 
            $error = $_GET['error'];
            switch ($error) {
                case 'required':
                    echo 'Nama produk, harga, dan stok wajib diisi!';
                    break;
                case 'invalid_harga':
                    echo 'Harga harus berupa angka positif!';
                    break;
                case 'invalid_stok':
                    echo 'Stok harus berupa angka non-negatif!';
                    break;
                case 'db_error':
                    echo 'Terjadi kesalahan database. Silakan coba lagi.';
                    break;
                default:
                    echo 'Terjadi kesalahan. Silakan coba lagi.';
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Form Tambah Produk -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-box"></i> Form Tambah Produk</h5>
        </div>
        <div class="card-body">
            <form action="proses_tambah.php" method="POST" id="formTambahProduk">
                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                           placeholder="Masukkan nama produk" required maxlength="100">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="harga" name="harga" 
                           placeholder="Masukkan harga produk" required min="1" step="0.01">
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="stok" name="stok" 
                           placeholder="Masukkan jumlah stok" required min="0" value="0">
                </div>

                <!-- Kategori (Dropdown) -->
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Kecantikan">Kecantikan</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Otomotif">Otomotif</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Deskripsi (Textarea) -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" 
                              rows="4" placeholder="Masukkan deskripsi produk (opsional)"></textarea>
                </div>

                <hr>

                <!-- Tombol Submit -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../layout/footer.php'; ?>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
