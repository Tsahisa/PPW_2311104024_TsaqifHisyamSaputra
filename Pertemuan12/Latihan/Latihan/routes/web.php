<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/beranda', function () { return 'Halaman Beranda';
// });

// Route::get('/kendaraan/{jenis}', function ($jenis) { return "Tampilkan data kendaraan dengan jenis $jenis";
// });

// Route::get('/kendaraan/{jenis?}/{merek?}', function ($a = 'motor',$b = 'honda') { return "Cek harga kendaraan $a $b";
// });

// Route::get('/product/{id}', function ($id) { return "Tampilkan product dengan id = $id";
// });

// Route::get('/product/{id}', function ($id) { return "Tampilkan product dengan id = $id";
// })->where('id', '[0-9]+');

// Route::get('/hubungi-kami', function () { return '<h1>Hubungi Kami</h1>';
// });
// Route::redirect('/contact-us', '/hubungi-kami');

// Route::prefix('/admin')->group(function() {
// Route::get('/dashboard', function() { return 'Tampilkan dashboard aplikasi';
// });
// Route::get('/datapegawai', function() { return 'Tampilkan data pegawai';
// });
// Route::get('/datamahasiswa', function() { return 'Tampilkan data mahasiswa';
// });
// });

// Route::fallback(function () {
// return "Maaf, alamat tidak ditemukan";
// });

// Route::get('/baju/1', function () { return "Baju ke-1";
// });
// Route::get('/baju/1', function () { return "Baju saya ke-1";
// });
// Route::get('/baju/1', function () { return "Baju kita ke-1";
// });

// Route::get('/baju/{a}', function ($a) { return "Baju ke-$a";
// });
// Route::get('/baju/{b}', function ($b) { return "Baju saya ke-$b";
// });
// Route::get('/baju/{c}', function ($c) { return "Baju kita ke-$c";
// });

Route::get('/mahasiswa', function () {
return view('universitas.mahasiswa',["mhs1"=>"Abdul Hafidz"]);
});

Route::get('/mahasiswa', function () { return view('universitas.mahasiswa', [
"mhs1" => "Abdul hafidz", "mhs2" => "Aufar Bintang",
"mhs3" => "Muhammad Nur Hamada", "mhs4" => "Hastin Ajeng"
]);
});
