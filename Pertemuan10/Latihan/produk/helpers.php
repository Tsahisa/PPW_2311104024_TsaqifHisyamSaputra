<?php
/**
 * Helper Functions untuk Kelola Produk
 */

/**
 * Helper function untuk format harga ke Rupiah
 * @param float|int $angka - Nilai harga yang akan diformat
 * @return string - Harga dalam format Rupiah (Rp X.XXX.XXX)
 * 
 * Property 1: Rupiah Format Consistency
 * For any numeric harga value, the formatRupiah function SHALL produce 
 * a string that starts with "Rp" and contains properly formatted number 
 * with thousand separators.
 * Validates: Requirements 2.4
 */
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
