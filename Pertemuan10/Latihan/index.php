<?php
// Dashboard - Halaman Utama
$pageTitle = 'Dashboard - Sistem Akademik';
$basePath = '';

// Include header
include 'layout/header.php';

// Include sidebar
include 'layout/sidebar.php';
?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="bi bi-speedometer2"></i> Dashboard</h1>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Kelola Produk</h6>
                            <small>Manajemen data produk</small>
                        </div>
                        <i class="bi bi-box fs-1"></i>
                    </div>
                    <a href="produk/index.php" class="btn btn-light btn-sm mt-3">
                        <i class="bi bi-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Kelola Mahasiswa</h6>
                            <small>Manajemen data mahasiswa</small>
                        </div>
                        <i class="bi bi-people fs-1"></i>
                    </div>
                    <a href="tampil_data.php" class="btn btn-light btn-sm mt-3">
                        <i class="bi bi-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Test Koneksi</h6>
                            <small>Cek koneksi database</small>
                        </div>
                        <i class="bi bi-database fs-1"></i>
                    </div>
                    <a href="tes_koneksi.php" class="btn btn-light btn-sm mt-3">
                        <i class="bi bi-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Selamat datang di Sistem Akademik. Pilih menu di sidebar untuk mengelola data.
    </div>

<?php
// Include footer
include 'layout/footer.php';
?>
