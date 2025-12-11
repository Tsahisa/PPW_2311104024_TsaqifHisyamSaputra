-- =====================================================
-- Script SQL untuk Tabel Produk
-- Database: akademik
-- =====================================================

-- Buat tabel produk jika belum ada
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(12,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    kategori VARCHAR(50),
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Sample Data untuk Testing
-- =====================================================

INSERT INTO produk (nama_produk, harga, stok, kategori, deskripsi) VALUES
('Laptop ASUS VivoBook', 8500000.00, 15, 'Elektronik', 'Laptop ASUS VivoBook 14 inch, Intel Core i5, RAM 8GB, SSD 512GB'),
('Mouse Logitech M331', 250000.00, 50, 'Aksesoris', 'Mouse wireless Logitech M331 Silent Plus, ergonomis dan nyaman'),
('Keyboard Mechanical RGB', 450000.00, 30, 'Aksesoris', 'Keyboard mechanical dengan backlight RGB, switch blue'),
('Monitor Samsung 24 inch', 2100000.00, 10, 'Elektronik', 'Monitor Samsung 24 inch Full HD, IPS Panel, 75Hz'),
('Headset Gaming Razer', 850000.00, 25, 'Aksesoris', 'Headset gaming Razer Kraken dengan surround sound 7.1'),
('SSD Samsung 500GB', 750000.00, 40, 'Komponen', 'SSD Samsung 870 EVO 500GB SATA III'),
('RAM DDR4 16GB', 650000.00, 35, 'Komponen', 'RAM DDR4 16GB 3200MHz untuk PC Desktop'),
('Webcam Logitech C920', 1200000.00, 20, 'Aksesoris', 'Webcam Logitech C920 HD Pro 1080p'),
('Printer Epson L3210', 2300000.00, 8, 'Elektronik', 'Printer Epson EcoTank L3210 All-in-One'),
('USB Flash Drive 64GB', 85000.00, 100, 'Aksesoris', 'USB Flash Drive SanDisk 64GB USB 3.0');
