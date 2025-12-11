<?php
// Halaman Form Edit Produk
// Requirement 4.1: Form pre-filled dengan data existing
$pageTitle = 'Edit Produk';
$basePath = '../';

// Include koneksi database
require_once '../koneksi.php';

// Ambil ID produk dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validasi ID
if ($id <= 0) {
    header('Location: index.php?pesan=error');
    exit;
}

// Query untuk mengambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($conn, $query);

// Cek apakah produk ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    header('Location: index.php?pesan=error');
    exit;
}

// Ambil data produk
$produk = mysqli_fetch_assoc($result);
?>
<?php include '../layout/header.php'; ?>
<?php include '../layout/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="bi bi-pencil-square"></i> Edit Produk</h1>
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

    <!-- Form Edit Produk -->
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-box"></i> Form Edit Produk</h5>
        </div>
        <div class="card-body">
            <form action="proses_edit.php" method="POST" id="formEditProduk">
                <!-- Hidden ID -->
                <input type="hidden" name="id" value="<?php echo $produk['id']; ?>">

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                           placeholder="Masukkan nama produk" required maxlength="100"
                           value="<?php echo htmlspecialchars($produk['nama_produk']); ?>">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="harga" name="harga" 
                           placeholder="Masukkan harga produk" required min="1" step="0.01"
                           value="<?php echo $produk['harga']; ?>">
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="stok" name="stok" 
                           placeholder="Masukkan jumlah stok" required min="0"
                           value="<?php echo $produk['stok']; ?>">
                </div>

                <!-- Kategori (Dropdown) -->
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Elektronik" <?php echo ($produk['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                        <option value="Pakaian" <?php echo ($produk['kategori'] == 'Pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                        <option value="Makanan" <?php echo ($produk['kategori'] == 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
                        <option value="Minuman" <?php echo ($produk['kategori'] == 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
                        <option value="Kesehatan" <?php echo ($produk['kategori'] == 'Kesehatan') ? 'selected' : ''; ?>>Kesehatan</option>
                        <option value="Kecantikan" <?php echo ($produk['kategori'] == 'Kecantikan') ? 'selected' : ''; ?>>Kecantikan</option>
                        <option value="Olahraga" <?php echo ($produk['kategori'] == 'Olahraga') ? 'selected' : ''; ?>>Olahraga</option>
                        <option value="Otomotif" <?php echo ($produk['kategori'] == 'Otomotif') ? 'selected' : ''; ?>>Otomotif</option>
                        <option value="Lainnya" <?php echo ($produk['kategori'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                    </select>
                </div>

                <!-- Deskripsi (Textarea) -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" 
                              rows="4" placeholder="Masukkan deskripsi produk (opsional)"><?php echo htmlspecialchars($produk['deskripsi'] ?? ''); ?></textarea>
                </div>

                <hr>

                <!-- Tombol Submit -->
                <!-- Requirement 4.4: Tombol Batal untuk kembali tanpa perubahan -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save"></i> Update
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
