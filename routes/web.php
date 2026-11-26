<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UjiBladeController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\KantinController;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Http\Controllers\LabController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\MahasiswaController;

Route::get('/ukm', [UkmController::class, 'index'])
    ->name('ukm.index');

Route::get('/ukm/{ukm}', [UkmController::class, 'show'])
    ->name('ukm.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lab', [LabController::class, 'index']);
Route::get('/uji-blade', [UjiBladeController::class, 'index']);

Route::get('/beranda', [AkademikController::class, 'beranda']);
Route::get('/prodi', [AkademikController::class, 'prodi']);
Route::get('/dosen', [AkademikController::class, 'dosen']);
Route::get('/mahasiswa', [AkademikController::class, 'mahasiswa']);
Route::get('/mahasiswa/tambah', [MahasiswaController::class, 'create']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->middleware('throttle:pendaftaran');
Route::get('/cek-nim', [MahasiswaController::class, 'cekNim'])->middleware('throttle:cek-nim');
Route::get('/mahasiswa/{mahasiswa}', [AkademikController::class, 'mahasiswaShow']);
Route::get('/mahasiswa/{mahasiswa}/ubah', [MahasiswaController::class, 'edit']);
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy']);
Route::get('/matkul', [AkademikController::class, 'matkul']);
Route::get('/matkul/{matkul}', [AkademikController::class, 'matkulShow']);
Route::get('/peringkat', [AkademikController::class, 'peringkat']);
Route::get('/lab', [LabController::class, 'index']);
Route::get('/lab/{alat}', [LabController::class, 'show']);
Route::get('/ukm', [UkmController::class, 'index'])
    ->name('ukm.index');

Route::view('/percobaan', 'percobaan', [
    'nama' => 'Anisa Rizky Amalia',
    'catatan' => '<script>document.body.style.background="tomato"</script>Mahasiswa aktif',
    'matkul' => [
        ['nama' => 'Pemrograman Web 2', 'sks' => 3],
    ],
]);

Route::get('/kantin', [KantinController::class, 'index']);
Route::get('/kantin/tentang', [KantinController::class, 'tentang']);

Route::get('/kantin/kosong', function () {
    $menu = [];
    $jumlahMenu = 0;
    $jumlahHabis = 0;

    return view('kantin.index', compact(
        'menu',
        'jumlahMenu',
        'jumlahHabis'
    ));
});
Route::get('/uji', function () {
    return Barang::count();
});