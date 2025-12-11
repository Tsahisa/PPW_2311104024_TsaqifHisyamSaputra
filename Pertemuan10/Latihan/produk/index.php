<?php
// Halaman Index Produk - Menampilkan semua data produk
$pageTitle = 'Kelola Produk';
$basePath = '../';

// Include koneksi database dan helper functions
require_once '../koneksi.php';
require_once 'helpers.php';

/**
 * Fungsi untuk mencari produk berdasarkan keyword
 * @param mysqli $conn Koneksi database
 * @param string $keyword Kata kunci pencarian
 * @return mysqli_result|false Hasil query
 */
function cariProduk($conn, $keyword) {
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR kategori LIKE '%$keyword%' ORDER BY id DESC";
    return mysqli_query($conn, $query);
}

// Cek apakah ada pencarian
$keyword = '';
$isSearching = false;

if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
    $keyword = trim($_GET['keyword']);
    $isSearching = true;
    $result = cariProduk($conn, $keyword);
} else {
    // Query SELECT semua produk dari database
    $query = "SELECT * FROM produk ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
}

// Cek apakah query berhasil
if (!$result) {
    die("Error query: " . mysqli_error($conn));
}

// Hitung jumlah hasil
$jumlahHasil = mysqli_num_rows($result);
?>
<?php include '../layout/header.php'; ?>
<?php include '../layout/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="bi bi-box"></i> Kelola Produk</h1>
        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if (isset($_GET['pesan'])): ?>
        <?php
        $pesan = $_GET['pesan'];
        $alertClass = 'alert-info';
        $alertMessage = '';
        
        switch ($pesan) {
            case 'tambah_sukses':
                $alertClass = 'alert-success';
                $alertMessage = 'Data produk berhasil ditambahkan';
                break;
            case 'edit_sukses':
                $alertClass = 'alert-success';
                $alertMessage = 'Data produk berhasil diupdate';
                break;
            case 'hapus_sukses':
                $alertClass = 'alert-success';
                $alertMessage = 'Data produk berhasil dihapus';
                break;
            case 'error':
                $alertClass = 'alert-danger';
                $alertMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                break;
        }
        ?>
        <?php if ($alertMessage): ?>
            <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
                <?php echo $alertMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Form Pencarian -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="" class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" name="keyword" 
                               placeholder="Cari berdasarkan nama produk atau kategori..." 
                               value="<?php echo htmlspecialchars($keyword); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Hasil Pencarian Info -->
    <?php if ($isSearching): ?>
        <div class="alert alert-info">
            <?php if ($jumlahHasil > 0): ?>
                <i class="bi bi-info-circle"></i> Ditemukan <strong><?php echo $jumlahHasil; ?></strong> produk dengan keyword "<strong><?php echo htmlspecialchars($keyword); ?></strong>"
            <?php else: ?>
                <i class="bi bi-exclamation-circle"></i> Produk tidak ditemukan dengan keyword "<strong><?php echo htmlspecialchars($keyword); ?></strong>"
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Tabel Produk -->
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                <td><?php echo formatRupiah($row['harga']); ?></td>
                                <td><?php echo $row['stok']; ?></td>
                                <td><?php echo htmlspecialchars($row['kategori'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars(substr($row['deskripsi'] ?? '-', 0, 50)) . (strlen($row['deskripsi'] ?? '') > 50 ? '...' : ''); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       title="Hapus"
                                       onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Tidak ada data produk
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

</div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
