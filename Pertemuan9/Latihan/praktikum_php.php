<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum PHP - 3 Studi Kasus</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        h2 { color: #007bff; margin-top: 30px; }
        h3 { color: #555; }
        .result { background-color: #e9ecef; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .highlight { color: #28a745; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        hr { margin: 30px 0; border: 1px solid #ddd; }
    </style>
</head>
<body>
<div class="container">

<h1>PRAKTIKUM PHP - 3 STUDI KASUS</h1>

<?php
// KASUS 1: PROGRAM KONVERSI SUHU
echo "<h2>KASUS 1: Program Konversi Suhu</h2>";

// Nilai suhu untuk dikonversi
$celcius = 30;
$fahrenheit = 86;

// Konversi Celcius ke Fahrenheit
// Rumus: C * 9/5 + 32
$celcius_to_fahrenheit = $celcius * 9/5 + 32;

// Konversi Fahrenheit ke Celcius
// Rumus: (F - 32) * 5/9
$fahrenheit_to_celcius = ($fahrenheit - 32) * 5/9;

// Konversi Celcius ke Kelvin
// Rumus: C + 273.15
$celcius_to_kelvin = $celcius + 273.15;

echo "<div class='result'>";
echo "<h3>Hasil Konversi Suhu:</h3>";
echo "<table>";
echo "<tr><th>Konversi</th><th>Nilai Awal</th><th>Hasil</th></tr>";

// Menggunakan number_format() untuk menampilkan 2 digit desimal
echo "<tr><td>Celcius ke Fahrenheit</td><td>{$celcius}°C</td><td><span class='highlight'>" . number_format($celcius_to_fahrenheit, 2) . "°F</span></td></tr>";
echo "<tr><td>Fahrenheit ke Celcius</td><td>{$fahrenheit}°F</td><td><span class='highlight'>" . number_format($fahrenheit_to_celcius, 2) . "°C</span></td></tr>";
echo "<tr><td>Celcius ke Kelvin</td><td>{$celcius}°C</td><td><span class='highlight'>" . number_format($celcius_to_kelvin, 2) . " K</span></td></tr>";

echo "</table>";
echo "</div>";

echo "<hr>";

// KASUS 2: KALKULATOR DISKON BERTINGKAT
echo "<h2>KASUS 2: Kalkulator Diskon Bertingkat</h2>";

// Fungsi untuk menghitung diskon bertingkat
function hitungDiskon($totalBelanja) {
    $diskon = 0;
    $persenDiskon = 0;
    
    // Logika diskon bertingkat (urutan dari yang terbesar)
    // Diskon 30% jika belanja >= Rp 1.000.000
    if ($totalBelanja >= 1000000) {
        $persenDiskon = 30;
        $diskon = $totalBelanja * 0.30;
    }
    // Diskon 20% jika belanja >= Rp 500.000
    elseif ($totalBelanja >= 500000) {
        $persenDiskon = 20;
        $diskon = $totalBelanja * 0.20;
    }
    // Diskon 10% jika belanja > Rp 100.000 (menggunakan > sesuai modul)
    elseif ($totalBelanja > 100000) {
        $persenDiskon = 10;
        $diskon = $totalBelanja * 0.10;
    }
    
    $totalBayar = $totalBelanja - $diskon;
    
    return [
        'totalBelanja' => $totalBelanja,
        'persenDiskon' => $persenDiskon,
        'nominalDiskon' => $diskon,
        'totalBayar' => $totalBayar
    ];
}

// Contoh beberapa skenario belanja
$skenarioBelanja = [80000, 150000, 500000, 1200000];

echo "<div class='result'>";
echo "<h3>Hasil Perhitungan Diskon:</h3>";
echo "<table>";
echo "<tr><th>Total Belanja</th><th>Diskon (%)</th><th>Nominal Diskon</th><th>Total Bayar Bersih</th></tr>";

foreach ($skenarioBelanja as $belanja) {
    $hasil = hitungDiskon($belanja);
    echo "<tr>";
    echo "<td>Rp " . number_format($hasil['totalBelanja'], 0, ',', '.') . "</td>";
    echo "<td>{$hasil['persenDiskon']}%</td>";
    echo "<td>Rp " . number_format($hasil['nominalDiskon'], 0, ',', '.') . "</td>";
    echo "<td><span class='highlight'>Rp " . number_format($hasil['totalBayar'], 0, ',', '.') . "</span></td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

// Penjelasan logika diskon
echo "<div class='result'>";
echo "<h3>Ketentuan Diskon:</h3>";
echo "<ul>";
echo "<li>Belanja <b>> Rp 100.000</b> → Diskon 10%</li>";
echo "<li>Belanja <b>>= Rp 500.000</b> → Diskon 20%</li>";
echo "<li>Belanja <b>>= Rp 1.000.000</b> → Diskon 30%</li>";
echo "</ul>";
echo "</div>";

echo "<hr>";

// KASUS 3: MANIPULASI ARRAY NILAI
echo "<h2>KASUS 3: Manipulasi Array Nilai Mahasiswa</h2>";

// Array nilai mahasiswa sesuai soal
$nilaiMahasiswa = [75, 89, 65, 90, 85, 70, 98, 65, 69, 70, 12];

echo "<div class='result'>";
echo "<h3>Data Array Nilai:</h3>";
echo "<p>[" . implode(", ", $nilaiMahasiswa) . "]</p>";
echo "</div>";

// 1. Nilai Tertinggi menggunakan max()
$nilaiTertinggi = max($nilaiMahasiswa);

// 2. Nilai Terendah menggunakan min()
$nilaiTerendah = min($nilaiMahasiswa);

// 3. Rata-rata nilai menggunakan array_sum() dan count()
$totalNilai = array_sum($nilaiMahasiswa);
$jumlahMahasiswa = count($nilaiMahasiswa);
$rataRata = $totalNilai / $jumlahMahasiswa;

// 4. Jumlah mahasiswa yang lulus (nilai >= 70)
$jumlahLulus = 0;
foreach ($nilaiMahasiswa as $nilai) {
    if ($nilai >= 70) {  // Menggunakan >= sesuai ketentuan modul
        $jumlahLulus++;
    }
}

// Alternatif menggunakan array_filter
$mahasiswaLulus = array_filter($nilaiMahasiswa, function($nilai) {
    return $nilai >= 70;
});

// 5. Urutan nilai dari tertinggi ke terendah menggunakan rsort()
$nilaiUrut = $nilaiMahasiswa;  // Copy array agar tidak mengubah array asli
rsort($nilaiUrut);  // Sort descending (tertinggi ke terendah)

echo "<div class='result'>";
echo "<h3>Hasil Manipulasi Array:</h3>";
echo "<table>";
echo "<tr><th>Operasi</th><th>Hasil</th></tr>";
echo "<tr><td>Nilai Tertinggi (max)</td><td><span class='highlight'>{$nilaiTertinggi}</span></td></tr>";
echo "<tr><td>Nilai Terendah (min)</td><td><span class='highlight'>{$nilaiTerendah}</span></td></tr>";
echo "<tr><td>Rata-rata Nilai</td><td><span class='highlight'>" . number_format($rataRata, 2) . "</span></td></tr>";
echo "<tr><td>Jumlah Mahasiswa Lulus (nilai >= 70)</td><td><span class='highlight'>{$jumlahLulus} mahasiswa</span></td></tr>";
echo "<tr><td>Urutan Nilai (Tertinggi ke Terendah)</td><td><span class='highlight'>[" . implode(", ", $nilaiUrut) . "]</span></td></tr>";
echo "</table>";
echo "</div>";

// Detail mahasiswa lulus
echo "<div class='result'>";
echo "<h3>Detail Mahasiswa Lulus (Nilai >= 70):</h3>";
echo "<p>Nilai yang lulus: [" . implode(", ", $mahasiswaLulus) . "]</p>";
echo "</div>";

?>

<hr>
<p style="text-align: center; color: #666; font-size: 12px;">
    Praktikum PHP - Modul 9 | Dibuat dengan PHP
</p>

</div>
</body>