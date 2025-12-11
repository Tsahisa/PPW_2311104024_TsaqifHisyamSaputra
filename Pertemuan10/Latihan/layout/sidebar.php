<?php
// Sidebar Navigation dengan Bootstrap 5
// Menentukan halaman aktif berdasarkan URL
$currentPage = basename($_SERVER['PHP_SELF']);
$currentDir = basename(dirname($_SERVER['PHP_SELF']));
?>
<!-- Sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="sidebar-header">
        <h5 class="mb-0"><i class="bi bi-box-seam"></i> Sistem Akademik</h5>
    </div>
    <div class="position-sticky pt-3">
        <ul class="nav flex-column px-2">
            <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage == 'index.php' && $currentDir != 'produk') ? 'active' : ''; ?>" href="<?php echo $basePath ?? ''; ?>index.php">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($currentDir == 'produk' || strpos($currentPage, 'produk') !== false) ? 'active' : ''; ?>" href="<?php echo $basePath ?? ''; ?>produk/index.php">
                    <i class="bi bi-box"></i> Kelola Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $basePath ?? ''; ?>tampil_data.php">
                    <i class="bi bi-people"></i> Kelola Mahasiswa
                </a>
            </li>
        </ul>
        
        <hr class="my-3" style="border-color: rgba(255,255,255,0.1);">
        
        <ul class="nav flex-column px-2">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $basePath ?? ''; ?>tes_koneksi.php">
                    <i class="bi bi-database"></i> Test Koneksi
                </a>
            </li>
        </ul>
    </div>
</nav>
